@extends('layouts.app')
@section('title', ' אינדקס ')
@section('content')
<style>
   form.qz-search-form div.categories-select, .whatsapp-search div.categories-select {
  position: absolute;
  top: 110%;
  left: 0;
  width: 100%;
  max-height: 310px;
  border-radius: 20px;
      padding: 10px;
  -webkit-box-shadow: 0 21px 30px 0 rgba(59, 59, 59, 0.5);
          box-shadow: 0 21px 30px 0 rgba(59, 59, 59, 0.5);
  background-color: #ffffffdb;
  -webkit-transform: translateY(20px);
          transform: translateY(20px);
  z-index: -1;
  opacity: 0;
  visibility: hidden;
  -webkit-transition: opacity 0.15s ease, -webkit-transform 0.15s ease;
  transition: opacity 0.15s ease, -webkit-transform 0.15s ease;
  transition: transform 0.15s ease, opacity 0.15s ease;
  transition: transform 0.15s ease, opacity 0.15s ease, -webkit-transform 0.15s ease;
}
   form.qz-search-form div.categories-select ul, .whatsapp-search div.categories-select ul {
	   
	       max-height: 290px;
    overflow-y: auto;
   }

form.qz-search-form div.categories-select.open, .whatsapp-search div.categories-select.open{
  z-index: 99;
  -webkit-transform: translateY(0);
          transform: translateY(0);
  opacity: 1;
  visibility:visible;
}

form.qz-search-form div.categories-select ul, .whatsapp-search div.categories-select ul {
  padding: 0;
  margin: 0;
}

form.qz-search-form div.categories-select ul li, .whatsapp-search div.categories-select ul li{
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  min-height: 40px;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  padding: 2px 12px;
  color: #000;
  cursor: pointer;
  justify-content: flex-end;
  text-align: right;
}

form.qz-search-form div.categories-select ul li a, .whatsapp-search div.categories-select ul li a{
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-flow: column;
          flex-flow: column;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  width: 100%;
  height: 100%;
  text-decoration: none;
  color: #000;
  padding: 10px 0;
  line-height: 1.4;
}

form.qz-search-form div.categories-select ul li a strong, .whatsapp-search div.categories-select ul li a strong{
  font-weight: 400;
  font-size: 16px;
}

form.qz-search-form div.categories-select ul li a small, .whatsapp-search div.categories-select ul li a small{
  font-weight: 400;
  font-size: 13px;
  color: #777;
}

form.qz-search-form div.categories-select ul li:hover, .whatsapp-search div.categories-select ul li:hover{
  background-color: #ebebeb;
}

div.search-terms {
  float: right;
  width: 89%;
  height: 80px;
  font-size: 17px;
  opacity: 0.86;
  border-radius: 0 7px 7px 0;
  /* -webkit-box-shadow: 0 7px 23px 0 rgba(173, 173, 173, 0.5);
  box-shadow: 0 7px 23px 0 rgba(173, 173, 173, 0.5); */
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
      -ms-flex-direction: row;
          flex-direction: row;
}

div.search-terms div.search-badges {
  border-top-right-radius: 7px;
  border-bottom-right-radius: 7px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
   -ms-flex-direction: row;
   flex-direction: row-reverse;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
}

div.search-terms div.search-badges span.badge {
  width: auto;
  padding: 6px 13px;
  border-radius: 3rem;
  background-color: #ea861e;;
  text-align: center;
  color: #fff;
  font-weight: normal;
  margin: 2px 2px 2px 2px;
  display: -webkit-box;
  display: -ms-flexbox;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
      -ms-flex-direction: row;
          flex-direction: row;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
}

div.search-terms div.search-badges span.badge .close-badge {
  position: relative;
  top: -1px;
  margin-left: 5px;
  color: #fff;
  cursor: pointer;
}

form.qz-search-form, .whatsapp-search {
  position: relative;
}
form.qz-search-form input[type="text"], .whatsapp-search input[type="text"] {
  padding: 10px 20px 10px 10px;
  font-size: 19px;
  opacity: 0.86;
  border-radius: 0 7px 7px 0;
  border: 0;
  width: 100%;
  height: 80px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  cursor: pointer;
  color: #000;
  outline: none;
}

#homebanner .carousel-inner {
    background-repeat: no-repeat;
    background-size: cover;
}

#homebanner a.btn-banner {
    padding: 29px 12px;
	font-weight: 600;
}

#private_university_chosen , #marathon_university_chosen {
    border: 2px solid #ddd;
    border-radius: 50px;
}

#private_university_chosen ul.chosen-choices , #marathon_university_chosen ul.chosen-choices {
    border: 0 !important;
}

#private_university_chosen ul.chosen-results li.active-result , #marathon_university_chosen ul.chosen-results li.active-result{
    display: flex !important;
    min-height: 40px;
    align-items: center;
    padding: 2px 12px !important;
    color: #000;
    cursor: pointer !important;
    justify-content: flex-end;
    font-family: 'Varela Round', sans-serif;
    text-transform: uppercase;
    font-weight: 600;
}

#private_university_chosen  .chosen-choices li.search-choice , #marathon_university_chosen  .chosen-choices li.search-choice {
    padding: 6px 26px 6px 10px;
    margin: 13px 5px 14px 0;
}

#private_university_chosen .chosen-choices li.search-choice .search-choice-close , #marathon_university_chosen .chosen-choices li.search-choice .search-choice-close {
    top: 7px;
}


#private_university_chosen .chosen-drop , #marathon_university_chosen .chosen-drop {
    position: absolute;
    top: 110%;
    z-index: 1010;
    width: 100%;
    border: 1px solid #aaa;
    background: #fff;
    -webkit-box-shadow: 0 21px 30px 0 rgb(59 59 59 / 50%);
    padding: 10px;
    border-radius: 12px;
    box-shadow: 0 21px 30px 0 rgb(59 59 59 / 50%);
}
#private_university_chosen ul.chosen-results li.result-selected , #marathon_university_chosen ul.chosen-results li.result-selected {
    text-align: right;
}

.whatsapp-search div.categories-select ul {
    direction: ltr;
}

.whatsapp-search .search-terms {
    border: 2px solid #ddd;
    border-radius: 50px !important;
    height: 50px !important;
    width: 100% !important;
    overflow: hidden;
    flex-direction: row-reverse;
}

.whatsapp-search input[type="text"] {
    height: 45px;
}

