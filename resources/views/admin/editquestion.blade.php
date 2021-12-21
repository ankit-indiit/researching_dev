@extends('admin.layouts.app')

@section('title', ' שאלה עריכה  ')
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
                <li class="breadcrumb-item"><a href="{{route('admin.questionlisting')}}">שאלות</a></li>
                <li class="breadcrumb-item active">ערוך תיאור</li>
              </ol>
            </div>
          <h4 class="page-title">ערוך תיאור</h4>
        </div>
      </div>
    </div> 
<form method="POST" id = "edit_question_form" action="{{ route('admin.updatequestions') }}" enctype="multipart/form-data">
@csrf()
<input type="hidden" name="question_id" id ="question_id" value="{{$question->id}}">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row" style="direction:rtl">
              <div class="col-md-6 text-right">
                <h4 class="header-title mb-3">ערוך תיאור</h4>
              </div>
              <div class="col-md-6 text-left">
                <a href="{{route('admin.questionlisting')}}" class="btn btn-primary  mb-3">חזרה לשאלות</a>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="questiontitle">כותרת שאלה</label>                         
                      <input type="text" id="edit_title" name="edit_title" class="form-control" placeholder="הזן כותרת שאלה" value="{{$question->title}}"> 
                    </div>
                  </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="shortquestion">תיאור קצר</label> <textarea rows="4" id="edit_shrtdesc" name ="edit_shrtdesc" class="form-control" placeholder="הזן תיאור קצר" >{{$question->short_desc}}</textarea>
                  </div>
                </div> 
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="briefquestion">חבר בלוג</label>    
                    <br/>
                    <select name="question_blog" class="table-select question-blog" id=""> 
                          <option value="" selected="">בחר בלוג</option>
                          @foreach($blogs as $blog)
                          <option value="{{ $blog->id }}" @if($question->blog_id == $blog->id) selected @endif >{{ $blog->title}}</option>
                          @endforeach 
                     </select>
                  </div>
                </div> 
              </div>
              <div class="row mt-3">
                <div class="col-12 text-center">
                  <button type="button" id="edit_qstn" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                  <button type="button" id ="reset_bck" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
                </div>
              </div>
            </div>
          </div> <!-- end card-->
        </div> <!-- end col-->
      </div><!-- end row-->
    </div> <!-- container -->
  </div> <!-- content -->
</form>
</div>
</div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
   $(document).ready(function() {
     $('#reset_bck').click(function(){
       window.location.href = '{{route("admin.questionlisting")}}';
     });
       $("#edit_qstn").click(function(e) {
         e.preventDefault();
          var fd = new FormData();
         $.ajax({
             url: '{{ route("admin.updatequestions") }}',
             type: 'POST',
             data:new FormData($("#edit_question_form")[0]),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
             success: function(response) {
                 if ($.isEmptyObject(response.error)) {
                     window.location.href = '{{route("admin.questionlisting")}}';
                 } else {
                     printErrorMsg(response.error);
                 }
               }
             });
       });

       
         
         });
         
</script>
@endsection
    