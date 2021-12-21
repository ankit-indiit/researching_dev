<?php

namespace App\Http\Controllers;

use App\Models\Universities;
use App\Models\Option;
use App\Models\grouped_courses;
use Illuminate\Support\Facades\Auth;
use App\Models\recommendations;

class IndexController extends Controller
{

    public function index()
    {
        $universities = Universities::where('active',1)->get();
        $options = Option::where('name', "homepage_setting")->pluck('value')->first();
        $options = ($options) ? unserialize($options) : $options;
        $data = Universities::with('degrees')->get();
        $online_recommendation = recommendations::select('*')->where('type','online_recommendation')->get()->toArray();
        return view('includes.index',compact('universities','options','data','online_recommendation'));
    }

    public function getWhatsappLink($id)
    {
        $all_groups = grouped_courses::where('courseIds','like', '%"'.$id.'"%')->get();
        return json_encode($all_groups); 
    }

}
