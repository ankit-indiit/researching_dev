@extends('layouts.app')

@section('title', ' פרט הקורס שלי   ')

@section('content')
<style>
  div#player {
    height: 495px;
    /* PADDING: 126PX; */
    width: 880px !important;
    cursor: pointer;
}
div#player iframe {
    width: 100%;
    height: 100%;
}
.hideAll{
    display:none;
}
span.videotitle {
    font-size: 28px;
    padding: 10px;
    float: left;
    width: 100%;
    margin: 10px 0px;
    text-transform: capitalize;
}
i.bookmarkicon.flagCls.fa.fa-flag{
    color: #ff0000;
}
i.bookmarkicon.flagCls.far.fa-flag{
    color: #808080;
}
</style>
<link href="{{ asset('assets/css/videre.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/videoapp.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<?php // pr($courses_data[0]->course_name); die;  ?>
<div class="breadcrumb-inner-area pt-92">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <ul class="breadcrumb">
                	<li><a href="{{ url('/') }}"><i class="fas fa-home"></i> דף הבית</a></li>
                     <li class="active"> נגן הקורס </li>
              	</ul>
           	</div>
        </div>
 	</div>
</div>

<!-- Start Course Details  -->
<div class="tab-content tab-content-info">
<!-- Single Tab -->
  	<div id="tab1" class="tab-pane fade active in">
  		<div class="course-details-area default-padding-sm " style="direction: rtl;">
		 	<div class="container">
				<div class="row">
				   	<!-- Start Course Info -->
				   	<div class="col-md-9">
					  	<div class="courses-info mycourseinfo">
						 	<span class="videotitle"></span>
                            {{-- <h2><i class="fa fa-file-text"></i> --}}
						 	    {{-- {{ $courses_data[0]->course_name }} --}}
							    <!--מבוא לסטטיסטיקה-->
							{{-- </h2 > --}}
							<?php if(!empty(strip_tags($courses_data[0]->description)) && $courses_data[0]->description !=NULL){ ?>
							<div class="course-meta">
							<p>{!! $courses_data[0]->description !!}</p>
						 	</div>
							 <?php   }	?> 
							<div id="course-details-panel">
    							<div class="fluid-course-video">
    								<div id="player" class="vid-wrapper videre-container"></div>
    							</div>
							    
							</div>
						    <!--<button class="btn btn-theme btn-circle2 mt-20"> <i class="fa fa-download"></i></button>-->
						</div>
					  	<?php if($comment_area_show == 1){?>
						  	<div class="comments-area" style="display:none">
								<div class="comments-form">
									<div class="title">
										<h4>השאירו ביקורת</h4>
									</div>
									<form method="POST" class="contact-comments" id="upload-chats" action="{{ route('front.ratings') }}" enctype="multipart/form-data">
										<div class="row">
                                        <!-- <div class="col-md-12">
                                         	<label>דֵרוּג</label>
                                        	<div class="form-group">
                                        		<fieldset class="rating">
                                                    <input type="radio" id="star5" name="rating" value="5" />
                                                    <label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                                    <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                                    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                                    <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                                    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                                    <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                                    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                                    <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                                    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                                    <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                                </fieldset>
                                                </div>
                                        </div> -->
                    			    <input type="hidden" name="mycourseid" value = "{{$id}}">
                    				<div class="col-md-12">
                    					<div class="form-group comments">
                    						<textarea name = 'comments' class="form-control" placeholder="סקירה"></textarea>
                    					</div>
                    					<div class="form-group full-width submit">
                    						<button type="submit" class="btn btn-theme">שלח</button>
                    					</div>
                    				</div>
                    		    </div>
                    	</form>
                    </div>
                </div>
  	<?php } ?>
