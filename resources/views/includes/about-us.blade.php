@extends('layouts.app')
@section('title', 'עלינו ')
@section('content')
<!-- Start Breadcrumb  -->
<div class="banner-inner-area2 pt8"></div>
<div class="breadcrumb-inner-area mb50" style="">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <ul class="breadcrumb">
               <li><a href="#"><i class="fas fa-home"></i> דף הבית</a></li>
               <li class="active">באודות</li>
            </ul>
         </div>
      </div>
   </div>
</div>
<!--   <div class="curvedown">
   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 220"><path fill="#0d0d3f" fill-opacity="1" d="M0,64L60,64C120,64,240,64,360,74.7C480,85,600,107,720,112C840,117,960,107,1080,90.7C1200,75,1320,53,1380,42.7L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path>
   </svg>
   </div> -->
<!-- End Breadcrumb -->
<div class="about-area default-padding pt-0" style="direction: rtl;">
   <div class="container">
      <div class="row">
         <div class="about-items">
            <div class="col-md-6 thumb">
               <div class="thumb">
                  <div class="thumb aboutimg">
                        @if($aboutuses)
                        <img src="{{ asset('/assets/images/').'/'.$aboutuses[0]->a1_image }}" class="aboutbg">
                        <img src="{{ asset('/assets/images/').'/'.$aboutuses[0]->a2_image }}" alt="Thumb">
                        @endif
                     <!--<img src="{{ asset('/assets/img/about/aboutbg2.png') }}" class="aboutbg">
                     <img src="{{ asset('/assets/img/about/about2.png') }}" alt="Thumb">-->
                  </div>
               </div>
            </div>
            <div class="col-md-6 about-info wow fadeInLeft">
                <h2>
                   <span>
                    @if($aboutuses)
                    {{ $aboutuses[0]->a1_title }}
                    @endif
                    </span>
                </h2>
               @if($aboutuses)
                   <blockquote> {{ $aboutuses[0]->a1_description }} </blockquote>
               @endif
               <!--<blockquote> לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז, כאשר מדפסת לא ידועה לקחה מטבע מסוג וסיבב אותו בכדי ליצור ספר דגימה. 
               </blockquote>-->
               @if($aboutuses)
                   <p> {{ $aboutuses[0]->a2_description }} </p>
               @endif
               <!--<p> היא לא שרדה לא רק חמש מאות שנה, אלא גם את הקפיצה לכתב עבודות אלקטרוני, ונותרה בעינה ללא שינוי. זה היה פופולרי עם שחרורם של גיליונות המכילים קטעי לורם איפסום, ולאחרונה עם תוכנות פרסום שולחניות כמו כולל גרסאות של לורם איפסום.</p>
               <p>ה ללא שינוי. זה היה פופולרי עם שחרורם של גיליונות המכילים קטעי לורם איפסום, ולאחרונה עם תוכנות פרסום שולחניות כמו כולל גרסאות של לורם איפסום.</p>
               
               {היא לא שרדה לא רק חמש מאות שנה, אלא גם את הקפיצה לכתב עבודות אלקטרוני, ונותרה בעינה ללא שינוי. זה היה פופולרי עם שחרורם של גיליונות המכילים קטעי לורם איפסום, ולאחרונה עם תוכנות פרסום שולחניות כמו כולל גרסאות של לורם איפסום. ה ללא שינוי. זה היה פופולרי עם שחרורם של גיליונות המכילים קטעי לורם איפסום, ולאחרונה עם תוכנות פרסום שולחניות כמו כולל גרסאות של לורם איפסום.}
               
               -->
                </div>
         </div>
      </div>
   </div>
</div>
<!--div class="about-area default-padding bg-gray" style="direction: rtl;">
   <div class="container">
     <div class="row">
       <div class="about-items">
       <div class="col-md-6 thumb aboutleft  wow fadeInLeftBig">
           <div class="thumb">
             <img src="assets/img/about/5.jpg" alt="Thumb">
           </div>
         </div>
         <div class="col-md-6 about-info wow fadeInRightBig" >
           <h2>איך להתחיל?</span></h2>
           <blockquote> לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז, כאשר מדפסת לא ידועה לקחה מטבע מסוג וסיבב אותו בכדי ליצור ספר דגימה. </blockquote>
           <p> היא לא שרדה לא רק חמש מאות שנה, אלא גם את הקפיצה לכתב עבודות אלקטרוני, ונותרה בעינה ללא שינוי. זה היה פופולרי עם שחרורם של גיליונות המכילים קטעי לורם איפסום, ולאחרונה עם תוכנות פרסום שולחניות כמו כולל גרסאות של לורם איפסום.</p>
            <p>ה ללא שינוי. זה היה פופולרי עם שחרורם של גיליונות המכילים קטעי לורם איפסום, ולאחרונה עם תוכנות פרסום שולחניות כמו כולל גרסאות של לורם איפסום.</p>
      </div>
       </div>
     </div>
   </div>
   </div-->
