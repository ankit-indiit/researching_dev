@extends('layouts.app')
@section('title', ' פפרט בוג ')
@section('content')
<!-- Start Breadcrumb  -->
<div class="banner-inner-area2 pt8"></div>
<div class="blog-progress-main">
    <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <div class="blog-progress" >
						  <div class="blog-progress-bar">
							<div class="blog-progress-bar-fill" style="width: 0%;"></div>
							</div>
				</div>
             </div>
         </div>
    </div>
</div>
<div class="breadcrumb-inner-area mb50" style="">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <ul class="breadcrumb">
               <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> דף הבית</a></li>
               <li><a href="{{ Route('front.Blogs') }}">בלוג</a></li>
			   @if(isset($blog[0]->category->name))
               <li><a href="javascript:void(0)">{{ $blog[0]->category->name }}</a></li>
			   @endif
               <li class="active">{{ $blog[0]->title }}</li>
            </ul>
         </div>
      </div>
   </div>
</div>
<div class="blog-article default-padding pt-0"  style="direction:rtl">
   <div class="container">
      <div class="row blogouter">
         
         <div class=" col-md-4" style="direction:rtl">
            <div class="sidebartop ">
               <aside class="sidebarblog">
                  <div class="sidebar-item authorsidebar text-center">
                    <?php 
                        foreach ($instructor_data as $data) {
                        
                        $image =  asset('/assets/img/advisor/'.$data->avatar);
                        $images =  asset('/assets/users/'.$data->avatar);
                    ?>
                     @if(isset($data->avatar) && $data->avatar != '')
                     <a class ="show_detail" data-id = "{{$data->id}}" data-toggle="modal"><img src="{{ $images }}"></a>
                     @else
                     <a class ="show_detail" data-id = "{{$data->id}}" data-toggle="modal"><img src="{{ $image }}"></a>
                     @endif
                        
                     <a class = "authormore show_detail" data-id = "{{$data->id}}" data-toggle="modal" style="width: 100%;float: left;">{{$data->first_name}}</a>
                        
                     <div class="authorsocial">
                        <?php 
                        if($data->facebook_link != Null){
                        ?>
                        <a href="{{$data->facebook_link}}" class="social-icon facebook">
                           <i class="fab fa-facebook-f"></i>
                        </a>
                        <?php }?>
                        <?php 
                        if($data->linkedin_link != Null){
                        ?>
                        <a href="{{$data->linkedin_link}}" class="social-icon facebook">
                           <i class="fab fa-linkedin"></i>
                        </a>
                        <?php }?>
                        <?php 
                        if($data->whatspp_link != Null){
                        ?>
                        <a href="{{$data->whatspp_link}}" class="social-icon facebook">
                           <i class="fab fa-whatsapp"></i>
                        </a>
                        <?php }?>
                     </div>
                     
                     <p>{{ Str::limit($data->about, 60) }}</p>
                     <a class = "authormore show_detail" data-id = "{{$data->id}}" data-toggle="modal">הכר את    {{$data->first_name}}  {{$data->instructor_name}}</a>
                  </div>
                  <?php } ?>
                  <div class="sidebar-item poststab text-right">
                     <div class=" postsinner ">
                        <div class="cata-sub-nav">
                          <div class="nav-prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
                          <ul>
                           <?php
                              foreach ($categories as $category) {  ?>
                              <li class="nav-item active"><a class = "show_blogs" data-toggle="tab" data-id ="{{ $category->id }}" aria-expanded="true">
                                 {{$category->name}}
                                 </a> 
                              </li>
                           <?php }?> 
                          </ul>
                          <div class="nav-next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
                        </div>

                        <!-- <ul class="nav nav-pills" id="tabs" >
                           <?php
                              foreach ($categories as $category) {  ?>
                           <li class=""><a class = "show_blogs" data-toggle="tab" data-id ="{{ $category->id }}" aria-expanded="true">
                              {{$category->name}}
                              </a> 
                           </li>
                           <?php }?> 
                        </ul> -->
                     </div>
                     <div class="tab-content tab-content-info">
                        <!-- Single Tab -->
                        <?php
                           foreach ($categories as $category) {  
                           ?>
                        <div id="tab{{$category->id}}" class="tab-pane fade in" style = "display: none;">
                           <ul class="postslist"></ul>
                        </div>
                        <?php }?>
                     </div>
                  </div>
                  <div class="sidebar-item postssearch text-center">
                     <div class="title">
                        <h4>תרצה שנעזור לך <strong> להצליח במבחן ?</strong></h4>
                        <p>מצא את הקורס המותאם עבורך</p>
                     </div>
                     <form>
                        <?php 
                           $university_data = DB::table('universities')->get();
                        ?>
                        <div class="input-wraper mb-20">
                            <select id = "universities1" name = "universities1"class="form-control  chosen-select " data-placeholder=" בחר מוסד לימודים " multiple>
                                                @foreach($university_data as $university)
                        <option data-id = "{{ $university->id}}" data-type = "0" value="{{ $university->university_name }}">{{ $university->university_name }}</option> 
                        @endforeach  
                        </select>
                           <span class="icon-wrapper"> 
                           <span><i class="ti-search"></i></span> 
                           </span>
                        </div>
                     </form>
                     <div class="btn-blog-search">
                        <span>מרגיש מוכן לבחינה?</span>
                        <a href="#bookModal" data-toggle="modal" class="btn btn-theme mr-10">בחן את עצמך</a>
                     </div>
                  </div>
               </aside>
            </div>
         </div>
         <div class="blog-content col-md-8">
            <div class="row">
               <div class="col-md-12">
                  <div class="blog_grid_post ">
                     <div class="thumb">
                        <?php 
                           foreach ($blog as $value) {
                            
                             $image =  asset('/assets/img/blog/' .$value->image); 
                           ?>
                        <img class="img-fluid" src="{{ $image }}" alt="">
                        <!--div class="tag">
                           <!--ul class="ccn_tags">
                                       <li>
                                     <a href="#">
                                       שיווק</a>
                                     </li>
                                    </ul></div-->
                        <!--div class="post_date"><h2>21</h2> <span>October</span></div-->
                     </div>
                     <div class="details">
                        <a href="">
                           <h3>{{$value->title}}</h3>
                        </a>
                        <ul class="post_meta">
                           <li><span class="ti-timer"></span></li>
                           <li><span>
                              משך קריאה משוער כ- {{$value->reading_time }}דקות
                           </span></li>
                           <!-- <li> <div class="blog-progress">
                              <div class="blog-progress-bar">
                                <div class="blog-progress-bar-fill" style="width: 55%;"></div>
                              </div>
                              </li> -->
                           <!--li><span>משתמש מנהל</span></li>
                              <li><span class="ti-comments"></span></li>
                              <li><span>2 הערות</span></li-->
                        </ul>
                        <p>{{$value->content}}</p>
                        <div class="panel-group symb" id="accordion">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#ac11" aria-expanded="true" class="">
                                    תוכן עניינים
                                    </a>
                                 </h4>
                              </div>
                              <div id="ac11" class=" panel-collapse collapse in" aria-expanded="false">
                                 <div class="panel-body">
                                    <ul class="blog-ul">
                                    <?php 
                                    if($blog_contents != ''){
                                          $count_value = sizeof($blog_contents);
                                          for($i = 0 ; $i < $count_value; $i++){?>
                                       <li><a href="#{{$blog_contents[$i]->title}}">{{$blog_contents[$i]->title}}</a></li>
                                       <?php }?>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php 
                           $count_value = sizeof($blog_contents);
                           for($i = 0 ; $i < $count_value; $i++){?>
                        <div id="{{$blog_contents[$i]->title}}" class="blogdes">
                           <h4 class="bloghead">{{$blog_contents[$i]->title}}</h4>
                           <p>{!!$blog_contents[$i]->content!!}</p>
                        </div>
                        <?php }}?>
                        <div class="socialshare-blog">
                           <ul class="socialshare">
                              <li class="sharetext">
                                   שתף את הפוסט ב-
                               </li>
                               <li>
                                 <a  class="social-icon whatsapp" href="https://api.whatsapp.com/send?text={{Request::url()}}" data-action="share/whatsapp/share"><i class="fab fa-whatsapp"></i>Whatsapp</a>
                              </li>
                              <li>
                                 <a class="social-icon facebook" href="https://www.facebook.com/sharer.php?u={{Request::url()}}" rel="me" title="Facebook" target="_blank"><i class="fab fa-facebook"></i>Facebook</a>
                              </li>
                              <li>
                                 <a class="social-icon twitter" href="https://twitter.com/share?url={{Request::url()}}" rel="me" title="Twitter" target="_blank"><i class="fab fa-twitter"></i>Twitter</a>
                              </li>
                              <li>
                                 <a class="social-icon twitter instagram" href="" rel="me" title="Instagram" target="_blank"><i class="fab fa-instagram"></i>Instagram</a>
                              </li>
                              <li>
                                 <a href="https://www.linkedin.com/shareArticle?mini=true&url={{Request::url()}}" class="social-icon linkedin"><i class="fab fa-linkedin-in"></i>LinkedIn</a>
                                  </li>
                              
                           </ul>
                        </div>
                     </div>
                  </div>
                  @if(Auth::check()) 
                  <div class="blog-comments">
                     <div class="comments-area">
                        <div class="comments-form">
                           <div class="title">
                              <h4> כתוב תגובה או שאלה לגבי הפוסט   </h4>
                           </div>
                           <form method="POST" class="contact-comments" id="upload_comments" action="{{ route('front.blog_comments') }}" enctype="multipart/form-data">
                              <div class="row">
                                 <!--div class="col-md-6">
                                    <div class="form-group">
                                       
                                        <input name="name" class="form-control" placeholder="שֵׁם *" type="text">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                       
                                        <input name="email" class="form-control" placeholder="כתובת דוא"ל *" type="email">
                                    </div>
                                    </div-->
                                 <input type = 'hidden' name = 'blog_id' value = "{{$value->id}}">
                                 <input type="hidden" name="category_id" value = "{{$value->category_id}}">
                                 <div class="col-md-12">
                                    <div class="form-group comments">
                                       <!-- Comment -->
                                       <textarea name = "comments" class="form-control" placeholder="תגובה"></textarea>
                                    </div>
                                    <div class="form-group full-width submit textAlign">
                                       <button type="submit" class="btn btn-theme">
                                      <i class="fa fa-paper-plane" aria-hidden="true"></i> פרסם תגובה   
                                       </button>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                        
                     </div>
                  </div>
                  @else
                  <div class = "col-md-10">
                     <span style = "color:#696969	;" >
                        על מנת להוסיף תגובות או שאלות
                        <a href="#loginModal" data-toggle="modal" style="color:#eb871e;">
                           התחבר/הרשם 
                        </a> 
                        אנא
                     </span>
                  </div>
                  @endif
                  <?php }?>
                  <div class = "col-md-12" style="margin-top:20px;">
                  <?php 
                     if(count($blog_comment) != 0){
                       foreach($blog_comment as $value ){?>
                  <div class="comment-wrap blog-dt-comment">
                     <div class="comment-block">
                        <div class="commentimg">
                           <img src="{{ asset('/assets/img/userdummy.png') }}"/>
                        </div>
                        <div class="bottom-comment">
                           <div class="comment-date">
                              <?php
                                 $datetime = new DateTime($value->created_at);
                                 $date = $datetime->format('d/m/Y');
                                 $time = $datetime->format('H:i A');
                                 ?>
                              {{$date}} at {{$time}}
                           </div>
                           <a href= "#">
                              <p class="comment-text">{{$value->comment}}</p>
                           </a>
                        </div>
                     </div>
                  </div>
                  <?php }}?>
               </div>
               </div>
            </div>
         </div>
         
      </div>
   </div>
