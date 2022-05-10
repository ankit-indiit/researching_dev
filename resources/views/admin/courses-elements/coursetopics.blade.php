
<form method="POST" id = "add_topic_form" enctype="multipart/form-data">
    @csrf()
    <input type="hidden" name="topic_lecture_id" id ="topic_lecture_id" value="">
    <input type="hidden" name="topic_course_id" id ="topic_course_id" value="{{ $course_id }}">
    <div class="row" style="direction:rtl">
      <div class="col-md-12 text-right">
        <h4 class="header-title mb-3">
                  להוסיף פרקים
        </h4>
      </div>
    </div>   
      <div class="row">
          <div class="col-md-6">
            <div class="form-group">
                <label>מֶשֶׁך</label>
                <input id ="topic_duration" name="topic_duration" type="text"  class="form-control" placeholder="הזן את משך הזמן">
                <span class="text-danger error-text topic_duration_err"></span>
              </div>
          </div>
          
          <div class="col-md-6">
          <div class="form-group">
            <label>כותרת</label>
            <input id ="topic_title" name="topic_title" type="text"  class="form-control" placeholder="הזן את הכותרת">
            <span class="text-danger error-text topic_title_err"></span>
          </div>
          </div>
          
          <!--<div class="col-md-6">
            <div class="form-group">
              <label> כותרת סרטון </label>
              <input id ='topic_video_title' name='topic_video_title[]' type='text'  class='form-control' placeholder='כותרת סרטון'>
              <span class='text-danger error-text topic_video_title_err'></span>
            </div>
          </div>-->
          
          <!--<div class="col-md-12">
            <div class="form-group">
              <label>כתובת אתר וידאו</label>
              <input id ="topic_video_url" name="topic_video_url[]" type="text"  class="form-control" placeholder="כתובת אתר וידאו">
              <span class="text-danger error-text topic_video_url_err"></span>
            </div>
            </div>-->
            <div class="col-md-12">
                <div class="form-group">
                   <label>מחיר</label>
                   <input id ="topic_price" name="topic_price" type="text"  class="form-control" placeholder="מחיר">
                   <span class="text-danger error-text topic_price_err"></span>
                </div>
            </div>
            </div>
            <span class='topicvideocontrolappend'></span>
            <span class='topic_pdf_control_append'></span>
            <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                  <button id = "save_topic" type="button" class="btn btn-outline-warning waves-effect waves-light" style="margin-top:10px;">
                    לְהוֹסִיף
                  </button>
                </div>
            </div>
            </div>
</form>



<div class="col-lg-12">
    <div class="card-box recentuser">
      <div class="row" style="direction:rtl">
            <div class="col-md-6  text-right">
              <h4 class="header-title mb-3">
                נושאים
              </h4>
            </div>
            <!--<div class="col-md-6 text-left">
              <a href="#addtopic" data-toggle ="modal" class="btn btn-primary  mb-3">
               הוסף פרקים
               </a>
            </div>-->
      </div>
      <div class="table-responsive">
        <table id="basic-datatable1"  class="table table-borderless table-hover table-nowrap table-centered m-0  datatable-table">
          <thead class="thead-light datatable-head">
            
            <tr class="datatable-row">
              <th>
                מזהה נושא
              </th>
              <th colspan="2">
                כותרת
              </th>
              <th>
                מֶשֶׁך
              </th> 
              <th>
                פעולה
              </th>
            </tr>
          </thead>
        <tbody>
          <?php 
          foreach ($topics as $key => $value) {
          ?>
          <tr>
            <td class="number">{{$key+1}}</td>
            <td style="width: 36px;">
              {{$value->topic_name}}
            </td>
            <td>
               &nbsp;
            </td>
            <td>{{$value->topic_duration}}</td>
            <td>
              <a data-id = "{{$value->id}}" data-course="{{$value->course_id}}" class="btn btn-xs btn-success edit_topic_btn" data-toggle="tooltip"  title="Edit"><i class="mdi mdi-pencil"></i></a>
              <a data-id ="{{$value->id}}"  data-value ="" class="btn btn-xs btn-danger delete_topic" data-toggle="tooltip"  title="Delete"><i class="mdi mdi-trash-can"></i></a>
              <a href="#addlecture" data-toggle ="modal" data-id ="{{$value->id}}" class="btn btn-xs btn-warning add_lesson" title="add lesson"><i class="mdi mdi-plus"></i></a> 
              <!--<a href="#addVideo" data-toggle ="modal" data-id ="{{$value->id}}" class="btn btn-xs btn-warning add_video" title="add video"><i class="mdi mdi-plus"></i></a> -->
            </td>
          </tr>
        <?php }?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<form method="POST" id = "edit_topic_form"  enctype="multipart/form-data">
    @csrf()
<div id="edittopic" class="renewalproduct modal fade" style="direction: rtl;">
    <input type="hidden" name="topic_id" id ="topic_id" value="">
    <input type="hidden" name="topic_course_id1" id="topic_course_id1" value="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100">
                  ערוך פרקים
                </h4>   
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-right">
                <div class="form-group mb-3">
                    <label>כותרת</label>
                    <input id ="edit_topic_title" name="edit_topic_title" type="text"  class="form-control" placeholder="הזן את הכותרת">
                    <span class="text-danger error-text edit_topic_title_err"></span>
                </div>
                <!--<div class="form-group mb-3">
                    <label>מֶשֶׁך</label>
                    <input id ="edit_topic_duration" name="edit_topic_duration" type="text"  class="form-control" placeholder="הזן את משך הזמן">
                    <span class="text-danger error-text edit_topic_duration_err"></span>
                </div>
                <div class="topicvideocontrolappend"></div>
                <div class="form-group mb-3">
                    <button type="button" class="btn btn-primary add_more_video_url" >הוסף עוד סרטונים</button>
                </div>-->
                <!--<div class="form-group mb-3">
                    <label>כתובת אתר וידאו</label>
                    <input id ="edit_topic_video_url" name="edit_topic_video_url" type="text"  class="form-control" placeholder="כתובת אתר וידאו">
                    <span class="text-danger error-text edit_topic_video_url_err"></span>
                    <input type="hidden" name="edit_topic_video_id" id="edit_topic_video_id">
                </div>-->
                <button id = "edit_topic" type="button" class="btn btn-outline-warning waves-effect waves-light">
                  לְהוֹסִיף
                </button>
            </div>
        </div>
    </div>
