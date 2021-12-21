<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use DB;
use App\Models\Course;
use App\Models\admins;
use App\Models\Instructors;
use App\Models\Degrees;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class InstructorsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $is_logged_in = Session::get('admin_logged_in');
        if(!isset($is_logged_in) && $is_logged_in != '1'){
            Auth::logout();
            return redirect()->route('admin.adminLogin');
        }
    }
    
    public function listing(){
        $degrees = array();
        $universities = array();
        $instructors_data = Instructors::select('*')->get();
        return view('admin.instructor',compact('instructors_data'));
    }


    public function addinstructor(){
        return view('admin.addinstructor');
    } 

    public function saveinstructor(Request $request){
        $instructor = new Instructors;
        $validator = Validator::make($request->all(),  [
             'instructor_fname' => 'required',
             'instructor_lname' => 'required',
             'instructor_email' => 'required|email',
             'instructor_phoneno' => 'required',
             'addinst_university' => 'required',
             'addinst_degree' => 'required',
             'instructor_destiny' => 'required',
             'instructor_address' => 'required',
             'instructor_desc' => 'required',
             'instructor_qualification' => 'required',

         ]);
       
         if ($validator->passes()) {
            if($request->hasFile('user-img')) {
            $file = $request->file('user-img') ;
            $destinationPath = public_path().'/assets/users/';
            $filename = $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
            
            $instructor->avatar = $filename ;
        }
        $course_ids = Course::select('*')->where('degree_id',$request->addinst_degree)->pluck('course_id')->toArray();
        $course_ids = implode(',',$course_ids);
        $instructor->first_name = $request->instructor_fname;
        $instructor->last_name = $request->instructor_lname;
        $instructor->email = $request->instructor_email;
        $instructor->university = $request->addinst_university;
        $instructor->degree = $request->addinst_degree;
        $instructor->contact_number = $request->instructor_phoneno;
        $instructor->instructor_course_id = $course_ids;
        $instructor->about = $request->instructor_desc;
        $instructor->address = $request->instructor_address;
        $instructor->destiny = $request->instructor_destiny;
        $instructor->insta_link = $request->instagram_link;
        $instructor->facebook_link = $request->facebook_link;
        $instructor->whatspp_link = $request->whatsapp_link;
        $instructor->linkedin_link = $request->linkedin_link;
        $instructor->qualification = $request->instructor_qualification;
        $instructor->save();
        Session::flash('message', ' המדריך נוסף בהצלחה. ');
        return response()->json(['success' => true]);
         }else{
        return response()->json(['error'=>$validator->errors()]);
    }
    }

    public function editinstructor($id=""){
        $get_id = $id;
        $degree_id = '';
        $degree_name = '';
        $instructors_data = Instructors::select('*')->where('id',$get_id)->get();
        foreach ($instructors_data as $instructors) {
            $instructor = $instructors;
            $degrees_id = $instructors->degree;
        }
        if(!empty($degrees_id)){
            $degree_id = $degrees_id[0];
            $degrees_name = Degrees::select('*')->where('id',$degrees_id[0])->pluck('degree_name');
            $degree_name = $degrees_name[0];
        }
        return view('admin.editinstructor',compact('instructor','degree_id','degree_name'));
    }

    //function to update user profile.
    public function updateinstructor(Request $request)
    {
        $id = $request->instructor_id;
        $instructor = Instructors::findOrFail($id);
        $validator = Validator::make($request->all(),  [
             'instructor_fname' => 'required',
             'instructor_lname' => 'required',
             'instructor_email' => 'required|email',
             'instructor_phoneno' => 'required',
             'instructor_university' => 'required',
             'instructor_degree' => 'required',
             'instructor_designation' => 'required',
             'instructor_address' => 'required',
             'instructor_qualification' => 'required',
             'instructor_desc' =>'required'
         ]);
       
        if ($validator->passes()) {
            if($request->hasFile('user-img')) {
            $file = $request->file('user-img') ;
            $destinationPath = public_path().'/assets/users/';
            $filename = $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
            
            $instructor->avatar = $filename ;
        }
        $instructor->first_name = $request->instructor_fname;
        $instructor->last_name = $request->instructor_lname;
        $instructor->email = $request->instructor_email;
        $instructor->contact_number = $request->instructor_phoneno;
        $instructor->about = $request->instructor_desc;
        $instructor->address = $request->instructor_address;
        $instructor->destiny = $request->instructor_designation;
        $instructor->university = $request->instructor_university;
        $instructor->degree = $request->instructor_degree;
        $instructor->qualification = $request->instructor_qualification;
        $instructor->insta_link = $request->instagram;
        $instructor->facebook_link = $request->facebook_link;
        $instructor->whatspp_link = $request->whatsapp_link;
        $instructor->linkedin_link = $request->linkedin_link;
        $instructor->save();
        return response()->json(['success' => true]);
         }else{
        return response()->json(['error'=>$validator->errors()]);
    }
        
    }

    public function deleteinstructor(Request $request)
    {
      if($request->password != ''){
        $admin_id = session()->get('id');
        $id = $request->deleted_id;
        $check_login = admins::select('*')->where('status',1)->where('id', $admin_id)->first();
         if(!empty($check_login)){
          if (Hash::check($request->password, $check_login->password)) {
            $instructor = Instructors::findOrFail($id);
            $instructor->delete();
            $data['status'] = 1;
            $data['msg'] =' נמחק ';
          }else{
            $data['status'] = 0;
            $data['msg'] = ' הסיסמה לא התאימה. ';
          }
         }else{
          $data['status'] = 0;
          $data['msg'] = ' משתמש לא מחובר. ';
         }
      }else{
        $data['status'] = 0;
        $data['msg'] = ' אנא הזן סיסמה. ';
      } 
      return json_encode($data);  
    }
    
}
