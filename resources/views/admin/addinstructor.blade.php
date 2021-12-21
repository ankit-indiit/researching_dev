@extends('admin.layouts.app')

@section('title', ' להוסיף מדריך ')
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
                  <li class="breadcrumb-item"><a href="{{route('admin.instructorlisting')}}">מַדְרִיך</a></li>
                  <li class="breadcrumb-item active">הוסף מדריך</li>
              </ol>
            </div>
            <h4 class="page-title">הוסף מדריך</h4>
          </div>
        </div>
      </div> 
<form method="POST" id = "add_instructor_form" action="{{ route('admin.saveinstructor') }}" enctype="multipart/form-data">
@csrf()
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">        
        <div class="row" style="direction:rtl">
          <div class="col-md-6 text-right">
            <h4 class="header-title mb-3">הוסף מדריך </h4>
          </div>
          <div class="col-md-6 text-left">
            <a href="{{route('admin.instructorlisting')}}" class="btn btn-primary  mb-3">חזרה למדריך</a>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class=" profile_user">
              <div class="card">
                <div class="card-body text-center">
                  <div class="user-image ">
                    <img id = "imagePreview" class="rounded-circle img-thumbnail" src="{{ asset('/assets/instructors/default.jpg') }}">
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
                    <input type="text" id="fname" name="instructor_fname" class="form-control" placeholder="הכנס את שמך הפרטי" >
                    <span class="text-danger error-text instructor_fname_err"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lname">שם משפחה</label>
                    <input type="text" id="lname" name ="instructor_lname" class="form-control" placeholder="הזן את Lname שלך" >
                    <span class="text-danger error-text instructor_lname_err"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="emailaddress">כתובת דוא"ל</label>
                    <input type="email" id="emailaddress" class="form-control" name = "instructor_email"placeholder="הזן את כתובת הדוא"ל שלך" >
                    <span class="text-danger error-text instructor_email_err"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="phoneno">מכשיר טלפון</label>
                    <input type="text" id="phoneno" class="form-control" name="instructor_phoneno" placeholder="הזן את מספר הטלפון שלך">
                    <span class="text-danger error-text instructor_phoneno_err"></span>
                  </div>
                </div>
                <?php 
                  $university_data = DB::table('universities')->get();
                ?>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="academic">מוֹסָד</label>
                    <select id="addinst_university" name="addinst_university" class="form-control" data-placeholder="שם האוניברסיטה או המכללה " required="required" >
                    <option value = "">שם האוניברסיטה או המכללה</option>
                    @foreach($university_data as $university)
                    <option value="{{ $university->id }}">{{ $university->university_name }}</option> 
                    @endforeach               
                  </select>
                  <span class="text-danger error-text addinst_university_err"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="degree">תוֹאַר</label>
                  <select id = "addinst_degree" name = "addinst_degree" data-placeholder="תוֹאַר " class="form-control" required="required"  >
                    <option value="">וֹאַר </option>    </select>
                    <span class="text-danger error-text addinst_degree_err"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="designation">יִעוּד</label>
                  <input type="text" id="designation" name="instructor_destiny" class="form-control" placeholder="יִעוּד">
                  <span class="text-danger error-text instructor_destiny_err"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="address">כתובת</label>
                  <input type="text" id="address" class="form-control" name="instructor_address" placeholder="כתובת" >
                  <span class="text-danger error-text instructor_address_err"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="instagram">אינסטגרם</label>
                  <input type="text" id="instagram" name = "instagram_link" class="form-control" placeholder="הזן את הקישור שלך" value="">
                  <span class="text-danger error-text instagram_link_err"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="linkedin">
                    linkedin
                  </label>
                  <input type="text" id="linkedin" name = "linkedin_link" class="form-control" placeholder="הזן את הקישור שלך" value="">
                  <span class="text-danger error-text linkedin_link_err"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="facebook">
                    facebook
                  </label>
                  <input type="text" id="facebook" name = "facebook_link" class="form-control" placeholder="הזן את הקישור שלך" value="">
                  <span class="text-danger error-text facebook_link_err"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="whatsapp">
                    whatsapp
                  </label>
                  <input type="text" id="whatsapp" name = "whatsapp_link" class="form-control" placeholder="הזן את הקישור שלך" value="">
                  <span class="text-danger error-text whatsapp_link_err"></span>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="qualification">qualification</label>
                  <textarea type="text" id="qualification" rows="2" name = "instructor_qualification" class="form-control" placeholder="qualification" ></textarea>
                  <span class="text-danger error-text instructor_qualification_err"></span>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="intro">תיאור</label>
                  <textarea type="text" id="intro" rows="3" name = "instructor_desc" class="form-control" placeholder="תיאור" ></textarea>
                  <span class="text-danger error-text instructor_desc_err"></span>
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-12 text-center">
                <button type="submit"  id = "addinstbtn" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                <button id = 'addinstreset' type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
              </div>
            </div>
          </div>
        </div> <!-- end card-->
      </div> <!-- end col-->
    </div>
  <!-- end row-->
</div> <!-- container -->
</div> <!-- content -->
</div>
</div>
</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#addinstreset').click(function(){
      window.location.href = '{{route("admin.instructorlisting")}}';
    });
        $('#addinst_university').change(function(){
           var university_id = $(this).val();
           $.ajax({
            url: '{{ route("front.getdegree") }}',
            type: 'POST',
            data: {
                university_id: university_id
            },
            success: function(data) {
              $('#addinst_degree').html('');
                $.each(data.degree_data, function(i, d) {
                    $('#addinst_degree').append('<option value="' + d.id + '">' + d.degree_name + '</option>');
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
      $("#addinstbtn").click(function(e) {
        e.preventDefault();
         var fd = new FormData();
          var files = $('#user-img')[0].files;
          if(files.length > 0 ){
            fd.append('file',files[0]);
          }
        $.ajax({
            url: '{{ route("admin.saveinstructor") }}',
            type: 'POST',
            data:new FormData($("#add_instructor_form")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
            success: function(response) {
                if ($.isEmptyObject(response.error)) {
                    window.location.href = '{{route("admin.instructorlisting")}}';
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