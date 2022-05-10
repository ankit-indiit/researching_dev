<?php

namespace App\Http\Controllers;

use App\Models\AdminNotification;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Affiliate;
use App\Models\Blog;
use App\Models\Course;
use App\Models\cartItems;
use App\Models\Ticket;
use App\Models\Topics;
use App\Models\orders;
use App\Models\joinus;
use App\Models\referrals;
use App\Models\couponcode;
use App\Models\used_coupons;
use App\Models\recommendations;
use App\Models\question_answer;
use Stripe\Error\Card;
use Cartalyst\Stripe\Stripe;
use Illuminate\Support\Facades\DB;
use App\Models\Package;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * this function will add the cart items in session and as well as in db for both login and guest user.
     *
     * @return \Illuminate\Http\Response
     */
    public function addToCart($type,$id)
    {
        if(Auth::check()){
            $userid = Auth::user()->id;
        }else{
            //chk tmp id or not
            $guest_user = session()->get('guest_user');
            if(!empty($guest_user)){
                $userid = $guest_user;
            }else{
                $userid = uniqid();
                if(!$guest_user) {
                    session(['guest_user'=> $userid]);
                }
                //add session 
            }    
        }
        //for adding course in the cart
        if($type == '0'){
           $courses = Course::select('*')->where('course_id',$id)->get(); 
           foreach ($courses as $course) {
                $cart = session()->get('cart.items');
                // if item not exist in cart then add to cart with quantity = 1
                if(!$cart) {
                $cart = [
                    $id => [
                        "name" => $course->course_name,
                        "quantity" => 1,
                        "price" => $course->price,
                        "photo" => $course->image,
                        "description" => $course->description,
                        "course_id" => $id,
                        "user_id" => $userid,
                        "item_type" => 0
                    ]
                ];
                session()->put('cart.items', $cart);
                }
            // if item not exist in cart then add to cart with quantity = 1
                $cart[$id] = [
                    "name" => $course->course_name,
                    "quantity" => 1,
                    "price" => $course->price,
                    "photo" => $course->image,
                    "description" => $course->description,
                    "course_id" => $id,
                    "user_id" => $userid,
                    "item_type" => 0
                ];
                session()->put('cart.items', $cart);        
                $cart_data = new cartItems;
                $cart_data->user_id = $userid;
                $cart_data->course_id = $course->course_id;
                $cart_data->name = $course->course_name;
                $cart_data->description = $course->description;
                $cart_data->quantity = 1;
                $cart_data->price = $course->price;
                $cart_data->image = $course->image;
                $cart_data->item_type = 0;
                $cart_data->save();   
                return redirect(url()->previous());
            }
        }else{
            $packages = Package::select('*')->where('package_code',$id)->get();
            foreach ($packages as $package) {
                $cart = session()->get('cart.items');
                // if item not exist in cart then add to cart with quantity = 1
                if(!$cart) {
                $cart = [
                    $id => [
                        "name" => $package->package_name,
                        "quantity" => 1,
                        "price" => $package->price,
                        "photo" => $package->image,
                        "description" => $package->description,
                        "course_id" => $id,
                        "user_id" => $userid,
                        "item_type" => 1
                    ]
                ];
                session()->put('cart.items', $cart);
            }
            // if item not exist in cart then add to cart with quantity = 1
                $cart[$id] = [
                    "name" => $package->package_name,
                    "quantity" => 1,
                    "price" => $package->price,
                    "photo" => $package->image,
                    "description" => $package->description,
                    "course_id" => $id,
                    "user_id" => $userid,
                    "item_type" => 1
                ];
                session()->put('cart.items', $cart);        
                $cart_data = new cartItems;
                $cart_data->user_id = $userid;
                $cart_data->course_id = $package->package_code;
                $cart_data->name = $package->package_name;
                $cart_data->description = $package->description;
                $cart_data->quantity = 1;
                $cart_data->price = $package->price;
                $cart_data->image = $package->image;
                $cart_data->item_type = 1;
                $cart_data->save();   
                return redirect(route('front.courses'));
            }
       }
}

    public function topicAddtoCart($course_id,$topic_id){
       
       if(Auth::check()){
            $userid = Auth::user()->id;
        }else{
            //chk tmp id or not
            $guest_user = session()->get('guest_user');
            if(!empty($guest_user)){
                $userid = $guest_user;
            }else{
                $userid = uniqid();
                if(!$guest_user) {
                    session(['guest_user'=> $userid]);
                }
                //add session 
            }    
        }
        $topicData = Topics::select('*')->where('id',$topic_id)->get();
        $course = Course::select('*')->where('course_id',$course_id)->get();
        
        foreach ($topicData as $key=>$topicData) {
            $cart = session()->get('cart.items');
            // if item not exist in cart then add to cart with quantity = 1
            if(!$cart) {
            $cart = [
                $topic_id => [
                    "name" => $topicData->topic_name,
                    "quantity" => 1,
                    "price" => $topicData->topic_price,
                    "photo" => $course[0]->image,
                    "description" =>$course[0]->description,
                    "course_id" => $course_id,
                    "topic_id" => $topic_id,
                    "user_id" => $userid,
                    "item_type" => 3
                ]
            ];
            session()->put('cart.items', $cart);
        }
        // if item not exist in cart then add to cart with quantity = 1
            $cart[$topic_id] = [
                "name" => $topicData->topic_name,
                "quantity" => 1,
                "price" => $topicData->topic_price,
                "photo" => $course[0]->image,
                "description" => $course[0]->description,
                "course_id" => $course_id,
                "topic_id" => $topic_id,
                "user_id" => $userid,
                "item_type" => 3
            ];
            session()->put('cart.items', $cart);
            $cart_data = new cartItems;
            $cart_data->user_id = $userid;
            $cart_data->course_id = $course_id;
            $cart_data->topic_id = $topic_id;
            $cart_data->name = $topicData->topic_name;
            $cart_data->description = $course[0]->description;
            $cart_data->quantity = 1;
            $cart_data->price = $topicData->topic_price;
            $cart_data->image = $course[0]->image;
            $cart_data->item_type = 3;
            $cart_data->save();
            return redirect(route('front.courses'));
        }
    }
    
    //load and show cart items items page.
    public function showCart($id){
    
        $current_user_id = $id;
        $cart_data = array();
        $user_ids = array();
        $recommendations = array();
        $referrals_data = array();
        $code = '';
        //checkout type on the basis of item type value 
        //item_type = 0 for courses
        //item_type = 1 for packages
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $cart_data = cartItems::select('*')->where('user_id',$user_id)->get();
        }else{
            $cart_data = cartItems::select('*')->where('user_id',$id)->get();
        }
        foreach ($cart_data as $value) {
            $recommendations = recommendations::select('*')->where('course_id',$value->course_id)->where('status',1)->get();
        }
        foreach ($recommendations as $recommendation) {
            $user_ids[] = $recommendation->user_id;
        }
        $users_data = User::select('*')->whereIn('id',$user_ids)->get();
        $questions = question_answer::select('*')->get();
        $referrals_data = referrals::select('*')->where('reffered_by',$id)->where('status',0)->get();
        if(count($referrals_data) > 0){
            foreach($referrals_data as $referral){
               $code = $referral->refferal_code;

              }
        }
        $urls = joinus::select('*')->pluck('url');
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $user_detail = User::find($user_id);
            $ticketData = DB::table('tickets')->where('user_id',$user_id)->get()->toArray();
            return view('includes.cart',compact('cart_data','user_detail','recommendations','users_data','questions','urls','current_user_id','code','ticketData'));
        }else{
            return view('includes.cart',compact('cart_data','recommendations','users_data','questions','urls','current_user_id','code'));
        }
    }

    //function to remove items from cart and db also.
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart.items');
            
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart.items', $cart);
            }
            cartItems::where('course_id',$request->id)->delete();
            if(count(session()->get('cart.items')) == 0){
                session()->forget('cart');
            }
        }
        // return redirect(route('courses'));
    }

    //function to remove items from cart and db also.
    public function applycoupon(Request $request)
    {
        session()->forget('cart.refer');
        $coupon_code=$request->coupon_name;
        $actual_price = $request->actual_price;
        $discount = array();
        $coupons = couponcode::select('*')->where('coupon_code',$coupon_code)->get();
        $reffer_code = User::where('reffer_code',$coupon_code)->first();
        if (count($coupons) > 0){
            if(Auth::check()){
                $user_id = Auth::user()->id;
            }else{
                $user_id = session()->get('guest_user');
            }
            $check_user = used_coupons::select('*')->where('coupon_id',$coupons[0]->id)->where('user_id',$user_id)->count();
            if($check_user == 0){
                foreach ($coupons as $coupon) {
                    $percent = $coupon->value;
                    $discount_value = $actual_price*$percent/100;
                    $final_amount = $actual_price -$discount_value;
                }
                //insert after applying
                $used_add = DB::table('used_coupons')
                ->insert([
                    'coupon_id' => $coupons[0]->id,
                    'user_id' => $user_id
                ]);
                $data['status'] = 1;
                $data['discount_value'] = $discount_value;
                $data['final_amount'] = $final_amount;
                $data['msg'] ='applied'; 
                 
            }else{
                $data['status'] = 0;
                $data['msg'] = 'קוד קופון כבר בשימוש!';
            }
        }
        elseif($reffer_code)
        {
            $is_used = '';
            if(Auth::check()){
                $user_id = Auth::user()->id;
                $is_used = referrals::where('refferal_code',$coupon_code)->where('reffered_to',$user_id)->first();
            }
            if($is_used){
                $data['status'] = 0;
                $data['msg'] ='קוד קופון כבר בשימוש!';
            }else{
                $percent = 10;
                $reffer_data = array(
                    'reffered_by'=> $reffer_code->id,
                    'refferal_code' => $coupon_code,
                    'discount_value' => $percent
                );
                session()->put('cart.refer', $reffer_data);            
                $discount_value = $actual_price*$percent/100;
                $final_amount = $actual_price -$discount_value;            
                $data['status'] = 1;
                $data['discount_value'] = $discount_value;
                $data['final_amount'] = $final_amount;
                $data['msg'] ='הוחל על הקופון!';  
            }
        }
        else{
            $data['status'] = 0;
            $data['msg'] ='קוד קופון לא חוקי.';
        }
       return response()->json(['data' => $data]);
    }

    //function loading checkout page.
    public function checkout(Request $request)
    {   
        
        $validator = Validator::make($request->all(),  [
             'first_name' => 'required',
             'last_name' => 'required',
             'email' => 'required|email',
             'phone_number' => 'required',
             'agree_terms' => 'required',
             'risk_terms' => 'required'
        ]);
        if ($validator->passes()) {
        //check for validator start for user details
            try {
            //try start
            $count = 1;
            $price = array();
            $Type = array();
            $course_data = explode(',',$request->courses_id);
            $Prices = explode(',', $request->grand_total);
            $types = explode(',',$request->course_type);
            
            $orderno = uniqid();
            foreach ($course_data as $keys => $value) {
                
                foreach ($Prices as $key => $prices) {
                    $price[$key] = $prices;
                }
                foreach ($types as $key => $type) {
                    $Type[$key]  = $type;
                }
                $order_no = $orderno . '_' . $count;
                $pay_data = array(
                    'user_id' => Auth::user()->id,
                    'order_number' => $order_no,
                    'status' => 2,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'grand_total' => $price[$keys],
                    'course_type' => $Type[$keys],
                    'item_count' => $request->item_count,
                    'payment_method' => 'card',
                    'phone_number' => $request->phone_number,
                    'ordered_courses' => $value,
                    'created_at' => date("Y/m/d h:i:s"),
                );
                
                $insert = DB::table('orders')->insert($pay_data);
                $id = DB::getPdo()->lastInsertId();
                $notification_data = [
                    'sender_id'=>Auth::user()->id, // sender id as a user id
                    'courses_id'=>$value,
                    'title'=>'רכישת קורס',
                    'message'=>'קורס חדש נרכש',
                    'type'=>'1',
                    'manual_id'=>$id
                ];
                
                
                DB::table('notifications')->insert($notification_data);                
                if(!empty($request->coupon_code_hidden)){
                    $User = User::where('reffer_code',$request->coupon_code_hidden)->pluck('id');
                    $second_user_notification_data = [
                        'sender_id'=> $User[0],
                        'courses_id'=>$value,
                        'title'=>'קוד הקופון שלך משומש',
                        'message'=>$request->first_name." קוד הקופון שלך משמש על ידי",
                        'type'=>'2'
                        ];
                    DB::table('notifications')->insert($second_user_notification_data);
                }
                
                //if status active ends
                //insert start
                if($insert){
                    $card_reffer = session()->get('cart.refer');
                    if($card_reffer){
                        
                        // For using reffer code assign 10% discunt to refferal user
                        $refferal_data = array(
                            'refferal_code' => $card_reffer['refferal_code'],   
                            'reffered_by' => $card_reffer['reffered_by'],
                            'reffered_to' =>   Auth::user()->id,
                            'discount_value' => $card_reffer['discount_value'], 
                            'status' => 1 // status = 1 means code is used.     
                        );
                        referrals::create($refferal_data);    
                        
                        $affiliate = new Affiliate();
                        $affiliate->user_id = $card_reffer['reffered_by'];
                        $affiliate->refferal_by =  Auth::user()->id;
                        $affiliate->discount = $card_reffer['discount_value'];
                        $affiliate->status = '0';
                        $affiliate->save();
                    }
                    
                    $notify = new AdminNotification();
                    $notify->user_id = Auth::user()->id;
                    $notify->read_notification = 0;
                    $notify->content = "זה עתה רכש קורס ".Auth::user()->first_name;
                    $notify->save();
                    
                    $courses_id = cartItems::select('course_id')->where('user_id',Auth::user()->id)->get();
                    cartItems::whereIn('course_id',$courses_id)->delete();

                    // $check_for_first_order = orders::select('*')->where('user_id',Auth::user()->id)->count();
                    // if($check_for_first_order == 1){
                    //     $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                    //     $res = "";
                    //     for ($i = 0; $i < 10; $i++) {
                    //         $res .= $chars[mt_rand(0, strlen($chars)-1)];
                    //     }
                    //     $refferal_data = array(
                    //         'refferal_code' => $res,
                    //         'reffered_by' => Auth::user()->id,
                    //         'discount_value' => 10,
                    //         'status' => 0 //is code used or not for status = 0 means code not used.
                    //     );
                    //     $data['code'] = $res;
                    //     $insert1 = DB::table('referrals')->insert($refferal_data);   

                    // }
                    session()->forget('cart');
                    Session::flash('message', "Booking accepted and payment has been initiated.");
                            $data['status'] = 1;
                    $count = $count + 1;
                }
                        //insert end
                else {
                        $data['msg'] = $this->response->responseServerError();
                        $data['status'] = 0;
                    }//check for customer ends
                
                }}
                //try end
                //catch start
                catch (Exception $e) {
                    $data['msg'] = $e->getMessage();
                    $data['status'] = 0;
                } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                    $data['msg'] = $e->getMessage();
                    $data['status'] = 0;
                } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                    $data['msg'] = $e->getMessage();
                    $data['status'] = 0;
                }
                //catch end
                return response()->json(['success' => true,'value' => $data]);
        } //validator check ends 
        else{ //else for validator
            $data['status'] = 0;
            $data['msg'] = '';
            return response()->json(['error'=>$validator->errors(),'value' => $data]);
        }
    }

}


