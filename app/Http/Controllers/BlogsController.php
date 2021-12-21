<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Blog;
use App\Models\viewhistory;
use App\Models\categories;
use App\Models\blog_comments;
use App\Models\Instructors;
use Illuminate\Support\Facades\DB;
use App\Models\detail_blog_contents;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BlogsController extends Controller
{
    public function loadDataAjax(Request $request)
    {
        $results = Blog::orderBy('id')->paginate(6);
        $categories = categories::all();
        $output = '';
        foreach ($results as $blog_data) {
            $slug = Str::slug($blog_data->slug, '-');   
            Blog::where('id', $blog_data->id)->update(array('slug' => $slug));
        }
        if ($request->ajax()) {
            foreach ($results as $result) {
                $image =  asset('/assets/images/' .$result->image);                 
                $output .= '<div class="col-md-4">
                    <div class="blog_grid_post blog_image">
                  <div class="thumb">
                    <img class="img-fluid" src="'.$image.'" alt="">
                    </div>
                    <div class="details">
                        <a href="'.route('front.blog.show',['slug' => $result->slug]).'">'.substr($result->title,0,60).'</a>';
                            $comment_count = 0;
                  $blog_comments = DB::table('blog_comments')->where('blog_id',$result->id)->where('status',1)->get();
                  $comment_count = sizeof($blog_comments);
                            
                   $output .= '
                   <ul class="post_meta">
                      <li><span class="ti-user"></span></li>
                      <li><span></span></li>
                      <li><span class="ti-comments"></span></li>';
                      $output .= '
                      <li><span>'.$comment_count.' הערות</span></li>
                      </ul>
                    <span class="readingtime">משך זמן הקריאה הוא '.$result->reading_time.' mins</span>
                                    <p>'.$result->content.'</p>
                </div>
              </div>
                </div>
                      ';
            }
            return $output;
        }
        return view('includes.blog',compact('categories','results'));
    }

	public function getBlogsByCat(Request $request){
		$output = '';
        $results = Blog::where('category_id',$request->input('id'))->get();	

		if($results){
		foreach ($results as $result) {
			if (strlen($result->content) > 100){
				$blog_content = Str::limit($result->content, 100). '...';
			}else{
				$blog_content = $result->content;
			}
			$image =  asset('/assets/images/' .$result->image);                 
			$output .= '<div class="col-md-4">
				<div class="blog_grid_post blog_image">
			  <div class="thumb">
				<img class="img-fluid" src="'.$image.'" alt="">
				</div>
				<div class="details">
					<a href="'.route('front.blog.show',['slug' => $result->slug]).'">'.substr($result->title,0,60).'</a>';
						$comment_count = 0;
			  $blog_comments = DB::table('blog_comments')->where('blog_id',$result->id)->where('status',1)->get();
			  $comment_count = sizeof($blog_comments);
						
			   $output .= '
			   <ul class="post_meta">
				  <li><span class="ti-user"></span></li>
				  <li><span></span></li>
				  <li><span class="ti-comments"></span></li>';
				  $output .= '
				  <li><span>'.$comment_count.' הערות</span></li>
				  </ul>
				<span class="readingtime">משך זמן הקריאה הוא '.$result->reading_time.' דקות</span>
								<p>'.$blog_content.'</p>
								
				<a href='.route("front.blog.show",["slug" => $result->slug]).'>Read More</a>
			</div>
		  </div>
			</div>
				  ';
		}
		}else{
			$output .= "No more records found";
		}
		return $output;		
	}
	
    public function getBlogs(Request $request)
    {
        $blog_data = array();
        $category_id = $request->id;
        $blogs = DB::table('blogs')->where('category_id',$category_id)->paginate(1);
        return view('includes.blogs-paginate', compact('blogs','category_id'))->render();
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showBlog($slug)
    {
        $blog_comment = array();
        $blog = Blog::select('*')->where('slug',$slug)->get();
        foreach ($blog as $value) {
            $this->createviewhistory($value->id);
            $id = $value->id;
            $instructor_id = $value->instructor_id;
            $blog_contents = json_decode($value->details);
        }
        $instructor_data = Instructors::select('*')->where('id',$instructor_id)->get();;
        $categories = categories::all();
        $blog_comment = blog_comments::select('*')->where('blog_id',$id)->where('status',1)->take(3)->get();
        return view('includes.blog-detail',compact('blog','blog_contents','categories','instructor_data','blog_comment'));
    }

    public function addcomments(Request $request){

        $blog_comments = new blog_comments;
        $blog_comments->blog_id = $request->blog_id;
        $blog_comments->category_id = $request->category_id;
        $blog_comments->comment = $request->comments;
        // $blog_comments->user_id = Auth::user()->id;
        $blog_comments->save();
        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listBlogs(Request $request)
    {
        $blog_data = array();
        $category_id = $request->id;
        $blog_data = Blog::select('*')->where('category_id',$category_id)->get();
        $html = '';
        foreach ($blog_data as $blog) { 
            $url =   route('front.blog.show',['slug' => $blog->slug]);
            $html .='<li><a href="'.$url.'">'.$blog->title.'</a></li>';         
        } 
        echo $html;
        die;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showbloginstructor(Request $request)
    {
        $Instructor_id = $request->id;
        $instructors_data = Instructors::find($Instructor_id);
        return response()->json(['success' => true, 'instructors_data' => $instructors_data]);
    }

    public function createviewhistory($data){
      $count = 1;
        $views_blog = viewhistory::select('*')->where('blog_id',$data);
        
        if(($views_blog->count()) > 0 ){

          $count++;
          DB::table('viewhistories')->where('blog_id',$data)->update(['views' => $count]);
        }else{
           $view_blog = new viewhistory;
          $view_blog->blog_id = $data;
          $view_blog->date = date('d:m:y');
          $view_blog->views = $count;
          $view_blog->save();
        }
    }

}
