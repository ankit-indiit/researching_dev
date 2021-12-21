<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Course;
use App\Models\Instructors;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AboutusController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructors = DB::table('instructors')->get();
        $aboutuses  =  DB::table('aboutuses')->get();
        return view('includes.about-us',compact('instructors','aboutuses'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_details(Request $request)
    {
        $Instructor_id = $request->id;
        $instructors_data = Instructors::find($Instructor_id);
        $recomendations = $instructors_data->recomendations;
        $recomendation_data = [];
        foreach($recomendations as $key => $recomendation){
            $recomendation_data[$key]['recomendation'] = $recomendation;
            $recomendation_data[$key]['user'] = $recomendation->user;
            $recomendation_data[$key]['university'] = $recomendation->user->universities;
            $recomendation_data[$key]['degree'] = $recomendation->user->degree; 
        }
        return response()->json(['success' => true, 'instructors_data' => $instructors_data, 'recomendations'=>$recomendation_data]);
    }
}
