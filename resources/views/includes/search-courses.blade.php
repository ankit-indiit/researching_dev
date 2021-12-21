@extends('layouts.app')

@section('title', ' קורסים ')

@section('content')
    

<div class="banner-inner-area" style="" >
      <div class="container">
         <div class="row">
            <div class="col-lg-12 col-md-12">
		   <div class="bannercontinner">
		   
               <h1>תואר ראשון במדעי המחשב וטכנולוגיה  </h1>
			   <span class="banner-inst-logo"><img src="{{ asset('/assets/img/instut1.png') }}"></span>
            </div>
            </div>
         </div>
      </div>
   </div>
      <div class="breadcrumb-inner-area" style="" >
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12">
                 
                  <ul class="breadcrumb">
                     <li><a href="#"><i class="fas fa-home"></i> דף הבית</a></li>
                     <li class="active">תארים  </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
     

      <!-- Start Popular Courses
         ============================================= -->
      <div class="popular-courses-area coursessection weekly-top-items default-padding  pb-0" style="direction: rtl;">
         <div class="container">
            <div class="row">
               <div class="site-heading text-center">
                  <div class="col-md-8 col-md-offset-2">
                     <h2>קורסים מותאמים עבורך  </h2>
                  </div>
               </div>
            </div>
            <div class="row sidebar-sec">
               <div class="col-md-12">
                  <div class="row">
                     <div class="top-course-items">
          @if (session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
@endif
				  <div class="tab-content tab-content-info">
                     <!-- Single Tab -->
                     <div id="tab1" class="tab-pane fade active in">
                        <!-- Single Item -->
                        <?php
                    foreach ($courses as $key => $get_course) { 
                      foreach ($get_course as $course) {
                       $image =  asset('/assets/img/courses/' .$course->image); 
                      ?>
                        <div class="col-md-12 col-sm-12 mb-30">
                           <div class="item text-right">
                              <a  class="thumb">
                                 <img src="{{ $image }}" alt ="Thumb">
      								 			    <div class=" videomodal fade" id="videomodal" style="display:none">
                                		<iframe width="100%" height="100%" src="https://www.youtube.com/embed/yAoLSRbwxL8?autoplay=1&mute=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                              </a>
				
                              <div class="info">
                                
                                 
                                    <a href="{{route('front.course.show',['id' => $course->course_id])}}"><h4>{{$course->course_name}}</h4></a>
                                 <!-- <div class="meta"> -->
                                  <!-- <?php 
                                  $no_of_reviews = 0;
                                  $star = 0;
                                  $ratings = DB::table('reviews')->where('course_id',$course->course_id)->get();
                                  if(!empty($ratings) && count($ratings)>0){
                                    $no_of_reviews = count($ratings);
                                    foreach ($ratings as $value) {
                                      $star = $star + $value->rating;
                                    }
                                    $avg_rating = $star / $no_of_reviews;?> -->
                                    <!-- <ul>
                                      <li> -->
                                        <!-- @foreach(range(1,5) as $i) -->
                                        <!-- <span class="fa-stack" style="width:1em">
                                        <i class="far fa-star fa-stack-1x"></i> -->
                                          <!-- @if($avg_rating >0)
                                            @if($avg_rating >0.5) -->
                                              <!-- <i class="fas fa-star fa-stack-1x"></i> -->
                                            <!-- @else -->
                                            <!-- <i class="fas fa-star-half fa-stack-1x"></i> -->
                                            <!-- @endif
                                          @endif
                                        @php $avg_rating--; @endphp -->
                                          <!-- </span> -->
                                        <!-- @endforeach -->
                                      <!-- </li> 
                                    </ul> -->
                                  <!-- <?php } else{?> -->
                                    <!-- <ul>
                                      <li> -->
                                        <!-- @foreach(range(1,5) as $i) -->
                                        <!-- <span class="fa-stack" style="width:1em">
                                          <i class="far fa-star fa-stack-1x"></i>
                                          </span> -->
                                       <!--  @endforeach
                                    <?php }?> -->
                                 </div>
                                 <p>
                                  {{ Str::limit($course->description, 150) }}
                                 </p>

                                 <div class="footer-meta">
                                  <?php 
                                  if((!empty($ordered_courses)) && $ordered_courses->contains($course->course_id)){?>
                                    <span style="color:#002147; font-size:20px">My Learning</span>
                                  <?php }else{?>
                                    <div class="btn-btm">
                                      <a class="btn btn-theme effect btn-sm" href="{{route('front.buycourse',['type' => 0 ,'courseid' => $course->course_id])}}">הה עכשיו   </a>
                                    @if (Auth::check())
                                      <?php if (DB::table('cart_items')->where('course_id', $course->course_id )->where('user_id',Auth::user()->id)->where('item_type','0')->exists()){?>
                                      <a class="btn btn-theme effect btn-sm" href="{{route('front.display.cart',['id' => Auth::user()->id])}}">view cart</a>
                                    <?php }else {?>
                                    <a class="btn btn-theme btnoutline effect btn-sm cart_button" href="{{route('front.cart.show',['type' => 0 ,'id' => $course->course_id])}}">הוסף לעגלה    </a>
                                    <?php }?>
                                    @elseif(Auth::guest())
                                    @if(session('cart'))
                                    <?php 
                                    $cart = session()->get('cart');
                                    $guest_user = session()->get('guest_user');
                                       if (array_key_exists("$course->course_id",$cart)){?>
                                        <a class="btn btn-theme effect btn-sm" href="{{route('front.display.cart',['id' => $guest_user])}}">view cart</a>
                                         <?php }else {?>
                                    <a class="btn btn-theme btnoutline effect btn-sm cart_button" href="{{route('front.cart.show',['type' => 0 , 'id' => $course->course_id])}}">הוסף לעגלה    </a>
                                    <?php }?>
                                    @else
                                    <a class="btn btn-theme btnoutline effect btn-sm cart_button" href="{{route('front.cart.show',['type' => 0 ,'id' => $course->course_id])}}">הוסף לעגלה    </a>
                                    @endif
                                    @else
                                    <a class="btn btn-theme btnoutline effect btn-sm cart_button" href="{{route('front.cart.show',['type' => 0 ,'id' => $course->course_id])}}">הוסף לעגלה    </a>
                                    @endif
                    </div>
                    <?php }?>
                                    <h4>₪{{$course->price}}</h4>
								 
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                        <!-- Single Item -->
                        @if ($courses->lastPage() > 1) 
    <ul class="pagination"> 
      <li class="{{ ($courses->currentPage() == 1) ? ' disabled' : '' }}"> 
        <a href="{{ $courses->url(1) }}">Previous</a> 
      </li> 
      @for ($i = 1; $i <= $courses->lastPage(); $i++) 
      <li class="{{ ($courses->currentPage() == $i) ? ' active' : '' }}"> 
        <a href="{{ $courses->url($i) }}">{{ $i }}</a> 
      </li> 
    @endfor 
      <li class="{{ ($courses->currentPage() == $courses->lastPage()) ? ' disabled' : '' }}">   <a href="{{ $courses->url($courses->currentPage()+1) }}" >Next</a> 
      </li> 
    </ul> 
  @endif
                     </div>
                     
                     </div>
                  </div>
               </div>
               <!-- Start Sidebar -->
   
            </div>
         </div>
      </div>
      <!-- End Popular Courses --> 
	   <div class="curveup2">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 220"><path fill="#f7f7f7" fill-opacity="1" d="M0,64L60,64C120,64,240,64,360,74.7C480,85,600,107,720,112C840,117,960,107,1080,90.7C1200,75,1320,53,1380,42.7L1440,32L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg>
	  </div>
			 <div class="curvedown2">
         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 220">
            <path fill="#f7f7f7" fill-opacity="1" d="M0,64L60,64C120,64,240,64,360,74.7C480,85,600,107,720,112C840,117,960,107,1080,90.7C1200,75,1320,53,1380,42.7L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path>
         </svg>
      </div>
      <!-- Start Newsletter 
         ============================================= -->
      <div class="newsletter-area subscribe-items shadow theme-hard padding-160-90  bg-cover" style="background-image: url({{ asset('/assets/img/banner/11.jpg')}}); direction: rtl;">
         <div class="container">
            <div class="row">
               <div class="col-md-6 col-sm-6 left-info">
                  <div class="info-box text-right">
                     <div class="icon">
                        <i class="flaticon-email"></i>
                     </div>
                     <div class="info">
                        <h3 class="text-white">הצטרף ליותר מ -500,000 סטודנטים שנהנים עכשיו מחינוך Avada </h3>
                        <p class="text-white">
                           הפוך לחלק מאוניברסיטת Avada כדי לקדם את הקריירה שלך.
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-sm-6">
                  <div class="subcribe-form">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <input type="text" name="" placeholder="שם מלא " class="form-control">
                              <i class="fa fa-user"></i>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <input type="email" name="" placeholder="אימייל  " class="form-control">
                              <i class="fa fa-envelope"></i>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <select name="" placeholder="טלפון  " class="form-control">
							    <option>בחר קורסים</option>
							    <option>כַּלכָּלָנוּת</option>
							    <option>עיצוב גרפי</option>
							    <option>נפיזיקה</option>
							  </select>
                <i class="fa fa-building"></i>
                           </div>
                        </div>
                        <div class="col-md-12 text-right">
                           <button class="btn">הירשם</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- End Newsletter -->   
       @endsection
       @section('scripts')
      <script type="text/javascript">
	  $(document).ready(function(){
	  
	  $(".top-course-items .item > a.thumb").hover(
  function () {
    $(this).addClass("showvideo");
  },
  function () {
    $(this).removeClass("showvideo");
  }
); 

});
	 </script>
	  @endsection