<div class="our-team default-padding ouTeam" style="background-image: url({{ asset('/assets/img/bannerpattern.jpg')}}); direction: rtl;">
   <div class="container">

      <div class="row">
          <div class="col-md-12">
            <div class="site-heading text-center">
                <h2>
                   @if($aboutuses)
                    {{ $aboutuses[0]->a2_title }}
                    @endif
                </h2>
            </div>
         </div>
      </div>

      <div class="row rowfLex">
        
         <?php
            foreach ($instructors as $instructor) { 
            $image =  asset('/assets/users/' .$instructor->avatar);
              ?>
         <div class="col-md-6 aboutteam   wow fadeInLeft">
            <div class="aboutthumb show_detail" data-id = "{{$instructor->id}}" data-toggle="modal">
               <div class="aboutthumbimg">
                  <a  data-id = "{{$instructor->id}}" data-toggle="modal">
                  <img src="{{$image}}">
                  </a>
               </div>
               <div class="aboutthumbcont">
                  <a data-id = "{{$instructor->id}}" data-toggle="modal">
                     <h2 class="mb-0">{{$instructor->first_name . $instructor->last_name}} </h2>
                     <span >מנהל</span> 
                     <p>{{ $instructor->about}}</p>
                  </a>
               </div>
            </div>
         </div>
         <?php } ?>
      </div>
   </div>
</div>
<div class="modal teammodal fade" id="team1">
   <input type = "hidden" name="instructorid" id ="instructorid" value ="">
   <div class="modal-dialog  modal-lg">
      <div class="modal-content">
         <div class="modal-header border-bottom-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
         </div>
         <div class="modal-body" style="direction: rtl;">
            <div class="row">
               <div class="col-md-4">
                  <div class="team-widget">
                     <div class="site-heading text-center mb-10 mobile-title">
                        <h2 class="">ג'יימס סמית '</h2>
                        <span>מנהל</span>
                     </div>
                     <div class="teamimg" id = "user_image">
                        <!-- <img src="assets/img/advisor/2.jpg"> -->
                     </div>
                     <div class="teaminfo">
                        <ul class="memberinfo">
                           <li><i class="fa fa-phone"></i><span id="contact"></span></li>
                           <li><i class="fa fa-map-marker-alt"></i><span id="address"></span></li>
                           <li><i class="fa fa-envelope"></i><span id="email"></span></li>
                        </ul>
                     </div>
                     <hr class="mt-20 mb-20">
                        <div class="authorsocial">
                        </div>
                     <div class="proSocial">
                        <ul class="socialshare text-center">	
                           <li><a href="" class="social-icon whatsapp"><i class="fab fa-whatsapp"></i></a></li>
                           <li><a href="" class="social-icon facebook"><i class="fab fa-facebook"></i></a></li>
                           <li><a href="" class="social-icon twitter"><i class="fab fa-twitter"></i></a></li>
                           <li><a href="" class="social-icon instagram"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                     </div>
                     <div class="teameduc">
                        <div class="site-heading text-center mb-10">
                           <h2 class="">חינוך</h2>
                        </div>
                        <p><span id="education"></span></p>
                     </div>
                  </div>
               </div>
               <div class="col-md-8">
                  <div class="team-widget">
                     <div class="site-heading text-center mb-10 web-title">
                        <h2 class="">ג'יימס סמית '</h2>
                        <span>מנהל</span>
                     </div>
                     <div class="teamdescription">
                        <h3><b><span id="name"></span></b></h3>
                        <p><span id="about"></span></p>
                        <h3 class="mb-0"><b>המלצות</b></h3>
                        <div id="myCarousel" class="carousel slide" data-ride="carousel" data-touch="true">
                           <!-- Indicators -->
                           <ol class="carousel-indicators mb-20">
                           </ol>
                           <!-- Wrapper for slides -->
                           <div class="carousel-inner">

                           </div>
                           <a id="show_comments" class="btn btn-theme mt-20">לרשימת ההמלצות המלאה</a>
                           @if(Auth::check())
                           <button class="btn btn-join btn-add-recomnd mr-10 mt-20" data-id="" data-toggle="modal" href="#team2">הוסף המלצה</button>
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php 
   if(Auth::check()){
     $userid = Auth::user()->id;
   }else{
     $userid = '0';
   }
   
   ?>
