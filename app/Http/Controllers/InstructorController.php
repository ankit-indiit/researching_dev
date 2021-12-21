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

class InstructorController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructors = DB::table('instructors')->paginate(4);
        return view('includes.instructor',compact('instructors'));
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
        return response()->json(['success' => true, 'instructors_data' => $instructors_data]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_instructor_detail()
    {
        // $Instructor_id = $id;
        // $instructors_data = Instructors::find($Instructor_id);
        return view('includes.instructor-detail');
    }
}
