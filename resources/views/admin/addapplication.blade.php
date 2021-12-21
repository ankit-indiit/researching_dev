@extends('admin.layouts.app')

@section('title', ' יישום להוסיף ')
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
                                <li class="breadcrumb-item"><a href="{{route('admin.application')}}">ניהול יישומים</a></li>
                                <li class="breadcrumb-item active">הוסף ניהול יישומים</li>
                            </ol>
                        </div>
                        <h4 class="page-title">הוסף ניהול יישומים</h4>
                    </div>
                </div>
            </div> 

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
				    <div class="row" style="direction:rtl">
				        <div class="col-md-6 text-right">
                            <h4 class="header-title mb-3">הוסף ניהול יישומים</h4>
				        </div>
				        <div class="col-md-6 text-left">
                            <a href="{{route('admin.application')}}" class="btn btn-primary  mb-3">חזרה לניהול יישומים</a>
				        </div>
					</div>
<form method="POST" id = "add_chat" action="{{ route('admin.saveapp') }}" enctype="multipart/form-data">
@csrf() 
    <div class="row">
		<div class="col-lg-12">
        	<div class="row">
                <div class="col-md-6">
					<div class="form-group">
						<label>כותרת</label>
						<input type="text" name ="title" id ="title" class="form-control" placeholder="כותרת" >
						<span class="text-danger error-text title_err"></span>
					</div>
				</div>
                <div class="col-md-6">
                	<div class="form-group">
			        	<label>חפש שם משתמש</label>
						<select class="app_select" name="selected_user" id="selected_user">
							@foreach($users_list as $user_list)
			            	<option value="{{$user_list->id}}">{{$user_list->first_name}}</option>
			            	@endforeach
						</select>
						<span class="text-danger error-text selected_user_err"></span>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group uploadfiles">
						<label>העלה קבצים</label>
						<label for="uploadfile" class="fileupload"> <i class="fa fa-upload"></i><p id="image_title"> אנא בחר בקובץ  </p></label>
						<input type="file" id="uploadfile" name="uploadfile" style="display:none">
						<span class="text-danger error-text uploadfile_err"></span>
					</div>
				</div>
	            <div class="col-md-12">
					<div class="form-group">
						<label>תוֹכֶן</label>
						<textarea type="text" name="content" id ="content" rows="4" class="form-control" placeholder="תוֹכֶן" >
                    	</textarea>
                    	<span class="text-danger error-text content_err"></span>
					</div>
				</div>
			</div>
			<div class="row mt-3">
                <div class="col-12 text-center">
                    <button type="button" id = "upload_chat_btn" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                    <button type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
                </div>
        	</div>
        </div>
    </div> <!-- end card-->
    </form>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
	$(".app_select").select2();

	$('#uploadfile').change(function() {
       $('#image_title').text(this.files && this.files.length ? this.files[0].name : '');
     });
     $("#upload_chat_btn").click(function(e) {
           e.preventDefault();
           var fd = new FormData();
           var files = $('#uploadfile')[0].files;
            // Check file selected or not
           if(files.length > 0 ){
            fd.append('file',files[0]);
           $.ajax({
             url: '{{ route("admin.saveapp") }}',
             type: 'POST',
               data:new FormData($("#add_chat")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
             success: function(data) {
                   if ($.isEmptyObject(data.error)) {
                    window.location.href = '{{route("admin.application")}}';
                } else {
                    printErrorMsg(data.error);
                }
               }
           });
         }else{
             alert("Please select a file.");
           }
   
         });
     function printErrorMsg (msg) {
          $.each( msg, function( key, value ) {
              $('.'+key+'_err').text(value);
            });
        }

	
</script>
@endsection
    