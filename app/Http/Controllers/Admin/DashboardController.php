<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use DB;
use App\Models\admins;
use App\Models\orders;
use App\Models\Contact;
use App\Models\chatbox;
use App\Models\User;
use App\Models\Course;
use App\Models\Degrees;
use App\Models\quiz;
use App\Models\visitors;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Session;


class DashboardController extends Controller
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

    public function dashboard($from_date = "", $to_date=""){
        $paid_ids = array();

        //dd(Session::all());
        
        $visitors = visitors::select('ip')->whereBetween('created_at',[$from_date, $to_date])->distinct()->count();
        /*echo "<pre>";
        print_r($visitors);
        print_r($from_date);
        print_r($to_date);
        echo "<pre>";
        exit;*/
        if($visitors == '0'){
            $visitors = '-';
        }else{
            $visitors = $visitors;
        }
        $registered_users = User::select('id')->whereBetween('created_at',[$from_date, $to_date])->distinct()->count();
        if($registered_users == '0'){
            $registered_users = '-';
        }else{
            $registered_users = $registered_users;
        }
        $paid_users = orders::select('user_id')->distinct()->get();
        foreach ($paid_users as $key => $value) {
            $paid_ids[] = $value->user_id; 
        }
        $count_users = User::select('id')->whereBetween('created_at',[$from_date, $to_date])->whereIn('id',$paid_ids)->distinct()->count();
        if($count_users == '0'){
            $count_users = '-';
        }else{
            $count_users = $count_users;
        }

        $degree_count = degrees::select('id')->whereBetween('created_at',[$from_date, $to_date])->distinct()->count();
        if($degree_count == '0'){
            $count_users = '-';
        }else{
            $degree_count = $degree_count;
        }

        $courses_count = Course::select('course_id')->whereBetween('created_at',[$from_date, $to_date])->distinct()->count();
        if($courses_count == '0'){
            $courses_count = '-';
        }else{
            $courses_count = $degree_count;
        }

        $total_income = orders::select( DB::raw('SUM(orders.grand_total) as total'))->whereBetween('created_at',[$from_date, $to_date])->first();
        if($total_income == '0'){
            $total_income = '-';
        }else{
            $total_income = $total_income;
            $total_income = round($total_income->total,2);
        }
        $contact_data = Contact::select('email')->distinct()
            ->count();
        $chatbox_data = chatbox::select('user_id')->distinct()->count();
        $total_alert_count = $contact_data + $chatbox_data;
        return view('admin.index',compact('visitors','registered_users','count_users','total_income','degree_count','courses_count','total_alert_count')); 
        
    }  
 
    public function filtered_data($from_date = "", $to_date=""){
        
        /*$from_date = '2021-04-09 10:18:38';
        $to_date ='2021-12-02 06:10:00';*/
        
        $paid_ids = array();
        $visitors = visitors::select('ip')->whereBetween('created_at',[$from_date, $to_date])->distinct()
            ->count();
        if($visitors == '0'){
            $visitors = '-';
        }else{
            $visitors = $visitors;
        }
        $registered_users = User::select('id')->whereBetween('created_at',[$from_date, $to_date])->distinct()->count();
        if($registered_users == '0'){
            $registered_users = '-';
        }else{
            $registered_users = $registered_users;
        }
        $paid_users = orders::select('user_id')->distinct()->get();
        foreach ($paid_users as $key => $value) {
            $paid_ids[] = $value->user_id; 
        }
        $count_users = User::select('id')->whereBetween('created_at',[$from_date, $to_date])->whereIn('id',$paid_ids)->distinct()->count();
        if($count_users == '0'){
            $count_users = '-';
        }else{
            $count_users = $count_users;
        }
        $degree_count = degrees::select('id')->whereBetween('created_at',[$from_date, $to_date])->distinct()->count();
        if($degree_count == '0'){
            $count_users = '-';
        }else{
            $degree_count = $degree_count;
        }

        $courses_count = Course::select('course_id')->whereBetween('created_at',[$from_date, $to_date])->distinct()->count();
        
        if($courses_count == '0'){
            $courses_count = '-';
        }else{
            $courses_count = $courses_count;
        }

        $total_income = orders::select( DB::raw('SUM(orders.grand_total) as total'))->whereBetween('created_at',[$from_date, $to_date])->first();
        
        if(isset($total_income) && $total_income != ''){
            $total_income = round($total_income['total'],2);
        }else{
            $total_income = '-';
        }
       
        $quiz_count = quiz::select('course_id')->whereBetween('created_at',[$from_date, $to_date])->distinct()->count();
        
        if($quiz_count == '0'){
            $quiz_count = '-';
        }     

        return response()->json(['success'=>true,'visitors' => $visitors,'registered_users' => $registered_users,'count_users' => $count_users,'total_income' => $total_income, 'degree_count' => $degree_count,'courses_count' => $courses_count, 'quiz_count'=>$quiz_count]); 
    } 

    public function graphSegment()
    {
        $month_array = array(
           "January",
           "February",
           "March",
           "April",
           "May",
           "June",
           "July",
           "August",
           "September",
           "October",
           "November",
           "December"
        );

        $graph_data = array();

                
        $data =  orders::select(DB::raw("(COUNT(*)) as count"),DB::raw("MONTHNAME(created_at) as monthname"))
        ->whereYear('created_at', date('Y'))
        ->groupBy('monthname')
        ->orderBy('created_at')
        ->get()->toArray();
        
    
        $allMonth = array_column($data, 'monthname');

        foreach($month_array as $month){

            if(in_array($month,$allMonth)){
                $key = array_search($month, array_column($data, 'monthname'));
                $graph_data[] = array(
                    "count" => $data[$key]['count'],
                    "monthname" => $data[$key]['monthname']
                );               
            }else{
                $graph_data[] = array(
                    "count" => 0,
                    "monthname" => $month
                );
            }
        }

        return $graph_data;

    }

    public function adminProfile(){
    	$countries = DB::table('country')->where('parent',0)->get();
        return view('admin.profile',compact('countries'));
    } 

    public function updateProfile(Request $request){
    	$admin_id = session()->get('id');
    	$admin = admins::findOrFail($admin_id);
        $admin_data = DB::table('admins')->where('id',$admin_id)->get();
        $validator = Validator::make($request->all(),  [
             'admin_name' => 'required',
             'admin_email' => 'required|email',
             'admin_phone' => 'required',
             'address' => 'required',
             'country' => 'required'
        ]);
        if ($validator->passes()) {
            if($request->hasFile('user-img')) {
            $file = $request->file('user-img') ;
            $destinationPath = public_path().'/assets/users/';
            $filename = $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
            
            $admin->image = $filename ;
        }
        $admin->name = $request->admin_name;
        $admin->email = $request->admin_email;
        $admin->phone_number = $request->admin_phone;
        $admin->address = $request->address;
        $admin->country = $request->country;
        $admin->save();
        Session::flash('message', ' הפרופיל עודכן בהצלחה. ');
        return response()->json(['success'=>true]);
         }else{
        return response()->json(['error'=>$validator->errors()]);
    }
    } 

    public function changepassword(Request $request){

    	$admin_id = session()->get('id');
    	$admin = admins::findOrFail($admin_id);
        $admin_data = DB::table('admins')->where('id',$admin_id)->pluck('password');
        $oldpass = $admin_data[0];
        $validator = Validator::make($request->all(),  [
             'old_password' => 'required|min:8',
             'new_password' => 'required|min:8',
             'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->passes()) {
        //cross check old password
        if(Hash::check($request->old_password,$oldpass)){
            $admin->password = Hash::make($request->new_password);
            $admin->save();
            Session::flash('message', ' הסיסמא עודכנה בהצלחה. ');
        }
    }else{
        return response()->json(['error'=>$validator->errors()]);
    }
    }
}
