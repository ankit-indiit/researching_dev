@extends('layouts.app')
@section('title', ' פרט כמובן   ')
@section('content')
<!-- Start Course Details  -->    
<div class="course-details-area default-padding-lg1 pb-0" style="direction: rtl;">
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
                        <h4>מרתון עבור {{$courses_data[0]->course_name}}</h4>
                        <h4> לפי: <b>@if(isset($courses_data[0]->instructors->first_name)) {{$courses_data[0]->instructors->first_name}} @endif</b></h4>
                     </div>
                     <div class="item category instutlogo">
                        <img height="60px" src="{{ asset('/assets/images') }}/{{ $courses_data[0]->university->logo }}">
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
                        פרטי מרתון
                        </a>
                     </li>
                     <!-- <li>
                        <a data-toggle="tab" href="#tab2" aria-expanded="false">
                        חומרי לימוד לקורס
                        </a>
                     </li> -->
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
                                             <span class="purchasecost">$50</span>
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
                                                      {{$topic->topic_name}}
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
                                          <p>{{$question->answers}}</p>
                                       </div>
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
                                    <img src="{{ asset('/assets/img/team/2.jpg') }}" alt ="Thumb">
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
                                    <img src="{{ asset('/assets/img/team/3.jpg') }}" alt ="Thumb">
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
                     <!-- <div id="tab2" class="tab-pane fade">
                        <div class="info title">
                           <div class="course-main2">
                              <h2> <span>העלה קבצים</span>
                              </h2>
                           </div>
                           <form method="POST" id="upload-docs-form" action="{{ route('front.upload_docs') }}" enctype="multipart/form-data">
                              @csrf
                              <?php
                                 foreach ($courses_data as $course_data) { ?>
                              <div class="uploadfiles">
                                 <label for="uploadfile">
                                    <i class="fa fa-upload"></i>
                                    <p id ="image_title"> אנא בחר בקובץ   </p>
                                 </label>
                                 <input style="display:none" type="file"  name="uploadfile"  id="uploadfile"/>
                              </div>
                              <button id = "upload_docs_btn" type = "submit" class="btn btn-join ">
                              שלח
                              </button>
                              <input type = "hidden" name = 'docs_course_id' value = "{{$course_data->course_id}}"/>
                              <?php }?>
                           </form>
                        </div>
                     </div> -->
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
               <div  class="sidebar1" id="sidebartop">
                  <a href="{{Route('front.showDegree',['id'=> $courses_data[0]->degree_id])}}" class="btn btn-md d-block outline-btn">עבור לעמוד שאר הקורסים </a>
                  <aside id="sidebar1">
                     <div class="sidebar-item purschase-box">
                        <h2 class="text-center"><span class="purchase-ins">@if($courses_data[0]->marathon_price>0){{$courses_data[0]->marathon_price}} @else Free @endif</span></h2>
                        @if($courses_data[0]->start_date)
                           @if(\Carbon\Carbon::parse($courses_data[0]->start_date)->isPast())
                              <a href="#" class="btn btn-md d-block outline-btn">Marathon is expire</a>
                           @else
                           
                        <!------------------------>
                        <!--Sidebar Buy now button-->
                        <!--/ data-toggle="modal" data-target="#loginModal" -->
                            <a href="{{route('front.buycourse',['type' => 0 ,'courseid' => $courses_data[0]->course_id])}}" class="btn btn-theme effect btn-md d-block">קנה עכשיו </a>
                           
                            <!--Sidebar Watch the Basket -->
                            <?php if (DB::table('cart_items')->where('course_id', $courses_data[0]->course_id )->where('user_id',Auth::user()->id)->where('item_type','0')->exists()){ ?>
                            <a class="btn btn-md d-block outline-btn" href="{{route('front.display.cart',['id' => Auth::user()->id])}}">
                                               צפה בסל
                            </a>
                            <?php } else { ?>
                            <!--Sidebar Add to cart -->
                            <a class="btn btn-md d-block outline-btn" href="{{route('front.cart.show',['type' => 0 ,'id' => $courses_data[0]->course_id])}}">הוסף לעגלה    </a>
                            <?php } ?>
                        <!------------------------->
                           
                           @endif
                        @else 
                           @if(Auth::check())
                              @php 
                                 $is_aleready_signup = DB::table('marathon_orders')->where('user_id',Auth::user()->id)->where('course_id',$courses_data[0]->course_id)->first();
                              @endphp 
                              @if($is_aleready_signup)
                                 <a href="javascript:void(0)" class="btn btn-md d-block outline-btn" disabled="disabled">נרשם בהצלחה</a>
                              @else
                                 <button class="btn btn-md d-block outline-btn signUpMarathon" style="width:100%">הירשם למרתון </button>
                              @endif
                           @else 
                              <a href="#loginModal"  data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn btn-md d-block outline-btn">הירשם למרתון </a>
                           @endif   
                        @endif

                        <h5>לִכלוֹל :</h5>
                        <ul>
                           @if($courses_data[0]->start_time && $courses_data[0]->end_time)
                           @php 
                           $startTime = \Carbon\Carbon::parse($courses_data[0]->start_time);
                           $endTime = \Carbon\Carbon::parse($courses_data[0]->end_time);
                           $totalDuration =  $startTime->diff($endTime)->format('%H:%I')." Hours";
                           @endphp
                           <li><i class="ti-alarm-clock"></i>  <span>{{$totalDuration}} שעות לפי דרישה  </span></li>
                           @endif
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
                                 <p>{{ Str::limit($instructor_data->about, 50) }}</p>
                              </div>
                           </li>
                        </ul>
                        <?php } ?>
                     </div>
                     <?php if(count($recommendations) != 0){?>
                     <div class="sidebar-item similar-courses">
                        <div class="title">
                           <h4>סטודנטים ממליצים</h4>
                        </div>
                        <div class="advisor-list-items">
                           <?php foreach($recommendations as $value){
                              foreach ($users_data as $user_data) {
                                $image =  asset('/assets/users/' .$user_data->avatar);
                              
                              ?>
                           <div class="item">
                              <div class="thumb">
                                 <img src="{{$image }}" alt ="Thumb">
                              </div>
                              <div class="info">
                                 <div class="author text-right">
                                    <h4>{{$user_data->first_name}}</h4>
                                 </div>
                                 <div> 
                                    <span><i class="fas fa-star"></i></span> <span><i class="fas fa-star"></i></span> <span><i class="fas fa-star"></i></span> <span><i class="fas fa-star"></i></span> <span><i class="fas fa-star"></i></span> 
                                 </div>
                                 <p>
                                    {{$value->description}}
                                 </p>
                              </div>
                           </div>
                           <?php }}?>
                        </div>
                     </div>
                     <?php }?>
                     <div class="sidebar-item similar-courses">
                        <!--ul class="socialshare2">
                           <li><a href="" class="social-icon"><i class="fab fa-whatsapp"></i> להצטרפות לקבוצת הלמידה</a></li>
                           
                           </ul-->
                        <div class="share-as">
                           <h4>שתף כ</h4>
                        </div>
                        <ul class="socialshare">
                           <li><a href="https://facebook.com/sharer/sharer.php?u={{ Request::url() }}&title={{$courses_data[0]->course_name}}" class="social-icon facebook" target="_blank"><i class="fab fa-facebook"></i>Facebook</a></li>
                           <li><a href="https://twitter.com/intent/tweet?text={{$courses_data[0]->course_name}}&url={{ Request::url() }}" class="social-icon twitter" target="_blank"><i class="fab fa-twitter"></i>Twitter</a></li>
                           <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ Request::url()}}&title={{$courses_data[0]->course_name}}" class="social-icon linkedin"  target="_blank"><i class="fab fa-linkedin"></i>Linkedin</a></li>
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
   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 220">
      <path fill="#f7f7f7" fill-opacity="1" d="M0,64L60,64C120,64,240,64,360,74.7C480,85,600,107,720,112C840,117,960,107,1080,90.7C1200,75,1320,53,1380,42.7L1440,32L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
   </svg>
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
                     <li class="btnglow"> <a data-toggle="tab" href="#marathonTab" aria-expanded="false">
                       מרתון 
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
                  <div class="top-course-items courses-carousel owl-carousel owl-theme corpara">
                     @foreach($related_products as $related)
                     <div class="item text-right">
                        <a class="thumb" href="{{ Route('front.course.show', ['id' => $related->course_id ]) }}">
                        <img src="{{ asset('/assets/images') }}/{{$related->image}}" alt ="Thumb">
                        </a>
                        <div class="info">
                           <h4>
                              <a href="{{ Route('front.course.show', ['id' => $related->course_id ]) }}">{{ $related->course_name }}</a>
                           </h4>
                           <p>
                           {{ $related->description }}
                           </p>
                           <div class="footer-meta">
                              <h4>@if($related->price > 0) ${{$related->price}}  @else Free @endif</h4>
                              <div class="btn-btm">
                                 <a class="btn btn-theme effect btn-sm" href="#">קנה עכשיו  </a>
                                 <a class="btn btn-theme btnoutline effect btn-sm" href="#">הוסף לעגלה    </a>
                              </div>
                           </div>
                        </div>
                     </div>
                     @endforeach
                  </div>
               </div>
               <div id="marathonTab" class="tab-pane fade">
                  <div class="top-course-items courses-carousel owl-carousel owl-theme corpara">
                     @foreach($related_products as $related)
                     <div class="item text-right">
                        <a class="thumb" href="{{ Route('front.marathon.details', ['id' => $related->course_id ]) }}">
                        <img src="{{ asset('/assets/images') }}/{{$related->image}}" alt ="Thumb">
                        </a>
                        <div class="info">
                           <h4>
                              <a href="{{ Route('front.marathon.details', ['id' => $related->course_id ]) }}">מרתון עבור {{ $related->course_name }}  </a>
                           </h4>
                           <p> {{ $related->description }} </p>
                           <div class="footer-meta">
                              <h4>@if($related->marathon_price > 0) ${{$related->marathon_price}}  @else Free @endif</h4>
                              <div class="btn-btm">
                                 <a class="btn btn-theme effect btn-sm" href="#">קנה עכשיו  </a>
                                 <a class="btn btn-theme btnoutline effect btn-sm" href="#">הוסף לעגלה    </a>
                              </div>
                           </div>
                        </div>
                     </div>
                     @endforeach
                  </div>
               </div>
               <div id="tab22" class="tab-pane fade">
                  <div class="top-course-items courses-carousel2 owl-carousel owl-theme">
                  @foreach ($packages as $package)
                     <div class="item">
                        <div class="packagedeal" style="direction: rtl;">
                        @foreach ($package->courses_info as $package_courses)
                           <div class="packageinner">
                              <a href="package-detail.html" class="thumb">
                              <img src="{{asset('/assets/img/courses/' .$package_courses->image)}}" alt ="Thumb"> 
                              </a>
                              <div class="info">
                                 <h4>
                                    <a href="{{route('front.package.show',['id' => $package_courses->course_id,'package_id' => $package->package_code])}}">{{$package_courses->course_name}}</a>
                                 </h4>
                                 <p>
                                 {!! Str::limit($package->description, 150) !!}
                                 </p>
                              </div>
                           </div>
                        @endforeach
                           <div class="footer-meta">
                              <div class="btn-btm">
                                 <a class="btn btn-theme effect btn-sm" href="#">קנה עכשיו  </a>
                                 <a class="btn btn-theme btnoutline effect btn-sm" href="#">הוסף לעגלה    </a>
                              </div>
                              <h4>₪{{$package->price}}</h4>
                           </div>
                        </div>
                     </div>
                  @endforeach
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- End Popular Courses -->
<div class="curvedown2">
   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 220">
      <path fill="#f7f7f7" fill-opacity="1" d="M0,64L60,64C120,64,240,64,360,74.7C480,85,600,107,720,112C840,117,960,107,1080,90.7C1200,75,1320,53,1380,42.7L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path>
   </svg>
