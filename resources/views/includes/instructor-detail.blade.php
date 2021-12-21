@extends('layouts.app')

@section('title', 'instructor-detail')

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
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 220"><path fill="#0d0d3f" fill-opacity="1" d="M0,64L60,64C120,64,240,64,360,74.7C480,85,600,107,720,112C840,117,960,107,1080,90.7C1200,75,1320,53,1380,42.7L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>
	</div>
	
	<section class="teammodal pb40 instructdetail">
		<div class="container">
			<div class="row" style="direction: rtl;">
	           <div class="col-md-4">
	              <div class="team-widget">
	                 <div class="teamimg" id = "user_image">
	                    <img src="assets/img/advisor/2.jpg">
	                 </div>
	                 <div class="teaminfo">
						 <ul class="memberinfo">
						  <li><i class="fa fa-phone"></i><span id="contact">054-7896710</span></li>
						  <li><i class="fa fa-map-marker-alt"></i><span id="address">Mivtza Uvda Street, Rishon Lezion, Israel</span></li>
						  <li><i class="fa fa-envelope"></i><span id="email">Elyasaf@gmail.com</span></li>
						 </ul>
					  </div>
	                 <hr class="mt-20 mb-20">
	                 <div class="teameduc">
						<div class="site-heading text-center mb-10">
						<h2 class="">חינוך</h2>
					    </div>
						<p><span id="education">B.Tech במדעי המחשב מאוניברסיטת וורטון2008-2012</span></p>
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
	                    <span id="about"> 
	                    	ורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז, כאשר מדפסת לא ידועה לקחה מטבע מסוג וסיבבה אותו כדי ליצור ספר דגימה. זה שרד לא רק חמש מאות שנה, אלא גם את הקפיצה לכתב עבודות אלקטרוני, ונשאר למעשה ללא  
	                    </span>

	                    <h3 class="mb-0 mt-30"><b>המלצות</b></h3>
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
	                                      <p><span class="recommendations">ורם איפסום הוא פשוטדמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז שנות ה 1500-, כאשר מדפסת לא ידועה לקחה מטה מסוג וסיבב אותו בכדי . לורם איפסום הוא פשוטדמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי ש </span></p>
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
	                                      <p><span class="recommendations">ורם איפסום הוא פשוטדמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז שנות ה 1500-, כאשר מדפסת לא ידועה לקחה מטה מסוג וסיבב אותו בכדי . לורם איפסום הוא פשוטדמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי ש </span></p>
	                                      <span class="quotebottom"><i class="fa fa-quote-right"></i></span>
	                                   </div>
	                                   <div class="recommendimg"><img src="{{ asset('/assets/img/advisor/course_tutor_2.jpg') }}"></div>
	                                </div>
	                             </div>
	                          </div>
	                       </div>
	                     
	                    </div>  <div class="mt-20">
	                       <a href="{{url('/recommend')}}" class="btn btn-theme mt-20">לרשימת ההמלצות המלאה</a>
	                       <button class="btn btn-join mr-10 mt-20">הוסף המלצה</button>
	                       <button class="btn btn-join mr-10 mt-20 addcard">הוסף לעגלה     <i class="fa fa-cart-plus" aria-hidden="true"></i> </button> </div>
	                 </div>
	              </div>
	           </div>
	        </div>
		</div>
	</section>
	<!-- Preloader Start -->
    <div class="se-pre-con">
    	<h2>
 מוצאים את המורה הכי טוב בשבילך</h2>
    </div>
    <!-- Preloader Ends -->
	@endsection
	@section('scripts')
	<script type="text/javascript">
		$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").delay(4000).fadeOut("slow");;
	});
	</script>
	
	@endsection	