<!--New modal Start-->
<form method="POST" action="{{url('add_recommend')}}" id="add_instrecommend_form">
   @csrf
   <input type = "hidden" name="user_id" id ="user_id" value ="{{$userid}}">
   <input type = "hidden" name="instructor_id" id ="instructor_id" value ="">
   <div class="modal teammodal2 teammodal21 fade" id="team2" data-backdrop="static">
      <div class="modal-dialog">
         <div class="modal-content">
            <!-- modal header -->
            <div class="modal-header border-bottom-0">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
            <!-- modal header ends -->
            <!-- Modal body -->
            <div class="modal-body">
               <div class="recommend_team " style="direction: rtl;">
                  <div class="form-wraper1">
                     <h3 class="mb-0"> הוסף המלצה  </h3>
                     <div class="form-group">
                        <label for="recommed" class="et_pb_contact_form_label">המלצה</label>
                        <textarea type="text" id="recommend" name="recommend" rows="5"  class="form-control" placeholder="המלצה"></textarea>
                        <span class="recommend_error text-danger"></span>
                     </div>
                   <!--   <div class="form-group ">
                        <input style ="border:none;" type='file' id="imageupload" accept=".png, .jpg, .jpeg" name = "avatar" />
                     </div> -->
                     <div class="form-group text-center mb-0">
                        <button id = "addrecommend" class="log-btn form-btn wdt-30"> שלח  </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</form>
<!--New modal End-->
@if(!Auth::check())
<!-- Start Newsletter  -->
<form method="POST" action="{{url('newsletters')}}">
   @csrf
   <div class="newsletter-area subscribe-items shadow theme-hard default-padding bg-cover" style="background-image: url({{ asset('/assets/img/banner/11.jpg')}}); direction: rtl;">
      <div class="container">
         <div class="row">
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
@endsection
@section('scripts')

<script >
   $('#myCarousel').on('touchstart mousedown', function(event) {
         var xClick;
         if (event.type == 'touchstart') {
             xClick = event.originalEvent.touches[0].pageX;
         } else {
             xClick = event.originalEvent.pageX;
         }

         $(this).on('touchmove mousemove', function(event) {
             var xMove;
             if (event.type == 'touchmove') {
                 xMove = event.originalEvent.touches[0].pageX;
             } else {
                 xMove = event.originalEvent.pageX;
             }
             const sensitivityInPx = .5;

             if (Math.floor(xClick - xMove) > sensitivityInPx) {
                 $(this).carousel('next');
             } else if (Math.floor(xClick - xMove) < -sensitivityInPx) {
                 $(this).carousel('prev');
             }

         });
         $(this).on('touchend mouseover', function() {
             $(this).off('touchmove mousemove');
         });
     });
