@extends('layouts.app')

@section('title', ' פירוט חבילה   ')

@section('content')


     
  
     
      <!-- Start Course Details 
         ============================================= -->
      <div class="course-details-area default-padding-lg pb-40" style="direction: rtl;">
         <div class="container">
            <div class="row sidebar-sec">
               <!-- Start Course Info -->
               <div class="col-md-8" style="">
                  <div class="courses-info">
                     <!--h2>
                        כלכלה – מאקרו
                     </h2-->
                    <div class="course-meta">
                        <div class=" instutemain">
                        <div class="item category instuteinfo">
                           <h4>פְּסִיכוֹלוֹגִיָה </h4>
						     <h4>עיצוב גרפי</h4>
							  <h4> לפי: <b>ד"ר רותי פלד</b></h4>
                        </div>

                        <div class="item category instutlogo">
                          <img height="60px" src="{{ asset('/assets/img/instut1.png') }}">
                        </div>
                        </div>
                     </div>
                     <!-- <img src="assets/img/courses/course_economics_portfolio_feat.jpg" alt="Thumb" class="w-100"> -->
                      <div class="icn">
                     <div class="fluid-width-video-wrapper" >
                        <iframe src="https://player.vimeo.com/video/80567526?autoplay=0&autopause=0" allowfullscreen ></iframe>
					
                     </div>
                    </div>

                     
                     <!-- Star Tab Info -->
                     <div class="tab-info">
                        <!-- Tab Nav -->
                        <ul class="nav nav-pills">
                           <li class="active">
                              <a data-toggle="tab" href="#tab1" aria-expanded="true">
                    פרטי הקורס
                              </a>
                           </li>
						    <li>
                              <a data-toggle="tab" href="#tab2" aria-expanded="false">
                     חומרי לימוד לקורס
                              </a>
                           </li>
                           <!--li>
                              <a data-toggle="tab" href="#tab4" aria-expanded="false">
                       סטודנטים ממליצים
                              </a>
                           </li-->
                           <li>
                              <a data-toggle="tab" class="tab3 " href="#tab3" aria-expanded="false">
                         שאלות ותשובות
                              </a>
                           </li>
                          
                        </ul>
                        <!-- End Tab Nav -->
                        <!-- Start Tab Content -->
                        <div class="tab-content tab-content-info">
                           <!-- Single Tab -->
                           <div id="tab1" class="tab-pane fade active in">
                              <?php
                        foreach ($courses_data as $course_data) { ?>
                        
                        <div class="info title">
                          <div class="course-main2 ">
                            <h2 class="mb-0 ">{{$course_data->course_name}} – מאקרו</h2>
                              <h3> מַדְרִיך: ר רותי פלד   </h3>
                          </div>
                            <h4 class="mt-30"> מנהיגים עסקיים של מחר </h4>
                            <p>{{$course_data->description}}</p>
                            <p>{{$course_data->description}}</p>
                            <p>{{$course_data->description}}</p>
                 
                            <h4>בנה את העתיד שלך באמצעות</h4>
                            <p>{{$course_data->description}}</p>
                          <div class="course-main d-block mt-30">
                            <?php } ?>
                            <h2><b>סילבוס הקורס</b></h2>
                              <div class="course-list-items acd-items acd-arrow">
                                <div class="panel-group symb" id="accordion">
                                  <?php
                                  $count = 0; 
                                  foreach ($syllabus as $lecture => $get_data) {
                                    foreach ($get_data as $data) {
                                      $count += 1;
                                   ?>
                                  <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#ac1{{$data->id}}" aria-expanded="false" class="collapsed">
                                          <span class="pull-left lesson-duration">52:39 דק’</span>
                                          <span class="purchasecost">₪50</span>
                                          <strong>{{$count}}</strong> {{$data->title}}
                                        </a>
                                      </h4>
                                    </div>
                                    <div id="ac1{{$data->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                      <?php foreach ($data->topics as $topic) { ?>
                                     <div class="panel-body p-0">
                                        <ul class="mb-0  p-0">
                                           <li class ="border-bottom">
                                          <a class="border-0 courselist" href="#">
                                            <div class="topic-title">{{$topic->topic_name}}</div>
                                            <span class="duration float-left ml-5">
                                                 {{$topic->topic_duration}}  דק 
                                            </span>                                 
                                          </a>
                                    </li>
                                  </ul> 
                                                                                                                                                                                                                                                                                   
                                             </div>
                                             <?php } ?>
                                          </div>
                                       </div>
                                        <?php } ?>
                                   <?php } ?>
                                    </div>
                                 </div>
                              </div>
                              </div>
                           </div>
                           <!-- End Single Tab -->
                           <!-- Single Tab -->
                           <div id="tab3" class="tab-pane fade">
                              <div class="info title">
							  
							  
                                 <h4>מותאם אישית ללמידה מהירה </h4>
                                 <p>
                                    לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז שנות ה 1500-, כאשר מדפסת לא ידועה לקחה מטה מסוג וקימה אותו כדי ליצור ספר דגימה. היא שרדה לא רק חמש מאות שנים, אלא גם את הקפיצה לכתב עבודות אלקטרוני, ונותרה בעינה ללא שינוי.
                                 </p>
                                 <h4>רשימת קורסים </h4>
	

      <!--div ss-container class="scrollbar-inner" style="height:300px ;direction:ltr"-->
        <!-- Start Course List -->
         <div class="course-list-items acd-items acd-arrow courseq-a">
            <div class="panel-group symb" id="accordion">
               <?php foreach ($questions as $question) { ?>
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h4 class="panel-title">
                        <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#ac11{{$question->id}}">
                        <strong>{{$question->id}}</strong> 
                                    <div>{{$question->questions}} </div>                                                       
                        </a>
                     </h4>
                  </div>
                  <div id="ac11{{$question->id}}" class="panel-collapse collapse ">
                     <div class="panel-body">
                    <p>{{$question->answers}}</p> </div>
                  </div>
               </div>
            <?php } ?>
                                    </div>
                                 </div>
                                 <!-- End Course List -->
      <!--/div-->





                              </div>
                           </div>
                           <!-- End Single Tab -->
                           <!-- Single Tab -->
                           <div id="tab4" class="tab-pane fade">
						   <div class="info title">
                                        <div class="advisor-list-items">
                                          
                                            <div class="item">
                                                <div class="thumb">
                                                    <img src="assets/img/team/2.jpg" alt="Thumb">
                                                </div>
                                                <div class="info">
                                                    <div class="author text-right">
                                                        <h4>ג'ון סמית</h4>
                                                      
                                                    </div>
                                                  <div> <span><i class="ti-star"></i></span> <span><i class="ti-star"></i></span> <span><i class="ti-star"></i></span> <span><i class="ti-star"></i></span> <span><i class="ti-star"></i></span> </div>
                                                    <p>
                                                      לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה.
                                                    </p>
													<h5><b>ג'ון סמית</b></h5>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="thumb">
                                                    <img src="assets/img/team/3.jpg" alt="Thumb">
                                                </div>
                                                <div class="info">
                                                    <div class="author text-right">
                                                        <h4>ג'ון סמית</h4>
                                                      
                                                    </div>
                                                     <div> <span><i class="ti-star"></i></span> <span><i class="ti-star"></i></span> <span><i class="ti-star"></i></span> <span><i class="ti-star"></i></span> <span><i class="ti-star"></i></span> </div>
                                                    <p>
                                                      לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה.
                                                    </p>
													<h5><b>ג'ון סמית</b></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
						   
						   </div>
                           <div id="tab2" class="tab-pane fade">
                              <div class="info title">
							  <div class="course-main2">
							    <h2> <span>העלה קבצים</span>
                              
                            </h2>
                            
