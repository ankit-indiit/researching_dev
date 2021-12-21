<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Degrees;
use App\Models\Universities;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $id = Auth::user()->id;
        $degrees_id = '';
        $users_data = array();
        $degree_id = '';
        $degrees_name = array();
        $degree_name = array();
        $users_data = User::select('*')->where('id',$id)->get();
        foreach($users_data as $user_data){
            $degrees_id = $user_data->student_degree;
        }
        if(!empty($degrees_id)){
            $degree_id = $degrees_id[0];
            $degrees_name = Degrees::select('*')->where('id',$degrees_id[0])->pluck('degree_name');
            $degree_name = $degrees_name[0];
        }
        return view('includes.profile',compact('user','degree_id','degree_name'));
    }

    //function to update user profile.
    public function updateProfile(Request $request)
    {
        
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(),  [
             'profile_first_name' => 'required',
             'profile_last_name' => 'required',
             'profile_email' => 'required|email',
             'profile_phone_number' => 'required',
             'profile_university' => 'required',
             'profile_degree' => 'required'
         ]);
       
         if ($validator->passes()) {
             
            if($request->hasFile('avatar')) {

            $file = $request->file('avatar') ;
            $destinationPath = public_path().'/assets/users/';
            //$filename = $file->getClientOriginalName();
            $original_name = $file->getClientOriginalName();
            $filename = str_replace(' ', '_', time().$original_name);
            $file->move($destinationPath, $filename);
            $user->avatar = $filename;
            /*echo "<pre>";
            print_r($user->avatar);
            die;*/
        }
        $user->first_name = $request->profile_first_name;
        $user->last_name = $request->profile_last_name;
        $user->email = $request->profile_email;
        $user->academic_institution = $request->profile_university;
        $user->student_degree = $request->profile_degree;
        $user->contact_number = $request->profile_phone_number;
        //$user->description = $request->profile_description;
        $user->save();
        Session::flash('message', ' ההגדרות עודכנו בהצלחה !! ');
        return response()->json(['success' => true]);
         }else{
        return response()->json(['error'=>$validator->errors()]);
    }
        
    }

    //function to change password if user want wile updating profile.
    public function changePassword(Request $request){

        $oldpass = Auth::user()->password;
        $validator = Validator::make($request->all(),  [
             'old_password' => 'required|min:8',
             'new_password' => 'required|min:8',
             'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->passes()) {
        //cross check old password
        if(Hash::check($request->old_password,$oldpass)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->new_password);
            $user->save();
            Session::flash('message', ' הסיסמא עודכנה בהצלחה. ');
        }
    }else{
        return response()->json(['error'=>$validator->errors()]);
    }
    }

    public function Messages(){
        return view('includes.message');
    }

    public function ShowMessagesDetails(){
        return view('includes.message-details');
    }
    
    public function PaymentMethods(){
        $id = Auth::user()->id;
        $default_card_data = array();
        return view('includes.payment-method');
    }

    public function Notifications(){
         return view('includes.notifications');
    }
    
    
}

