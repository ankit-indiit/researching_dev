<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use DB;
use App\Models\admins;
use App\Models\User;
use App\Models\orders;
use App\Models\Degrees;
use App\Models\quiz;
use App\Models\quiz_questions;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;


class QuizController extends Controller
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
    
    public function quizlisting($topic_id="",$lecture_id="",$course_id=""){
        $current_topic = $topic_id;
        $current_lecture = $lecture_id;
        $current_course = $course_id;
        $quiz_data = session()->get('quiz_data');
        $quiz_data = [
                    "topic_id" => $topic_id,
                    "lecture_id" => $lecture_id,
                    "course_id" => $course_id
                ];
        session()->put('quiz_data', $quiz_data); 
        $quizs = quiz::select('*')->where('topicId',$current_topic)->where('lectureId',$current_lecture)->where('courseId',$current_course)->get();
        return view('admin.quiz',compact('quizs'));
    }

    public function addquiz(){
        return view('admin.addquiz');
    }

    public function savequiz(Request $request){
        $quiz = new quiz;
        $validator = Validator::make($request->all(),  [
             'quiz_title' => 'required',
             'quiz_description' => 'required',
        ]);
        if ($validator->passes()) {
        $quiz->quizTopic = $request->quiz_title;
        $quiz->quizdescription = $request->quiz_description;
        $quiz->topicId = $request->topic_id;
        $quiz->lectureId = $request->lecture_id;
        $quiz->courseId = $request->course_id;
        $quiz->perQuestionMarks = $request->quiz_marks;
        $quiz->days = $request->quiz_days;
        $quiz->quiz_attempt = $request->reattempt;
        $quiz->save();
        Session::flash('message', ' המשתמש נוסף בהצלחה. ');
        return response()->json(['success' => true]);
         }else{
        return response()->json(['error'=>$validator->errors()]);
    }
}

    public function editquiz($id=""){
        $quiz = quiz::select('*')->where('id',$id)->get();
        $quiz_value = array();
        foreach ($quiz as $value) {
            $quiz_value = $value;
        }
        return view('admin.editquiz',compact('quiz_value'));
    }

    //function to update user profile.
    public function updatequiz(Request $request)
    {
        $id = $request->quiz_id;
        $quiz = quiz::findOrFail($id);
        $validator = Validator::make($request->all(),  [
             'quiz_title' => 'required',
             'quiz_description' => 'required',
        ]);
       
        if ($validator->passes()) {
        $quiz->quizTopic = $request->quiz_title;
        $quiz->quizdescription = $request->quiz_description;
        $quiz->topicId = $request->topic_id;
        $quiz->lectureId = $request->lecture_id;
        $quiz->courseId = $request->course_id;
        $quiz->perQuestionMarks = $request->quiz_marks;
        $quiz->days = $request->quiz_days;
        $quiz->quiz_attempt = $request->reattempt;
        $quiz->save();
        Session::flash('message', ' עריכת המשתמש בהצלחה  ');
        return response()->json(['success' => true]);
         }else{
        return response()->json(['error'=>$validator->errors()]);
    }
        
    }

    public function deletequiz(Request $request)
    {
            $id = $request->deleted_id;
            $quiz = quiz::findOrFail($id);
            $quiz->delete();
            $data['status'] = 1;
            $data['msg'] ='deleted'; 
            return json_encode($data);  
    }

    public function addquizquestions($id=""){
        $quiz_id = $id;
        $questions = quiz_questions::select('*')->where('quiz_id',$quiz_id)->get();
        return view('admin.addquizquestions',compact('quiz_id','questions'));
    }

    public function addquizoptions($id=""){
        $quizid = $id;
        return view('admin.addquizoptions',compact('quizid'));
    }

    public function savequizquestions(Request $request){
        $quiz_questions = new quiz_questions;
        $validator = Validator::make($request->all(),  [
             'questiontype' => 'required',
             'questionarea' => 'required',
             'ans_option' => 'required'
        ]);
        if ($validator->passes()) {
            if($request->hasfile('option'))
            {
                foreach($request->file('option') as $file)
                {
                    $destinationPath = public_path().'/assets/images/';
                    $original_name = $file->getClientOriginalName();
                    $file_name = str_replace(' ','_',time().$file->getClientOriginalName());
                    $thumb_img = Image::make($file->getRealPath())->resize(null,50,function ($constraint) {
                    $constraint->aspectRatio();
                });
                if($thumb_img->save($destinationPath.'/'.$file_name,100)){
                    $image_name[] = $file_name;
               }
            }
        }
        if($request->questiontype == '0'){
            $quiz_questions->optionA = $request->option_a;
            $quiz_questions->optionB = $request->option_b;
            $quiz_questions->optionC = $request->option_c;
            $quiz_questions->optionD = $request->option_d;
        }else{
            $quiz_questions->optionA = $image_name[0];
            $quiz_questions->optionB = $image_name[1];
            $quiz_questions->optionC = $image_name[2];
            $quiz_questions->optionD = $image_name[3];
        }
        $quiz_questions->topic_id = $request->topic_id;
        $quiz_questions->quiz_id = $request->quiz_id;
        $quiz_questions->question = $request->questionarea;
        $quiz_questions->Answer = $request->ans_option;
        $quiz_questions->questionImage = $request->quest_image;
        $quiz_questions->questionLink = $request->quest_video;
        $quiz_questions->questionType = $request->questiontype;
        $quiz_questions->save();
        Session::flash('message', ' המשתמש נוסף בהצלחה. ');
        return response()->json(['success' => true]);
         }else{
        return response()->json(['error'=>$validator->errors()]);
    }
}

    public function updatequizquestions(Request $request){
        $id = $request->edit_quiz_id;
        $quiz_questions = quiz_questions::findOrFail($id);
        $validator = Validator::make($request->all(),  [
             'questiontype' => 'required',
             'questionarea' => 'required',
             'ans_option' => 'required'
        ]);
        if ($validator->passes()) {
            if($request->hasfile('option'))
            {
                foreach($request->file('option') as $file)
                {
                    $destinationPath = public_path().'/assets/images/';
                    $original_name = $file->getClientOriginalName();
                    $file_name = str_replace(' ','_',time().$file->getClientOriginalName());
                    $thumb_img = Image::make($file->getRealPath())->resize(null,50,function ($constraint) {
                    $constraint->aspectRatio();
                });
                if($thumb_img->save($destinationPath.'/'.$file_name,100)){
                    $image_name[] = $file_name;
               }
            }
        }
        if($request->questiontype == '0'){
            $quiz_questions->optionA = $request->option_a;
            $quiz_questions->optionB = $request->option_b;
            $quiz_questions->optionC = $request->option_c;
            $quiz_questions->optionD = $request->option_d;
        }else{
            $quiz_questions->optionA = $image_name[0];
            $quiz_questions->optionB = $image_name[1];
            $quiz_questions->optionC = $image_name[2];
            $quiz_questions->optionD = $image_name[3];
        }
        $quiz_questions->topic_id = $request->topic_id;
        $quiz_questions->quiz_id = $request->quiz_id;
        $quiz_questions->question = $request->questionarea;
        $quiz_questions->Answer = $request->ans_option;
        $quiz_questions->questionImage = $request->quest_image;
        $quiz_questions->questionLink = $request->quest_video;
        $quiz_questions->questionType = $request->questiontype;
        $quiz_questions->save();
        Session::flash('message', ' המשתמש נוסף בהצלחה. ');
        return response()->json(['success' => true]);
         }else{
        return response()->json(['error'=>$validator->errors()]);
    }
}
    
    public function deletequizquestion(Request $request)
    {
            $id = $request->deleted_id;
            $quiz = quiz_questions::findOrFail($id);
            $quiz->delete();
            $data['status'] = 1;
            $data['msg'] ='deleted'; 
            return json_encode($data);  
    }
    
    public function editquizoptions($id=""){
        $questions_data = quiz_questions::select('*')->where('id',$id)->get();
        foreach ($questions_data as $key => $value) {
            $question_data = $value;
        }
        return view('admin.editquizoptions',compact('question_data'));
    }

    public function showsales(){
        return view('admin.sales');
    }

    public function showhistorycategory(){
        return view('admin.payment-history-category');
    }


    
}