</div>
<!-- End Course Info -->
<!-- Start Course Sidebar -->
   	<div class="col-md-3">        
	  	<div class="aside">
		 	<!-- Sidebar Item -->
		 	<div class="sidebar-item course-info mycourse-side">
				<div class="title">
				   	<!--<h2>סטטיסטיקה תיאורית (סטטיסטיקה א') </h2>-->
				   	<h2>{{ $courses_data[0]->course_name }}</h2>
				</div>
				<div class="aboutsearch">
                     <div class="form-group">
                        <div class="input-group">
                           <input id="onlyText" type="text" name="searchBar" onkeydown="return /[a-z]/i.test(event.key)"  placeholder="לחפש.." class="form-control searchBar"  course_id ="{{ $courses_data[0]->course_id }}" topicIdsStr="{{ @$topicIdsStr }}">
                           <span class="input-group-addon"> <i class="ti-search"></i></span>
                        </div>
                     </div>
                 </div>
				<div class="mycourse-list">
					<div class="panel-group symb" id="accordion">
			        <?php
                    if(!empty($topics)){
                    $i = 1; 
                    $downloadPdfArr = [];
    		        $viewVideoArr = [];
                    foreach($topics as $key=>$val){
                        $userprogress  = DB::table('user_progress')->where('topic_id',$val['id'])->where('user_id',Auth::user()->id)->first();
                    ?>
					<div class="panel panel-default topicCls" topic_id="{{ @$val['id'] }}">
					  	<div class="panel-heading">
						 	<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#ac1{{$i}}" aria-expanded="false" class="openeye collapsed" data-lecture-id="{{$val['id']}}">
									<strong></strong> {{ $val['topic_name'] }} <!--מבוא-->
								</a>
						 	</h4>
					  	</div>
					  	<div id="ac1{{$i}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
						 	<div class="panel-body p-0 border-0">
								<ul class="section-list video_sec_list">
                    			<?php
                    		    $backgroudColor = "#fff";
                    		    if(!empty($val['newfullarray'])){
                    		        foreach($val['newfullarray'] as $topic_element_key=>$topic_element_val){
                    		         $topic_element_repeat = DB::table('topic_element_repeat')->where('topic_id',$val['id'])
                    		           ->where('user_id',Auth::user()->id)
                    		           ->where('element_type',$topic_element_val['type'])
                    		           ->where('element_id',$topic_element_val['id'])
                    		           ->where('course_id', $courses_data[0]->course_id)->first();
                    		        
                    		        $watched_topic_element = DB::table('last_watch_element')
                    		           ->where('course_id', $courses_data[0]->course_id)
                    		           ->where('topic_id',$val['id'])
                    		           ->where('user_id',Auth::user()->id)
                    		           ->where('element_type',$topic_element_val['type'])
                    		           ->where('element_id',$topic_element_val['id'])
                    		           ->first();
                    		           
                                    if(!empty($watched_topic_element)){
                                        $backgroudColor = "#fff4e9!important";
                                    }else{
                                        $backgroudColor = "#fff";
                                    }
                                    
                                    
                		            if(!empty($userprogress)){
                		                $downloadPdfArr = (explode(",",$userprogress->pdf_ids));
                		            }
                		            if(!empty($userprogress)){
                		                $viewVideoArr = (explode(",",$userprogress->video_ids));
                		            }
                    		        $topicElementType = '';
                    		        $flag = "";
                    		        $class1 = '';
                                    $question = '';
                    		        $href = '';
                    		        $href1 = '';
                                    $target_black = '';
                                    $topic_data_path = '';
                                   if($topic_element_val['type']=='1'){
                                       $flag = "flagCls";
                                       $topicElementType = "pdfCls";
                                       $href = "javascript:void(0);";
                                       $href1 = asset('assets/topic_pdf/'.$topic_element_val['topic_data_path']);
                                       $class= "fa fa-file-pdf pdfUrl";
                                       $target_black = "_blank";
                                       $vidoe_duration = '';
                                       $isPdfDownload = 1;
                                       (in_array($topic_element_val['id'],$downloadPdfArr))?$style= "block":$style= "none";
    				  			   }elseif($topic_element_val['type']=='2'){
    				  			       $flag = "videoFlag";
    				  			       $topicElementType = "videoCls";
    				  			       $href = "javascript:void(0);";
    				  			       $href1 = '';
    				  			       $class = "far fa-play-circle videoUrl";
    				  			       $class1 = "topic_video_url";
    				  			       $vidoe_url = $topic_element_val['topic_data_path'];
    				  			       $vidoe_duration = (!empty($topic_element_val['video_duration']))?$topic_element_val['video_duration'].
    				  			       ' דקות':
    				  			       '0 דקות';
    				  			       $isVideoViewed = 1;
                                       (in_array($topic_element_val['id'],$viewVideoArr))?$style= "block":$style= "none";
    				  			   }else{
    				  			        $flag = "quizFlag";
    				  			        $topicElementType = "quizCls";
    				  			        $href = "javascript:void(0);";
    				  			        $href1 = url("quiz-question/".$id."/".$val['id']."/".$topic_element_val["id"]);
    				  			        $class= "fa fa-question questionUrl";
                                        $class1 = "questionUrl";
                                        $question =   count($topic_element_val["quiz_questions"]);
                                        $vidoe_duration =  '';
                                        $userChooseAnsCount = DB::table('quiz_answers')->where('user_id',Auth::user()->id)->where('topic_id',$val['id'])->where('quiz_id',$topic_element_val['id'])->count();
                                        ($userChooseAnsCount == $question)?$style= "block":$style= "none";
    				  			    }

                                    if($style == 'block'){
                                        $class = "check_video_icon fas fa-check-circle videoUrl";
                                    }
                                    
                    			?>
                    			<li class="topicElementCls {{ $topicElementType }}"  topic_id="{{ @$val['id'] }}" element_id="{{ $topic_element_val['id'] }}" element_type="{{ $topic_element_val['type'] }}" course_id ="{{ $courses_data[0]->course_id }}">
                    			  	<a class="item" href="{{ @$href }}" href1="{{ @$href1 }}" style="background:{{ @$backgroudColor }}">
                    					<div class="title-container">
                    				  		<span class="lecture-main">
                    				  			<span class="lecture-icon video_time_div"><i class="{{ $class }}"></i><span class="video_total_time">{{ @$vidoe_duration }}</span></span>
                                                <?php echo '&nbsp;&nbsp;'.$question; ?>
                    							<span class="lecture-name {{ @$class1 }}" topic-video-title="{{ $topic_element_val['name'] }}"
                    							topic-video-url="{{ @$vidoe_url }}">
                    							<?php echo (!empty($topic_element_val['name']))? $topic_element_val['name'] : ''; ?>
                    							</span>
                    						</span>
                    						<span class="bookmark">
                                                {{-- <i class="check_video_icon fas fa-check-circle" style="display:{{ $style }};"></i> --}}
                                                <i class="bookmarkicon flagCls 
                                                @if(!empty($topic_element_repeat) && $topic_element_repeat->is_repeat == '1')
                                                 fa fa-flag
                                                @else
                                                 far fa-flag
                                                @endif"></i>
                                            </span>
                    					</div>
                    				</a>
                    			</li>
                    			<?php
                    		        }
                    		    }
                    			?>
						  	</ul>
					  	</div>
				   	</div>
			   	</div>
			<?php
			$i++;
                }
                    }
            ?>
								  </div>
							 </div>
							</div>

						  </div>
					   </div>
					   <!-- End Course Sidebar -->
					</div>
				 </div>
			  </div>
		  </div>
	     <div id="tab2" class="tab-pane fade">
			  <div class="course-learning-area default-padding-sm " style="direction: rtl;">
					<div class="container">
						<div class="row">
						   <!-- Start Course Info -->
						   <div class="col-md-8 col-md-offset-2">
    						 <ul>
    						    <?php
    						    foreach($coursematerialdata as $value){
    						    $path_parts = pathinfo($value->name);
    						    ?>
    						    <input type ="hidden" id="download_course_id" value="{{$value->id}}" data-path="{{asset('').$value->file_path}}">
    						    <li><a  href='{{asset('').$value->file_path}}' id="download_course" class="download_course"  download> <div><i class="fa fa-folder iconfolder"></i>{{$path_parts['filename']}}</div>   <i class="fa fa-download downloadicon"></i></a></li>
    						   <?php }?>
    						 </ul>
					    </div>
					 </div>
			    </div>
			 </div>
		 </div>
		 <div id="tab3" class="tab-pane fade">
			  <div class="course-event-area default-padding-sm " style="direction: rtl;">
				 <div class="container">
					<div class="row">
					   <div class="col-md-12">
								<div class="row event_lists p0 mb-20">
							  <div class="col-md-7  p0">
								<div class="blog_grid_post event-cont">
								  <div class="details">
									<h3>הכל ניתן ללמד</h3>
									<p>המוסד המודרני שלנו מעוניין לטפח סביבה בה סטודנטים צעירים יכולים להתכנס וללמוד בסביבה יצירתית וגמישה. אנו עובדים בשיתוף פעולה עם תלמידינו כדי להשיג תוצאות יוצאות מן הכלל.
													 </p>
									<ul class="mb0">
									  <li><a href="javascript:void(0)" class="icon-datetime"><span class="ti-calendar"></span> 1Jan 2021 at 9:00pm</a></li>
									  <li><a href="javascript:void(0)" class="icon-datetime"><span class="ti-time"></span> <span class="countertimer2"></span></a></li>
									  <li>
									  <a href="javascript:void(0)" class="btn-join btn"><img   class="ml-10" height="24px" src="{{ asset('/assets/img/zoomicon.png') }}"> תקריב </a>
									  <a href="#phonemodal" data-toggle="modal" class="btn-theme btn btn-md">לְהִצְטַרֵף</a>

									  </li>
									</ul>
								  </div>
								</div>
							  </div>
							   <div class="col-md-5 p0">
								<div class="blog_grid_post ">
								  <div class="thumb">
									<img class="img-fluid w100" src="{{ asset('/assets/img/event/2.jpg') }}" alt="el2.jpg">
									<div class="post_date"><h2>29</h2> <span>December</span></div>
								  </div>
								</div>
							  </div>
							</div>
						 <div class="row event_lists p0 mb-20">

							  <div class="col-md-7  p0">
								<div class="blog_grid_post event-cont">
								  <div class="details">
									<h3>הכל ניתן ללמד</h3>
									<p>המוסד המודרני שלנו מעוניין לטפח סביבה בה סטודנטים צעירים יכולים להתכנס וללמוד בסביבה יצירתית וגמישה. אנו עובדים בשיתוף פעולה עם תלמידינו כדי להשיג תוצאות יוצאות מן הכלל.
													 </p>
									<ul class="mb0">
									  <li><a href="javascript:void(0)" class="icon-datetime"><span class="ti-calendar"></span> 1Jan 2021 at 9:00pm</a></li>
									  <li><a href="javascript:void(0)" class="icon-datetime"><span class="ti-time"></span> <span class="countertimer2"></span></a></li>
									  <li>
																  <a href="javascript:void(0)" class="btn-join btn"><img   class="ml-10" height="24px" src="{{ asset('/assets/img/zoomicon.png') }}"> תקריב </a>
									  <a href="#phonemodal" data-toggle="modal" class="btn-theme btn btn-md">לְהִצְטַרֵף</a>

									  </li>
									</ul>
								  </div>
								</div>
							  </div>
							   <div class="col-md-5 p0">
								<div class="blog_grid_post ">
								  <div class="thumb">
									<img class="img-fluid w100" src="{{ asset('/assets/img/event/3.jpg') }}" alt="el2.jpg">
									<div class="post_date"><h2>29</h2> <span>December</span></div>
								  </div>
								</div>
							  </div>
							</div>
													<div class="row event_lists p0">

							  <div class="col-md-7  p0">
								<div class="blog_grid_post event-cont">
								  <div class="details">
									<h3>הכל ניתן ללמד</h3>
									<p>המוסד המודרני שלנו מעוניין לטפח סביבה בה סטודנטים צעירים יכולים להתכנס וללמוד בסביבה יצירתית וגמישה. אנו עובדים בשיתוף פעולה עם תלמידינו כדי להשיג תוצאות יוצאות מן הכלל.
													 </p>
									<ul class="mb0">
									  <li><a href="javascript:void(0)" class="icon-datetime"><span class="ti-calendar"></span> 1Jan 2021 at 9:00pm</a></li>
									  <li><a href="javascript:void(0)" class="icon-datetime"><span class="ti-time"></span> <span class="countertimer2"></span></a></li>
									  <li>
									  <a href="javascript:void(0)" class="btn-join btn"><img   class="ml-10" height="24px" src="{{ asset('/assets/img/zoomicon.png') }}"> תקריב </a>
		 <a href="#phonemodal" data-toggle="modal" class="btn-theme btn btn-md">לְהִצְטַרֵף</a>

									  </li>
									</ul>
								  </div>
								</div>
							  </div>
							   <div class="col-md-5 p0">
								<div class="blog_grid_post ">
								  <div class="thumb">
									<img class="img-fluid w100" src="{{ asset('/assets/img/event/1.jpg') }}" alt="el2.jpg">
									<div class="post_date"><h2>29</h2> <span>December</span></div>
								  </div>
								</div>
							  </div>
							</div>


				 </div>
				 </div>
				 </div>
			 </div>
		 </div>
	  	<div id="tab4" class="tab-pane fade">

		  	<div class="user-recommended-area default-padding-sm " style="direction: rtl;">
		  		<div class="container">
					<div class="row">
					  	<div class="col-md-12" id="signup">
						  <div class="form-wraper">
					   	<h3>המלצת משתמשים </h3>
					   	<form method="POST" action="{{url('add_recommend')}}" id="add_recommend_form">
						@csrf
						<input type = "hidden" name="user_id" id ="user_id" value ="{{$user_id}}">
	  		<input type = "hidden" name="course_id" id ="course_id" value ="{{$id}}">
					  	<div class="form-group">
					  		<div class="site-heading text-center">
               					<p> לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקס הדמה הסטנדרטי בתעשייה. </p>


               					<h3>
								תיאור
							</h3>
					 		<textarea id= "recommendation" name ="recommendation" type="text" rows="4" placeholder="תיאור " class="form-control"></textarea>



                    <!--     <input style ="border:none;" type='file' id="imageupload" accept=".png, .jpg, .jpeg" name = "avatar" />
        					</div>
						</div> -->

						  <div class="form-group">
			 <h3 class="mb-0"><b>
			 	המלצות אחרות
			 </b></h3>
			 <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators mb-20">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
     <div class="reviewcont reviewbox">

                                   <div class="recommendcont"><div class="recommendinner"><span class="quotetop"><i class="fa fa-quote-right"></i></span><p><span class="recommendations">לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקס הדמה הסטנדרטי בתעשייה.</span></p>  <span class="quotebottom"><i class="fa fa-quote-left"></i></span></div> <div class="recommendimg"><img src="{{ asset('/assets/img/advisor/course_tutor_1.jpg') }}"></div> </div>

                                 </div>
    </div>
	<div class="item ">
     <div class="reviewcont reviewbox">

                                   <div class="recommendcont"><div class="recommendinner"><span class="quotetop"><i class="fa fa-quote-right"></i></span>  <p><span class="recommendations">לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקס הדמה הסטנדרטי בתעשייה.</span></p>  <span class="quotebottom"><i class="fa fa-quote-left"></i></span></div> <div class="recommendimg"><img src="{{ asset('/assets/img/advisor/course_tutor_2.jpg') }}"></div> </div>

                                 </div>
    </div>
    </div>
    </div>

			</div>

						  <div class="form-group">
							 <button id = "addrecommend" class="log-btn form-btn">שלח המלצה </button>
						  </div>
						  <!-- <div class="form-group mt-20"> <span class="or-txt">
							 <span class="line-span"></span> <span>או שתף לפי </span> <span class="line-span"></span> </span>
						  </div> -->
						  <!-- <div class="form-group socialuser">
							 <button class="form-btn fuser-recommend" style=""><i class="ti-facebook"></i></button>

							 <button class="form-btn wuser-recommend" style=""><i class="fab fa-whatsapp" aria-hidden="true"></i> </button>

							 <button class="form-btn iuser-recommend" style="  "><i class="fab fa-instagram" aria-hidden="true"></i> </button>
						  </div> -->
					   </form>
					</div>
					  </div>
					</div>
				  </div>
			   </div>
          </div>
      </div>
      <!-- End Course Details -->

 <div class="modal loginModal bookModal" id="phonemodal">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header border-bottom-0">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
               </div>
               <!-- Modal body -->
               <div class="modal-body  p-30" id="signup">
			   <div class="form-wraper">
                           <form>
			                <div class="form-group">
                                 <input type="text" name="" style="direction:rtl;" placeholder="מספר טלפון " class="form-control">
                              </div>
								<div class="form-group text-center">
							  <button type="submit" class="btn btn-theme btn-md btn-lt-ht mt-10">שלח</button>
							</div>
							    </form>
                              </div>
               </div>
			   </div>
			   </div>
			   </div>
	   		<!--- Chat Box Start--->
		  <div class="chat-popup" id="myForm" style="display:none">
			<h1 class="chaticon">תיבת צ'אט</h1>
				<div class="chatbody">
                <div class="chatoptions">
				  <ul class="chat-lists">
				  <li  class="btn-radio">אני מעוניין לדווח על תקלה טכנית בקורס</li>
				  <li  class="btn-radio">אני מעוניין לעדכן בשינויים שקרו בקורס</li>
				  <li  class="btn-radio">אני מעוניין להאריך את תוקף הקורס</li>
				  <!--li  class="btn-radio">אני מעוניין לשלוח מייל על נושא שאינו מופיע לעיל</li-->
				  <li  class="btn-radio btn-other-subject">אחר</li>
				  </ul>

                    </div>
					<div class="chatform" style="display:none;">
				     <div class="form-wraper">
                           <form method="POST" class="mt-0" id="upload_course_chats" action="{{ route('front.chatbox') }}" enctype="multipart/form-data">
                             <div class="row">
                             <div class="col-xs-9">
                               <div class="form-group">
                                 <input type="text"   class="allsubjects form-control" name = "title" value="אני מעוניין לדווח על תקלה טכנית בקורס" readonly/>
                                 <input type="text"  Placeholder="" class="othersubject form-control" style="display:none;"/>
                              </div>
                              </div> <div class="col-xs-3">
                               <div class="form-group">
                                  <button class="btn btn-backward"><i class="fa fa-arrow-right"></i></button>
                              </div>
                              </div>
                             </div>
                             @if (Auth::guest())
                                 <div class="form-group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  placeholder="כתובת דוא " value="{{ old('email') }}" required autocomplete="email" multiple>
                                  </div>
                              @endif
							  <div class="form-group">
                                 <textarea type="text" name = 'body' rows="4" placeholder="גוּף " class="form-control"></textarea>
                              </div>
							<div class="form-group uploadfiles">
							     <label for="uploadfile"> <i class="fa fa-upload"></i> <p id ="image_title">גרור או שחרר קבצים לכאן</p></label>
                                 <input type="file" id="uploadfile" name="uploadfile" style="display:none">
                              </div><div class="form-group mb-0 text-center">
							  <button type="submit" id="course_chat_btn" class="btn btn-theme btn-md ">לשלוח הודעה</button>
							   </div>
							    </form>
                              </div>
                    </div>
                </div>
		</div>

	  <a href="#" class="fixed-msg-icon btn btn-theme btn-md">תמיכה <img style="width:auto" height="24px" src="{{ asset('/assets/img/tools.png') }}"/></a>
	  <!--- Chat Box Ends--->

    <!-- End Footer -->
    @endsection
    @section('scripts')
	<script src="{{ asset('assets/js/videre.js') }}"></script>
	<script src="https://embed.videodelivery.net/embed/sdk.latest.js"></script>


    <script type="text/javascript">
	    $(document).on('click', '.flagicon', function () {
			 $(this).removeClass("fa-flag-o");
			   $(this).addClass("fa-flag");
			   $(this).addClass("redclr");
        });
	    $(document).on('click', '.redclr', function () {
			   $(this).removeClass("redclr");
			   $(this).addClass("greenclr");
        });
	    $(document).on('click', '.greenclr', function () {
	           $(this).removeClass("fa-flag");
	           $(this).addClass("fa-flag-o");
			   $(this).removeClass("redclr");
			   $(this).removeClass("greenclr");
        });
	    /*$(document).on('click', '.bookmarkicon', function () {
			   $(this).removeClass("fa-bookmark-o");
			   $(this).addClass("fa-bookmark");
			   $(this).addClass("blueclr");
        });*/
	</script>
	<script>
    // Set the date we're counting down to
    var countDownDate = new Date("Jan 25, 2021 15:37:25").getTime();
    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    var demo = document.getElementsByClassName("countertimer2");
	$.each( demo, function( key, value ) {
	   // Output the result in an element with id="demo"
		demo[key].innerHTML = days + " Days " + hours + " Hr " + minutes + " Min "  + seconds + " Sec ";
		// If the count down is over, write some text
		if (distance < 0) {
		    clearInterval(x);
		    demo[key].innerHTML = "EXPIRED";
		}
	});
    }, 1000);
