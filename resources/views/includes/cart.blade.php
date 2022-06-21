@extends('layouts.app')
@section('title', ' עֲגָלָה ')
@section('content')
<style type="text/css">
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
   div#private_university_chosen {
    width: 100% !important;
        direction: ltr;
}
div#private_university_chosen input.chosen-search-input.default {
    padding-right: 15px;
}
</style>
<?php $courses_id = [];?>
<?php $course_type = [];?>
<?php $grand_total = [];?>
<?php $topic_ids = [];?>
<!-- Start Breadcrumb  -->
<div class="banner-inner-area2 pt8"></div>
<div class="breadcrumb-inner-area mb50" style="">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <ul class="breadcrumb">
               <li><a href="#"><i class="fas fa-home"></i> דף הבית</a></li>
               <li><a href="#">עגָלָה </a></li>
            </ul>
         </div>
      </div>
   </div>
</div>
<div class="cart-wizard pb-0">
   <div class="stepwizard" style="direction:rtl">
      <div class="container pos-relative">
         <div class="row">
            <div class="stepwizard-row">
               <div class="stepwizard-step">
                  <a class="btn btn-circle btn-primary active-step" href="#step-1" data-toggle="tab" onclick="stepnext(1)" >1</a>
                  <p>עגלה </p>
               </div>
               @if (Auth::check())
               <div class="stepwizard-step">
                  <a href = "#step-2" class="btn btn-default btn-circle disabled" data-toggle="tab">2</a>
                  <p>הרשמה </p>
               </div>
               @else
               <div class="stepwizard-step">
                  <a class="btn btn-default btn-circle disabled" href="#step-2" data-toggle="tab">2</a>
                  <p>הרשמה </p>
               </div>
               @endif
               <div class="stepwizard-step">
                  <a class="btn btn-default btn-circle disabled" href="#step-3" data-toggle="tab">3</a>
                  <p>תשלום </p>
               </div>
               <div class="stepwizard-step">
                  <a class="btn btn-default btn-circle disabled" href="#step-4" data-toggle="tab">4</a>
                  <p>אישור רכישה </p>
               </div>
            </div>
         </div>
      </div>
      <div class="tab-content">
         <!--- Chat Box Start--->
         <div class="chat-popup" id="myForm" style="display:none">
            <h1 class="chaticon">תיבת צ'אט</h1>
            <div class="chatbody">
               <div class="chatoptions">
                  <ul class="chat-lists">
                     @if (Auth::check())
                     @foreach($ticketData as $ticket_data)
                     <li  class="btn-radio ticket_cls" data-id="{{ $ticket_data->id }}">{{ $ticket_data->subject }}</li>
                     @endforeach
                     @endif
                     <!--<li  class="btn-radio">יש לי תקלה בתהליך הרכישה</li>
                        <li  class="btn-radio">אני מעוניין בחבילת קורסים שלא קיימת</li>
                        <li  class="btn-radio btn-other-subject">אחר</li>-->
                  </ul>
               </div>
               <div class="chatform" style="display:none;">
                  <div class="form-wraper">
                     <!--<form method="POST" class="mt-0" id="upload-chats" action="{{ route('front.chatbox') }}" enctype="multipart/form-data">-->
                     <form method="POST" class="mt-0" id="upload_chats"  enctype="multipart/form-data">
                        <div class="alert alert-success alert-block alertMessage" style="display:none;">
                           <button type="button" class="close" data-dismiss="alert">×</button>
                           <strong>השאילתה שלך נשלחה!  </strong>
                        </div>
                        @csrf
                        <input type="hidden" name="ticket_id" id="ticket_id"  value="">
                        <div class="row">
                           <div class="col-xs-9">
                              <div class="form-group">
                                 <input type="text" name = 'ticket_subjects' id ="ticket_subjects" class="allsubjects form-control" value="יש לי תקלה בתהליך הרכישה" readonly/>
                                 <input type="text"  Placeholder="" class="othersubject form-control" style="display:none;"/>
                              </div>
                           </div>
                           <div class="col-xs-3">
                              <div class="form-group">
                                 <button onclick="return false;" class="btn btn-backward"><i class="fa fa-arrow-right"></i></button>
                              </div>
                           </div>
                        </div>
                        @if (Auth::guest())
                        <div class="form-group">
                           <input id="cahtbox_email" type="email" class="form-control @error('email') is-invalid @enderror" name="cahtbox_email"  placeholder="כתובת דוא " value="{{ old('email') }}" required autocomplete="email" multiple>
                        </div>
                        @endif
                        <div class="form-group">
                           <textarea type="text" name="ticket_message" id="ticket_message" rows="4" placeholder="גוּף " class="form-control"></textarea>
                        </div>
                        <div class="alert alert-danger" id ="upload_chat_error" style="display:none">
                           <ul></ul>
                        </div>
                        <!--<div class="form-group uploadfiles">
                           <label for="uploadfile">
                              <i class="fa fa-upload"></i> 
                              <p id="image_title"> אנא בחר בקובץ  </p>
                           </label>
                           <input type="file" id="uploadfile" name="uploadfile" style="display:none">
                           </div>-->
                        <div class="form-group mb-0 text-center">
                           <button type="submit" id = "upload_chat_btn"class="btn btn-theme btn-md ">לשלוח הודעה</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         @if (Auth::check())
         <a href="#" id = "support_button" class="fixed-msg-icon btn btn-theme btn-md">תמיכה <img style="width:auto" height="24px" src="{{ asset('/assets/img/tools.png') }}"/></a>
         @else
         @endif
         <!--- Chat Box Ends--->
         <div class="tab-pane  active  pb-70" id="step-1" >
            <div class="container">
               <div class="row">
                  <div class="col-md-7">
                     <form class="cart-table">
                        <?php $total = 0 ?>
                        @if(sizeof($cart_data) == 0)
                        <h4 class = 'alert alert-success'>העגלה שלך ריקה!!</h4>
                        @else
                        @foreach($cart_data as $details)
                        <?php $total += $details->price * $details->quantity; 
                           $image =  asset('/assets/images/' .$details->image);
                           ?>
                        <div class="table-responsive">
                           <table class="table table-bordered tbfont">
                              <!--thead>
                                 <tr>
                                    <th  width="35%">פרטי מוצר </th>
                                    <th>חבילה</th>
                                    <th>מחיר מלא</th>
                                    <th>אחרי הנחה</th>
                                    
                                    <th></th>
                                 </tr>
                                 </thead-->
                              <tbody>
                                 <tr>
                                    <td width="35%">
                                       <div class="product-details-wrap">
                                          <div class="product-image">
                                             <img src="{{ $image }}">
                                          </div>
                                          <div class="product-info">
                                             <h6>{{ $details->name }}</h6>
                                             <p>{!! Str::limit($details->description, 25) !!}</p>
                                          </div>
                                       </div>
                                    </td>
                                    <?php if($details->item_type == 1){?> 
                                    <td  class="br-none text-center" style="overflow: hidden;"  rowspan="2">
                                       <!-- <img src="{{ asset('/assets/img/package.png') }}" alt=""> -->
                                       <div class="couponfix ribbon-top-left"><span>חבילות </span></div>
                                    </td>
                                    <?php }?>
                                    <td  rowspan="2"  class="br-none text-center finalprice">₪32.00</td>
                                    <td  rowspan="2"  class="br-none text-center">₪{{ $details->price }}</td>
                                    <td  rowspan="2"  class="br-none text-center">
                                       <a  class ="removecart" data-id="{{ $details->course_id }}"><i class="ti-close"></i></a>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        @endforeach
                        @endif        
                     </form>
                     @if(sizeof($cart_data) != 0)
                     <div class="total-cart cartbottom mt-0">
                        <div class="shipping-title text-center">
                           סכום סופי
                        </div>
                        <div class="shipping-infopanel">
                           <table class="totalcart-table">
                              <?php $shipping_total = 0;
                                 ?>
                              @foreach($cart_data as $details)
                              <?php $shipping_total += $details->price 
                                 ?>
                              @endforeach
                              <input type="hidden" id = "shipping_total" name="shipping_total" value="{{$shipping_total}}">
                              <tr>
                                 <th width="40%">מחיר מקורי  :</th>
                                 <td width="60%">₪{{$shipping_total}}</td>
                              </tr>
                              <tr>
                                 <td  colspan="2">
                                    <div class="form-group checkout-form border-0 p-0 mt-0 mb-10">
                                       <span class="checkbox-wrap d-block">
                                       <label class="container w-100 mb-0">יש לך קופון?
                                       <input class="coupon_question"  name="coupon_question" onchange="valueChanged()" type="checkbox">
                                       <span class="checkmark"></span>
                                       </label>
                                       </span>
                                    </div>
                                    <form action = "{{ url('apply_coupon') }}" method="POST">
                                       @csrf
                                       <div class="couponshow" style="display:none">
                                          <div class="coupon mt-0">
                                             <div class="coupon-form">
                                                <input type="text" id = "coupon_name" name="coupon_name" class="input-text mt-0 mb-0" placeholder="קוּפּוֹן">
                                                <button id="apply" type="submit" class="button" name="" value="">שלח</button>
                                             </div>
                                          </div>
                                       </div>
                                    </form>
                                    <div class="coupon-alert"></div>
                                 </td>
                              </tr>
                              {{-- @if (@$discountCoupon)
                              <tr>
                                 <td  colspan="2">
                                    <div class="form-group checkout-form border-0 p-0 mt-0 mb-10">
                                       <span class="checkbox-wrap d-block">
                                       <label class="container w-100 mb-0">השתמש בהנחה  {{$discountCoupon->discount}}
                                       <input class="discount_coupon" value="{{$discountCoupon->id}}" name="discount_coupon" type="checkbox" onclick="discountCoupon({{$discountCoupon->id}});">
                                       <span class="checkmark"></span>
                                       </label>
                                       </span>
                                    </div>
                                    <div class="coupon-alert"></div>
                                 </td>
                              </tr>
                              @endif --}}
                              <tr>
                                 <th width="40%">מחיר סופי :</th>
                                 <td width="60%"><span id="after_apply" style="color:#016B06; ">₪{{$shipping_total}}</span></td>
                              </tr>
                              <tr>
                                 <th width="40%">חסכת!  :</th>
                                 <td width="60%"><span id="saved" style="color:#016B06;">₪0</span></td>
                              </tr>
                              <tr>
                                 <td class="border-0" colspan="2">
                                    @if (Auth::check())
                                    <a href="javascript:void(0)" onclick="stepnext(3);" class="checkout-btn">לתשלום </a>
                                    @else
                                    <a href="javascript:void(0)" onclick="stepnext(2);" class="checkout-btn">לתשלום </a>
                                    @endif
                                 </td>
                              </tr>
                           </table>
                        </div>
                     </div>
                     @endif
                     <!--div class="cart-btn-sec">
                        <a href="#" class="cart-clear-btn">עגלה נקייה </a>
                        <a href="#" class="cart-update-btn">עדכן את עגלת הקניות </a>
                        </div-->
                  </div>
                  <div class="col-md-5">
                     <div class="cartsidebar">
                        <div class="title">
                           <h4>למה אנחנו</h4>
                        </div>
                        <ul>
                           <li>
                              <i class="ti-book"></i> 
                              <div class="cart-bullets">
                                 <h3>
                                    התאמה אישית לחומרי הלימוד שלך
                                 </h3>
                                 <p>
                                    אצלנו תוכל ללמוד קורסים המותאמים בדיוק לחומר הלימוד שלך, כפי שהמרצה שלך מלמד 
                                 </p>
                              </div>
                           </li>
                           <li>
                              <i class="ti-signal"></i> 
                              <div class="cart-bullets">
                                 <h3>
                                    מערכת הלמידה המקוונת המתקדמת ביותר בשוק
                                 </h3>
                                 <p>
                                    אצלנו תקבל את מערכת הלימוד הטובה והנוחה ביותר כדי שהלמידה תהפוך לאפקטיבית ונגישה
                                 </p>
                              </div>
                           </li>
                           <li>
                              <i class="ti-crown"></i> 
                              <div class="cart-bullets">
                                 <h3>
                                    מרצים מנוסים עם שיטות הוראה מהטובות בשוק
                                 </h3>
                                 <p>
                                    אצלנו תלמד את החומר בצורה קלה וברורה באמצעות שיטות ייחודיות שפיתחו המורים הטובים והמנוסים ביותר בתחום
                                 </p>
                              </div>
                           </li>
                        </ul>
                     </div>
                     <?php if(count($recommendations) != 0){?>
                     <div class="cartsidebar">
                        <div class="title">
                           <h4> סטודנטים ממליצים</h4>
                        </div>
                        <div class="cart-cont">
                           <div class="content cart-carousel owl-carousel owl-theme">
                              <?php foreach($recommendations as $value){
                                 foreach ($users_data as $user_data) {
                                              $image =  asset('/assets/users/' .$user_data->avatar);?>
                              <div class="item website-review">
                                 <div class="userimg">
                                    <img src="{{$image }}">
                                    <h3>{{$user_data->first_name}}</h3>
                                    <h5>מנהל</h5>
                                 </div>
                                 <p> {{$value->description}}</p>
                              </div>
                              <?php }}?>
                           </div>
                           <a href="{{url('/recommend')}}" class="btn-recomend btn btn-join btn-block"> ראה את כל ההמלצות </a>
                        </div>
                     </div>
                     <?php }?>
                     <div class="cartsidebar">
                        <div class="title">
                           <h4>הוסף גם</h4>
                        </div>
                        <!--<button style ="background: #eb871e; color:white;" class="btn btn-join btn-block" ><i class="ti-shopping-cart"></i> מרתון </button>-->
                        <a href="#marthonpopup" data-toggle="modal" style ="background: #eb871e; color:white; padding:10px 25px;" class="btn btn-join btn-block" ><i class="ti-shopping-cart"></i> מרתון </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="tab-pane  fade  pb-70" id="step-2" >
            <div class="container">
               <div class="row">
                  <div class="col-md-6"  id="login">
                     <div class="form-wraper">
                        <div id="response">
                           @if(Session::has('message'))
                           <div class="alert alert-success alert-dismissable">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              {{ Session::get('message') }}
                           </div>
                           @endif
                           @if(Session::has('error'))
                           <div class="alert alert-danger alert-dismissable">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              {{ Session::get('error') }}
                           </div>
                           @endif
                           @if($errors->has('error_card'))
                           <div class="alert alert-danger alert-dismissable">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              {{ $errors->first('error_card') }}
                           </div>
                           @endif
                        </div>
                        <div class="alert alert-danger print-loginerror-msg" style="display:none">
                           <ul></ul>
                        </div>
                        <h3 class=" dir-ltr"> ? כבר יש לך חשבון </h3>
                        <form  action="{{ route('front.loginpage') }}" class="mt-4" method="POST" id="first_form">
                           @csrf
                           <div class="form-group">
                              <input id="cart_email" type="text" class="form-control @error('email') is-invalid @enderror" name="cart_email" placeholder="שם משתמש או דוא " value="{{ old('email') }}" required autocomplete="email" autofocus multiple>
                              @error('email')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <input id="cart_password" type="password" class="form-control @error('password') is-invalid @enderror" name="cart_password" required autocomplete="current-password" type="password" name="" placeholder="סיסמה ">
                              @error('password')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                              @enderror  
                           </div>
                           <div class="form-group checkout-form border-0 p-0 mt-0">
                           </div>
                           <div class="form-group">
                              @if (Auth::check())
                              <button onclick="stepnext(3);" class="log-btn form-btn">הירשם </button>
                              @else
                              <button  id = "cart_loginBtn" type="submit" class="log-btn form-btn">התחברות </button>
                              @endif
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
                  <div class="col-md-6" id="signup">
                     <div class="form-wraper">
                        <h3 class="">הירשם לחשבונך </h3>
                        <div class="alert alert-danger" id ="cart_errors" style="display:none">
                           <ul></ul>
                        </div>
                        <form method="POST" action="{{ route('front.signup') }}" id="second_form">
                           @csrf
                           <div class="form-group">
                              <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" placeholder="שם פרטי " value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                              @error('first_name')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder="שם משפחה " value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                              @error('last_name')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <input id="email1" type="email" class="form-control @error('email1') is-invalid @enderror" name="email1"  placeholder="כתובת דוא " value="{{ old('email') }}" required autocomplete="email" multiple>
                              @error('email1')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <input id="password1" type="password" class="form-control @error('password1') is-invalid @enderror" placeholder="סיסמה "  name="password1" required>
                              @error('password1')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                           </div>
                           <?php 
                              $university_data = DB::table('universities')->get();
                              ?>
                           <div class="form-group">
                              <select id="university" name="university" class="form-control" data-placeholder="שם האוניברסיטה או המכללה " required="required" >
                                 <option value = "">שם האוניברסיטה או המכללה</option>
                                 @foreach($university_data as $university)
                                 <option value="{{ $university->id }}">{{ $university->university_name }}</option>
                                 @endforeach               
                              </select>
                           </div>
                           <div class="form-group">
                              <select id = "degree" name = "degree" data-placeholder="תוֹאַר " class="form-control" required="required"  >
                                 <option value="">וֹאַר </option>
                              </select>
                           </div>
                           <div class="form-group checkout-form border-0 p-0 mt-0">
                              <span class="checkbox-wrap d-block">
                              <label class="container w-100 mb-0">כדי להירשם אצלנו אנא סמן כדי להסכים ל   <a href="#" class="terms-text">תנאים והגבלות </a>
                              <input id = "terms" type="checkbox" name="terms" value="">
                              <span class="checkmark"></span>
                              </label>
                              </span>
                           </div>
                           <div class="form-group">
                              @if (Auth::check())
                              <button onclick="stepnext(3);" class="log-btn form-btn">הירשם </button>
                              @else
                              <button id = "cart_signup" type="submit" class="log-btn form-btn">הירשם </button>
                              @endif
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="tab-pane   fade pb-70" id="step-3" >
            <div class="container">
               @if(Auth::check())
               <form id="payment_form" class="checkout-form">
                  <input type="hidden" id="coupon_code_hidden"  >
                  <div class="row checkoutmain">
                     <div class="col-md-4 ">
                        <div class="checkoutside">
                           <div id="sidebartop" class="checkout-sidebar">
                              <div class="sidebar-bg-image"></div>
                              <?php  
                                 $image = asset('/assets/users/' .$user_detail->avatar);
                                 ?>
                              <div class="user-sidebar">
                                 <div class="avatar-upload">
                                    <div class="avatar-preview">
                                       <div id="imagePreview" style="background-image: url({{$image}});">
                                       </div>
                                    </div>
                                 </div>
                                 <h4>{{$user_detail->first_name . ' ' . $user_detail->last_name}}</h4>
                              </div>
                              <a href="#" class="backCart"><i class="ti-arrow-left"></i>חזרה לעגלה </a>
                              <h3>סיכום הזמנה </h3>
                              <?php $count = sizeof($cart_data);
                                 ?>
                              <h4>עֲגָלָה ({{$count}})</h4>
                              @foreach($cart_data as $details)
                              <?php
                                 $total += $details->price * $details->quantity;
                                 $image =  asset('/assets/images/' .$details->image);
                                 
                                 $course_type[] = $details->item_type;
                                 if(!empty($details->item_type) && $details->item_type =='3'){
                                    $courses_id[] = $details->topic_id;
                                 }else{
                                    $courses_id[] = $details->course_id;
                                 }
                                 ?>
                              <table class="table order-cart-table">
                                 <tbody>
                                    <tr>
                                       <td>
                                          <div class="product-details-wrap">
                                             <div class="product-image">
                                                <img src="{{$image}}">
                                             </div>
                                             <div class="product-info">
                                                <h6>{{ $details->name }}</h6>
                                                <div class="badge">1</div>
                                                <input type="hidden" id = "item_count" name="item_count" value ="1">
                                             </div>
                                          </div>
                                       </td>
                                       <td>₪{{ $details->price }}</td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                              <table class="totalprice-table">
                                 <?php $shipping_total = 0;
                                    $orignal_total = 100;
                                    
                                    ?>
                                 @foreach($cart_data as $details)
                                 <?php $shipping_total += $details->price;
                                    $grand_total[] = $details->price; ?>
                                 @endforeach
                                 <tr>
                                    <!--th>סך הכל :</th-->
                                    <th>מחיר מקורי  :</th>
                                    <td>{{$orignal_total}}</td>
                                 </tr>
                                 <!--tr>
                                    <th>משלוח :</th>
                                    <td>איסוף עצמי </td>
                                    </tr-->
                                 <tr>
                                    <!--th>סכום סופי :</th-->
                                    <th>מחיר סופי   :</th>
                                    <td id="finalP">{{$shipping_total}}</td>
                                 </tr>
                                 @if(sizeof($cart_data) != 0)
                                 <input type="hidden" id = "checkout_type" name="checkout_type" value ="{{$details->item_type}}">
                                 @endif
                              </table>
                              <div class="checkout-payment checkout_web">
                                 <img src="{{ asset('/assets/img/stamp.png') }}"/>
                                 <!--div class="form-check">
                                    <div class="radio-wraper">
                                       <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                       <label class="form-check-label" for="exampleRadios1">
                                       העברה בנקאית ישירה
                                       </label>
                                    </div>
                                    <p>בצע את התשלום ישירות לחשבון הבנק שלנו. אנא השתמש במזהה ההזמנה שלך כהפניה לתשלום. ההזמנה שלך לא תישלח עד אשר הכספים יוסרו בחשבוננו. </p>
                                    </div>
                                    <div class="form-check">
                                    <div class="radio-wraper">
                                       <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                       <label class="form-check-label" for="exampleRadios2">
                                       מזומן במשלוח
                                       </label>
                                    </div>
                                    <p>הנתונים האישיים שלך ישמשו לעיבוד הזמנתך, לתמיכה בחווייתך ברחבי אתר זה ולמטרות אחרות המתוארות במדיניות הפרטיות שלנו. </p>
                                    </div-->
                                 <div class="checkout-form termsagree">
                                    <label class="container">קראתי ואני מסכים לתנאי השימוש
                                    <input type="checkbox" name="agree_terms" id ="agree_terms" value="">
                                    <span class="checkmark"></span>
                                    </label>
                                    <label class="container">אני מודע לסיכון שבהעתקת ו/או העברת חומרי הלימוד המוגנים באתר לרבות הקלטות הקורסים
                                    <input type="checkbox" name="risk_terms" id ="risk_terms" value="">
                                    <span class="checkmark"></span>
                                    </label>
                                 </div>
                                 <!-- <button type = 'submit' class="place-orderbtn mt-0">שצע הזמנה </button> -->
                                 <button type = "submit" class="place-orderbtn mt-0">בצע הזמנה </button>
                                 <p class="checkoutnote">כשתלחץ על לחצן הרכישה אתה תצטרף גם לרשימת הניוזלטר שלנו כדי לקבל חומרי לימוד שנפרסם, עדכונים והטבות. </p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-8 paymentcart-form">
                        <div id="response">
                           @if(Session::has('message'))
                           <div class="alert alert-success alert-dismissable">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              {{ Session::get('message') }}
                           </div>
                           @endif
                           @if(Session::has('error'))
                           <div class="alert alert-danger alert-dismissable">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              {{ Session::get('error') }}
                           </div>
                           @endif
                           @if($errors->has('error_card'))
                           <div class="alert alert-danger alert-dismissable">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              {{ $errors->first('error_card') }}
                           </div>
                           @endif
                        </div>
                        <div class="fields-errors">
                           @error('name')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                           @error('email')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span> 
                           @enderror
                        </div>
                        <div class="alert alert-danger" id ="payment_form_error" style="display:none">
                           <ul></ul>
                        </div>
                        <h3  class="head-cart">פרטי תשלום </h3>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group mb-0">
                                 <label>שם משפחה  </label>
                                 <input id="payment_last_name" type="text" class="form-control @error('payment_last_name') is-invalid @enderror" placeholder="
                                    שם משפחה  " name="payment_last_name" value="{{$user_detail->last_name}}"autocomplete="payment_last_name"  />
                                 <i class="fa fa-user"></i>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group mb-0">
                                 <label>שם פרטי </label>
                                 <input id="payment_first_name" type="text" class="form-control @error('payment_first_name') is-invalid @enderror" placeholder=" שם פרטי " name="payment_first_name" value="{{$user_detail->first_name}}"autocomplete="first_name" />
                                 <i class="fa fa-user"></i>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group mb-0">
                                 <label>אימייל </label>
                                 <input type="email" id="payment_email" class="form-control @error('payment_email') is-invalid @enderror" placeholder=" אימייל " name="payment_email" value="{{$user_detail->email}}"autocomplete="email"  />
                                 <i class="fa fa-envelope"></i>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group mb-0">
                                 <label>מספר טלפון </label>
                                 <input type="text" id="payment_phone_number" class="form-control @error('payment_phone_number') is-invalid @enderror" placeholder="
                                    מספר איש קשר " name="payment_phone_number" value="{{$user_detail->contact_number}}"  />
                                 <i class="fa fa-phone"></i>
                              </div>
                           </div>
                        </div>
                        <h3 class="head-cart mt-20">אמצעי תשלום </h3>
                        <div class ="row d-flex" style="display: flex!important;padding-right: 15px;">
                           <input id = 'add_new_card' class = "payment_checked" type="radio" name="opt_radio" value = "0" style="min-height: 16px;" ><label style="    padding-right: 10px;">Add new card detail</label>
                        </div>
                        <div id="card-detail-form-section">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>סוג כרטיס </label>
                                    <select id = "card_type" name ="card_type" class="form-control" >
                                       <option value = "">בחר סוג כרטיס </option>
                                       <option value = "master_card">כרטיס מאסטר </option>
                                       <option value = "visa_card"> Visa Card </option>
                                       <option value = "debit_card"> Debit Card </option>
                                       <option value = "credit_card">  Credit Card  </option>
                                    </select>
                                    <i class="fa fa-credit-card"></i>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>הוסף שם בעל כרטיס </label>
                                    <input type="text" id = "holder_name" name="holder_name" class="form-control" value="">
                                    <i class="fa fa-user"></i>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>מספר כרטיס </label>
                                    <input type="text" name="ticket_number" id ="ticket_number" class="form-control" value="">
                                    <i class="fa fa-ticket"></i>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label>תאריך תפוגה </label>
                                    <select id = "expiry_month" name ="expiry_month" class="form-control" >
                                       <option value = ''>בחר חודש </option>
                                       <option value = '1'>1</option>
                                       <option value = '2'>2</option>
                                       <option value = '3'>3</option>
                                       <option value = '4'>4</option>
                                       <option value = '5'>5</option>
                                       <option value = '6'>6</option>
                                       <option value = '7'>7</option>
                                       <option value = '8'>8</option>
                                       <option value = '9'>9</option>
                                       <option value = '10'>10</option>
                                       <option value = '11'>11</option>
                                       <option value = '12'>12</option>
                                    </select>
                                    <i class="fa fa-calendar"></i>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label>שנת תפוגה </label>
                                    <select id = "expiry_year" name = "expiry_year" class="form-control">
                                       <option>בחר שנה </option>
                                       <?php 
                                          $y = gmdate("Y");
                                          $x = 15;
                                          $max = ($y + $x);
                                          while ($y <= $max) {
                                             echo "<option value='$y'>$y</option>";
                                             $y = $y + 1;
                                          }
                                          ?>
                                    </select>
                                    <i class="fa fa-calendar"></i>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label>הוסף CVV </label>
                                    <input type="text" name="cvv_value" id = "cvv_value" class="form-control">
                                    <i class="fa fa-code"></i>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php 
                           $counts = 0;
                           $card_data = DB::table('card_details')->where('user_id',Auth::user()->id)->get();
                           $counts = count($card_data);
                           ?>
                        @if($counts != 0 )
                        <hr class="custom-hr my-3" style="border-top: 1px solid #eb871e61;margin: 18px;">
                        <div class ="row d-flex" style="display: flex!important;padding-right: 15px;">
                           <input class = "payment_checked" type="radio" id = 'choose_old_cards' name="opt_radio" value = "1" style="min-height: 16px;" ><label style="    padding-right: 10px;">Select from existing cards</label>
                        </div>
                        <div id="card-detail-list-section" >
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="table-responsive">
                                    <table class="table table-cart">
                                       <thead>
                                          <tr>
                                             <th>&nbsp;</th>
                                             <th>Card Type</th>
                                             <th>Card Holder</th>
                                             <th>Card Number</th>
                                             <th>&nbsp;</th>
                                          </tr>
                                       </thead>
                                       <?php
                                          $selected = 'unchecked';
                                             foreach ($card_data as $value) {
                                                 $selected = ($value->is_default == 1 ? 'checked' :  'unchecked');
                                                 if($value->is_default == 1){
                                                  $default_card_id = $value->id;
                                                 }else{
                                                  $default_card_id = '';
                                                 }
                                                 ?>
                                       <tbody>
                                          <tr>
                                             <td>
                                                <input id = "show_list" checked='{{$selected}}' type="radio" name="optsradio" value = "{{$value->stripe_card_id}}">
                                                <input type ="hidden" id="default_card_id" value ="{{$default_card_id}}">
                                             </td>
                                             <td>{{$value->card_type}}</td>
                                             <td>{{$value->card_holder_name}}</td>
                                             <td>xxxx{{$value->card_number}}</td>
                                             <td>
                                                <a  id ="delete_card" class="btndel" data-id="{{ $value->id }}"><i class="ti-close"></i></a>
                                             </td>
                                          </tr>
                                       </tbody>
                                       <?php  }?>
                                    </table>
                                 </div>
                              </div>
                           </div>
                           @endif
                        </div>
                        <div class="checkout-payment mobile_view">
                           <img src="{{ asset('/assets/img/stamp.png') }}"/>
                           <!--div class="form-check">
                              <div class="radio-wraper">
                                 <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                 <label class="form-check-label" for="exampleRadios1">
                                 העברה בנקאית ישירה
                                 </label>
                              </div>
                              <p>בצע את התשלום ישירות לחשבון הבנק שלנו. אנא השתמש במזהה ההזמנה שלך כהפניה לתשלום. ההזמנה שלך לא תישלח עד אשר הכספים יוסרו בחשבוננו. </p>
                              </div>
                              <div class="form-check">
                              <div class="radio-wraper">
                                 <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                 <label class="form-check-label" for="exampleRadios2">
                                 מזומן במשלוח
                                 </label>
                              </div>
                              <p>הנתונים האישיים שלך ישמשו לעיבוד הזמנתך, לתמיכה בחווייתך ברחבי אתר זה ולמטרות אחרות המתוארות במדיניות הפרטיות שלנו. </p>
                              </div-->
                           <div class="checkout-form termsagree">
                              <label class="container">קראתי ואני מסכים לתנאי השימוש
                              <input type="checkbox" name="agree_terms" id ="agree_terms" value="">
                              <span class="checkmark"></span>
                              </label>
                              <label class="container">אני מודע לסיכון שבהעתקת ו/או העברת חומרי הלימוד המוגנים באתר לרבות הקלטות הקורסים
                              <input type="checkbox" name="risk_terms" id ="risk_terms" value="">
                              <span class="checkmark"></span>
                              </label>
                           </div>
                           <!-- <button type = 'submit' class="place-orderbtn mt-0">שצע הזמנה </button> -->
                           <button type = "submit" class="place-orderbtn mt-0">בצע הזמנה </button>
                           <p class="checkoutnote">כשתלחץ על לחצן הרכישה אתה תצטרף גם לרשימת הניוזלטר שלנו כדי לקבל חומרי לימוד שנפרסם, עדכונים והטבות. </p>
                        </div>
                     </div>
                  </div>
               </form>
               @endif
            </div>
         </div>
         <div class="tab-pane   fade " id="step-4" >
            <div class="thankyou-sec video-box">
               <div class="thankmsg">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-6 ">
                           <div class="video-section mb-40">
                              <iframe width="100%" height="315" src="https://www.youtube.com/embed/DKz_EEoJRs4?controls=0&autoplay=1&mute=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                           </div>
                        </div>
                        <div class="col-md-6 ">
                           <div class="text-center">
                              <h4 class="check-icon"><i class="ti-check"></i></h4>
                              <h1>תודה !</h1>
                              <h3>התשלום בוצע בהצלחה</h3>
                              <p>ם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז, כאשר מדפסת לא ידועה לקחה מטבע מסוג וסיבבה אותו כדי ליצור ספר דגימהה</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="referfriend pt-80 pb-80">
                  <div class="container">
                     <div class="row">
                        <div class="referimg">
                           <img src="{{ asset('/assets/img/Refer.png') }}">
                        </div>
                        <div class="site-heading text-center mb-20">
                           <h2>הפנה חבר</h2>
                           <p>שתף קוד הפניה עם חבריך, חברך יקבל 10% הנחה ברכישה ותקבל 10% הנחה ברכישה הבאה שלך לקורסים</p>
                        </div>
                        <div class="form-group mb-0">
                           <div class="input-group">
                              <input id = "refer_code" type="text" class="form-control"value="{{ Auth::user()->reffer_code }}" readonly autocomplete="off" />
                              <a id ="refer_button" class="input-group-addon">
                              העתק קישור
                              </a> 
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="intensivellesson pt-40 pb-40">
                  <div class="container">
                     <div class="row">
                        <div class="site-heading text-center w-100 mb-20">
                           <h2> מרתון </h2>
                        </div>
                        <div class="top-course-items courses-carousel owl-carousel owl-theme" style="    direction: ltr;">
                          @if (count($marathons) > 0)
                           @foreach ($marathons as $marathon)
                              <div class="item text-right">
                                 <a class="thumb">
                                    <span class="cartdiscount">-40%</span>
                                    <img src='{{ asset("/assets/images/$marathon->image") }}' alt="Thumb">
                                    <div class="countertimer" id="countertimer"></div>
                                 </a>
                                 <div class="info">
                                    <h4>
                                       <a href="{{route('front.course.show',['id' => $marathon->course_id])}}">{{ $marathon->course_name }}</a>
                                    </h4>
                                    <div class="meta">
                                       <ul>
                                          <li>
                                             <i class="fas fa-star"></i>
                                             <i class="fas fa-star"></i>
                                             <i class="fas fa-star"></i>
                                             <i class="fas fa-star"></i>
                                             <i class="fas fa-star"></i>
                                          </li>
                                       </ul>
                                    </div>
                                    <p>{{ $marathon->description }}</p>
                                    <div class="footer-meta">
                                       <h4>${{ $marathon->price }}</h4>
                                       <div class="btn-btm">
                                          <a class="btn btn-theme effect btn-sm" href="{{route('front.display.cart',['id' => Auth::user()->id])}}">קנה עכשיו  </a>
                                          <a class="btn btn-theme btnoutline effect btn-sm" href="{{route('front.cart.show',['type' => 0 ,'id' => $marathon->course_id])}}">הוסף לעגלה    </a>
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
               <div class="contacticons mb-0">
                  <div class="container">
                     <div class="row">
                        <div class="site-heading text-center mb-20">
                           <h2>עקוב אחרינו ברשתות החברתיות  </h2>
                           <p> לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקס הדמה הסטנדרטי בתעשייה. </p>
                        </div>
                        <div class="social-contact">
                           <ul>
                              <li><a href="{{$urls[0]}}" class="social-icon facebook"><i class="fab fa-facebook"></i> פייסבוק</a></li>
                              <li><a href="{{$urls[1]}}" class="social-icon youtube"><i class="fab fa-youtube"></i> יוטיוב</a></li>
                              <li><a href="{{$urls[2]}}" class="social-icon instagram"><i class="fab fa-instagram"></i> אינסטגרם</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="contactfaq mb-0">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-10  col-md-offset-1">
                           <div class="site-heading text-center">
                              <h2>שאלות ותשובות </h2>
                              <p> לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקס הדמה הסטנדרטי בתעשייה. </p>
                           </div>
                           <div class="panel-group " id="accordion">
                              <?php foreach ($questions as $question) { ?>
                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                       <a data-toggle="collapse" data-parent="#accordion" href="#ac1{{$question->id}}" aria-expanded="false" class="collapsed">
                                       {{$question->questions}}
                                       </a>
                                    </h4>
                                 </div>
                                 <div id="ac1{{$question->id}}" class="panel-collapse collapse" aria-expanded="false">
                                    <p>{{$question->answers}}</p>
                                    <a href="javascript:void(0)" class="btn-readmore">קרא עוד</a>
                                 </div>
                              </div>
                              <?php } ?>
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
<div class="modal loginModal in" id="marthonpopup" >
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- modal header -->
         <div class="modal-header border-bottom-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
         </div>
         <!-- modal header ends -->
         <!-- Modal body -->
         <div class="modal-body">
            <div class="after_login" style="direction: rtl;">
               <div class="form-wraper">
                  <h3 class="mb-0">מֵידָע </h3>
                  <form action="#" class="mt-4" method="POST" id="marathon_form">
                     <span class="text-danger error-text credentials_err"></span> 
                     <div class="form-group">
                        <select id="private_university" name="private_university" class="form-control  chosen-select" data-placeholder="לחפש " multiple="" style="display: none;">
                           @foreach($universities as $university)
                           <option data-id = "{{ $university->id}}" data-type = "0" value="{{ $university->university_name }}">{{ $university->university_name }}</option>
                           @endforeach                           
                        </select>                  
                     </div>                     
                     <div class="form-group">
                        <input id="date" type="date" class="form-control " name="marathon_email" placeholder="שם משתמש או דוא " value="" required=""  multiple="">
                        <span class="text-danger error-text marathon_email_err"></span>
                     </div>
                     <div class="form-group text-center">
                        <button type="submit" id="submitMarathon" class="log-btn form-btn wdt-30">שלח</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('scripts')
