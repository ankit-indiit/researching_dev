<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use DB;
use App\Models\admins;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AdminLoginController extends Controller
{
    
    public function admin_do_login(Request $request){
        if(!empty($request->email) && !empty($request->password)){
            $check_login = admins::select('*')->where('status',1)->where('email', $request->email)->first();
            if(!empty($check_login)){
                if (Hash::check($request->password, $check_login->password)) {
                    Session::put('admin_logged_in', '1');
                    Session::put('id', $check_login->id);
                    Session::put('admin_name', $check_login->name);
                    // Auth::logout();
                    $data['status'] = 1;
                }
                else{
                    $data['status'] = 0;
                    $data['msg'] = ' אנא הזן סיסמא חוקית. ';
                }
            }
            else{
              $data['status'] = 0;
              $data['msg'] = ' משתמש לא קיים. ';
            }
        }
        else{
            $data['status'] = 0;
            $data['msg'] = ' אנא הזן אישורים תקפים. ';
        }
        return json_encode($data);
    }

    public function admin_login(){
        $is_logged_in = Session::get('admin_logged_in');
        if(isset($is_logged_in) && $is_logged_in == '1'){
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

     public function adminforgotpassword(){
        $is_logged_in = Session::get('admin_logged_in');
        if(isset($is_logged_in) && $is_logged_in == '1'){
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.forgotpassword');
    }

    public function admin_do_forgotpassword(Request $request){
        if(!empty($request->email)){
            $check = admins::select('*')->where('status',1)->where('email', $request->email)->first();
            if(!empty($check)){
                $token = hexdec(uniqid());
                DB::table('admins')
                ->where('id',  $check->id)
               ->update(['remember_token' =>$token]);
                $reset_link = url('/').'/admin/resetpassword/'.$token;
                $email_data = array('username' => $check->name, 'reset_link' => $reset_link);
                $email_to = $check->email;
                $name_to = $check->name;
                Mail::send('admin.auth.emails', $email_data, function($message) use ($name_to, $email_to){
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

    public function admin_resetpassword($token){
        $check_token = admins::select('*')->where('status',1)->where('remember_token', $token)->first();
        if(!empty($check_token)){
            $user_id = $check_token->id;
        }
        else{
            $user_id = 0;
        }
        return view('admin.auth.resetpassword',compact('user_id'));
    }

    public function admin_set_password(Request $request){
        if(!empty($request->newpassword)){
            $update_data = array('password' => Hash::make($request->newpassword), 'remember_token' => ' ');
            $update = admins::where('id',  $request->user_id)->update($update_data);
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

    public function logout(){
        Session::forget('admin_logged_in');
        Session::forget('id');
        Session::forget('admin_name');
        // Session::flush();
        // Auth::logout();
        return redirect()->route('admin.adminLogin');
        }
        
        public function pendingmessage(){
         return view('admin.pendingmessage');
    }
    
    public function programmingerror(){
         return view('admin.programmingerror');
    }
    
    public function paymentmanagement(){
         return view('admin.paymentmanagement');
    }
    
    public function responseconfirmation(){
         return view('admin.responseconfirmation');
    }
    
    public function recommendation(){
        return view('admin.recommendation');
    }
    
    public function viewrecommendation(){
        return view('admin.viewrecommendation');
    }
    
    public function addrecommendation(){
        return view('admin.addrecommendation');
    }
}