// $(document).ready(function(){
// 	var user_id = "{{ Auth::id() }}";
// 	window.user_id = Math.floor(1000 + Math.random() * 9000)+'ID'+user_id;
// 	var vid_width = document.getElementById("course-details-panel").offsetWidth;
// 	init_vid_player('{{$courses_data[0]->video_link}}','{{ $courses_data[0]->course_name }}',vid_width);
// 	$('#uploadfile').change(function() {
//       $('#image_title').text(this.files && this.files.length ? this.files[0].name : '');
//     });
//     $("#course_chat_btn").click(function(e) {
//           e.preventDefault();
//           var fd = new FormData();
//           var files = $('#uploadfile')[0].files;
//           // Check file selected or not
//           if(files.length > 0 ){
//           fd.append('file',files[0]);
//           $.ajax({
//             url: '{{ route("front.chatbox") }}',
//             type: 'POST',
//               data:new FormData($("#upload_course_chats")[0]),
//               dataType:'JSON',
//               contentType: false,
//               cache: false,
//               processData: false,
//             success: function(data) {
//                   window.location.reload();
//               }
//           });
//         }else{
//             alert("Please select a file.");
//           }

//         });
//     $("#addrecommend").click(function(e) {
//          e.preventDefault();
//          var user_id = $('#user_id').val();
//          var course_id = $('#course_id').val();
//          var fd = new FormData();
//          var type = 'course';
//          fd.append('type',type);
//          fd.append('user_id',user_id);
//          fd.append('course_id',course_id);
//           var files = $('#imageupload')[0].files;
//           // Check file selected or not
//           if(files.length > 0 ){

