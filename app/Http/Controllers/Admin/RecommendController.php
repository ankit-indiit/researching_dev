<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use DB;
use App\Models\admins;
use App\Models\Course;
use App\Models\User;
use App\Models\Instructors;
use App\Models\recommendations;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class RecommendController extends Controller
{   
    
    public function recommendation(){

        $course_recommendations = array();
        $instructor_recommendations = array();
        $website_recommendations = array();
        $course_recommendations = recommendations::select('*')->where('type','course')->get();
        $instructor_recommendations = recommendations::select('*')->where('type','instructor')->get();
        $website_recommendations = recommendations::select('*')->where('type','website')->get();
        $online_recommendation = recommendations::select('*')->where('type','online_recommendation')->get();
        return view('admin.recommendation',compact('course_recommendations','instructor_recommendations','website_recommendations','online_recommendation'));
    }
    
    public function viewrecommendation($id=""){

        $user_name = '';
        $user_image = '';
        $course_id = '';
        $course_name = '';
        $instructor_name = '';
        $university_name = '';
        $degree_name = '';
        $instructor_id = '';
        $comment_type = '';
        $description = '';
        $id = $id;
        $view_data = recommendations::select('*')->where('id',$id)->get();
        foreach ($view_data as $value) {
            $user_id = $value->user_id;
            $user_data = User::select('*')->where('id',$user_id)->get();
            foreach ($user_data as $data) {
                $user_name = $data->first_name . $data->last_name;
                $user_image = $data->avatar;
            }
            $comment_type = $value->type;
            if($comment_type == 'course'){
                $course_id = $value->course_id;
                
                $course_data = Course::select('*')->where('course_id',$course_id)->get();
                foreach ($course_data as $course) {
                    $course_name = $course->course_name;
                    $university_id = $course->university_id;
                    $degree_id = $course->degree_id;
                    $degree = DB::table('degrees')->where('id',$degree_id)->pluck('degree_name');
                    if(isset($degree[0])){
                        $degree_name = $degree[0];
                    }else{
                         $degree_name = '';
                    }
                    $university = DB::table('universities')->where('id',$university_id)->pluck('university_name');

                    if(isset($university[0])){
                        $university_name = $university[0];
                    }else{
                        $university_name = '';
                    }
                    
                }
            }else if($comment_type == 'instructor'){
                $instructor_id = $value->instructor_id;
                
                $instructor_data = Instructors::select('*')->where('id',$instructor_id)->get();
                foreach ($instructor_data as $instructor) {
                    $instructor_name = $instructor->first_name . $instructor->last_name;
                    $university_id = $instructor->university;
                    $degree_id = $instructor->degree;
                    $degree = DB::table('degrees')->where('id',$degree_id)->pluck('degree_name');
                    if(isset($degree[0])){
                        $degree_name = $degree[0];
                    }else{
                         $degree_name = '';
                    }
                    $university = DB::table('universities')->where('id',$university_id)->pluck('university_name');

                    if(isset($university[0])){
                        $university_name = $university[0];
                    }else{
                        $university_name = '';
                    }
                }

            }else{
                $course_id = '';
                $instructor_id = '';
                $degree_name = '';
                $university_name = '';
                $course_name = '';
                $instructor_name = '';
            }
            $description = $value->description;

        }
    
        return view('admin.viewrecommendation',compact('user_image','user_name','comment_type','description','instructor_id','course_id','degree_name','university_name','course_name','instructor_name','id'));
    }
    
    public function editrecommendation ($id){
        
        $recommendation_data = recommendations::select('*')->where('id',$id)->get();
        /*echo "<pre>";
        print_r($recommendation_data->toArray());
        die;*/
        return view('admin.editrecommendation',compact('recommendation_data'));
    }
    
    public function delete_onlie_recommed(Request $request){
        $res = recommendations::where('id',$request->id)->delete();
        if($res){
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0]);
        }
    }
    public function upd_online_recommend(Request $request){
        
        $recommendation = recommendations::findOrFail($request->recommend_id);
        $data=[];
        if($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $destinationPath = public_path().'/assets/users/';
            $original_name = $file->getClientOriginalName();
            $filename = str_replace(' ', '_', time().$original_name);
            $file->move($destinationPath, $filename);
            $data['user_image'] = $filename;
        }
        $data['recommed_tag_line'] = $request->recommed_tag_line; 
        $data['user_id'] = $request->user_select;
        $data['description'] = $request->recommed_desc;
        $res = recommendations::where('id',$request->recommend_id)->update($data);
        if($res){
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
    }
    
    public function addrecommendation(){
        return view('admin.addrecommendation');
    }

    public function updatecommentstatus(Request $request){
        $id = $request->comment_id;
        $comments = recommendations::findOrFail($id);
        $data['status'] = 0;
        if($request->status != ''){
            $comments->is_approved = $request->status;
            $comments->save();
            $data['status'] = 1;
        }
        return response()->json(['success' => true,'data' => $data]);
    }

    public function updateshowhide(Request $request){
        $id = $request->comment_id;
        $comments = recommendations::findOrFail($id);
        $data['status'] = 0;
        if($request->status != ''){
            $comments->status = $request->status;
            $comments->save();
            $data['status'] = 1;
        }
        return response()->json(['success' => true,'data' => $data]);
    }

    public function updateshowposted(Request $request){
        $id = $request->comment_id;
        $comments = recommendations::findOrFail($id);
        $data['status'] = 0;
        if($request->status != ''){
            $comments->is_posted = $request->status;
            $comments->save();
            $data['status'] = 1;
        }
        return response()->json(['success' => true,'data' => $data]);
    }

    public function saverecommend(Request $request){
        $recommendations = new recommendations;
        $user_id = $request->user_select;
        
        $validator = Validator::make($request->all(),  [
             'user_select' => 'required',
             'recommendation_type' => 'required',
             'avatar' => 'required',
             'recommed_desc' => 'required',
         ]);
        if ($validator->passes()) {
             
        if($request->hasFile('avatar')) {
            $file = $request->file('avatar') ;
            $destinationPath = public_path().'/assets/users/';
            $filename = $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
             $recommendations->user_image = $filename;
        }
        
        if(isset($request->course_user_social_link) && $request->course_user_social_link != ''){
                $recommendations->course_user_social_link = $request->course_user_social_link;
        }
        
        if($request->recommendation_type == 'course'){
            $id = $request->course_selected;
            $course_data = Course::select('*')->where('course_id',$id)->get();
            $recommendations->course_id = $id;
            $recommendations->user_id = $user_id;
            $recommendations->type =  $request->recommendation_type;
            $recommendations->description = $request->recommed_desc;
            $recommendations->save();
        }elseif($request->recommendation_type == 'instructor'){
            $id = $request->instructor_selected;
            $instructor_data = Instructors::select('*')->where('id',$id)->get();
            foreach ($instructor_data as $value) {
                $instructor_name = $value->first_name;
        }
        $recommendations->instructor_id = $id;
        $recommendations->instructor_name = $instructor_name;
        $recommendations->user_id = $user_id;
        $recommendations->type =  $request->recommendation_type;
        $recommendations->description = $request->recommed_desc;
        $recommendations->save();
        }
        else{
        $recommendations->user_id = $user_id;
        $recommendations->type =  $request->recommendation_type;
        $recommendations->description = $request->recommed_desc;
            if(!empty($request->recommed_tag_line)){
                $recommendations->recommed_tag_line = $request->recommed_tag_line;
            }
        $recommendations->save();
        }
        return response()->json(['success' => true]);
    }else{
        return response()->json(['error'=>$validator->errors()]);
    }
    }

    public function updaterecommend(Request $request){
        $id = $request->comment_id;
        $comments = recommendations::findOrFail($id);
        $validator = Validator::make($request->all(),  [
            'recommed_desc' => 'required'
         ]);
        if ($validator->passes()) {
        
        if($request->recommendation_type == 'course'){
            $id = $request->course_selected;
            $comments->course_id = $id;
            $comments->type =  $request->recommendation_type;
            $comments->description = $request->recommed_desc;
            $comments->instructor_id = Null;
            $comments->instructor_name = Null;
            $comments->save();
        }elseif($request->recommendation_type == 'instructor'){
            $id = $request->instructor_selected;
            $instructor_data = Instructors::select('*')->where('id',$id)->get();
            foreach ($instructor_data as $value) {
                $instructor_name = $value->first_name;
        }
        $comments->instructor_id = $id;
        $comments->course_id = Null;
        $comments->instructor_name = $instructor_name;
        $comments->type =  $request->recommendation_type;
        $comments->description = $request->recommed_desc;
        $comments->save();
        }else{
        $comments->instructor_id = Null;
        $comments->instructor_name = Null;
        $comments->course_id = Null;
        $comments->type =  $request->recommendation_type;
        $comments->description = $request->recommed_desc;
        $comments->save();
        }
        return response()->json(['success' => true]);
    }else{
        return response()->json(['error'=>$validator->errors()]);
    }
    }
}
