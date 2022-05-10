<div class="col-lg-12">
    <div class="card-box recentuser">
      <div class="row" style="direction:rtl">
            <div class="col-md-6  text-right">
              <!--<h4 class="header-title mb-3">
               רשימות קבצים
              </h4>-->
            </div>
           <div class="col-md-6 text-left">
              <a href="#addpdf" data-toggle ="modal" class="btn btn-primary  mb-3">
                העלה קובץ
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
              <th>כוכותרת הקבצים</th>
              <th colspan="2">נתיב קבצים</th> 
              <th>
                פעולה
              </th>
            </tr>
          </thead>
        <tbody>
          <?php 
          foreach ($topics_pdf as $key => $value) {
              
          ?>
          <tr>
            <td class="number">{{$key+1}}</td>
            <td style="width: 36px;">
              {{ $value['topic_pdf_title'] }} 
            </td>
            <td>
               &nbsp;
            </td>
            <td>{{$value['topic_pdf_url'] }}</td>
            <td>
              <a href="#deletePdf" data-id ="{{$value['id']}}"  class="btn btn-xs btn-danger delete_topic_pdf" data-toggle="modal"  title="Delete"><i class="mdi mdi-trash-can"></i></a>
            </td>
          </tr>
        <?php }?>
        </tbody>
      </table>
    </div>
  </div>
</div>



<form method="POST" id = "add_topic_pdf_form" enctype="multipart/form-data">
    @csrf()
    <div id="addpdf" class="renewalproduct modal fade" style="direction: rtl;">
        <input type="hidden" name="chapter_id" id ="chapter_id" class="chapter_id" value="{{ $topic_id }}">
        <input type="hidden" name="pdfimageName" id ="pdfimageName" class="pdfimageName">
       <input type="hidden" name="order_id" id ="order_id" class="order_id" value="{{ $highestnumber }}">
        
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100">
                  העלה קובץ
                    </h4>   
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-right">
                    <div class="col-lg-12">
            			<div class="form-group">  
            			    <label>כותרת הקובץ</label>
            			    <input type="text"  name="topic_pdf_title"  id="topic_pdf_title" class="form-control topic_pdf_title">
            			    <span class="text-danger error-text topic_pdf_title_err"></span>
            			</div>
        			</div>
                <div class="col-lg-12">
    			<div class="form-group"> 
    			<label for="Bimage">קובץ מצורף</label>
    			    <div class="dropzone myDropzone" id="myDropzone">
    			    <div class="fallback">
    			    	<input style="display:none" type="file"  name="uploadfile"  id="uploadfile"/>
    				</div>
    				<div class="dz-message needsclick">
    			        <i class="h3 text-muted dripicons-cloud-upload"></i>
    			        <h4>
    			        גרור ושחרר לוגו לכאן
    			        </h4>
    			    </div>
    				</div>
    				<span class="text-danger error-text imageName_err"></span>
    				<div class="dropzone-previews mt-3" id="file-previews"></div>
    			</div>
    			</div>
                    <button id="add_topic_pdf" type="button" class="btn btn-outline-warning waves-effect waves-light">
                      לְהוֹסִיף
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!--<div id="deletePdf" class="renewalproduct modal fade" style="direction: rtl;">
    <input type="hidden" name="deletedid" id ="deletedid" value="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100">מחק רשומות</h4>   
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-right">
                <div class="form-group mb-3">
                    <label>סיסמה</label>
                    <input id ="get_password" name="get_passowrd" type="password"  class="form-control" placeholder="הזן את הסיסמה">
                </div>
                <button id = "confirm_password" type="button" class="btn btn-outline-warning waves-effect waves-light">שלח</button>
            </div>
        </div>
    </div>
</div>-->
<div id="deletePdf" class="deletemodal modal fade">
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
                <button id ="deleteTopicPdf" type="button" class="btn btn-danger">לִמְחוֹק</button>
            </div>
        </div>
    </div>
</div>