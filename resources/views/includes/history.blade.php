@extends('layouts.app')

@section('title', ' הִיסטוֹרִיָה ')

@section('content')
  
   
      <!-- Start Breadcrumb 
         ============================================= -->
		<!-- <div class="breadcrumb-area" style="" >
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12">
                <h1>הִיסטוֹרִיָה </h1>
                  <ul class="breadcrumb">
                     <li><a href="#"><i class="fas fa-home"></i> דף הבית</a></li>
                     <li><a href="#">עמודים</a></li>
                     <li class="active">הִיסטוֹרִיָה </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <div class="curvedown">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 220"><path fill="#0d0d3f" fill-opacity="1" d="M0,64L60,64C120,64,240,64,360,74.7C480,85,600,107,720,112C840,117,960,107,1080,90.7C1200,75,1320,53,1380,42.7L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>
	  </div> -->
	 
<div class="banner-inner-area2 pt8"></div>
<div class="breadcrumb-inner-area" style="">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <ul class="breadcrumb">
               <li><a href="#"><i class="fas fa-home"></i> דף הבית</a></li>
               <li><a href="#">עמודים</a></li>
               <li class="active">הִיסטוֹרִיָה </li>
            </ul>
         </div>
      </div>
   </div>
</div>

      <!-- End Breadcrumb -->
      <div class="default-padding-lg1 sidebar_content-section bg-gray" style="direction: rtl">
         <div class="container">
            <div class="col-md-4">
               @include('includes.profile-sidebar')
            </div>
            <div class="col-md-8">
               <div class="content-wraper">
                  <h3>הִיסטוֹרִיָה </h3>
                  <div class="row">
                     <div class="col-md-12">
                        
                                 <?php
                                 if(count($orders) == 0){?>
                                    <div class="row" style="text-align:center;">
                                       <span>עדיין לא רכשת שום קורס!</span>
                                    </div>
                                 <?php }else{
                                    foreach ($orders as $key => $order_value) {
                                    $created_at = explode(' ',$order_value->created_at);
                                    $created_at = $created_at[0];
                                    ?>
                                    <div class="table-responsive">
                                    <table class="table">
                              <thead>
                                 <tr>
                                    <!-- <th>Owner Name</th> -->
                                    <th>בקש חידוש תוקף </th>
                                    <th>מחיר המוצר </th>
                                    <!-- <th>אופן התשלום </th> -->
                                    <th>תאריך הרכישה </th>
                                    <!-- <th>זְמַן </th> -->
                                    <!-- <th>פעולה </th> -->
                                    <th>שם המוצר</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <!-- <td>John Smith</td> -->
                                    <td><a href="javascript:void(0)" class="msg-snd">לשלוח הודעה</a></td>
                                    <td>{{$order_value->grand_total}}</td>
                                    <!-- <td>כרטיס אשראי </td> -->
                                    <td>{{($created_at)}}</td>
                                    <!-- <td>09:00 am</td> -->
                                    <!-- <td class="text-center"><i class="ti-trash"></i></td> -->
                                    <td>
                                    @if(isset($courses_name[$key]))
                                       {{ $courses_name[$key] }} 
                                    @endif
                                    </td>
                                 </tr>
                                   <?php }?>

                                 <?php }?> 
                                 
                              </tbody>
                           </table>
                        </div>
                        @if ($orders->lastPage() > 1) 
                           <ul class="pagination"> 
                              <li class="{{ ($orders->currentPage() == 1) ? 'disabled' : '' }}"> 
                                 <a href="{{ ($orders->currentPage() == 1) ? 'javascript:void(0)' : $orders->url(1) }}">Previous</a> 
                              </li> 
                              @for ($i = 1; $i <= $orders->lastPage(); $i++) 
                              <li class="{{ ($orders->currentPage() == $i) ? 'active' : '' }}"> 
                              <a href="{{ $orders->url($i) }}">{{ $i }}</a> 
                              </li> 
                           @endfor 
                              <li class="{{ ($orders->currentPage() == $orders->lastPage()) ? 'disabled' : '' }}">  
                                 <a href="{{ ($orders->currentPage() == $orders->lastPage()) ? 'javascript:void(0)' : $orders->url($orders->currentPage()+1) }}" >Next</a> 
                              </li> 
                           </ul> 
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
	@endsection	 
    @section('scripts')
      <script type="text/javascript">
         function readURL(input) {
         if (input.files && input.files[0]) {
         var reader = new FileReader();
         reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
         }
         reader.readAsDataURL(input.files[0]);
         }
         }
         $("#imageUpload").change(function() {
         readURL(this);
         });
      </script>
   @endsection