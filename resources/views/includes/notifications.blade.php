@extends('layouts.app')

@section('title', ' התראות ')

@section('content')
      

<div class="banner-inner-area2 pt8"></div>
<div class="breadcrumb-inner-area" style="">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <ul class="breadcrumb">
               <li><a href="#"><i class="fas fa-home"></i> דף הבית</a></li>
               <li><a href="#">עמודים</a></li>
               <li class="active">התראות </li>
            </ul>
         </div>
      </div>
   </div>
</div>

      <!-- Start Breadcrumb  -->
<!-- 		       <div class="breadcrumb-area" style="" >
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12">
                <h1>התראות </h1>
                  <ul class="breadcrumb">
                     <li><a href="#"><i class="fas fa-home"></i> דף הבית</a></li>
                     <li><a href="#">עמודים</a></li>
                     <li class="active">התראות </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
	    <div class="curvedown2">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 220"><path fill="#0d0d3f" fill-opacity="1" d="M0,64L60,64C120,64,240,64,360,74.7C480,85,600,107,720,112C840,117,960,107,1080,90.7C1200,75,1320,53,1380,42.7L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>
	  </div> -->
      <!-- End Breadcrumb -->
      <div class="default-padding-lg1 sidebar_content-section bg-gray" style="direction: rtl;">
         <div class="container">
            <!-- <div class="col-md-4">
               <div class="sidebar-wraper">
                  <div class="user-sidebar">
                     <div style="position: relative;">
                        <img src="assets/img/advisor/2.jpg">
                        <span class="edit-icon"><i class="ti-pencil-alt"></i></span>
                     </div>
                     <h4>John Smith</h4>
                     <p>john@example.com</p>
                  </div>
                  <ul>
                     <li>
                        <a href="profile.html"><i class="ti-user"></i> Profile</a>
                     </li>
                     <li>
                        <a href="message.html" class="active"><i class="ti-comment"></i> Messages</a>
                     </li>
                     <li>
                        <a href="payment-method.html"><i class="ti-credit-card"></i> Payment Method</a>
                     </li>
                     <li>
                        <a href="history.html" class="border-0"><i class="ti-timer"></i> History</a>
                     </li>
                  </ul>
               </div>
               </div> -->
            <div class="col-md-12">
               <div class="content-wraper">
                  <div class="sidebar_header-login">
                     <h3>התראות </h3>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <!-- Star Tab Info -->
                        <div class="tab-info notifications-tab">
                           <!-- Tab Nav -->
                           <ul class="nav nav-pills">
                              <li class="active">
                                 <a data-toggle="tab" href="#tab1" aria-expanded="true">
                               כל ההודעות
                                 </a>
                              </li>
                              <li>
                                 <a data-toggle="tab" href="#tab2" aria-expanded="false">התראות שלי</a>
                                <!-- <a data-toggle="tab" href="#tab2" aria-expanded="false">
                                 התראות אחרונות
                                 </a>-->
                              </li>
                           </ul>
                           <!-- End Tab Nav -->
                           <!-- Start Tab Content -->
                           <div class="tab-content tab-content-info">
                              <!-- Single Tab -->
                              <div id="tab1" class="tab-pane fade active in">
                                 <div class="info title">
                                    <?php foreach ($notifications as $key => $notification) {
                                       /*$created_at = DB::table('notification_users')->where('notification_id',$notification->id)->pluck('created_at');
                                       $datetime = new DateTime($created_at[0]);
                                       $day = $datetime->format('d');
                                       $month = $datetime->format('M');
                                       $year = $datetime->format('y');
                                       $time = $datetime->format('H:i');*/

                                       ?>
                                    <div class="notifications-row">
                                       <div class="notifications-img">
                                          <img src="{{ asset('/assets/img/advisor/3.jpg') }}">
                                       </div>
                                       <div class="notifications-text text-right text-right w-100">
                                          <div class="notifications-heading">
                                             <h5>{{$notification->title}}</h5>
                                             <div class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <span><i class="ti-angle-down"></i></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                   <li class="">
                                                      <a class = "remove_notifi"data-id="{{ $notification->id }}"><i class="ti-trash " ></i> Delete this notification </a>
                                                   </li>
                                                   <li class="">
                                                      <a href="#"><i class="ti-close"></i>Stop receving notification like this </a>
                                                   </li>
                                                </ul>
                                             </div>
                                          </div>
                                          <p><!--$notification->message--></p>
                                          <div>
                                             <span><i class="ti-time"></i> <!--$day.' '.$month.' '.$year.' '.'at'.' '.$time--> </span>
                                          </div>
                                       </div>
                                    </div>
                                 <?php }?>
                                 </div>
                              </div>
                              <!-- End Single Tab -->
                              <!-- Single Tab -->
                              <div id="tab2" class="tab-pane fade">
                                 <div class="info title">
                                    <?php foreach ($recent_notifications as $key => $recent_notification) {
                                       /*$createdat = DB::table('notification_users')->where('notification_id',$recent_notification->id)->pluck('created_at');
                                       $datetime1 = new DateTime($createdat[0]);
                                       $day1 = $datetime1->format('d');
                                       $month1 = $datetime1->format('M');
                                       $year1 = $datetime1->format('y');
                                       $time1 = $datetime1->format('H:i');*/

                                       ?>
                                    <div class="notifications-row">
                                       <div class="notifications-img">
                                          <img src="{{ asset('/assets/img/advisor/3.jpg') }}">
                                       </div>
                                       <div class="notifications-text text-right w-100">
                                          <div class="notifications-heading">
                                               <h5>{{$recent_notification->title}}</h5>
                                             <div class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <span><i class="ti-angle-down"></i></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                   <li class="">
                                                      <a class = "remove_notifi"data-id="{{ $recent_notification->id }}"><i class="ti-trash " ></i> Delete this notification </a>
                                                   </li>
                                                   <li class="">
                                                      <a href="#"><i class="ti-close"></i>Stop receving notification like this </a>
                                                   </li>
                                                </ul>
                                             </div>
                                          </div>
                                         <p><!--$recent_notification->message--></p>
                                          <div>
                                             <span><i class="ti-time"></i><!--$day1.' '.$month1.' '.$year1.' '.'at'.' '.$time1--></span>
                                          </div>
                                       </div>
                                    </div>
                                    <?php }?>
                                 </div>
                              </div>
                              <!-- End Single Tab -->
                           </div>
                           <!-- End Tab Content -->
                        </div>
                        <!-- End Tab Info -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   @endsection
   @section('scripts')
   <script type="text/javascript">
   $(".remove_notifi").click(function (e) {
            e.preventDefault();
            var ele = $(this);
                $.ajax({
                    url: '{{ url("remove_notification") }}',
                    method: "POST",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
        });   
   </script>
   
   @endsection