<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Degrees;
use App\Models\Universities;
use App\Models\notifications;
use App\Models\notification_user;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{

    public function Notifications(){
        $notification_ids = array();
        $recent_ids = array();
        $user_id = Auth::user()->id;
        $notifications = notifications::select('*')->where('sender_id',$user_id)->get();
        
        $recent_notifications = notifications::select('*')->where('sender_id',$user_id)->orderBy('id', 'DESC')->limit('2')->get();
       /* pr($notifications);
        pr($recent_notifications);
        die;*/
        /*$users_data = notification_user::select('*')->where('reciever_id',$user_id)->get();
        
        foreach ($users_data as $value) {
            $notification_ids[] = $value->notification_id;
        }
        $notifications = notifications::select('*')->whereIn('id',$notification_ids)->get();
        $recents_data = notification_user::select('*')->where('reciever_id',$user_id)->orderBy('created_at', 'DESC')->limit('2')->get();
        foreach ($recents_data as $recent_data) {
            $recent_ids[] = $recent_data->notification_id;
        }
        $recent_notifications = notifications::select('*')->whereIn('id',$recent_ids)->get();*/
        return view('includes.notifications',compact('notifications','recent_notifications'));
    }

    //function to remove items from cart and db also.
    public function remove(Request $request)
    {
        if($request->id) {
            $id = $request->id;
            $user_id = Auth::user()->id;
            notifications::where('sender_id',$user_id)->where('id',$id)->delete();
            //notification_user::where('reciever_id',$user_id)->where('notification_id',$id)->delete();
        }
    }
}

