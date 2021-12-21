<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use DB;
use App\Models\admins;
use App\Models\User;
use App\Models\Degrees;
use App\Models\Universities;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ProductCategoryController extends Controller
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
        $universities = Universities::select('*')->get();
        return view('admin.institution',compact('universities'));
    }


    public function addproductcategory(){
        return view('admin.addinstitution');
    } 

    public function saveproductcategory(Request $request){
        $Universities = new Universities;
        $validator = Validator::make($request->all(),  [
             'institute_name' => 'required',
         ]);
        
        if ($validator->passes()) {
          if($request->imageName) {
            $Universities->logo = $request->imageName ;
          }
          if($request->active) {
            $Universities->active = 1;
          }else{
            $Universities->active = '0';
          }
          $Universities->university_name = $request->institute_name; 
          $Universities->save();
          return response()->json(['success'=>true]);
        }else{
        return response()->json(['error'=>$validator->errors()]);
    }
    }

    public function editproductcategory($id=""){
        $university_id = $id;
        $university_data = Universities::select('*')->where('id',$id)->get();
        foreach ($university_data as $value) {
            $university_name = $value->university_name;
            $logo = $value->logo;
            $active = $value->active;
        }
        return view('admin.editinstitution',compact('university_name','logo','university_id','active'));
    }

    public function updateproductcategory(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make($request->all(),  [
             'university_name' => 'required'
         ]);
         if ($validator->passes()) {
        $university = Universities::findOrFail($id);
        if($request->imageName) {
            $university->logo = $request->imageName ;
        }
        if($request->active) {
          $university->active = 1;
        }else{
          $university->active = '0';
        }        
        $university->university_name = $request->university_name; 
        $university->save();
        return response()->json(['success'=>true]);
         }else{
        return response()->json(['error'=>$validator->errors()]);
    }
       
    }

    public function deleteproductcategory(Request $request)
    {
      if($request->password != ''){
        $admin_id = session()->get('id');
        $id = $request->deleted_id;
        $check_login = admins::select('*')->where('status',1)->where('id', $admin_id)->first();
         if(!empty($check_login)){
          if (Hash::check($request->password, $check_login->password)) {
            $university = Universities::findOrFail($id);
            $university->delete();
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

    public function uploadfiles(Request $request)
    {
        $file = $request->file('file');
        if(!empty($file)){
           //Move Uploaded File
           $destinationPath = public_path().'/assets/images/';
           $original_name = $file->getClientOriginalName();
           $file_name = str_replace(' ','_',time().$file->getClientOriginalName());
         
           if($file->move($destinationPath,$file_name)){
               $image_name = $file_name;
               $data['status'] = 1;
               $data['image_name'] = $image_name;
           }
           else{
               $data['status'] = 0;
           }
       }
       else{
           $data['status'] = 0;
       }
       return json_encode($data);
        
       
    }

    public function universityStatusUpdate(Request $request)
    {
      $university = Universities::findOrFail($request->id);
      $university->active = $request->active;
      $university->save();
    }

    
}