</div>
</form>
<div id="deletetopic" class="deletemodal modal fade">
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
                <button id ="deletedata" type="button" class="btn btn-danger">לִמְחוֹק</button>
            </div>
        </div>
    </div>
</div>

<form method="POST" id = "add_video_by_chapter"  enctype="multipart/form-data">
    @csrf()
<div id="addVideo" class="renewalproduct modal fade" style="direction: rtl;">
    <input type="hidden" name="chapter_id" id ="chapter_id" value="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100">
                  לההוסף סרטוני פרקים
                </h4>   
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-right">
                <div class='form-group mb-3'>
                    <label> כותרת סרטון </label>
                    <input id ='topic_video_title' name='topic_video_title[]' type='text'  class='form-control' placeholder='כותרת סרטון'>
                    <span class='text-danger error-text topic_video_title_err'></span>
                </div>
                <div class="form-group mb-3">
                    <label>כתובת אתר וידאו</label>
                    <input id ="topic_video_url" name="topic_video_url[]" type="text"  class="form-control" placeholder="כתובת אתר וידאו">
                    <span class="text-danger error-text topic_video_url_err"></span>
                </div>
                <div class="topicvideocontrolappendd"></div>
                <div class="form-group mb-3">
                    <button type="button" class="btn btn-primary add_more_video_url" >הוסף עוד סרטונים</button>
                </div>
                <button id = "save_video" type="button" class="btn btn-outline-warning waves-effect waves-light" style="margin-top:10px;">
                  לְהוֹסִיף
                </button>
            </div>
        </div>
    </div>
</div>
</form>
<!--<form method="POST" id = "add_topic_form_old"  enctype="multipart/form-data">
    @csrf()
<div id="addtopic" class="renewalproduct modal fade" style="direction: rtl;">
    <input type="hidden" name="topic_lecture_id" id ="topic_lecture_id" value="">
     <input type="hidden" name="topic_course_id" id ="topic_course_id" value="{{ $course_id }}">
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
                    <label>כותרת</label>
                    <input id ="topic_title" name="topic_title" type="text"  class="form-control" placeholder="הזן את הכותרת">
                    <span class="text-danger error-text topic_title_err"></span>
                </div>
                <div class="form-group mb-3">
                    <label>מֶשֶׁך</label>
                    <input id ="topic_duration" name="topic_duration" type="text"  class="form-control" placeholder="הזן את משך הזמן">
                    <span class="text-danger error-text topic_duration_err"></span>
                </div>
                <div class="form-group mb-3">
                    <label>מחיר</label>
                    <input id ="topic_price" name="topic_price" type="text"  class="form-control" placeholder="מחיר">
                    <span class="text-danger error-text topic_price_err"></span>
                </div>
                
                <div class='form-group mb-3'>
                    <label> כותרת סרטון </label>
                    <input id ='topic_video_title' name='topic_video_title[]' type='text'  class='form-control' placeholder='כותרת סרטון'>
                    <span class='text-danger error-text topic_video_title_err'></span>
                </div>
                
                <div class="form-group mb-3">
                    <label>כתובת אתר וידאו</label>
                    <input id ="topic_video_url" name="topic_video_url[]" type="text"  class="form-control" placeholder="כתובת אתר וידאו">
                    <span class="text-danger error-text topic_video_url_err"></span>
                </div>
                <div class="topicvideocontrolappend"></div>
                <div class="form-group mb-3">
                    <button type="button" class="btn btn-primary add_more_video_url" >הוסף עוד סרטונים</button>
                </div>
                <button id = "save_topic" type="button" class="btn btn-outline-warning waves-effect waves-light" style="margin-top:10px;">
                  לְהוֹסִיף
                </button>
            </div>
        </div>
    </div>
</div>
</form>-->
<form method="POST" id = "add_lecture_form" action="{{ route('admin.savelectures') }}" enctype="multipart/form-data">
    @csrf()
<div id="addlecture" class="renewalproduct modal fade" style="direction: rtl;">
    <input type="hidden" name="topic_id" id ="topic_id" class="topic_id" value="">
    <input type="hidden" name="course_id" id ="course_id" value="{{$course_id}}">
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
                    <input id ="get_title" name="get_title" type="text"  class="form-control" placeholder="הזן את הכותרת">
                    <span class="text-danger error-text get_title_err"></span>
                </div>
                <div class="form-group mb-3">
                    <label>מֶשֶׁך</label>
                    <input id ="get_duration" name="get_duration" type="text"  class="form-control" placeholder="הזן את משך הזמן">
                    <span class="text-danger error-text get_duration_err"></span>
                </div>
                <div class="form-group mb-3">
                    <label>מחיר</label>
                    <input id ="get_price" name="get_price" type="text"  class="form-control" placeholder="הכנס את הסיסמא">
                    <span class="text-danger error-text get_price_err"></span>
                </div>
                <button id = "save_lecture" type="button" class="btn btn-outline-warning waves-effect waves-light">
                  לְהוֹסִיף
                </button>
            </div>
        </div>
    </div>
</div>
</form>