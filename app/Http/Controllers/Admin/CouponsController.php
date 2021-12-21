<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use DB;
use App\Models\admins;
use App\Models\couponcode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CouponsController extends Controller
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
    
    public function listing(){
        $coupons_data = couponcode::select('*')->get();
        return view('admin.coupons',compact('coupons_data'));
    }


    public function addcoupon(){
        return view('admin.addcoupon');
    } 


    public function savecoupon(Request $request){
        $coupons = new couponcode;
        $validator = Validator::make($request->all(),  [
             'add_coupon_name' => 'required',
             'add_couponcode' => 'required',
             'add_discount' => 'required',
             'start_date' => 'required',
             'expired_date' => 'required',
             'degree_name' => 'required',
             'courses' => 'required',
             'institute_name' => 'required',

         ]);
       
         if ($validator->passes()) {
           
            $coupons->coupon_name = $request->add_coupon_name;
            $coupons->coupon_code = $request->add_couponcode;
            $coupons->value = $request->add_discount;
            $coupons->started_at = $request->start_date;
            $coupons->expired_at = $request->expired_date;
            $coupons->coupon_type = $request->custom_check;
            if($request->institute_name != ''){
                $coupons->university_name = $request->institute_name;
            }
            if($request->courses != ''){
                $coupons->course_name = $request->courses;
            }
            if($request->degree_name != ''){
                $coupons->degree_name = $request->degree_name;
            }
            $coupons->save();
        Session::flash('message', ' הקופון נשמר בהצלחה. ');
        return response()->json(['success' => true]);
         }else{
        return response()->json(['error'=>$validator->errors()]);
    }
    }

    public function editcoupon($id=""){
        $coupon_id = $id;
        $coupon_data = array();
        $degrees_id = '';
        $degree_id = '';
        $degrees_name = array();
        $degree_name = array();
        $coupons_data = couponcode::select('*')->where('id',$coupon_id)->get();
        foreach ($coupons_data as $value) {
            $coupon_data = $value;
        }
        return view('admin.editcoupon',compact('coupon_data','coupon_id'));
    }

    //function to update user profile.
    public function updatecoupon(Request $request)
    {
        $id = $request->coupon_id;
        $coupons = couponcode::findOrFail($id);
        $validator = Validator::make($request->all(),  [
             'coupon_name' => 'required',
             'coupon_code' => 'required',
             'coupon_discount' => 'required',
             'start_date' => 'required',
             'expired_date' => 'required'
         ]);
        if($request->institute_name != ''){
            $coupons->university_name = $request->institute_name;
        }
        if($request->courses != ''){
            $coupons->course_name = $request->courses;
        }
        if($request->degree_name != ''){
            $coupons->degree_name = $request->degree_name;
        }
       
        if ($validator->passes()) {
            $coupons->coupon_name = $request->coupon_name;
            $coupons->coupon_code = $request->coupon_code;
            $coupons->value = $request->coupon_discount;
            $coupons->started_at = $request->start_date;
            $coupons->expired_at = $request->expired_date;
            $coupons->save();
            Session::flash('message', ' עריכת קופון בהצלחה  ');
            return response()->json(['success' => true]);
         }else{
        return response()->json(['error'=>$validator->errors()]);
    }
        
    }

    public function deletecoupon(Request $request)
    {
        $id = $request->deleted_id;
            $couponcode = couponcode::findOrFail($id);
            $couponcode->delete();
            $data['status'] = 1;
            $data['msg'] ='deleted'; 
      return json_encode($data);  
    }
}
