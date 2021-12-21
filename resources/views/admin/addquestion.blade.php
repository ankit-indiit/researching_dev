@extends('admin.layouts.app')

@section('title', ' הוסף שאלה ')
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
                <li class="breadcrumb-item active">הוסף שאלה</li>
              </ol>
            </div>
            <h4 class="page-title">הוסף שאלה</h4>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row" style="direction:rtl">
                <div class="col-md-6 text-right">
                  <h4 class="header-title mb-3">הוסף שאלה</h4>
                </div>
                <div class="col-md-6 text-left">
                  <a href="{{route('admin.questionlisting')}}" class="btn btn-primary  mb-3">חזרה לשאלות</a>
                </div>
              </div>
<form method="POST" id = "add_question_form" action="{{ route('admin.savequestions') }}" enctype="multipart/form-data">
@csrf()
              <div class="row">
                <div class="col-lg-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="questiontitle">כותרת שאלה</label>                       
                        <input type="text" id="question_title" name = "question_title"class="form-control" placeholder="הזן כותרת שאלה" > 
                        <span class="text-danger error-text question_title_err"></span>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="shortquestion">תיאור קצר</label>            
                        <textarea rows="4" id="short_desc" name = "short_desc" class="form-control" placeholder="הזן תיאור קצר" ></textarea>
                        <span class="text-danger error-text short_desc_err"></span>
                      </div>
                    </div> 
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="briefquestion">חבר בלוג</label>    
                        <br/>
                        <select name="question_blog" class="table-select question-blog" id=""> 
                              <option value="" selected="">בחר בלוג</option>
                              @foreach($blogs as $blog)
                              <option value="{{ $blog->id }}">{{ $blog->title}}</option>
                              @endforeach 
                         </select>
                      </div>
                    </div> 
                  </div>
                  <div class="row mt-3">
                    <div class="col-12 text-center">
                      <button type="submit" id ="save_question" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                      <button type="button" id ="backbtn" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
                    </div>
                  </div>
                </div>
              </div> <!-- end card-->
            </form>
            </div> <!-- end col-->
          </div>
          <!-- end row-->
        </div> <!-- container -->
      </div> <!-- content -->
    </div>
  </div>
</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#backbtn').click(function(){
      window.location.href = '{{route("admin.questionlisting")}}';
    });
    $("#save_question").click(function(e) {
      e.preventDefault();
        var fd = new FormData();
        $.ajax({
          url: '{{ route("admin.savequestions") }}',
          type: 'POST',
          data:new FormData($("#add_question_form")[0]),
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
      function printErrorMsg (msg) {
        $.each( msg, function( key, value ) {
          $('.'+key+'_err').text(value);
        });
      }
    });
</script>
@endsection
