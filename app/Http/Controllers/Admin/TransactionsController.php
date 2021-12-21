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
use App\Models\Course;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class TransactionsController extends Controller
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
    
    public function showhistory(){
        $orders = orders::select('*')->get();
        $recent_courses_data = Course::select('*')->get();
       
        return view('admin.transaction-history',compact('orders','recent_courses_data'));
    }

    public function showdetailhistory($id = ''){
        $orders_data = orders::select('*')->where('id',$id)->get();
        $order_data = array();
        foreach ($orders_data as $value) {
            $order_data = $value;
        }
        return view('admin.transaction-detail',compact('order_data'));
    }

    public function showsales(){
        $courses_getting = [];
        $Orders = [];
        $orderedcourses = [];
        $order_count = 0;
        $orders_data = orders::select('*')->get();
        foreach ($orders_data as $key => $order_data) {
            $courseid = $order_data->ordered_courses;
            array_push($orderedcourses,$courseid);
            if(!in_array($courseid,$courses_getting)){
                array_push($courses_getting,$courseid);
                array_push($Orders,$order_data);
            }
        }
        $courses = Course::select('*')->whereIn('course_id',$courses_getting)->get();
        return view('admin.sales',compact('courses','orderedcourses'));
    }

    public function showhistorycategory(){
        return view('admin.payment-history-category');
    }
    
}