.whatsapp-search .search-badges span.close-badge {
    float: right;
    margin-left: 3px;
}
a.btn.btn-join.whatsapp-join-btn {
    height: 50px;
    line-height: 38px;
    padding: 5px 25px;
    min-width: 145px;
}
#marathon_university_chosen ul.chosen-choices {
	padding: 0 20px;
}
html[lang="en"] .popular-courses-area.weekly-top-items.tag-lists:before {
    height: 120px;
    top: -25px;
}
.whatsapp-search {
    position: relative;
    width: 100%;
}
</style>
<!-- Start Banner -->
<div class="banner-area home-baner" id="homebanner">
        
   <div id="bootcarousel" class="carousel text-light top-pad text-dark slide animate_text" data-ride="carousel">
      <!-- Wrapper for slides -->
      <div class="carousel-inner carousel-zoom" style="background-image: url({{ asset('/assets/images/'.$homepage->banner_background)}});">
         <!-- <div class="item active bg-cover" style="background-image: url({{ asset('/assets/img/bannerslide.jpg')}});"> -->
         <div class="item active bg-cover">
            <div class="box-table">
               <div class="box-cell ">
                  <div class="container-fluid">
                     <div class="row">
                        <div class="col-md-6 hidden-xs hidden-sm mobile_view_img">
                           <div class="content-wrap">
                              <div class="bannergirl2 text-center">
                                 <img src="{{ asset('/assets/images/'.$homepage->banner_mobile_image) }}">
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 text-right mobilebg" style="float: right;background-image: url({{ asset('/assets/img/mbimg.png')}});">
                           <div class="content dekcontent">
                              @php 
                              $banner_text = json_decode($homepage->banner_text,true);
                              @endphp 
                              <h2 class="wow fadeInRight" data-wow-duration="1.8s"> {{ $banner_text['title1'] }} <span class="textorange">{{ $banner_text['title2'] }}</span><br>
                                 {{ $banner_text['title3'] }}
                                 <span class="curvehead"> {{ $banner_text['title4'] }} </span>
                              </h2>
                              <!--p data-animation="animated slideInLeft"> לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה </p--->
                              <div class="slider-below-sup-wrap search-content">
                                 <div class="col-md-12">
                                    <div class="boxequal">
                                       <form action="#" class="qz-search-form">
                                          <div class="row">
                                             <div class="col-md-8 col-sm-8 col-xs-12 or1">
                                                <div class="input-wraper">
                                                   <span class="icon-wrapper"> 
                                                   <span><i class="ti-search"></i>
                                                   <img src="{{ asset('/assets/img/loader.gif') }}"  id="loading-image" alt="Loading..." />
                                                   </span>
                                                   </span>
                                                   <div class="search-terms">
                                                      <input type="text" class="text-right" placeholder="בחר אוניברסיטה ...">
                                                      <div class="search-badges">
                                                         
                                                      </div>
                                                  </div>                                                  
                                                </div>
                                                <div class="categories-select">
                                                   <ul></ul>
                                               </div>
                                             </div>
                                             <div class="col-md-4 col-sm-4 col-xs-12 or2" id = 'get_course_detail'>
                                                <a href="#videoModal" data-toggle="modal" class="btn-banner searchbtn-glow mbshow">
                                                   איך מתחילים? <img src="{{ asset('/assets/img/palybt.png') }}">
                                                </a>
                                             </div>
                                          </div>
                                       </form>                                       
                                       {{-- <form action="#">
                                          <?php 
                                             $university_data = DB::table('universities')->get();
                                             ?>
                                          <div class="row">
                                             <div class="col-md-8 col-sm-8 col-xs-12 or1">
                                                <div class="input-wraper">
                                                   <span class="icon-wrapper"> 
                                                   <span><i class="ti-search"></i>
                                                   <img src="{{ asset('/assets/img/loader.gif') }}"  id="loading-image" alt="Loading..." />
                                                   </span>
                                                   </span>
                                                   <!--select id = "universities1" name = "universities1"class="form-control  chosen-select " data-placeholder=" בחר מוסד לימודים " multiple>
                                                      @foreach($university_data as $university)
                                                      <option data-id = "{{ $university->id}}" data-type = "0" value="{{ $university->university_name }}">{{ $university->university_name }}</option> 
                                                      @endforeach  
                                                      </select--> 
                                                   <select id="universities1" class="search-multi" data-placeholder=" בחר מוסד לימודים" name = "universities1" multiple="multiple">
                                                      @foreach($university_data as $university)
                                                      <option data-id = "{{ $university->id}}" data-type = "0" value="{{ $university->university_name }}">{{ $university->university_name }}</option>
                                                      @endforeach
                                                   </select>
                                                   <span id = 'degree_text' style ="display:none; ">
                                                   בחר חוג / תואר
                                                   </span>
                                                </div>
                                             </div>
                                             <div class="col-md-4 col-sm-4 col-xs-12 or2" id = 'get_course_detail'>
                                                <!-- <a href="{{route('front.courses')}}" class="btn-banner searchbtn-glow mbshow">
                                                   איך מתחילים? <img src="{{ asset('/assets/img/palybt.png') }}">
                                                </a> -->

                                                <a href="#videoModal" data-toggle="modal" class="btn-banner searchbtn-glow mbshow">
                                                   איך מתחילים? <img src="{{ asset('/assets/img/palybt.png') }}">
                                                </a>
                                             </div>
                                          </div>
                                       </form> --}}
                                       <!--p style="margin-bottom: 0;">* החיפוש כולל מורים למוסיקה ומאמנים אישיים.</p-->
                                    </div>
                                 </div>
                                 <div class="col-md-12 p-0">
                                    @php 
                                    $banner_list = json_decode($homepage->banner_list,true);
                                    @endphp 
                                    <ul class="icon_listBaner">
                                       <li>
                                          <div class="icon_listinner" id="icon_listinner1">
                                             <p>
                                                {{$banner_list[0]['title']}}
                                             </p>
                                             <img src="{{ asset('/assets/img/icon12.png') }}">
                                             <div class="tooltiptext" id="tooltiptext1">
                                                {{$banner_list[0]['text']}}
                                             </div>
                                          </div>
                                       </li>
                                       <li>
                                          <div class="icon_listinner" id="icon_listinner2">
                                             <p>
                                                {{$banner_list[1]['title']}}
                                             </p>
                                             <img src="{{ asset('/assets/img/icon11.png') }}">
                                             <div class="tooltiptext" id="tooltiptext2">
                                                {{$banner_list[1]['text']}}
                                             </div>
                                          </div>
                                       </li>
                                       <li>
                                          <div class="icon_listinner" id="icon_listinner3">
                                             <p>{{$banner_list[2]['title']}}</p>
                                             <img src="{{ asset('/assets/img/icon-11.png') }}">
                                             <div class="tooltiptext" id="tooltiptext3">
                                                {{$banner_list[2]['text']}}
                                             </div>
                                          </div>
                                       </li>
                                       <li>
                                          <div class="icon_listinner" id="icon_listinner4">
                                             <p>
                                                {{$banner_list[3]['title']}}
                                             </p>
                                             <img src="{{ asset('/assets/img/save-icon.png') }}">
                                             <div class="tooltiptext" id="tooltiptext4">
                                                {{$banner_list[3]['text']}}
                                             </div>
                                          </div>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                              <!-- <a data-animation="animated slideInUp" class="btn btn-theme effect btn-md" href="#">צפו בקורסים</a> -->
                           </div>
                        </div>
                        <div class="col-md-6 hidden-xs hidden-sm">
                           <div class="content-wrap">
                              <div class="bannergirl text-center">
                                 <img src="{{ asset('/assets/images/'.$homepage->banner_image) }}">
                              </div>
                              <div class="socialbanner">
                                 <a href="{{ $homepage->banner_insta }}" target="_blank" class="bannericon bannerinstagram"><img src="{{ asset('/assets/img/instagram.png') }}"/></a>
                                 <a href="{{ $homepage->banner_facebook }}" target="_blank" class="bannericon bannerfacebook"><img src="{{ asset('/assets/img/facebook1.png') }}"/></a>
                                 <a href="https://web.whatsapp.com/send?phone={{ $homepage->banner_whatsapp }}&text&app_absent=0" target="_blank" class="bannericon bannerwhatsapp"><img src="{{ asset('/assets/img/whatsapp.png') }}"/></a>
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
<!-- End Banner -->
<div class="features-area default-padding bottom-less pb-0 sidebar-sec bg-gray"style="direction:rtl">
   <div class="container">
      <div class="row wow fadeInRight" data-wow-duration="1.8s">
         <div class="col-md-12">
            <div class="row">
               <div class="site-heading text-center">
                  <div class="col-md-8 col-md-offset-2">
                     <h2>{{ $homepage->service_title }}</h2>
                     <p> {{ $homepage->service_desc }}  </p>
                  </div>
               </div>
            </div>
            <div class="features">
               <div class="equal-height col-md-3 col-sm-6 col-lg-20 ">
                  <div class="item mariner">
                     <a href="{{route('front.Blogs')}}">
                        <div class="infoicon">
                           <h4>מסלול למידה עצמאית</h4>
                           <div class="icon"> <span> <img src="{{ asset('/assets/img/icon/open-book.png') }}"></span></div>
                        </div>
                        <div class="info">
                           <p> האתר מציע מאמרים במגוון נושאים בסטטיסטיקה ושיטות מחקר בהם תוכל להסתייע כדי להצליח</p>
                        </div>
                     </a>
                  </div>
               </div>
               <div class="equal-height col-md-3 col-sm-6 col-lg-20 ">
                  <div class="item casablanca">
                     <a href="#bookModal2" data-toggle="modal">
                        <div class="infoicon">
                           <h4>שיעור פרטי מותאם לקורס שלך</h4>
                           <div class="icon">  <span><img src="{{ asset('/assets/img/icon/simulation.png') }}"></span></div>
                        </div>
                        <div class="info">
                           <p> האתר מסייע בחיפוש מורה פרטי שמלמד את חומרי הקורס שלך ונבחר כמתאים ביותר עבורך </p>
                        </div>
                     </a>
                  </div>
               </div>
               <!-- <div class="equal-height col-md-3 col-sm-6 col-lg-20 ">
                  <div class="item mariner">
                     <a href="#bookModal" data-toggle="modal">
                        <div class="infoicon">
                           <h4>סימולציה מותאמת לקורס שלך</h4>
                           <div class="icon">  <span> <img src="{{ asset('/assets/img/icon/editing.png') }}"></span> </div>
                        </div>
                        <div class="info">
                           <p> האתר מציע מערך סימולציות המותאמות לחומרי הלימוד שלך בהתאם לאופן שבו המרצה שלך מלמד</p>
                        </div>
                     </a>
                  </div>
               </div> -->
               <div class="equal-height col-md-3 col-sm-6 col-lg-20 ">
                  <div class="item mariner">
                     <a href="#marathonModal" data-toggle="modal">
                        <div class="infoicon">
                           <h4>מצא את מסלולי המרתון שלך</h4>
                           <div class="icon">  <span> <img src="{{ asset('/assets/img/icon/editing.png') }}"></span> </div>
                        </div>
                        <div class="info">
                           <p>האתר מציע מסלולי מרתון עבורכם אשר מיועדים לתוצאות מקסימליות.</p>
                        </div>
                     </a>
                  </div>
               </div>
               <div class="equal-height col-md-3 col-sm-6 col-lg-20 ">
                  <div class="item malachite">
                     <a href="#whtsapp" class="js-anchor-link">
                        <div class="infoicon">
                           <h4>קבוצת למידה בוואצאפ</h4>
                           <div class="icon">  <span><img src="{{ asset('/assets/img/icon/whatsapp.png') }}"></span> </div>
                        </div>
                        <div class="info">
                           <p> האתר מאפשר לך להצטרף לקבוצת וואצאפ עם סטודנטים ממוסדות שונים וחומרים זהים </p>
                        </div>
                     </a>
                  </div>
               </div>
               <div class="equal-height col-md-3 col-sm-6 col-lg-20 ">
                  <div class="item casablanca ">
                     <a href="#homebanner" class="js-anchor-link">
                        <div class="infoicon">
                           <h4>קורסים מותאמים אישית</h4>
                           <div class="icon"> <span><img src="{{ asset('/assets/img/icon/book.png') }}"></span> </div>
                        </div>
                        <div class="info">
                           <p> האתר מציע קורסים אשר הותאמו במיוחד למוסד הלימודים והתואר שלך, בדיוק כפי שהמרצה שלך מלמד </p>
                        </div>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="curvedown">
   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 140">
      <path fill="#f7f7f7" fill-opacity="1" d="M0,64L60,64C120,64,240,64,360,74.7C480,85,600,107,720,112C840,117,960,107,1080,90.7C1200,75,1320,53,1380,42.7L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path>
   </svg>
