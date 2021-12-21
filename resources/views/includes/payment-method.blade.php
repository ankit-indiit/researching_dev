@extends('layouts.app')

@section('title', ' אמצעי תשלום   ')

@section('content')
<!-- Start Breadcrumb -->
<!-- <div class="breadcrumb-area" style="" >
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <h1>אמצעי תשלום </h1>
               <ul class="breadcrumb">
                  <li><a href="#"><i class="fas fa-home"></i> דף הבית</a></li>
                  <li><a href="#">עמודים</a></li>
                  <li class="active">אמצעי תשלום </li>
               </ul>
            </div>
         </div>
      </div>
   </div> -->

<div class="banner-inner-area2 pt8"></div>
<div class="breadcrumb-inner-area" style="">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <ul class="breadcrumb">
               <li><a href="#"><i class="fas fa-home"></i> דף הבית</a></li>
               <li><a href="#">עמודים</a></li>
               <li class="active">אמצעי תשלום </li>
            </ul>
         </div>
      </div>
   </div>
</div>

<!--    <div class="curvedown2">
	  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 220"><path fill="#0d0d3f" fill-opacity="1" d="M0,64L60,64C120,64,240,64,360,74.7C480,85,600,107,720,112C840,117,960,107,1080,90.7C1200,75,1320,53,1380,42.7L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>
   </div> -->

<!-- End Breadcrumb -->
   <div class="default-padding-lg1 sidebar_content-section bg-gray" style="direction: rtl">
      <div class="container">
         <form  action="{{ route('front.add_payment_cards') }}" class="mt-4" method="POST" id="card_details">
         <div class="col-md-4">
         @include('includes.profile-sidebar')
         </div>
         <div class="col-md-8">
            <div class="content-wraper profilewraper">
               <h3>אמצעי תשלום </h3>
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
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>הוסף שם בעל כרטיס </label>
                        <input type="text" id = "holder_name" name="holder_name" class="form-control" value="">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>מספר כרטיס </label>
                        <input type="text" name="ticket_number" id ="ticket_number" class="form-control" value="">
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
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>שנת תפוגה </label>
                        <select id = "expiry_year" name = "expiry_year" class="form-control">
                           <option value = "">בחר שנה </option>
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
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>הוסף CVV </label>
                        <input type="text" name="cvv_value" id = "cvv_value" class="form-control">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <button id = 'cancel_button' type ="button" class="btn circle btn-dark effect btn-md">לְבַטֵל </button>
                        <button type = "submit" class="btn circle btn-theme effect btn-md add-card-btn">הוסף כרטיס </button>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <?php 
         $counts = 0;
         $card_data = DB::table('card_details')->where('user_id',Auth::user()->id)->get();
         $counts = count($card_data);
      ?>
      @if($counts != 0 )
            <table class="table">
            <thead>
            <tr>
               <th>&nbsp;</th>
               <th>Card Type</th>
               <th>Card Holder</th>
               <th>Card Number</th>
               <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php
               foreach ($card_data as $value) {
                   $selected = ($value->is_default == 1 ? 'checked' :  '');
                   ?>
               <tr>
                  <?php if($value->is_default == 1){?>
                     <input type="hidden" name="card_id" id = "card_id" value = "{{$value->id}}" >
                  <?php }?>
               <td>
                  <input checked='{{$selected}}' type="radio" name="optradio" value = "{{$value->stripe_card_id}}">
               </td>
               <td>{{$value->card_type}}</td>
        <td>{{$value->card_holder_name}}</td>
        <td>xxxx{{$value->card_number}}</td>
        <td>
           <a  id ="delete_card" class="btndel" data-id="{{ $value->id }}"><i class="ti-close"></i></a>
        </td>
      </tr>  
      <?php  }?>
               </div>    
    </tbody>
  </table>
</div>
      @endif
            </div>
         </div>
      </form>
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
         $(document).ready(function(){
            $( "#card_details" ).validate({
            errorClass: 'errors',
            rules: {
            card_type: {
                required: true
            },
            holder_name: {
               required: true,
            },
            ticket_number: {
               required: true,
               creditcard: true
            },
            expiry_month: {
               required: true,
            },
            expiry_year: {
               required: true,
            },
            cvv_value: {
               required: true,
            },
        },
        messages: {
            card_type: {
                required: " אנא בחר סוג כרטיס.  "
            },
            holder_name: {
                required: " אנא הזן את שם בעל הכרטיס.  "
            },
            ticket_number: {
                required: " אנא הזן את מספר הכרטיס. ",
                creditcard:" נא להזין מספר כרטיס תקף  "
            },
            expiry_month: {
                required: " אנא בחר חודש תפוגת הכרטיס.  "
            },
            expiry_year: {
                required: " אנא בחר שנת תפוגת כרטיס.  "
            },
            cvv_value: {
                required: " אנא הזן cvv תקף. "
            },
        }
      });
            $("#cancel_button").click(function(){
               $("#card_details").trigger("reset");
            });
            $("#card_details").on('submit',function(event) {
               var isValid = $("#card_details").valid();
               if(isValid){
               event.preventDefault();
               var card_type = $('#card_type').val();
               var holder_name = $('#holder_name').val();
               var card_number = $('#ticket_number').val();
               var card_number = (card_number.trim());
               var expiry_month = $('#expiry_month').val();
               var expiry_year = $('#expiry_year').val();
               var cvv_number = $('#cvv_value').val();
               var card_id = $('#card_id').val();
               $.ajax({
               url: '{{ url("add_card") }}',
                  method:"POST",
                  data:{
                     card_type:card_type,
                     holder_name:holder_name,
                     card_number:card_number,
                     expiry_month:expiry_month,
                     expiry_year:expiry_year,
                     cvv_number:cvv_number,
                     card_id:card_id
                  },
                  success:function(data){
                     if (data.value.status == 1) { 
                       alert(data.value.msg);
                       window.location.reload();      
                  } else {
                     alert(data.value.msg);
                  }  
               }
            });
            }
            return false;
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
   });
      </script>
   @endsection