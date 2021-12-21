@extends('layouts.app')
@section('title', ' מַדְרִיך ')
@section('content')
<!-- Start Breadcrumb 
   ============================================= -->
<div class="breadcrumb-area" style="" >
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <h1>מַדְרִיך  </h1>
            <ul class="breadcrumb">
               <li><a href="#"><i class="fas fa-home"></i> דף הבית</a></li>
               <li class="active">מַדְרִיך </li>
            </ul>
         </div>
      </div>
   </div>
</div>
<div class="curvedown">
   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 220">
      <path fill="#0d0d3f" fill-opacity="1" d="M0,64L60,64C120,64,240,64,360,74.7C480,85,600,107,720,112C840,117,960,107,1080,90.7C1200,75,1320,53,1380,42.7L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path>
   </svg>
</div>
<div class="default-padding pt-0 ptIns" style="direction: rtl;">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="site-heading text-center">
               <h2>המדריכים שלנו</h2>
               <p> לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקס הדמה הסטנדרטי בתעשייה. </p>
            </div>
         </div>
         <?php
            foreach ($instructors as $instructor) { 
            $image =  asset('/assets/img/advisor/' .$instructor->avatar); 
              ?>
         <div class="col-md-6 aboutteam  wow fadeInLeftBig  mb-30">
            <div class="aboutthumb">
               <div class="aboutthumbimg">
                  <a class = "show_detail" data-id = "{{$instructor->id}}" data-toggle="modal">
                  <img src="{{$image}}">
                  </a>
               </div>
               <div class="aboutthumbcont">
                  <a class = "show_detail" data-id = "{{$instructor->id}}" data-toggle="modal">
                     <h2 class="mb-0">{{$instructor->first_name}} </h2>
                     <span >מנהל</span> 
                     <p>{{ Str::limit($instructor->about, 30) }}</p>
                  </a>
               </div>
            </div>
         </div>
         <?php } ?>
      </div>
      @if ($instructors->lastPage() > 1) 
      <ul class="pagination">
         <li class="{{ ($instructors->currentPage() == 1) ? ' disabled' : '' }}"> 
            <a href="{{ $instructors->url(1) }}">Previous</a> 
         </li>
         @for ($i = 1; $i <= $instructors->lastPage(); $i++) 
         <li class="{{ ($instructors->currentPage() == $i) ? ' active' : '' }}"> 
            <a href="{{ $instructors->url($i) }}">{{ $i }}</a> 
         </li>
         @endfor 
         <li class="{{ ($instructors->currentPage() == $instructors->lastPage()) ? ' disabled' : '' }}">   <a href="{{ $instructors->url($instructors->currentPage()+1) }}" >Next</a> 
         </li>
      </ul>
      @endif
   </div>
	  
	  
	  
	  
     
 <div class="modal teammodal" id="team1">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
     <div class="modal-header border-bottom-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
     </div>
      <div class="modal-body" style="direction: rtl;">
	  <div class="row">
	  <div class="col-md-4">
	     <div class="team-widget">
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
	  	     <div class="site-heading text-center mb-10">
				<h2 class="">ג'יימס סמית '</h2>
				 <span>מנהל</span>
			    </div>
			<div class="teamdescription">
				<h3><b><span id="name"></span></b></h3>
			<p><span id="about"></span></p>
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
                                    
                                   <div class="recommendcont"><div class="recommendinner"><span class="quotetop"><i class="fa fa-quote-left"></i></span><p><span class="recommendations"></span></p>  <span class="quotebottom"><i class="fa fa-quote-right"></i></span></div> <div class="recommendimg"><img src="{{ asset('/assets/img/advisor/course_tutor_1.jpg') }}"></div> </div>    									
                                    
                                 </div>
    </div>
	<div class="item ">
     <div class="reviewcont">
                                   
                                   <div class="recommendcont"><div class="recommendinner"><span class="quotetop"><i class="fa fa-quote-left"></i></span>  <p><span class="recommendations"></span></p>  <span class="quotebottom"><i class="fa fa-quote-right"></i></span></div> <div class="recommendimg"><img src="{{ asset('/assets/img/advisor/course_tutor_2.jpg') }}"></div> </div>							
                                  
                                 </div>
    </div>
    </div>
<a href="{{url('/recommend')}}" class="btn btn-theme mt-20">לרשימת ההמלצות המלאה</a>
  <button class="btn btn-join mr-10 mt-20">הוסף המלצה</button>
    </div>
			
			</div>
	  </div>
	  </div>
	  </div>
      </div>

   
    </div>
  </div>

</div>
<div class="modal teammodal" id="team1">
   <div class="modal-dialog  modal-lg">
      <div class="modal-content">
         <div class="modal-header border-bottom-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
         </div>
         <div class="modal-body" style="direction: rtl;">
            <div class="row">
               <div class="col-md-4">
                  <div class="team-widget">
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
                     <div class="site-heading text-center mb-10">
                        <h2 class="">ג'יימס סמית '</h2>
                        <span>מנהל</span>
                     </div>
                     <div class="teamdescription">
                        <h3><b><span id="name"></span></b></h3>
                        <p><span id="about"></span></p>
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
                                          <p><span class="recommendations"></span></p>
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
                                          <p><span class="recommendations"></span></p>
                                          <span class="quotebottom"><i class="fa fa-quote-right"></i></span>
                                       </div>
                                       <div class="recommendimg"><img src="{{ asset('/assets/img/advisor/course_tutor_2.jpg') }}"></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <a href="/researching_dev/public/recommend" class="btn btn-theme mt-20">לרשימת ההמלצות המלאה</a>
                           <button class="btn btn-join mr-10 mt-20">הוסף המלצה</button>
                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
     @if(!Auth::check())
<!-- Start Newsletter  -->
<form method="POST" action="{{url('newsletters')}}">
  @csrf
<div class="newsletter-area subscribe-items shadow theme-hard default-padding bg-cover" style="background-image: url({{ asset('/assets/img/banner/11.jpg')}});">
  <div class="container">
    <div class="row">
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
                  <div class ="form-group">
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
   $(".signuptab").click(function(){
    $("ul.nav.nav-pills li").addClass("active");
    $("ul.nav.nav-pills li.logintab").removeClass("active");
   });
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
   });
     
</script>
@endsection