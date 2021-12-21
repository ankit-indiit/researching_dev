@extends('admin.layouts.app')
@section('title', 'חבילות')
@section('content')
<?php 
$is_logged_in = session()->get('admin_logged_in');
if(!isset($is_logged_in) && $is_logged_in != '1'){
    return redirect()->route('admin.adminLogin')->send();
}
?>

<div class="content-page">
	<div class="content">
		<!-- Start Content-->
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
        		<div class="col-12">
                	<div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">בית</a></li>
                                <li class="breadcrumb-item active">חבילות</li>
                        	</ol>
                        </div>
                    	<h4 class="page-title">חבילות</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body recentuser eventcourse ">
                            <div class="row align-items-center" style="direction:rtl">
                                <div class="col-md-6 text-right">
                                <h4 class="header-title mb-3">חבילות</h4>
                                </div>
                                <div class="col-md-6 text-left">
                                    <a href="#addgroup" data-toggle="modal" class="btn btn-primary  mb-3"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <?php 
                                foreach ($packages as $package) {
                                ?>
                                <table  class="  table table-hover table-bordered table-nowrap table-centered ">
                                    <tr>
                                        <td colspan="4">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4>{{$package->package_name}}</h4>
                                                </div>

                                                <div class="col-md-6 text-left">
                                                    <a data-id ="{{$package->package_code	}}" class="btn btn-primary float-left mr-1 addcoursesbtn"><i class="fa fa-plus"></i></a>
                                                    <a data-id="{{$package->package_code	}}" class="edit"><i class="fa fa-pencil-alt"></i></a>
                                                    <form id="deletePackage{{$package->package_code}}" action="{{ route('admin.package.delete', ['id' => $package->package_code] )}}" method="post" style="display:none">@csrf {{ method_field('DELETE') }}</form>
                                                    <a onclick="document.getElementById('deletePackage{{$package->package_code	}}').submit()" ><i class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr> 
                                    <tr  class="thead-light">
                                        <th>קוּרס</th>
                                        <th>תוֹאַר</th>
                                        <th>מוֹסָד</th>
                                        <th>פעולה</th>
                                    </tr>
                                    <?php
                                    $degree = '';
                                    $university = '';
                                    if($package->course_id != ''){
                                    $coursesid = explode(",",$package->course_id) ;
                                    $courses =  DB::table('courses')->whereIn('course_id',$coursesid)->get();
                                    foreach ($courses as $course) {
                                        $degrees = DB::table('degrees')->where('id',$course->degree_id)->pluck('degree_name');
                                        if(count($degrees) > 0){
                                            $degree = $degrees[0];
                                        }else{
                                            $degree = '-';
                                        }
                                        $universities = DB::table('universities')->where('id',$course->university_id)->pluck('university_name');
                                        if(count($universities) > 0){
                                            $university = $universities[0];
                                        }else{
                                            $university = '-';
                                        }
                                    ?>
                                    <tr>
                                        <td>{{$course->course_name}}</td>
                                        <td>{{$degree}}</td>
                                        <td>{{$university}}</td>
                                        <td><a data-id = "{{$course->course_id}}" data-value="{{$package->package_code}}" class="btn btn-xs btn-danger deletedata"><i class="mdi mdi-trash-can"></i></a></td>
                                    </tr>
                                    <?php }}?>
                                </table>
                                <?php 
                                }
                                ?>	
                            </div>	
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <form method="POST" id = "add_package_form" action="{{ route('admin.package.store') }}" enctype="multipart/form-data">
        @csrf()
        <div id="addgroup" class="renewalproduct modal fade" style="direction: rtl;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title w-100">הוסף חבילה</h4>	
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body text-right">
                        <div class="form-group mb-3">
                            <label>שם חבילה</label>
                            <input type="text" id ="package_name" name="package_name"  class="form-control" placeholder="הזן שם חבילה">
                            <span class="text-danger error-text package_name_err"></span>
                        </div> 
                        <div class="form-group mb-3">
                            <label>תיאור</label>
                            <textarea id ="package_description" name="package_description"  rows="3" class="form-control" placeholder="הזן תיאור"></textarea>
                            <span class="text-danger error-text package_description_err"></span>
                        </div> 
                        <div class="form-group mb-3">
                            <label>מחיר חבילה</label>
                            <input type="text" id ="package_price" name="package_price"  class="form-control" placeholder="הזן מחיר חבילה">
                            <span class="text-danger error-text package_price_err"></span>
                        </div> 
                        <div class="form-group mb-3">
                            <label>קורסים</label>
                            <select type="text" id="course_name" name="course_name[]" data-placeholder="בחר קורסים..." class="chosen-select form-control" tabindex="2" multiple>
                                @foreach($courses_data as $course)
                                    <option value="{{ $course->course_id }}">{{ $course->course_name }}</option> 
                                @endforeach
                            </select>
                            <span class="text-danger error-text course_name_err"></span>
                        </div> 	                            
                        <div class="form-group mb-3">
                            <label>תמונה</label>
                            <input type="file" id ="package_image" name="package_image"  class="form-control">
                            <span class="text-danger error-text package_image_err"></span>
                        </div>                            
                        <div class="form-group mb-3">
                            <label>מצב חבילה</label>
                            <input type="hidden" name="package_status" value="0" class="form-control">
                            <input type="checkbox" id="package_status" name="package_status" value="1">
                            <span class="text-danger error-text package_status_err"></span>
                        </div>                        
                        <button type="submit" id="savePackage" class="btn btn-outline-warning waves-effect waves-light">שלח</button>
                    </div>	
                </div>
            </div>
        </div>
        </form>

        <form method="POST" id="edit_package_form" action="{{ route('admin.package.update') }}" enctype="multipart/form-data">
        @csrf()
        <div id="editpackage" class="renewalproduct modal fade" style="direction: rtl;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100">ערוך חבילה</h4>	
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-right">
                    <div class="form-group mb-3">
                        <label>שם חבילה</label>
                        <input type="hidden" id="edit_package_code" name="edit_package_code" value="">
                        <input type="text" id ="edit_package_name" name="edit_package_name"  class="form-control" placeholder="הזן שם חבילה">
                        <span class="text-danger error-text edit_package_name_err"></span>
                    </div> 
                    <div class="form-group mb-3">
                        <label>תיאור</label>
                        <textarea id ="edit_package_description" name="edit_package_description"  rows="3" class="form-control" placeholder="הזן מחיר חבילה"></textarea>
                        <span class="text-danger error-text edit_package_description_err"></span>
                    </div> 
                    <div class="form-group mb-3">
                        <label>מחיר חבילה</label>
                        <input type="text" id ="edit_package_price" name="edit_package_price"  class="form-control" placeholder="הזן מחיר חבילה">
                        <span class="text-danger error-text edit_package_price_err"></span>
                    </div>                     
                    <div class="form-group mb-3">
                        <label>מצב חבילה</label>
                        <input type="hidden" name="edit_package_status" value="0" class="form-control">
                        <input type="checkbox" id="edit_package_status" name="edit_package_status" value="1">
                        <span class="text-danger error-text package_status_err"></span>
                    </div>  
                    <button type="submit" id="updatePackage" class="btn btn-outline-warning waves-effect waves-light">עדכון</button>
                </div>  
            </div>
        </div>
        </div>
        </form>

        <form method="POST" id = "add_course_form" action="{{ route('admin.package.add.course') }}" enctype="multipart/form-data">
        @csrf()
        <div id="addcourse" class="renewalproduct addcourses modal fade" style="direction: rtl;">
            <input type="hidden" id = "course_group_id" name = "course_group_id" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title w-100">הוסף קורסים</h4>	
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <?php 
                        $courses = DB::table('courses')->get();
                    ?>
                    <div class="modal-body text-right">
                        <div class="form-group mb-3">
                            <label>קורסים</label>
                            <select type="text" id ="course_name" name="course_name[]" data-placeholder="בחר קורסים..." class="chosen-select form-control" tabindex="2" multiple>
                                
                                @foreach($courses as $course)
                                    <option value="{{ $course->course_id }}">{{ $course->course_name }}</option> 
                                @endforeach
                            </select>
                            <span class="text-danger error-text course_name_err"></span>
                        </div> 									
                        <button type="submit" id ="addpackageCourse" class="btn btn-outline-warning waves-effect waves-light">שלח</button>
                    </div>			
                </div>
            </div>
        </div>
        </form> 
        <div id="courseDelete" class="deletemodal modal fade">
            <input type="hidden" name="deleted_id" id ="deleted_id" value="">
            <input type="hidden" name="get_groups" id ="get_groups" value="">
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
</div>
<!--content-->