//           fd.append('file',files[0]);
//             $.ajax({
//                 url: '{{ route("front.add_recommend") }}',
//                 type: 'POST',
//                 data:new FormData($("#add_recommend_form")[0]),
//                 dataType:'JSON',
//                 contentType: false,
//                 cache: false,
//                 processData: false,
//                 success: function(data) {
//                  window.location.href = '{{route("front.userrecommend")}}' + '/' + user_id + '/' + course_id;
//                 }
//             });
//         }else{
//             alert("Please select a file.");
//           }
//     });


//     /*$(".download_course").click(function(e) {
// 		e.preventDefault();
// 		var id = $('#download_course_id').val();
// 		var data_path = $('#download_course_id').attr('data-path');
// 		console.log(data_path);

// 		$.ajax({
// 		url: '{{ route('front.download_study_course') }}',
// 		type: 'POST',
// 		data:{id:id},
// 		success: function(response) {
// 				console.log(response);
// 			}
// 		});
//     });*/

// 	$('.nav-pills.playertab a').click(function(){
//   	  $('.breadcrumb .active').text($(this).text());
// 	});
// });

/*$(document).on("click",".topic_video_url",function(){
    let topic_video_url = $(this).attr('topic-video-url');
    let topic_video_title = $(this).attr('topic-video-title');
    //$('#topic_url_video').attr('src', topic_video_url);
	var vid_width = document.getElementById("course-details-panel").offsetWidth;
	init_vid_player(topic_video_url,topic_video_title,vid_width);
});
*/



