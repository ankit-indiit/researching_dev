<div class="col-lg-12">
    <div class="card-box recentuser">
      <div class="row" style="direction:rtl">
            <div class="col-md-6  text-right">
              <!--<h4 class="header-title mb-3">
               רשרשימת סרטונים
              </h4>-->
            </div>
           <div class="col-md-6 text-left">
              <a href="#addvideo" data-toggle ="modal" class="btn btn-primary  mb-3">
              הוסף וידאו
              </a>
            </div>
      </div>
      <div class="table-responsive">
        <table id="basic-datatable1"  class="table table-borderless table-hover table-nowrap table-centered m-0  datatable-table">
          <thead class="thead-light datatable-head">
            
            <tr class="datatable-row">
              <th>
                מזהה נושא
              </th>
              <th>כותרת סרטון</th>
              <th colspan="2">מזהה וידאו</th>
              <th>
                פעולה
              </th>
            </tr>
          </thead>
        <tbody>
          <?php 
          foreach ($topic_video as $key => $value) {
          ?>
          <tr>
            <td class="number">{{$key+1}}</td>
            <td style="width: 36px;">
              {{$value->topic_video_title}}
            </td>
            <td>
               &nbsp;
            </td>
            <td>{{$value->topic_video_url}}</td>
            <td>
              <a href="#editTopicVideo" data-id="{{$value->id}}" class="btn btn-xs btn-success edit_topic_btn" data-toggle="modal"  title="Edit video"><i class="mdi mdi-pencil"></i></a>
              <a href="#deletevideo" data-id ="{{$value['id']}}"  class="btn btn-xs btn-danger delete_topic_video" data-toggle="modal"  title="Delete"><i class="mdi mdi-trash-can"></i></a>
              <!--<a data-id ="{{$value->id}}"  data-value ="" class="btn btn-xs btn-danger delete_topic" data-toggle="tooltip"  title="Delete"><i class="mdi mdi-trash-can"></i></a>
              <a href="#addvideo" data-toggle ="modal" data-id ="{{$value->id}}" class="btn btn-xs btn-warning add_lesson" title="add Video"><i class="mdi mdi-plus"></i></a> -->
            </td>
          </tr>
        <?php }?>
        </tbody>
      </table>
    </div>
  </div>
</div>




<form method="POST" id = "add_topic_video_form" enctype="multipart/form-data">
    @csrf()
<div id="addvideo" class="renewalproduct modal fade" style="direction: rtl;">
    <input type="hidden" name="topic_id" id ="topic_id" class="topic_id" value="{{ $topic_id }}">
    <input type="hidden" name="chapter_id" id ="chapter_id" class="chapter_id" value="{{ $topic_id }}">
    <input type="hidden" name="order_id" id ="order_id" class="order_id" value="{{ $highestnumber }}">
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100">
              רשימת סרטונים
                </h4>   
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-right">
            <div class="col-md-12">
                <div class="form-group">
                  <label> כותרת סרטון </label>
                  <input id ='topic_video_title' name='topic_video_title[]' type='text' class='form-control' placeholder='כותרת סרטון'>
                  <span class='text-danger error-text topic_video_title_err'></span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                  <label>מזהה וידאו</label>
                  <input id ="topic_video_url" name="topic_video_url[]" type="text"  class="form-control" placeholder="מזהה וידאו">
                  <span class="text-danger error-text topic_video_url_err"></span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                  <label>משך הסרטון</label>
                  <input id ="topic_video_duration" name="topic_video_duration[]" type="text"  class="form-control" placeholder="משך הסרטון">
                  <span class="text-danger error-text topic_video_duration_err"></span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                  <label>תיאור הסרטון</label>
                  <textarea id ="topic_video_description" name="topic_video_description[]" type="text"  class="form-control" placeholder="תיאור הסרטון"></textarea>
                  <span class="text-danger error-text topic_video_description_err"></span>
                </div>
            </div>
                <button id="add_topic_video" type="button" class="btn btn-outline-warning waves-effect waves-light">
                  לְהוֹסִיף
                </button>
            </div>
        </div>
    </div>
</div>
</form>






<form method="POST" id = "edit_topic_video_form" enctype="multipart/form-data">
    @csrf()
<div id="editTopicVideo" class="renewalproduct modal fade" style="direction: rtl;">
    <input type="hidden" name="edit_video_id" id ="edit_video_id" class="edit_video_id">
    <input type="hidden" name="topic_id" id ="topic_id" class="topic_id" value="{{ @$topic_id }}">
    <input type="hidden" name="chapter_id" id ="chapter_id" class="chapter_id" value="{{ $topic_id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100">
              רשימת סרטונים
                </h4>   
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-right">
                <div class="col-md-12">
                <div class="form-group">
                  <label> כותרת סרטון </label>
                  <input id ='edit_topic_video_title' name='topic_video_title[]' type='text' class='form-control' placeholder='כותרת סרטון'>
                  <span class='text-danger error-text topic_video_title_err'></span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                  <label>מזהה וידאו</label>
                  <input id ="edit_topic_video_url" name="topic_video_url[]" type="text"  class="form-control" placeholder="כתובת אתר וידאו">
                  <span class="text-danger error-text topic_video_url_err"></span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                  <label>משך הסרטון</label>
                  <input id ="edit_topic_video_duration" name="topic_video_duration[]" type="text"  class="form-control" placeholder="משך הסרטון">
                  <span class="text-danger error-text topic_video_duration_err"></span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                  <label>תיאור הסרטון</label>
                  <textarea id ="edit_topic_video_description" name="topic_video_description[]" type="text"  class="form-control" placeholder="תיאור הסרטון"></textarea>
                  <span class="text-danger error-text topic_video_description_err"></span>
                </div>
            </div>
                <button id="edit_topic_video" type="button" class="btn btn-outline-warning waves-effect waves-light">
                  לְהוֹסִיף
                </button>
            </div>
        </div>
    </div>
</div>
</form>

<div id="deletevideo" class="deletemodal modal fade">
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
                <button id ="deleteTopicVideo" type="button" class="btn btn-danger">לִמְחוֹק</button> 
            </div> 
        </div>
    </div>
</div>