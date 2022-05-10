@extends('layouts.app')
@section('title', ' צצור קשר ')
@section('content')
<!-- Start Breadcrumb  -->
<div class="banner-inner-area2 pt8"></div>
<div class="breadcrumb-inner-area mb50" style="">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <ul class="breadcrumb">
               <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> דף הבית</a></li>
               <li class="active"> צור קשר   </li>
            </ul>
         </div>
      </div>
   </div>
</div>
<!-- Start Contact Info -->
<div class="contact-info-area default-padding pt-0" style="direction: rtl;">
   <div class="container">
      <div class="row">
         <!-- Start Contact Info -->
         <div class="contact-info text-center">
            <div class="row">
               <div class="col-md-3 col-sm-6">
                  <div class="item">
                     <div class="icon">
                        <i class="flaticon-call"></i>
                     </div>
                     <div class="info"> 
                        <h4> {{ $info->phone_title }}   </h4>
                        <span class="d-block"> {{ $info->phone_number }} </span>
                     </div>
                  </div>
               </div>
               <div class="col-md-3 col-sm-6">
                  <div class="item">
                     <div class="icon">
                        <i class="flaticon-location"></i>
                     </div>
                     <div class="info">
                        <h4> {{ $info->address_title }} </h4>
                        <!-- <span>פול סמואלסון 10, ראש העין</span> -->
                        <span> {{ $info->address_details }} </span>
                     </div>
                  </div>
               </div>
               <div class="col-md-3 col-sm-6">
                  <div class="item">
                     <div class="icon">
                        <i class="flaticon-email"></i>
                     </div>
                     <div class="info">
                        <h4> {{ $info->email_title }} </h4>
                        <span> {{ $info->email_details }} </span>
                     </div>
                  </div>
               </div>
               <div class="col-md-3 col-sm-6">
                  <div class="item">
                     <div class="icon">
                        <!--i class="ti-sharethis"></i-->
                        <div class="followimg">
                        <svg xmlns="http://www.w3.org/2000/svg" style="padding-top: 30px" xmlns:xlink="http://www.w3.org/1999/xlink" width="70px" height="70px" viewBox="0 0 436 207">
							  <image id="Follow_Us_" data-name="Follow Us!" style="width:100%;height:100%" xlink:href="data:img/png;base64,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"/>
							</svg>

                        </div>
                     </div>
                     <div class="info">
                        <h4>{{ $info->social_title }}</h4>
                        <div class="social-contact">
                           <ul>
                              @if($info->social_instagram)
                              <li><a target="_blank" href="{{ $info->social_instagram }}" class="social-icon facebook"><i class="fab fa-facebook"></i></a><li>
                              @endif
                              @if($info->social_youtube)
                              <li><a target="_blank" href="{{ $info->social_youtube }}" class="social-icon youtube"><i class="fab fa-youtube"></i></a></li>
                              @endif
                              @if($info->social_facebook)
                              <li><a target="_blank" href="{{ $info->social_facebook }}" class="social-icon instagram"><i class="fab fa-instagram"></i></a></li>
                              @endif
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- End Contact Info -->
      </div>
   </div>
   <div class="contactfaq" style="background-image: url({{ asset('/assets/img/bannerpattern.jpg')}});">
      <div class="container">
         <div class="row">
            <div class="col-md-10  col-md-offset-1">
               <div class="site-heading text-center">
                  <h2> {{ $info->que_ans_title }} </h2>
                  <p> {{ $info->que_ans_desc }} </p>
               </div>
               <div class="panel-group " id="accordion">
                  @foreach($questions as $key=>$question)
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h4 class="panel-title">
                           <a data-toggle="collapse" data-parent="#accordion" href="#ac{{ $question->id }}">
                             {{ $question->title }}
                           </a>
                        </h4>
                     </div>
                     <div id="ac{{ $question->id }}" class="panel-collapse collapse @if($key==0) in @endif">
                        <p>{{ $question->short_desc }}</p>
                        @if($question->blog_id)
                        <a href="{{ Route('front.blog.show',['slug' => $question->blog->slug]) }}" class="btn-readmore">קרא עוד</a>
                        @endif
                     </div>
                  </div>
                  @endforeach
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="container">
      <div class="row contact-bottom-info">
         <!-- Start Maps & Contact Form -->
         <div class="maps-form text-right">
            <div class="col-md-6 maps">
               <h4>המיקום שלנו </h4>
               <div class="google-maps">
                  <div id="map" style="width: 100%; height: 400px;"></div>
                  <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d14767.262289338461!2d70.79414485000001!3d22.284975!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1424308883981"></iframe> -->
               </div>
            </div>
            <div class="col-md-6 form">
               <div class="heading">
                  <h4>צור קשר </h4>
               </div>
               <form method="POST" action="{{ route('front.contact-us.save') }}" enctype="multipart/form-data" class="contact-form">
                  <input type ="hidden" name="_token" id ="token" value ="{{csrf_token()}}">
                  <input type="hidden" id="ticketIssue" >
                  <div class="row">
                     <div class="col-md-12">
                        <div class=" checkout-form">
                           <label class="container">
                           <input type="radio" name="contact_radio" value ="1" data-val="אני מעוניין לרכוש קורס ולקבל פרטים נוספי">
                           <span class="checkmark"></span> אני מעוניאני מעוניין לרכוש קורס ולקבל פרטים נוספים  </label>
                           <label class="container">
                           <input type="radio" name="contact_radio" value ="2" data-val="ח לפתיחה של קורס מותאם נוסף">
                           <span class="checkmark"></span> אשמאשמח לפתיחה של קורס מותאם נוסף   </label>
                           <label class="container">
                           <input type="radio" name="contact_radio" value ="3"    data-val="ן בשיתוף פעולה ו/או שיווק שותפים">
                           <span class="checkmark"></span> אני מעונייאני מעוניין בשיתוף פעולה ו/או שיווק שותפים</label>
                           <label class="container">
                           <input type="radio" name="contact_radio" value ="4" data-val="ניין להצטרף לצוות המרצים באתר">
                           <span class="checkmark"></span> בני מעובני מעוניין להצטרף לצוות המרצים באתר   </label>
                           <label class="container">
                           <input type="radio" name="contact_radio" value ="5" data-val="אחר">
                           <span class="checkmark"></span> אחר</label>
                           <span class="text-danger error-text contact_radio_err"></span>
                        </div>
                     </div>
                     <div class="col-md-6">
                          <div class="form-group iconBx">
                              <i class="fa fa-phone"></i>
                           <input class="form-control" id="contact_phone" name="contact_phone" placeholder="טלפון  " type="text">
                           <span class="text-danger error-text contact_phone_err"></span>
                           <span class="alert-error"></span>
                        </div>
                       
                     </div>
                     <div class="col-md-6">
                        <div class="form-group iconBx">
                               <i class="fa fa-user"></i>
                           <input class="form-control" id="contact_name" name="contact_name" placeholder="שם משתמש  " type="text">
                           <span class="text-danger error-text contact_name_err"></span>
                           <span class="alert-error"></span>
                        </div>
                     </div>
                     <div class="col-md-12">
                         <div class="form-group iconBx" >
                               <i class="fa fa-envelope"></i>
                           <input class="form-control" id="contact_email" name="contact_email" placeholder="אימייל  *" type="email">
                           <span class="text-danger error-text contact_email_err"></span>
                           <span class="alert-error"></span>
                        </div>
                     </div>
                     <div class="col-md-12">
                           
                        <div class="form-group comments iconBx"> <i class="fa fa-comment"></i>
                           <textarea class="form-control" id="contact_comments" name="contact_comments" placeholder="תוכן ההודעה"></textarea>
                           <span class="text-danger error-text contact_comments_err"></span>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <button id = "contactBtn" type="submit" name="submit">
                       <i class="fa fa-paper-plane"></i> לשלוח הודעה 
                        </button>
                     </div>
                  </div>
                  <!-- Alert Message -->
                  <div class="col-md-12 alert-notification">
                     <div id="message" class="alert-msg"></div>
                  </div>
               </form>
            </div>
         </div>
         <!-- End Maps & Contact Form -->
      </div>
   </div>