$(document).on("click",".topic_video_url",function(){

    let topic_video_url = $(this).attr('topic-video-url');
    let topic_video_title = $(this).attr('topic-video-title');
    $('.videotitle').text('');
    $('.videotitle').text(topic_video_title);
    //  $('#topic_url_video').attr('src', topic_video_url);
	var vid_width = document.getElementById("course-details-panel").offsetWidth;
	$(".se-pre-con").show();

    $.ajax({
        url: '{{ route("front.get_video_url") }}',
        type: 'POST',
        data:{topic_video_url:topic_video_url},
        dataType:'JSON',
        success: function(data) {
            $(".se-pre-con").hide();
            var jwk_key = data.jwk_key;
            var key_ID = data.key_ID;
            var videoId = data.videoId;
            var ip = data.ip;

            const jwkKey = jwk_key;
            const keyID = key_ID;
            const videoID = videoId;
            // expiresTimeInS is the expired time in second of the video
            const expiresTimeInS = 3600
            streamSignedUrl();

            // Main function
            async function streamSignedUrl () {
              const encoder = new TextEncoder()
              const expiresIn = Math.floor(Date.now() / 1000) + expiresTimeInS
              const headers = {
                "alg": "RS256",
                "kid": keyID
              }
              const data = {
                "sub": videoID,
                "kid": keyID,
                "exp": expiresIn,
                "accessRules": [
                  {
            		"type": "ip.src",
            		"ip": [ip],
            		"action": "allow",
            	    },
                  {
                    "type": "any",
                    "action": "block"
                  }
                ]
              }

              const token = `${objectToBase64url(headers)}.${objectToBase64url(data)}`
              const jwk = JSON.parse(atob(jwkKey))
              const key = await crypto.subtle.importKey(
                "jwk", jwk,
                {
                  name: 'RSASSA-PKCS1-v1_5',
                  hash: 'SHA-256',
                },
                false, [ "sign" ]
              )
              const signature = await crypto.subtle.sign(
                { name: 'RSASSA-PKCS1-v1_5' }, key,
                encoder.encode(token)
              )
              const signedToken = `${token}.${arrayBufferToBase64Url(signature)}`
              jQuery('#player').html("<iframe src='https://iframe.videodelivery.net/"+signedToken+"'  id='stream-player'></iframe>");
              return signedToken
            }
            init_vid_player(topic_video_url,topic_video_title,vid_width);
        }
    });
    /***************************************************/
    const myTimeout = setTimeout(streamvideo, 5000);
    /***************************************************/
});

