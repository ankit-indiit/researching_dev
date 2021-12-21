@extends('admin.layouts.app')
@section('title', ' אירועים  ')
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
                <li class="breadcrumb-item active">אירועים</li>
              </ol>
            </div>
            <h4 class="page-title">אירועים</h4>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">
          <div class="card-box">
            <div class="row" style="direction:rtl">
              <div class="col-md-6 text-right">
                <h4 class="header-title mb-3">אירועים</h4>
              </div>
              <div class="col-md-6 text-left">
                <a href="{{route('admin.addevent')}}" class="btn btn-primary  mb-3">הוסף אירוע</a>
              </div>
            </div>
            <div class="table-responsive">
              <table  id="basic-datatable" class="table  table-hover table-nowrap table-centered m-0">
                <thead class="thead-light">
                  <tr>
                    <th width="35%">שם האירוע</th>
                    <th>תמונה</th>
                    <th>תאריך ושעה</th>
                    <th>פעולה</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  foreach ($events_data as $value) {
                    $image =  asset('/assets/images/' .$value->image);
                    $date =  date('m.d.Y', strtotime($value->eventDate));
                  ?>
                  <tr>
                    <td>{{$value->eventName}}</td>
                    <td><img src="{{ $image }}"  class="rounded-circle avatar-md"></td>
                    <td><span class="badge badge-secondary text-white dir-ltr">{{$date}} at {{$value->eventTime}}</span></td>
                    <td>
                      <a href="{{route('admin.viewevent').'/'.$value->id}}" data-toggle="tooltip" title="פרט קורס אירוע" class="btn btn-xs btn-info"><i class="mdi mdi-eye"></i></a>
                      <a href="{{route('admin.addeventcourse').'/'.$value->id}}" data-toggle="tooltip" title="הוסף קורסים / קבוצות" class="btn btn-xs btn-primary"><i class="mdi mdi-plus"></i></a>
                      <a href="{{route('admin.editevent').'/'.$value->id}}"  data-toggle="tooltip" title="ערוך אירוע" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>
                      <a data-value ="{{$value->id}}"  class="btn btn-xs btn-danger delete_event"><i class="mdi mdi-trash-can"></i></a>
                    </td>
                  </tr>
                <?php  }?>
                </tbody>
              </table>
            </div>
          </div>
        </div> 
      </div>
    </div>
  </div>
</div>
<div id="eventDelete" class="deletemodal modal fade">
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
                <button id ="delete_data" type="button" class="btn btn-danger">לִמְחוֹק</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function($) {
            $('.delete_event').click(function(){
                var id = $(this).attr('data-value');
                $('#deleted_id').val(id);
                $('#eventDelete').modal('show');

            });
            $("#delete_data").click(function(e) {
                e.preventDefault();
                var deleted_id = $('#deleted_id').val();
                $.ajax({
                    url: '{{ route("admin.deleteevent") }}',
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