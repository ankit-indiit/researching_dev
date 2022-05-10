@extends('admin.layouts.app')

@section('title', ' מדריך עריכה ')

@section('content')
<?php 
$is_logged_in = session()->get('admin_logged_in');
if(!isset($is_logged_in) && $is_logged_in != '1'){
    return redirect()->route('admin.adminLogin')->send();
        }
?>
<style>
.tab-horizontal {
    text-align: center;
}
.tab-horizontal button {
    display: inline-block;
    background-color: inherit;
    color: #0d0d3f;
    padding: 10px 20px;
    border: none;
    outline: none;
    text-align: left;
    cursor: pointer;
    transition: 0.3s;
    font-size: 17px;
}
.horizontaltab {
    color: #eb871e !important;
}

.courses-sections-details .tab {
    border: 1px solid #fff;
    width: 100%;
    display: flex;
}
.courses-sections-details .tabcontent {
    
    padding: 0px 12px;
    
    width: 100%;
    height: auto;
}
.courses-sections-details .tab button.active {
    background-color: #ffffff;
    color: #ee891f;
    border: 2px solid;
    border-bottom: none;
    font-weight: 700;
}
.courses-sections-details button.tablinks {
    border: 2px solid #ee891f;
    margin-bottom: 4px;
    border-top: none;
    border-right: none;
    border-left: none;
    text-align: center;
}

