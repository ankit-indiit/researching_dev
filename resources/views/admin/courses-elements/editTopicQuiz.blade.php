<div class="col-lg-12">
    <div class="card-box recentuser">
      <div class="row" style="direction:rtl">
            <div class="col-md-6  text-right">
              <!--<h4 class="header-title mb-3">
               רשרשימת סרטונים
              </h4>-->
            </div>
           <div class="col-md-6 text-left">
              <a href="#addQuiz" data-toggle ="modal" class="btn btn-primary  mb-3">
                הוסף חידון              </a>
            </div>
      </div>
      <div class="table-responsive">
        <table id="basic-datatable1"  class="table table-borderless table-hover table-nowrap table-centered m-0  datatable-table">
          <thead class="thead-light datatable-head">
            
            <tr class="datatable-row">
              <th>
                מזהה נושא
              </th>
              <th>כותרת החידון</th>
              <th> סך הכל שאלות</th>
              <th>
                פעולה
              </th>
            </tr>
          </thead>
        <tbody>
          <?php 
            foreach ($topic_quiz as $key => $value) {
          ?>
          <tr>
            <td class="number">{{$key+1}}</td>
            <td>
              {{ $value->quiz_title }}
            </td> 
            <td> 
                <a href="{{ route('admin.listquizquestions',['id'=>$value->id ]) }}" class="badge badge-success text-white table-data"><?php echo count($value->quizQuestions->toArray()); ?></a>
            </td>
            <td>
            <a href="#editQuiz" data-id="{{ $value->id }}" class="btn btn-xs btn-success edit_quiz" data-toggle="modal"  title="Edit Quiz"><i class="mdi mdi-pencil"></i></a>
            <a href="#deleteQuiz" data-id ="{{ $value->id }}"  class="btn btn-xs btn-danger deletequiz" data-toggle="modal"  title="Delete"><i class="mdi mdi-trash-can"></i></a>
            <!--<a href="javascript:void(0);" data-toggle ="modal" data-id ="{{$value['id']}}" class="btn btn-xs btn-warning addTopicQuizQuestion" title="Add Quiz Question"><i class="mdi mdi-plus"></i></a> -->
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<form method="POST" id = "add_quiz_form" enctype="multipart/form-data">
    @csrf()
    <div id="addQuiz" class="renewalproduct modal fade" style="direction: rtl;">
        <input type="hidden" name="chapter_id" id ="chapter_id" class="chapter_id" value="<?php echo $topic_id; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100">
                 הוסף חידון
                    </h4>   
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-right">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group  questionarea">
                            <label for="question">
                              כותרת החידון
                            </label>   <input type="text" name="quizTitle" id="quizTitle" class="form-control" placeholder="כותרת החידון" >
                            <span class="text-danger error-text quizTitle_err"></span>
                        </div>
                    </div>
                </div>
            <div class="row mt-3">
              <div class="col-12 text-center">
                <button type="button" id="add_quiz" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                <button type="button" id="back_btn" data-dismiss="modal" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
              </div>
            </div>
                </div>
            </div>
        </div>
    </div>
</form>   


<form method="POST" id = "edit_quiz_form" enctype="multipart/form-data">
    @csrf()
    <div id="editQuiz" class="renewalproduct modal fade" style="direction: rtl;">
        <input type="hidden" name="chapter_id" id ="chapter_id" class="chapter_id" value="<?php echo $topic_id; ?>">
        <input type="hidden" name="quiz_id" id ="quiz_id" class="quiz_id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100">
                        חידון ערוך
                    </h4>   
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-right">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group  questionarea">
                            <label for="question">
                              כותרת החידון
                            </label>   <input type="text" name="editquizTitle" id="editquizTitle" class="form-control editquizTitle" placeholder="כותרת החידון" >
                            <span class="text-danger error-text editquizTitle_err"></span>
                        </div>
                    </div>
                </div>
            <div class="row mt-3">
              <div class="col-12 text-center">
                <button type="button" id="edit_quiz_btn" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                <button type="button" id="back_btn" data-dismiss="modal" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
              </div>
            </div>
                </div>
            </div>
        </div>
    </div>
</form>   

<div id="deleteQuiz" class="deletemodal modal fade">
      <input type="hidden" name="deletedid" id ="deletedid" value="">
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
                <button id ="deleteTopicQuiz" type="button" class="btn btn-danger">לִמְחוֹק</button> 
            </div> 
        </div>
    </div>
</div>