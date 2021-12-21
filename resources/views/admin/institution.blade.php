@extends('admin.layouts.app')

@section('title', ' מוֹסָד ')
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
                                <li class="breadcrumb-item active">מוסדות</li>
                            </ol>
                        </div>
                    <h4 class="page-title">מוסדות</h4>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="row" style="direction:rtl">
                        <div class="col-md-6 text-right">
                            <h4 class="header-title mb-3">כל המוסדות</h4>
                        </div>
                        <div class="col-md-6 text-left">
                            <a href="{{route('admin.addproductcategory')}}" class="btn btn-primary  mb-3">הוסף מוסד</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table  id="basic-datatable" class="table  table-hover table-nowrap table-centered m-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>לוגו המוסד</th>
                                    <th>שם מוסד</th>
                                    <th> מספר חוגים/תארים </th>
                                    <th> מספר הקורסים </th>
                                    <th> פָּעִיל </th>
                                    <th>פעולה</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($universities as $university) {
                                    $degree_count = 0;
                                    $courses_count = 0;
                                    $degree_ids= array();
                                    $image =  asset('/assets/images/' .$university->logo);
                                    $degrees = DB::table('degrees')->where('university_id',$university->id)->get();
                                    $degree_count = count($degrees);
                                    foreach ($degrees as $degree) {
                                        $degree_ids[] = $degree->id;
                                    }
                                    $courses = DB::table('courses')->whereIn('degree_id',$degree_ids)->get();
                                    $courses_count = count($courses);
                                ?>
                                
                                <tr> 
                                    <td>
                                        <img data-href = "{{route('admin.productslisting')}}" src="{{$image}}"  class="table-data" style="height:30px;cursor:pointer"/>
                                    </td>
                                    <td><a data-href = "{{route('admin.productslisting')}}" class="table-data" >{{$university->university_name}}</a></td>
                                    <td>
                                        <a data-href="{{route('admin.degreeslisting').'/'.$university->id}}" href="javascript:void(0)" class="badge badge-success text-white table-data">{{$degree_count}}</a>
                                    </td>
                                    <td>
                                        <a data-href="{{route('admin.degreeslisting').'/'.$university->id}}" href="javascript:void(0)" class="badge badge-success text-white table-data">{{$courses_count}}</a>
                                    </td>
                                    <td>
                                    <label class="switch university-isactive">
                                        <input type="checkbox" value="{{$university->id}}" @if($university->active == 1) checked @endif >
                                        <span class="slider round"></span>
                                    </label>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.editproductcategory').'/'.$university->id}}" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>
                                        <a data-value ="{{$university->id}}" class="btn btn-xs btn-danger delete_category"><i class="mdi mdi-trash-can"></i></a>
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
<div id="DeleteModal2" class="renewalproduct modal fade" style="direction: rtl;">
    <input type="hidden" name="deletedid" id ="deletedid" value="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100">מחק רשומות</h4>   
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-right">
                <div class="form-group mb-3">
                    <label>סיסמה</label>
                    <input id ="get_password" name="get_passowrd" type="password"  class="form-control" placeholder="הזן את הסיסמה">
                </div>
                <button id = "confirm_password" type="button" class="btn btn-outline-warning waves-effect waves-light">שלח</button>
            </div>
        </div>
    </div>
</div> 
@endsection
@section('scripts')
    <script>
        $(document).ready(function($) {
            $(".table-data").click(function() {
                window.document.location = $(this).data("href");
            });
            $('.delete_category').click(function(){
                var id = $(this).attr('data-value');
                $('#deletedid').val(id);
                $('#DeleteModal2').modal('show');

            });
            $("#confirm_password").click(function(e) {
                e.preventDefault();
                var password = $('#get_password').val();
                var deleted_id = $('#deletedid').val();
                $.ajax({
                    url: '{{ route("admin.deleteproductcategory") }}',
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
            $('.switch.university-isactive input[type=checkbox]').click(function(){
                var un_id = $(this).val();
                if(!$(this).is(':checked')){
                    var un_status = 0;
                }else{
                    var un_status = 1;
                }
                if(un_id){
                    $.ajax({
                        url: '{{ route("admin.universityStatusUpdate") }}',
                        type: 'PUT',
                        dataType: 'json',
                            data: {
                            id: un_id,
                            active:un_status
                        }
                    });                   
                }
            });            
        });
    </script>
@endsection