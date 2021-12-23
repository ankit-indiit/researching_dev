<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Homepage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Option;
use Illuminate\Support\Facades\Validator;

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
        // $options = Option::where('name', "homepage_setting")->pluck('value')->first();
        // $options = ($options) ? unserialize($options) : $options;
        // return view('admin.homepage-settings',compact('options'));
        $homepage = Homepage::find(1);
        return view('admin.homepage',compact('homepage'));
    }

    public function updateHomepage(Request $request)
    {
      
        $homepage = Homepage::findOrFail(1);
        $validator = Validator::make($request->all(),  [
            'banner_text' => 'required',
            'banner_image' => 'required',
            'banner_background' => 'required'
        ]);
    
        if ($validator->passes()) {

            $homepage->banner_text = json_encode($request->banner_text,JSON_UNESCAPED_UNICODE);
            $homepage->banner_image = $request->banner_image; 
            $homepage->banner_background = $request->banner_background; 
            $homepage->banner_mobile_image = $request->banner_mobile_image; 
            $homepage->banner_facebook = $request->banner_facebook; 
            $homepage->banner_insta = $request->banner_insta; 
            $homepage->banner_whatsapp = $request->banner_whatsapp; 
            $homepage->service_title = $request->service_title; 
            $homepage->service_desc = $request->service_desc; 
            $homepage->course_title = $request->course_title; 
            $homepage->course_description = $request->course_description; 
            $homepage->funfactor = $request->funfactor; 
            $homepage->banner_list = json_encode($request->banner_list,JSON_UNESCAPED_UNICODE);
            $homepage->success = json_encode($request->success,JSON_UNESCAPED_UNICODE);
            $homepage->save();

            Session::flash('message', ' המשתמש נוסף בהצלחה. ');
            return response()->json(['success' => true]);
        }else{
            return response()->json(['error'=>$validator->errors()]);
        }
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

