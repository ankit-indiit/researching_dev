<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use DB;
use App\Models\admins;
use App\Models\contactus;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ContactusController extends Controller
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
    
    public function getcontact(){
    	$contactus_data = contactus::select('*')->get();
        return view('admin.contactus',compact('contactus_data'));
    }  

    public function updatecontact(Request $request){
    	$id = $request->contact_id;
        $validator = Validator::make($request->all(),  [
             'phone1' => 'required',
             'phone2' => 'required',
             'address1' => 'required',
             'address2' => 'required',
             'instagram' => 'required',
             'facebook' => 'required',
             'youtube' => 'required',
             'longitude1' => 'required',
             'latitude1' => 'required',
             'longitude2' => 'required',
             'latitude2' => 'required'
         ]);
       
         if ($validator->passes()) {
            $contactus = contactus::findOrFail($id);
        	$contactus->phonenumber1 = $request->phone1;
        	$contactus->phonenumber2 = $request->phone2;
        	$contactus->address1 = $request->address1;
        	$contactus->address2 = $request->address2;
        	$contactus->insta_link = $request->instagram;
        	$contactus->facebook_link = $request->facebook;
        	$contactus->youtube_link = $request->youtube;
        	$contactus->longitude1 = $request->longitude1;
        	$contactus->lattitude1 = $request->latitude1;
        	$contactus->longitude2 = $request->longitude2;
        	$contactus->lattitude2 = $request->latitude2;
        	$contactus->save();
        	Session::flash('message', ' Contactus עודכן בהצלחה. ');
        	return response()->json(['success' => true]);
     	}else{
        	return response()->json(['error'=>$validator->errors()]);
    }
    }

    
}