</div>				
<form method="POST" id="upload_package_docs" action="{{ route('front.upload_docs') }}" enctype="multipart/form-data">
               @csrf
               <?php
                        foreach ($courses_data as $course_data) { ?>				
                               <div class="uploadfiles">
                <label for="uploadfile"><i class="fa fa-upload"></i><p id ="image_title"> אנא בחר בקובץ   </p></label>
               <input style="display:none" type="file"  name="uploadfile"  id="uploadfile"/>
               </div>
                               <button id  = "upload_package_btn" type = "submit" class="btn btn-join ">
          שלח
           
           </button>
           <input type = "hidden" name = 'docs_course_id' value = "{{$course_data->course_id}}"/>
          <?php }?>
          </form>
                                
                              </div>
                           </div>
                           <!-- End Single Tab -->
                 
                        </div>
                        <!-- End Tab Content -->
                     </div>
                     <!-- End Tab Info -->
					 <div class="whtsbtn">
					  <ul class="socialshare2">
						    <li><a href="" class="social-icon"><i class="fab fa-whatsapp"></i> להצטרפות לקבוצת הלמידה</a></li>
						   
						   </ul>
					 </div>             
		
                       
                  </div>
               </div>
               <!-- End Course Info -->
               <div class="col-md-4" >
               <div class="blog-area"  id="sidebarss">
                 
                  <div  class="sidebar1 "  id="sidebartop">
				    <a href="courses.html" class="btn btn-md d-block outline-btn">עבור לעמוד שאר הקורסים </a>
                     <aside id="sidebar1">
                        <div class="sidebar-item purschase-box">
                           <h2 class="text-center"><span class="purchase-del">₪500</span><span class="purchase-ins">₪400</span></h2>
                           <a href="#" class="btn btn-theme effect btn-md d-block"  data-toggle="modal" data-target="#loginModal">קנה עכשיו </a>
                           <a href="#" class="btn btn-md d-block outline-btn">הוסף לעגלה  </a>
					
                              <h5>לִכלוֹל :</h5>
                              <ul>
                                 <li><i class="ti-alarm-clock"></i>  <span>00:02:28 שעות לפי דרישה  </span></li>
                                 <li><i class="ti-video-camera"></i><span>4 שיעורי וידאו </span></li>
                                 <li><i class="ti-pencil"></i><span>11 מבחני תרגול</span> </li>
                                  </ul>
                        </div>
						<div class="sidebar-item similar-courses">
                            <div class="title">
                                <h4>חבילות במבצע</h4>
                            </div>
                            <ul>
                              <?php
                        foreach ($courses_new_data as $course_new_data) { 
                          $image =  asset('/assets/img/courses/' .$course_new_data->image);
                          ?>
                                <li>
                                    <div class="thumb">
                                        <a href="#">
                                            <img src="{{ $image }}" alt ="Thumb">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <a href="#">{{$course_new_data->course_name}} </a>
										<p>
                                    {{ Str::limit($course_new_data->description, 30) }}
                                 </p>
								 <span>₪{{$course_new_data->price}}</span>
                                       
                                    </div>
                                </li>
                                                              <?php }?>
                          
								
                            </ul>
                        </div>
						<div class="sidebar-item similar-courses">
						<div class="title">
						<h4>מרצה באתר</h4>
						</div>
            <?php
                        foreach ($instructors_data as $instructor_data) {
                          $image =  asset('/assets/img/team/' .$instructor_data->avatar);
                         ?>
						<ul>
                           <li>
                              <div class="thumb w130">
                                 <a href="#team1" data-toggle="modal">
                                 <img src="{{ $image }}" alt ="Thumb">
                                 </a>
                              </div>
                              <div class="info">
                                 <a href="#team1" data-toggle="modal">{{$instructor_data->instructor_name}}</a>
                                 <p>{{ Str::limit($instructor_data->about, 40) }}</p>
                              
                              </div>
                           </li>
                          
                        </ul>
                        <?php } ?>
						</div>
								<div class="sidebar-item similar-courses">
						<div class="title">
						<h4>סטודנטים ממליצים</h4>
						</div>
						<div class="advisor-list-items">
                                          
                                            <div class="item">
                                                <div class="thumb">
                                                    <img src="{{ asset('/assets/img/team/2.jpg') }}" alt ="Thumb">
                                                </div>
                                                <div class="info">
                                                    <div class="author text-right">
                                                        <h4>ג'ון סמית</h4>
                                                      
                                                    </div>
                                                  <div> <span><i class="ti-star"></i></span> <span><i class="ti-star"></i></span> <span><i class="ti-star"></i></span> <span><i class="ti-star"></i></span> <span><i class="ti-star"></i></span> </div>
                                                    <p>
                                                      לורם איפסום הוא פשוט טקסט דמה של .
                                                    </p>
												
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="thumb">
                                                    <img src="{{ asset('/assets/img/team/3.jpg') }}" alt ="Thumb">
                                                </div>
                                                <div class="info">
                                                    <div class="author text-right">
                                                        <h4>ג'ון סמית</h4>
                                                      
                                                    </div>
                                                     <div> <span><i class="ti-star"></i></span> <span><i class="ti-star"></i></span> <span><i class="ti-star"></i></span> <span><i class="ti-star"></i></span> <span><i class="ti-star"></i></span> </div>
                                                    <p>
                                                      לורם איפסום הוא פשוט טקסט.
                                                    </p>
													
                                                </div>
                                            </div>
                                        </div>
						</div>
						
						<div class="sidebar-item similar-courses">
						    <!--ul class="socialshare2">
						    <li><a href="" class="social-icon"><i class="fab fa-whatsapp"></i> להצטרפות לקבוצת הלמידה</a></li>
						   
						   </ul-->
						   <div class="share-as">
						  <h4>שתף כ</h4>
						   </div>
						   <ul class="socialshare">
						  
						    <li><a href="" class="social-icon facebook"><i class="fab fa-facebook"></i>Facebook</a></li>
						    <li><a href="" class="social-icon twitter"><i class="fab fa-twitter"></i>Twitter</a></li>
						    <li><a href="" class="social-icon instagram"><i class="fab fa-instagram"></i>Instagram</a></li>
						     
						   </ul>
						</div>
                     </aside>
					
                  </div>
                  </div>
                  </div>
               </div>
          
    
 
		  </div>
         </div>
         </div>
 <div class="curveup2">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 220"><path fill="#f7f7f7" fill-opacity="1" d="M0,64L60,64C120,64,240,64,360,74.7C480,85,600,107,720,112C840,117,960,107,1080,90.7C1200,75,1320,53,1380,42.7L1440,32L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg>
	  </div>
	  <div class="popular-courses-area bg-gray active-dots carousel-shadow weekly-top-items pb-0">
         <!-- End Fidex BG -->
         <div class="container">
            <div class="row">
               <div class="site-heading text-center">
                  <div class="col-md-8 col-md-offset-2">
                     <h2>קורסים קשורים </h2>
                  </div>
               </div>
            </div>
            <div class="row">
             <div class="col-md-12">
			   <div class="tab-content tab-content-info">
			      <div class="tabcourses">
					 <ul class="nav nav-pills  justify-content-center">
					  <li class="btnglow"> <a data-toggle="tab" href="#tab22" aria-expanded="false">
                       חבילות במבצע
                        </a> 
                     </li>
                     <li class="active "> <a data-toggle="tab" href="#tab11" aria-expanded="true">
                      קורסים בודדים
                        </a> 
                     </li>
                    
                    
                  </ul>
				  </div>
                     <!-- Single Tab -->
                     <div id="tab11" class="tab-pane fade active in">
              
			   

                  <div class="top-course-items courses-carousel owl-carousel owl-theme">
                     <div class="item text-right">
                        <a class="thumb">
                           <img src="{{ asset('/assets/img/courses/course_economics_portfolio_feat.jpg') }}" alt ="Thumb">
                        </a>
                        <div class="info">
                          
                           <h4>
                              <a href="#">כַּלכָּלָנוּת  </a>
                           </h4> <div class="meta">
                              <ul>
                                 <li>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                 
                                 </li>
                               
                              </ul>
                           </div>
                           <p>
                              המוסד המודרני שלנו מעוניין לטפח סביבה בה סטודנטים צעירים יכולים להתכנס וללמוד בסביבה יצירתית וגמישה. אנו עובדים בשיתוף פעולה עם תלמידינו כדי להשיג תוצאות יוצאות מן הכלל.
                           </p>
                           <div class="footer-meta">
                              <h4>$23.00</h4>
                          <div class="btn-btm">
                                    <a class="btn btn-theme effect btn-sm" href="#">קנה עכשיו  </a>
                                    <a class="btn btn-theme btnoutline effect btn-sm" href="#">הוסף לעגלה    </a>
									  </div>
                           </div>
                        </div>
                     </div>
                     <div class="item text-right">
                        <a class="thumb">
                           <img src="{{ asset('/assets/img/courses/course_biology_portfolio_feat.jpg') }}" alt ="Thumb">
                        </a>
                        <div class="info">
                          
                           <h4>
                              <a href="#">עביולוגיה </a>
                           </h4> <div class="meta">
                              <ul>
                                 <li>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                
                                 </li>
                                
                              </ul>
                           </div>
                           <p>
                              המוסד המודרני שלנו מעוניין לטפח סביבה בה סטודנטים צעירים יכולים להתכנס וללמוד בסביבה יצירתית וגמישה. אנו עובדים בשיתוף פעולה עם תלמידינו כדי להשיג תוצאות יוצאות מן הכלל.
                           </p>
                           <div class="footer-meta">
                              <h4>$23.00</h4>
                             <div class="btn-btm">
                                    <a class="btn btn-theme effect btn-sm" href="#">קנה עכשיו  </a>
                                    <a class="btn btn-theme btnoutline effect btn-sm" href="#">הוסף לעגלה    </a>
									  </div>
                           </div>
                        </div>
                     </div>
                     <!-- Single Item -->
                     <div class="item text-right">
                        <a class="thumb">
                           <img src="{{ asset('/assets/img/courses/course_graphic_design_portfolio_feat.jpg') }}" alt ="Thumb">
                        </a>
                        <div class="info">
                          
                           <h4>
                              <a href="#">עיצוב גרפי  </a>
                           </h4> <div class="meta">
                              <ul>
                                 <li>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                               
                                 </li>
                                
                              </ul>
                           </div>
                           <p>
                              המוסד המודרני שלנו מעוניין לטפח סביבה בה סטודנטים צעירים יכולים להתכנס וללמוד בסביבה יצירתית וגמישה. אנו עובדים בשיתוף פעולה עם תלמידינו כדי להשיג תוצאות יוצאות מן הכלל.
                           </p>
                           <div class="footer-meta">
                              <h4>$23.00</h4>
                           <div class="btn-btm">
                                    <a class="btn btn-theme effect btn-sm" href="#">קנה עכשיו  </a>
                                    <a class="btn btn-theme btnoutline effect btn-sm" href="#">הוסף לעגלה    </a>
									  </div>
                           </div>
                        </div>
                     </div>
                     <div class="item text-right">
                        <a class="thumb">

                           <img src="{{ asset('/assets/img/courses/course_music_portfolio_feat.jpg') }}" alt ="Thumb">
                        </a>
                        <div class="info">
                        
                           <h4>
                              <a href="#">הפקה מוזיקלית </a>
                           </h4>   <div class="meta">
                              <ul>
                                 <li>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                 
                                 </li>
                                
                              </ul>
                           </div>
                           <p>
                              המוסד המודרני שלנו מעוניין לטפח סביבה בה סטודנטים צעירים יכולים להתכנס וללמוד בסביבה יצירתית וגמישה. אנו עובדים בשיתוף פעולה עם תלמידינו כדי להשיג תוצאות יוצאות מן הכלל.
                           </p>
                           <div class="footer-meta">
                              <h4>$23.00</h4>
                              <div class="btn-btm">
                                    <a class="btn btn-theme effect btn-sm" href="#">קנה עכשיו  </a>
                                    <a class="btn btn-theme btnoutline effect btn-sm" href="#">הוסף לעגלה    </a>
									  </div>
                           </div>
                        </div>
                     </div>
                  </div>
              
               </div>
			 <div id="tab22" class="tab-pane fade">
            
			   

                  <div class="top-course-items courses-carousel2 owl-carousel owl-theme">
				  <div class="item">
                   <div class="packagedeal" style="direction: rtl;">
							<div class="packageinner">
							  <a href="package-detail.html" class="thumb">
									 <img src="{{ asset('/assets/img/courses/course_economics_portfolio_feat.jpg') }}" alt ="Thumb">  
								  </a>
								  <div class="info">
									 <h4>
										<a href="package-detail.html">כַּלכָּלָנוּת</a>
									 </h4> 
									 <p>
										המוסד המודרני שלנו מעוניין לטפח סביבה בה סטודנטים צעירים יכולים להתכנס וללמוד בסביבה יצירתית וגמישה. אנו עובדים בשיתוף פעולה עם תלמידינו כדי להשיג תוצאות יוצאות מן הכלל.
									 </p>
									
								  </div>
								  </div>
													<div class="packageinner">
							 <a  href="package-detail.html" class="thumb">
                                 <img src="{{ asset('/assets/img/courses/course_graphic_design_portfolio_feat.jpg') }}" alt ="Thumb">  
                              </a>
                             <div class="info">
                                 
                                 <h4>
                                    <a href="package-detail.html">עיצוב גרפי  </a>
                                 </h4>
                                 <p>
                                    המוסד המודרני שלנו מעוניין לטפח סביבה בה סטודנטים צעירים יכולים להתכנס וללמוד בסביבה יצירתית וגמישה. אנו עובדים בשיתוף פעולה עם תלמידינו כדי להשיג תוצאות יוצאות מן הכלל.
                                 </p>
                                <div class="footer-meta">
								 <div class="btn-btm">
                                    <a class="btn btn-theme effect btn-sm" href="#">קנה עכשיו  </a>
                                    <a class="btn btn-theme btnoutline effect btn-sm" href="#">הוסף לעגלה    </a>
									  </div>
                                    <h4>$23.00</h4>
                                 </div>
                              </div>
								  </div>

						
						</div>
                          </div>
      <div class="item">
