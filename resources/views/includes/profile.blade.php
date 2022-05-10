@extends('layouts.app')

@section('title', ' פּרוֹפִיל ') 

@section('content')
  <!-- Start Breadcrumb -->
<!-- <div class="breadcrumb-area" style="" >
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12">
           <h1>פּרוֹפִיל  </h1>
            <ul class="breadcrumb">
               <li><a href="#"><i class="fas fa-home"></i> דף הבית</a></li>
               <li><a href="#">עמודים</a></li>
               <li class="active">פּרוֹפִיל </li>
            </ul>
         </div>
      </div>
   </div>
</div>
<div class="curvedown2">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 220"><path fill="#0d0d3f" fill-opacity="1" d="M0,64L60,64C120,64,240,64,360,74.7C480,85,600,107,720,112C840,117,960,107,1080,90.7C1200,75,1320,53,1380,42.7L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>
</div> -->


<div class="banner-inner-area2 pt8"></div>
<div class="breadcrumb-inner-area" style="">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12">
          <ul class="breadcrumb">
             <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> דף הבית</a></li>
             <li><a href="#">עמודים</a></li>
             <li class="active"><a href="{{ route(Route::currentRouteName())}}">התראות </a></li>
          </ul>
       </div>
    </div>
  </div>
</div>

      <!-- End Breadcrumb -->