</div>
<!-- End Features -->
<!-- Start About 
   ============================================= -->
<div class="about-area toppad"  id="whtsapp"  style="direction: rtl;">
   <div class="container">
       
      <div class="row">
         <div class="about-items ">
            @php 
            $success_data = json_decode($homepage->success, true);
            @endphp 
            <div class="col-md-6 about-info wow fadeInLeft ">
               <h2> {{ $success_data['title'] }} {{-- <span> {{ $success_data['tagline'] }} </span> --}}</h2>
               <blockquote> 
                  {{ $success_data['text1'] }}
               </blockquote>
               <p> 
                  {{ $success_data['text2'] }}
               </p>
               <div class="inmbabout">
						<div class="row">
							  <div class="col-md-4 or2m">
								 <a class="btn circle btn-theme effect btn-md btn-lt-ht" href="#videoModal" data-toggle="modal">איך זה עובד</a> 
							  </div>
							  <div class="col-md-8 aboutsearch or1m">
									 <div class="form-group">
										<div class="input-group whatsapp-search">
										   <div class="input-wraper ">
											  <div class="search-terms">
												 <input type="text" placeholder="בחר אוניברסיטה ...">
												 <div class="search-badges">
													
												 </div>
											 </div>                                                  
										   </div>
										   <div class="categories-select"> 
											  <ul></ul>
										  </div>                           
										   {{-- <input type="text" name="" placeholder="לחפש.." class="form-control">  --}}
										   {{-- <select id="universities1" class="search-multi" data-placeholder=" בחר מוסד לימודים" name = "universities1" multiple="multiple">
											  @foreach($university_data as $university)
											  <option data-id = "{{ $university->id}}" data-type = "0" value="{{ $university->university_name }}">{{ $university->university_name }}</option>
											  @endforeach
										   </select>                            --}}
										</div>
									 </div>
									 <div class="wa_group">
									 </div>
									 <div class="wa-response">

									 </div>
								
									
								  </div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<a href="" class="btn btn-join disabled whatsapp-join-btn" id="whatsappJoinBtn" style="display: none;">
									 הצטרף
									 </a>
							</div>
							<div class="col-md-8">	 
									<div class="form-group checkout-form border-0 p-0 mt-0">
										<span class="checkbox-wrap">
										<label class="container mb-0">
										<input value="1" type="checkbox" id="termAndConditions">
										<span class="checkmark"></span>
										<a href="javascript:void(0);"> אני מסכים עם כל תנאי השימוש</a>
										</label>
										</span>
									 </div>
							</div>
						</div>
                 
               
                  <div class="col-md-4 or2m"></div>
               </div>
            </div>
            <div class="col-md-6 thumb ">
               <div class="thumb aboutimg">
                  <img class="aboutbg" src="{{ asset('/assets/images/'.$success_data['bg_image']) }}"/>
                  <img alt="Thumb" src="{{ asset('/assets/images/'.$success_data['front_image']) }}"/>
                  <!-- <a href="https://www.youtube.com/watch?v=DKz_EEoJRs4" class="popup-youtube light video-play-button">
                     <i class="fa fa-play"></i>
                     </a> -->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- End About -->
<!-- Start Popular Courses
   ============================================= -->
<div class="popular-courses-area default-padding weekly-top-items   tag-lists" style="background-image: url({{ asset('/assets/img/bannerpattern2.png')}});">
   <div class="container">
      <div class="row">
         <div class="site-heading text-center">
            <div class="col-md-8 col-md-offset-2 headtt">
               <h2> {{ $homepage->course_title }}
               </h2>
               <p> 
                  {{ $homepage->course_description }}
               </p>
            </div>
         </div>
      </div>
      <div class="row">
         @if($universities)
            @foreach($universities as $university)
               <div class="col-md-4">
                  <div class="on-hover_show widget tight fixcontent">
                     <div class="acc-panel-like shadow main-panel panelBox">
                        
                        <span class="badge"><img src="{{ asset('/assets/images') }}/{{ $university->logo }}"/></span>
                        <span class="panel-title">{{  Str::limit($university->university_name,50) }}</span> 
                        <div class="hover-dropdown">
                        @if($university->degrees)
                           @foreach($university->degrees as $degree)
                              <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                 <div class="panel panel-default">
                                    <div class="panel-heading acc-panel-like shadow" role="tab" id="heading{{ $degree->degree_name }}">
                                       <h4 class="panel-title">
                                          <a role="button" href="{{Route('front.showDegree',['id'=> $degree->id])}}">
                                          {{ $degree->degree_name }} </a>
                                          <span class="plus-minus-icon" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $university->id }}{{ $degree->id }}" aria-expanded="true" aria-controls="collapse{{ $university->id }}{{ $degree->id }}">
                                          <i class="fa fa-plus colfa"></i>
                                          <i class="fa fa-minus colfa" style="display: none"></i>
                                          </span>
                                       </h4>
                                    </div>
                                    <div id="collapse{{ $university->id }}{{ $degree->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $university->id }}{{ $degree->id }}">
                                       <div class="panel-body">
                                          @php 
                                          $all_courses = DB::table('courses')->where('degree_id',$degree->id)->where('university_id', $university->id)->get();
                                          @endphp
                                          @if(count($all_courses) > 0)
                                             @foreach($all_courses as $course)
                                             <div class="acc-panel-like shadow"> <a class="panel-title" href="{{route('front.course.show',['id' => $course->course_id])}}">{{ $course->course_name }}</a>  </div>
                                             @endforeach
                                          @else
                                          <div class="acc-panel-like shadow"> <a class="panel-title" href="javascript:void(0)">לא נמצא קורס!</a> </div>
                                          @endif
                                       </div>
                                    </div>
                                 </div>
                              </div> 
                           @endforeach
                        @endif
                        </div>
                     </div>
                  </div>
               </div>               
            @endforeach
         @endif         
      </div>
   </div>
</div>
<!-- End Popular Courses -->
<div class="revirew_tab-section advisor-details-area" style="background-image: url({{ asset('/assets/img/banner/banner19.jpg')}}); ">
   <div class="container">
      <div class="row advisor-info">
         <div class="col-md-12 content">
            <div class="site-heading text-center">
               <div class="col-md-12">
                  <h2 class="text-white"> סטודנטים ממליצים</h2>
               </div>
            </div>
            <!-- Star Tab Info -->
            <div class="tab-info">
               <div class="content campus-carousel owl-carousel owl-theme pl-0">
                  <div class="item website-review">
                     <div class="userimg">
                        <img src="{{ asset('assets/img/advisor/1.jpg') }}">
                        <h3>פאול דרבואה</h3>
                        <h5>מנהל</h5>
                     </div>
                     <p> לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז שנות ה 1500-, כאשר מדפסת לא ידועה לקחה מטה מסוג וסיבב אותו בכדי </p>
                  </div>
                  <div class="item website-review">
                     <div class="userimg">
                        <img src="{{ asset('assets/img/advisor/2.jpg') }}">
                        <h3>פאול דרבואה</h3>
                        <h5>מנהל</h5>
                     </div>
                     <p> לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז שנות ה 1500-, כאשר מדפסת לא ידועה לקחה מטה מסוג וסיבב אותו בכדי </p>
                  </div>
                  <div class="item website-review">
                     <div class="userimg">
                        <img src="{{ asset('assets/img/advisor/3.jpg') }}">
                        <h3>פאול דרבואה</h3>
                        <h5>מנהל</h5>
                     </div>
                     <p> לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז שנות ה 1500-, כאשר מדפסת לא ידועה לקחה מטה מסוג וסיבב אותו בכדי </p>
                  </div>
                  <div class="item website-review">
                     <div class="userimg">
                        <img src="{{ asset('assets/img/advisor/4.jpg') }}">
                        <h3>פאול דרבואה</h3>
                        <h5>מנהל</h5>
                     </div>
                     <p> לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז שנות ה 1500-, כאשר מדפסת לא ידועה לקחה מטה מסוג וסיבב אותו בכדי </p>
                  </div>
                  <div class="item website-review">
                     <div class="userimg">
                        <img src="{{ asset('assets/img/advisor/1.jpg') }}">
                        <h3>פאול דרבואה</h3>
                        <h5>מנהל</h5>
                     </div>
                     <p> לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז שנות ה 1500-, כאשר מדפסת לא ידועה לקחה מטה מסוג וסיבב אותו בכדי </p>
                  </div>
               </div>
            </div>
            <!-- End Tab Info -->
         </div>
      </div>
   </div>
</div>

