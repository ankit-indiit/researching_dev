@extends('admin.layouts.app')
@section('title', ' קורסים מקובצים ')
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
                                <li class="breadcrumb-item active">קורסים מקובצים</li>
                        	</ol>
                        </div>
                    	<h4 class="page-title">קורסים מקובצים</h4>
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
                                <h4 class="header-title mb-3">קורסים מקובצים</h4>
                                </div>
                                <div class="col-md-6 text-left">
                                    <a href="#addgroup" data-toggle="modal" class="btn btn-primary  mb-3"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <?php 
                                foreach ($groups as $value) {
                                ?>
                                <table  class="  table table-hover table-bordered table-nowrap table-centered ">
                                    <tr>
                                        <td colspan="4">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4>{{$value->groupName}}</h4>
                                                </div>

                                                <div class="col-md-6 text-left">
                                                    <a data-id ="{{$value->id}}" class="btn btn-primary float-left mr-1 addcoursesbtn"><i class="fa fa-plus"></i></a>
                                                    <a data-id="{{$value->id}}" class="edit"><i class="fa fa-pencil-alt"></i></a>
                                                    <form id="deleteGroup{{$value->id}}" action="{{route('admin.delete.group', ['id' => $value->id] )}}" method="post" style="display:none">@csrf {{ method_field('DELETE') }}</form>
                                                    <a onclick="document.getElementById('deleteGroup{{$value->id}}').submit()" ><i class="fa fa-trash"></i></a>
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
                                    if($value->courseIds != ''){
                                    $coursesid = json_decode($value->courseIds,true) ;
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
                                        <td><a data-id = "{{$course->course_id}}" data-value="{{$value->id}}" class="btn btn-xs btn-danger deletedata"><i class="mdi mdi-trash-can"></i></a></td>
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
        <form method="POST" id = "add_group_form" action="{{ route('admin.savegroup') }}" enctype="multipart/form-data">
        @csrf()
        <div id="addgroup" class="renewalproduct modal fade" style="direction: rtl;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title w-100">הוסף קבוצה</h4>	
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body text-right">
                        <div class="form-group mb-3">
                            <label>שם קבוצה</label>
                            <input type="text" id ="group_name" name="group_name"  class="form-control" placeholder="הזן את שם הקבוצה">
                            <span class="text-danger error-text group_name_err"></span>
                        </div> 
                        
                        <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="plan_validity">
                            קישור Whatsapp
                        </label>
                        <div class="repeater-default">
                            <div data-repeater-list="links">
                                <div data-repeater-item="whatsapp_link">
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="whatsapp_link" name="whatsapp_link" placeholder="" value="" >
                                        </div>
                                        <div class="col-md-2">
                                        <input type="checkbox" id="is_selected" name="is_selected" class="group-name" onclick="markCheckBox(this.attributes['name'].value);" value="0" />
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <button class="btn btn-danger" data-repeater-delete type="button"> <i class="bx bx-x"></i>
                                                Delete
                                            </button>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="mt-3 btn btn-primary" data-repeater-create type="button"><i class="bx bx-plus"></i>
                                        Add
                                    </button>
                            </div>
                        </div>
                    </div>
                </div>

                        <button type="submit" id="saveGroup" class="btn btn-outline-warning waves-effect waves-light">שלח</button>
                    </div>	
                </div>
            </div>
        </div>
        </form>

        <form method="POST" id = "edit_group_form" action="{{ route('admin.editgroup') }}" enctype="multipart/form-data">
        @csrf()
        <div id="editgroup" class="renewalproduct modal fade" style="direction: rtl;">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100">הוסף קבוצה</h4> 
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-right">
                        <div class="form-group mb-3">
                        <label>שם קבוצה</label>
                            <input type="hidden" id="edit_group_id" name="edit_group_id" value="">
                            <input type="text" id ="edit_group_name" name="edit_group_name"  class="form-control" placeholder="הזן את שם הקבוצה" required />
                            <span class="text-danger error-text edit_group_name_err"></span>
                        </div>
                        <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="plan_validity">
                            קישור Whatsapp
                        </label>
                        <div class="repeater-default">
                            <div data-repeater-list="edit_links" class="edit_repeter_container">
                                <div data-repeater-item="edit_whatsapp_link" class="main_repeter">
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="edit_whatsapp_link" name="edit_whatsapp_link" placeholder="" value="editvalue" required />
                                        </div>
                                        <div class="col-md-2">
                                        <input type="checkbox" id="is_edit_selected" name="is_edit_selected" class="group-name" onclick="markCheckBox(this.attributes['name'].value);" value="0" is_checked/>
                                        </div>
                                        <div class="col-md-4">
                                            <button class="btn btn-danger" data-repeater-delete type="button"> <i class="bx bx-x"></i>
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="mt-3 btn btn-primary" data-repeater-create type="button"><i class="bx bx-plus"></i>
                                        Add
                                    </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" id="editGroup" class="btn btn-outline-warning waves-effect waves-light">שלח</button>
            </div>  
            </div>
        </div>
        </div>
        </form>

        <form method="POST" id = "add_course_form" action="{{ route('admin.addgroupcourse') }}" enctype="multipart/form-data">
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
                        <button type="submit" id ="addgroupCourse" class="btn btn-outline-warning waves-effect waves-light">שלח</button>
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

    $("#saveGroup").click(function(e) {
        e.preventDefault();
        $.ajax({
            url: '{{ route("admin.savegroup") }}',
            type: 'POST',
            data:new FormData($("#add_group_form")[0]),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                console.log(response);
                if ($.isEmptyObject(response.error)) {
                    window.location.href = '{{route("admin.groupedcourses")}}';
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

    $("#addgroupCourse").click(function(e) {
        e.preventDefault();
        var value = new FormData();
        var id = $('#course_group_id').val();
        console.log(id);
        $.ajax({
            url: '{{ route("admin.addgroupcourse") }}' + '/' + id,
            type: 'POST',
               data:new FormData($("#add_course_form")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
            success: function(response) {
                console.log(response);
                if ($.isEmptyObject(response.error)) {
                    window.location.href = '{{route("admin.groupedcourses")}}';
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
                    url: '{{ route("admin.geteditdata") }}',
                    type: 'POST',
                    dataType: 'json',
                        data: {
                        id:id
                    },
                    success: function (response) {
                      $.each(response.links, function(i, d) {
                        $('#edit_group_name').val(d.groupName);
                        $('#edit_group_id').val(d.id);
                        var obj = d.whatsappLink;
                        var links = JSON.parse(obj);
                        $('.main_repeter:not(:first)').remove();
                        $repeter_el = '<div data-repeater-item="edit_whatsapp_link" class="main_repeter">'+
                                    '<div class="row mt-2">'+
                                        '<div class="col-md-6">'+
                                            '<input type="text" class="form-control" id="edit_whatsapp_link" name="edit_links[0][edit_whatsapp_link]" placeholder="" value="editvalue" required="">'+
                                        '</div>'+
                                        '<div class="col-md-2">'+
                                            '<input type="checkbox" id="is_edit_selected" name="edit_links[0][is_edit_selected][]" class="group-name" onclick="markCheckBox(this.attributes[ name].value);" value="0" is_checked="">'+
                                        '</div>'+
                                            '<div class="col-md-4">'+
                                            '<button class="btn btn-danger" data-repeater-delete="" type="button"> <i class="bx bx-x"></i>'+
                                            ' Delete'+
                                            '</button>'+
                                        '</div>'+
                                    '</div>'+
                                    ' </div>';
                        $('.edit_repeter_container').html("");
                        var $repeter_elemnt_html='';
                        $.each( links, function( key, value ) {
                            $repeter_elemnt = $repeter_el.replaceAll("edit_links[0]", "edit_links["+key+"]"); 
                            $repeter_elemnt = $repeter_elemnt.replaceAll("editvalue", value); 
                            if(d.link_selected == key){
                                $repeter_elemnt_html += $repeter_elemnt.replaceAll("is_checked", "checked"); 
                            }else{
                                $repeter_elemnt_html += $repeter_elemnt.replaceAll("is_checked", ""); 
                            }    
                        });
                        $('.edit_repeter_container').html($repeter_elemnt_html);
                      });
                      $('#editgroup').modal('show');
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
                    url: '{{ route("admin.deletecourse") }}',
                    type: 'POST',
                    dataType: 'json',
                        data: {
                        deleted_id:deleted_id,
                        groups_id:groups_id,
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