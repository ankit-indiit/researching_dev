@extends('admin.layouts.app')

@section('title', ' להוסיף תואר ')
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
                  <li class="breadcrumb-item"><a href="{{route('admin.productslisting')}}">מוֹסָד</a></li>
                  <li class="breadcrumb-item"><a href="{{route('admin.degreeslisting').'/'.$id}}">תוֹאַר</a></li>
                  <li class="breadcrumb-item active">הוסף תואר</li>
                </ol>
              </div>
              <h4 class="page-title">הוסף תואר</h4>
            </div>
          </div>
        </div> 
<form method="POST" id = "add_degree_form" action="{{ route('admin.savedegree') }}" enctype="multipart/form-data">
@csrf()
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="alert alert-danger" id ="profile_error_message" style="display:none">
                <ul></ul>
                </div>
                <div class="row" style="direction:rtl">
                  <div class="col-md-6 text-right">
                    <h4 class="header-title mb-3">הוסף תואר</h4>
                  </div>
                  <div class="col-md-6 text-left">
                    <a href="{{route('admin.degreeslisting').'/'.$id}}" class="btn btn-primary  mb-3">חזרה לתארים</a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="dname">תוֹאַר</label>
                          <input type="text" id="degree_name" name ="degree_name" class="form-control" placeholder="הזן תואר" >
                          <span class="text-danger error-text degree_name_err"></span>
                        </div>
                      </div>
                    </div>
                    <input type="hidden" id="adddegree_university" name ="adddegree_university" value ="{{$id}}">
                    <div class="row mt-3">
                      <div class="col-12 text-center">
                        <button id = "savedegreebtn" type="submit" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                        <button type="button" id ="degree_back" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
                      </div>
                    </div>
                  </div>
                </div> <!-- end card-->
              </div> <!-- end col-->
            </div>
            <!-- end row-->
          </div> <!-- container -->
        </div> <!-- content -->
      </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    $('#degree_back').click(function(){
      window.location.href = '{{route("admin.degreeslisting").'/'.$id}}';
    });
    $("#savedegreebtn").click(function(e) {
        e.preventDefault();
        var id = $('#adddegree_university').val();
         var fd = new FormData();
        $.ajax({
            url: '{{ route("admin.savedegree") }}',
            type: 'POST',
            data:new FormData($("#add_degree_form")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
            success: function(response) {
                if ($.isEmptyObject(response.error)) {
                    window.location.href = '{{route("admin.degreeslisting")}}' + '/' + id;
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