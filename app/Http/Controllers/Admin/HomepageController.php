<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Option;

class HomepageController extends Controller
{
    
    public function __construct()
    {
        if(Auth::check()){
            Auth::logout();
            return redirect()->route('admin.adminLogin');           
        }
        $is_logged_in = Session::get('admin_logged_in');
        if(!isset($is_logged_in) && $is_logged_in != '1'){
            Auth::logout();
            return redirect()->route('admin.adminLogin');
        }
    } 

    public function index()
    {
        $options = Option::where('name', "homepage_setting")->pluck('value')->first();
        $options = ($options) ? unserialize($options) : $options;
        return view('admin.homepage-settings',compact('options'));
    }

    public function saveSettings(Request $request)
    {
        $option = Option::updateOrCreate([
			'name'   => "homepage_setting",
		],[
			'value'  => serialize($request->except('_token')),
		]);	
        return redirect()->back()->with('message', 'הגדרות נשמרו !');

    }
    
}

