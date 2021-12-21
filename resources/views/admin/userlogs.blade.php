@extends('admin.layouts.app')

@section('title', ' יומני משתמשים  ')
@section('content')
<?php 
$is_logged_in = session()->get('admin_logged_in');
        
if(!isset($is_logged_in) && $is_logged_in != '1'){
            
    return redirect()->route('admin.adminLogin')->send();
        }

?>
<style type="text/css">
	.buttons-excel
	{
		display: none;
	}
</style>

<div class="content-page">
  <div class="content">
    <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="page-title-box">
	            <div class="page-title-right">
	              <ol class="breadcrumb m-0">
	                <li class="breadcrumb-item">
	                  <a href="{{route('admin.dashboard')}}">בית</a>
	                </li>
	                <li class="breadcrumb-item active"> User Logs  </li>
	              </ol>
	            </div>
              <h4 class="page-title"> User Logs </h4>
            </div>
         </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="card-box recentuser">
             <div class="row" style="direction:rtl">
              <div class="col-md-6  text-right">
                <h4 class="header-title mb-3">כל המשתמשים </h4>
              </div>
              <!-- <div class="col-md-6 text-left">
                <a href="{{route('admin.adduser')}}" class="btn btn-primary  mb-3">הוסף משתמש</a>
              </div> -->
             </div>
             <div class="table-responsive">
                <table id="basic-datatable1"  class="table table-borderless table-hover table-nowrap table-centered m-0">
	                <thead class="thead-light">
	                   <tr>
	                     <th> Sr No </th>	
	                     <th> Date </th>	
	                     <th> Time </th>	
	                     <th> IP </th>	
	                     <th> Action </th>	
	                   </tr>
	                </thead>
	                <tbody>
	                	<?php
	                	foreach ($userlogs_data as $index => $value) {
	                		$date_arr= explode("/", $value->last_login_at);
	                		$date = explode(' ',$date_arr[2]) ;
	                	 ?>
	                   <tr>
	                      <td>
	                         {{$index+1}}
	                      </td>
	                      <td>
	                          {{$date[0]}} {{$date_arr[1]}} {{$date_arr[0]}} 
	                      </td>
	                      <td>
	                      	{{$date[1]}}
	                      	
	                      </td>
	                      <td>
	                         {{$value->last_login_ip}}
	                      </td>
	                      <td>
	                      	<a data-value ="{{$value->id}}" class="btn btn-xs btn-danger delete_logs"><i class="mdi mdi-trash-can"></i></a>
	                      </td>
	                   </tr>
	                   <?php }?>
	                </tbody>
                </table>
	          </div>
	  		</div>   
        </div>
      </div>

    </div>
  </div>
  <div id="DeleteLog" class="deletemodal modal fade">
      <input type="hidden" name="deleted_id" id ="deleted_id" value="">
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
                <button id ="delete_log" type="button" class="btn btn-danger">לִמְחוֹק</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function($) {
            
            $('.delete_logs').click(function(){
                var id = $(this).attr('data-value');
                $('#deleted_id').val(id);
                $('#DeleteLog').modal('show');

            });
            $("#delete_log").click(function(e) {
                e.preventDefault();
                var deleted_id = $('#deleted_id').val();
                $.ajax({
                    url: '{{ route("admin.deletelog") }}',
                    type: 'POST',
                    dataType: 'json',
                        data: {
                        deleted_id:deleted_id
                    },
                    success: function (response) {
                        if(response.status == 1){
                            window.location.reload();
                        }else{
                            alert(response.msg);
                        }
                    }
                });
            });
        });
    </script>
@endsection