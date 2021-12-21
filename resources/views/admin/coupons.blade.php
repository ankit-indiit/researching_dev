@extends('admin.layouts.app')

@section('title', ' קופונים ')
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
                <li class="breadcrumb-item active">קופונים</li>
              </ol>
            </div>
            <h4 class="page-title">קופונים</h4>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">
          <div class="card-box">
            <div class="row" style="direction:rtl">
              <div class="col-md-6 text-right">
                <h4 class="header-title mb-3">קופונים</h4>
              </div>
              <div class="col-md-6 text-left">
                <a href="{{route('admin.addcoupon')}}" class="btn btn-primary  mb-3">הוסף קופון</a>
              </div>
            </div>
            <div class="table-responsive">
              <table  id="basic-datatable" class="table  table-hover table-nowrap table-centered m-0">
                <thead class="thead-light">
                  <tr>
                  <th>שֵׁם</th>
                  <th>קוד קופון</th>
                  <th>הנחה (%)</th>
                  <th>מוֹסָד</th>
                  <th>קורסים</th>
                  <th> תארים  </th>
                  <th>פעולה</th>
                  </tr>
                </thead>
              <tbody>
                <?php
                  foreach ($coupons_data as $index => $coupon_data) {
                    if($coupon_data->university_name != ''){
                      $university_name = $coupon_data->university_name;
                    }else{
                      $university_name = '-';
                    }
                    if($coupon_data->degree_name != ''){
                      $degree_name = $coupon_data->degree_name;
                    }else{
                      $degree_name = '-';
                    }
                    if($coupon_data->course_name != ''){
                      $course_name = $coupon_data->course_name;
                    }else{
                      $course_name = '-';
                    }
                  ?>
            <tr>
            <td>{{$coupon_data->coupon_name}}</td>
            <td>{{$coupon_data->coupon_code}}</td>
            <td>{{$coupon_data->value}}%</td>
            <td>{{$university_name}}</td>
            <td>{{$course_name}}</td>
            <td>{{$degree_name}} </td>
            <td>
              <a href="{{route('admin.editcoupon').'/'.$coupon_data->id}}" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>
              <a data-value ="{{$coupon_data->id}}" class="btn btn-xs btn-danger delete_coupon"><i class="mdi mdi-trash-can"></i></a>
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
<!--header ends -->
    <div id="couponDelete" class="deletemodal modal fade">
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
    <!--content-->

@endsection
@section('scripts')
    <script>
        $(document).ready(function($) {
            
            $('.delete_coupon').click(function(){
                var id = $(this).attr('data-value');
                $('#deleted_id').val(id);
                $('#couponDelete').modal('show');

            });
            $("#delete_data").click(function(e) {
                e.preventDefault();
                var deleted_id = $('#deleted_id').val();
                $.ajax({
                    url: '{{ route("admin.deletecoupon") }}',
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