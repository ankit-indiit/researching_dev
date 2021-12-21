@extends('admin.layouts.app')

@section('title', ' עריכת אירוע  ')
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
                                <li class="breadcrumb-item"><a href="{{route('admin.events')}}">אירועים</a></li>
                                <li class="breadcrumb-item active">ערוך אירוע</li>
                            </ol>
                        </div>
                        <h4 class="page-title">ערוך אירוע</h4>
                    </div>
                </div>
            </div> 
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row" style="direction:rtl">
                    <div class="col-md-6 text-right">
                        <h4 class="header-title mb-3">ערוך אירוע</h4>
                    </div>
                    <div class="col-md-6 text-left">
                        <a href="{{route('admin.events')}}" class="btn btn-primary  mb-3">חזרה לאירועים</a>
                    </div>
                </div>
<form method="POST" id="edit_event_form" action = "{{ route('admin.updateevent') }}" enctype="multipart/form-data">
@csrf()
<input type="hidden" name="imageName" id ="imageName" value="{{$event_data->image}}">
<input type="hidden" name ="id" value="{{$event_data->id}}">
    <div class="row ">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="eventname">שם אירוע</label>    
                            <input type="text" id="eventname" name ="eventname" class="form-control" placeholder="הזן שם אירוע" value="{{$event_data->eventName}}"> 
                            <span class="text-danger error-text eventname_err"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="zoomlink">קישור זום</label>     
                            <input type="text" id="zoomlink" name = "zoomlink" class="form-control" placeholder="היכנס לקישור זום" value="{{$event_data->zoomLink}}">
                            <span class="text-danger error-text zoomlink_err"></span> 
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
                            <span class="text-danger error-text imageName_err"></span>
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
                                <?php
                                    $image =  asset('/assets/images/' .$event_data->image);
                                ?>
                        <input type ="hidden" name="previousimage" id = "previousimage" value= "{{$event_data->image}}">
                        <img id ="uploadImage" src="{{$image}}"  class="companylogo">
                        </div>
                    <div class="col pl-0">
                        <a id ="uploadname" href="javascript:void(0);" class="text-muted font-weight-bold" data-dz-name="">{{$event_data->image}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">תיאור</label>     
                            <textarea rows="4" id="description" name ="description" class="form-control" placeholder="הזן תיאור" >{{$event_data->description}}
                            </textarea>
                            <span class="text-danger error-text description_err"></span>
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date">תאריך האירוע</label>     
                            <input type="text" class="basic-datepicker form-control" id ="selected_date" name ="selected_date" value ="{{$event_data->eventDate}}" placeholder="הזן את תאריך האירוע">
                            <span class="text-danger error-text selected_date_err"></span>
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="eventtime">זמן האירוע</label>
                            <input class=" form-control" type="text" id="timepicker"  value ="{{$event_data->eventTime}}" name="selected_time" placeholder="00:00" />
                            <span class="text-danger error-text selected_time_err"></span>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <button type="submit" id ="editbtn" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                        <button id ="editeventbck" type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
                    </div>
                </div>
            </div>
        </div> <!-- end card-->
    </div> <!-- end col-->
</form>
</div>
<!-- end row-->
</div> <!-- container -->
</div> <!-- content -->
</div>
</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    Dropzone.autoDiscover = false;
    $(document).ready(function() {
        $('.basic-datepicker ').flatpickr();
        $('#timepicker').timepicker({
            //timeFormat: 'h:mm p',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
   
    $('#editeventbck').click(function(){
      window.location.href = '{{route("admin.events")}}';
      });
    var baseurl = window.location.origin;
    $("div#myAwesomeDropzone").dropzone({
        url: "{{route('admin.uploadfiles')}}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        maxFiles: 1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        removedfile: function(file) {
            var _ref;
            var image = $('#previousimage').val();
            $("#uploadname").text(image);
            $("#uploadImage").attr('src',baseurl+'/assets/images/'+image);
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
            $("#uploadname").html(res.image_name);
          $("#uploadImage").attr('src',baseurl+'/assets/images/'+res.image_name);
        },
        error: function (file, response) {
            return false;
        }
    });

    $("#editbtn").click(function(e) {
        e.preventDefault();
         var fd = new FormData();
        $.ajax({
            url: '{{ route("admin.updateevent") }}',
            type: 'POST',
            data:new FormData($("#edit_event_form")[0]),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
              if ($.isEmptyObject(response.error)) {
                    window.location.href = '{{route("admin.events")}}';
                } else {
                  printErrorMsg(response.error);
                }
              }
              });
              function printErrorMsg (msg) {
                $.each( msg, function( key, value ) {
              $('.'+key+'_err').text(value);
            });
        }
            });
});
</script>
@endsection

