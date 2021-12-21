@extends('admin.layouts.app')

@section('title', ' קטגוריית בלוגים ')
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
                <li class="breadcrumb-item"><a href="{{ route('admin.blogslisting') }}">בלוגים</a></li>
                <li class="breadcrumb-item active">קטגוריות</li>
              </ol>
            </div>
            <h4 class="page-title">קטגוריות</h4>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">
          <div class="card-box">
            <div class="row" style="direction:rtl">
              <div class="col-md-6  text-right">
                <h4 class="header-title mb-3">כל הקטגוריות </h4>
              </div>
              <div class="col-md-6 text-left">
                <a href="#addcategory" data-toggle="modal" class="btn btn-primary  mb-3">הוסף קטגוריה</a>
              </div>
            </div>
            <div class="table-responsive">
              <table  id="basic-datatable"  class="table  table-hover table-nowrap table-centered m-0">
                <thead class="thead-light">
                  <tr>
                    <th  class="text-center">שם קטגוריה</th>
                    <th  class="text-center">פעולה</th>
                  </tr>
                </thead>
              <tbody>
                <?php
                foreach ($categories_data as $value) {
                  # code...
                
                 ?>
            <tr>
              <td class="text-center">{{$value->name}}</td>
              <td class="text-center">
                <a data-id ="{{$value->id}}" data-value ="{{$value->name}}"   class="btn btn-xs btn-success editcategories"><i class="mdi mdi-pencil"></i></a>
                <a data-value ="{{$value->id}}" class="btn btn-xs btn-danger deletecategory"><i class="mdi mdi-trash-can"></i></a>
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
</div>
</div>
<div id="addcategory" class="renewalproduct modal fade" style="direction: rtl;">
  <input type="hidden" name="addedval" id ="addedval" value="">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100">הוסף קטגוריה</h4> 
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body text-right">
        <div class="form-group mb-3">
          <label>שם קטגוריה</label>
            <input type="text" id ="added_value" name ="added_value"  class="form-control" placeholder="הזן את שם הקטגוריה">
        </div>
        <button type="button" id = "addnew" class="btn btn-outline-warning waves-effect waves-light">שלח</button>
      </div>  
    </div>
  </div>
</div>  
<div id="editcategory" class="renewalproduct modal fade" style="direction: rtl;">
   <input type="hidden" name="editid" id ="editid" value="">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100">ערוך קטגוריה</h4> 
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body text-right">
        <div class="form-group mb-3">
          <label>שם קטגוריה</label>
            <input type="text" name ="edit_value" id ="edit_value"  class="form-control" placeholder="הזן את שם הקטגוריה" value="">
        </div>
        <button type="button" id ="edited" class="btn btn-outline-warning waves-effect waves-light">שלח</button>
      </div>  
    </div>
  </div>
</div>
<div id="delete_category" class="deletemodal modal fade">
   <input type="hidden" name="deletedid" id ="deletedid" value="">
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
                <button id = "deleted" type="button" class="btn btn-danger">לִמְחוֹק</button>
            </div>
        </div>
    </div>
</div> 
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    $('.deletecategory').click(function(){
      var id = $(this).attr('data-value');
      $('#deletedid').val(id);
      $('#delete_category').modal('show');
    });
    $("#deleted").click(function(e) {
      e.preventDefault();
      var deleted_id = $('#deletedid').val();
      $.ajax({
        url: '{{ route("admin.deletecategory") }}',
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
    $('.editcategories').click(function(){
      var id = $(this).attr('data-id');
      var value = $(this).attr('data-value');
      $('#edit_value').val(value);
      $('#editid').val(id);
      $('#editcategory').modal('show');
    });
    $("#edited").click(function(e) {
      e.preventDefault();
      var edited_id = $('#editid').val();
      var edit_value = $('#edit_value').val();
      $.ajax({
        url: '{{ route("admin.editcategory") }}',
          type: 'POST',
          dataType: 'json',
            data: {
              edit_value:edit_value,
              edit_id:edited_id
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
     $("#addnew").click(function(e) {
          e.preventDefault();
          var add_value = $('#added_value').val();
          $.ajax({
            url: '{{ route("admin.savecategory") }}',
              type: 'POST',
              dataType: 'json',
                data: {
                  add_value:add_value
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