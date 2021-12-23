@extends('admin.layouts.app')

@section('title', ' עלינו   ')
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
                                <li class="breadcrumb-item active">עלינו</li>
                            </ol>
                        </div>
                    <h4 class="page-title">עלינו</h4>
                </div>
            </div>
        </div> 
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">  
                    <h4 class="header-title mb-3 text-right">עלינו </h4>
            <?php foreach ($aboutus as $value) {?>
<form method="POST" id="aboutus_form" action = "" enctype="multipart/form-data">
@csrf()
<input type="hidden" name="aboutus_id" id ="aboutus_id" value ="{{$value->id}}">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="headsub">הרעיון שלנו</h4>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">כּוֹתֶרֶת</label>
                            <input type="text" id="a1_title" name ="a1_title" class="form-control" placeholder="הזן את הכותרת שלך" value="{{$value->a1_title}}">
                             <span class="text-danger error-text a1_title_err"></span>
                        </div>
                    </div>
                    <input type="hidden" name="a1_imageName" id ="a1_imageName" value="{{$value->a1_image}}">
                    <div class="col-lg-12">
                        <div class="form-group ">
                            <label for="Bimage">
                            קובץ מצורף
                            </label>
                            <div class="dropzone" id="a1_myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"data-upload-preview-template="#uploadPreviewTemplate">
                            <div class="fallback">
                              <input name="file" type="file" />
                            </div>
                            <div class="dz-message needsclick">
                              <i class="h3 text-muted dripicons-cloud-upload"></i>
                              <h4>גרור ושחרר לוגו לכאן</h4>
                            </div>
                        </div>
                        <span class="text-danger error-text a1_imageName_err"></span>
                        <!-- Preview -->
                        <div class="dropzone-previews mt-3" id="file-previews"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="card mt-1 mb-0 shadow-none border ">
                             <div class="p-2">
                                <div class="row align-items-center">    
                                    <div class="col-auto">
                <?php $image =  asset('/assets/images/' .$value->a1_image)   ?>
                <input type ="hidden" name="a1_previousimage" id = "a1_previousimage" value= "{{$value->image}}">
                <img id ="a1_uploadImage" src="{{$image}}"  class="avatar-sm rounded bg-light">
            </div>
            <div class="col pl-0">
                <a id ="a1_uploadname" href="javascript:void(0);" class="text-muted font-weight-bold" data-dz-name="">{{$value->a1_image}}</a>
            </div>
        </div>
    </div>
</div>
</div>
</div>
    <div class="col-md-12 more_input">
        <div class ="col-md-12 old">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description">תיאור</label>
                    <!--<textarea class="summernote-basic" name="a1_description[]">{{!! $value->a1_description !!}}</textarea>-->
                    <textarea class="form-control" name="a1_description" rows="5" cols="33">{!! $value->a1_description !!}</textarea>
                    <span class="text-danger error-text a1_description_err"></span>
                </div>
            </div>
            <a href="#" class="remove_field">Remove</a>
            </div>   
        </div> 
        <div class="col-md-12">
            <h4 class="headsub">איך להתחיל?</h4>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="title">כּוֹתֶרֶת</label>
                <input type="text" id="a2_title" name ="a2_title" class="form-control" placeholder="הזן את הכותרת שלך" value="{{$value->a2_title}}">
                <span class="text-danger error-text a2_title_err"></span>
            </div>
                </div>
                <input type="hidden" name="a2_imageName" id ="a2_imageName" value="{{$value->a2_image}}">
                    <div class="col-lg-12">
                        <div class="form-group ">
                            <label for="Bimage">
                            קובץ מצורף
                            </label>
                            <div class="dropzone" id="a2_myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"data-upload-preview-template="#uploadPreviewTemplate">
                            <div class="fallback">
                              <input name="file" type="file" />
                            </div>
                            <div class="dz-message needsclick">
                              <i class="h3 text-muted dripicons-cloud-upload"></i>
                              <h4>גרור ושחרר לוגו לכאן</h4>
                            </div>
                        </div>
                        <span class="text-danger error-text a2_imageName_err"></span>
                        <!-- Preview -->
                        <div class="dropzone-previews mt-3" id="file-previews"></div>
                    </div>
                </div>
            <div class="col-md-12">
                    <div class="form-group">
                        <div class="card mt-1 mb-0 shadow-none border">
                             <div class="p-2">
                                <div class="row align-items-center">    
                                    <div class="col-auto">
                <?php $image =  asset('/assets/images/' .$value->a2_image)
                ?>
                <input type ="hidden" name="previousimage" id = "a2_previousimage" value= "{{$value->a2_image}}">
                <img id ="a2_uploadImage" src="{{$image}}"  class="avatar-sm rounded bg-light">
            </div>
            <div class="col pl-0">
                <a id ="a2_uploadname" href="javascript:void(0);" class="text-muted font-weight-bold" data-dz-name="">{{$value->a2_image}}</a>
            </div>
        </div>
    </div>
</div>
</div>
</div>
   <div class="col-md-12 more_input">
        <div class ="col-md-12 old">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description">תיאור</label>
                    <!--<textarea class="summernote-basic" name="a2_description[]">{{!! $value->a2_description !!}}</textarea>-->
                    <textarea class="form-control" name="a2_description" rows="5" cols="33">{!! $value->a2_description !!}</textarea>
                    <span class="text-danger error-text a2_description_err"></span>
                </div>
            </div>
            <a href="#" class="remove_field">Remove</a>
            </div>   
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 text-center">
            <button type="submit" id="savebtn" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
            <button id ="backbtn" type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
        </div>
    </div>
</div> <!-- end col-->
</div>
<!-- end row-->
</form>
<?php }?>
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
        $('#backbtn').click(function(){
      window.location.href = '{{route("admin.dashboard")}}';
    });
    $('.summernote-basic').summernote('fontName', 'Varela Round');
    var baseurl = window.location.origin;
    $("div#a1_myAwesomeDropzone").dropzone({
        url: "{{route('admin.Uploadfiles')}}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        maxFiles: 1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        removedfile: function(file) {
            var _ref;
            var image = $('#a1_previousimage').val();
            $("#a1_uploadname").text(image);
            $("#a1_uploadImage").attr('src',baseurl+'/assets/images/'+image);
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
                $('#a1_imageName').val(res.image_name);
            }
            $("#a1_uploadname").html(res.image_name);
          $("#a1_uploadImage").attr('src',baseurl+'/assets/images/'+res.image_name);
        },
        error: function (file, response) {
            return false;
        }
    });
    $("div#a2_myAwesomeDropzone").dropzone({
        url: "{{route('admin.Uploadfiles')}}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        maxFiles: 1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        removedfile: function(file) {
            var _ref;
            var image = $('#a2_previousimage').val();
            $("#a2_uploadname").text(image);
            $("#a2_uploadImage").attr('src',baseurl+'/assets/images/'+image);
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
                $('#a2_imageName').val(res.image_name);
            }
            $("#a2_uploadname").html(res.image_name);
          $("#a2_uploadImage").attr('src',baseurl+'/assets/images/'+res.image_name);
        },
        error: function (file, response) {
            return false;
        }
    });
    $("#savebtn").click(function(e) {
        e.preventDefault();
         var fd = new FormData();
        $.ajax({
            url: '{{ route("admin.update_aboutus") }}',
            type: 'POST',
            data:new FormData($("#aboutus_form")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
            success: function(response) {
                if ($.isEmptyObject(response.error)) {
                    //window.location.href = '{{route("admin.dashboard")}}';
                    location.reload();
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

        var x = 1; 
        var tempdiv;
        $(".more_input").on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
        $(this).closest('.old').remove(); 
        x--;
    });
});
     
    $('#summernote-basic').summernote('fontName', 'Varela Round');</script>
  @endsection