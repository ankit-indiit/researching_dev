<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Course;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        $courses_data = Course::all();
        return view('admin.packages',compact('packages','courses_data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),  [
            'package_name' => 'required',
            'package_description' => 'required',
            'package_price' => 'required|numeric',
            'course_name' => 'required',
        ]);
        if ($validator->passes()) 
        {
            $package = new Package();
            $package->package_name	= $request->package_name;
            $package->description =  $request->package_description;
            $package->price =  $request->package_price;
            $package->status =  $request->package_status;
            if($request->hasFile('package_image')) {
                $file = $request->file('package_image') ;
                $destinationPath = public_path().'/assets/packages/';
                $filename = $file->getClientOriginalName();
                $file->move($destinationPath, $filename);
                $package->image = $filename ;
            }         
            $package->course_id = implode(",",$request->course_name);   
            $package->save();
            Session::flash('message', ' המשתמש נוסף בהצלחה. ');
            return response()->json(['success' => true]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()]);
        }        
    }

    public function packageDelete($id)
    {
        $package = Package::where('package_code',$id)->delete();
        return redirect()->back();        
    }

    public function packageCourseDelete(Request $request)
    {
        $id = $request->deleted_id;
        $package_id = $request->package_id;
        $package = Package::select('*')->where('package_code',$package_id)->get();
        foreach ($package as $value) {
            $courses_id = explode(",",$value->course_id);
            if (($key = array_search($id, $courses_id)) !== false) {
                unset($courses_id[$key]);
            }
        }
        $courses_id =  implode(",",$courses_id);
        $affectedRows = Package::where('package_code', $package_id)->update(array('course_id' => $courses_id));
        $data['status'] = 1;
        $data['msg'] ='deleted'; 
        return json_encode($data);  
    }

    public function packageUpdate(Request $request)
    {
        if($request->edit_package_code){
            $package = array();
            $package['package_code']	= $request->edit_package_code;
            $package['package_name']	= $request->edit_package_name;
            $package['description'] =  $request->edit_package_description;
            $package['price'] =  $request->edit_package_price;
            $package['status'] =  $request->edit_package_status;
            Package::Where('package_code',$request->edit_package_code)->update($package);
            return redirect()->back(); 
        }
    }

    public function getPackage(Request $request)
    {
        $package_id = $request->id;
        $package = Package::where('package_code', $package_id)->first();
        return response()->json(['success' => true, 'package' => $package]);
    }

    public function packageAddCourse(Request $request)
    {
        $package_id = $request->course_group_id;
        $course = $request->course_name;
        $affectedRows = Package::where('package_code', $package_id)->first();
        $previous_data = $affectedRows->course_id;
        if($previous_data){
            $previous_data_arr = explode(",",$previous_data);
            $all_courses = array_unique(array_merge($previous_data_arr,$course));
            $courses = implode(",",$all_courses);
        }else{
            $courses = implode(",",$course);
        }
        Package::where('package_code', $package_id)->update(['course_id'=> $courses]);
        Session::flash('message', ' המשתמש נוסף בהצלחה. ');
        return response()->json(['success' => true]);
    }
}
