  <div class="col-lg-12">
    <div class="card-box recentuser">
      <div class="row" style="direction:rtl">
        <div class="col-md-6  text-right">
          <h4 class="header-title mb-3">
            כל ההרצאות
          </h4>
        </div>
        <!--<div class="col-md-6 text-left">
          <a href="#addlecture" data-toggle ="modal" class="btn btn-primary  mb-3">
            הוסף הרצאות
          </a>
        </div>-->
      </div>
      <div class="table-responsive">
        <table id="basic-datatable1"  class="table table-borderless table-hover table-nowrap table-centered m-0  datatable-table">
          <thead class="thead-light datatable-head">
            
            <tr class="datatable-row">
              <th>
                מזהה הרצאה
              </th>
              <th colspan="2">
                כותרת
              </th>
              <th>
                מֶשֶׁך
              </th>
              <th>
                מחיר
              </th>
              <th>
                פעולה
              </th>
            </tr>
          </thead>
        <tbody>
          <?php 
            foreach ($lectures as $key => $lecture) {?>
          <tr>
            <td class="number">{{$key + 1}}</td>
            <td style="width: 36px;"> 
              {{$lecture->title}}
            </td>
            <td>
               &nbsp;
            </td>
            <td>{{$lecture->duration}}</td>
            <td>₪{{$lecture->price}}</td>
            <td>
              <a data-id = "{{$lecture->id}}" data-value="{{$course_id}}" class="btn btn-xs btn-success edit_lectr_btn" data-toggle="tooltip"  title="Edit"><i class="mdi mdi-pencil"></i></a>
              <a data-id ="{{$lecture->id}}"  class="btn btn-xs btn-danger deletebtn" data-toggle="tooltip"  title="delete"><i class="mdi mdi-trash-can"></i></a>
              <!--<a data-id ="{{$lecture->id}}" data-value="{{$course_id}}" class="btn btn-xs btn-warning topicbtn" data-toggle="tooltip"  title="add Chapters"><i class="mdi mdi-plus"></i></a>-->
              <a href="{{route('admin.quizlisting') . '/' . $lecture->id . '/'. $lecture->topic_id . '/' . $lecture->course_id}}" class="btn btn-xs btn-warning" data-toggle="tooltip"  title="add quiz"><i class="mdi mdi-plus"></i></a>
            </td>
          </tr>
        <?php }?>
        </tbody>
      </table>
    </div>
  </div>
</div> 

<div id="deletelecture" class="deletemodal modal fade">
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
</div>
<form method="POST" id = "edit_lecture_form" action="" enctype="multipart/form-data">
    @csrf()
<div id="editlecture" class="renewalproduct modal fade" style="direction: rtl;">
  <input type ="hidden" name="edit_lecture_id" id ="edit_lecture_id" value="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100">
                  הוסף הרצאות
                </h4>   
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-right">
                <div class="form-group mb-3">
                    <label>כותרת</label>
                    <input id ="edit_title" name="edit_title" type="text"  value="" class="form-control" placeholder="הזן את הכותרת">
                    <span class="text-danger error-text edit_title_err"></span>
                </div>
                <div class="form-group mb-3">
                    <label>מֶשֶׁך</label>
                    <input id ="edit_duration" name="edit_duration" type="text"  value="" class="form-control" placeholder="הזן את משך הזמן">
                    <span class="text-danger error-text edit_duration_err"></span>
                </div>
                <div class="form-group mb-3">
                    <label>מחיר</label>
                    <input id ="edit_price" name="edit_price" type="text"  value="" class="form-control" placeholder="הכנס את הסיסמא">
                    <span class="text-danger error-text edit_price_err"></span>
                </div>
                <button id = "edit_lecture"
                 type="button" class="btn btn-outline-warning waves-effect waves-light">
                  לְהוֹסִיף
                </button>
            </div>
        </div>
    </div>
</div>
</form>