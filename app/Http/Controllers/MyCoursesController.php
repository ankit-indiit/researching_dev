<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Course;
use App\Models\orders;
use App\Models\Package;
use App\Models\Lectures;
use App\Models\question_answer;
use App\Models\Topics;
use App\Models\TopicVideos;
use App\Models\quiz;
use App\Models\quiz_questions;
use Illuminate\Support\Facades\DB;
use App\Models\reviews;
use App\Models\Instructors;
use App\Models\MarathonOrder;
use PDF;
use App\Models\coursematerial;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MyCoursesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $reviews_data = array();
        $total_lectures = array();
        $courses_data = array();
        $orders_data = orders::select('*')->where('user_id',$user_id)->get();
        $marathon_data = MarathonOrder::where('user_id',$user_id)->where('is_paid',1)->get();
        $size = count($orders_data);
        if($size != 0){
            foreach ($orders_data as $key => $order_data) {
            $coursesIds = explode(",", $order_data->ordered_courses);
            $courses_data[$key] = Course::select('*')->whereIn('course_id',$coursesIds)->get();
            foreach ($coursesIds as  $value) {
            $lectures = Lectures::select('id')->where('course_id',$value)->get();
            if(count(reviews::select('*')->where('course_id',$value)->pluck('rating')) > 0)
            {
               $reviews_data[$key] = reviews::select('*')->where('course_id',$value)->pluck('rating');
            }else
            {
                $reviews_data[$key] = [];
            } 
          
            $total_lectures[$key] = count($lectures);
            }
        }
        }
        $courses_data = $this->paginate($courses_data);
        $marathon_data = $this->paginate($marathon_data);
    	return view('includes.my-courses',compact('courses_data','total_lectures','reviews_data','marathon_data'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showMyCourse($id)
    {
        $course_id = $id;
        $user_id = Auth::user()->id;
        $comment_area_show = 1;
        $already_added_review_id = reviews::select('*')->where('course_id',$id)->where('user_id',$user_id)->pluck('id');
        if(count($already_added_review_id) != 0){
            $comment_area_show = 0;
        }
        $instructor_data = Instructors::select('*')->where('instructor_course_id',$id)->get();
        $coursematerialdata =  coursematerial::select('*')->where('course_id',$id)->get();
        $courses_data = Course::select('*')->where('course_id',$id)->get();
        $topics = Topics::where('course_id',$course_id)->get()->toArray();
        
        if(!empty($topics)){
            $quizCount = [];
            foreach($topics as $key =>$topic){
                $topics[$key]['quizTopics'] = quiz::where('topicId',$topic['id'])->get()->toArray();
                array_push($quizCount,count($topics[$key]['quizTopics']));
                $topics[$key]['topic_video_data'] = TopicVideos::select('id','topic_video_title','topic_video_url')->where('topic_id',$topic['id'])->get()->toArray();
                $quiz_quest_count = quiz_questions::where('topic_id',$topic['id'])->get()->toArray();
                if(!empty($quiz_quest_count) && count($quiz_quest_count)>0){
                    $topics[$key]['quiz_quest_count'] = count($quiz_quest_count);
                }else{
                    $topics[$key]['quiz_quest_count'] = 0;
                }
            }
        }
        if(!empty($quizCount)){
           // pr($quizCount);
            $quizCount = array_sum($quizCount);
            
        }
        /*echo "<pre>";
        print_r(array_sum($quizCount));
        die;*/
        return view('includes.my-courses-detail',compact('id','comment_area_show','coursematerialdata','instructor_data','user_id','courses_data','topics'));
    }

    //function to add ratings and comments for courses.
    public function addratings(Request $request){

        $reviews = new reviews;
        $reviews->course_id = $request->mycourseid;
        $reviews->comment = $request->comments;
        $reviews->rating = $request->rating;
        $reviews->user_id = Auth::user()->id;
        $reviews->save();
        return redirect()->back();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
    
    public function download(Request $request)
    {
        $id = $request->id;
        $reports =  coursematerial::select('*')->where('id',$id)->get();
        foreach($reports as $report){
            $path = storage_path().'/'.'app'.'/public/uploads/'.$report->name;
        }
        $pdf = PDF::loadView('pdf.pdf');
        $headers = array(
              'Content-Type: application/pdf',
            );
         return response()->download($path, 'filename.pdf', $headers);


        $path = public_path('pdf/');
        $fileName =  time().'.'. 'pdf' ;
        $pdf->save($path . '/' . $fileName);

        $pdf = public_path('pdf/'.$fileName);
        return response()->download($pdf);
    }
}
