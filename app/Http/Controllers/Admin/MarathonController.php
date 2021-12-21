<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Marathon;
use App\Models\User;
use App\Models\MarathonOrder;
use App\Models\MarathonQuestion;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class MarathonController extends Controller
{
    public function index()
    {
        $marathons = MarathonOrder::distinct('course_id')->pluck('course_id')->toArray();
        $marathon_courses = Course::whereIn('course_id',$marathons)->get();
        return view('admin.marathons',compact('marathon_courses'));
    }

    public function showMarathon($id)
    {
        $marathons = MarathonOrder::where('course_id',$id)->get();
        return view('admin.marathon',compact('marathons'));
    }

    public function showQuestions()
    {
        $MarathonQuestion = MarathonQuestion::all()->toArray();
        if(!empty($MarathonQuestion)){
            foreach($MarathonQuestion as $key=>$val){
            $courseData = Course::where('course_id',$val['mararthon_id'])->get();
            $MarathonQuestion[$key]['instructors'] = $val['user_id'];
            $userData = User::find($val['user_id']);
            $MarathonQuestion[$key]['course_name'] =  $courseData[0]->course_name;
            $MarathonQuestion[$key]['first_name'] =  $userData['first_name'];
            $MarathonQuestion[$key]['last_name'] =  $userData['last_name'];
            }
        }
        return view('admin.marathonquestions',compact('MarathonQuestion'));
    }
}
