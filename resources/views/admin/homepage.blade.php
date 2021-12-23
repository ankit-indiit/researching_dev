@extends('admin.layouts.app')

@section('title', ' דף הבית ')
@section('content')
<?php 
$is_logged_in = session()->get('admin_logged_in');
        
if(!isset($is_logged_in) && $is_logged_in != '1'){      
    return redirect()->route('admin.adminLogin')->send();
}

?>
<div class="content-page">
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">בית</a></li>
                            <li class="breadcrumb-item active"> דף הבית </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> דף הבית </h4>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">  
                        <h4 class="header-title mb-3 text-right">דף הבית</h4>
                        <form method="POST" id="aboutus_form" action = "" enctype="multipart/form-data">
                            @csrf()
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="headsub">דֶגֶל</h4>
                                </div>
                                @php 
                                $banner_text = json_decode($homepage->banner_text,true);
                                @endphp 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="banner_text">כותרת 1</label>
                                        <input type="text" id="banner_text1" name ="banner_text[title1]" class="form-control" placeholder="כותרת 1" value="{{ $banner_text['title1'] }}">
                                        <span class="text-danger error-text banner_text_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="banner_text">כותרת 2</label>
                                        <input type="text" id="banner_text2" name ="banner_text[title2]" class="form-control" placeholder="כותרת 2" value="{{ $banner_text['title2'] }}">
                                        <span class="text-danger error-text banner_text_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="banner_text">כותרת 3</label>
                                        <input type="text" id="banner_text3" name ="banner_text[title3]" class="form-control" placeholder="כותרת 3" value="{{ $banner_text['title3'] }}">
                                        <span class="text-danger error-text banner_text_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="banner_text">כותרת 4</label>
                                        <input type="text" id="banner_text4" name ="banner_text[title4]" class="form-control" placeholder="כותרת 4" value="{{ $banner_text['title4'] }}">
                                        <span class="text-danger error-text banner_text_err"></span>
                                    </div>
                                </div>
                                <!---------- Banner Image ------------->
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="hidden" name="banner_image" id ="banner_image" value="{{ $homepage->banner_image}}">
                                        <label for="Bimage">
                                            תמונת באנר
                                        </label>
                                        <div class="dropzone" id="banner_imageDropzone" data-plugin="dropzone" data-previews-container="#file-previews"data-upload-preview-template="#uploadPreviewTemplate">
                                            <div class="fallback">
                                                <input name="file" type="file" />
                                            </div>
                                            <div class="dz-message needsclick">
                                                <i class="h3 text-muted dripicons-cloud-upload"></i>
                                                <h4>גרור ושחרר לוגו לכאן</h4>
                                            </div>
                                        </div>
                                        <span class="text-danger error-text banner_image_err"></span>
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
                                                        <?php $image =  asset('/assets/images/' .$homepage->banner_image); ?>
                                                        <input type ="hidden" name="previousimage" id = "banner_image_previousimage" value= "{{@$homepage->banner_image}}">
                                                        <img id ="banner_image_uploadImage" src="{{$image}}"  class="avatar-sm rounded bg-light">
                                                    </div>
                                                    <div class="col pl-0">
                                                        <a id ="banner_image_uploadname" href="javascript:void(0);" class="text-muted font-weight-bold" data-dz-name="">{{ $homepage->banner_image }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>      
                                <!---------- Banner Background ------------->
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="hidden" name="banner_background" id ="banner_background" value="{{ $homepage->banner_background}}">
                                        <label for="banner_background">
                                            רקע באנר
                                        </label>
                                        <div class="dropzone" id="banner_backgroundDropzone" data-plugin="dropzone" data-previews-container="#file-previews"data-upload-preview-template="#uploadPreviewTemplate">
                                            <div class="fallback">
                                                <input name="file" type="file" />
                                            </div>
                                            <div class="dz-message needsclick">
                                                <i class="h3 text-muted dripicons-cloud-upload"></i>
                                                <h4>גרור ושחרר לוגו לכאן</h4>
                                            </div>
                                        </div>
                                        <span class="text-danger error-text banner_background_err"></span>
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
                                                        <?php $image =  asset('/assets/images/' .$homepage->banner_background); ?>
                                                        <input type ="hidden" name="previousimage" id = "banner_background_previousimage" value= "{{@$homepage->banner_background}}">
                                                        <img id ="banner_background_uploadImage" src="{{$image}}"  class="avatar-sm rounded bg-light">
                                                    </div>
                                                    <div class="col pl-0">
                                                        <a id ="banner_background_uploadname" href="javascript:void(0);" class="text-muted font-weight-bold" data-dz-name="">{{ $homepage->banner_background }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>      

                                <!---------- Banner Mobile Image ------------->
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="hidden" name="banner_mobile_image" id ="banner_mobile_image" value="{{ $homepage->banner_mobile_image}}">
                                        <label for="banner_mobile_image">
                                            תמונת באנר לנייד
                                        </label>
                                        <div class="dropzone" id="banner_mobile_imageDropzone" data-plugin="dropzone" data-previews-container="#file-previews"data-upload-preview-template="#uploadPreviewTemplate">
                                            <div class="fallback">
                                                <input name="file" type="file" />
                                            </div>
                                            <div class="dz-message needsclick">
                                                <i class="h3 text-muted dripicons-cloud-upload"></i>
                                                <h4>גרור ושחרר לוגו לכאן</h4>
                                            </div>
                                        </div>
                                        <span class="text-danger error-text banner_mobile_image_err"></span>
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
                                                        <?php $image =  asset('/assets/images/' .$homepage->banner_mobile_image); ?>
                                                        <input type ="hidden" name="previousimage" id = "banner_mobile_image_previousimage" value= "{{@$homepage->banner_mobile_image}}">
                                                        <img id ="banner_mobile_image_uploadImage" src="{{$image}}"  class="avatar-sm rounded bg-light">
                                                    </div>
                                                    <div class="col pl-0">
                                                        <a id ="banner_mobile_image_uploadname" href="javascript:void(0);" class="text-muted font-weight-bold" data-dz-name="">{{ $homepage->banner_mobile_image }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <!---------- End Banner Mobile Image ------------->    
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="banner_social">באנר חברתי</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" id="banner_facebook" name ="banner_facebook" class="form-control" placeholder="פייסבוק" value="{{ $homepage->banner_facebook }}">
                                                <span class="text-danger error-text banner_facebook_err"></span>
                                            </div>                                            
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" id="banner_insta" name ="banner_insta" class="form-control" placeholder="אינסטגרם" value="{{ $homepage->banner_insta }}">
                                                <span class="text-danger error-text banner_insta_err"></span>
                                            </div>                                            
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" id="banner_whatsapp" name ="banner_whatsapp" class="form-control" placeholder="וואטסאפ" value="{{ $homepage->banner_whatsapp }}">
                                                <span class="text-danger error-text banner_whatsapp_err"></span>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>   
                                <div class="col-md-12">
                                    <div class="row">
                                        @php 
                                        $banner_list = json_decode($homepage->banner_list,true);
                                        @endphp 
                                        @for($i=0; $i<4; $i++)
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="banner_list">רשימת כותרת {{$i+1}}</label>
                                                <input type="text" id="banner_list_title{{$i}}" name ="banner_list[{{$i}}][title]" class="form-control" value="{{ $banner_list[$i]['title'] }}">
                                            </div>                                            
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="banner_list">רשום טקסט {{$i+1}}</label>
                                                <textarea type="text" id="banner_list_text{{$i}}" name ="banner_list[{{$i}}][text]" class="form-control">{{ $banner_list[$i]['text'] }}</textarea>
                                            </div>                                            
                                        </div>
                                        @endfor
                                    </div>
                                </div>                                                                        
                            </div>
                            <div class="row">
                                @php 
                                    $success = json_decode($homepage->success,true);
                                @endphp 
                                <div class="col-md-12">
                                    <h4 class="headsub">הַצלָחָה</h4>
                                </div> 
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="success_title">כותרת</label>
                                        <input type="text" id="success_title" name="success[title]" class="form-control" value="{{ $success['title'] }}">
                                        <span class="text-danger error-text success_title_err"></span>
                                    </div>
                                </div>  
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="success_tagline">קו תג</label>
                                        <input type="text" id="success_tagline" name="success[tagline]" class="form-control" value="{{ $success['tagline'] }}">
                                        <span class="text-danger error-text success_tagline_err"></span>
                                    </div>
                                </div>  
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="success_text1">טקסט 1</label>
                                        <textarea type="text" id="success_text1" name="success[text1]" class="form-control">{{ $success['text1'] }}</textarea>
                                        <span class="text-danger error-text success_text1_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="success_text2">טקסט 2</label>
                                        <textarea type="text" id="success_text2" name="success[text2]" class="form-control">{{ $success['text2'] }}</textarea>
                                        <span class="text-danger error-text success_text2_err"></span>
                                    </div>
                                </div>    
                                <!---------- Success Bacground Image ------------->
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="hidden" name="success[bg_image]" id ="success_bg_image" value="{{ $success['bg_image'] }}">
                                        <label for="success_bg_image">
                                            תמונת רקע
                                        </label>
                                        <div class="dropzone" id="success_bg_imageDropzone" data-plugin="dropzone" data-previews-container="#file-previews"data-upload-preview-template="#uploadPreviewTemplate">
                                            <div class="fallback">
                                                <input name="file" type="file" />
                                            </div>
                                            <div class="dz-message needsclick">
                                                <i class="h3 text-muted dripicons-cloud-upload"></i>
                                                <h4>גרור ושחרר לוגו לכאן</h4>
                                            </div>
                                        </div>
                                        <span class="text-danger error-text success_bg_image_err"></span>
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
                                                        <?php $image =  asset('/assets/images/'.$success['bg_image']); ?>
                                                        <input type="hidden" name="previousimage" id="success_bg_image_previousimage" value="{{ $success['bg_image'] }}">
                                                        <img id ="success_bg_image_uploadImage" src="{{$image}}"  class="avatar-sm rounded bg-light">
                                                    </div>
                                                    <div class="col pl-0">
                                                        <a id ="success_bg_image_uploadname" href="javascript:void(0);" class="text-muted font-weight-bold" data-dz-name="">{{ $success['bg_image'] }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <!---------- End Success Background Image ------------->      
                                <!---------- Success Front Image ------------->
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="hidden" name="success[front_image]" id ="success_front_image" value="{{ $success['front_image'] }}">
                                        <label for="success_front_image">
                                            תמונה קדמית
                                        </label>
                                        <div class="dropzone" id="success_front_imageDropzone" data-plugin="dropzone" data-previews-container="#file-previews"data-upload-preview-template="#uploadPreviewTemplate">
                                            <div class="fallback">
                                                <input name="file" type="file" />
                                            </div>
                                            <div class="dz-message needsclick">
                                                <i class="h3 text-muted dripicons-cloud-upload"></i>
                                                <h4>גרור ושחרר לוגו לכאן</h4>
                                            </div>
                                        </div>
                                        <span class="text-danger error-text success_front_image_err"></span>
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
                                                        <?php $image =  asset('/assets/images/'.$success['front_image']); ?>
                                                        <input type ="hidden" name="previousimage" id = "success_front_image_previousimage" value= "{{ $success['front_image'] }}">
                                                        <img id ="success_front_image_uploadImage" src="{{$image}}"  class="avatar-sm rounded bg-light">
                                                    </div>
                                                    <div class="col pl-0">
                                                        <a id ="success_front_image_uploadname" href="javascript:void(0);" class="text-muted font-weight-bold" data-dz-name="">{{ $success['front_image'] }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <!---------- End Success Front Image ------------->                                                                                                                              
                            </div>                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="headsub">שֵׁרוּת</h4>
                                </div> 
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="service_title">כּוֹתֶרֶת</label>
                                        <input type="text" id="service_title" name="service_title" class="form-control" placeholder="הזן כותרת" value="{{ $homepage->service_title }}">
                                        <span class="text-danger error-text service_title_err"></span>
                                    </div>
                                </div>  
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="service_desc">תיאור</label>
                                        <textarea type="text" id="service_desc" name="service_desc" class="form-control" placeholder="הזן תיאור">{{ $homepage->service_desc }}</textarea>
                                        <span class="text-danger error-text service_desc_err"></span>
                                    </div>
                                </div>                                                                                              
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="headsub">קוּרס</h4>
                                </div> 
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="course_title">כּוֹתֶרֶת</label>
                                        <input type="text" id="course_title" name="course_title" class="form-control" placeholder="הזן כותרת" value="{{ $homepage->course_title }}">
                                        <span class="text-danger error-text course_title_err"></span>
                                    </div>
                                </div>  
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="course_description">תיאור</label>
                                        <textarea type="text" id="course_description" name="course_description" class="form-control" placeholder="הזן תיאור">{{ $homepage->course_description }}</textarea>
                                        <span class="text-danger error-text course_description_err"></span>
                                    </div>
                                </div>                                                                                              
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="headsub">גורם מהנה </h4>
                                </div> 
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="switch">
                                            <input type="hidden" id="homepage_funfactor_hide" name ="funfactor" value="0">
                                            <input type="checkbox" id="homepage_funfactor" name ="funfactor" value="1" @if(isset($homepage->funfactor) && $homepage->funfactor == 1) checked @endif>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>                                                                                               
                            </div>                            
                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <button type="submit" id="savebtn" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                                    <button id ="backbtn" type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
                                </div>
                            </div>                               
                        </form>                         
                    </div>
                </div> <!-- end col-->
            </div>
        </div> <!-- container -->
    </div> <!-- content -->
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
    $("div#success_front_imageDropzone").dropzone({
        url: "{{route('admin.Uploadfiles')}}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        maxFiles: 1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        removedfile: function(file) {
            var _ref;
            var image = $('success_front_image_previousimage').val();
            $("success_front_image_uploadname").text(image);
            $("success_front_image_uploadImage").attr('src',baseurl+'/assets/images/'+image);
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
                $('#success_front_image').val(res.image_name);
            }
            $("#success_front_image_uploadname").html(res.image_name);
          $("#success_front_image_uploadImage").attr('src',baseurl+'/assets/images/'+res.image_name);
        },
        error: function (file, response) {
            return false;
        }
    });$("div#success_bg_imageDropzone").dropzone({
        url: "{{route('admin.Uploadfiles')}}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        maxFiles: 1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        removedfile: function(file) {
            var _ref;
            var image = $('success_bg_image_previousimage').val();
            $("success_bg_image_uploadname").text(image);
            $("success_bg_image_uploadImage").attr('src',baseurl+'/assets/images/'+image);
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
                $('#success_bg_image').val(res.image_name);
            }
            $("#success_bg_image_uploadname").html(res.image_name);
          $("#success_bg_image_uploadImage").attr('src',baseurl+'/assets/images/'+res.image_name);
        },
        error: function (file, response) {
            return false;
        }
    });
    $("div#banner_mobile_imageDropzone").dropzone({
        url: "{{route('admin.Uploadfiles')}}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        maxFiles: 1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        removedfile: function(file) {
            var _ref;
            var image = $('banner_mobile_image_previousimage').val();
            $("banner_mobile_image_uploadname").text(image);
            $("banner_mobile_image_uploadImage").attr('src',baseurl+'/assets/images/'+image);
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
                $('#banner_mobile_image').val(res.image_name);
            }
            $("#banner_mobile_image_uploadname").html(res.image_name);
          $("#banner_mobile_image_uploadImage").attr('src',baseurl+'/assets/images/'+res.image_name);
        },
        error: function (file, response) {
            return false;
        }
    });
    $("div#banner_backgroundDropzone").dropzone({
        url: "{{route('admin.Uploadfiles')}}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        maxFiles: 1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        removedfile: function(file) {
            var _ref;
            var image = $('#banner_background_previousimage').val();
            $("#banner_background_uploadname").text(image);
            $("#banner_background_uploadImage").attr('src',baseurl+'/assets/images/'+image);
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
                $('#banner_background').val(res.image_name);
            }
            $("#banner_background_uploadname").html(res.image_name);
          $("#banner_background_uploadImage").attr('src',baseurl+'/assets/images/'+res.image_name);
        },
        error: function (file, response) {
            return false;
        }
    });
    $("div#banner_imageDropzone").dropzone({
        url: "{{route('admin.Uploadfiles')}}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        maxFiles: 1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        removedfile: function(file) {
            var _ref;
            var image = $('#banner_image_previousimage').val();
            $("#banner_image_uploadname").text(image);
            $("#banner_image_uploadImage").attr('src',baseurl+'/assets/images/'+image);
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
                $('#banner_image').val(res.image_name);
            }
            $("#banner_image_uploadname").html(res.image_name);
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
            url: '{{ route("admin.update_homepage") }}',
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