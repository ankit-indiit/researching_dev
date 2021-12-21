@extends('admin.layouts.app')

@section('title', ' מוֹסָד ')
@section('content')
<?php 
$is_logged_in = session()->get('admin_logged_in');
        
if(!isset($is_logged_in) && $is_logged_in != '1'){
            
    return redirect()->route('admin.adminLogin')->send();
        }

?>
<?php 
if(Session :: has ('quiz_data') || !empty (Session :: get ('quiz_data'))){
  $data = session()->get('quiz_data');
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
                <li class="breadcrumb-item"><a href="javascript: void(0);">
                  ערוך מוצרים
                </a></li>
                <li class="breadcrumb-item active">
                  חִידוֹן
                </li>
              </ol>
            </div>
            <h4 class="page-title">חִידוֹן</h4>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">
          <div class="card-box">
            <div class="row" style="direction:rtl">
              <div class="col-md-6 text-right">
                <h4 class="header-title mb-3">חִידוֹן</h4>
              </div>
              <div class="col-md-6 text-left">
                <a href="{{route('admin.addquiz')}}" class="btn btn-primary  mb-3">הוסף חידון</a>
              </div>
            </div>
            <div class="table-responsive">
              <table  id="basic-datatable" class="table  table-hover table-nowrap table-centered m-0">
                <thead class="thead-light">
                  <tr>
                    <th>
                      S לא.
                    </th>
                    <th>שְׁאֵלָה</th>
                    <th>
                      סימנים
                    </th>
                    <th>
                      ניסיון מחדש
                    </th>
                    <th>
                      ימי-יום
                    </th>
                    <th>פעולה</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  foreach ($quizs as $key => $value) {
                    if($value->quiz_attempt == 0){
                      $attempt = 'No';
                    }else{
                      $attempt = 'Yes';
                    }
                  ?>
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>
                      {{$value->quizTopic}}                          
                    </td>
                    <td>
                      {{$value->perQuestionMarks}}
                    </td>
                    <td>
                     {{$attempt}}
                    </td>
                    <td>
                      {{$value->days}}
                    </td>
                    <td>
                    <a href="{{route('admin.editquiz').'/'.$value->id}}" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>
                    <a data-value ="{{$value->id}}" class="btn btn-xs btn-danger delete_quiz"><i class="mdi mdi-trash-can"></i></a>
                    <a href="{{route('admin.addquizquestions').'/'.$value->id}}" class="btn btn-xs btn-warning topicbtn" data-toggle="tooltip"  title="add questions"><i class="mdi mdi-plus"></i></a>
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

 <div id="quizDelete" class="deletemodal modal fade">
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
            
            $('.delete_quiz').click(function(){
                var id = $(this).attr('data-value');
                $('#deleted_id').val(id);
                $('#quizDelete').modal('show');

            });
            $("#delete_data").click(function(e) {
                e.preventDefault();
                var deleted_id = $('#deleted_id').val();
                $.ajax({
                    url: '{{ route("admin.deletequiz") }}',
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
