@extends('admin.layouts.app')

@section('title', ' מדריך עריכה ')
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
                <li class="breadcrumb-item active">ערוך מדריך</li>
              </ol>
            </div>
            <h4 class="page-title">ערוך מדריך</h4>
          </div>
        </div>
      </div> 

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row" style="direction:rtl">
                <div class="col-md-6 text-right">
                  <h4 class="header-title mb-3">ערוך מדריך </h4>
                </div>
                <div class="col-md-6 text-left">
                  <a href="{{route('admin.instructorlisting')}}" class="btn btn-primary  mb-3">חזרה למדריך</a>
                </div>
              </div>
<form method="POST" id = "edit_instructor_form" action="{{ route('admin.updateinstructor') }}" enctype="multipart/form-data">
@csrf()
<input type="hidden" name="instructor_id" id ="instructor_id" value ="{{$instructor->id}}">
<?php
  $university_data = DB::table('universities')->get();
  $image =  asset('/assets/users/' .$instructor->avatar);
  ?>
  <div class="row">
    <div class="col-lg-4">
      <div class=" profile_user">
        <div class="card">
          <div class="card-body text-center">
            <div class="user-image ">
              <img class="rounded-circle img-thumbnail userPreview" src="{{ $image }}">
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
            <input type="text" id="instructor_fname" name="instructor_fname" class="form-control" placeholder="הכנס את שמך הפרטי" value="{{$instructor->first_name}}">
            <span class="text-danger error-text instructor_fname_err"></span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="lname">שם משפחה</label>
            <input type="text" id="instructor_lname" name="instructor_lname" class="form-control" placeholder="הזן את Lname שלך" value="{{$instructor->last_name}}">
            <span class="text-danger error-text instructor_lname_err"></span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="emailaddress">כתובת דוא"ל</label>
            <input type="email" id="instructor_email" name="instructor_email" class="form-control" placeholder="הזן את כתובת הדוא"ל שלך" value="{{$instructor->email}}">
            <span class="text-danger error-text instructor_email_err"></span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="phoneno">מכשיר טלפון</label>
            <input type="text" id="instructor_phoneno" name="instructor_phoneno" class="form-control" placeholder="הזן את מספר הטלפון שלך" value="{{$instructor->contact_number}}">
            <span class="text-danger error-text instructor_phoneno_err"></span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="academic">מוֹסָד</label>
            <select id="instructor_university" name="instructor_university" type="text" class="form-control">
              <option >בחר</option>
              @foreach($university_data as $university)
              <option value="{{ $university->id }}" {{$university->id == $instructor->university  ? 'selected' : ''}}>{{ $university->university_name }}</option> 
              @endforeach 
            </select>
            <span class="text-danger error-text instructor_university_err"></span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <?php if((!empty($degree_id)) && (!empty($degree_name))){?>
            <input type="hidden" id="instructor_degree_id" value ="{{$degree_id}}">
            <input type="hidden" id="instructor_degree_name" value ="{{$degree_name}}">
            <?php }else{?>
            <input type="hidden" id="instructor_degree_id" value ="">
            <input type="hidden" id="instructor_degree_name" value ="">
            <?php }?>
              <label for="degree">תוֹאַר</label>
              <select id = "instructor_degree" name = "instructor_degree" data-placeholder="תוֹאַר " class="form-control" required="required"  >
                <option value="">וֹאַר </option>
              </select>
              <span class="text-danger error-text instructor_degree_err"></span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="designation">יִעוּד</label>
              <input type="text" id="instructor_designation" name="instructor_designation" class="form-control" placeholder="יִעוּד" value="{{$instructor->destiny}}">
              <span class="text-danger error-text instructor_designation_err"></span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="address">כתובת</label>
              <input type="text" id="instructor_address" name="instructor_address" class="form-control" placeholder="כתובת" value="{{$instructor->address}}">
              <span class="text-danger error-text instructor_address_err"></span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="instagram">אינסטגרם</label>
              <input type="text" id="instagram" name = "instagram" class="form-control" placeholder="הזן את הקישור שלך" value="{{$instructor->insta_link}}">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="linkedin">
                    linkedin
              </label>
              <input type="text" id="linkedin" name = "linkedin_link" class="form-control" placeholder="הזן את הקישור שלך" value="{{$instructor->linkedin_link}}">
          </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="facebook">
                    facebook
              </label>
              <input type="text" id="facebook" name = "facebook_link" class="form-control" placeholder="הזן את הקישור שלך" value="{{$instructor->facebook_link}}">    
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="whatsapp">
                    whatsapp
              </label>
              <input type="text" id="whatsapp" name = "whatsapp_link" class="form-control" placeholder="הזן את הקישור שלך" value="">
              </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="qualification">qualification</label>
              <textarea type="text" id="instructor_qualification" rows="2" name = "instructor_qualification" class="form-control" placeholder="qualification" >{{$instructor->qualification}}</textarea>
              <span class="text-danger error-text instructor_qualification_err"></span>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
            <label for="intro">תיאור</label>
            <textarea type="text" id="intro" rows="3" name = "instructor_desc" class="form-control" placeholder="תיאור" >{{$instructor->about}}</textarea>
            <span class="text-danger error-text instructor_desc_err"></span>
            </div>      
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12 text-center">
            <button type="button" id="insteditbtn" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
            <button type="button" id="reset_instructor" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
          </div>
        </div>
      </div>
    </div> <!-- end card-->
  </form>
            </div> <!-- end col-->
          </div><!-- end row-->
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
    $('.basic-datatable ').DataTable();
     $('#reset_instructor').click(function(){
       window.location.href = '{{route("admin.instructorlisting")}}';
     });
     function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
        $('.userPreview').attr('src', e.target.result);
        $('.userPreview').hide();
        $('.userPreview').fadeIn(650);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  $("#user-img").change(function() {
    readURL(this);
  });
  var degree_id = $('#instructor_degree_id').val();
  var degree_name = $('#instructor_degree_name').val();
  $('#instructor_degree').append('<option selected value="' + degree_id + '">' + degree_name + '</option>');
       $("#insteditbtn").click(function(e) {
         e.preventDefault();
          var fd = new FormData();
           var files = $('#user-img')[0].files;
           if(files.length > 0 ){
             fd.append('file',files[0]);
           }
         $.ajax({
             url: '{{ route("admin.updateinstructor") }}',
             type: 'POST',
             data:new FormData($("#edit_instructor_form")[0]),
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
         
             $('#instructor_university').change(function(){
           var university_id = $(this).val();
           $.ajax({
             url: '{{ route("front.getdegree") }}',
             type: 'POST',
             data: {
                 university_id: university_id
             },
             success: function(data) {
               $('#instructor_degree').html('');
                 $.each(data.degree_data, function(i, d) {
                     $('#instructor_degree').append('<option value="' + d.id + '">' + d.degree_name + '</option>');
                 });
               }
           });
         });
         });
</script>
@endsection
    