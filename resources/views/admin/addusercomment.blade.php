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
                <li class="breadcrumb-item active">הוסף המלצה</li>
              </ol>
            </div>
            <h4 class="page-title">הוסף המלצה</h4>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">
          <div class="card-box">
            <div class="row" style="direction:rtl">
              <div class="col-md-6 text-right">
                <h4 class="header-title mb-3">הוסף המלצה</h4>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <form method="POST" id = "add_comment_form" action="{{ route('admin.saveuserrecommend') }}" enctype="multipart/form-data">
                @csrf()
                <input type ="hidden" name="user_id" id="user_id" value="{{$user_id}}"/>
                  <div class="row">
                  
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="recommendation_type">
                          הוסף היכן שברצונך להוסיף המלצות
                        </label>
                        <select id="recommendation_type" name="recommendation_type" class="form-control" required="required">
                          <option value="">
                            בחר סוג
                          </option>    
                          <option value="website">
                            אתר אינטרנט
                          </option> 
                          <option value="instructor">
                            מַדְרִיך
                           </option> 
                          <option value="course">
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
                          <option data-id = "{{ $course->course_id}}" data-type = "0" value="{{ $course->course_id }}">{{ $course->course_name }}</option> 
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
                            select instructor
                          </option>    
                          @foreach($instructor_data as $instructor)
                          <option data-id = "{{ $instructor->id}}" data-type = "0" value="{{ $instructor->id }}">{{ $instructor->first_name }}</option> 
                          @endforeach 
                        </select>
                        <span id="errMsg1"></span>
                      </div>
                    </div>
                    
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="recommed">המלצה</label>
                        <textarea type="text" id="recommed" rows="4" name="recommed_desc" class="form-control" placeholder="המלצה"></textarea>
                        <span class="text-danger error-text recommed_desc_err"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-12 text-center">
                      <button type="submit" id="addreccmdbtn" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                      <button id="backbtn" type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
                    </div>
                  </div>
                </form>
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
    $(document).ready(function() {
        $('#backbtn').click(function(){
      window.location.href = '{{route("admin.userslisting")}}';
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
        
      $("#addreccmdbtn").click(function(e) {
        e.preventDefault();
        if($('#recommendation_type').val() == 'course' && $('#course_selected').val() == ''){
            $("#errMsg").css("color", "red");
            $("#errMsg").html(" אנא בחר את הקורס   ");
            return 0;
         
        }else if($('#recommendation_type').val() == 'instructor' && $('#instructor_selected').val() == '' ){
            $("#errMsg1").css("color", "red");
            $("#errMsg1").html(" אנא בחר את המדריך  ");
            return 0;
        }else{
          var fd = new FormData();
        $.ajax({
            url: '{{ route("admin.saveuserrecommend") }}',
            type: 'POST',
            data:new FormData($("#add_comment_form")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
            success: function(response) {
                if ($.isEmptyObject(response.error)) {
                    window.location.href = '{{route("admin.userslisting")}}';
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
    });
</script>
@endsection