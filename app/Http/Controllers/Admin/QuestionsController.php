<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use DB;
use App\Models\admins;
use App\Models\Blog;
use App\Models\questions;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class QuestionsController extends Controller
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
            return redirect()->route('admin.adminLogin');
        }
    }
    
    public function listing(){
        $questions = questions::select('*')->get();
        return view('admin.question',compact('questions'));
    }  

    public function addquestions(){
        $blogs  = Blog::where('status',1)->get();
        return view('admin.addquestion',compact('blogs'));
    }
    public function savequestions(Request $request){
        $questions = new questions;
        $validator = Validator::make($request->all(),  [
             'question_title' => 'required',
             'short_desc' => 'required',
        ]);
        if ($validator->passes()) {
        $questions->title = $request->question_title;
        $questions->short_desc = $request->short_desc;
        $questions->blog_id = $request->question_blog;
        $questions->save();
        Session::flash('message', ' המשתמש נוסף בהצלחה. ');
        return response()->json(['success' => true]);
         }else{
        return response()->json(['error'=>$validator->errors()]);
    }
}
    public function editquestions($id=""){
        $questions = questions::select('*')->where('id',$id)->get();
        $blogs  = Blog::where('status',1)->get();
        $question = array();
        foreach ($questions as $value) {
            $question = $value;
        }
        return view('admin.editquestion',compact('question','blogs'));
    }

    //function to update user profile.
    public function updatequestions(Request $request)
    {
        $id = $request->question_id;
        $question = questions::findOrFail($id);
        $validator = Validator::make($request->all(),  [
             'edit_title' => 'required',
             'edit_shrtdesc' => 'required',
         ]);
       
        if ($validator->passes()) {
        $question->title = $request->edit_title;
        $question->short_desc = $request->edit_shrtdesc;
        $question->blog_id = $request->question_blog;
        $question->save();
        Session::flash('message', ' עריכת המשתמש בהצלחה  ');
        return response()->json(['success' => true]);
         }else{
        return response()->json(['error'=>$validator->errors()]);
    }
        
    }

    public function deletequestions(Request $request)
    {
        $id = $request->deleted_id;
            $questions = questions::findOrFail($id);
            $questions->delete();
            $data['status'] = 1;
            $data['msg'] ='deleted'; 
        return json_encode($data);  
    }
}
