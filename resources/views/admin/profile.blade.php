@extends('admin.layouts.app')

@section('title', ' פּרוֹפִיל ')
@section('content')
<?php 
$is_logged_in = session()->get('admin_logged_in');
        
if(!isset($is_logged_in) && $is_logged_in != '1'){
            
    return redirect()->route('admin.adminLogin')->send();
        }

?>
<div class="content-page">
    <div class="content"><!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">בית</a></li>
                                <li class="breadcrumb-item active">פּרוֹפִיל</li>
                            </ol>
                        </div>
                        <h4 class="page-title">פּרוֹפִיל</h4>
                    </div>
                </div><!-- start page title -->
            </div><!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <h4 class="header-title mb-3">הגדרות פרופיל</h4>
                        </div>
                    </div>
            <form method="POST" id="admin_profile_form" action = "{{ route('admin.update_profile') }}" enctype="multipart/form-data">
            @csrf()
            <div class="row">
              <div class="col-lg-4">
                <div class=" profile_user">
                <?php 
                  $admin_id = session()->get('id');
                  $admin_data = DB::table('admins')->where('id',$admin_id)->get();
                  foreach ($admin_data as $value) {
                   $image =  asset('/assets/users/' .$value->image);
                ?>
                <div class="card">
                  <div class="card-body text-center">
                    <div class="user-image ">
                      <img id ="imagePreview" class="rounded-circle img-thumbnail" src="{{$image}}">
                      <label for="user-img">העלאת תמונה</label>
                      <input id="user-img" name="user-img" style="display:none" type="file" name ="file">
                    </div>
                  </div>
                </div>
              </div>
            </div> 
            <div class="col-lg-8">
              <h4 class="headsub">מידע בסיסי</h4>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="fullname">שם מלא</label>
                      <input type="text" id="fullname" name="admin_name" class="form-control" placeholder="הכנס את שמך המלא" value="{{$value->name}}">
                      <span class="text-danger error-text admin_name_err"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="emailaddress">כתובת דוא"ל</label>
                      <input type="email" id="emailaddress" name = "admin_email" class="form-control" placeholder="הזן את כתובת הדוא"ל שלך" value="{{$value->email}}">
                      <span class="text-danger error-text admin_email_err"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="phoneno">בטלפון.</label>
                      <input type="text" id="phoneno" name="admin_phone" class="form-control" placeholder="הזן את מספר הטלפון שלך" value="{{$value->phone_number}}">
                      <span class="text-danger error-text admin_phone_err"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="address">כתובת</label>
                      <input type="text" id="address" name ="address" class="form-control" placeholder="הזן את הכתובת שלך" value="{{$value->address}}">
                      <span class="text-danger error-text address_err"></span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="country">מדינה</label>
                      <select id="country" name="country" class="form-control" data-placeholder="select country" >
                        <option value = "">select country</option>
                        @foreach($countries as $country)
                        <option value="{{ $country->name}}" {{$country->name == $value->country  ? 'selected' : ''}}>{{ $country->name}}</option> 
                        @endforeach               
                      </select>
                      <span class="text-danger error-text country_err"></span>
                    </div>
                  </div>
                  <div class="col-12 text-center">
                    <button id ="adminbtn" type="submit" class="btn btn-primary waves-effect waves-light m-1" ><i class="fe-check-circle mr-1"></i> שלח</button>
                    <button  type="button" class="btn btn-light waves-effect waves-light m-1 profile_reset"><i class="fe-x mr-1"></i> לְבַטֵל</button>
                  </div>
                </div>
              </div>
              <?php }?>
            </div>
          </form>
          <form method="POST" id = "admin_password_form" action="{{ route('admin.update_password') }}" enctype="multipart/form-data">
          @csrf()
          <div class="col-lg-8 offset-4">
            <h4 class="headsub">שנה סיסמא</h4>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="oldpassword">סיסמה ישנה</label>
                  <input type="password" id="oldpassword" name ="old_password" class="form-control" placeholder="הזן את הסיסמה הישנה שלך">
                  <span class="text-danger error-text old_password_err"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="newpassword">סיסמה חדשה</label>
                  <input type="password" id="newpassword" name ="new_password" class="form-control" placeholder="הכנס סיסמה חדשה">
                  <span class="text-danger error-text new_password_err"></span>
                </div>
              </div> 
              <div class="col-md-6">
                <div class="form-group">
                  <label for="confirmnewpassword">תאשר סיסמא חדשה</label>
                  <input type="password" id="confirmnewpassword" name="confirm_password" class="form-control" placeholder="הזן את סיסמתך האישור החדשה">
                  <span class="text-danger error-text confirm_password_err"></span>
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-12 text-center">
                <button id ="admin_password_submit" type="submit"  class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                <button type="button" class="btn btn-light waves-effect waves-light m-1 profile_reset"><i class="fe-x mr-1"></i> לְבַטֵל</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div> <!-- end card-->
  </div> <!-- end col-->
</div>
<!-- end row-->
</div> <!-- container -->
</div> <!-- content -->
</div><!--content page ends-->

<!-- END wrapper -->
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
       $('.profile_reset').click(function(){
      window.location.href = '{{route("admin.dashboard")}}';
    });
        var image = '';
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
            $('#imagePreview').attr('src', e.target.result);
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
          }
          reader.readAsDataURL(input.files[0]);
        }
      }
      $("#user-img").change(function() {
        readURL(this);
      });
      $("#adminbtn").click(function(e) {
        e.preventDefault();
         var fd = new FormData();
          var files = $('#user-img')[0].files;
          if(files.length > 0 ){
            fd.append('file',files[0]);
          }
        $.ajax({
            url: '{{ route("admin.update_profile") }}',
            type: 'POST',
            data:new FormData($("#admin_profile_form")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
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

        $("#admin_password_submit").click(function(e) {
        e.preventDefault();
        var old_password = $("input[name='old_password']").val();
        var new_password = $("input[name='new_password']").val();
        var confirm_password = $("input[name='confirm_password']").val();
        $.ajax({
            url: '{{ route("admin.update_password") }}',
            type: 'POST',
            data: {
                old_password:old_password,
                new_password:new_password,
                confirm_password: confirm_password
            },
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                     window.location.reload();
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