<div class="packagedeal" style="direction: rtl;">
							<div class="packageinner">
							  <a href="package-detail.html" class="thumb">
									 <img src="{{ asset('/assets/img/courses/course_physics_portfolio_feat.jpg') }}" alt ="Thumb"> 
								  </a>
								  <div class="info">
									 <h4>
										<a href="package-detail.html">כַּלכָּלָנוּת</a>
									 </h4> 
									 <p>
										המוסד המודרני שלנו מעוניין לטפח סביבה בה סטודנטים צעירים יכולים להתכנס וללמוד בסביבה יצירתית וגמישה. אנו עובדים בשיתוף פעולה עם תלמידינו כדי להשיג תוצאות יוצאות מן הכלל.
									 </p>
									
								  </div>
								  </div>
													<div class="packageinner">
							 <a  href="package-detail.html" class="thumb">
                                 <img src="{{ asset('/assets/img/courses/course_biology_portfolio_feat.jpg') }}" alt ="Thumb">  
                              </a>
                             <div class="info">
                                 
                                 <h4>
                                    <a href="package-detail.html">עיצוב גרפי  </a>
                                 </h4>
                                 <p>
                                    המוסד המודרני שלנו מעוניין לטפח סביבה בה סטודנטים צעירים יכולים להתכנס וללמוד בסביבה יצירתית וגמישה. אנו עובדים בשיתוף פעולה עם תלמידינו כדי להשיג תוצאות יוצאות מן הכלל.
                                 </p>
                                <div class="footer-meta">
								 <div class="btn-btm">
                                    <a class="btn btn-theme effect btn-sm" href="#">קנה עכשיו  </a>
                                    <a class="btn btn-theme btnoutline effect btn-sm" href="#">הוסף לעגלה    </a>
									  </div>
                                    <h4>$23.00</h4>
                                 </div>
                              </div>
								  </div>

						
						</div>
                    
				</div>
				</div>
              
               </div>
               </div>
            </div>
         </div>
         </div>
      </div>
      <!-- End Popular Courses -->
 <div class="curvedown2">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 220"><path fill="#f7f7f7" fill-opacity="1" d="M0,64L60,64C120,64,240,64,360,74.7C480,85,600,107,720,112C840,117,960,107,1080,90.7C1200,75,1320,53,1380,42.7L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>
	  </div>

       @if(!Auth::check())
