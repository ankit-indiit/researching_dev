<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Course;
use App\Models\Lectures;
use App\Models\quiz;
use App\Models\quiz_questions;
use App\Models\QuizAnswer;
use App\Models\Instructors;
use App\Models\question_answer;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SimulationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('includes.simulation');
    }
    
    public function show_simulation($cid='',$id=''){
        $courseId = $cid;
        $quizId = $id;
        
        $quiz_data = quiz::where("id",$quizId)->get()->toArray();
        $course_data = Course::where("course_id",$courseId)->get()->toArray();
        $quiz_questions = quiz_questions::where("quiz_id",$quizId)->get()->toArray();
        if(!empty($quiz_questions)){
            $quiz_questions_count = count($quiz_questions);
        }else{
            $quiz_questions_count = '';
        }
        //pr($quiz_data);
        return view('includes.simulation',compact('quiz_data','course_data','quiz_questions','quiz_questions_count'));
    }
    
    
    public function correctAnswerList(Request $request){
        
        $user_id = Auth::user()->id;
        $input = $request->all();
        //pr($request->all());
        $match_user_answers = [];
        foreach($input['questionIdArr'] as $questionkey=>$questionId){
            $ques_answer = quiz_questions::where("id",$questionId)->get();
            $user_answer = QuizAnswer::select("*")->where('user_id',$user_id)->where('question_id',$questionId)->get();
            if(!empty($user_answer) && count($user_answer) == 0){
                array_push($match_user_answers,2);
            }else{
            if($ques_answer[0]['Answer'] == $user_answer[0]['choose_answer_option']){
                array_push($match_user_answers,1);
            }else{
                array_push($match_user_answers,0);
            }
            }
        }
        $result = array_combine($input['questionIdArr'],$match_user_answers);
        /*echo "<pre>";
        print_r($result);
        die;*/
        return response()->json(['data' => $result]);
    }
    
    
    public function chooseAnswer(Request $request){
        $user_id = Auth::user()->id;
        $quiz_answer = new QuizAnswer;
        $question_id = $request->question_id;
        $topic_id = $request->topic_id;
        $choose_option = $request->choose_option;
        $quiz_answer_check = QuizAnswer::select("*")->where('user_id',$user_id)->where('question_id',$question_id)->get();
        $checkAnswer = quiz_questions::where("id",$question_id)->get()->toArray();
        if($checkAnswer[0]['Answer'] == $choose_option){
            $message = 1;
        }else{
            $message = 0;
        }
        if(count($quiz_answer_check) == 0){
            $quiz_answer->user_id = $user_id;
            $quiz_answer->topic_id = $topic_id;
            $quiz_answer->question_id = $question_id;
            $quiz_answer->choose_answer_option = $choose_option;
            $result = $quiz_answer->save();
        }
        /*
        else{
            $result = QuizAnswer::where('user_id',$user_id)->where('question_id',$question_id)->update(['choose_answer_option'=>$choose_option]);
        }*/
        return response()->json(['success' => 1,'message'=>$message]);
    }
    
}
