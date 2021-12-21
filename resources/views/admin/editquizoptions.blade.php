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
                <li class="breadcrumb-item"><a href="{{route('admin.quizlisting').'/'.$topic_id . '/' .$lecture_id . '/' . $course_id}}">חִידוֹן</a></li>
                <li class="breadcrumb-item active">
                  ערוך את שאלת החידון
                </li>
              </ol>
            </div>
            <h4 class="page-title">
              ערוך את שאלת החידון
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
                  <h4 class="header-title mb-3">
                    ערוך חידון
                  </h4>
                </div>
                <div class="col-md-6 text-left">
                  <a href="{{route('admin.addquizquestions').'/'.$question_data->quiz_id}}" class="btn btn-primary  mb-3">חזרה לחידון</a>
                </div>
              </div>
<form method="POST" id = "edit_quiz_questions_form" action="{{ route('admin.updatequizquestions') }}" enctype="multipart/form-data">
@csrf()
<input type="hidden" name="topic_id" id="topic_id" value="{{$topic_id}}">
<input type="hidden" name="lecture_id" id="lecture_id" value="{{$lecture_id}}">
<input type="hidden" name="course_id" id="course_id" value="{{$course_id}}">
<input type="hidden" name="quiz_id" id="quiz_id" value="{{$question_data->quiz_id}}">
<input type="hidden" name="edit_quiz_id" id="edit_quiz_id" value="{{$question_data->id}}">

              <div class="row">
                <div class="col-lg-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="questiontype">סוג שאלה</label>
                        <select  id="questiontype" name="questiontype" class="form-control" placeholder="סוג שאלה">
                          <?php 
                          $type = $question_data->questionType;
                          $img_selected = '';
                          $text_selected = '';
                          if($type == '0'){
                            $text_selected = 'selected';
                            $img_selected = '';
                          }else{
                            $text_selected = '';
                            $img_selected = 'selected';
                          }
                          ?>
                          <option  value ="">
                            בחר סוג
                          </option>
                          <option {{$text_selected}} value="0">
                            שאלות מסוג טקסט
                          </option>
                          <option {{$img_selected}} value="1">
                            שאלות מסוג תמונה
                          </option>
                        </select>
                        <span class="text-danger error-text questiontype_err"></span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group  questionarea">
                        <label for="question">
                          שְׁאֵלָה
                        </label>   <textarea rows="9" name="questionarea" id="questionarea" class="form-control" placeholder=" הזן שאלה להוסיף " >{{$question_data->question}}</textarea>
                        <span class="text-danger error-text questionarea_err"></span>
                      </div>
                        <div class="form-group  questionarea">
                        <label for="question">
                          תשובה
                        </label>
                        <?php 
                        $answer = $question_data->Answer;
                        $opt1_selected = '';
                        $opt2_selected = '';
                        $opt3_selected = '';
                        $opt4_selected = '';
                        if($answer == '1'){
                          $opt1_selected = 'selected';
                          $opt2_selected = '';
                          $opt3_selected = '';
                          $opt4_selected = '';
                        }elseif ($answer == '2') {
                          $opt1_selected = '';
                          $opt2_selected = 'selected';
                          $opt3_selected = '';
                          $opt4_selected = '';
                        }elseif ($answer == '3') {
                          $opt1_selected = '';
                          $opt2_selected = '';
                          $opt3_selected = 'selected';
                          $opt4_selected = '';
                        }else{
                          $opt1_selected = '';
                          $opt2_selected = '';
                          $opt3_selected = '';
                          $opt4_selected = 'selected';
                        }
                        ?>
                         <select  id="ans_option" name="ans_option" class="form-control" placeholder="סוג שאלה">
                          <option  value =" ">
                            בחר תשובה
                          </option>
                          <option  {{$opt1_selected}} value="1">
                            אפשרות A.
                          </option>
                          <option {{$opt2_selected}} value="2">
                            אפשרות B.
                          </option>
                          <option {{$opt3_selected}} value="3">
                            אפשרות C.
                          </option>
                          <option {{$opt4_selected}} value="4">
                            אפשרויות
                          </option>
                        </select>
                        <span class="text-danger error-text ans_option_err"></span>
                      </div>
                    </div>
                    <?php 
                    $quest_type = $question_data->questionType;
                    if($quest_type == '0'){
                      $value1 = $question_data->optionA;
                      $value1 = $question_data->optionB;
                      $value1 = $question_data->optionC;
                      $value1 = $question_data->optionD;
                    }else{

                    }
                    ?>
                    <div class="col-md-6" id ="text_options" style="display:block;">
                      <div class="form-group">
                        <label>
                          אפשרות A
                        </label>
                        <input name = "option_a" id ="option_a" type="text" value="{{$value1}}" class="form-control quizoption" placeholder=" הזן אפשרות ראשונה " required>
                        <span class="text-danger error-text option_a_err"></span>
                      </div>
                      <div class="form-group">
                        <label>
                          אפשרות B
                        </label>
                        <input name = "option_b" id="option_b" type="text" value="{{$value1}}" class="form-control quizoption" placeholder=" הזן אפשרות שנייה " required>
                        <span class="text-danger error-text option_b_err"></span>
                      </div>
                      <div class="form-group">
                        <label>
                          אפשרות C
                        </label>
                        <input name = "option_c" id="option_c" type="text" value="{{$value1}}" class="form-control quizoption" placeholder=" הזן אפשרות שלישית " required>
                        <span class="text-danger error-text option_c_err"></span>
                      </div>
                      <div class="form-group">
                        <label>
                          אפשרות D
                        </label>
                        <input name = "option_d" id="option_d" type="text" class="form-control quizoption" placeholder=" הזן את האפשרות הרביעית " required>
                        <span class="text-danger error-text option_d_err"></span>
                      </div>
                    </div>
                    <div class="col-md-6" id ="image_options" style="display:none;">
                      <div class="form-group">
                        <label>
                          אפשרות A
                        </label>
                        <input name = "option[]"  type="file" class="form-control quizoption" placeholder=" הזן אפשרות ראשונה " required>
                        <span class="text-danger error-text option_a_err"></span>
                      </div>
                      <div class="form-group">
                        <label>
                          אפשרות B
                        </label>
                        <input name = "option[]"  type="file" class="form-control quizoption" placeholder=" הזן אפשרות שנייה " required>
                        <span class="text-danger error-text option_b_err"></span>
                      </div>
                      <div class="form-group">
                        <label>
                          אפשרות C
                        </label>
                        <input name = "option[]" type="file" class="form-control quizoption" placeholder=" הזן אפשרות שלישית " required>
                        <span class="text-danger error-text option_c_err"></span>
                      </div>
                      <div class="form-group">
                        <label>
                          אפשרות D
                        </label>
                        <input name = "option[]" type="file" class="form-control quizoption" placeholder=" הזן את האפשרות הרביעית " required>
                        <span class="text-danger error-text option_d_err"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                      <label for="video">
                        הוסף תמונה לשאלה
                      </label>
                      <input type="file" id = 'quest_image' name="quest_image" class="form-control" name="fileToUpload" id="fileToUpload">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="video">
                        הוסף קישור וידאו
                      </label>
                      <input type="text" value = "{{$question_data->questionLink}}" id="quest_video" name="quest_video" class="form-control" placeholder=" הוסף קישור וידאו  ">
                    </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-12 text-center">
                    <button type="button" id="edit_quiz_question" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                    <button type="button" id="back_btn" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
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
  <script>$('.summernote-basic').summernote('fontName', 'Varela Round');</script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#questiontype').on('change', function() {
        {
          var inputBox = document.getElementsByClassName('quizoption');
          if(this.value == '1'){
            $('#text_options').css('display','none');
            $('#image_options').css('display','block');
          }else{
            $('#text_options').css('display','block');
            $('#image_options').css('display','none');
          }
        }
      });

      $('#back_btn').click(function(){
            window.location.href = "{{route('admin.addquizquestions').'/'.$question_data->quiz_id}}";

        });

      $("#edit_quiz_question").click(function(e) {
        e.preventDefault();
         
        $.ajax({
            url: '{{ route("admin.updatequizquestions") }}',
            type: 'POST',
            data:new FormData($("#edit_quiz_questions_form")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
            success: function(response) {
                if ($.isEmptyObject(response.error)) {
                    window.location.href = "{{route('admin.addquizquestions').'/'.$question_data->quiz_id}}";
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