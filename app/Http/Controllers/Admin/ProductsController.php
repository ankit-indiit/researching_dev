<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use DB;
use App\Models\admins;
use App\Models\User;
use App\Models\Degrees;
use App\Models\Course;
use App\Models\question_answer;
use App\Models\Lectures;
use App\Models\TopicVideos;
use App\Models\recommendations;
use App\Models\Topics;
use App\Models\Universities;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $is_logged_in = Session::get('admin_logged_in');
        if(!isset($is_logged_in) && $is_logged_in != '1'){
            Auth::logout();
            return redirect()->route('admin.adminLogin');
        }
    }
    
    //function for listing of products page
    public function listing($id ="",$inst_id=""){
        $simple_courses_data = Course::select('*')->where('degree_id',$id)->where('university_id',$inst_id)->limit(25)->get();
        $marathon_courses_data = Course::select('*')->where('degree_id',$id)->where('university_id',$inst_id)->limit(25)->get();
        $degree_id = $id;
        $university_id = $inst_id;
        return view('admin.products',compact('simple_courses_data','marathon_courses_data','degree_id','university_id'));
    }

    //function for delete courses from product page
    public function deleteproduct(Request $request)
    {
      if($request->password != ''){
        $admin_id = session()->get('id');
        $id = $request->deleted_id;
        $check_login = admins::select('*')->where('status',1)->where('id', $admin_id)->first();
         if(!empty($check_login)){
          if (Hash::check($request->password, $check_login->password)) {
            Course::select('*')->where('course_id',$id)->delete();
            $data['status'] = 1;
            $data['msg'] =' נמחק ';
          }else{
            $data['status'] = 0;
            $data['msg'] = ' הסיסמה לא התאימה. ';
          }
         }else{
          $data['status'] = 0;
          $data['msg'] = ' משתמש לא מחובר. ';
         }
      }else{
        $data['status'] = 0;
        $data['msg'] = ' אנא הזן סיסמה. ';
      } 
      return json_encode($data);  
    }

    //function to call view add products
    public function addproduct($id="",$university_id = ""){
        $degree_id = $id;
        $university_id = $university_id;
        return view('admin.addproduct',compact('degree_id','university_id'));
    } 

    //function to save products
    public function saveproduct(Request $request){
        $course = new Course;
        $validator = Validator::make($request->all(),  [
             'add_university' => 'required',
             'add_degree' => 'required',
             'prducttype' => 'required',
             'add_instructor' => 'required',
             'course_name' => 'required',
             'course_url' => 'required',
             'course_description' => 'required',
             'imageName' => 'required'
         ]);
        if ($validator->passes()) {
            
            if(!empty($request->tagline1)){
                $course->tagline1 = $request->tagline1;
            }
            if(!empty($request->tagline2)){
                $course->tagline2 = $request->tagline2;
            }
            if(!empty($request->tagline3)){
                $course->tagline3 = $request->tagline3;
            }
            if(!empty($request->tagline4)){
                $course->tagline4 = $request->tagline4;
            }
            if(!empty($request->tagline5)){
                $course->tagline5 = $request->tagline5;
            }
            $course->course_name = $request->course_name;
            $course->description = $request->course_description;
            $course->degree_id = $request->add_degree;
            $course->university_id = $request->add_university;
            $course->instructor_id = $request->add_instructor;
            $course->video_link = $request->course_url;
            
            if($request->type == 0){//for free and paid course
                $course->type = 0;
                $course->price = 0.0;
            }else{
                $course->type = 1;
                $course->price = $request->price;
            }
            //course_type for diffrentiate online or intensive learning.
            $course->course_type = $request->prducttype;
            $course->image = $request->imageName;
            $course->save();
            Session::flash('message', ' תארים נוספו בהצלחה ');
            return response()->json(['success' => true]);
         }else{
            return response()->json(['error'=>$validator->errors()]);
    }
    }

    //function to call view edit products
    public function editproduct($id="",$degree_id="",$uni_id=""){
        $courseid = $id;
        $degreeid = $degree_id;
        $universityid = $uni_id;
        $courses_data = Course::select('*')->where('course_id',$courseid)->get();
        foreach ($courses_data as $course_data) {
            $course_data = $course_data;
        }
        $lectures = Lectures::select('*')->where('course_id',$courseid)->get();
        $topics = Topics::select('*')->where('course_id',$courseid)->get();
        $questions_data = question_answer::select('*')->where('course_id',$courseid)->get();
        return view('admin.showcourse',compact('courseid','degreeid','universityid','course_data','lectures','topics','questions_data'));
    }
    
    //function to call view edit products
    public function editintensiveproducts($id="",$degree_id="",$uni_id=""){
       $degree_id = $degree_id;
       $university_id = $uni_id;
       $course_id = $id;
       $intensive_course = array();
       $intensive_courses = Course::select('*')->where('course_id',$course_id)->get();
       foreach ($intensive_courses as $value) {
         $intensive_course = $value;
       }
        return view('admin.editintensivecourse',compact('degree_id','course_id','university_id','intensive_course'));
    }

    //function to update edit products
    public function updateproduct(Request $request)
    {
        $course_id = $request->course_id;
        $validator = Validator::make($request->all(),  [
             'edit_university' => 'required',
             'edit_degree' => 'required',
             'edit_prducttype' => 'required',
             'edit_instructor' => 'required',
             'course_name' => 'required',
             'course_url' => 'required',
             'description' => 'required'

         ]);
        if ($validator->passes()) {
            if($request->price == ''){//for free and paid course
                $course_type = 0;
                $course_price = 0.0;
            }else{
                $course_type = 1;
                $course_price = $request->price;
            }
            
            $course_data = array(
                    'course_name' => $request->course_name,
                    'description' => $request->description,
                    'degree_id' => $request->edit_degree,
                    'university_id' => $request->edit_university,
                    'instructor_id' => $request->edit_instructor,
                    'video_link' => $request->course_url,
                    'price' => $course_price,
                    'type' => $course_type,
                    'course_type' => $request->edit_prducttype,
                    'image' => $request->imageName,
                    'tagline1' => $request->tagline1,
                    'tagline2' => $request->tagline2,
                    'tagline3' => $request->tagline3,
                    'tagline4' => $request->tagline4,
                    'tagline5' => $request->tagline5,
                );
            $insert = DB::table('courses')->where('course_id',$course_id)->update($course_data);
            Session::flash('message', ' תארים נוספו בהצלחה ');
            return response()->json(['success' => true]);
         }else{
            return response()->json(['error'=>$validator->errors()]);
        }
    }

    //function to update edit products
    public function updateintensiveproduct(Request $request)
    {
        $course_id = $request->intensive_course_id;
        $validator = Validator::make($request->all(),  [
             'edit_instructor' => 'required',
             'edit_course_name' => 'required',
             'edit_course_url' => 'required',
             'course_date' => 'required',
             'course_start_time'  => 'required',
             'course_end_time'  => 'required',
             'edit_course_topics'  => 'required',
             'zoom_url'  => 'required',
             'edit_price' => 'required' 
         ]);

        if ($validator->passes()) {
           $topics = implode(',',$request->edit_course_topics);
            $course_data = array(
              'course_name' => $request->edit_course_name,
              'instructor_id' => $request->edit_instructor,
              'video_link' => $request->edit_course_url,
              'start_date' => $request->course_date,
              'start_time' => $request->course_start_time,
              'end_time' => $request->course_end_time,
              'zoom_link' => $request->zoom_url,
              'marathon_price' => $request->edit_price,
              'topics' => $topics
            );
            $insert = DB::table('courses')->where('course_id',$course_id)->update($course_data);

            Session::flash('message', ' תארים נוספו בהצלחה ');
            return response()->json(['success' => true]);
         }else{
            return response()->json(['error'=>$validator->errors()]);
    }  
    }

    //function to add lectures for particular selected course in db
    public function savelectures(Request $request){
        $Lectures = new Lectures;
        $validator = Validator::make($request->all(),  [
             'get_title' => 'required',
             'get_duration' => 'required',
             'get_price' => 'required',

        ]);
        if ($validator->passes()) {
            $Lectures->title = $request->get_title;
            $Lectures->price = $request->get_price;
            $Lectures->duration = $request->get_duration;
            $Lectures->course_id = $request->course_id;
            $Lectures->save();
            Session::flash('message', ' תארים נוספו בהצלחה ');
            return response()->json(['success' => true]);
         }else{
            return response()->json(['error'=>$validator->errors()]);
    }
    }

    //function to save edit lectures in db
    public function edit_lecture(Request $request){
        $id = $request->edit_lecture_id;
        $validator = Validator::make($request->all(),  [
             'edit_title' => 'required',
             'edit_duration' => 'required',
             'edit_price' => 'required',

        ]);
        if ($validator->passes()) {
            $lecture_data = array(
                    'title' => $request->edit_title,
                    'duration' => $request->edit_duration,
                    'price' => $request->edit_price
                );
                $insert = DB::table('lectures')->where('id',$id)->update($lecture_data);
            Session::flash('message', ' תארים נוספו בהצלחה ');
            return response()->json(['success' => true]);
         }else{
            return response()->json(['error'=>$validator->errors()]);
    }
    }
    
    //function to get data in edit form for update
    public function get_lecture_data(Request $request){
        $courseid = $request->course_id;
        $lecture_id = $request->lecture_id;
        $edit_lecture_data = Lectures::select('*')->where('id',$lecture_id)->where('course_id',$courseid)->get();
        foreach ($edit_lecture_data as $value) {
            $lecture_data = $value;
        }
        $data['status'] = '1';
        $data['data'] = $lecture_data;
        return json_encode($data);
    }

    //function to delete lectures from listing
    public function deletelecture(Request $request)
    {
        $id = $request->deleted_id;
        $lecture = Lectures::findOrFail($id);
        $lecture->delete();
        $data['status'] = 1;
        $data['msg'] ='deleted'; 
        return json_encode($data);  
    }

    //function to save topics in db
    public function savetopic(Request $request){
        
        $topics = new Topics;
        $topicVideos = new TopicVideos;
        $validator = Validator::make($request->all(),  [
             'topic_title' => 'required',
             'topic_duration' => 'required'

        ]);
        if ($validator->passes()) {
            
            $topics->topic_name = $request->topic_title;
            $topics->topic_duration = $request->topic_duration;
            $topics->lecture_id = $request->topic_lecture_id;
            $topics->course_id = $request->topic_course_id;
            $topics->save();
            $topic_id = $topics->id;
            if(!empty($request->topic_video_url) && count($request->topic_video_url) > 0){
                
                for($i=0;$i<count($request->topic_video_url);$i++){
                    $topic_video_data = ['topic_video_url'=>$request->topic_video_url[$i],'topic_video_title'=>$request->topic_video_title[$i],'topic_id'=>$topic_id];
                    TopicVideos::create($topic_video_data);
                }
                /*$topicVideos->topic_id = $topic_id;
                $topicVideos->topic_video_url = $request->topic_video_url;
                $topicVideos->save();*/
            }
            Session::flash('message', ' תארים נוספו בהצלחה ');
            return response()->json(['success' => true]);
         }else{
            return response()->json(['error'=>$validator->errors()]);
    }
    }

    //function to update edited topic in db
    public function edit_topic(Request $request){
       /* echo "<pre>";
        print_r($request->all());
        die;*/
        $id = $request->topic_id;
        $lecture_id = $request->topic_lecture_id1;
        $course_id = $request->topic_course_id1;
        $validator = Validator::make($request->all(),  [
             'edit_topic_title' => 'required',
             'edit_topic_duration' => 'required'

        ]);
        if ($validator->passes()) {
            $topic_data = array(
                    'topic_name' => $request->edit_topic_title,
                    'topic_duration' => $request->edit_topic_duration
            );
            $insert = DB::table('topics')->where('id',$id)->where('lecture_id',$lecture_id)->where('course_id',$course_id)->update($topic_data);
            
            if(isset($request->topic_video_title) && !empty($request->topic_video_title) && $request->topic_video_title[0] !=''){
                    TopicVideos::where('topic_id',$id)->delete();
                for($i=0;$i<count($request->topic_video_title);$i++){
                    $topic_video_data = ['topic_video_url'=>$request->topic_video_url[$i],'topic_video_title'=>$request->topic_video_title[$i],'topic_id'=>$id];
                    TopicVideos::create($topic_video_data);
                }
            }else{
                TopicVideos::where('topic_id',$id)->delete();
            }
            Session::flash('message', ' תארים נוספו בהצלחה ');
            return response()->json(['success' => true]);
         }else{
            return response()->json(['error'=>$validator->errors()]);
    }
    }

    
    public function get_topic_data(Request $request){
        $id = $request->id;
        $courseid = $request->course_id;
        $lecture_id = $request->lecture_id;
        $edit_topic_data = Topics::select('*')->where('id',$id)->where('course_id',$courseid)->where('lecture_id',$lecture_id)->get();
        foreach ($edit_topic_data as $key=>$value) {
            $topic_data = $value;
            $topicvideodata = TopicVideos::select('*')->where('topic_id',$value['id'])->get()->toArray();
            if(!empty($topicvideodata)){
                $html = '';
                foreach($topicvideodata as $k=>$v){
                    $html .="<div class='topic_video_url_main'><div class='form-group mb-3'>
                                <label> כותרת סרטון </label>
                                <input id='topic_video_title' value=".$v['topic_video_title']." name='topic_video_title[]' type='text'  class='form-control' placeholder='כותרת סרטון'>
                                <span class='text-danger error-text topic_video_title_err'></span>
                            </div>
                            <div class='form-group mb-3'>
                                <label>כתובת אתר וידאו</label>
                                <input id='topic_video_url' value=".$v['topic_video_url']." name='topic_video_url[]' type='text'  class='form-control' placeholder='כתובת אתר וידאו'>
                                <span class='text-danger error-text topic_video_url_err'></span>
                            </div>
                            <span class='btn btn-primary remove_topic_div' data-id=".$v['topic_video_url']." style='margin-bottom: 10px;'>×</span>
                            </div>
                            </div>";
                }
                $edit_topic_data[$key]['topic_videos_data'] = $html;
                }else{
                $edit_topic_data[$key]['topic_videos_data'] = 
                            "<div class='topic_video_url_main'><div class='form-group mb-3'>
                                <label> כותרת סרטון </label>
                                <input id='topic_video_title' name='topic_video_title[]' type='text'  class='form-control' placeholder='כותרת סרטון'>
                                <span class='text-danger error-text topic_video_title_err'></span>
                            </div>
                            <div class='form-group mb-3'>
                                <label>כתובת אתר וידאו</label>
                                <input id='topic_video_url' name='topic_video_url[]' type='text'  class='form-control' placeholder='כתובת אתר וידאו'>
                                <span class='text-danger error-text topic_video_url_err'></span>
                            </div>
                                <span class='btn btn-primary remove_topic_div' data-id='0' style='margin-top: 10px;'>×</span>
                            </div>";
                }
        }
        $data['status'] = '1';
        $data['data'] = $topic_data;
        return json_encode($data);
    }

    public function deletetopic(Request $request)
    {
        $id = $request->deleted_id;
        $topic = Topics::findOrFail($id);
        $topic->delete();
        $data['status'] = 1;
        $data['msg'] ='deleted'; 
        return json_encode($data);  
    }

    public function savecourseqstn(Request $request){
        
        
        $courseid = $request->course_id;
        
        $q_a = new question_answer;
        $validator = Validator::make($request->all(),  [
             'add_answer' => 'required',
             'add_qustn' => 'required',
             'lecture_id' => 'required',
             
        ]);
        if ($validator->passes()) {
            $q_a->questions = $request->add_qustn;
            $q_a->answers = $request->add_answer;
            $q_a->lecture_id = $request->lecture_id;
            $q_a->course_id = $courseid;
            $q_a->save();
            Session::flash('message', ' תארים נוספו בהצלחה ');
            return response()->json(['success' => true]);
         }else{
            return response()->json(['error'=>$validator->errors()]);
    }
    }

    public function get_qa_data(Request $request){
        $id = $request->id;
        $courseid = $request->course_id;
        $edit_qa_data = question_answer::select('*')->where('id',$id)->where('course_id',$courseid)->get();
        foreach ($edit_qa_data as $value) {
            $qa_data = $value;
        }
        $data['status'] = '1';
        $data['data'] = $qa_data;
        return json_encode($data);
    }

    public function edit_qa(Request $request){
        $id = $request->qa_id;
        $course_id = $request->qa_course_id;

        $validator = Validator::make($request->all(),  [
             'edit_qustn' => 'required',
             'edit_answer' => 'required'

        ]);
        if ($validator->passes()) {
            $qa_data = array(
                    'questions' => $request->edit_qustn,
                    'answers' => $request->edit_answer
            );
            $insert = DB::table('question_answers')->where('id',$id)->where('course_id',$course_id)->update($qa_data);
            Session::flash('message', ' תארים נוספו בהצלחה ');
            return response()->json(['success' => true]);
         }else{
            return response()->json(['error'=>$validator->errors()]);
    }
    }

    public function deleteqa(Request $request)
    {
        $id = $request->deleted_id;
        $Q_A = question_answer::findOrFail($id);
        $Q_A->delete();
        $data['status'] = 1;
        $data['msg'] ='deleted'; 
        return json_encode($data);  
    }

    public function course_Uploadfiles(Request $request)
    {

        $file = $request->file('file');
        if(!empty($file)){
           //Move Uploaded File
           $destinationPath = public_path().'/assets/images/';
           $original_name = $file->getClientOriginalName();
           $file_name = str_replace(' ','_',time().$file->getClientOriginalName());
            $thumb_img = Image::make($file->getRealPath())->resize(null,300,function ($constraint) {
           $constraint->aspectRatio();
         });
           if($thumb_img->save($destinationPath.'/'.$file_name,100)){
               $image_name = $file_name;
               $data['status'] = 1;
               $data['image_name'] = $image_name;
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