<div class="socialreviews  default-padding  bottom-less bg-gray">
   <div class="container">
      <div class="row advisor-info">
         <div class="col-md-12 content">
            <div class="site-heading text-center">
               <div class="col-md-12">
                  <h2 class=""> המלצות ברשת</h2>
               </div>
            </div>
            <!-- <div class="tab-info">
               <div class="content tab-carousel owl-carousel owl-theme pl-0">-->
                   <!--*********************************-->
            <div class="tab-info">
               <div class="content tab-carousel owl-carousel owl-theme pl-0">
                        <?php
                           if(count($online_recommendation) > 0){
                            $image2 = '';
                            $username2 = '';
                            foreach($online_recommendation as $key=>$val){
                                $user_data2 = DB::table('users')->where('id',$val['user_id'])->get();
                                foreach ($user_data2 as $data2) {
                                    $image2 =  asset('/assets/users/' .$data2->avatar);
                                    $username2 = $data2->first_name . $data2->last_name;
                                }
                        ?>
                          <div class="item">
                             <div class="row">
                                <div class="col-lg-9 col-md-9 col-sm-9">
                                   <div class="reviewcont">
                                      <span class="quotetop"><i class="fa fa-quote-right"></i></span>
                                      <p><?php  if(!empty($val['description'])){ echo $val['description'];}  ?></p>
                                      <img src="{{ asset('/assets/img/') }}<?php  if(!empty($val['user_image'])){ echo '/'.$val['user_image'];}  ?>"/>
                                      <span class="quotebottom"><i class="fa fa-quote-left"></i></span>
                                   </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                   <div class="userimg">
                                      <img src="{{ $image2 }}">
                                      <h3>{{ $username2 }}</h3>
                                      <h5><?php  if(!empty($val['recommed_tag_line'])){  echo $val['recommed_tag_line']; }  ?></h5>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <?php
                           }
                           }
                        ?>
               </div>
            </div>
            <!--***************************************************************-->
                   
                   
                  <!--<div class="item">
                     <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-9">
                           <div class="reviewcont">
                              <span class="quotetop"><i class="fa fa-quote-right"></i></span>
                              <p> לורם איפסום הוא פשוטדמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז שנות ה 1500-, כאשר מדפסת לא ידועה לקחה מטה מסוג וסיבב אותו בכדי . לורם איפסום הוא פשוטדמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז שנות ה 1500-, כאשר מדפסת לא ידועה לקחה מטה מסוג וסיבב אותו בכדי  </p>
                              <img src="{{ asset('/assets/img/fb.png') }}"/>
                              <span class="quotebottom"><i class="fa fa-quote-left"></i></span>
                           </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                           <div class="userimg">
                              <img src="{{ asset('/assets/img/advisor/4.jpg') }}">
                              <h3>פבלו נאפ</h3>
                              <h5>אדם חשוב, חברה כלשהי</h5>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="item">
                     <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-9">
                           <div class="reviewcont">
                              <span class="quotetop"><i class="fa fa-quote-right"></i></span>
                              <p> לורם איפסום הוא פשוטדמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז שנות ה 1500-, כאשר מדפסת לא ידועה לקחה מטה מסוג וסיבב אותו בכדי . לורם איפסום הוא פשוטדמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז שנות ה 1500-, כאשר מדפסת לא ידועה לקחה מטה מסוג וסיבב אותו בכדי  </p>
                              <img src="{{ asset('/assets/img/google-logo.png') }}"/>
                              <span class="quotebottom"><i class="fa fa-quote-left"></i></span>
                           </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                           <div class="userimg">
                              <img src="{{ asset('/assets/img/advisor/3.jpg') }}">
                              <h3>פבלו נאפ</h3>
                              <h5>אדם חשוב, חברה כלשהי</h5>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="item">
                     <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-9">
                           <div class="reviewcont">
                              <span class="quotetop"><i class="fa fa-quote-right"></i></span>
                              <p> לורם איפסום הוא פשוטדמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז שנות ה 1500-, כאשר מדפסת לא ידועה לקחה מטה מסוג וסיבב אותו בכדי . לורם איפסום הוא פשוטדמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז שנות ה 1500-, כאשר מדפסת לא ידועה לקחה מטה מסוג וסיבב אותו בכדי  </p>
                              <img src="{{ asset('/assets/img/fb.png') }}"/>
                              <span class="quotebottom"><i class="fa fa-quote-left"></i></span>
                           </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                           <div class="userimg">
                              <img src="{{ asset('/assets/img/advisor/2.jpg') }}">
                              <h3>פבלו נאפ</h3>
                              <h5>אדם חשוב, חברה כלשהי</h5>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>-->
            
            
            
         </div>
      </div>
   </div>
</div>
<!-- Start Fun Factor 
   ============================================= -->
@if(isset($homepage->funfactor) && $homepage->funfactor == 1)
<div class="fun-factor-area shadow default-padding bottom-less text-center bg-fixed  dark-hard" style="">
   <div class="container">
      <div class="row">
         <div class="col-md-12 col-sm-12 ">
            <div class="row wow fadeInLeft">
               <div class="col-md-3 col-sm-6 item">
                  <div class="fun-fact">
                     <div class="icon"> <i class="fas fa-award"></i> </div>
                     <div class="info"> <span class="timer" data-to="212" data-speed="5000"></span> <span class="medium">קופונים שנרכשו</span> </div>
                  </div>
               </div>
               <div class="col-md-3 col-sm-6 item">
                  <div class="fun-fact">
                     <div class="icon"> <i class="fas fa-user-shield"></i> </div>
                     <div class="info"> <span class="timer" data-to="128" data-speed="5000"></span> <span class="medium">מבקרים</span> </div>
                  </div>
               </div>
               <div class="col-md-3 col-sm-6 item">
                  <div class="fun-fact">
                     <div class="icon"> <i class="fas fa-users"></i> </div>
                     <div class="info"> <span class="timer" data-to="8970" data-speed="5000"></span> <span class="medium">תלמידים נרשמו</span> </div>
                  </div>
               </div>
               <div class="col-md-3 col-sm-6 item">
                  <div class="fun-fact">
                     <div class="icon"> <i class="fas fa-book-open"></i> </div>
                     <div class="info"> <span class="timer" data-to="640" data-speed="5000"></span> <span class="medium">קורסים</span> </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div> 
@endif
<!-- End Fun Factor -->
@endsection
@section('footer')
<!-- Chat Box Start-->
<div class="chat-popup" id="myForm" style="display:none">
   <h1 class="chaticon">תיבת צ'אט</h1>
   <div class="chatbody">
      <div class="chatoptions">
         <label for="rdo-1" class="btn-radio">
            <input type="radio" id="rdo-1" name="radio-grp">
            <svg width="30px" height="30px" viewBox="0 0 20 20">
               <circle cx="10" cy="10" r="9"></circle>
               <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
            </svg>
            <span class="checkmark">א  </span>
            אני מעוניין לדווח על תקלה טכנית בקורס
         </label>
         <label for="rdo-2" class="btn-radio">
            <input type="radio" id="rdo-2" name="radio-grp">
            <svg width="30px" height="30px" viewBox="0 0 20 20">
               <circle cx="10" cy="10" r="9"></circle>
               <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
            </svg>
            <span class="checkmark">ב </span>
            אני מעוניין לעדכן בשינויים שקרו בקורס
         </label>
         <label for="rdo-3" class="btn-radio">
            <input type="radio" id="rdo-3" name="radio-grp">
            <svg width="30px" height="30px" viewBox="0 0 20 20">
               <circle cx="10" cy="10" r="9"></circle>
               <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
            </svg>
            <span class="checkmark">ג  </span>
            אני מעוניין להאריך את תוקף הקורס
         </label>
         <label for="rdo-4" class="btn-radio">
            <input type="radio" id="rdo-4" name="radio-grp">
            <svg width="30px" height="30px" viewBox="0 0 20 20">
               <circle cx="10" cy="10" r="9"></circle>
               <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
            </svg>
            <span class="checkmark">ד  </span>
            אני מעוניין לשלוח מייל על נושא שאינו מופיע לעיל
         </label>
      </div>
      <div class="chatform" style="display:none;">
         <div class="form-wraper">
            <form>
               <div class="form-group">
                  <textarea type="text" rows="4" placeholder="הוֹדָעָה " class="form-control"></textarea>
               </div>
               <div class="form-group uploadfiles">
                  <label for="uploadfile">
                     <i class="fa fa-upload"></i>
                     <p>גרור או שחרר קבצים לכאן</p>
                  </label>
                  <input type="file" id="uploadfile" name="uploadfile" style="display:none">
               </div>
               <button type="submit" class="btn btn-theme btn-md ">לשלוח הודעה</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
@section('extra')
<div class="modal loginModal modal-video fade" id="videoModal">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header border-bottom-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
         </div>
         <!-- Modal body -->
         <div class="modal-body video-box">
            <div class="video-section">
               <iframe width="100%" height="315" src="https://www.youtube.com/embed/DKz_EEoJRs4?controls=0&autoplay=1&mute=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
         </div>
      </div>
   </div>
