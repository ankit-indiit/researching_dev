@extends('admin.layouts.app')

@section('title', ' שְׁאֵלָה ')
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
                <li class="breadcrumb-item">
                  <a href="javascript: void(0);">בית</a>
                </li>
                <li class="breadcrumb-item active">שאלות</li>
              </ol>
            </div>
            <h4 class="page-title">שאלות</h4>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">
          <div class="card-box">
            <div class="row" style="direction:rtl">
              <div class="col-md-6 text-right">
                <h4 class="header-title mb-3">שאלות</h4>
              </div>
              <div class="col-md-6 text-left">
                <a href="{{route('admin.addquestions')}}" class="btn btn-primary  mb-3">הוסף שאלה</a>
              </div>
            </div>
            <div class="table-responsive">
              <table  id="basic-datatable" class="table  table-hover table-nowrap table-centered m-0">
                <thead class="thead-light">
                  <tr>
                    <th>S.no</th>
                      <th>כותרת שאלה</th>
                      <th>תיאור קצר</th>
                      <th>פעולה</th>
                  </tr>
                </thead>
              <tbody>
                <?php
                  foreach ($questions as $question) {
                  ?>
              <tr>
                <td>{{$question->id}}</td>
                <td>{{$question->title}} </td>
                <td>{{ Str::limit($question->short_desc, 50) }}</td>
                <td>
                  <a href="{{route('admin.editquestions') . '/' . $question->id}}" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>
                  <a data-value ="{{$question->id}}" class="btn btn-xs btn-danger delete_questn"><i class="mdi mdi-trash-can"></i></a>
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

<div id="question_delt" class="deletemodal modal fade">
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
<script type="text/javascript">
  $(document).ready(function(){
    $('.delete_questn').click(function(){
                var id = $(this).attr('data-value');
                $('#deleted_id').val(id);
                $('#question_delt').modal('show');

            });
            $("#delete_data").click(function(e) {
                e.preventDefault();
                var deleted_id = $('#deleted_id').val();
                $.ajax({
                    url: '{{ route("admin.deletequestions") }}',
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