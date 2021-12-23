<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use DB;
use App\Models\admins;
use App\Models\questions;
use App\Models\aboutus;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AboutusController extends Controller
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

    public function getabout(){
        $aboutus = aboutus::select('*')->get();
        return view('admin.aboutus',compact('aboutus'));
    }

    public function updateabout(Request $request){
        $blog_id = '';
        $blogs = new aboutus;
        $title = [];
        $content = [];
        $data = [];
        $id = $request->aboutus_id;

        $aboutus = aboutus::findOrFail($id);
        $validator = Validator::make($request->all(),  [
             'a1_title' => 'required',
             'a1_imageName' => 'required',
             'a1_description' => 'required',
             'a2_title' => 'required',
             'a2_imageName' => 'required',
             'a2_description' => 'required'
         ]);
       
        if ($validator->passes()) {
          if($request->a1_imageName) {
            $aboutus->a1_image = $request->a1_imageName ;
            }
            if($request->a2_imageName){
                $aboutus->a2_image = $request->a2_imageName ;
            }
        $aboutus->a1_title = $request->a1_title;
        $aboutus->a1_description = $request->a1_description; 
        $aboutus->a2_title = $request->a2_title; 
        $aboutus->a2_description = $request->a2_description;   

        $aboutus->save();

        Session::flash('message', ' המשתמש נוסף בהצלחה. ');
        return response()->json(['success' => true]);
         }else{
        return response()->json(['error'=>$validator->errors()]);
    }
    }
}
