@extends('admin.layouts.app')

@section('title', ' הוסף משתמש   ')
@section('content')
<?php 
$is_logged_in = session()->get('admin_logged_in');
        
if(!isset($is_logged_in) && $is_logged_in != '1'){
            
    return redirect()->route('admin.adminLogin')->send();
        }

?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">בית</a></li>
                                <li class="breadcrumb-item"><a href="{{route('admin.userslisting')}}">משתמשים</a></li>
                                <li class="breadcrumb-item active">הוסף משתמש</li>
                            </ol>
                        </div>
                        <h4 class="page-title">הוסף משתמש</h4>
                    </div>
                </div>
            </div> 
<form method="POST" id = "add_user_form" action="{{ route('admin.saveuser') }}" enctype="multipart/form-data">
@csrf()
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="direction:rtl">
                        <div class="col-md-6 text-right">
                            <h4 class="header-title mb-3">הוסף משתמש </h4>
                        </div>
                        
                    <div class="col-md-6 text-left">
                        <a href="{{route('admin.userslisting')}}" class="btn btn-primary  mb-3">בחזרה למשתמשים</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class=" profile_user">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="user-image ">
                                        <img id = "imagePreview" class="rounded-circle img-thumbnail" src="{{ asset('/assets/users/default.jpg') }}">
                                        <label for="user-img">העלאת תמונה</label>
                                        <input id="user-img" name="user-img" style="display:none" type="file">
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
                                    <label for="fname">שם פרטי</label>
                                    <input type="text" id="fname" name = "adduser_fname" class="form-control" placeholder="הכנס את שמך הפרטי" >
                                    <span class="text-danger error-text adduser_fname_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lname">שם משפחה</label>
                                    <input type="text" name = "adduser_lname" id="lname" class="form-control" placeholder="הזן את Lname שלך" >
                                    <span class="text-danger error-text adduser_lname_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emailaddress">כתובת דוא"ל</label>
                                    <input type="email" name ="adduser_email" id="emailaddress" class="form-control" placeholder="הזן את כתובת הדוא"ל שלך" >
                                    <span class="text-danger error-text adduser_email_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phoneno">מכשיר טלפון</label>
                                    <input type="text" name = "adduser_phoneno"id="phoneno" class="form-control" placeholder="הזן את מספר הטלפון שלך">
                                    <span class="text-danger error-text adduser_phoneno_err"></span>
                                </div>
                            </div>
                            <?php 
                                $university_data = DB::table('universities')->get();
                            ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="academic">מוֹסָד</label>
                                    <select id="adduser_university" name="adduser_university" class="form-control" data-placeholder="שם האוניברסיטה או המכללה " required="required" >
                                        <option value = "">שם האוניברסיטה או המכללה</option>
                                            @foreach($university_data as $university)
                                                <option value="{{ $university->id }}">{{ $university->university_name }}</option> 
                                            @endforeach               
                                    </select>
                                    <span class="text-danger error-text adduser_university_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="degree">תוֹאַר</label>
                                    <select id = "adduser_degree" name = "adduser_degree" data-placeholder="תוֹאַר " class="form-control" required="required"  >
                                        <option value="">וֹאַר </option>        
                                    </select>
                                    <span class="text-danger error-text adduser_degree_err"></span>
                                </div>
                            </div>
                        </div>
                        <h4 class="headsub">
                            פרופיל חברתי.
                        </h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="facebookurl">
                                        כתובת אתר בפייסבוק
                                    </label>
                                    <input type="text" name = "facebookurl" id="facebookurl" class="form-control" placeholder="הזן את כתובת האתר שלך לפרופיל בפייסבוק.">
                                    <span class="text-danger error-text facebookurl_err"></span>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="linkedinurl">
                                        כתובת אתר של לינקדאין
                                    </label>
                                    <input type="text" name = "linkedinurl" id="linkedinurl" class="form-control" placeholder="הזן את כתובת ה- linkedIn שלך.">
                                    <span class="text-danger error-text linkedinurl_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="twitterurl">
                                        כתובת אתר בטוויטר
                                    </label>
                                    <input type="text" name = "twitterurl" id="twitterurl" class="form-control" placeholder="הזן את כתובת ה- Twitter שלך.">
                                    <span class="text-danger error-text twitterurl_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="youtubeurl">
                                        כתובת אתר של YouTube
                                    </label>
                                    <input type="text" name = "youtubeurl" id="youtubeurl" class="form-control" placeholder="הזן את כתובת האתר שלך ב- YouTube.">
                                    <span class="text-danger error-text youtubeurl_err"></span>
                                </div>
                            </div>
                        </div>
                        <h4 class="headsub">שנה סיסמא</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="newpassword">סיסמה חדשה</label>
                                    <input type="password" name = "adduser_newpass" id="newpassword" class="form-control" placeholder="הכנס סיסמה חדשה">
                                    <span class="text-danger error-text adduser_newpass_err"></span>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="confirmnewpassword">תאשר סיסמא חדשה</label>
                                    <input type="password" name = "adduser_confirmpass" id="confirmnewpassword" class="form-control" placeholder="הזן את סיסמתך האישור החדשה">
                                    <span class="text-danger error-text adduser_confirmpass_err"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <button id = "saveuser_btn" type="submit" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                                <button id ="backbtn" type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->
    </div> <!-- container -->
</div> <!-- content -->
</form>
</div>
</div>    
</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#backbtn').click(function(){
      window.location.href = '{{route("admin.userslisting")}}';
    });
        $('#adduser_university').change(function(){
           var university_id = $(this).val();
           $.ajax({
            url: '{{ route("front.getdegree") }}',
            type: 'POST',
            data: {
                university_id: university_id
            },
            success: function(data) {
              $('#adduser_degree').html('');
                $.each(data.degree_data, function(i, d) {
                    $('#adduser_degree').append('<option value="' + d.id + '">' + d.degree_name + '</option>');
                });
              }
          });

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
      $("#saveuser_btn").click(function(e) {
        e.preventDefault();
         var fd = new FormData();
          var files = $('#user-img')[0].files;
          if(files.length > 0 ){
            fd.append('file',files[0]);
          }
        $.ajax({
            url: '{{ route("admin.saveuser") }}',
            type: 'POST',
            data:new FormData($("#add_user_form")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
            success: function(response) {
                if ($.isEmptyObject(response.error)) {
                    window.location.href = '{{route("admin.userslisting")}}';
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
    });
</script>
@endsection