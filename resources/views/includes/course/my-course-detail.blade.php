@extends('layouts.app')
@section('title', ' פרט הקורס שלי   ')
@section('content')
<main class="py-4">
   <style>
      div#player {
      height: 495px;
      /* PADDING: 126PX; */
      width: 880px !important;
      cursor: pointer;
      }
      div#player iframe {
      width: 100%;
      height: 100%;
      }
      .hideAll{
      display:none;
      }
      span.videotitle {
      font-size: 28px;
      padding: 10px;
      float: left;
      width: 100%;
      margin: 10px 0px;
      text-transform: capitalize;
      }
      i.bookmarkicon.flagCls.fa.fa-flag{
      color: #ff0000;
      }
      i.bookmarkicon.flagCls.far.fa-flag{
      color: #808080;
      }

     img.loder-img {
		width: 75px;
	}
      @keyframes load2 {
        0%,
        100% {
          box-shadow: 0em -3em 0em 0.2em #ffffff, 2em -2em 0 0em #ffffff, 3em 0em 0 -0.5em #ffffff, 2em 2em 0 -0.5em #ffffff, 0em 3em 0 -0.5em #ffffff, -2em 2em 0 -0.5em #ffffff, -3em 0em 0 -0.5em #ffffff, -2em -2em 0 0em #ffffff;
        }
        12.5% {
          box-shadow: 0em -3em 0em 0em #ffffff, 2em -2em 0 0.2em #ffffff, 3em 0em 0 0em #ffffff, 2em 2em 0 -0.5em #ffffff, 0em 3em 0 -0.5em #ffffff, -2em 2em 0 -0.5em #ffffff, -3em 0em 0 -0.5em #ffffff, -2em -2em 0 -0.5em #ffffff;
        }
        25% {
          box-shadow: 0em -3em 0em -0.5em #ffffff, 2em -2em 0 0em #ffffff, 3em 0em 0 0.2em #ffffff, 2em 2em 0 0em #ffffff, 0em 3em 0 -0.5em #ffffff, -2em 2em 0 -0.5em #ffffff, -3em 0em 0 -0.5em #ffffff, -2em -2em 0 -0.5em #ffffff;
        }
        37.5% {
          box-shadow: 0em -3em 0em -0.5em #ffffff, 2em -2em 0 -0.5em #ffffff, 3em 0em 0 0em #ffffff, 2em 2em 0 0.2em #ffffff, 0em 3em 0 0em #ffffff, -2em 2em 0 -0.5em #ffffff, -3em 0em 0 -0.5em #ffffff, -2em -2em 0 -0.5em #ffffff;
        }
        50% {
          box-shadow: 0em -3em 0em -0.5em #ffffff, 2em -2em 0 -0.5em #ffffff, 3em 0em 0 -0.5em #ffffff, 2em 2em 0 0em #ffffff, 0em 3em 0 0.2em #ffffff, -2em 2em 0 0em #ffffff, -3em 0em 0 -0.5em #ffffff, -2em -2em 0 -0.5em #ffffff;
        }
        62.5% {
          box-shadow: 0em -3em 0em -0.5em #ffffff, 2em -2em 0 -0.5em #ffffff, 3em 0em 0 -0.5em #ffffff, 2em 2em 0 -0.5em #ffffff, 0em 3em 0 0em #ffffff, -2em 2em 0 0.2em #ffffff, -3em 0em 0 0em #ffffff, -2em -2em 0 -0.5em #ffffff;
        }
        75% {
          box-shadow: 0em -3em 0em -0.5em #ffffff, 2em -2em 0 -0.5em #ffffff, 3em 0em 0 -0.5em #ffffff, 2em 2em 0 -0.5em #ffffff, 0em 3em 0 -0.5em #ffffff, -2em 2em 0 0em #ffffff, -3em 0em 0 0.2em #ffffff, -2em -2em 0 0em #ffffff;
        }
        87.5% {
          box-shadow: 0em -3em 0em 0em #ffffff, 2em -2em 0 -0.5em #ffffff, 3em 0em 0 -0.5em #ffffff, 2em 2em 0 -0.5em #ffffff, 0em 3em 0 -0.5em #ffffff, -2em 2em 0 0em #ffffff, -3em 0em 0 0em #ffffff, -2em -2em 0 0.2em #ffffff;
        }
      }
     .panel.panel-default.videoLoader .adjust {
			display: flex;
			height: 100%;
			width: 100%;
			justify-content: center;
			align-items: center;
		}
      .hide-video-loader{
         display: none;
      }

      .panel.panel-default.videoLoader {
			height: 565px;
			position: absolute;
			left: 0;
			top: 0;
			z-index: 2;
			background: #fff;
			border: 0;
			width: 100%;
      }

   </style>
   <link href="https://dev.indiit.solutions/researching_dev/public/assets/css/videre.css" rel="stylesheet">
   <link href="https://dev.indiit.solutions/researching_dev/public/assets/css/videoapp.css" rel="stylesheet">
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <div class="breadcrumb-inner-area pt-92">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 col-md-12">
               <ul class="breadcrumb">
                  <li><a href="https://dev.indiit.solutions/researching_dev/public"><i class="fas fa-home"></i> דף הבית</a></li>
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
                  <div class="col-md-9">
                     <div class="panel panel-default videoLoader hide-video-loader">
                        <div class="adjust d-none">
                           <div class="loader2">
							<img src="https://dev.indiit.solutions/researching_dev/public/assets/img/preloader.gif" class="loder-img">
						   </div>
                        </div>
                     </div>
                     <div class="courses-info mycourseinfo">
                        <span class="videotitle"></span>
                        <div id="course-details-panel">
                           <div class="fluid-course-video">
                              <div id="player" class="vid-wrapper videre-container"></div>
                           </div>
                        </div>                           
                     </div>
                     <div class="comments-area" style="display:none">
                        <div class="comments-form">
                           <div class="title">
                              <h4>השאירו ביקורת</h4>
                           </div>
                           <form method="POST" class="contact-comments" id="upload-chats" action="https://dev.indiit.solutions/researching_dev/public/ratings" enctype="multipart/form-data">
                              <div class="row">                                
                                 <input type="hidden" name="mycourseid" value="30">
                                 <div class="col-md-12">
                                    <div class="form-group comments">
                                       <textarea name="comments" class="form-control" placeholder="סקירה"></textarea>
                                    </div>
                                    <div class="form-group full-width submit">
                                       <button type="submit" class="btn btn-theme">שלח</button>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <!-- End Course Info -->
                  <!-- Start Course Sidebar -->
                  <div class="col-md-3">
                     <div class="aside">
                        <!-- Sidebar Item -->
                        <div class="sidebar-item course-info mycourse-side">
                           <div class="title">
                              <!--<h2>סטטיסטיקה תיאורית (סטטיסטיקה א') </h2>-->
                              <h2>{{ $course }}</h2>
                           </div>
                           <div class="aboutsearch">
                              <div class="form-group">
                                 <div class="input-group">
                                    <input id="onlyText" type="text" name="searchBar" onkeydown="return /[a-z]/i.test(event.key)" placeholder="לחפש.." class="form-control searchBar" course_id="30" topicidsstr="76,117,136,139,">
                                    <span class="input-group-addon"> <i class="ti-search"></i></span>
                                 </div>
                              </div>
                           </div>
                           <div class="mycourse-list">
                              <div class="panel-group symb" id="accordion">
                                @if (!empty($userTopics))
                                 @foreach ($userTopics as $key => $topics)
                                 <div class="panel panel-default topicCls" topic_id="117">
                                    <div class="panel-heading">
                                       <h4 class="panel-title">
                                          <a data-toggle="collapse" data-parent="#accordion" href="#ac{{$key}}" aria-expanded="false" class="openeye collapsed" data-lecture-id="117">
                                             <strong>{{getTopicNameById($key)}}</strong>
                                          </a>
                                       </h4>
                                    </div>
                                    <div id="ac{{$key}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                       <div class="panel-body p-0 border-0">
                                          <ul class="section-list video_sec_list">
                                             @foreach ($topics as $element)
                                             @php                                                
                                                if ($element->watched_topic_element == true) {
                                                   $backgroudColor = "#fff4e9!important";
                                                } else {
                                                   $backgroudColor = "#fff";
                                                }                                               

                                                if ($element->type == 'pdf') {
                                                   if (!empty($element->topic_url)) {
                                                      $link = url("/assets/topic_pdf/$element->topic_url");
                                                   } else {
                                                      $link = 'javascript:void(0)';
                                                   }                                                   
                                                   $icon = $element->elementStatus == 'true' ? 'fas fa-check-circle' : 'fa fa-file-pdf';
                                                   $elementClass = '';
                                                } elseif ($element->type == 'video') {
                                                   $link = 'javascript:void(0)';
                                                   $elementClass = 'elementClass';
                                                   $icon = $element->elementStatus == 'true' ? 'fas fa-check-circle' : 'far fa-play-circle';
                                                } elseif ($element->type == 'quiz') {
                                                   $link = url("quiz-question"."/".$element->course_id."/".$element->topic_id."/".$element->id);
                                                   $elementClass = '';
                                                   $icon = $element->elementStatus == 'true' ? 'fas fa-check-circle' : 'fa fa-question';
                                                }        
                                             @endphp 
                                                <li class="topicElementCls" topic_id="{{$element->topic_id}}" element_id="{{$element->id}}" element_type="{{$element->type}}" course_id="{{$element->course_id}}" {{ $element->elementStatus }}>
                                                   <a class="item" href="{{$link}}" style="background:{{ @$backgroudColor }}" {{$element->type == 'pdf' ? 'download="'.$element->topicTitle.'"' : ''}}>
                                                      <div class="title-container">
                                                         <span class="lecture-main {{@$elementClass}}" data-topic-video-url="{{$element->topic_url}}"data-video-title="{{$element->topicTitle}}" data-element-id="{{$element->id}}" data-type="{{$element->type}}">
                                                            <span class="lecture-icon video_time_div">
                                                               <i class="{{$icon}}"></i>
                                                               <span class="video_total_time">
                                                                  {{ $element->type == 'video' ? $element->topic_duration : '' }}
                                                               </span>
                                                            </span>
                                                            &nbsp;&nbsp;
                                                            <span class="lecture-name " data-video-title="{{$element->topicTitle}}" data-topic-video-url="{{$element->topic_url}}">
                                                               {{$element->topicTitle}}
                                                            </span>
                                                         </span>
                                                         <span class="bookmark">
                                                         <i class="bookmarkicon flagCls {{ $element->flagCls }}" data-topic-id="{{$element->topic_id}}"data-element-id="{{$element->id}}" data-course-id="{{$element->course_id}}" data-type="{{$element->type}}"></i>
                                                         </span>
                                                      </div>
                                                   </a>
                                                </li>
                                             @endforeach
                                          </ul>
                                       </div>
                                    </div>
                                 </div> 
                                 @endforeach
                                @else
                                  <h5 class="text-center">לא נמצא נושא נוסף בקורס זה</h5>
                                @endif                           
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
      <div id="" class="tab-pane fade">
         
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
                                    <li><a href="javascript:void(0)" class="icon-datetime"><span class="ti-time"></span> <span class="countertimer2">EXPIRED</span></a></li>
                                    <li>
                                       <a href="javascript:void(0)" class="btn-join btn"><img class="ml-10" height="24px" src="https://dev.indiit.solutions/researching_dev/public/assets/img/zoomicon.png"> תקריב </a>
                                       <a href="#phonemodal" data-toggle="modal" class="btn-theme btn btn-md">לְהִצְטַרֵף</a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-5 p0">
                           <div class="blog_grid_post ">
                              <div class="thumb">
                                 <img class="img-fluid w100" src="https://dev.indiit.solutions/researching_dev/public/assets/img/event/2.jpg" alt="el2.jpg">
                                 <div class="post_date">
                                    <h2>29</h2>
                                    <span>December</span>
                                 </div>
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
                                    <li><a href="javascript:void(0)" class="icon-datetime"><span class="ti-time"></span> <span class="countertimer2">EXPIRED</span></a></li>
                                    <li>
                                       <a href="javascript:void(0)" class="btn-join btn"><img class="ml-10" height="24px" src="https://dev.indiit.solutions/researching_dev/public/assets/img/zoomicon.png"> תקריב </a>
                                       <a href="#phonemodal" data-toggle="modal" class="btn-theme btn btn-md">לְהִצְטַרֵף</a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-5 p0">
                           <div class="blog_grid_post ">
                              <div class="thumb">
                                 <img class="img-fluid w100" src="https://dev.indiit.solutions/researching_dev/public/assets/img/event/3.jpg" alt="el2.jpg">
                                 <div class="post_date">
                                    <h2>29</h2>
                                    <span>December</span>
                                 </div>
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
                                    <li><a href="javascript:void(0)" class="icon-datetime"><span class="ti-time"></span> <span class="countertimer2">EXPIRED</span></a></li>
                                    <li>
                                       <a href="javascript:void(0)" class="btn-join btn"><img class="ml-10" height="24px" src="https://dev.indiit.solutions/researching_dev/public/assets/img/zoomicon.png"> תקריב </a>
                                       <a href="#phonemodal" data-toggle="modal" class="btn-theme btn btn-md">לְהִצְטַרֵף</a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-5 p0">
                           <div class="blog_grid_post ">
                              <div class="thumb">
                                 <img class="img-fluid w100" src="https://dev.indiit.solutions/researching_dev/public/assets/img/event/1.jpg" alt="el2.jpg">
                                 <div class="post_date">
                                    <h2>29</h2>
                                    <span>December</span>
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
      <div id="tab4" class="tab-pane fade">
         <div class="user-recommended-area default-padding-sm " style="direction: rtl;">
            <div class="container">
               <div class="row">
                  <div class="col-md-12" id="signup">
                     <div class="form-wraper">
                        <h3>המלצת משתמשים </h3>
                        <form method="POST" action="https://dev.indiit.solutions/researching_dev/public/add_recommend" id="add_recommend_form">
                           <input type="hidden" name="_token" value="hz4m0Cf8YRYcThPAZXerAcp4s82aQbC7DBlqrWys">                        <input type="hidden" name="user_id" id="user_id" value="22">
                           <input type="hidden" name="course_id" id="course_id" value="30">
                           <div class="form-group">
                              <div class="site-heading text-center">
                                 <p> לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקס הדמה הסטנדרטי בתעשייה. </p>
                                 <h3>
                                    תיאור
                                 </h3>
                                 <textarea id="recommendation" name="recommendation" type="text" rows="4" placeholder="תיאור " class="form-control"></textarea>
                                 <div class="form-group">
                                    <h3 class="mb-0"><b>
                                       המלצות אחרות
                                       </b>
                                    </h3>
                                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                       <!-- Indicators -->
                                       <ol class="carousel-indicators mb-20">
                                          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                          <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                                       </ol>
                                       <!-- Wrapper for slides -->
                                       <div class="carousel-inner">
                                          <div class="item active">
                                             <div class="reviewcont reviewbox">
                                                <div class="recommendcont">
                                                   <div class="recommendinner">
                                                      <span class="quotetop"><i class="fa fa-quote-right"></i></span>
                                                      <p><span class="recommendations">לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקס הדמה הסטנדרטי בתעשייה.</span></p>
                                                      <span class="quotebottom"><i class="fa fa-quote-left"></i></span>
                                                   </div>
                                                   <div class="recommendimg"><img src="https://dev.indiit.solutions/researching_dev/public/assets/img/advisor/course_tutor_1.jpg"></div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="item">
                                             <div class="reviewcont reviewbox">
                                                <div class="recommendcont">
                                                   <div class="recommendinner">
                                                      <span class="quotetop"><i class="fa fa-quote-right"></i></span>  
                                                      <p><span class="recommendations">לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקס הדמה הסטנדרטי בתעשייה.</span></p>
                                                      <span class="quotebottom"><i class="fa fa-quote-left"></i></span>
                                                   </div>
                                                   <div class="recommendimg"><img src="https://dev.indiit.solutions/researching_dev/public/assets/img/advisor/course_tutor_2.jpg"></div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <button id="addrecommend" class="log-btn form-btn">שלח המלצה </button>
                                 </div>                               
                              </div>
                           </div>
                        </form>
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
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
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
                     <li class="btn-radio">אני מעוניין לדווח על תקלה טכנית בקורס</li>
                     <li class="btn-radio">אני מעוניין לעדכן בשינויים שקרו בקורס</li>
                     <li class="btn-radio">אני מעוניין להאריך את תוקף הקורס</li>
                     <!--li  class="btn-radio">אני מעוניין לשלוח מייל על נושא שאינו מופיע לעיל</li-->
                     <li class="btn-radio btn-other-subject">אחר</li>
                  </ul>
               </div>
               <div class="chatform" style="display:none;">
                  <div class="form-wraper">
                     <form method="POST" class="mt-0" id="upload_course_chats" action="https://dev.indiit.solutions/researching_dev/public/chatbox" enctype="multipart/form-data">
                        <div class="row">
                           <div class="col-xs-9">
                              <div class="form-group">
                                 <input type="text" class="allsubjects form-control" name="title" value="אני מעוניין לדווח על תקלה טכנית בקורס" readonly="">
                                 <input type="text" placeholder="" class="othersubject form-control" style="display:none;">
                              </div>
                           </div>
                           <div class="col-xs-3">
                              <div class="form-group">
                                 <button class="btn btn-backward"><i class="fa fa-arrow-right"></i></button>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <textarea type="text" name="body" rows="4" placeholder="גוּף " class="form-control"></textarea>
                        </div>
                        <div class="form-group uploadfiles">
                           <label for="uploadfile">
                              <i class="fa fa-upload"></i> 
                              <p id="image_title">גרור או שחרר קבצים לכאן</p>
                           </label>
                           <input type="file" id="uploadfile" name="uploadfile" style="display:none">
                        </div>
                        <div class="form-group mb-0 text-center">
                           <button type="submit" id="course_chat_btn" class="btn btn-theme btn-md ">לשלוח הודעה</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <a href="#" class="fixed-msg-icon btn btn-theme btn-md">תמיכה <img style="width:auto" height="24px" src="https://dev.indiit.solutions/researching_dev/public/assets/img/tools.png"></a>
         <!--- Chat Box Ends--->
         <!-- End Footer -->
      </div>
   </div>
</main>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/videre.js') }}"></script>
<script src="https://embed.videodelivery.net/embed/sdk.latest.js"></script>
<script type="text/javascript">
   $(document).on('click', '.flagCls', function(){
      if($(this).hasClass("far")){
         $(this).addClass("fa");
         $(this).removeClass("far");
      }else{
         $(this).removeClass("fa");
         $(this).addClass("far");
      }
      var topic_id = $(this).data('topicId');
      var element_id = $(this).data('element-id');
      var element_type = $(this).data('type');
      var course_id = $(this).data('course-id');

      if (element_type == 'pdf') {
         element_type = 1;
      } else if (element_type == 'video') {
         element_type = 2;
      } else if (element_type == 'quiz') {
         element_type = 3;
      }
      $.ajax({
         url: '{{ route("front.topicElementRepeat") }}',
         type: 'POST',
         data:{topic_id:topic_id,element_id:element_id,element_type:element_type,course_id:course_id},
         dataType:'JSON',
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(response) {
             console.log(response.status);
         },
      });
   });

   function arrayBufferToBase64Url(buffer) {
     return btoa(String.fromCharCode(...new Uint8Array(buffer)))
       .replace(/=/g, '')
       .replace(/\+/g, '-')
       .replace(/\//g, '_')
   }

   function objectToBase64url(payload) {
     return arrayBufferToBase64Url(
       new TextEncoder().encode(JSON.stringify(payload)),
     )
   }

   $(document).on('click', '.elementClass', function(){
      $('.videoLoader').removeClass('hide-video-loader');
      let topic_video_url = $(this).data('topic-video-url');
      let topic_video_title = $(this).data('video-title');
      // let element_id = $(this).data('element-id');
      // var refresh = window.location.protocol + "//" + window.location.host + window.location.pathname + '?element-video='+element_id;    
      // window.history.pushState({ path: refresh }, '', refresh);
      $.ajax({
         url: '{{ route("front.get_video_url") }}',
         type: 'POST',
         data:{topic_video_url:topic_video_url},
         dataType:'JSON',
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(data) {
             // $(".se-pre-con").hide();
            var jwk_key = data.jwk_key;
            var key_ID = data.key_ID;
            var videoId = data.videoId;
            var ip = data.ip;

            const jwkKey = jwk_key;
            const keyID = key_ID;
            const videoID = videoId;
            // expiresTimeInS is the expired time in second of the video
            const expiresTimeInS = 3600
            streamSignedUrl();

            // Main function
            async function streamSignedUrl () {
              const encoder = new TextEncoder()
              const expiresIn = Math.floor(Date.now() / 1000) + expiresTimeInS
              const headers = {
                "alg": "RS256",
                "kid": keyID
              }
              const data = {
                "sub": videoID,
                "kid": keyID,
                "exp": expiresIn,
                "accessRules": [
                  {
                  "type": "ip.src",
                  "ip": [ip],
                  "action": "allow",
                   },
                  {
                    "type": "any",
                    "action": "block"
                  }
                ]
              }

              const token = `${objectToBase64url(headers)}.${objectToBase64url(data)}`
              const jwk = JSON.parse(atob(jwkKey))
              const key = await crypto.subtle.importKey(
                "jwk", jwk,
                {
                  name: 'RSASSA-PKCS1-v1_5',
                  hash: 'SHA-256',
                },
                false, [ "sign" ]
              )
              const signature = await crypto.subtle.sign(
                { name: 'RSASSA-PKCS1-v1_5' }, key,
                encoder.encode(token)
              )
              $('.mycourseinfo .videotitle').html(topic_video_title);
              const signedToken = `${token}.${arrayBufferToBase64Url(signature)}`
              $('.videoLoader').addClass('hide-video-loader');
              jQuery('#player').html("<iframe src='https://iframe.videodelivery.net/"+signedToken+"'  id='stream-player'></iframe>");
              return signedToken
            }
            init_vid_player(topic_video_url,topic_video_title,vid_width);
         },
      });
   });

   $(document).on("click",".topicElementCls",function(){
         var course_id = $(this).attr('course_id');
         var topic_id = $(this).attr('topic_id');
         var element_id = $(this).attr('element_id');
         var element_type = $(this).attr('element_type');
         if (element_type == 'pdf') {
            element_type = 1;
         } else if (element_type == 'video') {
            element_type = 2;
         } else if (element_type == 'quiz') {
            element_type = 3;
         }
         $.ajax({
            url: '{{ route("front.last_watched_topic_element") }}',
            type: 'POST',
            data:{
               topic_id:topic_id,
               element_id:element_id,
               element_type:element_type,
               course_id:course_id
            },
            dataType:'JSON',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // console.log(response);
            },
        });
    });

   $(document).on("click",".topicElementCls",function(){
      var course_id = $(this).attr('course_id');
      var topic_id = $(this).attr('topic_id');
      var element_id = $(this).attr('element_id');
      var element_type = $(this).attr('element_type');
      if (element_type == 'pdf') {
         element_type = 1;
      } else if (element_type == 'video') {
         element_type = 2;
      } else if (element_type == 'quiz') {
         element_type = 3;
      }
      var href = $(this).parents("a").attr("href1");
      $.ajax({
         url: '{{ route("front.user_progress") }}',
         type: 'POST',
         data:{
           topic_id:topic_id,
           element_id:element_id,
           element_type:element_type,
           course_id:course_id
         },
         dataType:'JSON',
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(response) {
             // if(element_type == 1 && response.status == '1'){
             //     window.open(href,'_blank');
             // }
         },
      });
   });
</script>
@endsection