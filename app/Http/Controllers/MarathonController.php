<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lectures;
use App\Models\recommendations;
use App\Models\Topics;
use App\Models\Instructors;
use App\Models\User;
use App\Models\question_answer;
use App\Models\Universities;
use App\Models\Degrees;
use App\Models\MarathonOrder;
use App\Models\MarathonQuestion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MarathonController extends Controller
{
    public function showMarathonDetails($id)
    {
        $user_ids = array();
        $recommendations = array();
        $users_data = array();
    	$courses_data = Course::select('*')->where('course_id',$id)->get();
        if(count($courses_data) == 0)  abort(404); 
        $related_products = Course::where('degree_id',$courses_data[0]->degree_id)->where('course_id', '!=' ,$id)->get();
        $packages = DB::table('packages')->paginate(4);   
        foreach ($packages as $package) {
            $courses_new = array();
            $coursesIds = explode(",", $package->course_id);
            $courses_new = Course::select('*')->whereIn('course_id',$coursesIds)->get();
            $package->courses_info =$courses_new;
        }
    	foreach ($courses_data as $value) {
    		$syllabus = array();
            $courseid = $value->course_id;
            $lectures_data = Lectures::select('*')->where('course_id',$courseid)->get();
            $syllabus['lectures'] = $lectures_data;
            foreach($lectures_data as $lecture){
                $lectureid = $lecture->id;
                $topics_data = Topics::select('*')->where('lecture_id',$lectureid)->get();
                $lecture['topics'] = $topics_data;
            }
    	}
    	$instructors_data = Instructors::select('*')->where('instructor_course_id',$id)->get();
        $recommendations = recommendations::select('*')->where('course_id',$id)->where('status',1)->get();
        foreach ($recommendations as $recommendation) {
            $user_ids[] = $recommendation->user_id;
        }
        $users_data = User::select('*')->whereIn('id',$user_ids)->get();
    	//category one for questions related to courses
    	$questions = question_answer::select('*')->get();
        $cource_title = $courses_data[0]->course_name;
        $cource_image = $courses_data[0]->image;
        $cource_degree = $courses_data[0]->degrees->degree_name;
        return view('includes.marathon-detail',compact('courses_data','packages','syllabus','instructors_data','questions','recommendations','users_data','related_products'));        
    }

    public function get_marathon(Request $request)
    {
        $private_university = $request->university;
        $private_type = $request->type;
        $html = '';
        if(isset($private_university)){
            foreach ($private_university as $key => $value) {
                $html .='<option selected data-type = "'.$value['type'].'" data-id = "'.$value['university_id'].'" value="'.$value['university_name'].'">'.$value['university_name'].'</option>';
            }    
            if($private_type == '0'){
                $selected_degrees = Degrees::select('degree_name','id')->where('university_id',$private_university[0]['university_id'])->get();
                foreach ($selected_degrees as $values) {
                    $html .= '<option data-type = "1" data-id = "'.$values->id.'" value="' .$values->degree_name.'">'.$values->degree_name .'</option>';
                    $degrees_id[] = $values->id;
                }
                $data['courses'] = array();
                $data['selected_universities'] = array();
                $data['instructor_id'] = '';
                $data['degrees'] = $degrees_id;
                $data['type'] = $private_type;
            }
            if($private_type == '1'){
                $selected_courses = Course::select('course_id','course_name')->where('degree_id',$private_university[1]['university_id'])->where('university_id',$private_university[0]['university_id'])->get();
                foreach ($selected_courses as $values) {
                    $html .= '<option data-type = "2" data-id = "'.$values->course_id.'" value="' .$values->course_name.'">'.$values->course_name .'</option>';
                    $courses_id[] = $values->course_id;
                }
                $data['degrees'] = array();
                $data['selected_universities'] = array();
                $data['instructor_id'] = '';
                $data['courses'] = $courses_id;
                $data['type'] = $private_type;
            }
            if($private_type == '2'){
                $data['degrees'] =array();
                $data['courses'] = array();
                $data['selected_universities'] = array();
                $data['type'] = $private_type;
                $selected_instructors = Instructors::select('*')->where('instructor_course_id',$private_university[2]['university_id'])->get();
                foreach ($selected_instructors as $value) {
                    $instructor_id[] = $value->id;
                }
                $data['instructor_id'] = $instructor_id;

            }

            $data['html'] = $html;
            return json_encode($data);
            die;
        }else{
            $selected_universities = array();
            $selected_universities = Universities::select('*')->get();
            foreach ($selected_universities as $value) {
                $html .= '<option data-type = "0" data-id = "'.$value->id.'" value="' .$value->university_name.'">'.$value->university_name .'</option>';
            }
            $data['degrees'] =array();
            $data['courses'] = array();
            $data['course_id'] = '';
            $data['selected_universities'] = $selected_universities;
            $data['html'] = $html;
            return json_encode($data);
            die;
        }
    }

    public function marathonRegistartion(Request $request)
    {
        $marathon = new MarathonOrder();
        $marathon->user_id = Auth::user()->id;
        $marathon->course_id = $request->course_id;
        $marathon->is_paid = 0;
        $marathon->save();
        if($marathon){
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }

    public function storeQuestions(Request $request)
    {
        $marathonid = $request->marathonid;
        $file = $request->file('file');
        if(!empty($file)){
           $destinationPath = public_path().'/assets/marathon-questions/';
           $original_name = $file->getClientOriginalName();
           $file_name = str_replace(' ','_',time().$file->getClientOriginalName());
           if($file->move($destinationPath,$file_name)){
               $image_name = $file_name;
               $data['status'] = 1;
               $data['image_name'] = $image_name;

               $marathonQuestion = new MarathonQuestion();
               $marathonQuestion->user_id = Auth::user()->id;
               $marathonQuestion->mararthon_id = $marathonid;
               $marathonQuestion->file = $image_name;
               $marathonQuestion->save();
           }
           else{
               $data['status'] = 0;
           }
       }
       else{
           $data['status'] = 0;
       }
       return json_encode($data);        
    }
}
