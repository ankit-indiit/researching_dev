<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Course;
use App\Models\Instructors;
use App\Models\orders;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HistoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $orders = array();
        $orders = DB::table('orders')->where('user_id',Auth::user()->id)->paginate(10);
        $coursesIds = array();
        $courses = array();
        foreach ($orders as $order) {
            $coursesIds[] = explode(",", $order->ordered_courses);
        }
        $courses_name = Course::select('course_name')->whereIn('course_id',$coursesIds)->pluck('course_name');
        return view('includes.history',compact('user','orders','courses_name'));
    }
}