function streamvideo() {
  const player = Stream(document.getElementById('stream-player'));
    //player.autoplay();
    player.addEventListener('play', () => {
        console.log('playing!');
    });
    player.play().catch(() => {
        console.log('playback failed, muting to try again');
        player.muted = true;
        player.play();
    });
}



function arrayBufferToBase64Url(buffer) {
  return btoa(String.fromCharCode(...new Uint8Array(buffer)))
    .replace(/=/g, '')
    .replace(/\+/g, '-')
    .replace(/\//g, '_')
}

function objectToBase64url(payload) {
  return arrayBufferToBase64Url(
    new TextEncoder().encode(JSON.stringify(payload)),
  )
}



$(document).on("keyup",".searchBar", function() {
    var searchword = $(this).val();
    var course_id = $(this).attr('course_id');
    var topicidsstr = $(this).attr('topicidsstr');
    /*var topic_ids = [];
    $(".topicCls").each(function(){
        topic_ids.push($(this).attr('topic_id'));
    });*/
    $.ajax({
        url: '{{ route("front.searchChapter") }}',
        type: 'POST',
        data:{searchword,searchword,course_id:course_id,topicidsstr:topicidsstr},
        dataType:'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if(response.status == 1){
                $("#accordion").html('');
                $("#accordion").html(response.html);
            }
        },
    });
});

