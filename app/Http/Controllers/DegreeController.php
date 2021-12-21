<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Degrees;
use App\Models\Course;
use App\Models\Instructors;
use App\Models\Universities;
use App\Models\orders;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Notifications\contactsnew;

class DegreeController extends Controller
{      
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getdegree (Request $request)
    {
        $university_id = $request->university_id;
        $selected_degrees = Degrees::select('degree_name','id')->where('university_id',$university_id)->get();
        return response()->json(['success' => true, 'degree_data' => $selected_degrees]);
    }

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_degree (Request $request)
    {
        $university = $request->university;
        $type = $request->type;
        $html = '';

        if(isset($university)){
            foreach ($university as $key => $value) {
                $html .='<option style = "display:none;"selected data-type = "'.$value['type'].'" data-id = "'.$value['university_id'].'" value="'.$value['university_name'].'">'.$value['university_name'].'</option>';
            }    
        if($type == '0'){
            $selected_degrees = Degrees::select('degree_name','id')->where('university_id',$university[0]['university_id'])->get();
            foreach ($selected_degrees as $values) {
                $html .= '<option data-type = "1" data-id = "'.$values->id.'" value="' .$values->degree_name.'">'.$values->degree_name .'</option>';
                $degrees_id[] = $values->id;
            }
            $data['courses'] = array();
            $data['selected_universities'] = array();
            $data['course_id'] = '';
            $data['degrees'] = $degrees_id;
            $data['type'] = $type;
            }
            if($type == '1'){
                $selected_courses = Course::select('course_id','course_name')->where('degree_id',$university[1]['university_id'])->get();
                foreach ($selected_courses as $values) {
                    $html .= '<option data-type = "2" data-id = "'.$values->course_id.'" value="' .$values->course_name.'">'.$values->course_name .'</option>';
                    $courses_id[] = $values->course_id;
                }
                $data['degrees'] = array();
                $data['selected_universities'] = array();
                $data['course_id'] = '';
                $data['courses'] = $courses_id;
                $data['type'] = $type;
            }
            if($type == '2'){
                $data['degrees'] =array();
                $data['courses'] = array();
                $data['selected_universities'] = array();
                $data['type'] = $type;
                $data['course_id'] = $university[2]['university_id'];
                $data['course_name'] = $university[2]['university_name'];
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

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_private_degree (Request $request)
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
                $selected_courses = Course::select('course_id','course_name')->where('degree_id',$private_university[1]['university_id'])->get();
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

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_simulation_degree (Request $request)
    {
        $simulation_university = $request->university;
        $simulation_type = $request->type;
        $html = '';
        if(isset($simulation_university)){
            foreach ($simulation_university as $key => $value) {
                $html .='<option selected data-type = "'.$value['type'].'" data-id = "'.$value['university_id'].'" value="'.$value['university_name'].'">'.$value['university_name'].'</option>';
            }    
        if($simulation_type == '0'){
            $selected_degrees = Degrees::select('degree_name','id')->where('university_id',$simulation_university[0]['university_id'])->get();
            foreach ($selected_degrees as $values) {
                $html .= '<option data-type = "1" data-id = "'.$values->id.'" value="' .$values->degree_name.'">'.$values->degree_name .'</option>';
                $degrees_id[] = $values->id;
            }
            $data['courses'] = array();
            $data['selected_universities'] = array();
            $data['course_id'] = '';
            $data['degrees'] = $degrees_id;
            $data['type'] = $simulation_type;
            }
            if($simulation_type == '1'){
                $selected_courses = Course::select('course_id','course_name')->where('degree_id',$simulation_university[1]['university_id'])->get();
                foreach ($selected_courses as $values) {
                    $html .= '<option data-type = "2" data-id = "'.$values->course_id.'" value="' .$values->course_name.'">'.$values->course_name .'</option>';
                    $courses_id[] = $values->course_id;
                }
                $data['degrees'] = array();
                $data['selected_universities'] = array();
                $data['course_id'] = '';
                $data['courses'] = $courses_id;
                $data['type'] = $simulation_type;
            }
            if($simulation_type == '2'){
                $data['degrees'] =array();
                $data['courses'] = array();
                $data['selected_universities'] = array();
                $data['type'] = $simulation_type;
                $data['course_id'] = $simulation_university[2]['university_id'];
                $data['course_name'] = $simulation_university[2]['university_name'];
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

    public function showDegree($id)
    {
        $degree = Degrees::findOrFail($id);
        $courses = DB::table('courses')->where('degree_id',$id)->where('university_id',$degree->university_id)->paginate(4);
        $packages = DB::table('packages')->paginate(4);   
        $ordered_courses = array();
        $ordered_packages = array();
    	foreach ($packages as $package) {
		 	$courses_new = array();
		 	$coursesIds = explode(",", $package->course_id);
		 	$courses_new = Course::select('*')->whereIn('course_id',$coursesIds)->get();
		 	$package->courses_info =$courses_new;
    	}
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $ordered_courses = orders::select('*')->where('user_id',$user_id)->where('course_type','0')->pluck('ordered_courses');
            $ordered_packages = orders::select('*')->where('user_id',$user_id)->where('course_type','1')->pluck('ordered_packages');
        }
    	return view('includes.degree',compact('degree','courses','packages','ordered_courses','ordered_packages'));
    }
}

