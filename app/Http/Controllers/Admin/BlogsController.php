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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class BlogsController extends Controller
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
    
    public function listing(Request $request){
        $blogs_data = Blog::select('*')->get();
        if($request->category != '' && !empty($request->category)){
          $blogs_data = $blogs_data->where('category_id',$request->category);
        } 
        return view('admin.blogs',compact('blogs_data'));
    }


    public function addblog(){
        return view('admin.addblog');
    } 


    public function saveblog(Request $request){
        $blog_id = '';
        $blogs = new Blog;
        $title = [];
        $content = [];
        $data = [];
        $blog_content = new detail_blog_contents;
        $validator = Validator::make($request->all(),  [
             'texturl' => 'required',
             'title' => 'required',
             'startend' => 'required',
             'category' => 'required',
             'intro' => 'required',
             'texthead' => 'required',
             'author' => 'required',
             'status' => 'required',
             'references' => 'required'
         ]);
       
        if ($validator->passes()) {
          if($request->imageName) {
            $blogs->image = $request->imageName ;
        }
        $blogs->title = $request->title;
        $blogs->content = $request->intro; 
        $blogs->category_id = $request->category; 
        $blogs->instructor_id = $request->author; 
        $blogs->reading_time = $request->startend; 
        $blogs->references = $request->references; 
        $blogs->slug = $request->texturl; 
        $blogs->status = $request->status;  

        if($request->texthead != '' && $request->description != ''){
            foreach ($request->texthead as $key => $value) {
                $title[] = $value;
            }
            foreach ($request->description as $key => $value) {
                $content[] = $value;
            }
            $data = array_map(function ($title, $content) {
            return [
                'title' => $title,
                'content' => $content,
            ];
        }, $title, $content);
            $blogs->details = json_encode($data);

        }
        $blogs->save();

        Session::flash('message', ' המשתמש נוסף בהצלחה. ');
        return response()->json(['success' => true]);
         }else{
        return response()->json(['error'=>$validator->errors()]);
    }
    }

    public function editblog($id=""){

        $blog_id = $id;
        $edit_blog = '';
        $edit_blogs = Blog::select('*')->where('id',$blog_id)->get();
        foreach ($edit_blogs as $value) {
            $edit_blog = $value;
            $image = $value->image;
        }
        return view('admin.editblog',compact('edit_blog','image'));
    }

    //function to update user profile.
    public function updateblog(Request $request)
    {   
        $blog_id = '';
        $blogs = new Blog;
        $title = [];
        $content = [];
        $data = [];
        $id = $request->blog_id;
        $blogs = Blog::findOrFail($id);
        $validator = Validator::make($request->all(),  [
             'texturl' => 'required',
             'title' => 'required',
             'startend' => 'required',
             'category' => 'required',
             'intro' => 'required',
             'texthead' => 'required',
             'author' => 'required',
             'status' => 'required',
             'references' => 'required'
         ]);
       
        if ($validator->passes()) {
          if($request->imageName) {
            $blogs->image = $request->imageName ;
        }
        $blogs->title = $request->title;
        $blogs->content = $request->intro; 
        $blogs->category_id = $request->category; 
        $blogs->instructor_id = $request->author; 
        $blogs->reading_time = $request->startend; 
        $blogs->references = $request->references; 
        $blogs->slug = $request->texturl; 
        $blogs->status = $request->status;  

        if($request->texthead != '' && $request->description != ''){
            foreach ($request->texthead as $key => $value) {
                $title[] = $value;
            }
            foreach ($request->description as $key => $value) {
                $content[] = $value;
            }
            $data = array_map(function ($title, $content) {
            return [
                'title' => $title,
                'content' => $content,
            ];
        }, $title, $content);
            $blogs->details = json_encode($data);

        }
        $blogs->save();

        Session::flash('message', ' המשתמש נוסף בהצלחה. ');
        return response()->json(['success' => true]);
         }else{
        return response()->json(['error'=>$validator->errors()]);
    }
        
    }

    public function deleteblog(Request $request)
    {
        $id = $request->deleted_id;
         if($id != ''){
            $blogs = Blog::findOrFail($id);
            $blogs->delete();
            $data['status'] = 1;
            $data['msg'] =' נמחק ';
         }else{
          $data['status'] = 0;
          $data['msg'] = ' לא מצליח למחוק את הבלוג. ';
         } 
      return json_encode($data);  
    }

    public function categorylisting(){
        $categories_data = categories::select('*')->get();
        return view('admin.blog-category',compact('categories_data'));
    }

    public function savecategory(Request $request){
        $value = $request->add_value;
        if($value != ''){
            $categories = new categories;
            $categories->name = $value;
            $categories->save();
            $data['status'] = 1;
            $data['msg'] =' נמחק ';
         }else{
          $data['status'] = 0;
          $data['msg'] = ' לא יכול להיות מסוגל לשמור קטגוריה. ';
         }
     return json_encode($data);
    }


    //function to update user profile.
    public function editcategory(Request $request)
    {
        $id = $request->edit_id;
        $value = $request->edit_value;
        if($value != ''){
            $categories = categories::findOrFail($id);
            $categories->name = $value;
            $categories->save();
            $data['status'] = 1;
            $data['msg'] =' נמחק ';
         }else{
          $data['status'] = 0;
          $data['msg'] = ' לא יכול להיות מסוגל לערוך קטגוריה. ';
         }
     return json_encode($data);
        
    }

    public function deletecategory(Request $request)
    {
        $id = $request->deleted_id;
         if($id != ''){
            $categories = categories::findOrFail($id);
            $categories->delete();
            $data['status'] = 1;
            $data['msg'] =' נמחק ';
         }else{
          $data['status'] = 0;
          $data['msg'] = ' לא יכול להיות מסוגל למחוק קטגוריה. ';
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
            $thumb_img = Image::make($file->getRealPath())->resize(null,500,function ($constraint) {
           $constraint->aspectRatio();
         });
           if($thumb_img->save($destinationPath.'/'.$file_name,100)){
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
}
