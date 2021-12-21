<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Blog;
use App\Models\Course;
use App\Models\cartItems;
use App\Models\orders;
use App\Models\Package;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BuynowController extends Controller
{
    //function to remove items from cart and db also.
    public function buyCourse($type,$courseid)
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
           $courses = Course::select('*')->where('course_id',$courseid)->get(); 
           foreach ($courses as $course) {
                $cart = session()->get('cart.items');
                // if item not exist in cart then add to cart with quantity = 1
                if(!$cart) {
                $cart = [
                    $courseid => [
                        "name" => $course->course_name,
                        "quantity" => 1,
                        "price" => $course->price,
                        "photo" => $course->image,
                        "description" => $course->description,
                        "course_id" => $courseid,
                        "user_id" => $userid,
                        "item_type" => 0
                    ]
                ];
                session()->put('cart.items', $cart);
            }
            // if item not exist in cart then add to cart with quantity = 1
                $cart[$courseid] = [
                    "name" => $course->course_name,
                    "quantity" => 1,
                    "price" => $course->price,
                    "photo" => $course->image,
                    "description" => $course->description,
                    "course_id" => $courseid,
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
                return redirect()->route('front.display.cart', ['id' => $userid ]); 
            }
        }else{
            $packages = Package::select('*')->where('package_code',$courseid)->get();
            foreach ($packages as $package) {
                $cart = session()->get('cart.items');
                // if item not exist in cart then add to cart with quantity = 1
                if(!$cart) {
                $cart = [
                    $courseid => [
                        "name" => $package->package_name,
                        "quantity" => 1,
                        "price" => $package->price,
                        "photo" => $package->image,
                        "description" => $package->description,
                        "package_id" => $courseid,
                        "user_id" => $userid,
                        "item_type" => 1
                    ]
                ];
                session()->put('cart.items', $cart);
            }
            // if item not exist in cart then add to cart with quantity = 1
                $cart[$courseid] = [
                    "name" => $package->package_name,
                    "quantity" => 1,
                    "price" => $package->price,
                    "photo" => $package->image,
                    "description" => $package->description,
                    "package_id" => $courseid,
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
                return redirect()->route('front.display.cart', ['id' => $userid ]);   
            }
       }
    }
}
