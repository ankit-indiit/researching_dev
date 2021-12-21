@extends('admin.layouts.app')

@section('title', ' להוסיף חידון ')
@section('content')
<?php 
$is_logged_in = session()->get('admin_logged_in');
        
if(!isset($is_logged_in) && $is_logged_in != '1'){
            
    return redirect()->route('admin.adminLogin')->send();
        }

?>
<?php 
if(Session :: has ('quiz_data') || !empty (Session :: get ('quiz_data'))){
  $data = session()->get('quiz_data');
  $topic_id = $data['topic_id'];
  $lecture_id = $data['lecture_id'];
  $course_id = $data['course_id'];
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
                <li class="breadcrumb-item"><a href="javascript: void(0);">
                  ערוך מוצרים
                </a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.quizlisting')}}">חִידוֹן</a></li>
                <li class="breadcrumb-item active">
                  ערוך חידון
                </li>
              </ol>
            </div>
            <h4 class="page-title">
              ערוך חידון
            </h4>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row" style="direction:rtl">
                <div class="col-md-6 text-right">
                  <h4 class="header-title mb-3">הוסף חידון</h4>
                </div>
                <div class="col-md-6 text-left">
                  <a href="{{route('admin.quizlisting')}}" class="btn btn-primary  mb-3">חזרה לחידון</a>
                </div>
              </div>
<form method="POST" id = "edit_quiz_form" action="{{ route('admin.updatequiz') }}" enctype="multipart/form-data">
@csrf()
<input type="hidden" name="topic_id" id="topic_id" value="{{$topic_id}}">
<input type="hidden" name="lecture_id" id="lecture_id" value="{{$lecture_id}}">
<input type="hidden" name="course_id" id="course_id" value="{{$course_id}}">
<input type="hidden" name="quiz_id" id="quiz_id" value="{{$quiz_value->id}}">
              <div class="row">
                <div class="col-lg-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>
                          נושא החידון
                        </label>
                        <input type="text" value="{{$quiz_value->quizTopic}}" name="quiz_title" id ="quiz_title" class="form-control" placeholder=" הזן נושא חידון " >
                        <span class="text-danger error-text quiz_title_err"></span>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group  questionarea">
                        <label for="question">
                          תיאור חידון
                        </label>   
                        <textarea name ="quiz_description" id="quiz_description" rows="4"  class="form-control" placeholder=" הזן תיאור חידון " >{{$quiz_value->quizdescription}}</textarea>
                        <span class="text-danger error-text quiz_description_err"></span>
                      </div>
                    </div>
                  </div>
                  <div class ="row">
                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="video">
                        סימנים
                      </label>
                      <input type="text" name="quiz_marks" id="quiz_marks" value="{{$quiz_value->perQuestionMarks}}" class="form-control" placeholder=" הזן סימנים לכל שאלה " >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="video">
                        ימים
                      </label>
                      <input type="text" name="quiz_days" id="quiz_days" value="{{$quiz_value->days}}" class="form-control" placeholder=" הזן את הימים המגיעים " >
                    </div>
                  </div>
                </div>
                <?php 
                $checked = '';
                $attempt = $quiz_value->quiz_attempt;
                if($attempt == 0){
                  $checked = '';
                }else{
                  $checked = 'checked = checked';
                }
                ?>
                <input type="hidden" name="checked_value" value="{{$quiz_value->quiz_attempt}}">
                <div class="row">
                  <div class="col-md-12">
                    <input type="checkbox" name ="reattempt" id="is_attemped" value='{{$quiz_value->quiz_attempt}}' {{$checked}}>
                    <label >
                      חידון ניסיון חוזר
                    </label>
                  
                </div>
                </div>
              <div class="row mt-3">
                <div class="col-12 text-center">
                  <button type="button" id = "update_btn" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                  <button type="button" id="edit_bck" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
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
    $(document).ready(function() {

      $('#is_attemped').change(function(){
        if($(this).attr('checked')){
          $('checked_value').val('1');
        }else{
          $('checked_value').val('0');
      }
    });
        
        $('#edit_bck').click(function(){
            window.location.href = "{{route('admin.quizlisting').'/'.$topic_id . '/' . $lecture_id . '/' . $course_id}}";

        });

      
      $("#update_btn").click(function(e) {
        e.preventDefault();
         
        $.ajax({
            url: '{{ route("admin.updatequiz") }}',
            type: 'POST',
            data:new FormData($("#edit_quiz_form")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
            success: function(response) {
                if ($.isEmptyObject(response.error)) {
                    window.location.href = "{{route('admin.quizlisting').'/'.$topic_id . '/' . $lecture_id . '/' . $course_id}}";
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
    });
</script>
@endsection