</div>
{{-- <div class="modal privatelesson-md fade bookModal" id="bookModal">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header border-bottom-0">
            <h4 class="modal-title"><span><img src="{{ asset('/assets/img/icon/editing.png') }}"></span> סימולציה מותאמת לקורס שלך - חינם!</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
         </div>
         <!-- Modal body -->
         <div class="modal-body  p-30" id="signup">
            <div class="form-wraper w-100 br-all-none p-0">
               <p class="subtitle">בשירות זה ניתן לבחור את הקורס שאתה מעוניין לבצע בו סימולציה. הסימולציות באתר מותאמות לחומרי הלימוד הנלמדים בכל קורס בהתאם לאופן שבו המרצה שלך מלמד. הסימולציה תהיה נגישה לך לתרגול והערכת יכולותיך, נקודות הקושי והחוזקות שלך בחומרים ותלווה בפתרונות וידאו מלאים לתרגילים השונים. המערכת תשמור את השלב שבו סיימת בפרופיל שלך באתר ותוכל לחזור ולמלא אותה בכל עת שתבחר כדי להתכונן באופן הטוב ביותר לבחינה.</p>
               <div class="stepwizard" style="direction:rtl">
                  <div class="stepwizard-row">
                     <div class="stepwizard-step">
                        <a class="btn btn-default btn-circle active-step disabled" href="#step-1" data-toggle="tab" onclick="stepnext(1)" >1</a>
                        <p> חיפוש</p>
                     </div>
                     <div class="stepwizard-step">
                        <a class="btn btn-default btn-circle" disabled="disabled" href="#step-2" data-toggle="tab">2</a>
                        <p>הרשמה</p>
                     </div>
                     <div class="stepwizard-step">
                        <a class="btn btn-default btn-circle" disabled="disabled" href="#step-3" data-toggle="tab">3</a>
                        <p>אישור</p>
                     </div>
                  </div>
                  <div class="tab-content">
                     <div class="tab-pane  active " id="step-1" >
                        <?php 
                           $university_data = DB::table('universities')->get();
                           ?>
                        <div class="form-group">
                           <select id = "simulation_university" name = "simulation_university"class="form-control  chosen-select" data-placeholder="לחפש " multiple>
                              @foreach($university_data as $university)
                              <option data-id = "{{ $university->id}}" data-type = "0" value="{{ $university->university_name }}">{{ $university->university_name }}</option>
                              @endforeach  
                           </select>
                        </div>
                        @if (Auth::check())
                        <button onclick="stepnext(3);" class="btn btn-theme btn-md btn-lt-ht mt-20 get_detail disabled">הַבָּא</button>
                        @else
                        <button onclick="stepnext(2);" class="btn btn-theme btn-md btn-lt-ht mt-20 get_detail disabled">הַבָּא</button>
                        @endif
                     </div>
                     <div class="tab-pane  loginModal " id="step-2" >
                        <ul class="nav nav-pills" style="display: flex;">
                           <li class="active ">
                              <a data-toggle="tab" href="#login" aria-expanded="true">
                              התחברות
                              </a>
                           </li>
                           <li>
                              <a data-toggle="tab" href="#signup11" aria-expanded="false">הירשם</a>
                           </li>
                        </ul>
                        <div class="tab-content tab-content-info" style="direction: rtl;">
                           <!-- Single Tab -->
                           <div id="login" class="tab-pane fade active in">
                              <div class="form-wraper">
                                 <h3 class="mb-0">התחבר לחשבונך </h3>
                                 <div class="alert alert-danger print-loginerror-msg" style="display:none">
                                    <ul></ul>
                                 </div>
                                 <form class="mt-4" method="POST">
                                    @csrf
                                    <div class="form-group">
                                       <input id="simulation_email" type="text" class="form-control @error('simulation_email') is-invalid @enderror" name="simulation_email" placeholder="שם משתמש או דוא " value="{{ old('email') }}"autocomplete="simulation_email" autofocus multiple>
                                       @error('simulation_email')
                                       <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                       </span>
                                       @enderror
                                    </div>
                                    <div class="form-group">
                                       <input id="simulation_password" type="password" class="form-control @error('simulation_password') is-invalid @enderror" name="simulation_password" required autocomplete="current-password"  placeholder="סיסמה ">
                                       @error('simulation_password')
                                       <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                       </span>
                                       @enderror  
                                    </div>
                                    <div class="form-group checkout-form border-0 p-0 mt-0">
                                    </div>
                                    <div class="form-group">
                                       <button id = "simulation_login" type="submit" class="log-btn form-btn">התחברות </button>
                                    </div>
                                    <div class="form-group"> <span class="or-txt">
                                       <span class="line-span"></span> <span>אוֹ </span> <span class="line-span"></span> </span>
                                    </div>
                                    <div class="form-group">
                                       <button onclick ="location.href ='{{ route('front.facebooklogin') }}'" type="button" class ="form-btn" style="background:#4267b2;font-weight: normal;"><i class="ti-facebook"></i>התחבר עם פייסבוק</button>
                                    </div>
                                    <div class="form-group">
                                       <button onclick ="location.href ='{{ route('front.googlelogin') }}'" type="button" class="form-btn" style="background:#db3236;font-weight: normal;"><i class="fab fa-google" aria-hidden="true"></i>התחבר עם גוגל </button>
                                    </div>
                                    <div class="form-group mb-0">
                                    </div>
                                 </form>
                              </div>
                           </div>
                           <div id="signup11" class="tab-pane fade">
                              <div class="form-wraper">
                                 <h3 class="mb-0">הירשם לחשבונך </h3>
                                 <div class="alert alert-danger print-error-msgnew" style="display:none">
                                    <ul></ul>
                                 </div>
                                 <form method="POST" >
                                    @csrf
                                    <div class="form-group">
                                       <input id="simulation_first_name" type="text" class="form-control @error('simulation_first_name') is-invalid @enderror" name="simulation_first_name" placeholder="שם פרטי " value="{{ old('simulation_first_name') }}" required autocomplete="simulation_first_name" autofocus>
                                       @error('simulation_first_name')
                                       <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                       </span>
                                       @enderror
                                    </div>
                                    <div class="form-group">
                                       <input id="simulation_last_name" type="text" class="form-control @error('simulation_last_name') is-invalid @enderror" name="simulation_last_name" placeholder="שם משפחה " value="{{ old('simulation_last_name') }}" required autocomplete="simulation_last_name" autofocus>
                                       @error('simulation_last_name')
                                       <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                       </span>
                                       @enderror
                                    </div>
                                    <div class="form-group">
                                       <input id="simulation_signup_email" type="email" class="form-control @error('simulation_signup_email') is-invalid @enderror" name="simulation_signup_email"  placeholder="כתובת דוא " value="{{ old('simulation_signup_email') }}" required autocomplete="simulation_signup_email" multiple>
                                       @error('simulation_signup_email')
                                       <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                       </span>
                                       @enderror
                                    </div>
                                    <div class="form-group">
                                       <input id="simulation_signup_password" type="simulation_signup_password" class="form-control @error('simulation_signup_password') is-invalid @enderror" placeholder="סיסמה "  name="simulation_signup_password" required>
                                       @error('simulation_signup_password')
                                       <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                       </span>
                                       @enderror
                                    </div>
                                    <?php 
                                       $university_data = DB::table('universities')->get();
                                       ?>
                                    <div class="form-group">
                                       <select id="simulation_signup_university" name="simulation_signup_university" class="form-control" data-placeholder="שם האוניברסיטה או המכללה " required="required" >
                                          <option value = "">שם האוניברסיטה או המכללה</option>
                                          @foreach($university_data as $university)
                                          <option value="{{ $university->id }}">{{ $university->university_name }}</option>
                                          @endforeach               
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <select id = "simulation_signup_degree" name = "simulation_signup_degree" data-placeholder=" בחר חוג / תואר  " class="form-control" required="required"  >
                                          <option value="">וֹאַר </option>
                                       </select>
                                    </div>
                                    <div class="form-group checkout-form border-0 p-0 mt-0">
                                       <span class="checkbox-wrap d-block">
                                       <label class="container w-100 mb-0">כדי להירשם אצלנו אנא סמן כדי להסכים ל   <a href="#" class="terms-text">תנאים והגבלות </a>
                                       <input id = "simulation_terms" type="checkbox" name="simulation_terms" value="">
                                       <span class="checkmark"></span>
                                       </label>
                                       </span>
                                    </div>
                                    <div class="form-group">
                                       <button id = "simulation_signup" type="submit" class="log-btn form-btn">הירשם </button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <button type="submit" onclick="stepnext(3);" class="btn btn-theme btn-md btn-lt-ht mt-20">הַבָּא</button>
                     </div>
                     <div class="tab-pane   text-center" id="step-3" > 
                        <a  href="{{route('front.simulation')}}"class="btn btn-theme btn-md btn-lt-ht mt-20 mb-40">לחץ כאן כדי להתחיל את הסימולציה שלך</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div> --}}
