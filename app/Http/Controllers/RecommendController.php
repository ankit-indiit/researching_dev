<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Course;
use App\Models\Instructors;
use App\Models\recommendations;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Notifications\contactsnew;



class RecommendController extends Controller
{

    public function addrecommend(Request $request){

        $recommendations = new recommendations;
        $user_id = Auth::user()->id;

        if($request->hasFile('avatar')) {
            $file = $request->file('avatar') ;
            $destinationPath = public_path().'/assets/users/';
            $filename = $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
             $recommendations->user_image = $filename ;
        }
        if($request->type == 'course'){
            $id = $request->course_id;
            $course_data = Course::select('*')->where('course_id',$id)->get();
            $recommendations->course_id = $id;
            $recommendations->user_id = $user_id;
            $recommendations->type =  $request->type;
            $recommendations->description = $request->recommendation;
            $recommendations->save();
        }elseif($request->type == 'instructor'){
            $id = $request->instructor_id;
            $instructor_data = Instructors::select('*')->where('id',$id)->get();
            foreach ($instructor_data as $value) {
                $instructor_name = $value->first_name;
            }
            $recommendations->instructor_id = $id;
            $recommendations->instructor_name = $instructor_name;
            $recommendations->user_id = $user_id;
            $recommendations->type =  $request->type;
            $recommendations->description = $request->recommend;
            $recommendations->save();
        }
        return response()->json(['success' => true]);
     }

     public function userrecommend($id="",$course_id=""){

        $recommendations = recommendations::select('*')->where('user_id',$id)->where('course_id',$course_id)->where('status','1')->get();
        return view('includes.users-recommendations',compact('recommendations'));
     }

    public function instructor_recommend($id=""){
        $inst_recommend = recommendations::select('*')->where('instructor_id',$id)->get();
        /*echo "<pre>";
        print_r($inst_recommend->toArray());
        echo "</pre>";
        die;*/
        return view('includes.recommendations',compact('inst_recommend'));
    }

}
