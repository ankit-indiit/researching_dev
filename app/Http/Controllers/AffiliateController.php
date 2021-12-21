<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AffiliateController extends Controller
{
    public function index()
    {
        $all_refferels = Affiliate::where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('includes.affiliate',compact('all_refferels'));
    }
}
