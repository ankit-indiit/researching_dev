@extends('layouts.app')
@section('title', 'שותפים')
@section('content')
<!-- Start Breadcrumb  -->
<div class="banner-inner-area2 pt8"></div>
<div class="breadcrumb-inner-area mb50" style="">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <ul class="breadcrumb">
               <li><a href="{{ Url('/') }}"><i class="fas fa-home"></i> דף הבית</a></li>
               <li class="active"><a href="{{ Route('front.affiliate') }}"> שותפים </a></li>
            </ul>
         </div>
      </div>
   </div>
</div>
<div class="referfriend default-padding-lg" style="direction:rtl">
    <div class="container">
       <div class="row">
          <div class="referimg">
             <img src="assets/img/Refer.png">
          </div>
          <div class="site-heading text-center mb-20">
             <h2>הפנה חבר</h2>
             <p>שתף קוד הפניה עם חבריך, חברך יקבל 10% הנחה ברכישה ותקבל 10% הנחה ברכישה הבאה שלך לקורסים</p>
          </div>
          <div class="form-group mb-0">
             <div class="input-group">
                <input type="text" class="form-control" id="copyTextInput" readonly="" value="{{ Auth::user()->reffer_code }}">
                <a href="javascript:void(0)" class="input-group-addon"  onclick="copyText()">
                העתק קישור
                </a> 
             </div>
          </div>
       </div>
    </div>
</div>
<div class="userspurchased pt-80 pb-80">
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <div class="site-heading text-center mb-20">
                <h2>משתמשי ההפניה שלך</h2>
                <p>מידע על משתמשים הפניה שהשתמשו בקוד וקיבלו הנחה ברכישה</p>
             </div>
          </div>
         @if(count($all_refferels) > 0)
            @foreach ($all_refferels as $user)
            <div class="col-md-4 referraluser  wow fadeInLeftBig  mt-30" >
               <div class="referraluser-main text-center">
                  <div class="referraluser-img text-center">
                     <a href="#">
                     <img src="{{ asset('assets/users') }}/{{$user->affiliateUser->avatar}}">
                     </a>
                     <span class="userdiscount">₪{{ $user->discount }}</span>
                  </div>
                  <div class="referraluser-info text-center">
                     <h2 class="mb-0"> {{ $user->affiliateUser->full_name }} </h2>
                     <span class="userdate"><i class="ti-calendar"></i> {{ $user->created_at->format('d M Y') }} </span>
                  </div>
               </div>
            </div>                
            @endforeach
         @else
         <div class="col-md-12">
            <div class="alert alert-dark text-center" role="alert">
               לא נמצא משתמש הפניה!
            </div>
         </div>  
         @endif    
      </div>
    </div>
 </div>
@endsection
@section('scripts')
<script type="text/javascript">
   $(document).ready(function(){

   });
   
   function copyText(){
         var copyText = document.getElementById("copyTextInput");
         copyText.select();
         copyText.setSelectionRange(0, 99999)
         document.execCommand("copy");
         alert("Copied the reffer code: " + copyText.value);         
   }   
</script>
@endsection