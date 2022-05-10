
    <!--<input type="hidden" name="course_id" id="course_id" value="{{$course_data->course_id}}">-->
    <input type = "hidden" name = 'docs_course_id' value = "{{$course_data->course_id}}"/>
    @csrf()
    <div class="row" style="direction:rtl">
      <div class="col-md-6 text-right">
        <h4 class="header-title mb-3">ערוך מוצר</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
            <form method="POST" id="upload-docs-form" enctype="multipart/form-data">
            <input type="hidden" name="courseMaterialimg" id ="courseMaterialimg">
            <input type="hidden" name="original_image_name" id ="original_image_name">
              <div class="col-lg-12">
                <div class="form-group"> 
                  <label for="Bimage">
                             קובץ מצורף
                </label>
                      <div class="dropzone" id="myAwesomeDropzones" data-plugin="dropzone" data-previews-container="#file-previews"data-upload-preview-template="#uploadPreviewTemplate">
                      <div class="fallback">
                        <input style="display:none" type="file"  name="uploadfile"  id="uploadfile"/>
                    </div>
                      <div class="dz-message needsclick">
                        <i class="h3 text-muted dripicons-cloud-upload"></i>
                        <h4>גרור ושחרר לוגו לכאן</h4>
                    </div>
                    </div>
                    <span class="text-danger error-text imageName_err"></span>
                    <!-- Preview -->
                    <div class="dropzone-previews mt-3" id="file-previews"></div>
                </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <button type="button" id ="upload_docs_btnssss" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                        <button type="button" id ="bckbtn" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
                    </div>
                </div>
                </form>
              <div class="row">
                <?php 
                    $coursematerials_data = DB::table('coursematerials')->where('course_id',$course_data->course_id)->get()->toArray();
                    if(!empty($coursematerials_data)){
                    ?>
                    <div class="col-lg-12">
                        <div class="card-box recentuser">
                    <div class="table-responsive">
                        <table id="basic-datatable11"  class="table table-borderless table-hover table-nowrap table-centered m-0  datatable-table">
                          <thead class="thead-light datatable-head">
                            <tr class="datatable-row">
                              <th>
                                מזהה נושא
                              </th>
                              <th colspan="2">
                                כותרת
                              </th>
                              <th>
                                קבצים
                              </th>
                              <th>
                                פעולה
                              </th>
                            </tr>
                          </thead>
                        <tbody>
                          <?php 
                            foreach($coursematerials_data as $key=>$val){
                          ?>
                            <tr>
                                <td class="number">{{$key+1}}</td>
                                <td style="width: 36px;"> 
                                  {!! Str::limit(strip_tags($val->name), 15, $end='...') !!}
                                </td>
                                <td>
                                   &nbsp;
                                </td>
                                <td>
                                    <input type ="hidden" name="previousimage" id = "previousimage" value= "{{$val->file_path}}">
                                    @if (pathinfo($val->file_path, PATHINFO_EXTENSION) == 'pdf')
                                    PDF
                                    @else
                                    <img id ="uploadImages" src="{{asset(''.$val->file_path)}}"  class="companylogo" alt="file">
                                    @endif
                                </td>
                                <td>
                                <a data-id="{{$val->id}}" data-value="" class="btn btn-xs btn-danger deleteMaterialfile"
                                    data-toggle="tooltip" title="" data-original-title="Delete" aria-describedby="tooltip315675">
                                    <i class="mdi mdi-trash-can"></i>
                                </a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    </div>
                    </div>
                <?php
                    }
                ?>
            </div> 
          
      </div>
    </div> <!-- end card-->

<div id="deleteMaterialfile" class="deletemodal modal fade">
      <input type="hidden" name="deleted_course_material_id" id ="deleted_course_material_id" value="">
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
                <button id ="deleteMaterial" type="button" class="btn btn-danger">לִמְחוֹק</button>
            </div>
        </div>
    </div>
</div>