$(document).on("keydown",".searchBar", function() {
    var searchword = $(this).val();
    var course_id = $(this).attr('course_id');
    var topicidsstr = $(this).attr('topicidsstr');
    /*var topic_ids = [];
    $(".topicCls").each(function(){
        topic_ids.push($(this).attr('topic_id'));
    });*/
    $.ajax({
        url: '{{ route("front.searchChapter") }}',
        type: 'POST',
        data:{searchword,searchword,course_id:course_id,topicidsstr:topicidsstr},
        dataType:'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if(response.status == 1){
                $("#accordion").html('');
                $("#accordion").html(response.html);
            }
        },
    });
    });
        
    $(document).on("click",".topicElementCls",function(){
        var course_id = $(this).attr('course_id');
        var topic_id = $(this).attr('topic_id');
        var element_id = $(this).attr('element_id');
        var element_type = $(this).attr('element_type');
        $.ajax({
            url: '{{ route("front.last_watched_topic_element") }}',
            type: 'POST',
            data:{topic_id:topic_id,element_id:element_id,element_type:element_type,course_id:course_id},
            dataType:'JSON',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);
            },
        });
    });
    
    
    $(document).on("click",".pdfUrl",function(){
        var topic_id = $(this).parents("li").attr('topic_id');
        var element_id = $(this).parents("li").attr('element_id');
        var element_type = $(this).parents("li").attr('element_type');
        var course_id = $(this).parents("li").attr('course_id');
        var href = $(this).parents("a").attr("href1");
        $.ajax({
            url: '{{ route("front.user_progress") }}',
            type: 'POST',
            data:{
                    topic_id:topic_id,
                    element_id:element_id,
                    element_type:element_type,
                    course_id:course_id
            },
            dataType:'JSON',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(element_type == 1 && response.status == '1'){
                    window.open(href,'_blank');
                }
            },
        });
    });
    $(document).on("click",".flagCls",function(){
        
        if($(this).hasClass("far")){
            $(this).addClass("fa");
            $(this).removeClass("far");
        }else{
            $(this).removeClass("fa");
            $(this).addClass("far");
        }
        var topic_id = $(this).parents("li").attr('topic_id');
        var element_id = $(this).parents("li").attr('element_id');
        var element_type = $(this).parents("li").attr('element_type');
        var course_id = $(this).parents("li").attr('course_id');
        var href = $(this).parents("a").attr("href1");
        $.ajax({
            url: '{{ route("front.topicElementRepeat") }}',
            type: 'POST',
            data:{topic_id:topic_id,element_id:element_id,element_type:element_type,course_id:course_id},
            dataType:'JSON',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response.status);
            },
        });
    });
    
    
    $(document).on("click",".questionUrl",function(){
        var href = $(this).parents("a").attr("href1");
        window.location.href = href;
    });
    
    
    $(document).on("click",".videoUrl",function(){
        
        $(this).parents(".lecture-main").find(".topic_video_url").click();
        
        var topic_id = $(this).parents("li").attr('topic_id');
        var element_id = $(this).parents("li").attr('element_id');
        var element_type = $(this).parents("li").attr('element_type');
        var course_id = $(this).parents("li").attr('course_id');
        $.ajax({
            url: '{{ route("front.user_progress") }}',
            type: 'POST',
            data:{topic_id:topic_id,element_id:element_id,element_type:element_type,course_id:course_id},
            dataType:'JSON',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response.status);
            },
        });
    });
</script>
 @endsection