</style>
<div class="content-page">
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box">
            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                <li class="breadcrumb-item active">Edit product</li>
              </ol>
            </div>
            <h4 class="page-title">Edit product</h4>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">
          <div class="card-box" style="direction: rtl;">
          	<div class="row" style="direction:rtl">
		     <div class="col-md-6 text-right">
			 </div>
			  <div class="col-md-6 text-left">
                <button onclick="history.back()" class="btn btn-primary  mb-3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Back to products</font></font></button>
			 </div>
			</div>
            <div class="row">
              <div class="col-md-12">
              	<div class="courses-sections-details">
	                <div class="tab">
					  <button class="tablinks" onclick="openData(event, 'edit_chapter')" id="defaultOpen">Basic Detail</button>
					  <button class="tablinks" onclick="openData(event, 'edit_video')">Video</button>
					  <button class="tablinks" onclick="openData(event, 'edit_pdf')">PDF</button>
					  <button class="tablinks" onclick="openData(event, 'edit_quiz')">Quiz</button>
					</div>
					<div id="edit_chapter" class="tabcontent">
						<h3>Basic detail</h3>
						<?php
						$topic_id = $topic_id;
						$topics_data = $topics;  
						$highestnumber = $highest_number;
						?>
    					@include('admin.courses-elements.editChapter',compact('topic_id','topics_data','highestnumber'))
					</div>
					<div id="edit_video" class="tabcontent">
						<h3>Video</h3>
						<?php 
						$topic_id = $topic_id;
						$topic_video = $topic_video;
						$highestnumber = $highest_number;
						?>
					  @include('admin.courses-elements.editVideo',compact('topic_id','topic_video','highestnumber'))
					</div>
					<div id="edit_pdf" class="tabcontent">
					    <h3>Pdf</h3>
						<?php 
						$topic_id = $topic_id;
						$topics_pdf = $topics_pdf;
						$highestnumber = $highest_number;
						?>
						@include('admin.courses-elements.editPdf',compact('topic_id','topics_pdf','highestnumber'))
					</div>
					<div id="edit_quiz" class="tabcontent">
					    <h3>Quiz</h3>
						<?php 
						$topic_id = $topic_id;
						$topic_quiz = $topic_quiz;
						$highestnumber = $highest_number;
						?>
						@include('admin.courses-elements.editTopicQuiz',compact('topic_id','topic_quiz','highestnumber'))
					</div>
				</div>
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<link href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" />
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
	Dropzone.autoDiscover = false;
	function openData(evt, cityName) {
	  	var i, tabcontent, tablinks;
	  	tabcontent = document.getElementsByClassName("tabcontent");
	  	for (i = 0; i < tabcontent.length; i++) {
		    tabcontent[i].style.display = "none";
	  	}
	  	tablinks = document.getElementsByClassName("tablinks");
	  	for (i = 0; i < tablinks.length; i++) {
		    tablinks[i].className = tablinks[i].className.replace(" active", "");
	  	}
	  	document.getElementById(cityName).style.display = "block";
	  		evt.currentTarget.className += " active"; 
		}
		// Get the element with id="defaultOpen" and click on it
		document.getElementById("defaultOpen").click();
  		$(document).ready(function() {
  			$('#bckbtn').click(function(){
      		
    		});
    		
    		$(document).on("click",".add_lesson",function(){
    		    var topic_id = $(this).attr("data-id");
    		    $('.topic_id').val(topic_id);
    		});
    		
    		$("#save_lecture").click(function(e) {
      			e.preventDefault();
      			$.ajax({
					url: '{{ route("admin.savelectures") }}',
            		type: 'POST',
            		data:new FormData($("#add_lecture_form")[0]),
               		dataType:'JSON',
               		contentType: false,
           			cache: false,
               		processData: false,
            		success: function(response) {
                		if ($.isEmptyObject(response.error)) {
                    		window.location.reload();
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
        	$("#edit_lecture").click(function(e) {
      			e.preventDefault();
      			$.ajax({
					url: '{{ route("admin.edit_lecture") }}',
            		type: 'POST',
            		data:new FormData($("#edit_lecture_form")[0]),
               		dataType:'JSON',
               		contentType: false,
           			cache: false,
               		processData: false,
            		success: function(response) {
                		if ($.isEmptyObject(response.error)) {
                    		window.location.reload();
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
        	$(".edit_lectr_btn").click(function(e) {
          		e.preventDefault();
            	var lecture_id = $(this).attr('data-id');
            	var courseid = $(this).attr('data-value');
            	$.ajax({
          			url: '{{ route("admin.get_lecture_data") }}',
		            type: 'POST',
		            dataType: 'json',
		            data:{
		              lecture_id:lecture_id,
		              course_id:courseid
		            },
                	success: function(response) {
                        	$('#edit_title').val(response.data.title);
                        	$('#edit_lecture_id').val(response.data.id);
                        	$('#edit_duration').val(response.data.duration);
                        	$('#edit_price').val(response.data.price);
                        	$('#editlecture').modal('show');
                  	}
              	});
          	});
          	$('.topicbtn').click(function(){
                var id = $(this).attr('data-id');
                var courses_id = $(this).attr('data-value');
                $('#topic_lecture_id').val(id);
                 $('#topic_course_id').val(courses_id);
                $('#addtopic').modal('show');

            });

            $("#save_topic").click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route("admin.savetopic") }}',
                    type: 'POST',
                    data: new FormData($("#add_topic_form")[0]),
                    dataType:'JSON',
               		contentType: false,
           			cache: false,
               		processData: false, 
                    success: function (response) {
                        if ($.isEmptyObject(response.error)) {
                    		window.location.reload();
                		} else {
                    		printErrorMsg(response.error);
                		}
                    }
                });
            });

            $('.edit_topic_btn').click(function(e){
          		e.preventDefault();
          		var id = $(this).attr('data-id');
            	$.ajax({
          			url: '{{ route("admin.get_topic_data") }}',
		            type: 'POST',
		            dataType: 'json',
		            data:{id:id}, 
                	success: function(response) {
                	    if(response.status == 1){
                	        $("#edit_topic_video_title").val(response.topic_video_title);
                	        $("#edit_topic_video_url").val(response.topic_video_url);
                	        $("#edit_video_id").val(response.video_id);
                	        $("#edit_topic_video_duration").val(response.topic_video_duration);
                          $("#edit_topic_video_description").val(response.topic_video_description);
                	    }
                	    //console.log(response.data.topic_videos_data);
                		/*
                		$('#edit_topic_title').val(response.data.topic_name);
                		$('#topic_id').val(response.data.id);
                		$('#topic_lecture_id1').val(response.data.lecture_id);
                		$('#topic_course_id1').val(response.data.course_id);
                    	$('#edit_topic_duration').val(response.data.topic_duration);
                    	$('.topicvideocontrolappend').html(response.data.topic_videos_data);
                    	$('#edittopic').modal('show');
                    	*/
                  	}
              	});
            });

            $("#edit_topic").click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route("admin.edit_topic") }}',
                    type: 'POST',
                    data: new FormData($("#edit_topic_form")[0]),
                    dataType:'JSON',
               		contentType: false,
           			cache: false,
               		processData: false,
                    success: function (response) {
                        if ($.isEmptyObject(response.error)) {
                    		window.location.reload();
                		} else {
                    		printErrorMsg(response.error);
                		}
                    }
                });
            });
            
            
        	$("#edit_product").click(function(e) {
			    e.preventDefault();
			    var fd = new FormData();
			    $.ajax({
		            url: '{{ route("admin.updateproduct") }}',
		            type: 'POST',
		            data:new FormData($("#edit_course_form")[0]),
		               dataType:'JSON',
		               contentType: false,
		               cache: false,
		               processData: false,
            		success: function(response) {
                		if ($.isEmptyObject(response.error)) {
                    		
                		} else {
                    		printErrorMsg(response.error);
                		}
              		}
            	});
          	});
          	
          	
  		function printErrorMsg (msg) {
  		    console.log(msg)
    		$.each( msg, function( key, value ) {
      		$('.'+key+'_err').text(value);
    	    });
  	    }
       	$('.summernote-basic').summernote('fontName', 'Varela Round');
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
            		$("#uploadImage").attr('src',baseurl+'/researching_dev/public/assets/images/'+image);
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
          	$("#uploadImage").attr('src',baseurl+'/researching_dev/public/assets/images/'+res.image_name);
        },
        error: function (file, response) {
            return false;
        }
      });
    	$('.deletebtn').click(function(){
            var id = $(this).attr('data-id');
            $('#deleted_id').val(id);
            $('#deletelecture').modal('show');
        });

        $("#delete_data").click(function(e) {
            e.preventDefault();
            var deleted_id = $('#deleted_id').val();
            $.ajax({
                url: '{{ route("admin.deletelecture") }}',
                type: 'POST',
                dataType: 'json',
                    data: {
                    deleted_id:deleted_id
                },
                success: function (response) {
                    if(response.status == 1){
                        window.location.reload();
                    }else{
                        alert(response.msg);
                    }
                }
            });
        });
        
        

        $('.delete_topic').click(function(){
            var id = $(this).attr('data-id');
            $('#deleted_id').val(id);
            $('#deletetopic').modal('show');

        });
        

        $("#deletedata").click(function(e) {
            e.preventDefault();
            var deleted_id = $('#deleted_id').val();
            $.ajax({
                url: '{{ route("admin.deletetopic") }}',
                type: 'POST',
                dataType: 'json',
                    data: {
                    deleted_id:deleted_id
                },
                success: function (response) {
                    if(response.status == 1){
                        window.location.reload();
                    }else{
                        alert(response.msg);
                    }
                }
            });
        });

        $("#add_qustn_btn").click(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route("admin.savecourseqstn") }}',
                type: 'POST',
                data: new FormData($("#add_qustn_form")[0]),
                dataType:'JSON',
              contentType: false,
            cache: false,
              processData: false,
                success: function (response) {
                    if ($.isEmptyObject(response.error)) {
                    window.location.reload();
                } else {
                    printErrorMsg(response.error);
                }
                }
            });
        });

        $(".edit_question").click(function(e) {
          e.preventDefault();
          var id = $(this).attr('data-id');
          var courseid = $(this).attr('data-value');
          $.ajax({
            url: '{{ route("admin.get_qa_data") }}',
            type: 'POST',
            dataType: 'json',
            data:{
              id:id,
              course_id:courseid
            },
              success: function(response) {
                $('#edit_qustn').val(response.data.questions);
                $('#edit_answer').val(response.data.answers);
                $('#qa_id').val(response.data.id);
                $('#qa_course_id').val(response.data.course_id);
                $('#editqa').modal('show');
                }
            });
        });

        $("#edit_qa").click(function(e) {
          e.preventDefault();
      var fd = new FormData();
      $.ajax({
            url: '{{ route("admin.edit_qa") }}',
            type: 'POST',
            data:new FormData($("#edit_qa_form")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
            success: function(response) {
                if ($.isEmptyObject(response.error)) {
                    window.location.reload();
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
        $('.delete_qa').click(function(){
                var id = $(this).attr('data-id');
                $('#deleted_id').val(id);
                $('#deleted_qa').modal('show');
        });

        $("#deletedqa").click(function(e) {
            e.preventDefault();
            var deleted_id = $('#deleted_id').val();
            $.ajax({
                url: '{{ route("admin.deleteqa") }}',
                type: 'POST',
                dataType: 'json',
                    data: {
                    deleted_id:deleted_id
                },
                success: function (response) {
                    if(response.status == 1){
                        window.location.reload();
                    }else{
                        alert(response.msg);
                    }
                }
            });
        });
    });
    
    
    
    
    $("#add_topic_video").click(function(e) {
	    e.preventDefault();
	    var fd = new FormData();
	    $.ajax({
            url: '{{ route("admin.saveVideoByTopic") }}',
            type: 'POST',
            data:new FormData($("#add_topic_video_form")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
    		success: function(response) {
        		if ($.isEmptyObject(response.error)) {
            		window.location.reload();
        		} else {
            		printErrorMsg(response.error);
        		}
      		}
    	});
  	});
  	
    $("#edit_topic_video").click(function(e) {
	    e.preventDefault();
	    var fd = new FormData();
	    $.ajax({
            url: '{{ route("admin.editVideoByTopic") }}',
            type: 'POST',
            data:new FormData($("#edit_topic_video_form")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
    		success: function(response) {
        		if ($.isEmptyObject(response.error)) {
            		window.location.reload();
        		} else {
            		printErrorMsg(response.error);
        		}
      		}
    	});
  	});
</script>
<script>
    //var is_pdfhtml_appended = 0;
    $("#add_more_pdf_url").click(function(){
        var html = '<div class="col-lg-12">'+
                '<div class="form-group"> '+
                  '<label for="Bimage">קובץ מצורף</label>'+
                      '<div class="dropzone myDropzone" id="myDropzone">'+
                      '<div class="fallback">'+
                        '<input style="display:none" type="file"  name="uploadfile"  id="uploadfile"/>'+
                    '</div>'+
                      '<div class="dz-message needsclick">'+
                        '<i class="h3 text-muted dripicons-cloud-upload"></i>'+
                        '<h4>'+
                        'גרור ושחרר לוגו לכאן'+
                        '</h4>'+
                    '</div>'+
                    '</div>'+
                    '<span class="text-danger error-text imageName_err"></span>'+
                    '<div class="dropzone-previews mt-3" id="file-previews"></div>'+
                '</div>'+
                '</div>'+
                '<div class="col-md-1">'+
                    '<div class="form-group">'+  
                    '<label></label>'+
                        '<span class="btn btn-primary remove_pdf_div" style="margin-top: 10px;">×</span>'+
                    '</div>'+
                '</div>';
                //$(".topic_pdf_control_append").append(html);
            if($(".topic_pdf_control_append").html().length == 0){
                    $(".topic_pdf_control_append").append(html);
                    droupzone_fun();
            }
        });
        $(document).on('click','.remove_pdf_div',function(){
            $(this).parents('.topic_pdf_control_append').empty();
        });
    

    $(document).on('click','.add_more_video_url',function(){
        var html = 
        "<span class='row topic_video_url_main'><div class='col-md-1'>"+
        "<div class='form-group'>"+  
        "<label></label>"+
            "<span class='btn btn-primary remove_topic_div' style='margin-top: 10px;'>×</span>"+
        "</div>"+
        "</div>"+
        "<div class='col-md-6'>"+
        "<div class='form-group'>"+
            "<label>כתובת אתר וידאו</label>"+
            "<input id ='topic_video_url' name='topic_video_url[]' type='text'  class='form-control' placeholder='כתובת אתר וידאו'>"+
            "<span class='text-danger error-text topic_video_url_err'></span>"+
        "</div>"+
        "</div>"+
        "<div class='col-md-5'>"+
        "<div class='form-group'>"+
            "<label> כותרת סרטון </label>"+
            "<input id ='topic_video_title' name='topic_video_title[]' type='text'  class='form-control' placeholder='כותרת סרטון'>"+
            "<span class='text-danger error-text topic_video_title_err'></span>"+
        "</div>"+
        "</div></span>";
        $(".topicvideocontrolappend").append(html);
    });
    $(document).on('click','.remove_topic_div',function(){
        $(this).parents('.topic_video_url_main').remove();
    });

    /*****************************************************/
        var urll = "{{asset('assets/images/courseMaterials')}}";
        $("div#myAwesomeDropzones").dropzone({
      		url: "{{route('admin.uploadCourseMaterialFile')}}",
      		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      		maxFiles: 1,
      	    //  acceptedFiles: ".pdf,",
      	    //  acceptedFiles: ".jpeg,.jpg,.png,.gif",
      		addRemoveLinks: true,
      		removedfile: function(file) {
        		var _ref;
        		var image = $('#previousimage').val();
        		$("#uploadnames").text(image);
        		$("#uploadImages").attr('src',urll+image);
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
                $("#courseMaterialimg").val(res.image_name);
                $("#original_image_name").val(res.original_image_name);
            }
            $("#uploadname").html(res.image_name);
            $("#uploadImage").attr('src',urll.image_name);
        },
        error: function (file, response) {
            return false;
        }
      });
      
    $('.deleteMaterialfile').click(function(){
        var id = $(this).attr('data-id');
        $('#deleted_course_material_id').val(id);
        $('#deleteMaterialfile').modal('show');

    });
    $("#deleteMaterial").click(function(e) {
        e.preventDefault();
        var deleted_course_material_id = $('#deleted_course_material_id').val();
        $.ajax({
            url: '{{ route("admin.deleteCourseMaterial") }}',
            type: 'POST',
            dataType: 'json',
                data: {
                deleted_course_material_id:deleted_course_material_id
            },
            success: function (response) {
                if(response.status == 1){
                    window.location.reload();
                }else{
                    alert(response.msg);
                }
            }
        });
    });
    /*****************************************************/
    $(document).on("click",".add_video",function(){
        var chapter_id = $(this).attr('data-id');
        $("#chapter_id").val(chapter_id);
    });
    
    $("#save_video").click(function(e) {
        e.preventDefault();
        $.ajax({
            url: '{{ route("admin.saveVideoByTopic") }}',
            type: 'POST',
            data: new FormData($("#add_video_by_chapter")[0]),
            dataType:'JSON',
       		contentType: false,
   			cache: false,
       		processData: false,
            success: function (response) {
                if ($.isEmptyObject(response.error)) {
            		window.location.reload();
        		} else {
            		printErrorMsg(response.error);
        		}
            }
        });
    });
    
    $("#add_topic_pdf").click(function(e) {
        e.preventDefault();
        $.ajax({
            url: '{{ route("admin.add_topic_pdf") }}',
            type: 'POST',
            data: new FormData($("#add_topic_pdf_form")[0]),
            dataType:'JSON',
       		contentType: false,
   			cache: false,
       		processData: false,
            success: function (response) {
                if ($.isEmptyObject(response.error)) {
            		window.location.reload();
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



   // function droupzone_fun(){
        $("div#myDropzone").dropzone({
      		url: "{{route('admin.topic_pdf')}}",
      		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      		maxFiles: 1,
      	      acceptedFiles: ".pdf,",
      	    //  acceptedFiles: ".jpeg,.jpg,.png,.gif",
      		addRemoveLinks: true,
      		removedfile: function(file) {
        		var _ref;
        		var image = $('#previousimage').val();
        		$("#uploadnames").text(image);
        		$("#uploadImages").attr('src',urll+image);
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
                console.log(res.image_name);
                $('#pdfimageName').val(res.image_name);
                $("#courseMaterialimg").val(res.image_name);
                $("#original_image_name").val(res.original_image_name);
            }
            $("#uploadname").html(res.image_name);
            $("#uploadImage").attr('src',urll.image_name);
        },
        error: function (file, response) {
            return false;
            }
        });
    //}

    
    $(document).on("click",".delete_topic_video",function(){
       var videoId = $(this).attr("data-id");
       $("#deleteTopicVideo").attr("video_id_delete",videoId);
    });
    $("#deleteTopicVideo").click(function(e) {
        e.preventDefault();
        var deleted_id = $(this).attr('video_id_delete');
        $.ajax({
            url: '{{ route("admin.deleteVideo") }}',
            type: 'POST',
            dataType: 'json',
                data: {
                deleted_id:deleted_id
            },
            success: function (response) {
                if(response.status == 1){
                    window.location.reload();
                }else{
                    alert(response.msg);
                }
            }
        });
    });
    
    $(document).on("click",".delete_topic_pdf",function(){
       var pdfId = $(this).attr("data-id");
       $("#deleteTopicPdf").attr("pdf_id_delete",pdfId);
    });
    $("#deleteTopicPdf").click(function(e) {
        e.preventDefault();
        var deleted_id = $(this).attr('pdf_id_delete');
        $.ajax({
            url: '{{ route("admin.deletePdf") }}',
            type: 'POST',
            dataType: 'json',
                data: {
                deleted_id:deleted_id
            },
            success: function (response) {
                if(response.status == 1){
                    window.location.reload();
                }else{
                    alert(response.msg);
                }
            }
        });
    });
    
    
    /*=======================
       Topic quiz code here
    =========================*/
    $('#questiontype').on('change', function() {
      var inputBox = document.getElementsByClassName('quizoption');
      if(this.value == '1'){
        $('#text_options').css('display','block');
        $('#image_options').css('display','none');
      }else{
        $('#text_options').css('display','none');
        $('#image_options').css('display','block');
      }
    });
    
    $("#add_topic_question").click(function(e) {
        e.preventDefault();
        $.ajax({
            url: '{{ route("admin.savetopicquestions") }}',
            type: 'POST',
            data:new FormData($("#add_topic_quiz_form")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
            success: function(response) {
                if ($.isEmptyObject(response.error)) {
                    window.location.reload();
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
    
    

    
    
    
    /***************
     * Add Quiz 
    /**************/
    $("#add_quiz").click(function(e) {
  		e.preventDefault();
  		$.ajax({
			url: '{{ route("admin.saveTopicQuiz") }}',
    		type: 'POST',
    		data:new FormData($("#add_quiz_form")[0]),
       		dataType:'JSON',
       		contentType: false,
   			cache: false,
       		processData: false,
    		success: function(response) {
        		if ($.isEmptyObject(response.error)) {
            		window.location.reload();
        		} else {
            		printErrorMsg(response.error);
        		}
      		}
    	});
  	});
  	
  	/******************
     * Delete Quiz 
    /*****************/
  	$(document).on("click",".deletequiz",function(){
       var deleteQuizId = $(this).attr("data-id");
       $("#deleteTopicQuiz").attr("deleteTopicQuizid",deleteQuizId);
    });
    $("#deleteTopicQuiz").click(function(e) {
        e.preventDefault();
        var deleted_id = $(this).attr('deleteTopicQuizid');
        $.ajax({
            url: '{{ route("admin.deleteTopicQuiz") }}',
            type: 'POST',
            dataType: 'json',
                data: {
                deleted_id:deleted_id
            },
            success: function (response) {
                if(response.status == 1){
                    window.location.reload();
                }else{
                    alert(response.msg);
                }
            }
        });
    });
    
    /*****************
     * Get Edit Quiz 
    /*****************/
    $(".edit_quiz").click(function() {
        var quiz_id = $(this).attr("data-id");
        $(".quiz_id").val(quiz_id);
  		
  		$.ajax({
			url: '{{ route("admin.getTopicQuiz") }}',
    		type: 'GET',
    		data: {quiz_id:quiz_id},
       		dataType:'JSON',
    		success: function(response) {
        		if ($.isEmptyObject(response.error)) {
            		if(response.status == 1){
            		    $(".editquizTitle").val(response.quiz_title);
            		}
        		} else {
            		printErrorMsg(response.error);
        		}
      		}
    	});
  	});
    
    
    
    
    /***************
     * Update Quiz 
    /**************/
    $("#edit_quiz_btn").click(function(e) {
  		e.preventDefault();
  		$.ajax({
			url: '{{ route("admin.updateTopicQuiz") }}',
    		type: 'POST',
    		data:new FormData($("#edit_quiz_form")[0]),
       		dataType:'JSON',
       		contentType: false,
   			cache: false,
       		processData: false,
    		success: function(response) {
        		if ($.isEmptyObject(response.error)) {
            		window.location.reload();
        		} else {
            		printErrorMsg(response.error);
        		}
      		}
    	});
  	});
    
    /**********************************
     * Drag and Drop video , pdf, quiz
    /**********************************/
    $("#container").sortable({
      update: function(e, ui) {
        
        $("#container div").each(function(i, elm) {
          $elm = $(elm); // cache the jquery object
          $elm.attr("id", $elm.index("#container div"));
          // below is just for demo purpose
          $elm.text($elm.text().split("id")[0] + "id: " + $elm.attr("id"));
        });
      }
    });
    
    $(document).on("click",'.updatedorders',function(){
        var dragable_arr = [];
        $( ".draggable" ).each(function( index ) {
            dragable_arr.push({'table-id':$(this).attr('table-id'),'table-type':$(this).attr('table-type'),'order-id':$(this).attr('order-id')});
        });
        $.ajax({
			url: '{{ route("admin.reArrangeChapterElements") }}',
    		type: 'POST',
    		data:{dragable_arr:dragable_arr},
       		dataType:'JSON',
       		/*contentType: false,
   			cache: false,
       		processData: false,*/
    		success: function(response) {
    		    if(response.status > 0){
    		        window.location.reload();
    		    }
        		else {
            		printErrorMsg(response.error);
        		}
      		}
    	});
    });
</script>
@endsection