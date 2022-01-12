<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification as ModelsAdminNotification;
use App\Models\Course;
use App\Models\Degrees;
use App\Models\NotificationManuals;
use App\Models\notifications;
use App\Models\Universities;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminNotification extends Controller
{
    public function clearNotification(){
        ModelsAdminNotification::truncate();
    }

    public function getAdvanceNotification()
    {
        $manual_notification = NotificationManuals::with('course')->get();
        $courses = Course::all();
        $all_users = User::all();
        $universities = Universities::all();
        $degrees = Degrees::all();
        $events_data  = array();
        return view('admin.advanceNotification', compact('manual_notification','courses','events_data','all_users','universities','degrees'));
    }

    public function saveAdvanceNotification(Request $request)
    {
        $users = $request->users;
        $message = $request->message;
        $product = $request->product;
        $randomId = uniqid();
        if(count($users) > 0){
            $data = array();
            foreach($users as $user){
                $data[]= array(
                    'title' => 'Admin Notification',
                    'sender_id'=>$user,
                    'courses_id'=>$product,
                    'message'=>$message,
                    'type'=>3,
                    'manual_id'=>$randomId
                );
            }
        }
        notifications::insert($data);
        $nm = new NotificationManuals();
        $nm->notification_id = $randomId; 
        $nm->message = $message;
        $nm->sender_id = json_encode($users);
        $nm->courses_id = $product;
        $nm->save();
        Session::flash('message', 'Notification created successfully'); 
        return response()->json(['status'=>true,'message'=>'Notification created successfully']);
    }

    public function advanceNotificationFilter(Request $request)
    {
        $action = $request->action;
        // if($action == 'university_change'){
        //     $degree = Degrees::select('id','degree_name')->where('university_id',$uni_id)->get()->toArray();
        //     //return response()->json(['degree'=>$degree,'action'=>'university_change']);
        // }
        $all_degree ='';
        if($request->univ){
            $degree = Degrees::select('id','degree_name AS text');
            $degree->where('university_id',$request->univ);
            $all_degree = $degree->get();
        }   
        

        $users = User::select('*');
        if($request->univ){
            $users->where('academic_institution',$request->univ);
        }
        if($request->degree){
            $users->where('student_degree',$request->degree);
        }          
        if($request->search){
            $name = $request->search;
            $users->where('first_name','LIKE','%'.$name.'%')
            ->orWhere('last_name','LIKE','%'.$name.'%')
            ->orWhere('email','LIKE','%'.$name.'%')
            ->orWhere(DB::raw('CONCAT(first_name, " ", last_name)'), 'LIKE', '%' . $name . '%');
        }  
        $all_users = $users->get();
        $all_users = $all_users->map(function ($user) {
            return [
                'id' => $user->id,
                'text' => $user->full_name,
            ];
        });        
        return response()->json(['users'=>$all_users,'degree'=>$all_degree,'action'=>$action]);
    }
}
