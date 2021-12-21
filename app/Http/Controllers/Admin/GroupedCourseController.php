<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use DB;
use App\Models\admins;
use App\Models\User;
use App\Models\Degrees;
use App\Models\grouped_courses;
use App\Models\whatsapplinks;
use App\Models\userlogs;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class GroupedCourseController extends Controller
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
    
    public function groupedcourses(){
        $groups = grouped_courses::select('*')->get();
        return view('admin.groupedcourses',compact('groups'));
    }

    public function savegroup(Request $request){
        $group = new grouped_courses;
        $whatsapp_link = '';
        $validator = Validator::make($request->all(),  [
             'group_name' => 'required',
         ]);
        if ($validator->passes()) 
        {
            $data = $request->whatsapp_link;            
            $selected = json_encode($request->links);
            if($request->links){
                $group->whatsappLink = json_encode(array_column($request->links, 'whatsapp_link'));
                foreach($request->links as $key=>$link){
                    if(isset($link['is_selected'])){
                        $group->link_selected = $key;
                    }
                }
            }
            $group->groupName = $request->group_name;
            $group->save();
            Session::flash('message', ' המשתמש נוסף בהצלחה. ');
            return response()->json(['success' => true]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()]);
        }
    }

    public function editgroup(Request $request)
    {
        if($request->edit_group_id){
            $group = grouped_courses::find($request->edit_group_id);
            if($group){
                $validator = Validator::make($request->all(),  [
                     'edit_group_name' => 'required',
                 ]);
                if ($validator->passes()) 
                {
                    if($request->edit_links){
                        $group->whatsappLink = json_encode(array_column($request->edit_links, 'edit_whatsapp_link'));
                        foreach($request->edit_links as $key=>$link){
                            if(isset($link['is_edit_selected'])){
                                $group->link_selected = $key;
                            }
                        }
                    }
                    $group->groupName = $request->edit_group_name;
                    $group->update();
                    Session::flash('message', ' המשתמש נוסף בהצלחה. ');
                    return redirect()->back();
                }
                else
                {
                    return response()->json(['error'=>$validator->errors()]);
                }
            }
        }
    }

    public function deleteGroup($id)
    {
        grouped_courses::destroy($id);
        return redirect()->back();

    }

    public function addgroupcourse(Request $request, $id=""){
        $validator = Validator::make($request->all(),  [
             'course_name' => 'required',
         ]);
        if ($validator->passes()) {
            $affectedRows = grouped_courses::where('id', $id)->first();
            $previous_data = $affectedRows->courseIds;
            if($previous_data){
                $previous_data_arr = json_decode($previous_data);

                $all_courses = array_unique(array_merge($previous_data_arr,$request->course_name));
                $courses = json_encode($all_courses);
            }else{
                $courses = json_encode($request->course_name);
            }

            $affectedRows->courseIds = $courses;
            $affectedRows->update();
            Session::flash('message', ' המשתמש נוסף בהצלחה. ');
            return response()->json(['success' => true]);
        }else{
            return response()->json(['error'=>$validator->errors()]);
        }
    }

    public function editgroupcourse(Request $request, $id=""){
        $validator = Validator::make($request->all(),  [
             'courses_name' => 'required',
         ]);
        if ($validator->passes()) {
            $courses = implode(',', $request->courses_name);

            $affectedRows = grouped_courses::where('id', $id)->update(array('courseIds' => $courses));
            Session::flash('message', ' המשתמש נוסף בהצלחה. ');
            return response()->json(['success' => true]);
        }else{
            return response()->json(['error'=>$validator->errors()]);
        }
    }

    public function deletecourse(Request $request)
    {
        $id = $request->deleted_id;
        $group_id = $request->groups_id;
        $groups = grouped_courses::select('*')->where('id',$group_id)->get();
        foreach ($groups as $value) {
            $courses_id = json_decode($value->courseIds);
            if (($key = array_search($id, $courses_id)) !== false) {
                unset($courses_id[$key]);
            }
        }
        $courses_id =  json_encode($courses_id);
        $affectedRows = grouped_courses::where('id', $group_id)->update(array('courseIds' => $courses_id));
        $data['status'] = 1;
        $data['msg'] ='deleted'; 
        return json_encode($data);  
    }

    public function geteditdata(Request $request){
        $id = $request->id;
        $links = grouped_courses::select('*')->where('id',$id)->get();
        return response()->json(['success' => true, 'links' => $links]);

    }

}
    

