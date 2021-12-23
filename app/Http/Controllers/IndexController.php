<?php

namespace App\Http\Controllers;

use App\Models\Universities;
use App\Models\Option;
use App\Models\grouped_courses;
use App\Models\Homepage;
use Illuminate\Support\Facades\Auth;
use App\Models\recommendations;

class IndexController extends Controller
{

    public function index()
    {
        $universities = Universities::where('active',1)->get();
        $data = Universities::with('degrees')->get();
        $online_recommendation = recommendations::select('*')->where('type','online_recommendation')->get()->toArray();
        $homepage = Homepage::find(1);
        return view('includes.index',compact('universities','data','online_recommendation','homepage'));
    }

    public function getWhatsappLink($id)
    {
        $all_groups = grouped_courses::where('courseIds','like', '%"'.$id.'"%')->get();
        return json_encode($all_groups); 
    }

}
