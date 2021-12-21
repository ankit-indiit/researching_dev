@extends('admin.layouts.app')

@section('title', ' להוסיף מוצר ')
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
                                <li class="breadcrumb-item"><a href="{{route('admin.productslisting')}}">מוֹסָד</a></li>
                                <li class="breadcrumb-item"><a href="{{route('admin.degreeslisting').'/'.$university_id}}">תוֹאַר</a></li>
                                <li class="breadcrumb-item "><a href="{{route('admin.Productslisting').'/'.$degree_id.'/'.$university_id}}">מוצרים</a></li>
                                <li class="breadcrumb-item active">הוסף מוצר</li>
                            </ol>
                        </div>
                        <h4 class="page-title">הוסף מוצר</h4>
                    </div>
                </div>
            </div> 
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="row" style="direction:rtl">
          <div class="col-md-6 text-right">
            <h4 class="header-title mb-3">הוסף מוצר</h4>
          </div>
          <div class="col-md-6 text-left">
            <a href="{{route('admin.Productslisting').'/'.$degree_id.'/'.$university_id}}" class="btn btn-primary  mb-3">חזרה למוצרים</a>
          </div>
        </div>
<form method="POST" id = "add_course_form" action="{{ route('admin.saveproduct') }}" enctype="multipart/form-data">
@csrf()

<div class="row">
  <div class="col-lg-12">
  <?php 
    $university_data = DB::table('universities')->get();
  ?>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="Instutename">שם מוסד</label>
          <select id="add_university" name="add_university" class="form-control" data-placeholder=" בחר במכון" required="required" >
            <option value = "">
              בחר במכון
            </option>
            @foreach($university_data as $university)
                @if($university_id == $university->id)
                    <option value="{{ $university->id }}" selected >{{ $university->university_name }}</option>   
                @else
                    <option value="{{ $university->id }}">{{ $university->university_name }}</option> 
                @endif
            @endforeach               
          </select>
          <span class="text-danger error-text add_university_err"></span>
      </div>
    </div>
    <?php 
      $degrees_data = DB::table('degrees')->get();
    ?>
        <div class="col-md-6">
        <div class="form-group">
          <label for="degree">תוֹאַר</label>
            <select id="add_degree" name="add_degree" class="form-control" data-placeholder="חר את התואר" required="required" >
              <option value = "">
                בחר את התואר
              </option>
                @foreach($degrees_data as $degree)
                    @if($degree_id == $degree->id)
                        <option value="{{ $degree->id }}" selected>{{ $degree->degree_name }}</option> 
                    @else
                    <option value="{{ $degree->id }}">{{ $degree->degree_name }}</option> 
                    @endif
                @endforeach               
            </select>
            <span class="text-danger error-text add_degree_err"></span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="prducttype">סוג המוצר</label>
              <select class="form-control" name ="prducttype" id="prducttype" placeholder="חר את סוג הקורס
