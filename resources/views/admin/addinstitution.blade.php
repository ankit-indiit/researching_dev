@extends('admin.layouts.app')

@section('title', ' להוסיף מוסד ')
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
                <li class="breadcrumb-item"><a href="{{route('admin.productslisting')}}">מוסדות</a></li>
                <li class="breadcrumb-item active">הוסף מוסד</li>
              </ol>
            </div>
            <h4 class="page-title">הוסף מוסד</h4>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row" style="direction:rtl">
                <div class="col-md-6 text-right">
                  <h4 class="header-title mb-3">הוסף מוסד</h4>
                </div>
                <div class="col-md-6 text-left">
                  <a href="{{route('admin.productslisting')}}" class="btn btn-primary  mb-3">חזרה למוסד</a>
                </div>
              </div>
              <form method="POST" id="add_form" action = "{{ route('admin.saveproductcategory') }}" enctype="multipart/form-data">
            @csrf()
            <input type="hidden" name="imageName" id ="imageName" value="">
              <div class="row">
                <div class="col-lg-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="dname">שם מוסד</label>
                          <input type="text" id="institute_name" name = "institute_name" class="form-control" placeholder="הזן את שם המוסד" >
                          @if($errors->any())
                            @if($errors->has('institute_name'))
                              <div class="error" style="color: red;">{{ $errors->first('institute_name') }}</div>
                          @endif
                         @endif
                         <span class="text-danger error-text institute_name_err"> </span>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group ">
                        <label for="Bimage">לוגו המוסד</label>
                          <div class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"data-upload-preview-template="#uploadPreviewTemplate">
                            <div class="fallback">
                              <input name="file" type="file" />
                            </div>
                            <div class="dz-message needsclick">
                              <i class="h3 text-muted dripicons-cloud-upload"></i>
                              <h4>גרור ושחרר לוגו לכאן</h4>
                            </div>
                          </div>
                          <!-- Preview -->
                          <div class="dropzone-previews mt-3" id="file-previews"></div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="switch university-isactive">
                            <input type="checkbox" value="1" name ="active" checked>
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-12 text-center">
                      <button type="submit" id="addNewInstitution" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                      <button id = 'addcategorybtn' type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
                    </div>
                  </div>
                </div>
              </div> <!-- end card-->
              </form>
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
   Dropzone.autoDiscover = false;
  $(document).ready(function() {
  $('#addcategorybtn').click(function(){
      window.location.href = '{{route("admin.productslisting")}}';
    });
  $("div#myAwesomeDropzone").dropzone({
        url: "{{route('admin.uploadfiles')}}",
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

    $('#addNewInstitution').click(function(e){
        e.preventDefault();
        var fd = new FormData();
        $.ajax({
            url: '{{ Route('admin.saveproductcategory') }}',
            type: 'POST',
            data:new FormData($("#add_form")[0]),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
              if($.isEmptyObject(response.error)) {
                    window.location.href = '{{ Route('admin.productslisting') }}';
              }else {
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