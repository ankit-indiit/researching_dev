@extends('admin.layouts.app')

@section('title', ' תוֹאַר ')
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
                <li class="breadcrumb-item active">תוֹאַר</li>
              </ol>
            </div>
            <h4 class="page-title">תוֹאַר</h4>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">
          <div class="card-box">
            <div class="row" style="direction:rtl">
              <div class="col-md-6 text-right">
                <h4 class="header-title mb-3">כל התארים</h4>
              </div>
              <div class="col-md-6 text-left">
                <a href="{{route('admin.adddegrees').'/'.$id}}" class="btn btn-primary  mb-3">הוסף תארים</a>
              </div>
            </div>
            <div class="table-responsive">
              <table  id="basic-datatable" class="table  table-hover table-nowrap table-centered m-0">
                <thead class="thead-light">
                  <tr>
                    <th>מספר מזהה</th>
                    <th>תוֹאַר</th>
                    <th> מספר הקורסים   </th>
                    <th>פעולה</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($degrees as $index => $degree) {
                      $courses_count = 0;
                      $degree_ids= array();
                      $degree_ids[] = $degree->id;
                      $courses = DB::table('courses')->whereIn('degree_id',$degree_ids)->get();
                      $courses_count = count($courses);
                                ?>
                  <tr>
                    <td>
                        <a class="table-data" data-href="{{route('admin.Productslisting').'/'.$degree->id.'/'.$id}}">{{$index + 1 }}  </a>                          
                    </td>
                    <td>
                        <a class="table-data" data-href="{{route('admin.Productslisting').'/'.$degree->id.'/'.$id}}">{{$degree->degree_name}}</a>
                    </td>
                    <td>
                      <a data-href="{{route('admin.Productslisting').'/'.$degree->id.'/'.$id}}" class="badge badge-success text-white table-data">{{$courses_count}}</a>
                    </td>
                    <td>
                      <a href="{{route('admin.editdegrees').'/'.$degree->id}}" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>
                      <a data-value ="{{$degree->id}}" class="btn btn-xs btn-danger delete_degree"><i class="mdi mdi-trash-can"></i></a>
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
<div id="DeleteDegree" class="renewalproduct modal fade" style="direction: rtl;">
  <input type="hidden" name="degree_id" id ="degree_id" value="">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100">מחק רשומות</h4> 
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body text-right">
        <div class="form-group mb-3">
          <label>סיסמה</label>
          <input id = 'getpassword' type="password" name = "getpassword"  class="form-control" placeholder="הזן את הסיסמה">
        </div>
        <button id = "confirmpassword" type="button" class="btn btn-outline-warning waves-effect waves-light">שלח</button>
      </div>
      
    </div>
  </div>
</div> 
@endsection
@section('scripts')
      <script type="text/javascript">
      $(document).ready(function($) {
        $(".table-data").click(function() {
          window.document.location = $(this).data("href");
        });
        $('.delete_degree').click(function(){
                var id = $(this).attr('data-value');
                $('#degree_id').val(id);
                $('#DeleteDegree').modal('show');

            });
        $("#confirmpassword").click(function(e) {
                e.preventDefault();
                var password = $('#getpassword').val();
                var deleted_id = $('#degree_id').val();
                $.ajax({
                    url: '{{ route("admin.deletedegree") }}',
                    type: 'POST',
                    dataType: 'json',
                        data: {
                        password: password,
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