<!-- Start Newsletter  -->
<form method="POST" action="{{url('newsletters')}}">
  @csrf
<div class="newsletter-area subscribe-items shadow theme-hard default-padding bg-cover" style="background-image: url({{ asset('/assets/img/banner/11.jpg')}});">
  <div class="container">
    <div class="row" style="margin-top: 110px;">
      <div class="col-md-6 col-sm-6 left-info">
        <div class="info-box text-right" style="direction: initial;">
          <div class="icon">
            <i class="flaticon-email"></i>
          </div>
          <div class="info">
            <h3 class="text-white"> הצטרף למאות הסטודנטים שנהנים מחומרי לימוד מותאמים למוסד הלימודים, שאלות ותשובות וטיפים  ללמידה  .               </h3>
            <p class="text-white">
                           הפוך לחלק מאוניברסיטת Avada כדי לקדם את הקריירה שלך.
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
        <div class="subcribe-form">
          @if (\Session::has('success'))
        <div class="alert alert-success">
          <p>{{ \Session::get('success') }}</p>
        </div><br />
          @endif
          @if (\Session::has('failure'))
          <div class="alert alert-danger">
            <p>{{ \Session::get('failure') }}</p>
          </div><br />
          @endif
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="text" name="user_name" placeholder="שם מלא " class="form-control">
                  <i class="fa fa-user"></i>
                </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <input type="email" name="user_email" placeholder="אימייל  " class="form-control">
                    <i class="fa fa-envelope"></i>
                  </div>
                </div>
                <?php 
                    $university_data = DB::table('universities')->get();
                    ?>
                <div class="col-md-6">
                  <div class="form-group">
                    <select id="user_university" name="user_university" class="form-control" data-placeholder="שם האוניברסיטה או המכללה " required="required" >
                        <option style = "color:black;" value = "">שם האוניברסיטה או המכללה</option>
                        @foreach($university_data as $university)
                        <option style = "color:black;" value="{{ $university->id }}">{{ $university->university_name }}</option> 
                        @endforeach               
                      </select>
                       <i class="fa fa-building"></i>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                  <select id = "user_degree" name = "user_degree" data-placeholder="תוֹאַר " class="form-control" required="required"  >
                        <option style = "color:black;" value="">וֹאַר </option>        
                      </select>
                      <i class="fa fa-graduation-cap"></i>
                </div></div>
                  <div class="col-md-12 text-right">
                    <button type = "submit" class="btn"> הרשם לניוזלטר  </button>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  @endif
    <!-- End Newsletter -->
   
	  <div class="modal teammodal" id="team1">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
     <div class="modal-header border-bottom-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
     </div>
      <div class="modal-body" style="    direction: rtl;">
	  <div class="row">
      <?php
        foreach ($instructors_data as $instructor_data) {
          $image =  asset('/assets/img/team/' .$instructor_data->avatar);
         ?>
	  <div class="col-md-4">
	     <div class="team-widget">
		      <div class="teamimg">
			     <img src="{{ $image }}">
			  </div>
			  <div class="teaminfo">
				  <ul class="memberinfo">
				  <li><i class="fa fa-phone"></i>{{ $instructor_data->contact_number}}</li>
				  <li><i class="fa fa-map-marker-alt"></i>{{ $instructor_data->address}}</li>
				  <li><i class="fa fa-envelope"></i>{{ $instructor_data->email}}</li>
				  
				  </ul>
			  </div>
			  <hr class="mt-20 mb-20">
			    <div class="teameduc">
				<div class="site-heading text-center mb-10">
				<h2 class="">חינוך</h2>
			    </div>
				<p>{{ $instructor_data->qualification}}</p>
			  </div>
		 </div>
	  
	  </div>
	  
	   <div class="col-md-8">
	     <div class="team-widget">
	  	     <div class="site-heading text-center mb-10">
				<h2 class="">{{ $instructor_data->instructor_name}}</h2>
				 <span>מנהל</span>
			    </div>
			<div class="teamdescription">
				<h3><b>תיאור</b></h3>
			<p>{{ $instructor_data->about}}</p>
			<h3 class="mb-0"><b>המלצות</b></h3>
			 <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators mb-20">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
     <div class="reviewcont">
                                   <div class="recommendcont"><div class="recommendinner"><span class="quotetop"><i class="fa fa-quote-left"></i></span> <p>{{ $instructor_data->recommendations}}</p>	 <span class="quotebottom"><i class="fa fa-quote-right"></i></span></div> <div class="recommendimg"><img src="{{ asset('/assets/img/advisor/course_tutor_2.jpg') }}"></div> </div>							
                                 
                                 </div>
    </div>
	<div class="item ">
     <div class="reviewcont">
                                   <div class="recommendcont"><div class="recommendinner"><span class="quotetop"><i class="fa fa-quote-left"></i></span> <p>{{ $instructor_data->recommendations}}</p>	 <span class="quotebottom"><i class="fa fa-quote-right"></i></span></div> <div class="recommendimg"><img src="{{ asset('/assets/img/advisor/course_tutor_2.jpg') }}"></div> </div>							
                                 
                                 </div>
    </div>
    </div>
	<a href="{{url('/recommend')}}" class="btn btn-theme mt-20">לרשימת ההמלצות המלאה</a>
  <button class="btn btn-join mr-10 mt-20">הוסף המלצה</button>
    </div>
			
			</div>
	  </div>
	  </div>
    <?php }?>
	  </div>
      </div>

   
    </div>
  </div>
