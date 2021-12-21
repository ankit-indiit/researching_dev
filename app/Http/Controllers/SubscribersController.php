<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Course;
use App\Models\Instructors;
use App\Models\subscribers;
use Newsletter;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SubscribersController extends Controller
{

    public function store(Request $request)
    {
        if ( ! Newsletter::isSubscribed($request->user_email) ) 
        {
            Newsletter::subscribe($request->user_email);

            $subscribers = new subscribers;
            $subscribers->name = $request->user_name;
            $subscribers->email = $request->user_email;
            $subscribers->institute = $request->user_university;
            $subscribers->degree = $request->user_degree;
            $subscribers->save();

            return redirect()->back()->with('success', 'תודה על המנוי.');
        }else{
            return redirect()->back()->with('failure', ' מצטער! כבר נרשמת ');
        }
        
             
    }
}
