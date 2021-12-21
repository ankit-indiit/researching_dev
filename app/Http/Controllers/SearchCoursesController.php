<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Course;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Models\coursematerial;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SearchCoursesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search_courses($idss=array(),$type)
    {
        $courses_data = array();
        $selected_degrees = explode(',',$idss);
        if($type == 0){
            $courses_data[] = Course::select('*')->whereIn('degree_id',$selected_degrees)->get();
            $type = $type;
        }
        if($type == 1){
            $courses_data[] = Course::select('*')->whereIn('course_id',$selected_degrees)->get();
            $type = $type;
        }
        $courses = $this->paginate($courses_data);
        return view('includes.search-courses',compact('courses','type'));
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function paginate($items, $perPage = 1, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
    
    
}
