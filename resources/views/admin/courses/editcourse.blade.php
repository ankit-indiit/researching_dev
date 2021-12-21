
<form method="POST" id = "edit_course_form" enctype="multipart/form-data">
    <input type="hidden" name="course_id" id="course_id" value="{{$course_data->course_id}}">
    @csrf()
    <div class="row" style="direction:rtl">
      <div class="col-md-6 text-right">
        <h4 class="header-title mb-3">ערוך מוצר</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
      <?php 
        $university_data = DB::table('universities')->get();
      ?>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="Instutename">שם מוסד</label>
              <select id="edit_university" name="edit_university" class="form-control" data-placeholder=" בחר במכון" required="required" >
              <option value = "">
                     בחר במכון
              </option>
              @foreach($university_data as $university)
                <option value="{{ $university->id }}" {{$university->id == $course_data->university_id  ? 'selected' : ''}}>{{ $university->university_name }}</option> 
              @endforeach               
              </select>
              <span class="text-danger error-text edit_university_err"></span>
            </div>
          </div>
          <?php 
            $degrees_data = DB::table('degrees')->get();
          ?>
          <div class="col-md-6">
            <div class="form-group">
                <label for="degree">תוֹאַר</label>
                  <select id="edit_degree" name="edit_degree" class="form-control" data-placeholder="חר את התואר" required="required" >
                    <option value = "">
                       בחר את התואר
                    </option>
                    @foreach($degrees_data as $degree)
                      <option value="{{ $degree->id }}" {{$degree->id == $course_data->degree_id  ? 'selected' : ''}}>{{ $degree->degree_name }}</option> 
                    @endforeach               
                  </select>
                <span class="text-danger error-text edit_degree_err"></span>
              </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                  <label for="prducttype">סוג המוצר</label>
                      <select class="form-control" name ="edit_prducttype" id="edit_prducttype" placeholder="חר את סוג הקורס">
                        <option value = "">
                           בחר את סוג הקורס
                        </option>
                        <option value ="0" {{$course_data->course_type == 0  ? 'selected' : ''}} >
                                                   קורס מקוון
                        </option>
                        <option value ="1" {{$course_data->course_type == 1  ? 'selected' : ''}} >
                                                 למידה אינטנסיבית
                      </option>
                      </select>
                      <span class="text-danger error-text edit_prducttype_err"></span>
                  </div>
                </div> 
                <?php 
                  $instructors_data = DB::table('instructors')->get();
                ?>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="instructorname">מַדְרִיך</label>
                    <select id="edit_instructor" name="edit_instructor" class="form-control" data-placeholder="שם האוניברסיטה או המכללה<" required="required" >
                        <option value = "">שם האוניברסיטה או המכללה</option>
                        @foreach($instructors_data as $instructor)
                        <option value="{{ $instructor->id }}" {{$course_data->instructor_id == $instructor->id  ? 'selected' : ''}} >{{ $instructor->first_name . $instructor->last_name }}</option> 
                        @endforeach               
                    </select>
                    <span class="text-danger error-text edit_instructor_err"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="cname">שם קורס</label>
                    <input type="text" id="course_name" name ="course_name" value="{{$course_data->course_name}}"class="form-control" placeholder="הזן את שם הקורס">
                    <span class="text-danger error-text course_name_err"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="url">
                      כתובת אתר כמובן
                    </label>
                    <input type="text" id="course_url" value="{{$course_data->video_link}}" name="course_url" class="form-control" placeholder="הזן את כתובת האתר של סרטון הקורס">
                    <span class="text-danger error-text course_url_err"></span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group col-lg-12">
                    <label for="url">
                  מחיר
                    </label>
                    @if($course_data->price != 0.0)
                    <input type="text" id="price" name ="price" class="form-control" placeholder="" value="{{$course_data->price}}">
                    @else
                    <input type="text" id="price" name ="price" class="form-control" placeholder="" value="">
                  @endif
                <span class="text-danger error-text price_err"></span>
              </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                  <label for="description">תיאור</label>
                <textarea class="summernote-basic" name="description">{{!! $course_data->description !!}}</textarea>
                  <span class="text-danger error-text description_err"></span>
                </div>
            </div>
            <input type="hidden" name="imageName" id ="imageName" value="{{$course_data->image}}">
              <div class="col-lg-12">
                <div class="form-group ">
                  <label for="Bimage">
                             קובץ מצורף
                </label>
                      <div class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"data-upload-preview-template="#uploadPreviewTemplate">
                      <div class="fallback">
                        <input name="file" type="file" />
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
              <div class="col-md-12">
                <div class="form-group">
                  <div class="card mt-1 mb-0 shadow-none border ">
                    <div class="p-2">
                      <div class="row align-items-center">
                          <div class="col-auto">
                          <?php
                              $image =  asset('/assets/images/' .$course_data->image);
                          ?>
                          <input type ="hidden" name="previousimage" id = "previousimage" value= "{{$course_data->image}}">
                          <img id ="uploadImage" src="{{$image}}"  class="companylogo">
                          </div>
                          <div class="col pl-0">
                            <a id ="uploadname" href="javascript:void(0);" class="text-muted font-weight-bold" data-dz-name="">{{$course_data->image}}</a>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <!--**********************-->
            <div class="col-md-6">
              <div class="form-group">
                <label for="tagline1">שורת תיוג</label>
                <input type="text" class="tagsline1 form-control" name="tagline1" value="{{$course_data->tagline1}}">
                <span class="text-danger error-text tagline1_err"></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="tagline2">שורת תיוג</label>
                <input type="text" class="tagsline2 form-control" name="tagline2" value="{{$course_data->tagline2}}">
                <span class="text-danger error-text tagline2_err"></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="tagline3">שורת תיוג</label>
                <input type="text" class="tagsline3 form-control" name="tagline3" value="{{$course_data->tagline3}}">
                <span class="text-danger error-text tagline3_err"></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="tagline4">שורת תיוג</label>
                <input type="text" class="tagsline4 form-control" name="tagline4" value="{{$course_data->tagline4}}">
                <span class="text-danger error-text tagline4_err"></span>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="tagline5">שורת תיוג</label>
                <input type="text" class="tagsline5 form-control"  name="tagline5" value="{{$course_data->tagline5}}">
                <span class="text-danger error-text tagline5_err"></span>
              </div>
            </div>
            <!--**********************-->
            
            </div>
          <div class="row mt-3">
              <div class="col-12 text-center">
                <button type="submit" id ="edit_product" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                <button type="button" id ="bckbtn" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
            </div>
          </div>
      </div>
    </div> <!-- end card-->
</form>
