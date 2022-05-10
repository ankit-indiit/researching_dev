<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Course;
use App\Models\UserProgress;
use App\Models\orders;
use App\Models\Package;
use App\Models\Lectures;
use App\Models\question_answer;
use App\Models\Topics;
use App\Models\TopicElementsRepeat;
use App\Models\TopicQuiz;
use App\Models\TopicVideos;
use App\Models\TopicsPdf;
use App\Models\QuizAnswer;
use App\Models\TopicQuizQuestions;
use App\Models\quiz;
use App\Models\quiz_questions;
use Illuminate\Support\Facades\DB;
use App\Models\reviews;
use App\Models\Instructors;
use App\Models\MarathonOrder;
use App\Models\LastWatchedTopicElement;
use App\Models\UserCourseProgress;
use PDF;
use App\Models\coursematerial;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MyCoursesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $courseIdByChapters_arr = [];
        $reviews_data = array();
        $total_lectures = array();
        $courses_data = array();
        $orders_data = orders::select('*')->where('user_id',$user_id)->where('course_type','!=',3)->orderBy('id','DESC')->with('course')->get();
        $chapter_data = orders::select('*')->where('user_id',$user_id)->where('course_type',3)->orderBy('id','DESC')->with('chapter')->get();
        
        if(count($chapter_data) > 0){
            foreach($chapter_data as $key=>$val){
                $chapter_data[$key]['course'] = Course::where('course_id',$val->chapter->course_id)->first();
                $courseId = Topics::select('course_id')->where('id',$val['ordered_courses'])->first();
                array_push($courseIdByChapters_arr,$courseId['course_id']);
            }
        }
        
        $marathon_data = MarathonOrder::where('user_id',$user_id)->where('is_paid',1)->get();
        $size = count($orders_data);
        if($size != 0){
            foreach ($orders_data as $key => $order_data) {
                $coursesIds = explode(",", $order_data->ordered_courses);
                if(count($courseIdByChapters_arr)>0){
                    foreach(array_unique($courseIdByChapters_arr) as $k=>$v){
                        array_push($coursesIds,$v);
                    }
                }
                
                $courses_data[$key] = Course::select('*')->whereIn('course_id',$coursesIds)->get();
                foreach ($coursesIds as  $value) {
                    $lectures = Lectures::select('id')->where('course_id',$value)->get();
                    if (count(reviews::select('*')->where('course_id',$value)->pluck('rating')) > 0) {
                       $reviews_data[$key] = reviews::select('*')->where('course_id',$value)->pluck('rating');
                    } else {
                        $reviews_data[$key] = [];
                    }
                    $total_lectures[$key] = count($lectures);
                }
            }
        }
        // $userCourse = orders::where('user_id',$user_id)->pluck('ordered_courses')->toArray();
        $userRelatedCourse = Course::where('university_id', Auth::user()->academic_institution)
            ->orWhere('degree_id', Auth::user()->student_degree)
            ->get();

        $courses_data = $this->paginate($courses_data);
        $marathon_data = $this->paginate($marathon_data);
        return view('includes.my-courses',compact('courses_data','total_lectures','reviews_data','marathon_data','chapter_data','courseIdByChapters_arr', 'userRelatedCourse'));
    }
    
    
    public function topicElementRepeat(Request $request){
        
        $input = $request->all();
        $where_arr['user_id'] = Auth::user()->id;
        $where_arr['topic_id'] = $input['topic_id'];
        $where_arr['course_id'] = $input['course_id'];
        $where_arr['element_id'] = $input['element_id'];
        $where_arr['element_type'] = $input['element_type'];
        
        $userElementsRepeat = TopicElementsRepeat::where($where_arr)->first();
        if(!empty($userElementsRepeat)){
           ($userElementsRepeat['is_repeat'] == '1')?$data_upd_arr['is_repeat'] = '0':$data_upd_arr['is_repeat'] = '1';
            TopicElementsRepeat::where('id',$userElementsRepeat['id'])->update($data_upd_arr);
            $result['status'] = 1;
            $result['isRepet'] = $data_upd_arr['is_repeat'];
        }else{
            $data_arr['user_id'] = Auth::user()->id;
            $data_arr['topic_id'] = $input['topic_id'];
            $data_arr['course_id'] = $input['course_id'];
            $data_arr['element_id'] = $input['element_id'];
            $data_arr['element_type'] = $input['element_type'];
            $data_arr['is_repeat'] = '1';
            TopicElementsRepeat::create($data_arr)->id;
            $result['status']=1;
            $result['isRepet'] = 1;
        }
        return json_encode($result);
    }
    
    public function user_progress(Request $request)
    {
        $input = $request->all();

        if ($input['element_type'] == 0) {
            $typeId = 1;
        }
        if ($input['element_type'] == 1) {
            $typeId = 2;
        }
        if ($input['element_type'] == 2) {
            $typeId = 3;
        }
        if (!UserCourseProgress::where('user_id', Auth::user()->id)->where('course_id', $input['course_id'])->where('type_id', $input['element_id'])->exists()) {
            UserCourseProgress::create([
                'user_id' => Auth::user()->id,
                'course_id' => $input['course_id'],
                'type_id' => $input['element_id'],
                'type' => $input['element_type'],
            ]);
        }

        $where_arr['user_id'] = Auth::user()->id;
        $where_arr['topic_id'] = $input['topic_id'];
        $where_arr['course_id'] = $input['course_id'];
        $userProgress = UserProgress::where($where_arr)->first();
        if($input['element_type'] == 1){
            if(!empty($userProgress)){
            $video_ids_arr = (explode(",",$userProgress['pdf_ids']));
            if (!in_array($input['element_id'], $video_ids_arr)){
              $progress_arr_upd['pdf_ids'] = $userProgress['pdf_ids'].','.$input['element_id'];
              UserProgress::where('id',$userProgress['id'])->update($progress_arr_upd);
            }
            $result['status'] = '1';
            }else{
                $progress_arr['user_id'] = Auth::user()->id;
                $progress_arr['topic_id'] = $input['topic_id'];
                $progress_arr['course_id'] = $input['course_id'];
                $progress_arr['pdf_ids'] = $input['element_id'];
                UserProgress::create($progress_arr)->id;
                $result['status'] = '1';
            }
        }elseif($input['element_type'] == 2){
            if(!empty($userProgress)){
            $video_ids_arr = (explode(",",$userProgress['video_ids']));
            if (!in_array($input['element_id'], $video_ids_arr)){
              $progress_arr_upd['video_ids'] = $userProgress['video_ids'].','.$input['element_id'];
              UserProgress::where('id',$userProgress['id'])->update($progress_arr_upd);
            }
            $result['status'] = '1';
            }else{
                $progress_arr['user_id'] = Auth::user()->id;
                $progress_arr['topic_id'] = $input['topic_id'];
                $progress_arr['course_id'] = $input['course_id'];
                $progress_arr['video_ids'] = $input['element_id'];
                UserProgress::create($progress_arr)->id;
                $result['status'] = '1';
            }
        }
        return json_encode($result);
    }
    

    public function newShowMyCourse(Request $request, $id)
    {
        $course = Course::where('course_id', $id)->pluck('course_name')->first();

        $allTopics = Topics::where('course_id', $id)->pluck('id')->toArray();

        $existCourse  = orders::where('user_id', Auth::user()->id)->where('ordered_courses', $id)->exists();
        $isCourse  = orders::where('user_id', Auth::user()->id)->pluck('ordered_courses')->toArray();
        $isCourse  = Topics::whereIn('course_id', $isCourse)->pluck('id')->toArray();

        $topics = DB::select("select 
                temptable.title, 
                temptable.id, 
                temptable.pdf as type, 
                temptable.topic_id as topic_id, 
                temptable.order_id as order_id, 
                temptable.topic_pdf_url as topic_url,
                topics.topic_name, 
                topics.topic_duration 
            from 
            (
                select 
                  topic_pdf_title as title, 
                  id, 
                  'pdf',
                  topic_id, 
                  order_id,
                  topic_pdf_url
                from 
                  topic_pdf 
                where 
                  topic_id In(
                    SELECT 
                      id 
                    FROM 
                      `topics` 
                    WHERE 
                      `course_id` = $id
                  ) 
                UNION 
                select 
                  topic_video_title as title, 
                  id, 
                  'video', 
                  topic_id, 
                  order_id,
                  topic_video_url
                from 
                  topic_videos 
                where 
                  topic_id In(
                    SELECT 
                      id 
                    FROM 
                      `topics` 
                    WHERE 
                      `course_id` = $id
                  ) 
                UNION 
                select 
                  quiz_title as title, 
                  id, 
                  'quiz', 
                  topic_id, 
                  order_id,
                  ''
                from 
                  topic_quiz 
                where 
                  topic_id In(
                    SELECT 
                      id 
                    FROM 
                      `topics` 
                    WHERE 
                      `course_id` = $id
                  )
            ) as temptable 
        join topics on temptable.topic_id = topics.id");

        $setTopics = [];
        foreach ($topics as $topic) {
            $topicType = 0;
            if ($topic->type == 'pdf') {
                $topicType = 1;
            } elseif ($topic->type == 'video') {
                $topicType = 2;
            } elseif ($topic->type == 'quiz') {
                $topicType = 3;
            } 

            $elementStatus = UserCourseProgress::where('user_id', Auth::user()->id)
                ->where('course_id', $id)
                ->where('type', $topicType)
                ->where('type_id', $topic->id)
                ->exists();

            $elementFlag = TopicElementsRepeat::where('user_id', Auth::user()->id)
                ->where('course_id', $id)
                ->where('topic_id', $topic->topic_id)
                ->where('element_id', $topic->id)
                ->pluck('is_repeat')->first();

            $watched_topic_element = DB::table('last_watch_element')
                ->where('course_id', $id)
                ->where('topic_id', $topic->topic_id)
                ->where('user_id',Auth::user()->id)
                ->where('element_type', $topicType)
                ->where('element_id', $topic->id)
                ->exists();            
            
            $flagCls = $elementFlag == 1 ? 'fa fa-flag' : 'far fa-flag';

            $returnobject =  new \stdClass();

            $returnobject->id = $topic->id;
            $returnobject->topicTitle = $topic->title;
            $returnobject->topic_duration = date('H:i', strtotime($topic->topic_duration));
            $returnobject->order_id = $topic->order_id;
            $returnobject->topic_id = $topic->topic_id;
            $returnobject->type = $topic->type;
            $returnobject->course_id = $id;
            $returnobject->flagCls = $flagCls;
            $returnobject->topic_url = $topic->topic_url;
            $returnobject->watched_topic_element = $watched_topic_element;
            $returnobject->elementStatus = $elementStatus;

            $setTopics[$topic->topic_id][] = $returnobject; 
        }

        // $userTopics = $setTopics;
        $userTopics = array_intersect_key($setTopics, array_flip($isCourse));

        // dd($userTopics);
        if($existCourse == true) {
            return view('includes.course.my-course-detail', compact('userTopics', 'course'));
        } else {
            return redirect()->route('front.course.show', $id);
        }
    }

    public function showElementVideoSection(Request $request)
    {
        $courses_data = Course::where('course_id', 30)->first();
        $html = '<span class="videotitle">'.$courses_data->title.'</span>
        <div id="course-details-panel">
           <div class="fluid-course-video">
              <div id="player" class="vid-wrapper videre-container">
                <iframe src="'.$courses_data->video_link.'" id="stream-player"></iframe>
              </div>
           </div>
        </div>';
        return $html;
    }
    
    /*
    * Last watched video.
    */
    public function last_watched_topic_element(Request $request){
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $where_arr['topic_id'] = $input['topic_id'];
        $where_arr['course_id'] = $input['course_id'];
        $where_arr['user_id'] = Auth::user()->id;
        $last_watch_element = LastWatchedTopicElement::where($where_arr)->get()->toArray();
        if(!empty($last_watch_element)){
            LastWatchedTopicElement::where('id',$last_watch_element[0]['id'])->update($input);
            $result['status'] = '2';
        }else{
            LastWatchedTopicElement::create($input);
            $result['status'] = '1';
        }
        return json_encode($result);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showMyCourse($id)
    {
        $course_id = $id;
        $topicIds = [];
        $topicIdsStr='';
        $user_id = Auth::user()->id;
        $comment_area_show = 1;
        $already_added_review_id = reviews::select('*')->where('course_id',$id)->where('user_id',$user_id)->pluck('id');
        if(count($already_added_review_id) != 0){
            $comment_area_show = 0;
        }
        $instructor_data = Instructors::select('*')->where('instructor_course_id',$id)->get();
        $coursematerialdata =  coursematerial::select('*')->where('course_id',$id)->get();
        $courses_data = Course::select('*')->where('course_id',$id)->get();
        $isCourse  = orders::select('*')->where('ordered_courses',$course_id)->first(); // check $course_id is course id ya chapter id.
        if(empty($isCourse)){
            $chapter_data = orders::select('*')->where('user_id',$user_id)->where('course_type',3)->pluck('ordered_courses');
            if(count($chapter_data)>0){
                foreach($chapter_data as $k=>$v){
                    array_push($topicIds,$v);
                }
            }
            $topics = Topics::whereIn('id',$topicIds)->get()->toArray();    // Get only paid chapters list by couser id
        }else{
            $topics = Topics::where('course_id',$course_id)->get()->toArray(); // if paid course so , get all chapters.
        }
        if(!empty($topics)){
            $quizCount = [];
            foreach($topics as $key =>$topic){
             
            $topics[$key]['topic_video_new'] = TopicVideos::select('topic_video_title as name','topic_video_url as topic_data_path','topic_video_duration as video_duration','order_id','type','id')->where('topic_id',$topic['id'])->get()->toArray();
            $topics[$key]['topics_pdf_new'] = TopicsPdf::select('topic_pdf_title as name','topic_pdf_url as topic_data_path','id as video_duration','order_id','type','id')->where('topic_id',$topic['id'])->get()->toArray();
            $topic_quiz_new = TopicQuiz::select('quiz_title as name','quiz_title as topic_data_path','id as video_duration','order_id','type','id')->where('topic_id',$topic['id'])->get()->toArray();
            $fullarray = array_merge($topics[$key]['topic_video_new'],$topics[$key]['topics_pdf_new']);
            $topics[$key]['newfullarray'] = array_merge($fullarray,$topic_quiz_new);
            $orderData = array_column($topics[$key]['newfullarray'], 'order_id');
            array_multisort($orderData, SORT_ASC, $topics[$key]['newfullarray']);
            unset($topics[$key]['topic_videos']);
            unset($topics[$key]['topic_video_new']);
            unset($topics[$key]['topics_pdf_new']);
            $topicIdsStr .= $topic['id'].',';
            }
        }
        //$user_progress_data = UserProgress::where("user_id",Auth::user()->id)->where("course_id",$course_id)->get()->toArray();
       return view('includes.my-courses-detail',compact('id','comment_area_show','coursematerialdata','instructor_data','user_id','courses_data','topics','topicIdsStr'));
    }


    public function showMyChapter($id){

        $topic_id = $id;
        $user_id = Auth::user()->id;
        $topics = Topics::find($topic_id);
        $topicsVideos = TopicVideos::where("topic_id",$topic_id)->get()->toArray();
        $courses_data = Course::select('*')->where('course_id',$topics['course_id'])->get();
        $coursematerialdata =  coursematerial::select('*')->where('course_id',$topics['course_id'])->get();

        /*$comment_area_show = 1;
        $already_added_review_id = reviews::select('*')->where('course_id',$id)->where('user_id',$user_id)->pluck('id');
        if(count($already_added_review_id) != 0){
            $comment_area_show = 0;
        }
        $instructor_data = Instructors::select('*')->where('instructor_course_id',$id)->get();
        $coursematerialdata =  coursematerial::select('*')->where('course_id',$id)->get();

        $topics = Topics::where('course_id',$course_id)->get()->toArray();

        if(!empty($topics)){
            $quizCount = [];
            foreach($topics as $key =>$topic){
                $topics[$key]['quizTopics'] = quiz::where('topicId',$topic['id'])->get()->toArray();
                array_push($quizCount,count($topics[$key]['quizTopics']));
                $topics[$key]['topic_video_data'] = TopicVideos::select('id','topic_video_title','topic_video_url')->where('topic_id',$topic['id'])->get()->toArray();
                $quiz_quest_count = quiz_questions::where('topic_id',$topic['id'])->get()->toArray();
                if(!empty($quiz_quest_count) && count($quiz_quest_count)>0){
                    $topics[$key]['quiz_quest_count'] = count($quiz_quest_count);
                }else{
                    $topics[$key]['quiz_quest_count'] = 0;
                }
            }
        }
        if(!empty($quizCount)){
            $quizCount = array_sum($quizCount);
        }*/
        return view('includes.my-chapter-detail',compact('id','courses_data','topics','user_id','topicsVideos','coursematerialdata'));
    }



    //function to add ratings and comments for courses.
    public function addratings(Request $request){
        $reviews = new reviews;
        $reviews->course_id = $request->mycourseid;
        $reviews->comment = $request->comments;
        $reviews->rating = $request->rating;
        $reviews->user_id = Auth::user()->id;
        $reviews->save();
        return redirect()->back();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function download(Request $request)
    {
        $id = $request->id;
        $reports =  coursematerial::select('*')->where('id',$id)->get();
        foreach($reports as $report){
            $path = storage_path().'/'.'app'.'/public/uploads/'.$report->name;
        }
        $pdf = PDF::loadView('pdf.pdf');
        $headers = array(
              'Content-Type: application/pdf',
            );
        return response()->download($path, 'filename.pdf', $headers);
        $path = public_path('pdf/');
        $fileName =  time().'.'. 'pdf' ;
        $pdf->save($path . '/' . $fileName);
        $pdf = public_path('pdf/'.$fileName);
        return response()->download($pdf);
    }


    public function get_video_url(Request $request){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.cloudflare.com/client/v4/accounts/acf72dd236d407950885efd822228792/stream/keys",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "x-auth-email: courson.lms@gmail.com",
            "x-auth-key: 12d9f600c030cdfc4f5a740dafd4ed515a147"
            ),
        ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
        $respose_res = json_decode($response);
        $jwk_key = $respose_res->result->jwk;
        $key_ID = $respose_res->result->id;
        $ip = $_SERVER['REMOTE_ADDR'];
        $result['jwk_key'] = $jwk_key;
        $result['key_ID'] = $key_ID;
        $result['ip'] = $ip;
        $result['videoId'] = $request['topic_video_url'];
        return json_encode($result);
        }
    }


    public function show_quiz_question($cid='',$tid='',$id=''){
        
        $courseId = $cid;
        $topic_id = $tid;
        $quiz_id = $id;
        $quiz_data = TopicQuiz::find($quiz_id)->toArray();
        $course_data = Course::where("course_id",$courseId)->get()->toArray();
        $quiz_questions = $quiz_data['quiz_questions'];
        $quiz_questions_count = count($quiz_data['quiz_questions']);
        return view('includes.simulation',compact('quiz_data','course_data','quiz_questions','quiz_questions_count'));
    }


    public function showQuizResult(Request $request){

        $input   = $request->all();
        $quizId  = $input['quizId'];
        $topicId = $input['topicId'];
        $userId  = Auth::user()->id;
        $correctAnswer =  0;
        $ourAnswer  = QuizAnswer::where('user_id',$userId)->where('topic_id',$topicId)->get(['question_id','choose_answer_option'])->toArray();
        $topicQuizQuestions = TopicQuizQuestions::where('quiz_id',$quizId)->where('topic_id',$topicId)->get()->toArray();
        if(!empty($ourAnswer) && count($ourAnswer) > 0){
            foreach($ourAnswer as $key=>$val){
                $ans = TopicQuizQuestions::where('id',$val['question_id'])->where('answer',$val['choose_answer_option'])->get()->toArray();
                if(count($ans) >0 ){
                    $correctAnswer = $correctAnswer+1;
                }
            }
        }
        $result['questionCount'] = count($topicQuizQuestions);
        $result['correctAnswer'] = $correctAnswer;
        return json_encode($result);
    }

    public function searchChapterElement(Request $request){
        
        $input = $request->all();
        $courseid = $input['course_id'];
        $topicIds = (explode(",",$input['topicidsstr']));;
        $searchword = $input['searchword'];
        
        $html = '';
        $innerHtml = "";
        $viewVideoArr = [];
        $makeTopicArr = [];
        if($searchword !="" && !empty($searchword)){
        
        $topicsQuiz = TopicQuiz::select('topic_id')->where('quiz_title', 'LIKE', '%'.$searchword.'%')->whereIn('topic_id',$topicIds)->get()->toArray();
        $topicVideos = TopicVideos::select('topic_id')->where('topic_video_title', 'LIKE', '%'.$searchword.'%')->whereIn('topic_id',$topicIds)->get()->toArray();
        $topicsTopicsPdf = TopicsPdf::select('topic_id')->where('topic_pdf_title', 'LIKE', '%'.$searchword.'%')->whereIn('topic_id',$topicIds)->get()->toArray();
        
        if(!empty($topicsQuiz)){
            foreach($topicsQuiz as $key=>$val){
                array_push($makeTopicArr,$val['topic_id']);
            }
        }
        if(!empty($topicVideos)){
            foreach($topicVideos as $key=>$val){
                array_push($makeTopicArr,$val['topic_id']);
            }
        }
        if(!empty($topicsTopicsPdf)){
            foreach($topicsTopicsPdf as $key=>$val){
                array_push($makeTopicArr,$val['topic_id']);
            }
        }
        
        $topics = Topics::whereIn('id',array_unique($makeTopicArr))->get()->toArray();
        }
        else{
            $topics = Topics::whereIn('id',$topicIds)->get()->toArray();
            $result['status'] = 1;
        }
        if(!empty($topics)){
            
            $i = 1;
    		
            foreach($topics as $key=>$val){
                $userprogress  = DB::table('user_progress')->where('topic_id',$val['id'])->where('user_id',Auth::user()->id)->first();
                if(!empty($val['topic_videos'])){
                    $innerHtml = '';
                    foreach($val['topic_videos'] as $v_key=>$v_val){
                    if(!empty($userprogress)){
		                $viewVideoArr = (explode(",",$userprogress->video_ids));
		            }
  			        $vidoe_url = $v_val['topic_video_url'];
  			        $vidoe_duration = (!empty($v_val['topic_video_duration']))?$v_val['topic_video_duration'].' דקות':
  			        '0 דקות';
                    (in_array($v_val['id'],$viewVideoArr))?$style= "block":$style= "none";
                    $flagCls = "";
                    $topic_element_repeat = DB::table('topic_element_repeat')
                                                ->where('topic_id',$val['id'])
                            		            ->where('user_id',Auth::user()->id)
                            		            ->where('element_type',$v_val['type'])
                            		            ->where('element_id',$v_val['id'])
                            		            ->where('course_id', $courseid)->first();
                    if(!empty($topic_element_repeat) && $topic_element_repeat->is_repeat == '1'){
                        $flagCls = "fa fa-flag";
                    }else{
                        $flagCls = "far fa-flag";
                    }
                    $watched_topic_element = DB::table('last_watch_element')
                    		           ->where('course_id',$courseid)
                    		           ->where('topic_id',$val['id'])
                    		           ->where('user_id',Auth::user()->id)
                    		           ->where('element_type',$v_val['type'])
                    		           ->where('element_id',$v_val['id'])
                    		           ->first();
                    if(!empty($watched_topic_element)){
                        $backgroudColor = "#fff4e9!important";
                    }else{
                        $backgroudColor = "#fff";
                    }
                    $innerHtml .= '<li class="topicElementCls videoCls"  topic_id="'.$val['id'].'" element_id="'.$v_val['id'].'" element_type="'.$v_val['type'].'" course_id ="'.$courseid.'">
        			  	<a class="item" href="javascript:void(0);" style="background:'.$backgroudColor.'">
        					<div class="title-container">
        				  		<span class="lecture-main">
        				  			<span class="lecture-icon video_time_div"><i class="far fa-play-circle"></i><span class="video_total_time">'.$vidoe_duration.'</span></span>
        							<span class="lecture-name topic_video_url" topic-video-title="'.$v_val['topic_video_title'].'" topic-video-url="'.$vidoe_url.'"> '.$v_val['topic_video_title'].'</span>
        						</span>
        						<span class="bookmark">
                                    <i class="check_video_icon fas fa-check-circle" style="display:"'.$style.'";padding-left: 10px;"></i>
                                    <i class="bookmarkicon flagCls '.$flagCls.'"></i>
                                </span>
        					</div>
        				</a>
        			</li>';
                    }
                }
                
                if(!empty($val['topic_pdf'])) {
                    foreach($val['topic_pdf'] as $p_key=>$p_val){
                    if(!empty($userprogress)){
		                $downloadPdfArr = (explode(",",$userprogress->pdf_ids));
		            }
                    $href1 = asset('assets/topic_pdf/'.$p_val['topic_pdf_url']);
                    $class= "";
                    $target_black = "_blank";
                    $isPdfDownload = 1;
                    (in_array($p_val['id'],$downloadPdfArr))?$style= "block":$style= "none";
                    $flagCls = "";
                    $topic_element_repeat = DB::table('topic_element_repeat')
                                                ->where('topic_id',$val['id'])
                            		            ->where('user_id',Auth::user()->id)
                            		            ->where('element_type',$p_val['type'])
                            		            ->where('element_id',$p_val['id'])
                            		            ->where('course_id', $courseid)->first();
                    if(!empty($topic_element_repeat) && $topic_element_repeat->is_repeat == '1'){
                        $flagCls = "fa fa-flag";
                    }else{
                        $flagCls = "far fa-flag";
                    }
                    $watched_topic_element = DB::table('last_watch_element')
                    		           ->where('course_id', $courseid)
                    		           ->where('topic_id',$val['id'])
                    		           ->where('user_id',Auth::user()->id)
                    		           ->where('element_type',$p_val['type'])
                    		           ->where('element_id',$p_val['id'])
                    		           ->first();
                    if(!empty($watched_topic_element)){
                        $backgroudColor = "#fff4e9!important";
                    }else{
                        $backgroudColor = "#fff";
                    }
                    
                    $innerHtml .= '<li class="topicElementCls pdfCls"  topic_id="'.$val['id'].'" element_id="'.$p_val['id'].'" element_type="'.$p_val['type'].'" course_id ="'.$courseid.'">
                    			  	<a class="item" href="javascript:void(0);" href1="'.$href1.'" style="background:'.$backgroudColor.'">
                    					<div class="title-container">
                    				  		<span class="lecture-main">
                    				  			<span class="lecture-icon"><i class="fa fa-file-pdf"></i></span>
                    							<span class="lecture-name " topic-pdf-title="'.$p_val['topic_pdf_title'].'"
                    							topic-pdf-url="'.$href1.'">'.$p_val['topic_pdf_title'].'</span>
                    						</span>
                    						<span class="bookmark">
                                                <i class="check_video_icon fas fa-check-circle" style="display:"'.$style.'";padding-left: 10px;"></i>
                                                <i class="bookmarkicon flagCls '.$flagCls.'"></i>
                                            </span>
                    					</div>
                    				</a>
                    			</li>';
                    }
                }
                if(!empty($val['topic_quiz'])) {
                    foreach($val['topic_quiz'] as $q_key=>$q_val){
                    $href = url("quiz-question/".$courseid."/".$val['id']."/".$q_val["id"]);
                    $question =   count($q_val["quiz_questions"]);
                    $userChooseAnsCount = DB::table('quiz_answers')->where('user_id',Auth::user()->id)->where('topic_id',$val['id'])->where('quiz_id',$q_val['id'])->count();
                    ($userChooseAnsCount == $question)?$style1= "block":$style1= "none";
                    
                    
                    $flagCls = "";
                    $topic_element_repeat = DB::table('topic_element_repeat')
                                                ->where('topic_id',$val['id'])
                            		            ->where('user_id',Auth::user()->id)
                            		            ->where('element_type',$q_val['type'])
                            		            ->where('element_id',$q_val['id'])
                            		            ->where('course_id', $courseid)->first();
                    if(!empty($topic_element_repeat) && $topic_element_repeat->is_repeat == '1'){
                        $flagCls = "fa fa-flag";
                    }else{
                        $flagCls = "far fa-flag";
                    }
                    
                    $watched_topic_element = DB::table('last_watch_element')
                    		           ->where('course_id', $courseid)
                    		           ->where('topic_id',$val['id'])
                    		           ->where('user_id',Auth::user()->id)
                    		           ->where('element_type',$q_val['type'])
                    		           ->where('element_id',$q_val['id'])
                    		           ->first();
                    if(!empty($watched_topic_element)){
                        $backgroudColor = "#fff4e9!important";
                    }else{
                        $backgroudColor = "#fff";
                    }
                    
                    $innerHtml .= '<li class="topicElementCls quizCls"  topic_id="'.$val['id'].'" element_id="'.$q_val['id'].'" element_type="'.$q_val['type'].'" course_id ="'.$courseid.'">
                    			  	<a class="item" href="'.$href.'" style="background:'.$backgroudColor.'">
                    					<div class="title-container">
                    				  		<span class="lecture-main">
                    				  			<span class="lecture-icon"><i class="fa fa-question"></i></span>
                                                &nbsp;&nbsp;'.$question.'
                    							<span class="lecture-name">
                    							'.$q_val['quiz_title'].'</span>
                    						</span>
                    						<span class="bookmark">
                                                <i class="check_video_icon fas fa-check-circle" style="display:"'.$style1.'";padding-left: 10px;"></i>
                                                <i class="bookmarkicon flagCls '.$flagCls.'"></i>
                                            </span>
                    					</div>
                    				</a>
                    			</li>';
                    }
                }
                $html .='<div class="panel panel-default topicCls appended" topic_id='. $val['id'].'>
            			  	<div class="panel-heading">
            				 	<h4 class="panel-title">
            						<a data-toggle="collapse" data-parent="#accordion" href="#ac1_'.$i.'" aria-expanded="false" class="openeye collapsed" data-lecture-id='.$val['id'].'>
            							<strong></strong>'.$val['topic_name'].' 
            						</a>
            					</h4>
            				</div>
            				<div id="ac1_'.$i.'" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
						 	<div class="panel-body p-0 border-0">
								<ul class="section-list video_sec_list">
            				    '.$innerHtml.'
                				</ul>
    					  	</div>
    				   	</div>
    				    </div>';
                $i++;
            }
        $result['status'] = 1;
        }
        $result['html']= $html;
        return json_encode($result);
    }
    
    public function quizDetail()
    {
        return view('includes.quiz-detail');
    }
    
}