@endsection
@section('scripts')
<script src="https://cdn.tutorialjinni.com/jquery.repeater/1.2.1/jquery.repeater.js"></script>
<script src="https://cdn.tutorialjinni.com/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
<script type="text/javascript">
    function markCheckBox(ctrl) {
        $('input:checkbox.group-name').prop("checked", false);
        $("[name='" + ctrl + "']").prop("checked", true);
        $("[name='" + ctrl + "']").val("1");
    }
    $(document).ready(function(){
        $('.repeater-default').repeater({
            show: function () {
            $(this).slideDown();
        },
        hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
            }
        }
    });

    $("#savePackage").click(function(e) {
        e.preventDefault();
        $('.error-text').empty();
        $.ajax({
            url: '{{ route("admin.package.store") }}',
            type: 'POST',
            data:new FormData($("#add_package_form")[0]),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                console.log(response);
                if ($.isEmptyObject(response.error)) {
                    window.location.href = '{{route("admin.package")}}';
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

    $('.addcoursesbtn').click(function(){
        var id = $(this).attr('data-id');
        $('#course_group_id').val(id);
        $('#addcourse').modal('show');
    });

    $("#addpackageCourse").click(function(e) {
        e.preventDefault();
        var value = new FormData();
        var id = $('#course_group_id').val();
        console.log(id);
        $.ajax({
            url: '{{ route("admin.package.add.course") }}',
            type: 'POST',
               data:new FormData($("#add_course_form")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
            success: function(response) {
                console.log(response);
                if ($.isEmptyObject(response.error)) {
                    window.location.href = '{{route("admin.package")}}';
                } else {
                    printErrorMsg1(response.error);
                }
              }
            });
      });
        function printErrorMsg1 (msg) {
           $.each( msg, function( key, value ) {
              $('.'+key+'_err').text(value);
            });
        }

        $('.edit').click(function(){
                var id = $(this).attr('data-id');
                $.ajax({
                    url: '{{ route("admin.package.get") }}',
                    type: 'POST',
                    dataType: 'json',
                        data: {
                        id:id
                    },
                    success: function (response) {
                        console.log(response);
                        var data = response.package;
                        $('#edit_package_code').val(data.package_code);
                        $('#edit_package_name').val(data.package_name);
                        $('#edit_package_description').val(data.description);
                        $('#edit_package_price').val(data.price);
                        if(data.status == 1){
                            $('#edit_package_status').prop('checked',true);
                        }
                        $('#editpackage').modal('show');
                    }
                });

            });

        $('.deletedata').click(function(){
                var id = $(this).attr('data-id');
                var group_id = $(this).attr('data-value');
                $('#get_groups').val(group_id);
                $('#deleted_id').val(id);
                $('#courseDelete').modal('show');
        });

        $("#delete_data").click(function(e) {
            e.preventDefault();
            var deleted_id = $('#deleted_id').val();
            var groups_id = $('#get_groups').val();
            $.ajax({
                url: '{{ route("admin.package.course.delete") }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    deleted_id:deleted_id,
                    package_id:groups_id,
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