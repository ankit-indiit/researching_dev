<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use DB;
use App\Models\Blog;
use App\Models\categories;
use App\Models\blog_comments;
use App\Models\Instructors;
use App\Models\admins;
use App\Models\viewhistory;
use App\Models\detail_blog_contents;
use App\Models\User;
use App\Models\Degrees;
use App\Models\chatbox;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class ApplicationController extends Controller
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
    
    public function application(){
        $all_from_users = [];
        $chats =[];

        $archive_chats = [];
        $all_users = [];
        $chat = chatbox::select('*')->where('status' ,'!=', 2)->where('status' ,'!=', 3)->get();
        foreach ($chat as $key => $user) {
            $userid = $user->user_id;

            if(!in_array($userid,$all_from_users)){
                array_push($all_from_users,$userid);
                array_push($chats,$user);
            }
        }
        $archive_chat = chatbox::select('*')->where('status',2)->orwhere('status',3)->get();
        foreach ($archive_chat as $key => $users) {
            $userId = $users->user_id;

            if(!in_array($userId,$all_users)){
                array_push($all_users,$userId);
                array_push($archive_chats,$users);
            }
        }
        return view('admin.applicationmanagement',compact('chats','archive_chats'));
    }

    public function viewapplication($id =""){
        $chat_data = chatbox::select('*')->where('id',$id)->get();
        foreach ($chat_data as $value) {
            $chat = $value;
           $user_id = $value->user_id;
           if($user_id != 0){
            $users_data = User::select('*')->where('id',$user_id)->get();
           }else{
            $users_data = '';
           }
        }
        $previous_chats = chatbox::select('*')->where('id','!=',$id)->where('user_id',$user_id)->get();
        return view('admin.applicationmanagement-detail',compact('chat','users_data','previous_chats'));
    }

    public function savesummary(Request $request){
        $summary = $request->summary;
        $remarks = $request->remarks;
        $chat_id = $request->chat_id;
        $chats = chatbox::findOrFail($chat_id);
        $chats->summary = $summary;
        $chats->remarks = $remarks;
        $chats->save();
        return response()->json(['success' => true]);
    }

    public function addapplication(){
        $users_list = User::select('*')->get();
        return view('admin.addapplication',compact('users_list'));
    }

    public function saveapp(Request $request){

        $chatboxes = new chatbox;
        $validator = Validator::make($request->all(),  [
             'title' => 'required',
             'selected_user' => 'required',
             'uploadfile' => 'required',
             'content' => 'required'
         ]);
        if ($validator->passes()) {
        if ($request->hasFile('uploadfile')) {
            $imagePath = $request->file('uploadfile');
            $imageName = $imagePath->getClientOriginalName();

            $path = $request->file('uploadfile')->storeAs('uploadschats', $imageName, 'public');
        }
        $chatboxes->uploadfile = $imageName.'/storage/'.$path;;
        $chatboxes->title = $request->title;
        $chatboxes->body = $request->content;
        $chatboxes->email = '';
        $chatboxes->user_id = $request->selected_user;
        $id = $chatboxes->save();
        Session::flash('message', ' המשתמש נוסף בהצלחה. ');
        return response()->json(['success' => true]);
         }else{
        return response()->json(['error'=>$validator->errors()]);
    }
     }

    public function updateappstatus(Request $request){
        $id = $request->chat_id;
        $chats = chatbox::findOrFail($id);
        $data['status'] = 0;
        if($request->status != ''){
            $chats->status = $request->status;
            $chats->save();
            $data['status'] = 1;
        }
        return response()->json(['success' => true,'data' => $data]);
    }

    public function update_manager(Request $request){
        $id = $request->chat_id;
        $chats = chatbox::findOrFail($id);
        $data['status'] = 0;
        if($request->instructor_id != ''){
            $chats->manager_id = $request->instructor_id;
            $chats->save();
            $data['status'] = 1;
        }
        return response()->json(['success' => true,'data' => $data]);
    }

    public function deletechat(Request $request)
    {
        $id = $request->deleted_id;
            $chats = chatbox::findOrFail($id);
            $chats->delete();
            $data['status'] = 1;
            $data['msg'] ='deleted'; 
      return json_encode($data);  
    }

    public function revertchat(Request $request)
    {
        $id = $request->reverted_id;
            $chats = chatbox::findOrFail($id);
            $chats->status = 0;
            $chats->save();
            $data['status'] = 1;
            $data['msg'] ='reverted'; 
      return json_encode($data);  
    }
}