</div>
<div class="modal bookModal" id="bookModal">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header border-bottom-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
         </div>
         <!-- Modal body -->
         <div class="modal-body  p-30" id="Signup">
            <div class="form-wraper">
               <form>
                  <div class="form-group">
                     <input type="text" name="" placeholder="כותרת " class="form-control">
                  </div>
                  <div class="form-group">
                     <textarea type="text" rows="4" placeholder="תיאור " class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                     <select class="form-control  chosen-select" data-placeholder="שם האוניברסיטה או המכללה " multiple>
                        <option>שם האוניברסיטה או המכללה</option>
                        <option>מכללה 1 </option>
                        <option>מכללה 1 </option>
                        <option>מכללה 1 </option>
                     </select>
                  </div>
                  <div class="form-group">
                     <select class="form-control  chosen-select" data-placeholder="תוֹאַר " multiple>
                        <option>תוֹאַר </option>
                        <option>אומנות המדע </option>
                        <option>אומנות המדע </option>
                     </select>
                  </div>
                  <div class="form-group">
                     <select class="form-control  chosen-select" data-placeholder="קורסים " multiple>
                        <option>כַּלכָּלָנוּת </option>
                        <option>עיצוב גרפי </option>
                        <option>נפיזיקה</option>
                     </select>
                  </div>
                  <button type="submit" class="btn btn-theme btn-md btn-lt-ht mt-20">הַבָּא</button>
               </form>
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
                           <ol class="carousel-indicators">
                              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                              <li data-target="#myCarousel" data-slide-to="1"></li>
                           </ol>
                           <!-- Wrapper for slides -->
                           <div class="carousel-inner">
                              <div class="item active">
                                 <div class="reviewcont">
                                    <span class="quotetop"><i class="fa fa-quote-left"></i></span>
                                    <div class="imgflex">
                                       <img src="{{ asset('/assets/img/advisor/2.jpg') }}" />
                                       <p><span class="recommendations"></span></p>
                                       
                                    </div>
                                    <span class="quotebottom"><i class="fa fa-quote-right"></i></span>
                                 </div>
                              </div>
                              <div class="item ">
                                 <div class="reviewcont">
                                    <span class="quotetop"><i class="fa fa-quote-left"></i></span>
                                    <div class="imgflex">
                                         <img src="{{ asset('/assets/img/advisor/2.jpg') }}" />
                                       <p><span class="recommendations"></span></p>
                                     
                                    </div>
                                    <span class="quotebottom"><i class="fa fa-quote-right"></i></span>
                                 </div>
                              </div>
                           </div>
                           <button class="btn btn-theme">הוסף המלצה</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<a href="#" class="fixed-msg-icon"><img src="{{ asset('/assets/img/message-icon.png') }}" alt="Thumb"></a>
