@extends('layouts.app')
@section('title', 'תואר - '. $degree->degree_name)
@section('content') 
<div class="banner-inner-area" style="" >
  <div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="bannercontinner">
              <h1>{{ $degree->degree_name }}</h1>
              <span class="banner-inst-logo"><img src="{{ asset('/assets/images') }}/{{ $degree->university->logo }}"></span>
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
<!-- Start Popular Courses -->
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
               <div class="tabcourses">
                  <ul class="nav nav-pills  justify-content-center">
                     <li class="btnglow"> 
                        <a data-toggle="tab" href="#tab2" aria-expanded="false">
                        חבילות במבצע
                        </a> 
                     </li>
                     <li class="btnglow"> 
                        <a data-toggle="tab" href="#marathonTab" aria-expanded="false">
                        קורסים במרתון   
                        </a> 
                     </li>
                     <li class="active "> 
                        <a data-toggle="tab" href="#tab1" aria-expanded="true">
                        קורסים בודדים
                        </a> 
                     </li>
                  </ul>
               </div>
               @if (session('alert'))
               <div class="alert alert-success">
                  {{ session('alert') }}
               </div>
               @endif
               <div class="tab-content tab-content-info">
                  <!-- Single Tab -->
                  <div id="tab1" class="tab-pane fade active in">
                     <!-- Single Item -->
                     @if(count($courses)> 0)
                     <?php
                        foreach ($courses as $course) { 
                          $image =  asset('/assets/images/' .$course->image); 
                        ?>
                     <div class="col-md-12 col-sm-12 mb-30">
                        <div class="row item text-right">
                           <div class="col-md-4 pr-0 pl-0">
                              <a class="thumb" >
                                 <img src="{{ $image }}" alt ="Thumb" style="height: 285px;">
                                 <div class=" videomodal fade" id="videomodal" style="display:none">
                                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/yAoLSRbwxL8?autoplay=1&mute=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                 </div>
                              </a>
                           </div>
                           <div class="col-md-8">
                              <div class="info">
                                 <a href="{{route('front.course.show',['id' => $course->course_id])}}">
                                    <h4>{{$course->course_name}}</h4>
                                 </a>
                                 <?php 
                                    if(strlen($course->description) > 400){ ?>
                                 <span>{{ substr($course->description, 0, 400) }}</span>
                                 <span class="read-more-show hide_content">קרא עוד...</span>
                                 <span class="read-more-content"> 
                                 {{ substr($course->description, 400,strlen($course->description)) }} 
                                 <span class="read-more-hide hide_content">תקרא פחות </span> 
                                 </span>
                                 <?php }else{?>
                                 {{$course->description}}
                                 <?php }?>
                                 <div class="footer-meta">
                                    <?php 
                                       if((!empty($ordered_courses)) && $ordered_courses->contains($course->course_id)){?>
                                    <span style="color:#002147; font-size:20px">My Learning</span>
                                    <?php }else{?>
                                    <div class="btn-btm">
                                       <a class="btn btn-theme effect btn-sm" href="{{route('front.buycourse',['type' => 0 ,'courseid' => $course->course_id])}}">  קנה עכשיו 
                                       </a>
                                       @if (Auth::check())
                                       <?php if (DB::table('cart_items')->where('course_id', $course->course_id )->where('user_id',Auth::user()->id)->where('item_type','0')->exists()){?>
                                       <a class="btn btn-theme effect btn-sm" href="{{route('front.display.cart',['id' => Auth::user()->id])}}">
                                       צפה בסל
                                       </a>
                                       <?php }else {?>
                                       <a class="btn btn-theme btnoutline effect btn-sm cart_button" href="{{route('front.cart.show',['type' => 0 ,'id' => $course->course_id])}}">הוסף לעגלה    </a>
                                       <?php }?>
                                       @elseif(Auth::guest())
                                       @if(session('cart'))
                                       <?php 
                                          $cart = session()->get('cart');
                                          $guest_user = session()->get('guest_user');
                                          if (array_key_exists("$course->course_id",$cart)){?>
                                       <a class="btn btn-theme effect btn-sm" href="{{route('front.display.cart',['id' => $guest_user])}}">
                                       צפה בסל
                                       </a>
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
                                    <?php
                                       if($course->price != 0){?>
                                    <h4>₪{{$course->price}}</h4>
                                    <?php  }else{ ?>
                                    <h4>Free</h4>
                                    <?php }?>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php } ?>
                     @else
                     <div class="col-md-12 col-sm-12 mb-30">
                        <div class="row item text-right">
                           <div class="col-md-8">
                              <div class="info">
                                 <h4>מצטערים לא נמצאו קורסים!</h4>
                              </div>
                           </div>
                        </div>
                     </div>
                     @endif
                     <!-- Single Item -->
                     @if ($courses->lastPage() > 1) 
                     <ul class="pagination pagMob">
                        <li class="{{ ($courses->currentPage() == 1) ? ' disabled' : '' }}"> 
                           <a href="{{ $courses->url(1) }}">קודם  </a> 
                        </li>
                        @for ($i = 1; $i <= $courses->lastPage(); $i++) 
                        <li class="{{ ($courses->currentPage() == $i) ? ' active' : '' }}"> 
                           <a href="{{ $courses->url($i) }}">{{ $i }}</a> 
                        </li>
                        @endfor 
                        <li class="{{ ($courses->currentPage() == $courses->lastPage()) ? ' disabled' : '' }}">   <a href="{{ $courses->url($courses->currentPage()+1) }}" >הַבָּא  </a> 
                        </li>
                     </ul>
                     @endif
                  </div>
                  <div id="marathonTab" class="tab-pane fade">
                    <!-- Single Item -->
                    @if(count($courses)> 0)
                    <?php
                      foreach ($courses as $course) { 
                        $image =  asset('/assets/images/' .$course->image); 
                      ?>
                    <div class="col-md-12 col-sm-12 mb-30">
                      <div class="row item text-right">
                          <div class="col-md-4 pr-0 pl-0">
                            <a class="thumb" >
                                <img src="{{ $image }}" alt ="Thumb" style="height: 285px;">
                                <div class=" videomodal fade" id="videomodal" style="display:none">
                                  <iframe width="100%" height="100%" src="https://www.youtube.com/embed/yAoLSRbwxL8?autoplay=1&mute=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </a>
                          </div>
                          <div class="col-md-8">
                            <div class="info">
                                <a href="{{route('front.marathon.details',['id' => $course->course_id])}}">
                                  <h4>{{$course->course_name}}</h4>
                                </a>
                                <?php 
                                  if(strlen($course->description) > 400){ ?>
                                <span>{{ substr($course->description, 0, 400) }}</span>
                                <span class="read-more-show hide_content">קרא עוד...</span>
                                <span class="read-more-content"> 
                                {{ substr($course->description, 400,strlen($course->description)) }} 
                                <span class="read-more-hide hide_content">תקרא פחות </span> 
                                </span>
                                <?php }else{?>
                                {{$course->description}}
                                <?php }?>
                                <div class="footer-meta">
                                  <?php 
                                      if((!empty($ordered_courses)) && $ordered_courses->contains($course->course_id)){?>
                                  <span style="color:#002147; font-size:20px">My Learning</span>
                                  <?php }else{?>
                                  <div class="btn-btm">
                                      <a class="btn btn-theme effect btn-sm" href="{{route('front.buycourse',['type' => 0 ,'courseid' => $course->course_id])}}">  קנה עכשיו 
                                      </a>
                                      @if (Auth::check())
                                      <?php if (DB::table('cart_items')->where('course_id', $course->course_id )->where('user_id',Auth::user()->id)->where('item_type','0')->exists()){?>
                                      <a class="btn btn-theme effect btn-sm" href="{{route('front.display.cart',['id' => Auth::user()->id])}}">
                                      צפה בסל
                                      </a>
                                      <?php }else {?>
                                      <a class="btn btn-theme btnoutline effect btn-sm cart_button" href="{{route('front.cart.show',['type' => 0 ,'id' => $course->course_id])}}">הוסף לעגלה    </a>
                                      <?php }?>
                                      @elseif(Auth::guest())
                                      @if(session('cart'))
                                      <?php 
                                        $cart = session()->get('cart');
                                        $guest_user = session()->get('guest_user');
                                        if (array_key_exists("$course->course_id",$cart)){?>
                                      <a class="btn btn-theme effect btn-sm" href="{{route('front.display.cart',['id' => $guest_user])}}">
                                      צפה בסל
                                      </a>
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
                                  <?php
                                      if($course->marathon_price != 0){?>
                                  <h4>₪{{$course->marathon_price}}</h4>
                                  <?php  }else{ ?>
                                  <h4>Free</h4>
                                  <?php }?>
                                </div>
                            </div>
                          </div>
                      </div>
                    </div>
                    <?php } ?>
                    @else
                    <div class="col-md-12 col-sm-12 mb-30">
                      <div class="row item text-right">
                          <div class="col-md-8">
                            <div class="info">
                                <h4>מצטערים לא נמצאו קורסים!</h4>
                            </div>
                          </div>
                      </div>
                    </div>
                    @endif
                    <!-- Single Item -->
                    @if ($courses->lastPage() > 1) 
                    <ul class="pagination pagMob">
                      <li class="{{ ($courses->currentPage() == 1) ? ' disabled' : '' }}"> 
                          <a href="{{ $courses->url(1) }}">קודם  </a> 
                      </li>
                      @for ($i = 1; $i <= $courses->lastPage(); $i++) 
                      <li class="{{ ($courses->currentPage() == $i) ? ' active' : '' }}"> 
                          <a href="{{ $courses->url($i) }}">{{ $i }}</a> 
                      </li>
                      @endfor 
                      <li class="{{ ($courses->currentPage() == $courses->lastPage()) ? ' disabled' : '' }}">   <a href="{{ $courses->url($courses->currentPage()+1) }}" >הַבָּא  </a> 
                      </li>
                    </ul>
                    @endif                    
                  </div>
                  <div id="tab2" class="tab-pane fade">
                     <?php
                        foreach ($packages as $package) {  
                          ?>
                     <div class="col-md-12 col-sm-12  mb-30">
                        <div class="packagedeal">
                           <?php
                              foreach ($package->courses_info as $package_courses) { 
                                 $image =  asset('/assets/img/courses/' .$package_courses->image); 
                                ?>
                           <div class="packageinner">
                              <a class="thumb">
                              <img src="{{$image}}" alt="Thumb"> 
                              </a>
                              <div class="info">
                                 <h4>
                                    <a href="{{route('front.package.show',['id' => $package_courses->course_id,'package_id' => $package->package_code])}}">
                                       <h4>{{$package_courses->course_name}}</h4>
                                    </a>
                                 </h4>
                                 <p>{!! Str::limit($package->description, 150) !!}</p>
                              </div>
                           </div>
                           <?php }?>
                           <div class="footer-meta">
                              <?php if((!empty($ordered_packages)) && $ordered_packages->contains($package->package_code)){?>
                              <span style="color:#002147; font-size:20px">My Learning</span>
                              <?php }else{?>
                              <div class="btn-btm">
                                 <a class="btn btn-theme effect btn-sm" href="{{route('front.buycourse',['type' => 1 ,'courseid' => $package->package_code])}}">
                                 קנה עכשיו 
                                 </a>
                                 @if (Auth::check())
                                 <?php if (DB::table('cart_items')->where('course_id', $package->package_code )->where('user_id',Auth::user()->id)->where('item_type','1')->exists()){?>
                                 <a class="btn btn-theme effect btn-sm" href="{{route('front.display.cart',['id' => Auth::user()->id])}}">
                                 צפה בסל
                                 </a>
                                 <?php }else {?>
                                 <a class="btn btn-theme btnoutline effect btn-sm cart_button" href="{{route('front.cart.show',['type' => 1 ,'id' => $package->package_code])}}">הוסף לעגלה    </a>
                                 <?php }?>
                                 @elseif(Auth::guest())
                                 @if(session('cart'))
                                 <?php 
                                    $cart = session()->get('cart');
                                    $guest_user = session()->get('guest_user');
                                    if (array_key_exists("$package->package_code",$cart)){?>
                                 <a class="btn btn-theme effect btn-sm" href="{{route('front.display.cart',['id' => $guest_user])}}">
                                 צפה בסל
                                 </a>
                                 <?php }else {?>
                                 <a class="btn btn-theme btnoutline effect btn-sm cart_button" href="{{route('front.cart.show',['type' => 1 , 'id' => $package->package_code])}}">הוסף לעגלה    </a>
                                 <?php }?>
                                 @else
                                 <a class="btn btn-theme btnoutline effect btn-sm cart_button" href="{{route('front.cart.show',['type' => 1 ,'id' => $package->package_code])}}">הוסף לעגלה    </a>
                                 @endif
                                 @else
                                 <a class="btn btn-theme btnoutline effect btn-sm cart_button" href="{{route('front.cart.show',['type' => 1 ,'id' => $package->package_code])}}">הוסף לעגלה    </a>
                                 @endif
                                 <?php } ?>
                              </div>
                              <h4>₪{{$package->price}}</h4>
                           </div>
                        </div>
                     </div>
                     <?php }?>
                     @if ($packages->lastPage() > 1) 
                     <ul class="pagination pagMob">
                        <li class="{{ ($packages->currentPage() == 1) ? ' disabled' : '' }}"> 
                           <a href="{{ $packages->url(1) }}">קודם  </a> 
                        </li>
                        @for ($i = 1; $i <= $courses->lastPage(); $i++) 
                        <li class="{{ ($packages->currentPage() == $i) ? ' active' : '' }}"> 
                           <a href="{{ $packages->url($i) }}">{{ $i }}</a> 
                        </li>
                        @endfor 
                        <li class="{{ ($packages->currentPage() == $packages->lastPage()) ? ' disabled' : '' }}">   <a href="{{ $courses->url($packages->currentPage()+1) }}" >הַבָּא  </a> 
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
   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 220">
      <path fill="#f7f7f7" fill-opacity="1" d="M0,64L60,64C120,64,240,64,360,74.7C480,85,600,107,720,112C840,117,960,107,1080,90.7C1200,75,1320,53,1380,42.7L1440,32L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
   </svg>
</div>
<div class="deservecart  bg-gray" style="direction:rtl">
   <div class="container">
      <div class="row ">
         <div class="col-md-12">
            <div class="site-heading text-center">
               <h2>מגיע לך גם</h2>
            </div>
         </div>
      </div>
      <div class="row  justify-content-center mb-20">
         <div class="col-md-4 col-sm-6 ">
            <div class="item">
               <div class="thumb">
                  <img src="{{ asset('/assets/img/courses/1.jpg') }}" alt =""> 
               </div>
               <div class="info">
                  <h4>
                     <a href="#">שיעורי למידה אינטנסיביים</a>
                  </h4>
                  <p>
                     היא לא שרדה לא רק חמש מאות שנה, אלא גם את הקפיצה לכתב עבודות אלקטרוני, ונותרה בעינה.
                  </p>
                  <div class="footer-meta">
                     <a class="btn btn-theme effect btn-sm" href="#">הוסף לעגלה</a>
                     <h4>₪5.00 <span class="price">₪10.00</span></h4>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
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
@endsection
@section('scripts')
<script type="text/javascript">
   $(document).ready(function(){
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
   $(".top-course-items .item > a.thumb").hover(
   function () {
    $(this).addClass("showvideo");
   },
   function () {
    $(this).removeClass("showvideo");
   }
   ); 
    $(".show_detail").click(function (e) {
            e.preventDefault();
            var e = $(this);
                $.ajax({
                    url: '{{ url("instructor_detail") }}',
                    method: "POST",
                    data: {id: e.attr("data-id")},
                    success: function (data) {
                      $('#team1').modal('show');
                      var img = "assets/img/advisor/" + data.instructors_data.avatar;
                      $('#user_image').html('<img src="'+img+'">');
                      var phone = data.instructors_data.contact_number;
                      $('#contact').text(phone);
                      var address = data.instructors_data.address;
                      $('#address').text(address);
                      var email = data.instructors_data.email;
                      $('#email').text(email);
                      var education = data.instructors_data.qualification;
                      $('#education').text(education);
                      var name = data.instructors_data.instructor_name;
                      $('#name').text(name);
                      var about = data.instructors_data.about;
                      $('#about').text(about);
                      var recommendations = data.instructors_data.recommendations;
                      $('.recommendations').text(recommendations);
                      // var data = data.instructors_data;
                      // $('#team1').html(data.instructors_data);
                    }
                });
        });
   
            $('.read-more-content').addClass('hide_content')
            $('.read-more-show, .read-more-hide').removeClass('hide_content')
   
            // Set up the toggle effect:
            $('.read-more-show').on('click', function(e) {
              $(this).next('.read-more-content').removeClass('hide_content');
              $(this).addClass('hide_content');
              e.preventDefault();
            });
   
            // Changes contributed by @diego-rzg
            $('.read-more-hide').on('click', function(e) {
              var p = $(this).parent('.read-more-content');
              p.addClass('hide_content');
              p.prev('.read-more-show').removeClass('hide_content'); // Hide only the preceding "Read More"
              e.preventDefault();
            });
   
   
   });
</script>
@endsection