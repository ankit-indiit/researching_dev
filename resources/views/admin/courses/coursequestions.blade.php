
  <div class="col-lg-12">
    <div class="card-box recentuser">
      <div class="row" style="direction:rtl">
        <div class="col-md-6  text-right">
          <h4 class="header-title mb-3">
            רשימת שאלות
          </h4>
        </div>
        <div class="col-md-6 text-left">
          <a href="#addquestions" data-toggle ="modal" class="btn btn-primary  mb-3">
            להוסיף שאלות
          </a>
        </div>
      </div>
      <div class="table-responsive">
        <table id="basic-datatable1"  class="table table-borderless table-hover table-nowrap table-centered m-0  datatable-table">
          <thead class="thead-light datatable-head">
            
            <tr class="datatable-row">
              <th>
                שאלות מזהה
              </th>
              <th colspan="2">
                שְׁאֵלָה
              </th>
              <th colspan="2">
                תשובות
              </th>
              <th>
                פעולה
              </th>
            </tr>
          </thead>
        <tbody>
          <?php 
          foreach ($questions_data as $key => $value) {
          ?>
          <tr>
            <td class="number">{{$key+1}}</td>
            <td style="width: 36px;"> 
              {{$value->questions}}
            </td>
            <td>
               &nbsp;
            </td>
            <td>
               &nbsp;
            </td>
            <td style="width: 36px;">{{$value->answers}}</td>
            <td>
              <a data-id = "{{$value->id}}" data-value="{{$course_id}}" class="btn btn-xs btn-success edit_question" data-toggle="tooltip"  title="Edit"><i class="mdi mdi-pencil"></i></a>
              <a data-id ="{{$value->id}}"  data-value ="" class="btn btn-xs btn-danger delete_qa"><i class="mdi mdi-trash-can"></i></a>
            </td>
          </tr>
        <?php  }?>
        </tbody>
      </table>
    </div>
  </div>
</div> 
<form method="POST" id = "edit_qa_form"  enctype="multipart/form-data">
    @csrf()
<div id="editqa" class="renewalproduct modal fade" style="direction: rtl;">
    <input type="hidden" name="qa_id" id ="qa_id" value="">
    <input type="hidden" name="qa_course_id" id="qa_course_id" value="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100">
                  להוסיף פרקים
                </h4>   
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-right">
                <div class="form-group mb-3">
                    <label>
                      שְׁאֵלָה
                    </label>
                    <textarea rows="3" id="edit_qustn" name ="edit_qustn" value="" class="form-control" placeholder="הזן את השאלה"></textarea>
                    <span class="text-danger error-text add_qustn_err"></span>
                </div>
                <div class="form-group mb-3">
                    <label>
                      תשובה
                    </label>
                    <textarea rows="5" id="edit_answer" name ="edit_answer" value=""class="form-control" placeholder="הזן את התשובה"></textarea>
                    <span class="text-danger error-text add_answer_err"></span>
                </div>
                <button id = "edit_qa" type="button" class="btn btn-outline-warning waves-effect waves-light">
                  לְהוֹסִיף
                </button>
            </div>
        </div>
    </div>
</div>
</form>
<form method="POST" id = "add_qustn_form"  enctype="multipart/form-data">
    @csrf()
<div id="addquestions" class="renewalproduct modal fade" style="direction: rtl; ">
  <input type="hidden" name="course_id" id="course_id" value="{{$course_id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100">
                  להוסיף שאלות
                </h4>   
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-right">
                <div class="form-group mb-3">
                    <label>
                      שְׁאֵלָה
                    </label>
                    <textarea rows="3" id="add_qustn" name ="add_qustn" class="form-control" placeholder="הזן את השאלה"></textarea>
                    <span class="text-danger error-text add_qustn_err"></span>
                </div>
                <div class="form-group mb-3">
                    <label>
                      תשובה
                    </label>
                    <textarea rows="5" id="add_answer" name ="add_answer" class="form-control" placeholder="הזן את התשובה"></textarea>
                    <span class="text-danger error-text add_answer_err"></span>
                </div>
                
                
                <button id = "add_qustn_btn" type="button" class="btn btn-outline-warning waves-effect waves-light">
                  לְהוֹסִיף
                </button>
            </div>
        </div>
    </div>
</div>
</form>
<div id="deleted_qa" class="deletemodal modal fade">
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
                <button id ="deletedqa" type="button" class="btn btn-danger">לִמְחוֹק</button>
            </div>
        </div>
    </div>
</div>