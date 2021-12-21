<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use DB;
use App\Models\admins;
use App\Models\User;
use App\Models\Degrees;
use App\Models\Course;
use App\Models\Universities;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class DegreesController extends Controller
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
    
    public function listing($id = ''){
        $degrees = Degrees::select('*')->where('university_id',$id)->get();
        
        if(count($degrees)>0){
           foreach($degrees as $key=>$val){
               $val['id'];
               $checkDegreeAssigned = Course::select('*')->where('degree_id',$val['id'])->get();
               if(count($checkDegreeAssigned)){
                   $degrees[$key]['courseExists'] = "disabled";
               }else{
                   $degrees[$key]['courseExists'] = "";
               }
           }
        }
        $id = $id;
        return view('admin.degree',compact('degrees','id'));
    }

    public function deletedegree(Request $request)
    {
      if($request->password != ''){
        $admin_id = session()->get('id');
        $id = $request->deleted_id;
        $check_login = admins::select('*')->where('status',1)->where('id', $admin_id)->first();
         if(!empty($check_login)){
          if (Hash::check($request->password, $check_login->password)) {
            $checkDegreeAssigned = Course::select('*')->where('degree_id',$id)->get()->toArray();
            if(count($checkDegreeAssigned) > 0){
                $data['status'] = 0;
                $data['msg'] = 'אינך יכול למחוק תואר זה מכיוון שהוא קשור לקורס.';
                }
                else{
                $degree = Degrees::findOrFail($id);
                $degree->delete();
                $data['status'] = 1;
                $data['msg'] =' נמחק ';    
                }
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


    public function adddegrees($id=""){
        return view('admin.adddegree',compact('id'));
    } 


    public function savedegree(Request $request){
        $degree = new Degrees;
        $validator = Validator::make($request->all(),  [
             'degree_name' => 'required',
             'adddegree_university' => 'required',

         ]);
       
         if ($validator->passes()) {
            $degree->degree_name = $request->degree_name;
            $degree->University_id = $request->adddegree_university;
            $degree->save();
            Session::flash('message', ' תארים נוספו בהצלחה ');
            return response()->json(['success' => true]);
         }else{
            return response()->json(['error'=>$validator->errors()]);
    }
    }

    public function editdegrees($id=""){
        $degree_id = $id;
        $degree_data = array();
        $degrees_name = array();
        $degree_name = array();
        $degrees_data = Degrees::select('*')->where('id',$degree_id)->get();
        foreach ($degrees_data as $value) {
            $degree_data = $value;
        }
        return view('admin.editdegree',compact('degree_data','degree_id'));
    }

    //function to update user profile.
    public function updatedegree(Request $request)
    {
        $id = $request->degree_id;
        $degree = Degrees::findOrFail($id);
        $validator = Validator::make($request->all(),  [
             'degree_name' => 'required',
         ]);
       
        if ($validator->passes()) {
            
            $degree->degree_name = $request->degree_name;
            $degree->save();
            Session::flash('message', ' התארים עודכנו בהצלחה. ');
            return response()->json(['success' => true]);
         }else{
        return response()->json(['error'=>$validator->errors()]);
    }
        
    }
    
}