">
                <option value = "">
                  בחר את סוג הקורס
                </option>
                <option value ="0">
                                                         קורס מקוון
                </option>
                <option value ="1">
                                                       למידה אינטנסיבית
                </option>
              </select>
              <span class="text-danger error-text prducttype_err"></span>
            </div>
          </div> 
        <?php 
          $instructors_data = DB::table('instructors')->get();
        ?>
        <div class="col-md-6">
          <div class="form-group">
            <label for="instructorname">מַדְרִיך</label>
              <select id="add_instructor" name="add_instructor" class="form-control" data-placeholder="שם האוניברסיטה או המכללה<" required="required" >
                <option value = "">שם האוניברסיטה או המכללה</option>
                @foreach($instructors_data as $instructor)
                  <option value="{{ $instructor->id }}">{{ $instructor->first_name . $instructor->last_name }}</option> 
                @endforeach               
              </select>
              <span class="text-danger error-text add_instructor_err"></span>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="cname">שם קורס</label>
            <input type="text" id="course_name" name ="course_name" class="form-control" placeholder="הזן את שם הקורס">
            <span class="text-danger error-text course_name_err"></span>
            </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="url">
              כתובת אתר כמובן
            </label>
            <input type="text" id="course_url" name="course_url" class="form-control" placeholder="הזן את כתובת האתר של סרטון הקורס">
            <span class="text-danger error-text course_url_err"></span>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group col-lg-12">
            <input type = "hidden" id ="type" name="type" value ="0">
            <button class="btn btn-primary waves-effect waves-light" id ="show_price">
              חינם / בתשלום
            </button>
            <div class="col-md-12 mt-2" id="item" style="display: none;"><label for="url">
              מחיר
            </label>
            <input type="text" id="price" name ="price" class="form-control" placeholder="">
            <span class="text-danger error-text price_err"></span>
          </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="course_description" name="course_description" value ="">
            <label for="description">תיאור</label>
            <textarea class="summernote-basic" name="description"></textarea>
            <span class="text-danger error-text course_description_err"></span>
          </div>
        </div>
        <input type="hidden" name="imageName" id ="imageName" value="">
        <div class="col-lg-12">
          <div class="form-group ">
            <label for="Bimage">
                            קובץ מצורף
            </label>
            <div class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"data-upload-preview-template="#uploadPreviewTemplate">
              <div class="fallback">
                <input name="file" type="file" />
              </div>
              <div class="dz-message needsclick">
                <i class="h3 text-muted dripicons-cloud-upload"></i>
                <h4>גרור ושחרר לוגו לכאן</h4>
              </div>
              </div>
                <span class="text-danger error-text imageName_err"></span>
              <!-- Preview -->
              <div class="dropzone-previews mt-3" id="file-previews"></div>
            </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label for="tagline1">שורת תיוג</label>
                <input type="text" class="tagsline1 form-control" name="tagline1">
                <span class="text-danger error-text tagline1_err"></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="tagline2">שורת תיוג</label>
                <input type="text" class="tagsline2 form-control" name="tagline2">
                <span class="text-danger error-text tagline2_err"></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="tagline3">שורת תיוג</label>
                <input type="text" class="tagsline3 form-control" name="tagline3">
                <span class="text-danger error-text tagline3_err"></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="tagline4">שורת תיוג</label>
                <input type="text" class="tagsline4 form-control" name="tagline4">
                <span class="text-danger error-text tagline4_err"></span>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="tagline5">שורת תיוג</label>
                <input type="text" class="tagsline5 form-control"  name="tagline5">
                <span class="text-danger error-text tagline5_err"></span>
              </div>
            </div>
        
            </div>
      <div class="row mt-3">
          <div class="col-12 text-center">
          <button type="submit" id ="save_product" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
          <button type="button" id ="bckbtn" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
        </div>
      </div>
    </div>
    </div> <!-- end card-->
  </form>
    </div> <!-- end col-->
    </div> <!-- end row-->
    </div> <!-- container -->
</div> <!-- content -->
  </div>
  </div>
  </div>
</div>
@endsection
@section('scripts')      
<script type="text/javascript">
   Dropzone.autoDiscover = false;
   $(document).ready(function(){
 $('#bckbtn').click(function(){
      window.location.href = '{{route("admin.Productslisting").'/'.$degree_id.'/'.$university_id}}';
    });
    $("#save_product").click(function(e) {
        e.preventDefault();
         var plainText = $($(".summernote-basic").summernote("code")).text()
         $('#course_description').val(plainText);
         var fd = new FormData();
        $.ajax({
            url: '{{ route("admin.saveproduct") }}',
            type: 'POST',
            data:new FormData($("#add_course_form")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
            success: function(response) {
                if ($.isEmptyObject(response.error)) {
                    window.location.href = '{{route("admin.Productslisting").'/'.$degree_id.'/'.$university_id}}';
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

         $( "#show_price" ).click(function(e) {
          e.preventDefault();
    $( "#item" ).toggle();
    $('#type').val('1');
});
         $('.summernote-basic').summernote('fontName', 'Varela Round');


$("div#myAwesomeDropzone").dropzone({
        url: "{{route('admin.course_Uploadfiles')}}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        maxFiles: 1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        removedfile: function(file) {
            var _ref;
             return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
  },
        // autoProcessQueue: false,
        init: function() {
            this.on("maxfilesexceeded", function(file){
                this.removeAllFiles();
                this.addFile(file);
            });
        },
        success: function (file, response) {
            var res = JSON.parse(response);
            if(res.status == 1){
                $('#imageName').val(res.image_name);
            }
        },
        error: function (file, response) {
            return false;
        }
    });
   });
  

</script>
@endsection