<div class="modal privatelesson-md marathonModal fade" id="marathonModal">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header border-bottom-0">
              <h4 class="modal-title"><span><img src="{{ asset('/assets/img/icon/simulation.png') }}"></span> מצא את מסלולי המרתון שלך </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
         </div>
         <!-- Modal body -->
         <div class="modal-body  p-30" id="signup">
            <div class="form-wraper w-100 br-all-none p-0">
               <form class="mt-0">
                  <p class="subtitle">בשירות זה תוכלו לבחור את הקורס אותו אתם מחפשים קורס מרתון. המערכת תעזור לכם למצוא מסלול מרתון שמיועד לתוצאות מקסימליות ונבחר כמתאים ביותר עבורכם.</p>
                  <?php 
                     $university_data = DB::table('universities')->get();
                     ?>
                  <div class="form-group">
                     <select id = "marathon_university" name = "marathon_university"class="form-control  chosen-select" data-placeholder="חפש מורה פרטי בשבילך" multiple>
                        @foreach($university_data as $university)
                        <option data-id = "{{ $university->id}}" data-type = "0" value="{{ $university->university_name }}">{{ $university->university_name }}</option>
                        @endforeach  
                     </select>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal privatelesson-md bookModal fade" id="bookModal2">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header border-bottom-0">
            <h4 class="modal-title"><span><img src="{{ asset('/assets/img/icon/simulation.png') }}"></span>  שיעור פרטי מותאם לקורס שלך</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
         </div>
         <!-- Modal body -->
         <div class="modal-body  p-30" id="signup">
            <div class="form-wraper w-100 br-all-none p-0">
               <form class="mt-0">
                  <p class="subtitle">בשירות זה ניתן לבחור את הקורס שאתה מעוניין לחפש עבורו מורה פרטי. המערכת תסייע לך למצוא מורה פרטי שמלמד את חומרי הקורס ונבחר כמתאים ביותר עבורך.</p>
                  <?php 
                     $university_data = DB::table('universities')->get();
                     ?>
                  <div class="form-group">
                     <select id = "private_university" name = "private_university"class="form-control  chosen-select" data-placeholder="לחפש " multiple>
                        @foreach($university_data as $university)
                        <option data-id = "{{ $university->id}}" data-type = "0" value="{{ $university->university_name }}">{{ $university->university_name }}</option>
                        @endforeach  
                     </select>
                  </div>
                  <div id = 'get_instructor_detail'>
                     <a class="btn btn-theme btn-md btn-lt-ht mt-20 disabled">מצוא מדריך</a>
                  </div>
                  <!-- <button type="submit" class="btn btn-theme btn-md btn-lt-ht mt-20">למצוא מדריך</button> -->
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">

  $(document).on('click', '#termAndConditions', function(){
    if ($(this).val() == 1) {
      $('#whatsappJoinBtn').css("display", "block");
      $(this).val(0);
    } else {
      $('#whatsappJoinBtn').css("display", "none");
      $(this).val(1);
    }
  });

   $('#simulation_terms').change(function() { 
          if ($('#simulation_terms').is(":checked") == true) { 
            $('#simulation_terms').val('1'); 
          } else { 
            $('#simulation_terms').val(''); 
          } 
        });
        $('#simulation_signup_university').change(function(){
           var university_id = $(this).val();
           $.ajax({
            url: '{{ route('front.getdegree') }}',
            type: 'POST',
            data: {
                university_id: university_id
            },
            success: function(data) {
              $('#simulation_signup_degree').html('');
                $.each(data.degree_data, function(i, d) {
                    $('#simulation_signup_degree').append('<option value="' + d.id + '">' + d.degree_name + '</option>');
                });
              }
          });
   
        });
         $("#simulation_signup").click(function(e) {
        e.preventDefault();
        var first_name = $("input[name='simulation_first_name']").val();
        var last_name = $("input[name='simulation_last_name']").val();
        var email1 = $("input[name='simulation_signup_email']").val();
        var password1 = $("input[name='simulation_signup_password']").val();
        var university = $('#simulation_signup_university').val();
        var degree = $('#simulation_signup_degree').val();
        var terms = $("input[name='simulation_terms']").val();
        $.ajax({
            url: '{{ route('front.signup') }}',
            type: 'POST',
            data: {
                first_name:first_name,
                last_name:last_name,
                email1: email1,
                password1: password1,
                university:university,
                degree:degree,
                terms:terms
            },
            success: function(data) {
              if ($.isEmptyObject(data.error)) {
                   stepnext(3);
              } else {
                  printErrorMsgnew(data.error);
              }
            }
        });
    });
   
    function printErrorMsgnew (msg) {
      $(".print-error-msgnew").find("ul").html('');
      $(".print-error-msgnew").css('display','block');
      $.each( msg, function( key, value ) {
        $(".print-error-msgnew").find("ul").append('<li>'+value+'</li>');
      });
    }
      $("#simulation_login").click(function(e) {
          e.preventDefault();
          var email = $("input[name='simulation_email']").val();
          var password = $("input[name='simulation_password']").val();
          $.ajax({
            url: '{{ route('front.loginpage') }}',
            type: 'POST',
            data: {
                email: email,
                password: password
            },
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                   stepnext(3);
                } else {
                    printErrorMsg1(data.error);
                }
              }
          });
        });
   
      function printErrorMsg1 (msg) {
        $(".print-loginerror-msg").find("ul").html('');
        $(".print-loginerror-msg").css('display','block');
        $.each( msg, function( key, value ) {
        $(".print-loginerror-msg").find("ul").append('<li>'+value+'</li>');
        });
      }
   $('#universities1').change(function(e){
      var baseurl = window.location.origin+window.location.pathname;
      var university = [];
      var type = 0;
      $(this).find('option:selected').each(function(){
         university.push({university_name:$(this).val(),university_id:$(this).data('id'),type:$(this).data('type')});
         type = $(this).data('type');
   
         }); 
           $.ajax({
            url: '{{ route("front.get_degree") }}',
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
                  var url = baseurl + "search_courses/" + degrees_list + "/" + selected_type;
                  var link = $("<a>");
                  link.attr("href", url);
                  link.text(" איך מתחילים? ");
                  link.addClass("btn-banner searchbtn-glow");
                  $("#get_course_detail").html(link);
                  $("#universities1").chosen("destroy");
               $('#universities1').html('');
               document.getElementById("degree_text").setAttribute("style"," text-align:center;line-height: normal;display:block;color:white;font-size:14px;padding: 14px 5px;");
               $('#universities1').html(data.html);
               $('#universities1').chosen();
               }
               if(data.courses.length != 0){
                  document.getElementById("degree_text").setAttribute("style","display:none;");
                  $('#degree_text').text(' בחר קורס ');
                  var degrees_list = data.courses;
                  var selected_type = data.type;
                  var url = baseurl + "search_courses/" + degrees_list + "/" + selected_type;
                  var link = $("<a>");
                  link.attr("href", url);
                  link.text(" איך מתחילים? ");
                  link.addClass("btn-banner searchbtn-glow");
                  $("#get_course_detail").html(link);
                  $("#universities1").chosen("destroy");
               $('#universities1').html('');
               document.getElementById("degree_text").setAttribute("style","text-align:center;line-height: normal;display:block;color:white;font-size:14px;padding: 14px 5px;");
               $('#universities1').html(data.html);
               $('#universities1').chosen();
               }
               if(data.course_id != ''){
                  var course_id = data.course_id;
                  var course_name = data.course_name;
                  var selected_type = data.type;
                  // show your loading image
                   document.getElementById("degree_text").setAttribute("style","display:none;");
                  document.getElementById("loading-image").setAttribute("style","display:block");
                  var countdown = 30000;  // your countdown in milliseconds
                  setTimeout(function() {
                  // hide your loading image after "countdown" milliseconds
                  document.getElementById("loading-image").setAttribute("style","display:none");
                  }, countdown);
                  var url =  baseurl + "courses/show/" + course_id;
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

   $('#private_university').change(function(){
      var baseurl = window.location.origin+window.location.pathname;
      var university1 = [];
      var type1 = 0;
      $(this).find('option:selected').each(function(){
         university1.push({university_name:$(this).val(),university_id:$(this).data('id'),type:$(this).data('type')});
         type1 = $(this).data('type');
   
         }); 
           $.ajax({
            url: '{{ route('front.get_private_degree') }}',
            type: 'POST',
            dataType: 'json',
            data: {
                university: university1,
                type:type1
            },
            success: function(data) {
               if(data.degrees.length != 0){
                  var degrees_list = data.degrees;
                  var selected_type = data.type;
                  
                  $("#private_university").chosen("destroy");
                  $('#private_university').html('');
                  $('#private_university').html(data.html);
                  $('#private_university').chosen();
               
               }
               if(data.courses.length != 0){
                  var degrees_list = data.courses;
                  var selected_type = data.type;
                  $("#private_university").chosen("destroy");
                  $('#private_university').html('');
                  $('#private_university').html(data.html);
                  $('#private_university').chosen();
               }
               if(data.instructor_id != ''){
                  var instructor_id = data.instructor_id;
                  var selected_type = data.type;
                  var url = baseurl + "instructor-details";
                  var link = $("<a>");
                  link.attr("href", url);
                  link.text(" למצוא מדריך  ");
                  link.addClass("btn btn-theme btn-md btn-lt-ht mt-20");
                  $("#get_instructor_detail").html(link);
   
               }
               if(data.selected_universities.length != 0){
                   $("#private_university").chosen("destroy");
                   $('#private_university').html('');
                   $('#private_university').html(data.html);
                   $('#private_university').chosen();
                }              
                // $('#private_university_chosen').addClass('chosen-with-drop chosen-container-active');
              }
          });
        
        });
   
   $('#simulation_university').change(function(){
      var baseurl = window.location.origin+window.location.pathname;
      var university2 = [];
      var type2 = 0;
      $(this).find('option:selected').each(function(){
         university2.push({university_name:$(this).val(),university_id:$(this).data('id'),type:$(this).data('type')});
         type2 = $(this).data('type');
   
         }); 
           $.ajax({
            url: '{{ route('front.get_simulation_degree') }}',
            type: 'POST',
            dataType: 'json',
            data: {
                university: university2,
                type:type2
            },
            success: function(data) {
                
               if(data.degrees.length != 0){
                  var degrees_list = data.degrees;
                  var selected_type = data.type;
                  
                  $("#simulation_university").chosen("destroy");
                  $('#simulation_university').html('');
                  $('#simulation_university').html(data.html);
                  $('#simulation_university').chosen();
               
               }
               if(data.courses.length != 0){
                  var degrees_list = data.courses;
                  var selected_type = data.type;
                  $("#simulation_university").chosen("destroy");
                  $('#simulation_university').html('');
                  $('#simulation_university').html(data.html);
                  $('#simulation_university').chosen();
               }
               if(data.course_id != '' != 0){
                  var course_id = data.course_id;
                  var course_name = data.course_name;
                  var selected_type = data.type;
                  $(".get_detail").removeClass("disabled");
                  $("#simulation_university").chosen("destroy");
                  $('#simulation_university').html('');
                  $('#simulation_university').html(data.html);
                  $('#simulation_university').chosen();
               }
               if(data.selected_universities.length != 0){
                   $("#simulation_university").chosen("destroy");
                   $('#simulation_university').html('');
                   $('#simulation_university').html(data.html);
                   $('#simulation_university').chosen();
                }
              }
          });
        
        });


   $('#marathon_university').change(function(e){
      $('.marathon_university').prop('disabled',true);
      var baseurl = window.location.origin+window.location.pathname;
      var university1 = [];
      var type1 = 0;
      var is_university = [];
      $(this).find('option:selected').each(function(){
         is_university.push($(this).data('type'));
         university1.push({university_name:$(this).val(),university_id:$(this).data('id'),type:$(this).data('type')});
         type1 = $(this).data('type');

      }); 
      if(is_university.includes(0) == false){
         var university1 = [];
         var type1 = 0;
      }
      if(type1 == 2){
         e.preventDefault();
         var url = '{{ route("front.marathon.details", [ "id" => ":id" ] ) }}';
         url = url.replace(':id', university1[2].university_id);  
         window.location.href = url;
      }
      $.ajax({
         url: '{{ route('front.get_marathon') }}',
         type: 'POST',
         dataType: 'json',
         data: {
               university: university1,
               type:type1,
         },
         success: function(data) {
               
            if(data.degrees.length != 0){
               var degrees_list = data.degrees;
               var selected_type = data.type;
               
               $("#marathon_university").chosen("destroy");
               $('#marathon_university').html('');
               $('#marathon_university').html(data.html);
               $('#marathon_university').chosen();
            
            }
            if(data.courses.length != 0){
               var degrees_list = data.courses;
               var selected_type = data.type;
               $("#marathon_university").chosen("destroy");
               $('#marathon_university').html('');
               $('#marathon_university').html(data.html);
               $('#marathon_university').chosen();
            }
            if(data.instructor_id != ''){
               var instructor_id = data.instructor_id;
               var selected_type = data.type;
               var url = baseurl + "instructor-details";
               var link = $("<a>");
               link.attr("href", url);
               link.text(" למצוא מדריך  ");
               link.addClass("btn btn-theme btn-md btn-lt-ht mt-20");
               $("#get_instructor_detail").html(link);
            }
            if(data.selected_universities.length != 0){
               $("#marathon_university").chosen("destroy");
               $('#marathon_university').html('');
               $('#marathon_university').html(data.html);
               $('#marathon_university').chosen();
            }
         }
      });
   });       
</script>
<script>
   function stepnext(n){
       if(n != 0){
      
         //$(".stepwizard-row a").switchClass('btn-primary','btn-default');
           // $(".stepwizard-row a").removeClass('btn-primary');
           $(".stepwizard-row a").addClass('btn-default');
         $('.stepwizard a[href="#step-'+n+'"]').tab('show');
           $('.stepwizard-row a[href="#step-'+n+'"]').removeClass('btn-default');
           $('.stepwizard-row a[href="#step-'+n+'"]').addClass('btn-primary');
            if(n>1){
            if(n==3){
               $('.stepwizard-row a[href="#step-'+(n-1)+'"]').removeClass('btn-default');
               $('.stepwizard a[href="#step-'+n+'"]').tab('show');
               $('.stepwizard-row a[href="#step-'+(n-1)+'"]').addClass('btn-primary');
               $('.stepwizard-row a[href="#step-'+(n-2)+'"]').removeClass('btn-default');
               $('.stepwizard-row a[href="#step-'+(n-2)+'"]').addClass('btn-primary');
            }
          }
       }
   }
   stepnext(1);
   
   
</script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script>
   window.Yna = window.Yna || {};
   window.Yna.data = @json($data);
   console.log(window.Yna.data);
</script>
<script>
$(document).ready(function() {
   $('.search-multi').select2({
      closeOnSelect: false ,
   });

   $('.aboutsearch input[type=checkbox]').click(function(){
      if(!$(this).is(':checked')){
         $('.aboutsearch .btn-join').addClass('disabled');
      }else{
         $('.aboutsearch .btn-join').removeClass('disabled');
      }
   });   
   
});

$(document).ready(function () {
   
   var homeCategorySelect = $(".qz-search-form div.categories-select");
   var homeCategoryBadges = $(".qz-search-form div.search-badges");
   var homeCategoryList = $(".qz-search-form div.categories-select ul");
   var searchCategoryInput = $("form.qz-search-form .search-terms input[type=text]");   
   
   var homeCategories = {
      selected: [],
      courses:[],
      degrees:[],
      categoryLink: null,
      searchOpen: false,
      data: window.Yna.data,
      addUniversityDrop: function openCategorySelect() {
         
      },
      openCategorySelect: function openCategorySelect() {
         homeCategorySelect.addClass("open");
         homeCategories.searchOpen = true;
         setTimeout(function () {
            homeCategories.searchOpen = false;
         }, 200);
      },
      addCategoryBadge: function addCategoryBadge(term_id,name) {
         if(name == 'university'){
            var title = this.data.find(x => x.id == term_id).university_name;
         }
         else if(name == 'degree'){
            var data = this.degrees.find(x => x.id == term_id);
            var title = data.degree_name;
            this.courses = data.allcourses;
         }
         this.selected.push(term_id);
         this.updateCategories(term_id,name);

         var categoryBadge = $('<span class="badge" data-name="'+name+'" data-cat-id="' + term_id + '" data-idx="' + this.selected.length + '">' + "<span>" + title + "</span>" + '<span class="close-badge">x</span>' + "</span>");

         homeCategoryBadges.append(categoryBadge);
      },
      showDegreeList: function (arr){
         arr.forEach(function (value) {
            var categoryOption = $('<li data-name="degree" data-cat-id="' + value.id + '">' + value.degree_name + "</li>");
            homeCategoryList.append(categoryOption);
         });    
         searchCategoryInput.attr("placeholder", "בחר תואר ...");  
         searchCategoryInput.focus();
      },
      showCourseList: function (){
         this.courses.forEach(function (value) {
            var url = '{{ route("front.mycourse.show", [ "id" => ":id" ] ) }}';
            url = url.replace(':id', value.course_id);        
            var categoryOption = $('<a class="course_link" href="'+url+'"><li data-name="course" data-cat-id="' + value.course_id + '">' + value.course_name + "</li></a>");
            homeCategoryList.append(categoryOption);
         });
         searchCategoryInput.attr("placeholder", "בחר קורס ...");     
         searchCategoryInput.focus();   
      },
      updateCategories: function updateCategories(term_id,name) {
         this.clearCategorySelect();
         if(name == "university"){
            this.degrees = this.data.find(x => x.id == term_id).degrees;
            this.showDegreeList(this.degrees);
         }
         if(name == "degree"){
         this.courses = this.degrees.find(x => x.id == term_id).allcourses;
            if(this.courses.length > 0){	
               this.showCourseList();
            }else{
               homeCategoryList.append('<li class="no-cat">לא נמצאו תוצאות</li>');
            }
         }    
         
         searchCategoryInput.focus();
      },   
      deepFind: function deepFind(arr, id) {
      return arr.reduce(function (result, arrayItem) {
         if (result.length) return result;
         if (arrayItem.term_id === id) return result.concat([arrayItem]);

         return arrayItem.children.length ? homeCategories.deepFind(arrayItem.children, id) : result;
      }, []);
      },
      clearCategorySelect: function clearCategorySelect() {
      homeCategoryList.html("");
      },
      getPlaceholder: function getPlaceholder(level) {
      return "׳‘׳—׳¨ " + Yna.courseCategoryLevels[level] + "....";
      },
      populateCategorySelect: function populateCategorySelect() {
         this.data.forEach(function (value) {
            var categoryOption = $('<li data-name="university" data-cat-id="' + value.id + '">' + value.university_name + "</li>");
            homeCategoryList.append(categoryOption);
         });
         searchCategoryInput.attr("placeholder", "בחר אוניברסיטה ...");
      },   
      revertCategories: function revertCategories(term_id) {
         this.updateCategories(term_id);
         this.openCategorySelect();
      },
   };   

   homeCategories.populateCategorySelect();

   searchCategoryInput.on("focus", function () {
      homeCategories.openCategorySelect();
   });

   $("body").on("click", function (e) {
      var target = $(e.target);
      if (!target.parents("div.categories-select").length && !homeCategories.searchOpen) {
         homeCategorySelect.removeClass("open");
         searchCategoryInput.blur();
      }
   });   

   searchCategoryInput.on("keyup", function () {
      var search = $(this).val();
      var count = 0;
      if (!search.length) {
         $(".qz-search-form div.categories-select li.no-cat").remove();
         $(".qz-search-form div.categories-select li").show();
         return;
      }
      $(".qz-search-form div.categories-select li.no-cat").remove();
      $(".qz-search-form div.categories-select li").hide();

      $(".qz-search-form div.categories-select li").each(function () {
         if ($(this).text().toLowerCase().indexOf(search.toLowerCase()) !== -1) {
            count++;
            $(this).show();
         }
      });
      if (!count) {
         homeCategoryList.append('<li class="no-cat">לא נמצאו תוצאות</li>');
      }
   });


   $(document).on("click", ".qz-search-form div.categories-select li:not(.no-cat)", function (e) {
      e.stopPropagation();
      var catId = parseInt($(this).data("cat-id"));
      var name = $(this).data("name");
      if(name == "course"){
         return;
      }
      // Selected new category, add badge, change place holder
      $(".qz-search-form div.categories-select li.no-cat").remove();
      homeCategories.addCategoryBadge(catId,name);
      searchCategoryInput.val("");
   });   

   $(document).on("click", ".qz-search-form div.search-badges span.badge span.close-badge", function (e) {
      var idx = parseInt($(this).parent().data("idx"));
      var name = $(this).parent().data("name");
      homeCategoryList.html("");
		$(this).parent().nextAll().remove();
		$(this).parent().remove();	  
      if(name == 'university'){
         homeCategoryBadges.html("");
         homeCategories.populateCategorySelect();
      }
      else if(name == 'degree')
      {
         homeCategories.showDegreeList(homeCategories.degrees);
      }
      searchCategoryInput.val("");
      $(".qz-search-form div.categories-select li.no-cat").remove();
   });	


   // Whatsapp Search

   var w_homeCategorySelect = $(".whatsapp-search div.categories-select");
   var w_homeCategoryBadges = $(".whatsapp-search div.search-badges");
   var w_homeCategoryList = $(".whatsapp-search div.categories-select ul");
   var w_searchCategoryInput = $(".whatsapp-search .search-terms input[type=text]");
   
   var w_homeCategories = {
      selected: [],
      courses:[],
      degrees:[],
      categoryLink: null,
      searchOpen: false,
      data: window.Yna.data,
      addUniversityDrop: function openCategorySelect() {
         
      },
      openCategorySelect: function openCategorySelect() {
         w_homeCategorySelect.addClass("open");
         w_homeCategories.searchOpen = true;
         setTimeout(function () {
            w_homeCategories.searchOpen = false;
         }, 200);
      },
      addCategoryBadge: function addCategoryBadge(term_id,name) {
         if(name == 'university'){
            var title = this.data.find(x => x.id == term_id).university_name;
         }
         else if(name == 'degree'){
            var data = this.degrees.find(x => x.id == term_id);
            var title = data.degree_name;
            this.courses = data.allcourses;
         }
         this.selected.push(term_id);
         this.updateCategories(term_id,name);

         var categoryBadge = $('<span class="badge" data-name="'+name+'" data-cat-id="' + term_id + '" data-idx="' + this.selected.length + '">' + '<span class="close-badge">x</span>' + "<span>" + title + "</span>" + "</span>");

         w_homeCategoryBadges.append(categoryBadge);
      },
      showDegreeList: function (arr){
         arr.forEach(function (value) {
            var categoryOption = $('<li data-name="degree" data-cat-id="' + value.id + '">' + value.degree_name + "</li>");
            w_homeCategoryList.append(categoryOption);
         });    
         w_searchCategoryInput.attr("placeholder", "בחר תואר ...");  
         w_searchCategoryInput.focus();
         $('#join-whatsapp-link').val('');
         $('.wa-response').text('');
      },
      showCourseList: function (){
         this.courses.forEach(function (value) {
            var url = '{{ route("front.course.show", [ "id" => ":id" ] ) }}';
            url = url.replace(':id', value.course_id);        
            var categoryOption = $('<li data-name="course" data-cat-id="' + value.course_id + '">' + value.course_name + "</li>");
            w_homeCategoryList.append(categoryOption);
         });
         w_searchCategoryInput.attr("placeholder", "בחר קורס ...");     
         w_searchCategoryInput.focus();   
         $('#join-whatsapp-link').val('');
         $('.wa-response').text('');
      },
      updateCategories: function updateCategories(term_id,name) {
         this.clearCategorySelect();
         if(name == "university"){
            this.degrees = this.data.find(x => x.id == term_id).degrees;
            this.showDegreeList(this.degrees);
         }
         if(name == "degree"){
         this.courses = this.degrees.find(x => x.id == term_id).allcourses;
            if(this.courses.length > 0){	
               this.showCourseList();
            }else{
               w_homeCategoryList.append('<li class="no-cat">לא נמצאו תוצאות</li>');
            }
         }  
         if(name == "course"){
            
         }  
         
         w_searchCategoryInput.focus();
      },   
      deepFind: function deepFind(arr, id) {
      return arr.reduce(function (result, arrayItem) {
         if (result.length) return result;
         if (arrayItem.term_id === id) return result.concat([arrayItem]);

         return arrayItem.children.length ? w_homeCategories.deepFind(arrayItem.children, id) : result;
      }, []);
      },
      clearCategorySelect: function clearCategorySelect() {
      w_homeCategoryList.html("");
      },
      getPlaceholder: function getPlaceholder(level) {
      return "׳‘׳—׳¨ " + Yna.courseCategoryLevels[level] + "....";
      },
      populateCategorySelect: function populateCategorySelect() {
         this.data.forEach(function (value) {
            var categoryOption = $('<li data-name="university" data-cat-id="' + value.id + '">' + value.university_name + "</li>");
            w_homeCategoryList.append(categoryOption);
         });
         w_searchCategoryInput.attr("placeholder", "בחר אוניברסיטה ...");
         $('#join-whatsapp-link').val('');
         $('.wa-response').text('');
      },   
      revertCategories: function revertCategories(term_id) {
         this.updateCategories(term_id);
         this.openCategorySelect();
      },
   }; 
   w_homeCategories.populateCategorySelect();
   w_searchCategoryInput.on("focus", function () {
      w_homeCategories.openCategorySelect();
   });

   $("body").on("click", function (e) {
      var target = $(e.target);
      if (!target.parents("div.categories-select").length && !w_homeCategories.searchOpen) {
         w_homeCategorySelect.removeClass("open");
         w_searchCategoryInput.blur();
      }
   });  

   w_searchCategoryInput.on("keyup", function () {
      var search = $(this).val();
      var count = 0;
      if (!search.length) {
         $(".whatsapp-search div.categories-select li.no-cat").remove();
         $(".whatsapp-search div.categories-select li").show();
         return;
      }
      $(".whatsapp-search div.categories-select li.no-cat").remove();
      $(".whatsapp-search div.categories-select li").hide();

      $(".whatsapp-search div.categories-select li").each(function () {
         if ($(this).text().toLowerCase().indexOf(search.toLowerCase()) !== -1) {
            count++;
            $(this).show();
         }
      });
      if (!count) {
         w_homeCategoryList.append('<li class="no-cat">לא נמצאו תוצאות</li>');
      }
   });

   $(document).on("click", ".whatsapp-search div.categories-select li:not(.no-cat)", function (e) {    
      e.stopPropagation();
      var catId = parseInt($(this).data("cat-id"));
      var name = $(this).data("name");
      $('#join-whatsapp-link').val('');
      $('.wa-response').text('');
      if(name == "course"){
         w_homeCategorySelect.removeClass("open");
         console.log(catId);
         var url = '{{ route("front.getwhatsapp", ["id" => ":id" ]) }}';
         url = url.replace(':id', catId);         
         $.ajax({
            url: url,
            type: 'get',
            success: function(res) {
               data = JSON.parse(res);
               var html= '';
               var selected_whatapp_link ='';
               if(data.length > 0){
                  $.each(data, function(key, value) {
                     var selected = value.link_seleted;
                     console.log(selected);
                     var whatsapp_links = data = JSON.parse(value.whatsappLink);
                     selected_whatapp_link = whatsapp_links[0];
                  });
                  html += '<input type="hidden" id="join-whatsapp-link" value="'+selected_whatapp_link+'">';
                  $('.wa_group').html(html);
                  console.log(html);
                  $('.wa-response').text('Groups found! Click on join button');
               }else{
                  $('.wa-response').text('Sorry No group founds!');
               }
            }
         });         
         return;
      }
      // Selected new category, add badge, change place holder
      $(".whatsapp-search div.categories-select li.no-cat").remove();
      w_homeCategories.addCategoryBadge(catId,name);
      w_searchCategoryInput.val("");
   });   

   $(document).on("click", ".whatsapp-search div.search-badges span.badge span.close-badge", function (e) {
      var idx = parseInt($(this).parent().data("idx"));
      var name = $(this).parent().data("name");
      w_homeCategoryList.html("");
		$(this).parent().nextAll().remove();
		$(this).parent().remove();
      if(name == 'university'){
         w_homeCategoryBadges.html("");
         w_homeCategories.populateCategorySelect();
      }
      else if(name == 'degree')
      {
         w_homeCategories.showDegreeList(w_homeCategories.degrees);
      }
      w_searchCategoryInput.val("");
      $(".whatsapp-search div.categories-select li.no-cat").remove();
   });

   $('.whatsapp-join-btn').click(function(e){
      e.preventDefault();
      var whatsapp = $('#join-whatsapp-link').val();
      //console.log(whatsapp);
      if(whatsapp)
      {
         prefix = 'https://';
         if (whatsapp.substr(0, prefix.length) !== prefix)
         {
            whatsapp = prefix + whatsapp;
         }
         window = window.open(whatsapp, "_blank");
         window.focus();
      }else{
         $('.wa-response').text('Sorry No group founds!');
      }
   });	

});

/****************************/
$("#icon_listinner1").click(function(){
    $('#tooltiptext1').toggle();
  });
$("#icon_listinner2").click(function(){
    $('#tooltiptext2').toggle();
  });
$("#icon_listinner3").click(function(){
    $('#tooltiptext3').toggle();
  });
$("#icon_listinner4").click(function(){
    $('#tooltiptext4').toggle();
  });
/****************************/
</script>

<script>
	$('.js-anchor-link').click(function(e){
	  e.preventDefault();
	  var target = $($(this).attr('href'));
	  if(target.length){
		var scrollTo = target.offset().top;
		$('body, html').animate({scrollTop: scrollTo+'px'}, 1200);
	  }
	});
</script>

@endsection