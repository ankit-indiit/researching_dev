@extends('admin.layouts.app')
@section('title', ' משתמשים ')
@section('content')
<?php 
$is_logged_in = session()->get('admin_logged_in');
        
if(!isset($is_logged_in) && $is_logged_in != '1'){
            
    return redirect()->route('admin.adminLogin')->send();
        }

?>
<div class="content-page">
    <div class="content">
    <!-- Start Content-->
        <div class="container-fluid">
        <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">בית</a></li>
                                <li class="breadcrumb-item active">  תצוגת המלצה</li>
                            </ol>
                        </div>
                        <h4 class="page-title"> תצוגת המלצה </h4>
                    </div>
                </div>
            </div>     
        <!-- end page title --> 
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="direction:rtl">
                        <div class="col-md-6 text-right">
                            <h4 class="header-title mb-3">פרט המלצה  </h4>
                        </div>
                    </div>
<form method="POST" id = "edit_comment_form" action="{{ route('admin.updaterecommend') }}" enctype="multipart/form-data">
                @csrf()
    <input type="hidden" name="comment_id" id="comment_id" value="{{$id}}">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class=" profile_user">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <?php 
                                         $image =  asset('/assets/users/' .$user_image);

                                        ?>
                                        <div class="user-image "> 
                                            <img class="rounded-circle img-thumbnail" src="{{$image}}">
                                            <h5><b>{{$user_name}}</b></h5>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div> 
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>שם תלמיד</label>
                                        <p>{{$user_name}}</p>
                                    </div>
                                </div>
                        <?php 
                        if($comment_type == 'website'){?>

                        <?php }else if($comment_type == 'course'){?>
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label>שם מוסד   </label>
                                        <p>{{$university_name}}</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>שם התואר  </label>
                                        <p>{{$degree_name}} </p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> שם הקורס    </label>
                                        <p>{{$course_name}}   </p>
                                    </div>
                                </div>
                        <?php }else {?>
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label>שם מוסד   </label>
                                        <p>{{$university_name}}</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>שם התואר  </label>
                                        <p>{{$degree_name}} </p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> שם הקורס    </label>
                                        <p>{{$instructor_name}}   </p>
                                    </div>
                                </div>
                                <?php }?>
                                <div class="col-md-12">
                      <div class="form-group">
                        <label for="recommendation_type">
                            הוסף היכן שברצונך להוסיף המלצות
                        </label>
                        <select id="recommendation_type" name="recommendation_type" class="form-control" required="required">
                          <option value="">
                              בחר סוג
                          </option>    
                          <option <?php if ($comment_type == 'website') echo ' selected="selected"'; ?> value="website">
                              אתר אינטרנט
                          </option> 
                          <option <?php if ($comment_type == 'instructor') echo ' selected="selected"'; ?> value="instructor">מַדְרִיך </option> 
                          <option <?php if ($comment_type == 'course') echo ' selected="selected"'; ?> value="course">
                              קוּרס
                          </option> 
                        </select>
                        <span class="text-danger error-text recommendation_type_err"></span>
                      </div>
                    </div>

                    <?php 
                      $course_data = DB::table('courses')->get();
                    ?>
                    <div class="col-md-12 getcourses" style="display: none;">
                      <div class="form-group">
                        <label for="course_selected">
                            בחר את הקורס
                        </label>
                        <select id="course_selected" name="course_selected" class="form-control" required="required">
                          <option value="">
                              בחר קורס
                          </option>   
                          @foreach($course_data as $course)
                          <option <?php if ($course_id == $course->course_id) echo ' selected="selected"'; ?> data-id = "{{ $course->course_id}}" data-type = "0" value="{{ $course->course_id }}">{{ $course->course_name }}</option> 
                          @endforeach  
                        </select>
                        <span id="errMsg"></span>
                      </div>
                    </div>
                    <?php 
                      $instructor_data = DB::table('instructors')->get();
                    ?>
                    <div class="col-md-12 getinstructors" style="display: none;">
                      <div class="form-group">
                        <label for="instructor_selected">
                            בחר מדריך
                        </label>
                        <select id="instructor_selected" name="instructor_selected" class="form-control" required="required">
                          <option value="">
                              בחר מדריך
                          </option>    
                          @foreach($instructor_data as $instructor)
                          <option <?php if ($instructor->id == $instructor->id) echo ' selected="selected"'; ?> data-id = "{{ $instructor->id}}" data-type = "0" value="{{ $instructor->id }}">{{ $instructor->first_name }}</option> 
                          @endforeach 
                        </select>
                        <span id="errMsg1"></span>
                      </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>סיכום</label>
                                    <textarea name="recommed_desc" id="recommed_desc" class="form-control" rows="4" placeholder="סיכום">{{$description}}</textarea>
                                    <span class="text-danger error-text recommed_desc_err"></span>
                                </div>
                            </div>
                        </div>  
                        <div class="col-md-12 text-right">
                            <button type="submit" id="edit_comment_btn" class="btn btn-primary waves-effect waves-light"><i class="fe-check-circle mr-1"></i> לשמור</button>
                            <button id="backbtn" type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
                        </div>
                </div>
                </div>
            </div>
        </div> <!-- end card-->
    </form>
    </div> <!-- end col-->
</div>
</div> 


                </div>

                
            </div>
        </div>
</div>




@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(e){

         $('#backbtn').click(function(){
      window.location.href = '{{route("admin.recommendation")}}';
    });

        $('#recommendation_type').change(function(){
      var selected_value = $(this).val();
      if(selected_value == 'course'){
        $('.getcourses').css('display','block');
        $('.getinstructors').css('display','none');
      }else if(selected_value == 'instructor'){
        $('.getcourses').css('display','none');
        $('.getinstructors').css('display','block');
      }else{
        $('.getcourses').css('display','none');
        $('.getinstructors').css('display','none');
      }
    });

        $("#edit_comment_btn").click(function(e) {
        e.preventDefault();
        if($('#recommendation_type').val() == 'course' && $('#course_selected').val() == ''){
            $("#errMsg").css("color", "red");
            $("#errMsg").html("אנא בחר את הקורס");
            return 0;
         
        }else if($('#recommendation_type').val() == 'instructor' && $('#instructor_selected').val() == '' ){
            $("#errMsg1").css("color", "red");
            $("#errMsg1").html(" אנא בחר את המדריך   ");
            return 0;
        }else{
          var fd = new FormData();
        $.ajax({
            url: '{{ route("admin.updaterecommend") }}',
            type: 'POST',
            data:new FormData($("#edit_comment_form")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
            success: function(response) {
                if ($.isEmptyObject(response.error)) {
                    window.location.href = '{{route("admin.recommendation")}}';
                } else {
                    printErrorMsg(response.error);
                }
              }
            });
        }
         
      });
        function printErrorMsg (msg) {
           $.each( msg, function( key, value ) {
              $('.'+key+'_err').text(value);
            });
        }
    })
</script>
@endsection



