@extends('admin.layouts.app')

@section('title', ' מוֹסָד ')
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
                <li class="breadcrumb-item"><a href="{{route('admin.editChapter',['topic_id'=>$topic_id]) }}">חִידוֹן</a></li>
                <li class="breadcrumb-item active">
                שאלות חידון
                </li>
              </ol>
            </div>
            <h4 class="page-title">
              שאלות חידון
            </h4>
          </div>
        </div>
      </div>
        <!--******************************-->
        <div class="row">
                <div class="col-lg-12">
                  <div class="card-box">
                    <div class="row" style="direction:rtl">
                      <div class="col-md-6 text-right">
                        <!--<h4 class="header-title mb-3">חִידוֹן</h4>-->
                      </div>
                      <div class="col-md-6 text-left">
                        <a href="{{ route('admin.addquizoptions',['id'=>$quiz_id]) }}" class="btn btn-primary  mb-3">
                           הוסף שאלת חידון
                        </a>
                        <a  href="{{route('admin.editChapter',['topic_id'=>$topic_id]) }}"  class="btn btn-primary  mb-3">
                           חזרה למוצרים
                        </a>
                      </div>
                      
                    </div>
                    <div class="table-responsive">
                      <table  id="basic-datatable" class="table  table-hover table-nowrap table-centered m-0">
                        <thead class="thead-light">
                          <tr>
                            <th>
                              S לא.
                            </th>
                            <th colspan="2">שאלות<th>
                            <th>
                              א
                            </th>
                            <th>
                              ב
                            </th>
                            <th>
                              ג
                            </th>
                            <th>
                              ד
                            </th>
                            <th>
                              תשובה
                            </th>
                            <th>
                              סוּג
                            </th>
                            <th>
                              פעולות
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          if(!empty($questions)){
                          foreach ($questions as $key => $value) {
                            $type = $value['questionType'];
                            $radio = '';
                            if($type == '1'){
                              $option1 = $value['optionA'];
                              $option2 = $value['optionB'];
                              $option3 = $value['optionC'];
                              $option4 = $value['optionD'];
                              $radio ='text';
                              $answer = $value['answer'];
                              $final = '';
                              if($answer == '1'){
                                $final = $value['optionA'];
                              }elseif($answer == '2'){
                                $final = $value['optionB'];
                              }elseif($answer == '3'){
                                $final = $value['optionC'];
                              }else{
                                $final = $value['optionD'];
                              }
                            }else{
                              $option1 = asset('/assets/topic_question_images/' .$value['optionA']);
                              $option2 = asset('/assets/topic_question_images/' .$value['optionB']);
                              $option3 = asset('/assets/topic_question_images/' .$value['optionC']);
                              $option4 = asset('/assets/topic_question_images/' .$value['optionD']);
                              $radio ='image';
                              $answer = $value['answer'];
                              $final = '';
                              if($answer == '1'){
                                $final = $option1;
                              }elseif($answer == '2'){
                                $final = $option2;
                              }elseif($answer == '3'){
                                $final = $option3;
                              }else{
                                $final = $option4;
                              }
                            }
        
                          ?>
                          <tr>
                            <td>{{$key +1}}</td>
                            <td>{{$value['question']}}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <?php 
                            if($type == '1') {?>
                              <td>{{$option1}}</td>
                            <td>{{$option2}}</td>
                            <td>{{$option3}}</td>
                            <td>{{$option4}}</td>
                            <td>{{$final}}</td>
                            <?php }else{?>
                              <td><img src="{{$option1}}" alt='option1'></td>
                            <td><img src="{{$option2}}" alt='option2'></td>
                            <td><img src="{{$option3}}" alt='option3'></td>
                            <td><img src="{{$option4}}" alt='option4'></td>
                            <td><img src="{{$final}}" alt='answer'></td>
        
                            <?php }?>
                            
                            <td>
                              <label class="badge badge-success">{{$radio}}</label>
                            </td>
                            <td>
                            <a href="{{ route('admin.editTopicQuestion',['id'=>$value['id'],'topic_id'=>$value['topic_id']]) }}" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>
                            <a href="#deletetopicquestion" data-toggle="modal" data-value ="{{$value['id']}}" class="btn btn-xs btn-danger delete_quiz_question"><i class="mdi mdi-trash-can"></i></a>
                          </td>
                        </tr>
                      <?php } } ?>
                      </tbody>
                </table>
              </div>
            </div>
          </div> 
        </div>
        <!--******************************-->
  </div>

</div>
</div>

<div id="deletetopicquestion" class="deletemodal modal fade">
      <input type="hidden" name="deletedQuestionid" id ="deletedQuestionid" value="">
        <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="fas fa-times"></i>
                </div>
                <h4 class="modal-title w-100">האם אתה בטוח?</h4>    
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>האם אתה באמת רוצה למחוק את הרשומות האלה? לא ניתן לבטל תהליך זה.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">לְבַטֵל</button>
                <button id ="deleteTopicQuestionbtn" type="button" class="btn btn-danger">לִמְחוֹק</button> 
            </div> 
        </div>
    </div>
</div>

<!--<div id="quizquestiondelete" class="deletemodal modal fade">
      <input type="hidden" name="deleted_id" id ="deleted_id" value="">
        <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="fas fa-times"></i>
                </div>                      
                <h4 class="modal-title w-100">האם אתה בטוח?</h4>    
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>האם אתה באמת רוצה למחוק את הרשומות האלה? לא ניתן לבטל תהליך זה.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">לְבַטֵל</button>
                <button id ="delete_data" type="button" class="btn btn-danger">לִמְחוֹק</button>
            </div>
        </div>
    </div>
</div>-->
@endsection

@section('scripts')
    <script>
    $(document).on("click",".delete_quiz_question",function(){
       var deleteQuestionId = $(this).attr("data-value");
       $("#deleteTopicQuestionbtn").attr("questionDeleteId",deleteQuestionId);
    });
    $("#deleteTopicQuestionbtn").click(function(e) {
        e.preventDefault();
        var deleted_id = $(this).attr('questiondeleteid');
        $.ajax({
            url: '{{ route("admin.deleteTopicQuestion") }}',
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
    </script>
@endsection
