@extends('admin.layouts.app')

@section('title', ' עריכת תואר ')
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
                <li class="breadcrumb-item"><a href="{{route('admin.degreeslisting').'/'.$degree_id}}">תוֹאַר</a></li>
                <li class="breadcrumb-item active">ערוך תואר</li>
              </ol>
            </div>
          <h4 class="page-title">ערוך תואר</h4>
        </div>
      </div>
    </div> 
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row" style="direction:rtl">
              <div class="col-md-6 text-right">
                <h4 class="header-title mb-3">ערוך תואר</h4>
              </div>
              <div class="col-md-6 text-left">
                <a href="{{route('admin.degreeslisting').'/'.$degree_id}}" class="btn btn-primary  mb-3">חזרה לתארים</a>
              </div>
            </div>
            <form method="POST" id="editdegree_form" action = "" enctype="multipart/form-data">
              @csrf()
              <input type="hidden" name="degree_id" id ="degree_id" value ="{{$degree_data->id}}">
              <input type="hidden"id ="university_id" name="university_id" value="{{$degree_data->university_id}}">
            <div class="row">
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="degree_name">תוֹאַר</label>
                      <input type="text" id="degree_name"  name ="degree_name" class="form-control" placeholder="הזן תואר" value="{{$degree_data->degree_name}}">
                      <span class="text-danger error-text degree_name_err"></span>
                    </div>
                  </div>  
                    </div>
                    <div class="row mt-3">
                      <div class="col-12 text-center">
                        <button id = "editdegreebtn" type="button" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                        <button id = "resetdegree" type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
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
  $(document).ready(function(){

  $('#resetdegree').click(function(){
      window.location.href = '{{route("admin.degreeslisting").'/'.$degree_id}}';
    });
    
      $("#editdegreebtn").click(function(e) {
        e.preventDefault();
        var id = $('#university_id').val();
         var fd = new FormData();
        $.ajax({
            url: '{{ route("admin.updatedegree") }}',
            type: 'POST',
            data:new FormData($("#editdegree_form")[0]),
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