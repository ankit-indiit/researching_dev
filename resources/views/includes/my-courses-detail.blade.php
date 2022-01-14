@extends('layouts.app')

@section('title', ' פרט הקורס שלי   ') 

@section('content')
<link href="{{ asset('assets/css/videre.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/videoapp.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> 
<?php // pr($courses_data[0]->course_name); die;  ?>
<div class="breadcrumb-inner-area pt-92">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <ul class="breadcrumb">
                	<li><a href="#"><i class="fas fa-home"></i> דף הבית</a></li>
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
						 	<h2><i class="fa fa-file-text"></i>
						 	    {{ $courses_data[0]->course_name }}
							    <!--מבוא לסטטיסטיקה-->
							</h2>
						 	<div class="course-meta" id="course-details-panel">
	<!--						<p>בשיעור זה, נלמד:</p>
							  	<p>מהו מדגם?</p>
                                <p>מהי אוכלוסיה?</p>
                                <p>סטטיסטיקה תיאורית </p>
                                <p>סטטיסטיקה היסקית</p>    -->
                                
                            <?php if(!empty($courses_data[0]->tagline1)){ ?>
                                <p>{{ $courses_data[0]->tagline1 }}</p>
                            <?php } ?>
                            
                            <?php if(!empty($courses_data[0]->tagline2)){ ?>
                                <p>{{ $courses_data[0]->tagline2 }}</p>
                            <?php } ?>
                            
                            <?php if(!empty($courses_data[0]->tagline3)){ ?>
                                <p>{{ $courses_data[0]->tagline3 }}</p>
                            <?php } ?>
                            
                            <?php if(!empty($courses_data[0]->tagline4)){ ?>
                                <p>{{ $courses_data[0]->tagline4 }}</p>
                            <?php } ?>
                            
                            <?php if(!empty($courses_data[0]->tagline5)){ ?>
                                <p>{{ $courses_data[0]->tagline5 }}</p>
                            <?php } ?>
							  	<!--<ul>
									<li><span>מהו מדגם?<br></span></li>
									<li><span>מהי אוכלוסיה?</span></li>
									<li><span>סטטיסטיקה תיאורית </span></li>
									<li><span>סטטיסטיקה היסקית<br></span></li>
								</ul>https://www.youtube.com/embed/-SFcIUEvNOQ  336812686 -->
						 	</div>
						 	<div class="fluid-course-video">
								<div id="player" class="vid-wrapper videre-container"></div>
							{{-- <iframe src="http://player.vimeo.com/video/80567526?autoplay=1&autopause=0&loop=1" allowfullscreen allow=autoplay id="topic_url_video"></iframe> --}}
							</div>
							<button class="btn btn-theme btn-circle2 mt-20"> <i class="fa fa-download"></i> 
							</button>
						</div>
					  	<?php if($comment_area_show == 1){?>
						  	<div class="comments-area" style="display:none">
								<div class="comments-form">
									<div class="title">
										<h4>השאירו ביקורת</h4>
									</div>
									<form method="POST" class="contact-comments" id="upload-chats" action="{{ route('front.ratings') }}" enctype="multipart/form-data">
										<div class="row">
	<!-- 									 		<div class="col-md-12">
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
						<button type="submit" class="btn btn-theme">
															   שלח
						</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	</div>
  	<?php }?>
