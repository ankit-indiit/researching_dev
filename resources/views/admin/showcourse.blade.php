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
                <a href="products.php" class="btn btn-primary  mb-3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Back to products</font></font></a>
			 </div>
			</div>
            <div class="row">
              <div class="col-md-12">
              	<div class="courses-sections-details">
	                <div class="tab">
					  <button class="tablinks" onclick="openData(event, 'edit_course')" id="defaultOpen">Edit Course</button>
					  <button class="tablinks" onclick="openData(event, 'course_lectures')">Course Lectures</button>
					  <button class="tablinks" onclick="openData(event, 'course_chapters')">Course Chapters</button>
					  <!-- <button class="tablinks" onclick="openData(event, 'related_course')">Related Courses</button> -->
					  <button class="tablinks" onclick="openData(event, 'question_answer')">Question Answers</button>
					  <!-- <button class="tablinks" onclick="openData(event, 'reviews_ratings')" >Reviews/Ratings</button> -->
					</div>

					<div id="edit_course" class="tabcontent">
						<h3>Edit Course</h3>
					  @include('admin.courses.editcourse')
					</div>

					<div id="course_lectures" class="tabcontent">
						<h3>Course Lectures</h3>
						<?php $course_id = $courseid;
						$lectures = $lectures;
						?>
						@include('admin.courses.courselectures',compact('course_id','lectures'))
					</div>

					<div id="course_chapters" class="tabcontent">
					  <h3>Course Chapters</h3>
					  <?php $course_id = $courseid;
						$topics = $topics;
						?>
					  @include('admin.courses.coursetopics',compact('course_id','topics'))
					</div>
					<div id="related_course" class="tabcontent">
					  <h3>Related Course</h3>
					</div>
					<div id="question_answer" class="tabcontent">
					  <h3>Question Answers</h3>
                    <?php 
                    $course_id = $courseid;
                    $questions_data =$questions_data;
                    
                    ?>
                    @include('admin.courses.coursequestions',compact('course_id',$questions_data))
					</div>
					<div id="reviews_ratings" class="tabcontent">
					  <h3>Reviews Ratings</h3>
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
      			window.location.href = '{{route("admin.Productslisting").'/'.$degreeid.'/'.$universityid}}';
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
            	var lecture_id = $(this).attr('data-value');
            	var courseid = $(this).attr('data-course');
            	$.ajax({
          			url: '{{ route("admin.get_topic_data") }}',
		            type: 'POST',
		            dataType: 'json',
		            data:{
		              id:id,
		              lecture_id:lecture_id,
		              course_id:courseid
		            },
                	success: function(response) {
                	    //console.log(response.data.topic_videos_data);
                		$('#edit_topic_title').val(response.data.topic_name);
                		$('#topic_id').val(response.data.id);
                		$('#topic_lecture_id1').val(response.data.lecture_id);
                		$('#topic_course_id1').val(response.data.course_id);
                    	$('#edit_topic_duration').val(response.data.topic_duration);
                    	$('.topicvideocontrolappend').html(response.data.topic_videos_data);
                    	$('#edittopic').modal('show');
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
                    		window.location.href = '{{route("admin.Productslisting").'/'.$degreeid.'/'.$universityid}}';
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
</script>
<script>
    $(document).on('click','.add_more_video_url',function(){
        var html = "<div class='topic_video_url_main'>"+
                    "<div class='form-group mb-3'>"+
                        "<label> כותרת סרטון </label>"+
                        "<input id ='topic_video_title' name='topic_video_title[]' type='text'  class='form-control' placeholder='כותרת סרטון'>"+
                        "<span class='text-danger error-text topic_video_title_err'></span>"+
                    "</div>"+
                    "<div class='form-group mb-3'>"+
                        "<label>כתובת אתר וידאו</label>"+
                        "<input id ='topic_video_url' name='topic_video_url[]' type='text'  class='form-control' placeholder='כתובת אתר וידאו'>"+
                        "<span class='text-danger error-text topic_video_url_err'></span>"+
                        "<span class='btn btn-primary remove_topic_div' style='margin-top: 10px;'>×</span>"+
                    "</div>"+
                    "</div>";
        $(".topicvideocontrolappend").append(html);
    });
    $(document).on('click','.remove_topic_div',function(){
        $(this).parents('.topic_video_url_main').remove();
    });
    
</script>

@endsection

