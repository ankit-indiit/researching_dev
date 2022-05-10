<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Course;
use App\Models\Instructors;
use App\Models\orders;
use App\Models\coursematerial;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CoursesMaterialController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storedocs(Request $request)
    {
        $file = new coursematerial;

        if ($request->file('uploadfile')) {
            $imagePath = $request->file('uploadfile');
            $imageName = $imagePath->getClientOriginalName();

            $path = $request->file('uploadfile')->storeAs('uploads', $imageName, 'public');
        }

        $file->name = $imageName;
        $file->file_path = '/storage/'.$path;
        $file->course_id = $request->docs_course_id;
        $file->save();
        return response()->json(['success' => true]);
    }
    
    
    public function stroedata(Request $request){
        $coursematerial =  new coursematerial;
        $input = $request->all();
        $coursematerial->name = $input['original_image_name'];
        $coursematerial->file_path = '/assets/courseMaterials/'.$input['courseMaterialimg'];
        $coursematerial->course_id = $input['docs_course_id'];
        $coursematerial->save();
        return response()->json(['success' => true]);
    }
}