<form method="POST" id="profile_form" action = "{{ route('front.home.update') }}" enctype="multipart/form-data">
  @csrf()
      <div class="default-padding-lg1 sidebar_content-section bg-gray proMob" style="direction: rtl;">
         <div class="container">
            <div class="col-md-4">
              @include('includes.profile-sidebar')
            </div>
            <div class="col-md-8">
               <div class="content-wraper profileicons">
                  <h3> פרטי המשתמש       </h3>
                  <div class="row">
                  <div class="col-md-6">
                        <div class="form-group">
                           <label>שם משפחה  </label>
                           <input id="profile_last_name" type="text" class="form-control " placeholder=" שם משפחה   " name="profile_last_name" value="{{$user->last_name}}"autocomplete="profile_last_name" required />
                           <span class="text-danger error-text profile_last_name_err"></span>
                           <i class="fa fa-user"></i>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>שם פרטי </label>
                           <input id="profile_first_name" type="text" class="form-control " placeholder=" שם פרטי   " name="profile_first_name" value="{{$user->first_name}}"autocomplete="profile_first_name" required/>
                           <span class="text-danger error-text profile_first_name_err"></span>
                          <i class="fa fa-user"></i>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>אימייל </label>
                           <input type="email" id="profile_email" class="form-control " placeholder=" אימייל   " name="profile_email" value="{{$user->email}}"autocomplete="profile_email" required />
                           <span class="text-danger error-text profile_email_err"></span>
                          <i class="fa fa-envelope"></i>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>מספר טלפון </label>
                            <input type="text" id="profile_phone_number" class="form-control " placeholder=" מספר טלפון   " name="profile_phone_number" value="{{$user->contact_number}}" required />
                            <span class="text-danger error-text profile_phone_number_err"></span>
                         <i class="fa fa-phone"></i>
                        </div>
                     </div>
                     <!--  <div class="col-md-6">
                        <div class="form-group">
                           <label>DOB</label>
                           <input type="text" name="" class="form-control" value="20/05/1994">
                        </div>
                        </div> -->
                     <!--div class="col-md-12">
                        <div class="form-group">
                           <label>מִקוּד </label>
                           <input type="text" name="" class="form-control" value="12345">
                        </div>
                     </div-->

                     {{-- <div class="col-md-12">
                        <div class="form-group">
                           <textarea class="form-control" name="profile_description" rows="5" placeholder="תיאור">{{ $user->description }}</textarea>
                           <i class="fa fa-file filetop" aria-hidden="true"></i>
                        </div>
                     </div> --}}

                     <?php 
                    $university_data = DB::table('universities')->get();
                    ?>
					   
					           <div class="col-md-6">
                        <div class="form-group">
                          <?php if((!empty($degree_id)) && (!empty($degree_name))){?>
                          <input type="hidden" id="profile_degree_id" value ="{{$degree_id}}">
                          <input type="hidden" id="profile_degree_name" value ="{{$degree_name}}">
                        <?php }else{?>
                          <input type="hidden" id="profile_degree_id" value ="">
                          <input type="hidden" id="profile_degree_name" value ="">
                        <?php }?>
                      <select id = "profile_degree" name = "profile_degree" data-placeholder="תוֹאַר " class="form-control" required="required"  >
                        <option value="">וֹאַר </option>        
                      </select>
                      <span class="text-danger error-text profile_degree_err"></span>
                       <i class="fa fa-graduation-cap"></i>
                    </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                      <select id="profile_university" name="profile_university" class="form-control" data-placeholder="שם האוניברסיטה או המכללה " required="required" >
                        <option value = "">שם האוניברסיטה או המכללה</option>
                        @foreach($university_data as $university)
                        <option value="{{ $university->id }}" {{$university->id == $user->academic_institution  ? 'selected' : ''}}>{{ $university->university_name }}</option> 
                        @endforeach               
                      </select>
                      <span class="text-danger error-text profile_university_err"></span>
                       <i class="fa fa-building"></i>
                    </div>
                     </div>
                    <div class="col-md-12 buttonFlex">
                      <div class="form-group mb-0">
                        <button id= "profile_submit" type = 'submit' class="btn circle btn-theme effect btn-md">שמור שינויים </button>
                        <!-- <a  class="btn btn-link updatepwd pull-left pl-0"  href="#passwordModal" data-toggle="modal"> עדכן סיסמה  </a> -->
                      </div>
                      <div class="form-group">
                        <button id= "forgot_password" type = "button" class="btn circle btn-theme forgot_password effect btn-md">שנה סיסמא
                      </button>
                      </div>
                    </div>

                  </div>
                </form>
                <form method="POST" id = "password_form" action="{{ route('front.home.password') }}" enctype="multipart/form-data">
          @csrf()
              <h3>שנה סיסמא </h3>
              <div class="alert alert-danger" id ="password_error" style="display:none">
                    <ul></ul>
                  </div>
              <div class="row" style="direction: rtl;">
                <div class="col-md-6">
                  <div class="form-group">
                     <label> סיסמה ישנה  </label>
                     <input id = "old_password" type="Password" class="form-control"
                     placeholder=" סיסמה ישנה  " name="old_password" value="" />
                     <span class="text-danger error-text old_password_err"></span>
                    <i class="fa fa-lock"></i>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label> סיסמה חדשה  </label>
                    <input id = "new_password" type="Password" class="form-control " placeholder=" סיסמה חדשה  " name="new_password" value="" />
                    <span class="text-danger error-text new_password_err"></span>
                      <i class="fa fa-lock"></i>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label> אשר סיסמה   </label>
                    <input id = "confirm_password" type="Password" class="form-control " placeholder=" אשר סיסמה   " name="confirm_password" value="" />
                    <span class="text-danger error-text confirm_password_err"></span>
                    <i class="fa fa-lock"></i>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <button id= "password_submit" type = 'submit' class="btn circle btn-theme effect btn-md"> לְאַשֵׁר  </button>
                  </div>
                </div>
              </div>
          </form>
                </div>

          </div>
        </div>
      </div>
        <!-- <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
        
        <!-- </div> -->
     @endsection 
    @section('scripts')
      <script type="text/javascript">
      
      $(document).ready(function() {
        var image = '';
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
      $("#imageupload").change(function() {
        readURL(this);
      });
    //   $('input[name="avatar"]').change(function(event) {
    //     image_file = event.target.files;
    //     alert(image_file);
    //     $('#changed_image').val(image_file[0].name);
    // });
        var degree_id = $('#profile_degree_id').val();
        var degree_name = $('#profile_degree_name').val();
        $('#profile_degree').append('<option selected value="' + degree_id + '">' + degree_name + '</option>');
        $("#profile_submit").click(function(e) {
        e.preventDefault();
         var fd = new FormData();
          var files = $('#imageupload')[0].files;
          if(files.length > 0 ){
            fd.append('file',files[0]);
          }
        // var profile_first_name = $("input[name='profile_first_name']").val();
        // var profile_last_name = $("input[name='profile_last_name']").val();
        // var profile_email = $("input[name='profile_email']").val();
        // var profile_phone_number = $("input[name='profile_phone_number']").val();
        // var university = $('#profile_university').val();
        // var degree = $('#profile_degree').val();
        // var avatar =  $('input[name=avatar]').val();
        // var image = $('#changed_image').val();
        $.ajax({
            url: '{{ route('front.home.update') }}',
            type: 'POST',
            data:new FormData($("#profile_form")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
            // data: {
            //     profile_first_name:profile_first_name,
            //     profile_last_name:profile_last_name,
            //     profile_email: profile_email,
            //     profile_phone_number: profile_phone_number,
            //     university:university,
            //     degree:degree,
            //     avatar:avatar
            // },
            success: function(response) {
                if ($.isEmptyObject(response.error)) {
                    window.location.reload();
                } else {
                    printErrorMsg(response.error);
                }
              }
            });
      });
        function printErrorMsg (msg) {
           $.each( msg, function( key, value ) {
              $('.'+key+'_err').text(value);
            });
        }
        $('#profile_university').change(function(){
          var university_id = $(this).val();
          $.ajax({
            url: '{{ route('front.getdegree') }}',
            type: 'POST',
            data: {
                university_id: university_id
            },
            success: function(data) {
              $('#profile_degree').html('');
                $.each(data.degree_data, function(i, d) {
                    $('#profile_degree').append('<option value="' + d.id + '">' + d.degree_name + '</option>');
                });
              }
          });
        });
        $("#password_submit").click(function(e) {
        e.preventDefault();
        var old_password = $("input[name='old_password']").val();
        var new_password = $("input[name='new_password']").val();
        var confirm_password = $("input[name='confirm_password']").val();
        $.ajax({
            url: '{{ route('front.home.password') }}',
            type: 'POST',
            data: {
                old_password:old_password,
                new_password:new_password,
                confirm_password: confirm_password
            },
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                     window.location.href = '/home';
                } else {
                    printErrorMsg1(data.error);
                }
              }
            });
      });
        function printErrorMsg1 (msg) {
           $.each( msg, function( key, value ) {
              $('.'+key+'_err').text(value);
            });
        }
      });
      
 
</script>
@endsection 