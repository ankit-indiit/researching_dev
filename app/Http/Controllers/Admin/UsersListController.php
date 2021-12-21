<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use DB;
use App\Models\admins;
use App\Models\User;
use App\Models\Course;
use App\Models\Instructors;
use App\Models\recommendations;
use App\Models\Package;
use App\Models\orders;
use App\Models\chatbox;
use App\Models\Degrees;
use App\Models\userlogs;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class UsersListController extends Controller
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
    
    public function listing(){
        $users_data = User::select('*')->get();
        foreach ($users_data as $key => $value) {
            $id = $value->id;
            $paid_users[] = orders::select('*')->where('user_id',$id)->get();
        }
        foreach ($paid_users as $paid_user) {
            $count = count($paid_user);
            if($count != 0){
                foreach ($paid_user as $user) {
                 $paid_users_id[] = $user->user_id;   
                }
            }
        }
        $paid_users_data = User::select('*')->whereIn('id',$paid_users_id)->get();
        $free_users_data = User::select('*')->whereNotIn('id',$paid_users_id)->get();
        return view('admin.users',compact('users_data','paid_users_data','free_users_data'));
    }


    public function adduser(){
        return view('admin.adduser');
    } 

    public function updatestatus(Request $request){
        $id = $request->user_id;
        $user = User::findOrFail($id);
        $data['status'] = 0;
        if($request->status != ''){
            $user->status = $request->status;
            $user->save();
            $data['status'] = 1;
        }
        return response()->json(['success' => true,'data' => $data]);
    }

    public function saveuser(Request $request){
        $user = new user;
        $validator = Validator::make($request->all(),  [
             'adduser_fname' => 'required',
             'adduser_lname' => 'required',
             'adduser_email' => 'required|email',
             'adduser_phoneno' => 'required',
             'adduser_university' => 'required',
             'adduser_degree' => 'required',
             'adduser_newpass' => 'required|min:8',
             'adduser_confirmpass' => 'required|same:adduser_newpass',

         ]);
       
         if ($validator->passes()) {
            if($request->hasFile('user-img')) {
            $file = $request->file('user-img') ;
            $destinationPath = public_path().'/assets/users/';
            $filename = $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
            
            $user->avatar = $filename ;
        }
        $user->first_name = $request->adduser_fname;
        $user->last_name = $request->adduser_lname;
        $user->email = $request->adduser_email;
        $user->academic_institution = $request->adduser_university;
        $user->student_degree = $request->adduser_degree;
        $user->contact_number = $request->adduser_phoneno;
        $user->password = Hash::make($request->adduser_newpass);
        $user->facebook_url = $request->facebookurl;
        $user->twitter_url = $request->twitterurl;
        $user->linkedin_url = $request->linkedinurl;
        $user->youtube_url = $request->youtubeurl;
        $user->save();
        Session::flash('message', ' המשתמש נוסף בהצלחה. ');
        return response()->json(['success' => true]);
         }else{
        return response()->json(['error'=>$validator->errors()]);
    }
    }

    public function edituser($id=""){
        $user_id = $id;
        $user_data = array();
        $courses_ids = array();
        $packages_ids = array();
        $current_ids = array();
        $degrees_id = '';
        $degree_id = '';
        $degrees_name = array();
        $degree_name = array();
        $users_data = User::select('*')->where('id',$user_id)->get();
        $enrolled_courses = orders::select('*')->where('user_id',$user_id)->where('course_type','0')->get();
        $enrolled_packages = orders::select('*')->where('user_id',$user_id)->where('course_type','1')->get();
        if(!empty($enrolled_courses)){
            foreach ($enrolled_courses as $key => $enrolled_course) {
                $courses_ids[] = $enrolled_course->ordered_courses;
            }
            $courses_list = Course::select('*')->whereIn('course_id',$courses_ids)->get();
        }
        // if(!empty($enrolled_packages)){
        //     foreach ($enrolled_packages as $key => $enrolled_package) {
        //         $packages_ids[] = $enrolled_package->ordered_courses;
        //     }
        //     $packages_list = Package::select('*')->whereIn('package_code',$packages_ids)->get();
        // }
        foreach ($users_data as $value) {
            $user_data = $value;
            $degrees_id = $user_data->student_degree;
        }
        if(!empty($degrees_id)){
            $degree_id = $degrees_id[0];
            $degrees_name = Degrees::select('*')->where('id',$degrees_id[0])->pluck('degree_name');
            $degree_name = $degrees_name[0];
        }
        $chats = chatbox::select('*')->where('user_id',$user_id)->get();
        return view('admin.edituser',compact('user_data','degree_id','degree_name','courses_list','enrolled_courses','chats'));
    }

    //function to update user profile.
    public function updateUser(Request $request)
    {
        $id = $request->user_id;
        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(),  [
             'user_name' => 'required',
             'user_lname' => 'required',
             'user_email' => 'required|email',
             'user_phone' => 'required',
             'user_university' => 'required',
             'user_degree' => 'required'
         ]);
       
        if ($validator->passes()) {
            if($request->hasFile('user_img')) {
            $file = $request->file('user_img') ;
            $destinationPath = public_path().'/assets/users/';
            $filename = $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
            
            $user->avatar = $filename ;
        }
        $user->first_name = $request->user_name;
        $user->last_name = $request->user_lname;
        $user->email = $request->user_email;
        $user->academic_institution = $request->user_university;
        $user->student_degree = $request->user_degree;
        $user->contact_number = $request->user_phone;
        $user->facebook_url = $request->facebookurl;
        $user->twitter_url = $request->twitterurl;
        $user->linkedin_url = $request->linkedinurl;
        $user->youtube_url = $request->youtubeurl;
        $user->save();
        Session::flash('message', ' עריכת המשתמש בהצלחה  ');
        return response()->json(['success' => true]);
         }else{
        return response()->json(['error'=>$validator->errors()]);
    }
        
    }

    public function userlogs($id=""){
        $userlogs_data = userlogs::select('*')->where('user_id',$id)->get();
        return view('admin.userlogs',compact('userlogs_data'));
    }


    public function refunduser(){
        return view('admin.refunduser');
    } 

    public function deletelog(Request $request)
    {
        $id = $request->deleted_id;
            $logs = userlogs::findOrFail($id);
            $logs->delete();
            $data['status'] = 1;
            $data['msg'] ='deleted'; 
      return json_encode($data);  
    }

    public function add_comment($id=""){
        $user_id = $id;
        return view('admin.addusercomment',compact('user_id'));
    }

    public function admin_user_forgotpassword(Request $request){
        if(!empty($request->email)){
            $check = User::select('*')->where('status',1)->where('email', $request->email)->first();
            if(!empty($check)){
                $token = hexdec(uniqid());
                $user_id = $check->id;
                $reset_link = url('/').'/admin/resetuserpassword/'.$user_id;
                $email_data = array('username' => $check->first_name, 'reset_link' => $reset_link);
                $email_to = $check->email;
                $name_to = $check->first_name;
                Mail::send('admin.user_emails', $email_data, function($message) use ($name_to, $email_to){
                    $message->to($email_to, $name_to)->subject
                    ('Reset Password - Researching');
                    $message->from('ruchikaindiit@gmail.com','researching');
                });
                $data['msg'] = ' איפוס דואר קישור הסיסמה נשלח. ';
                $data['status'] = 1;
            }
            else{
                $data['msg'] = ' אימייל לא מזוהה. ';
                $data['status'] = 0;
            }
        }
        else{
            $data['msg'] = ' הדוא"ל ריק. ';
            $data['status'] = 0;
        }
        return json_encode($data);
    }

    public function admin_user_resetpassword($id){
        $check_id = User::select('*')->where('status',1)->where('id', $id)->first();
        if(!empty($check_id)){
            $user_id = $check_id->id;
        }
        else{
            $user_id = 0;
        }
        return view('admin.resetuserpassword',compact('user_id'));
    }

    public function set_user_password(Request $request){
        if(!empty($request->newpassword)){
            $update_data = array('password' => Hash::make($request->newpassword));
            $update = User::where('id',  $request->user_id)->update($update_data);
            if($update){
                $data['msg'] = ' הסיסמה עודכנה. ';
                $data['status'] = 1;
            }
            else{
                $data['msg'] = ' הסיסמה לא עודכנה.  ';
                $data['status'] = 0;
            }
        }
        else{
            $data['msg'] = ' אנא הזן סיסמה חדשה. ';
            $data['status'] = 0;
        }
        return json_encode($data);
    }

    public function saveuserrecommend(Request $request){
        $recommendations = new recommendations;
        $user_id = $request->user_id;
        $users_data = User::select('*')->where('id',$user_id)->get();
        foreach ($users_data as $value) {
            $user_image = $value->avatar;
        }
        $validator = Validator::make($request->all(),  [
             'recommendation_type' => 'required',
             'recommed_desc' => 'required'
         ]);
         if ($validator->passes()) {
            $recommendations->user_image = $user_image; 
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
        }else{
        $recommendations->user_id = $user_id;
        $recommendations->type =  $request->recommendation_type;
        $recommendations->description = $request->recommed_desc;
        $recommendations->save();
        }
        return response()->json(['success' => true]);
    }else{
        return response()->json(['error'=>$validator->errors()]);
    }
    }
    
}