</div>
<!-- End Contact Info -->
@endsection
@section('scripts')
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1dsvymo1CdKQVBIEsIS4HSc0-dulFwfc&callback=initMap"
   type="text/javascript"></script>

   <script>
      $('.panel-group').on('click', function(){
        $('html,body').stop();
      });
   </script>
<script type="text/javascript">
   var locations = [
     ['{{ $info->address1 }}', '{{ $info->longitude1 }}', '{{ $info->lattitude1 }}', 4],
     ['{{ $info->address2 }}', '{{ $info->longitude2 }}', '{{ $info->lattitude2 }}', 5],
   ];
   
   var map = new google.maps.Map(document.getElementById('map'), {
     zoom: 8,
     center: new google.maps.LatLng('{{ $info->longitude1 }}', '{{ $info->lattitude1 }}'),
     mapTypeId: google.maps.MapTypeId.ROADMAP
   });
   
   var infowindow = new google.maps.InfoWindow();
   
   var marker, i;
   
   for (i = 0; i < locations.length; i++) {  
     marker = new google.maps.Marker({
       position: new google.maps.LatLng(locations[i][1], locations[i][2]),
       map: map
     });
   
     google.maps.event.addListener(marker, 'click', (function(marker, i) {
       return function() {
         infowindow.setContent(locations[i][0]);
         infowindow.open(map, marker);
       }
     })(marker, i));
   }
</script>  <script type="text/javascript">
   $(document).ready(function(){
   $(".signuptab").click(function(){
    $("ul.nav.nav-pills li").addClass("active");
    $("ul.nav.nav-pills li.logintab").removeClass("active");
   });
   
   $("#contactBtn").click(function(e) {
        e.preventDefault();
        var contact_name = $("input[name='contact_name']").val();
        var contact_radio = $("input:radio[name=contact_radio]:checked").val();
        var contact_email = $("input[name='contact_email']").val();
        var contact_phone = $("input[name='contact_phone']").val();
        var contact_comments = $('#contact_comments').val();
        var ticketIssue = $('#ticketIssue').val();
        $.ajax({
            url: '{{ route("front.contact-us.save") }}',
            type: 'POST',
            data: {
                contact_name:contact_name,
                contact_radio:contact_radio,
                contact_email: contact_email,
                contact_phone: contact_phone,
                contact_comments:contact_comments,
                contact_ticketIssue:ticketIssue
            },
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                     window.location.reload();
                } else {
                    printErrorMsgnew(data.error);
                }
            }
        });
    });
   
    function printErrorMsgnew (msg) {
       $.each( msg, function( key, value ) {
              $('.'+key+'_err').text(value);
            });
    }
   });
   
     //$(document).on("change","",function(){
      $('input[type=radio][name=contact_radio]').change(function() {
            $("#ticketIssue").val($(this).attr('data-val'));
     });
</script>
@endsection