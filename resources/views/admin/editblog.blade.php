@extends('admin.layouts.app')

@section('title', ' עריכת בלוג ')
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
                <li class="breadcrumb-item active">ערוך את הבלוג</li>
              </ol>
            </div>
            <h4 class="page-title">ערוך את הבלוג</h4>
          </div>
        </div>
      </div> 
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="row" style="direction:rtl">
          <div class="col-md-6 text-right">
            <h4 class="header-title mb-3">ערוך את הבלוג </h4>
          </div>
          <div class="col-md-6 text-left">
            <a href="{{route('admin.blogslisting')}}" class="btn btn-primary  mb-3">חזרה לבלוגים</a>
          </div>
        </div>
<form method="POST" id="editblog_form" action = "" enctype="multipart/form-data">
@csrf()
<input type="hidden" name="blog_id" id ="blog_id" value ="{{$edit_blog->id}}">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="texturl">טקסט של כתובת אתר</label>
                  <input type="text" id="texturl" name ="texturl" class="form-control" value="{{$edit_blog->slug}}" placeholder="טקסט של כתובת אתר" >
                  <span class="text-danger error-text texturl_err"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="title">כותרת</label>
                  <input type="text" id="title" name="title" value="{{$edit_blog->title}}" class="form-control" placeholder="הזן את הכותרת שלך" >
                  <span class="text-danger error-text title_err"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="startend">כמה זמן ייקרא לקרוא את ההודעה מההתחלה ועד הסוף</label>
                  <input type="text" id="startend" name="startend" class="form-control" placeholder="כמה זמן ייקרא לקרוא את ההודעה מההתחלה ועד הסוף" value="{{$edit_blog->reading_time}}">
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
                      <option value="{{ $category->id }}" {{$category->id == $edit_blog->category_id  ? 'selected' : ''}} >{{ $category->name }}</option> 
                    @endforeach
                  </select>
                  <span class="text-danger error-text category_err"></span>
                </div>
              </div>  
              <div class="col-md-12">
                <div class="form-group">
                  <label for="refrences">הפניות</label>
                  <input type="text" id="references" name ="references" class="form-control" placeholder="הפניות" value="{{$edit_blog->references}}">
                  <span class="text-danger error-text references_err"></span>
                </div>
              </div>
              <div class="col-md-12">
                    <div class="form-group">
                         <label for="intro">מבוא</label>
                         <textarea id="intro" class="summernote-basic" name="intro">{!! $edit_blog->content !!}</textarea>
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
                                <option value="{{ $instructors->id }}" {{$instructors->id == $edit_blog->instructor_id  ? 'selected' : ''}}>{{ $instructors->first_name }}</option> 
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
                            <option  value ="0" {{$edit_blog->status == '0'  ? 'selected' : ''}}>טְיוּטָה</option>
                            <option value ="1" {{$edit_blog->status == '1'  ? 'selected' : ''}}>לְפַרְסֵם</option>
                            <option value="2" {{$edit_blog->status == '1'  ? 'selected' : ''}}>לא פורסם</option>
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
              <div class="col-md-12">
                <div class="form-group">
                  <div class="card mt-1 mb-0 shadow-none border ">
                    <div class="p-2">
                      <div class="row align-items-center">    
                        <div class="col-auto">
                          <?php
                
                    $image =  asset('/assets/images/' .$image)
                
                ?>
                <input type ="hidden" name="previousimage" id = "previousimage" value= "{{$edit_blog->image}}">
                <img id ="uploadImage" src="{{$image}}"  class="avatar-sm rounded bg-light">
                          
                        </div>
                        <div class="col pl-0">
                        <a id ="uploadname" href="javascript:void(0);" class="text-muted font-weight-bold" data-dz-name="">{{$image}}</a>
                            
                                   </div>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 more_input">
                
                <?php 
                $content = json_decode($edit_blog->details);
                if(!empty($content)){

                foreach ($content as $value) {?>
                  <div class ="col-md-12 old">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="texthead">כּוֹתֶרֶת</label>
                        <input type="text" name="texthead[]" class="form-control texthead" value="{{$value->title}}" placeholder="כּוֹתֶרֶת" >
                        <span class="text-danger error-text texthead_err"></span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">תיאור</label>
                         <textarea class="summernote-basic" name="description[]">{{$value->content}}</textarea>
                         <span class="text-danger error-text description_err"></span>
                        <!-- <div id="summernote-basic"></div> -->
                    </div>
                </div>
                <a href="#" class="remove_field">Remove</a>
                </div>
                 <?php }}?>
                
                <div class="col-md-12">
                    <h4 class="headsub">גוף הטקסט <a id ="addmorebtn"href="javascript:void(0)" class="btn btn-primary btn-circle float-left"><i class="fa fa-plus"></i></a></h4>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="texthead">כּוֹתֶרֶת</label>
                        <input type="text" name="texthead[]" class="form-control texthead" value="" placeholder="כּוֹתֶרֶת" >
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
                          <button id ="saveblog_btn" type="button"  class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                          <button type="button" class="btn btn-success waves-effect waves-light m-1"> תצוגה מקדימה</button>
                          <button id ="backbtn" type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
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
      Dropzone.autoDiscover = false;
    $(document).ready(function() {
        $('#backbtn').click(function(){
      window.location.href = '{{route("admin.blogslisting")}}';
    });
    $('.summernote-basic').summernote('fontName', 'Varela Round');
    var baseurl = window.location.origin;
    $("div#myAwesomeDropzone").dropzone({
        url: "{{route('admin.Uploadfiles')}}",
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
    $("#saveblog_btn").click(function(e) {
        e.preventDefault();
         var fd = new FormData();
        $.ajax({
            url: '{{ route("admin.updateblog") }}',
            type: 'POST',
            data:new FormData($("#editblog_form")[0]),
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
    });
        $(".more_input").on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
        $(this).closest('.old').remove(); 
        x--;
    });
});
     
    $('#summernote-basic').summernote('fontName', 'Varela Round');</script>
  @endsection