</script>
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
     $(".signuptab").click(function(){
     $("ul.nav.nav-pills li").addClass("active");
     $("ul.nav.nav-pills li.logintab").removeClass("active");
     });
     $("body").on('click','.show_detail', function (e) {
           e.preventDefault();
           var e = $(this);
               $.ajax({
                   url: '{{ url("about_detail") }}',
                   method: "POST",
                   data: {id: e.attr("data-id")},
                   success: function (data) {
                     $('.teammodal2 .recommend_team').show();
                     $('.teammodal2 .add-recomn-sucess').hide();
                     $('.recommend_team #recommend').val('');
                     $('.btn-add-recomnd').attr('data-id', data.id);
                     $('.authorsocial').empty();
                     $('#myCarousel .carousel-indicators').empty();
                     $('#myCarousel .carousel-inner').empty();
                     $('.no-recomends').empty();
                     console.log(data.instructors_data);
                     var inst_id = data.instructors_data.id;
                     $('#instructor_id').val(inst_id);
                     $('#instructorid').val(inst_id);
                     var img = "assets/users/" + data.instructors_data.avatar;
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
                     var recommendations = data.recomendations;
                     if(recommendations.length != 0){
                     $.each(recommendations, function (key, val) {
                        var rec = val.recomendation;
                        console.log(val);
                        var is_active = (key == 0) ? "active" : "";
                        var full_name =  rec.user.first_name +' '+rec.user.last_name;
                        $('#myCarousel .carousel-indicators').append('<li data-target="#myCarousel" data-slide-to="'+key+'" class="'+is_active+'"></li>');  
                        $html = '<div class="item '+is_active+'">'+
                                 '<div class="reviewcont">'+
                                    '<div class="recommendcont">'+
                                       '<div class="recommendinner">'+
                                          '<span class="quotetop"><i class="fa fa-quote-right"></i></span>'+
                                          '<p><span class="recommendations">'+rec.description+'</span></p>'+
                                          '<span class="quotebottom"><i class="fa fa-quote-left"></i></span>'+
                                       '</div>'+
                                       '<div class="infoUser">'+
                                          '<div class="recommendimg">'+
                                              '<img src="{{ asset('/assets/users') }}/'+rec.user.avatar+'">'+
                                          '</div>'+
                                          '<h3>'+full_name+'</h3>'+
                                          '<p class="mb-0" >'+rec.user.universities.university_name+'</p>'+
                                          '<p class="mb-0">'+rec.user.degree.degree_name+'</p>'+
                                       '</div>'+
                                    '</div>'+
                                 '</div>'+
                              '</div>';
                        $('#myCarousel .carousel-inner').append($html);
                     });
                     }else{
                        $('#myCarousel .carousel-inner').after('<p class="text-center no-recomends">אין המלצות זמינות!</p>');
                     }
                     var fblink = data.instructors_data.facebook_link;
                     var whatspplink = data.instructors_data.whatspp_link;
                     var linkedinlink = data.instructors_data.linkedin_link;
                     var insta_link = data.instructors_data.insta_link;
					      var social_html = '';
                     if (whatspplink != '' && whatspplink != null){
                       social_html += '<li><a href="'+whatspplink+'" class="social-icon whatsapp"><i class="fab fa-whatsapp"></i></a></li>&nbsp';
                     }
                     if (fblink != '' && fblink != null){
                       social_html += '<li><a href="'+fblink+'" class="social-icon facebook"><i class="fab fa-facebook"></i></a></li>&nbsp';
                     }
                     if (linkedinlink != '' && linkedinlink != null){
                        social_html += '<li><a href="'+linkedinlink+'" class="social-icon linkedin"><i class="fab fa-linkedin"></i></a></li>&nbsp';
                     }
                     if (insta_link != '' && insta_link != null){
                        social_html += '<li><a href="'+insta_link+'" class="social-icon instagram"><i class="fab fa-instagram"></i></a></li>&nbsp';
                     }
                     $('.socialshare').html(social_html);
                        $('#team1').modal('show');
                     }
               });
       });
   
     $("#addrecommend").click(function(e) {
         e.preventDefault();
         var user_id = $('#user_id').val();
         var instructor_id = $('#instructor_id').val();
         var recommend = $('.recommend_team #recommend').val();
         if(recommend == ''){
            $('.recommend_error').text('זה שדות חובה.');
         }else{
            if(user_id != 0){
               console.log('i');
               $.ajax({
                  url: '{{ Route('front.add_recommend') }}',
                  method: "POST",
                  data: {
                     'type'   : 'instructor',
                     'user_id' : user_id,
                     'instructor_id' : instructor_id,
                     'recommend' : recommend
                  },
                  success: function (data) {
                     $html = '<div class="alert alert-success add-recomn-sucess" role="alert">'+
                                 '<h4 class="alert-heading">מזל טוב!</h4>'+
                                 '<p>המלצתך נוספה בהצלחה. מנהל המערכת יאשר זאת לאחר הבדיקה.</p>'+
                              '</div>';
                     $('.teammodal2 .recommend_team').hide();
                     $('.teammodal2 .recommend_team').after($html);
                  } 
               });
            }
         }
      });
   
     $("#show_comments").click(function(e) {
       e.preventDefault();
       var instructor_id = $('#instructorid').val();
       window.location.href = "{{route('front.instructor_recommend')}}" + '/' + instructor_id;
          });
   
   });
</script>
@endsection