@endsection
@section('scripts')

<!-- Horizontal Scroll Bar For Category -->
<script>
   (function($) {
      $(".cata-sub-nav").on('scroll', function() {
         $val = $(this).scrollLeft();

         if($(this).scrollLeft() + $(this).innerWidth()>=$(this)[0].scrollWidth){
             $(".nav-next").hide();
           } else {
            $(".nav-next").show();
         }

         if($val == 0){
            $(".nav-prev").hide();
         } else {
            $(".nav-prev").show();
         }
      });
      console.log( 'init-scroll: ' + $(".nav-next").scrollLeft() );
      $(".nav-next").on("click", function(){
         $(".cata-sub-nav").animate( { scrollLeft: '+=460' }, 200);
         
      });
      $(".nav-prev").on("click", function(){
         $(".cata-sub-nav").animate( { scrollLeft: '-=460' }, 200);
      });
   })(jQuery);
</script>
<!-- End Of Slider -->

<script type="text/javascript">
   $(document).ready(function(){
   $("ul#tabs li:first").addClass("active");
   $('#tab1').addClass('active');
   $.ajax({
     url: '{{ url("list_category") }}',
     method: "POST",
     dataType: 'html',
     data: {id: $('ul#tabs li:first .show_blogs').attr("data-id")},
       success: function (html) {
         $('#tab1').css('display','block');
         $('#tab1').html(html);
       }
     });
    var docHeight = $(document).height(),
      windowHeight = $(window).height(),
      scrollPercent;

      $(window).scroll(function() {
        scrollPercent = $(window).scrollTop() / (docHeight - windowHeight) * 100;

        $('.blog-progress-bar-fill').width(scrollPercent + '%');
        });
      
   $(".show_blogs").click(function (e) {
     e.preventDefault();
     var e = $(this);
     $.ajax({
       url: '{{ url("list_category") }}',
       method: "POST",
       dataType: 'html',
       data: {id: e.attr("data-id")},
         success: function (html) {
           $('.tab-pane').hide();
           $('.tab-pane').removeClass('active');
           $('#tab'+e.attr("data-id")).addClass('active');
           $('#tab'+e.attr("data-id")).css('display','block');
           $('#tab'+e.attr("data-id")).html(html);
         }
       });
     });
   var stickySidebar = new StickySidebar('.sidebartop', {
     topSpacing:20,
     bottomSpacing: 20,
     containerSelector: '.blogouter',
     innerWrapperSelector: '.sidebarblog'
   });
   $('#universities1').change(function(e){
      var baseurl = window.location.origin;
      var university = [];
      var type = 0;
      $(this).find('option:selected').each(function(){
         university.push({university_name:$(this).val(),university_id:$(this).data('id'),type:$(this).data('type')});
         type = $(this).data('type');

         }); 
           $.ajax({
            url: '{{ route('front.get_degree') }}',
            type: 'POST',
            dataType: 'json',
            data: {
                university: university,
                type:type
            },
            success: function(data) {
                
               if(data.degrees.length != 0){
                  var degrees_list = data.degrees;
                  var selected_type = data.type;
                  $("#universities1").chosen("destroy");
               $('#universities1').html('');
               $('#universities1').html(data.html);
               $('#universities1').chosen();
               }
               if(data.courses.length != 0){
                  var degrees_list = data.courses;
                  var selected_type = data.type;
                  $("#universities1").chosen("destroy");
               $('#universities1').html('');
               $('#universities1').html(data.html);
               $('#universities1').chosen();
               }
               if(data.course_id != ''){
                  var course_id = data.course_id;
                  var course_name = data.course_name;
                  var selected_type = data.type;
                  // show your loading image
                  var url =  baseurl + "/researching_dev/public/courses/show/" + course_id;
                  window.location.href = url;
                  
               }
               if(data.selected_universities.length != 0){
                   $("#universities1").chosen("destroy");
                   $('#universities1').html('');
                   $('#universities1').html(data.html);
                   $('#universities1').chosen();
                }
              }
          });
        
        });
   $(".show_detail").click(function (e) {
           e.preventDefault();
           var e = $(this);
               $.ajax({
                   url: '{{ url("blog_instructor_detail") }}',
                   method: "POST",
                   data: {id: e.attr("data-id")},
                   success: function (data) {
                     $('#team1').modal('show');
                     var img = "{{ url('/') }}"+"/assets/img/advisor/" + data.instructors_data.avatar;
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