</div>
<!-- End Course Info -->
<!-- Start Course Sidebar -->
   	<div class="col-md-3">
	  	<div class="aside">
		 	<!-- Sidebar Item -->
		 	<div class="sidebar-item course-info mycourse-side">
				<div class="title">
				   	<h2>סטטיסטיקה תיאורית (סטטיסטיקה א') </h2>
				</div>
				<div class="aboutsearch">
                     <div class="form-group">
                        <div class="input-group">
                           <input type="text" name="" placeholder="לחפש.." class="form-control">
                           <span class="input-group-addon"> <i class="ti-search"></i></span>
                        </div>
                     </div>
                 </div>
				<div class="mycourse-list">
					<div class="panel-group symb" id="accordion">
			        <?php
                        if(!empty($topics)){
                        $i = 1;
                        foreach($topics as $key=>$val){
                    ?>    
					<div class="panel panel-default">
						  	<div class="panel-heading">
							 	<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#ac1{{$i}}" aria-expanded="false" class="collapsed openeye" data-lecture-id="{{$val['id']}}">
										<strong></strong> {{ $val['topic_name'] }} <!--מבוא--> 
									</a>
							 	</h4>
						  	</div>
					  	<div id="ac1{{$i}}" class="panel-collapse collapse " aria-expanded="false" style="height: 0px;">
						 	<div class="panel-body p-0">
								<ul class="section-list">
                    			<?php
                    		    if(!empty($val['topic_video_data'])){
                    		        foreach($val['topic_video_data'] as $topic_video_key=>$topic_video_val){
                    			?>
                    			<li>
                    			  	<a class="item">
                    					<div class="title-container">
                    				  		<span class="lecture-main">		
                    				  			<span class="lecture-icon">	
                    			  				    <i class="fa fa-youtube-play"></i>
                    								<i class="flagicon fa fa-flag-o"></i>
                    							</span>
                    							<span class="lecture-name topic_video_url" topic-video-title="{{$topic_video_val['topic_video_title']}}" 
                    							topic-video-url="<?php echo (!empty($topic_video_val['topic_video_url']))?$topic_video_val['topic_video_url']:'http://player.vimeo.com/video/80567526?autoplay=1&autopause=0&loop=1';  ?>">
                    							<?php echo (!empty($topic_video_val['topic_video_title']))? $topic_video_val['topic_video_title'] : ''; ?>	   
                    							</span>
                    						</span>
                    					    <span class="bookmark"><i class="bookmarkicon fa fa-bookmark-o"></i></span>
                    					</div>
                    				</a>
                    			</li>
                    			<?php
                    		        }
                    		    }
                    			?>
                    			<?php 
                    			    if(!empty($val['quizTopics'])){
									  foreach($val['quizTopics'] as $quiz_key=>$quiz_val){
									      
									      $quiz_data = DB::table('quiz_questions')->where("quiz_id",$quiz_val['id'])->get();
							    ?>
                                <li>
                                    <?php
                                        if(count($quiz_data) > 0){
                                        ?>
                                        <a class="item" href="{{ route('front.simulation.show',['cid'=>$val['course_id'],'id' => $quiz_val['id']]) }}">        
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <a class="item" href="javascript:void(0)">
                                        <?php
                                        }
                                    ?>
                                  	<div class="title-container" >
                                		<span class="lecture-main">
                                		  	<span class="lecture-icon">
                                				<i class="fa fa-question"></i>
                                		  	</span>
                                	  	</span>
                                        <span class="lecture-name">
                                			<?php echo (!empty($quiz_val['quizTopic'])) ?$quiz_val['quizTopic']:''; ?>
                                			<?php echo (!empty($quiz_data && count($quiz_data) >0))?count($quiz_data):'0'; ?>  שאלות 
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
			   	
			   	
			   	
			   	
<!--			   	<div class="panel panel-default">
			  		<div class="panel-heading">
					 	<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#ac1_2" aria-expanded="false" class="collapsed openeye">
								<strong>02</strong> סולמות מדידה
							</a>
						 	</h4>
				  	</div>
  	<div id="ac1_2" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
	 	<div class="panel-body p-0">
		 	<ul class="section-list">
				<li>
				  	<a class="item">
						<div class="title-container">
						  	<span class="lecture-main">	
						  		<span class="lecture-icon">						
						  			<i class="fa fa-youtube-play"></i></span>
									<span class="lecture-icon">		
									<i class="flagicon fa fa-flag-o"></i>
								</span>
							<span class="lecture-name">
						סולמות מדידה של משתנים			
										  (18:19)
												  </span>
											   </span>
									   <span class="bookmark">
											  <i class="bookmarkicon fa fa-bookmark-o"></i>
												</div>
										  </a>
									</li>									
										  </ul>
												  </div>
											   </div>
											   </div>
											   <div class="panel panel-default">
												  <div class="panel-heading">
											<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#ac1_3" aria-expanded="false" class="collapsed closedeye">
										<strong>03</strong> מדדי מרכז
											</a>
													 </h4>
											 </div>
										<div id="ac1_3" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
										<div class="panel-body p-0">
								<ul class="section-list">
										<li>
										  <a class="item">				 
										<div class="title-container">
									  <span class="lecture-main"><span class="lecture-icon">	<i class="fa fa-youtube-play"></i>
											  </span>
										  <span class="lecture-icon">						  
									<i class="flagicon fa fa-flag-o"></i>
									</span>
							<span class="lecture-name">
										שכיח			
										<i class="bookmarkicon fa fa-bookmark-o"></i>	 </span>
									</div>						  </a>
										</li>					<li>
								  <a class="item" href="{{route('front.simulation')}}">
								<div class="title-container">
									  <span class="lecture-main">
									  <span class="lecture-icon">											<i class="fa fa-question"></i>
											  </span>
												  <span class="lecture-name">
											מיון של משתנים				
																			שאלות )
																			  </span>
																		  </span>
																		</div>
																	  </a>
																	</li>
																	<li>
																	  <a class="item">
																		<div class="title-container">
																		  <span class="lecture-main">
																			  <span class="lecture-icon">
																				<i class="fa fa-file-text"></i>
																			  </span>
																			  <span class="lecture-name">
																				חציון
																			  </span>
																		  </span>
																		</div>
																	  </a>
																	</li>
																	<li>
																	  <a class="item">
																		<div class="title-container">
																		 <span class="lecture-main">									  
																			  <span class="lecture-icon">				
																				<i class="fa fa-youtube-play"></i>
																			  </span>
																			  <span class="lecture-icon">									  
																				<i class="flagicon fa fa-flag-o"></i>
																			  </span>
																			  <span class="lecture-name">
																				ממוצע(19:39)
																			  </span>
																		   </span>
																			   <span class="bookmark">
																				  <i class="bookmarkicon fa fa-bookmark-o"></i>
																			   </span>
																		</div>
																	  </a>
																	</li>
															  </ul>
												  </div>
											   </div>
											   </div>
						<div class="panel panel-default">
								<div class="panel-heading">
			<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#ac1_4" aria-expanded="false" class="collapsed openeye">
						<strong>04</strong> פעולות על משתנים
											</a>
													 </h4>
												  </div>
							<div id="ac1_4" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
					<div class="panel-body p-0">
										<ul class="section-list">
										<li>
										  <a class="item" href="{{route('front.simulation')}}">
										
											<div class="title-container">
											  <span class="lecture-main">
												  <span class="lecture-icon">
													<i class="fa fa-question"></i>
												  </span>
												  <span class="lecture-name">
													טרנספורמציות
													
													  (2 שאלות)
												  </span>
											  </span>
											</div>
										  </a>
										</li>
										
										<li>
										  <a class="item">
											
											<div class="title-container">
											  <span class="lecture-main">
											  <span class="lecture-icon">
												<i class="fa  fa-file-text"></i>
											  </span>
											  <span class="lecture-name">
												חוקי סכימה
											  </span>
											  </span>
											</div>
										  </a>
										</li>
								  </ul>
												  </div>
											   </div>
											   </div>
								  
		                         <div class="panel panel-default">
												  <div class="panel-heading">
													 <h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#ac1_5" aria-expanded="false" class="collapsed openeye">
							<strong>05</strong> מבוא
														</a>
									</h4>
												  </div>
									<div id="ac1_5" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
				<div class="panel-body p-0">
								<ul class="section-list">
										<li>
										  <a class="item">
											<div class="title-container">
											   <span class="lecture-main">									  
												  <span class="lecture-icon">				
													<i class="fa fa-youtube-play"></i>
												  </span>
												  <span class="lecture-icon">									  
													<i class="flagicon fa fa-flag-o"></i>
												  </span>
												  <span class="lecture-name">
													מבוא לסטטיסטיקה
													  (12:53)
												  </span>
											   </span>
											   <span class="bookmark">
												   <i class="bookmarkicon fa fa-bookmark-o"></i>
											   </span>
											</div>
										  </a>
										</li>
										
										<li>
										  <a class="item" href="{{route('front.simulation')}}">
										
											<div class="title-container">
											  <span class="lecture-main">
											  <span class="lecture-icon">
												<i class="fa fa-question"></i>
											  </span>
											  <span class="lecture-name">
												מיון של משתנים
												  (2 שאלות )
											  </span>
											  </span>
											</div>
										  </a>
										</li>
								  </ul>
												  </div>
											   </div>
											   </div>
											   <div class="panel panel-default">
												  <div class="panel-heading">
													 <h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#ac1_6" aria-expanded="false" class="collapsed closedeye">
								<strong>06</strong> סולמות מדידה
									</a>
													 </h4>
												  </div>
												  <div id="ac1_6" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
											<div class="panel-body p-0">
                                				<ul class="section-list">
                                				    <li>
                                						<a class="item">
                                							<div class="title-container">
                                							<span class="lecture-main">			  
                                								<span class="lecture-icon">				
                                									<i class="fa fa-youtube-play"></i>
                                					            </span>
                                								<span class="lecture-icon">			  
                                									<i class="flagicon fa fa-flag-o"></i>
                                								</span>
                                								<span class="lecture-name">
                                									סולמות מדידה של משתנים
                                								    (18:19)
                                								</span>
                                							</span>
                                							<span class="bookmark">
                                							    <i class="bookmarkicon fa fa-bookmark-o"></i>
                                							</span>
                                							</div>
                                						</a>
                                					</li>				
                                				</ul>
											</div>
											   </div>
											   </div>
											   <div class="panel panel-default">
												  <div class="panel-heading">
													 <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#ac1_7" aria-expanded="false" class="collapsed closedeye">
						<strong>07</strong> מדדי מרכז
							</a>
													 </h4>
												  </div>
												  <div id="ac1_7" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
													 <div class="panel-body p-0">
					<ul class="section-list">
																i>
											  <a class="item">
										<div class="title-container">
									  <span class="lecture-main">				  
										<span class="lecture-icon">				
									<i class="fa fa-youtube-play"></i>
												  </span>
												  <span class="lecture-icon">	<i class="flagicon fa fa-flag-o"></i>
												  </span>
											  <span class="lecture-name">
											שכיח  (12:51)
								 </span>													   <span class="bookmark">
										 <i class="bookmarkicon fa fa-bookmark-o"></i>
										  </span>
												</div>
											  </a>
											</li>
												<li>
									  <a class="item" href="{{route('front.simulation')}}">
										<div class="title-container">
									  <span class="lecture-main">
											  <span class="lecture-icon">
												<i class="fa fa-question"></i>
										  </span>
											  <span class="lecture-name">
											מיון של משתנים
											  (2 שאלות )
											  </span>
											  </span>
												</div>
										  </a>
											</li>
												<li>
											  <a class="item">
											<div class="title-container">
											 <span class="lecture-main">	
											  <span class="lecture-icon">
																				<i class="fa fa-file-text"></i>
																			  </span>
																			  <span class="lecture-name">
																				חציון
																			  </span>
																		  </span>
																		</div>
																	  </a>
																	</li>
																	<li>
																	  <a class="item">																
																		<div class="title-container">
																		<span class="lecture-main">									  
																			  <span class="lecture-icon">				
																				 <span class="video-youtube"><span>2</span><i class="fa fa-youtube-play"></i></span>
																			  </span>
																			  <span class="lecture-icon">									  
																				<i class="flagicon fa fa-flag-o"></i>
																			  </span>
																			  <span class="lecture-name">
																				ממוצע (19:39)
																			  </span>
																		  </span>
																		   <span class="bookmark">
																			 <i class="bookmarkicon fa fa-bookmark-o"></i>
																		  </span>
																		</div>
																	  </a>
																	</li>
															  </ul>
												  </div>
											   </div>
											   </div>
											   <div class="panel panel-default">
												  <div class="panel-heading">
													 <h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#ac1_8" aria-expanded="false" class="collapsed openeye">
														<strong>08</strong> פעולות על משתנים
														</a>
													 </h4>
												  </div>
												  <div id="ac1_8" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
													 <div class="panel-body p-0">
															<ul class="section-list">
										<li>
										  <a class="item" href="{{route('front.simulation')}}">
										
											<div class="title-container">
											  <span class="lecture-main">
											  <span class="lecture-icon">
												<i class="fa fa-question"></i>
											  </span>
											  <span class="lecture-name">
												טרנספורמציות
												
												  (2 שאלות)
											  </span>
											  </span>
											</div>
										  </a>
										</li>
										
										<li>
										  <a class="item">
											
											<div class="title-container">
											
											  <span class="lecture-main">
												  <span class="lecture-icon">
													<i class="fa  fa-file-text"></i>
												  </span>
												  <span class="lecture-name">
													חוקי סכימה
												  </span>
											  </span>
											</div>
										  </a>
										</li>
								  </ul>
												  </div>
											   </div>
											   </div>-->
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
						    <input type ="hidden" id = "download_course_id" value="{{$value->id}}">
						   <li><a id ="download_course"> <div><i class="fa fa-folder iconfolder"></i>{{$path_parts['filename']}}</div>   <i class="fa fa-download downloadicon"></i></a></li>
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
			     $(this).removeClass("redclr")
			   $(this).removeClass("greenclr");
     });
	  $(document).on('click', '.bookmarkicon', function () {
			   $(this).removeClass("fa-bookmark-o");
			   $(this).addClass("fa-bookmark");
			   $(this).addClass("blueclr");
     });
	
		
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
$(document).ready(function(){
	var user_id = "{{ Auth::id() }}";
	window.user_id = Math.floor(1000 + Math.random() * 9000)+'ID'+user_id;
	var vid_width = document.getElementById("course-details-panel").offsetWidth;
	init_vid_player('{{$courses_data[0]->video_link}}','{{ $courses_data[0]->course_name }}',vid_width);
	$('#uploadfile').change(function() {
      $('#image_title').text(this.files && this.files.length ? this.files[0].name : '');
    });
    $("#course_chat_btn").click(function(e) {
          e.preventDefault();
          var fd = new FormData();
          var files = $('#uploadfile')[0].files;
           // Check file selected or not
          if(files.length > 0 ){
           fd.append('file',files[0]);
          $.ajax({
            url: '{{ route("front.chatbox") }}',
            type: 'POST',
              data:new FormData($("#upload_course_chats")[0]),
              dataType:'JSON',
              contentType: false,
              cache: false,
              processData: false,
            success: function(data) {
                  window.location.reload();
              }
          });
        }else{
            alert("Please select a file.");
          }

        });
    $("#addrecommend").click(function(e) {
         e.preventDefault();
         var user_id = $('#user_id').val();
         var course_id = $('#course_id').val();
         var fd = new FormData();
         var type = 'course';
         fd.append('type',type);
         fd.append('user_id',user_id);
         fd.append('course_id',course_id);
          var files = $('#imageupload')[0].files;
           // Check file selected or not
          if(files.length > 0 ){
          	
           fd.append('file',files[0]);
          $.ajax({
            url: '{{ route("front.add_recommend") }}',
            type: 'POST',
              data:new FormData($("#add_recommend_form")[0]),
              dataType:'JSON',
              contentType: false,
              cache: false,
              processData: false,
            success: function(data) {
                 window.location.href = '{{route("front.userrecommend")}}' + '/' + user_id + '/' + course_id;
              }
          });
        }else{
            alert("Please select a file.");
          }
    	
     	
     	
           });
    $("#download_course").click(function(e) {
		e.preventDefault();
		var id = $('#download_course_id').val();
		$.ajax({
		url: '{{ route('front.download_study_course') }}',
		type: 'POST',
			data:{id:id},
		success: function(response) {
				console.log(response);
			}
		});

    });

	$('.nav-pills.playertab a').click(function(){
  	  $('.breadcrumb .active').text($(this).text());
	});
});

$(document).on("click",".topic_video_url",function(){
    let topic_video_url = $(this).attr('topic-video-url');
    let topic_video_title = $(this).attr('topic-video-title');
    //$('#topic_url_video').attr('src', topic_video_url);
	var vid_width = document.getElementById("course-details-panel").offsetWidth;
	init_vid_player(topic_video_url,topic_video_title,vid_width);
}); 
</script>
 @endsection