<script type ="text/javascript">
  $('.discount_coupon').on('change', function() {
      var val = this.checked ? this.value : '';
      alert(val);
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
<script type="text/javascript">
   function valueChanged()
     {
       if($('.coupon_question').is(":checked"))   
         $(".couponshow").show();
       else
         $(".couponshow").hide();
     }
</script>
<script type="text/javascript">
   // Set the date we're counting down to
   var countDownDate = new Date("Jan 25, 2022 15:37:25").getTime();
   // Update the count down every 1 second
   var x = setInterval(function() {
     // Get today's date and time
     var now = new Date().getTime(); 
     // Find the distance between now and the count down date
     var distance = countDownDate - now;
     // Time calculations for days, hours, minutes and seconds
     var days = Math.floor(distance / (1000 * 60 * 60 * 24));
     var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
     var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
     var seconds = Math.floor((distance % (1000 * 60)) / 1000);
     var demo = document.getElementsByClassName("countertimer");
   
     $.each( demo, function( key, value ) {
       // Output the result in an element with id="demo"
       demo[key].innerHTML = "<span class='countext'>" + days + "<br><span>Days</span></span>"  + "<span class='countext'>" 
       + hours + "<br><span>Hr</span></span>"
       + "<span class='countext'>"  + minutes + "<br><span>Min</span></span>" + "<span class='countext'>"  +seconds + "<br><span>Sec</span></span>";
   
       // If the count down is over, write some text 
       if (distance < 0) {
         clearInterval(x);
         demo[key].innerHTML = "EXPIRED";
       }
       
     });
   }, 1000);
   $(document).ready(function(){
       $('#university').change(function(){
         var university_id = $(this).val();
           $.ajax({
             url: '{{ route('front.getdegree') }}',
             type: 'POST',
             data: {
                 university_id: university_id
             },
             success: function(data) {
               $('#degree').html('');
                 $.each(data.degree_data, function(i, d) {
                   $('#degree').append('<option value="' + d.id + '">' + d.degree_name + '</option>');
                 });
               }
           });
         });
       $('#terms').change(function() { 
         if ($('#terms').is(":checked") == true) { 
           $('#terms').val('1'); 
         } else { 
           $('#terms').val(''); 
         } 
       });
       $('#agree_terms').change(function() { 
         if ($('#agree_terms').is(":checked") == true) { 
           $('#agree_terms').val('1'); 
         } else { 
           $('#agree_terms').val(''); 
         } 
       });
       $('#risk_terms').change(function() { 
         if ($('#risk_terms').is(":checked") == true) { 
           $('#risk_terms').val('1'); 
         } else { 
           $('#risk_terms').val(''); 
         } 
       });
       $("#cart_signup").click(function(e) {
         e.preventDefault();
         var first_name = $("input[name='first_name']").val();
         var last_name = $("input[name='last_name']").val();
         var email1 = $("input[name='email1']").val();
         var password1 = $("input[name='password1']").val();
         var university = $('#university').val();
         var degree = $('#degree').val();
         var terms = $("input[name='terms']").val();
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
                   window.location.reload();
                 } else {
                     printErrorMsg(data.error);
                 }
               }
             });
           });
   function printErrorMsg (msg) {
     $("#cart_errors").find("ul").html('');
     $("#cart_errors").css('display','block');
     $.each( msg, function( key, value ) {
       $("#cart_errors").find("ul").append('<li>'+value+'</li>');
     });
   }
   
   /* Marathon form submit */
   $("#submitMarathon").click(function(e) {
      e.preventDefault();
   });
    
   $("#cart_loginBtn").click(function(e) {
           e.preventDefault();
           var email = $("input[name='cart_email']").val();
           var password = $("input[name='cart_password']").val();
           $.ajax({
             url: '{{ route("front.loginpage") }}',
             type: 'POST',
             data: {
                 email: email,
                 password: password
             },
             success: function(data) {
                 if ($.isEmptyObject(data.error)) {
                  stepnext(3); 
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
   $("#payment_form").on('submit',function(event) {
     event.preventDefault();
     var first_name = $('#payment_first_name').val();
     var last_name = $('#payment_last_name').val();
     var email = $('#payment_email').val();
     var phone_number = $('#payment_phone_number').val();
     // var add_new_card = $('#add_new_card').is(":checked");
     // var choose_old_cards = $('#choose_old_cards').is(":checked");
     // if(add_new_card){
     //   var card_type = $('#card_type').val();
     //   var holder_name = $('#holder_name').val();
     //   var card_number = $('#ticket_number').val();
     //   var card_number = (card_number.trim());
     //   var expiry_month = $('#expiry_month').val();
     //   var expiry_year = $('#expiry_year').val();
     //   var cvv_number = $('#cvv_value').val();
     // }
     // if(choose_old_cards){
     //   var old_stripe_id = $('input[name=optsradio]:first').attr('checked', true).val();
     //   var card_id =  $('#default_card_id').val();
     // }
     var coupon_code_hidden = $("#coupon_code_hidden").val();
     var grand_total = '<?php echo implode(',',$grand_total); ?>';
     var item_count = $('#item_count').val();
     var courses_data = '<?php echo implode(',',$courses_id); ?>';
     var topic_ids = '<?php echo implode(',',$topic_ids); ?>';
     var course_type = '<?php echo implode(',',$course_type); ?>';
     var checkout_type = $('#checkout_type').val();
     var agree_terms = $("input[name='agree_terms']").val();
     var risk_terms = $("input[name='risk_terms']").val();
     $.ajax({
       url: '{{ url("checkout_update") }}',
       method:"POST",
       data:{
         first_name:first_name,
         last_name:last_name,
         email:email,
         phone_number:phone_number,
         grand_total:grand_total,
         item_count:item_count,
         courses_id:courses_data,
         course_type:course_type,
         checkout_type:checkout_type,
         agree_terms:agree_terms,
         risk_terms:risk_terms,
         coupon_code_hidden:coupon_code_hidden,
         
         // old_stripe_id:old_stripe_id,
         // card_id : card_id,
         // card_type:card_type,
         // holder_name:holder_name,
         // card_number:card_number,
         // expiry_month:expiry_month,
         // expiry_year:expiry_year,
         // cvv_number:cvv_number,
         // add_new_card:add_new_card,
         // choose_old_cards:choose_old_cards
   
       },
       success:function(data){
         console.log(data);
         if (data.value.status == 1) {
           $('#support_button').hide();
           $(".stepwizard-row a").removeClass('btn-primary');
           $(".stepwizard-row a").addClass('btn-default');
           $('#step-3').attr("style", "display: none;");
           window.scrollTo({ top: 0, behavior: 'smooth' });
           $('.stepwizard a[href="#step-4"]').tab('show');
           // $('#refer_code').val(data.code);
           $('.stepwizard-row a[href="#step-4"]').removeClass('btn-default');
            $('.stepwizard-row a[href="#step-4"]').addClass('btn-primary');
            $('.stepwizard-row a[href="#step-3"]').addClass('btn-primary');
            $('.stepwizard-row a[href="#step-2"]').addClass('btn-primary');
            $('.stepwizard-row a[href="#step-1"]').addClass('btn-primary');            
           }else {
            if(data.value.msg != ''){
               alert(data.value.msg);
            }else{
                window.scrollTo({ top: 0, behavior: 'smooth' });
                printErrorMsg2(data.error);
            }
         }  
       }
     });
   }); 
   function printErrorMsg2 (msg) {
          $("#payment_form_error").find("ul").html('');
          $("#payment_form_error").css('display','block');
          $.each( msg, function( key, value ) {
            $("#payment_form_error").find("ul").append('<li>'+value+'</li>');
          });
        }
     $('#uploadfile').change(function() {
       $('#image_title').text(this.files && this.files.length ? this.files[0].name : '');
     });
   /*     $("#upload_chat_btn").click(function(e) {
           e.preventDefault();
           var fd = new FormData();
           var files = $('#uploadfile')[0].files;
            // Check file selected or not
           if(files.length > 0 ){
            fd.append('file',files[0]);
           $.ajax({
             url: '{{ route("front.chatbox") }}',
             type: 'POST',
               data:new FormData($("#upload-chats")[0]),
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
   
         });*/
   });
</script>
<script type="text/javascript">
   $(document).ready(function(){
     $('#add_new_card').prop('checked', true);
     $('#card-detail-list-section').css("pointer-events", "none");
     $('#card-detail-list-section').css("opacity", "0.7");
     $(".payment_checked").change(function(){
       var add_new_card = $('#add_new_card').is(":checked");
       var choose_old_cards = $('#choose_old_cards').is(":checked");
   
         if( add_new_card ){ // check if the radio is checked
               $('#card-detail-list-section').css("pointer-events", "none");
               $('#card-detail-list-section').css("opacity", "0.7");
               $('#card-detail-form-section').css("pointer-events", "");
               $('#card-detail-form-section').css("opacity", "");
           }else{
             $('#card-detail-form-section').css("pointer-events", "none");
               $('#card-detail-form-section').css("opacity", "0.7");
               $('#card-detail-list-section').css("pointer-events", "");
               $('#card-detail-list-section').css("opacity", "");
           }
         if(choose_old_cards){ 
               $('#card-detail-form-section').css("pointer-events", " none");
               $('#card-detail-form-section').css("opacity", "0.7");
               $('#card-detail-list-section').css("pointer-events", " ");
               $('#card-detail-list-section').css("opacity", " ");
       }else{
             $('#card-detail-list-section').css("pointer-events", "none");
               $('#card-detail-list-section').css("opacity", "0.7");
               $('#card-detail-form-section').css("pointer-events", "");
               $('#card-detail-form-section').css("opacity", "");
           }
    });
     $("#delete_card").click(function (e) {
         e.preventDefault();
         var ele = $(this);
         if(confirm("Are you sure")) {
           $.ajax({
             url: '{{ url("remove_card") }}',
             method: "POST",
             data: {_token: '{{ csrf_token() }}', card_id: ele.attr("data-id")},
               success: function (data) {
                if (data.value.status == 1) { 
                        alert(data.value.msg);
                        window.location.reload();      
                   } else {
                      alert(data.value.msg);
                   }  
               }
             });
         }
       });
      $("body").on('click','.remove_coupon', function(e){
         $('#apply').prop('disabled',false);
         $('#coupon_name').prop('readonly',false);
         $('#coupon_name').val('');
         $('.coupon-alert').empty();
         var actual_price = $('#shipping_total').val();
         var final = '₪' + actual_price;
         var saved = '₪' + '0';
         $('#after_apply').text(final);
         $('#saved').text(saved);         
     });
     $("#apply").click(function(e){
      e.preventDefault();
      if($('#coupon_name').val()!=''){
         var coupon_code = $('#coupon_name').val();
         $("#coupon_code_hidden").val(coupon_code);
         var actual_price = $('#shipping_total').val();
         $.ajax({
            url: '{{route("front.apply_coupon") }}',
            method: "POST",
            dataType: 'json',
            data:{
               coupon_name: coupon_code,
               actual_price:actual_price
            },
         success: function(response) {
            if(response.data.status == 1){
               var final = '₪' + response.data.final_amount;
               var saved = '₪' + response.data.discount_value;
               $('#after_apply').text(final);
               $('#finalP').text(final);
               $('#saved').text(saved);
               console.log(response.data.msg);
               $remove = '<span class="remove_coupon"><a href="javascript:void(0)">Remove</a></span>';
               $('#apply').prop('disabled',true);
               $('#coupon_name').prop('readonly',true);
               $('.coupon-alert').html('<span class="text-success">'+response.data.msg+'</span>'+$remove);
            }else{
               $('.coupon-alert').html('<span class="text-danger">'+response.data.msg+'</span>');
            }
         }
      });
   }else{
      $('.coupon-alert').html('<span class="text-danger">קוד הקידום לא יכול להיות ריק</span>')
     }
   });
     $("#refer_button").click(function(){
      /* Get the text field */
      var copyText = document.getElementById("refer_code");
   
      /* Select the text field */
      copyText.select();
      copyText.setSelectionRange(0, 99999); /* For mobile devices */
   
      /* Copy the text inside the text field */
      document.execCommand("copy");
      $('#refer_button').html('Copied');
   });
      });
      
      
    $(document).on('click',".ticket_cls",function(){
       console.log($(this).attr('data-id')); 
       $("#ticket_id").val('');
       $("#ticket_id").val($(this).attr('data-id'));
    });
    
    
    $("#upload_chat_btn").click(function(e) {
        e.preventDefault();
        var  ticket_id = $("input[name='ticket_id']").val();
        var  ticket_subjects = $("input[name='ticket_subjects']").val();
        var  token = $('meta[name=csrf-token]').attr('content');
        var  ticket_message = $('textarea#ticket_message').val();
        
        $.ajax({
            url: '{{ Route('front.addTicket') }}',
            type: 'POST',
            data: {
                ticket_message:ticket_message,
                ticket_subjects:ticket_subjects,
                ticket_id:ticket_id,
                _token:token,
         },
         success: function(data) {
             if ($.isEmptyObject(data.error)){
                    $(".alertMessage").show();
                    //console.log(data);
                $('textarea#ticket_message').val('');
                setTimeout(function(){
                    $(".alertMessage").hide();
                },3000);
             } else {
                printErrorMsg(data.error);
             }
           }
        });
    });
    
    
</script>
@endsection