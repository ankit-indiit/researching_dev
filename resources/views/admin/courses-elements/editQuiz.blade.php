<div class="row">
        <div class="col-lg-12">
          <div class="card-box">
            <div class="row" style="direction:rtl">
              <div class="col-md-6 text-right">
                <!--<h4 class="header-title mb-3">חִידוֹן</h4>-->
              </div>
              <div class="col-md-6 text-left">
                <a href="#addQuiz"  data-toggle ="modal" class="btn btn-primary  mb-3">
                   סף חידון
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
                  if(!empty($topic_quiz_questions)){
                  foreach ($topic_quiz_questions as $key => $value) {
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
                    <a href="{{ route('admin.editTopicQuestion',['id'=>$value['id'],'topic_id'=>$topic_id]) }}" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>
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
    
 
<!--<form method="POST" id = "add_topic_quiz_form" enctype="multipart/form-data">
    @csrf()
    <div id="addTopicQuiz" class="renewalproduct modal fade" style="direction: rtl;">
        <input type="hidden" name="chapter_id" id ="chapter_id" class="chapter_id" value="<?php echo $topic_id; ?>">
        <input type="hidden" name="pdfimageName" id ="pdfimageName" class="pdfimageName">
        
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100">
                  הוסף שאלה
                    </h4>   
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-right">
                <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="questiontype">סוג שאלה</label>
                    <select  id="questiontype" name="questiontype" class="form-control" placeholder="סוג שאלה">
                      <option value ="">
                        בחר סוג
                      </option>
                      <option value="1">
                        שאלות מסוג טקסט
                      </option>
                      <option value="2">
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
                    </label>   <textarea rows="9" name="questionarea" id="questionarea" class="form-control" placeholder=" הזן שאלה להוסיף " ></textarea>
                    <span class="text-danger error-text questionarea_err"></span>
                  </div>
                    <div class="form-group  questionarea">
                    <label for="question">
                      תשובה
                    </label>
                     <select  id="ans_option" name="ans_option" class="form-control" placeholder="סוג שאלה">
                      <option value="1">
                        אפשרות A.
                      </option>
                      <option value="2">
                        אפשרות B.
                      </option>
                      <option value="3">
                        אפשרות C.
                      </option>
                      <option value="4">
                        אפשרויות
                      </option>
                    </select>
                    <span class="text-danger error-text ans_option_err"></span>
                  </div>
                </div>
                <div class="col-md-6" id ="text_options" style="display:block;">
                  <div class="form-group">
                    <label>
                      אפשרות A
                    </label>
                    <input name = "option_a" id ="option_a" type="text" class="form-control quizoption" placeholder=" הזן אפשרות ראשונה " required>
                    <span class="text-danger error-text option_a_err"></span>
                  </div>
                  <div class="form-group">
                    <label>
                      אפשרות B
                    </label>
                    <input name = "option_b" id="option_b" type="text" class="form-control quizoption" placeholder=" הזן אפשרות שנייה " required>
                    <span class="text-danger error-text option_b_err"></span>
                  </div>
                  <div class="form-group">
                    <label>
                      אפשרות C
                    </label>
                    <input name = "option_c" id="option_c" type="text" class="form-control quizoption" placeholder=" הזן אפשרות שלישית " required>
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
                  <input type="text" id="quest_video" name="quest_video" class="form-control" placeholder=" הוסף קישור וידאו  ">
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-12 text-center">
                <button type="button" id="add_topic_question" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                <button type="button" id="back_btn" data-dismiss="modal" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
              </div>
            </div>
                </div>
            </div>
        </div>
    </div>
</form> -->

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