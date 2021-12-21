@extends('admin.layouts.app')

@section('title', ' הוסף בלוג ')
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
                                <li class="breadcrumb-item"><a href="{{route('admin.blogslisting')}}">בלוגים</a></li>
                                <li class="breadcrumb-item active">הוסף בלוג</li>
                            </ol>
                        </div>
                    <h4 class="page-title">הוסף בלוג</h4>
                </div>
            </div>
        </div>
<form method="POST" id = "add_blog_form" action="{{ route('admin.saveblog') }}" enctype="multipart/form-data">
@csrf() 
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="direction:rtl">
                        <div class="col-md-6  text-right">
                            <h4 class="header-title mb-3">הוסף בלוג </h4>
                        </div>
                        <div class="col-md-6 text-left">
                            <a href="{{route('admin.blogslisting')}}" class="btn btn-primary  mb-3">חזרה לבלוגים</a>
                        </div>
                    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="texturl">טקסט של כתובת אתר</label>
                        <input type="text" id="texturl" name ="texturl" class="form-control" placeholder="טקסט של כתובת אתר" >
                        <span class="text-danger error-text texturl_err"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">כותרת</label>
                        <input type="text" id="title" name ="title" class="form-control" placeholder="הזן את הכותרת שלך" >
                        <span class="text-danger error-text title_err"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="startend">כמה זמן ייקרא לקרוא את ההודעה מההתחלה ועד הסוף</label>
                        <input type="text" id="startend" name ="startend" class="form-control" placeholder="כמה זמן ייקרא לקרוא את ההודעה מההתחלה ועד הסוף" >
                        <span class="text-danger error-text startend_err"></span>
                    </div>
                </div>
                <?php 
                    $categories_data = DB::table('categories')->get();
                ?> 
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="categories">קטגוריות</label>
                        <select class="form-control" name="category" id ="category">
                            <option value = "">--בחר קטגוריה--</option>
                            @foreach($categories_data as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option> 
                            @endforeach 
                        </select>
                        <span class="text-danger error-text category_err"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="refrences">הפניות</label>
                        <input type="text" id="refrences" name="references" class="form-control" placeholder="הפניות" >
                        <span class="text-danger error-text references_err"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                         <label for="intro">מבוא</label>
                         <textarea id="intro" class="summernote-basic" name="intro"></textarea>
                         <span class="text-danger error-text intro_err"></span>
                        <!-- <div id="summernote-basic"></div> -->
                    </div>
                </div>
                <?php 
                    $instructors_data = DB::table('instructors')->get();
                ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="author">בחר מחבר</label>
                        <select type="text" id="author" name="author" class="form-control">
                            <option value ="">בחר מחבר</option>
                            @foreach($instructors_data as $instructors)
                                <option value="{{ $instructors->id }}">{{ $instructors->first_name }}</option> 
                            @endforeach 
                        </select>
                        <span class="text-danger error-text author_err"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="statuss">סטָטוּס</label>
                        <select type="text" id="statuss" name="status" class="form-control">
                            <option value ="">בחר</option>
                            <option value ="0">טְיוּטָה</option>
                            <option value ="1">לְפַרְסֵם</option>
                            <option value="2">לא פורסם</option>
                        </select>
                        <span class="text-danger error-text status_err"></span>
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
                <div class="col-md-12 more_input">
                <div class="col-md-12">
                    <h4 class="headsub">גוף הטקסט <a id ="addmorebtn"href="javascript:void(0)" class="btn btn-primary btn-circle float-left"><i class="fa fa-plus"></i></a></h4>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="texthead">כּוֹתֶרֶת</label>
                        <input type="text" name="texthead[]" class="form-control texthead" required placeholder="כּוֹתֶרֶת" >
                        <span class="text-danger error-text texthead_err"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">תיאור</label>
                         <textarea class="summernote-basic" name="description[]"></textarea>
                        <!-- <div id="summernote-basic"></div> -->
                    </div>
                </div>
            </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <button id ="saveblog_btn" type="submit" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                    <button type="button" class="btn btn-success waves-effect waves-light m-1"> תצוגה מקדימה</button>
                    <button id ="backbtn" type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
                </div>
            </div>
        </div>
    </div> <!-- end card-->
</div> <!-- end col-->
</div><!-- end row-->
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
    Dropzone.autoDiscover = false;
    $(document).ready(function() {
        $('#backbtn').click(function(){
      window.location.href = '{{route("admin.blogslisting")}}';
    });
    $('.summernote-basic').summernote('fontName', 'Varela Round');
    $("div#myAwesomeDropzone").dropzone({
        url: "{{route('admin.Uploadfiles')}}",
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
    $("#saveblog_btn").click(function(e) {
        e.preventDefault();
         var fd = new FormData();
        $.ajax({
            url: '{{ route("admin.saveblog") }}',
            type: 'POST',
            data:new FormData($("#add_blog_form")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
            success: function(response) {
                if ($.isEmptyObject(response.error)) {
                    window.location.href = '{{route("admin.blogslisting")}}';
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

        var max_fields      = 10; 
        var wrapper         = $(".more_input");
        var x = 1; 
        var tempdiv;
        $('#addmorebtn').click(function(e){
            e.preventDefault();
            if(x < max_fields){ 
                x++; 
               tempdiv = $(wrapper).append('<div class ="col-md-12 last"><div class="col-md-12"><div class="form-group"><label for="texthead">כּוֹתֶרֶת</label><input type="text" name="texthead[]" class="form-control texthead" placeholder="כּוֹתֶרֶת" ></div></div><div class="col-md-12"><div class="form-group"><label for="description">תיאור</label><textarea class="summernote-basic" name="description[]"></textarea></div></div><a href="#" class="remove_field">Remove</a></div>'); //add input box
               $(wrapper).find('.summernote-basic').summernote()
        }
        });
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
        $(this).closest('.last').remove(); 
        x--;
    })
});
</script>
@endsection