<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Course;
use App\Models\Instructors;
use App\Models\Package;
use App\Models\question_answer;
use App\Models\Lectures;
use App\Models\recommendations;
use App\Models\Topics;
use App\Models\grouped_courses;
use App\Models\orders;
use Illuminate\Support\Facades\DB;
use App\Models\coursematerial;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CoursesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = DB::table('courses')->paginate(4);
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
    	return view('includes.courses',compact('courses','packages','ordered_courses','ordered_packages'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCourse($id)
    {
        $user_ids = array();
        $recommendations = array();
        $users_data = array();
    	$courses_data = Course::select('*')->where('course_id',$id)->get();        
        $related_course = Course::where('degree_id',$courses_data[0]->degree_id)->whereNotIn('course_id', [$id])->get();
        $ordered_chapter = orders::where('user_id',Auth::user()->id)->where('course_type','3')->get()->toArray(); // Get chapter where user have purchased
        $payed_chapters_list =[];
        if(!empty($ordered_chapter)){
            foreach($ordered_chapter as $key=>$val){
                array_push($payed_chapters_list,$val['ordered_courses']);
            }
        }
    	foreach ($courses_data as $value) {
    		$syllabus = array();
            $courseid = $value->course_id;
            
            $topics_data = Topics::select('*')->where('course_id',$courseid)->get();
            $syllabus['topics'] = $topics_data;
           
            foreach($topics_data as $topic){
                $topicid = $topic->id;
                $lectures_data = Lectures::select('*')->where('topic_id',$topicid)->get();
                $topic['lectures'] = $lectures_data;
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
        $cource_degree = @$courses_data[0]->degrees->degree_name;
        $university_name = $courses_data[0]->university->university_name;
        $this->recentlyViewed($cource_title,$cource_image,$cource_degree,$university_name,$id);
        return view('includes.course-detail',compact('related_course','courses_data','syllabus','instructors_data','questions','recommendations','users_data','payed_chapters_list'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPackage($id,$package_id)
    {
    	$courses_data = Course::select('*')->where('course_id',$id)->get();
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
    	$courses_id = Package::select('course_id')->where('package_code',$package_id)->get();
    	$coursesIds = explode(",", $courses_id);
    	$courses_new_data = array();
    	$courses_new_data = Course::select('*')->whereIn('course_id',$coursesIds)->get();
    	$questions = question_answer::select('*')->get();
    	return view('includes.package-detail',compact('courses_data','syllabus','instructors_data','courses_new_data','questions'));
    }

    public function recentlyViewed($post_title="Some Post",$image='', $degree='',$university_name='',$id='') {
        // Configuration Variables
        $num_to_store     =    2; // If there are more than this many stored, delete the oldest one
        $minutes_to_store = 1440; // These cookies will automatically be forgotten after this number of minutes. 1440 is 24 hours.

        $current_page["name"]       = $post_title;
        $current_page["url" ]       = \Request::url(); // The current URL
        $current_page["image"]      = $image;
        $current_page["degree"]      = $degree;
        $current_page["university_name"]      = $university_name;
        $current_page["cart_url"]      = url('/').'/cart/0/'.$id;
        //$current_page[""]      = $degree;   
        $recent                  = \Cookie::get(  'recently_viewed_content');
        $recent                  = json_decode($recent, TRUE);
        if ( $recent ) {
                foreach ( $recent as $key=>$val ) {
                    if ( $val["url"] == $current_page["url"])
                    unset( $recent[$key]);
                }
        }
        $recent[ time() ] = $current_page;
        if (sizeof($recent) > $num_to_store) {
                $recent = array_slice($recent, sizeof($recent)-5, sizeof($recent), true);
        }
        \Cookie::queue('recently_viewed_content', json_encode($recent), $minutes_to_store);
    }
    
}