</div>
@if(!Auth::check())
<!-- Start Newsletter  -->
<form method="POST" action="{{url('newsletters')}}">
   @csrf
   <div class="newsletter-area subscribe-items shadow theme-hard default-padding bg-cover" style="background-image: url({{ asset('/assets/img/banner/11.jpg')}});">
      <div class="container">
         <div class="row" style="margin-top: 110px;">
            <div class="col-md-6 col-sm-6 left-info">
               <div class="info-box text-right">
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
                  </div>
                  <br />
                  @endif
                  @if (\Session::has('failure'))
                  <div class="alert alert-danger">
                     <p>{{ \Session::get('failure') }}</p>
                  </div>
                  <br />
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
                        </div>
                     </div>
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
                        <p>{{ $instructor_data->qualification}}<br></p>
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
                                    <div class="recommendcont">
                                       <div class="recommendinner">
                                          <span class="quotetop"><i class="fa fa-quote-left"></i></span> 
                                          <p>{{ $instructor_data->recommendations}}</p>
                                          <span class="quotebottom"><i class="fa fa-quote-right"></i></span>
                                       </div>
                                       <div class="recommendimg"><img src="{{ asset('/assets/img/advisor/course_tutor_1.jpg') }}"></div>
                                    </div>
                                 </div>
                              </div>
                              <div class="item ">
                                 <div class="reviewcont">
                                    <div class="recommendcont">
                                       <div class="recommendinner">
                                          <span class="quotetop"><i class="fa fa-quote-left"></i></span> 
                                          <p>{{ $instructor_data->recommendations}}</p>
                                          <span class="quotebottom"><i class="fa fa-quote-right"></i></span>
                                       </div>
                                       <div class="recommendimg"><img src="{{ asset('/assets/img/advisor/course_tutor_2.jpg') }}"></div>
                                    </div>
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
<script>
   $('.panel-group').on('click', function(){
     $('html,body').stop();
   });
</script>
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
      $("#upload_docs_btn").click(function(e) {
            e.preventDefault();
            var fd = new FormData();
            var files = $('#uploadfile')[0].files;
             // Check file selected or not
            if(files.length > 0 ){
             fd.append('file',files[0]);
            $.ajax({
              url: '{{ route('front.upload_docs') }}',
              type: 'POST',
                data:new FormData($("#upload-docs-form")[0]),
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
   
   $(document).on('click','.signUpMarathon',function() {
      $(this).prop('disabled',true);
      $.ajax({
         url: '{{ route('front.marathon.register') }}',
         type: 'POST',
         data:{
            course_id: '{{$courses_data[0]->course_id}}',
         },
         success: function(data) {
            var res = JSON.parse(data);
            if(res.status == 1){
               $('.signUpMarathon').text('נרשם בהצלחה');
               $('.signUpMarathon').removeClass("signUpMarathon");
            }else{
               alert('Something went wrong. Please try again later.')
            }
         }
      });
   });
</script>
@endsection