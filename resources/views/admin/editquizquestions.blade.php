@extends('admin.layouts.app')

@section('title', ' להוסיף חידון ')
@section('content')
<?php 
$is_logged_in = session()->get('admin_logged_in');
        
if(!isset($is_logged_in) && $is_logged_in != '1'){
            
    return redirect()->route('admin.adminLogin')->send();
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
                <li class="breadcrumb-item"><a href="javascript: void(0);">בית</a></li>
                <li class="breadcrumb-item"><a href="
                  {{route('admin.quizlisting')}}">חִידוֹן</a></li>
                <li class="breadcrumb-item active">הוסף חידון</li>
              </ol>
            </div>
            <h4 class="page-title">הוסף חידון</h4>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row" style="direction:rtl">
                <div class="col-md-6 text-right">
                  <h4 class="header-title mb-3">הוסף חידון</h4>
                </div>
                <div class="col-md-6 text-left">
                  <a href="quiz.php" class="btn btn-primary  mb-3">חזרה לחידון</a>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="questiontype">סוג שאלה</label>
                        <select  id="questiontype" class="form-control" placeholder="סוג שאלה">
                          <option value ="">
                            בחר סוג
                          </option>
                          <option value="0">
                            שאלות מסוג טקסט
                          </option>
                          <option value="1">
                            שאלות מסוג תמונה
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group  questionarea">
                        <label for="question">
                          שְׁאֵלָה
                        </label>   <textarea rows="9"  class="form-control" placeholder=" הזן שאלה להוסיף " ></textarea>
                      </div>
                        <div class="form-group  questionarea">
                        <label for="question">
                          תשובה
                        </label>
                         <select  id="questiontype" class="form-control" placeholder="סוג שאלה">
                          <option>
                            אפשרות A.
                          </option>
                          <option>
                            אפשרות B.
                          </option>
                          <option >
                            אפשרות C.
                          </option>
                          <option>
                            אפשרויות
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6" id ="text_options" style="display:block;">
                      <div class="form-group">
                        <label>
                          אפשרות A
                        </label>
                        <input name = "options" type="text" class="form-control quizoption" placeholder=" הזן אפשרות ראשונה " >
                      </div>
                      <div class="form-group">
                        <label>
                          אפשרות B
                        </label>
                        <input name = "options" type="text" class="form-control quizoption" placeholder=" הזן אפשרות שנייה " >
                      </div>
                      <div class="form-group">
                        <label>
                          אפשרות C
                        </label>
                        <input name = "options" type="text" class="form-control quizoption" placeholder=" הזן אפשרות שלישית " >
                      </div>
                      <div class="form-group">
                        <label>
                          אפשרות D
                        </label>
                        <input name = "options" type="text" class="form-control quizoption" placeholder=" הזן אפשרות רביעית " >
                      </div>
                    </div>
                    <div class="col-md-6" id ="image_options" style="display:none;">
                      <div class="form-group">
                        <label>
                          אפשרות A
                        </label>
                        <input name = "options" type="file" class="form-control quizoption" placeholder=" הזן אפשרות ראשונה " >
                      </div>
                      <div class="form-group">
                        <label>
                          אפשרות B
                        </label>
                        <input name = "options" type="file" class="form-control quizoption" placeholder=" הזן אפשרות שנייה " >
                      </div>
                      <div class="form-group">
                        <label>
                          אפשרות C
                        </label>
                        <input name = "options" type="file" class="form-control quizoption" placeholder=" הזן אפשרות שלישית " >
                      </div>
                      <div class="form-group">
                        <label>
                          אפשרות D
                        </label>
                        <input name = "options" type="file" class="form-control quizoption" placeholder=" הזן אפשרות רביעית " >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                      <label for="video">
                        הוסף תמונה לשאלה.
                      </label>
                      <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="video">
                        הוסף קישור וידאו
                      </label>
                      <input type="text" class="form-control" placeholder=" הוסף קישור וידאו ">
                    </div>
                  </div>   
                </div>
          <div class="row mt-3">
            <div class="col-12 text-center">
              <button type="button" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
              <button type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
            </div>
          </div>
        </div>
      </div> <!-- end card-->
    </div> <!-- end col-->
  </div><!-- end row-->
</div> <!-- container -->
</div> <!-- content -->
</div>
</div>
</div>
</div>
@endsection
@section('scripts')
  <script>$('.summernote-basic').summernote('fontName', 'Varela Round');</script>
  <script type="text/javascript">
    $(document).ready(function(){


     $('#questiontype').on('change', function() {
      {
        var inputBox = document.getElementsByClassName('quizoption');
        if(this.value == '1'){
          $('#text_options').css('display','none');
          $('#image_options').css('display','block');
        }else{
          $('#text_options').css('display','block');
          $('#image_options').css('display','none');
        }
}
    });
     });
  </script>
        
@endsection