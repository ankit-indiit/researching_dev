<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use DB;
use App\Models\admins;
use App\Models\User;
use App\Models\Course;
use App\Models\Universities;
use App\Models\Degrees;
use App\Models\userlogs;
use App\Models\grouped_courses;
use App\Models\events;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class EventsController extends Controller
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
    
    public function listings(){
        $events_data = events::select('*')->get();
        return view('admin.events',compact('events_data'));
    }


    public function addevent(){
        return view('admin.addevent');
    } 

    public function saveevent(Request $request){
        $events = new events;
        $validator = Validator::make($request->all(),  [
             'eventname' => 'required',
             'zoomlink' => 'required',
             'imageName' => 'required',
             'description' => 'required',
             'selected_date' => 'required',
             'selected_time' => 'required',
         ]);

       if ($validator->passes()) {
          if($request->imageName) {
            $events->image = $request->imageName ;
          }
        $events->eventName = $request->eventname;
        $events->zoomLink = $request->zoomlink; 
        $events->description = $request->description; 
        $events->eventTime = $request->selected_time; 
        $events->eventDate = $request->selected_date;  
        $events->save();
        return response()->json(['success'=>true]);
    }
        return response()->json(['error'=>$validator->errors()]);
    }

    public function editevent($id=""){
        $event_data = array();
        $events_data = events::select('*')->where('id',$id)->get();
        foreach ($events_data as $value) {
            $event_data = $value;
        }
        return view('admin.editevent',compact('event_data'));
    }

    //function to update user profile.
    public function updateevent(Request $request)
    {
        $id = $request->id;
        $events = events::findOrFail($id);
        $validator = Validator::make($request->all(),  [
             'eventname' => 'required',
             'zoomlink' => 'required',
             'imageName' => 'required',
             'selected_date' => 'required',
             'selected_time' => 'required'
         ]);
       
        if ($validator->passes()) {
            if($request->imageName) {
            $events->image = $request->imageName ;
          }        
        $events->eventName = $request->eventname;
        $events->zoomLink = $request->zoomlink;
        $events->description = $request->description;
        $events->eventTime = $request->selected_date;
        $events->eventDate = $request->selected_time;
        $events->save();
        Session::flash('message', ' עריכת המשתמש בהצלחה  ');
        return response()->json(['success' => true]);
         }else{
        return response()->json(['error'=>$validator->errors()]);
    }
        
    }
    
    public function viewevent($id = "")
    {
        $courses_data = Course::select('*')->where('event_id',$id)->get();
        $groups = grouped_courses::select('*')->where('event_id',$id)->get();
        return view('admin.eventcoursedetail',compact('courses_data','groups'));  
    }

    public function addeventcourses($id ="")
    {
        $courses_data = Course::select('*')->get();
        $groups = grouped_courses::select('*')->get();
        return view('admin.addcourses',compact('courses_data','groups','id'));  
    }

    public function addeventcourse(Request $request)
    {
        $type = $request->type;
        if($type == '0'){
            $coursids = $request->courses;
            foreach ($coursids as $key => $value) {
                $affectedRows = Course::where('course_id', $value)->update(array('event_id' => $request->event_id));
            }
        }else{
            $coursids = $request->courses;
            foreach ($coursids as $key => $value) {
                $affectedRows = grouped_courses::where('id', $value)->update(array('event_id' => $request->event_id));
            }
        }
        return response()->json(['success' => true]);
          
    }

    public function deleteevent(Request $request)
    {
            $id = $request->deleted_id;
            DB::table('events')->where('id', $id)->delete();
            $data['status'] = 1;
            $data['msg'] ='deleted'; 
            return json_encode($data);  
    }

    public function deletecourseevent(Request $request)
    {
            $id = $request->deleted_id;
            DB::table('courses')->where('course_id', $id)->update(array('event_id' => ''));
            $data['status'] = 1;
            $data['msg'] ='deleted'; 
            return json_encode($data);  
    }

    public function deletegroupevent(Request $request)
    {
            $id = $request->deleted_id;
            DB::table('grouped_courses')->where('id', $id)->update(array('event_id'=>''));
            $data['status'] = 1;
            $data['msg'] ='deleted'; 
            return json_encode($data);  
    }
    
}
