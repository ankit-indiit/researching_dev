<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\cartItems;
use App\Models\referrals;
use DB;
use Log;
use Newsletter;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class RegisterController extends Controller
{
    //function for creating new user 
 	public function doSignup(Request $request){

 	 	$user = new User ();
 	 	$validator = Validator::make($request->all(),  [
             'first_name' => 'required',
             'last_name' => 'required',
             'email1' => 'required|email|unique:users,email',
             'password1' => 'required|min:8',
             'university' => 'required',
             'degree' => 'required',
             'terms' => 'required',
        ]);

        if ($validator->passes()) {

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email1;
        $user->password =  Hash::make($request->password1);
        $user->academic_institution = $request->university;
        $user->student_degree = $request->degree;       
        $user->save ();
        $reffer_code = strtolower($user->first_name).$user->id.rand(100,999);
        $user->reffer_code = $reffer_code;
        $user->save();
        if ( ! Newsletter::isSubscribed($request->email1) ) 
        {
            Newsletter::subscribePending($request->email1);
        }
        Auth::login($user);
        $cart = session()->get('cart');
        $guest_userid = session()->get('guest_user');
        if(!empty($cart)){
            DB::table('cart_items')->where('user_id',$guest_userid)->update(['user_id'=> $user->id]);  
            Auth::login($user);
            return response()->json(['success'=>' נוסף רשומות חדשות.   ']);
        }
        }else{
            return response()->json(['error'=>$validator->errors()]);
        }
    }

    //function to check user registered or not.
    public function doLogin(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required',
        ]);
        if ($validator->passes()) {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                 DB::table('userlogs')->insert(['user_id'=>Auth::user()->id, 'last_login_ip'=> $request->getClientIp(),'last_login_at' => date('d/M/Y h:i:s')]);
                $this->authenticated($request->password);
                $cart = session()->get('cart');
                $guest_userid = session()->get('guest_user');
                if(!empty($cart)){
                     DB::table('cart_items')->where('user_id',$guest_userid)->update(['user_id'=> Auth::user()->id]);  
                }
                return response()->json(['success'=>' נוסף רשומות חדשות.   ']);
            }
            return response()->json([
            'error' => [
                'credentials' => ' אנא בדוק את אישוריך. המשתמש אינו קיים !!  ',
                ]
            ]);
        }
        return response()->json(['error'=>$validator->errors()]);
    }

    protected function authenticated($user)
    {
        if(Auth::logoutOtherDevices($user))
        { 
            Log::warning('user logged out');
             } 
        return redirect('/');
    } 

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('/');
    }

    public function showforgot()
    {
        return view('auth.forgotpassword');
    }

    public function do_forgot(Request $request)
    {
        $data = array();
        if(!empty($request->email)){
            $check = User::select('*')->where('status',1)->where('email', $request->email)->first();
            if(!empty($check)){
                $token = hexdec(uniqid());
                DB::table('users')
                ->where('id',  $check->id)
               ->update(['remember_token' =>$token]);
                $reset_link = url('/').'/reset-password/'.$token;
                $email_data = array('username' => $check->first_name, 'reset_link' => $reset_link);
                $email_to = $check->email;
                $name_to = $check->first_name;
                Mail::send('auth.emails.reset', $email_data, function($message) use ($name_to, $email_to){
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

    public function resetPassword($token)
    {
        $check_token = User::select('*')->where('status',1)->where('remember_token', $token)->first();
        if(!empty($check_token)){
            $user_id = $check_token->id;
        }
        else{
            $user_id = 0;
        }
        return view('auth.resetpassword',compact('user_id'));
    }

    public function setPassword(Request $request)
    {
        if(!empty($request->newpassword)){
            $update_data = array('password' => Hash::make($request->newpassword), 'remember_token' => ' ');
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
}