</div>
     @endsection 
     @section('scripts')
	<script type="text/javascript">
	$( document ).ready(function() {
    $('#user_university').change(function(){
          var university_id = $(this).val();
          $.ajax({
            url: '{{ route('front.getdegree') }}',
            type: 'POST',
            data: {
                university_id: university_id
            },
            success: function(data) {
              $('#user_degree').html('');
                $.each(data.degree_data, function(i, d) {
                    $('#user_degree').append('<option style = "color:black;" value="' + d.id + '">' + d.degree_name + '</option>');
                });
              }
          });
        });
		   var sidebar  = new StickySidebar('#sidebarss', {
	     	topSpacing: 0,
			containerSelector: '.sidebar-sec',
			innerWrapperSelector: '#sidebartop'
		});

       $('#uploadfile').change(function() {
      $('#image_title').text(this.files && this.files.length ? this.files[0].name : '');
    });
    $("#upload_package_btn").click(function(e) {
          e.preventDefault();
          var fd = new FormData();
          var files = $('#uploadfile')[0].files;
           // Check file selected or not
          if(files.length > 0 ){
           fd.append('file',files[0]);
          $.ajax({
            url: '{{ route('front.upload_docs') }}',
            type: 'POST',
              data:new FormData($("#upload_package_docs")[0]),
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
	
});


	</script>
      @endsection
