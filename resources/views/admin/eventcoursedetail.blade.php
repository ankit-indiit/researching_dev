@extends('admin.layouts.app')

@section('title', ' קורס אירועים  ')
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
            <li class="breadcrumb-item"><a href="{{route('admin.events')}}">אירועים</a></li>
            <li class="breadcrumb-item active">פרט קורס אירוע</li>
          </ol>
          </div>
            <h4 class="page-title">פרט קורס אירוע</h4>
          </div>
        </div>
      </div>     
      <!-- end page title --> 
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body recentuser eventcourse " style="direction:rtl">
              <div class="row" style="direction:rtl">
                <div class="col-md-6 text-right">
                  <h4 class="header-title mb-3">פרט קורס אירוע</h4>
                </div>
                <div class="col-md-6 text-left">
                  <a href="{{route('admin.events')}}" class="btn btn-primary  mb-3">חזרה לאירועים</a>
                     </div>
                    </div>
                  <ul class="nav nav-tabs justify-content-center">
                    <li class="nav-item">
                      <a href="#singlecourses" data-toggle="tab" aria-expanded="true" class="nav-link active">
                          קורסים בודדים
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="#groupedcourses" data-toggle="tab" aria-expanded="false" class="nav-link ">
                           קורסים מקובצים
                    </a>
                  </li>
                  </ul>
                    <div class="tab-content">
                      <div class="tab-pane show active" id="singlecourses">
                        <div class="table-responsive">
                          <table id="basic-datatable" class="  table table-borderless table-hover table-nowrap table-centered m-0">
                            <thead class="thead-light">
                              <tr> 
                                <th>מזהה מוצר</th>
                                <th>שם קורס</th>
                                <th>תוֹאַר</th>
                                <th>שם מוסד</th>
                                <th>עלות מוצר</th>
                                <th>פעולה</th>
                              </tr>
                            </thead>
                          <tbody>
                            <?php foreach($courses_data as $index => $course){
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
                              <td>
                                {{$course->course_id}}
                              </td>
                              <td>
                             {{$course->course_name}}
                              </td>
                              <td>{{$degree}}</td>
                                <td>{{$university}}  </td>
                              <td>
                                 ₪{{$course->price}}                 
                              </td>
                              <td>
                                <a data-id ="{{$course->course_id}}" class="btn btn-xs btn-danger delete_course"><i class="mdi mdi-trash-can"></i></a>
                              </td>
                            </tr>
                            <?php }?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane " id="groupedcourses">
          <div class="table-responsive">
            <table  class="  table table-hover table-nowrap table-centered m-0">
            <thead class="thead-light">
              <tr> 
                  <th>שם קבוצה</th>
                  <th>קישור Whatsapp</th>
                  <th>אין קורסים</th>
                  <th>פעולה</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $count = 0; 
              foreach($groups as $group){
                $courses = $group->courseIds;
                $courses = explode(',',$courses);
                $count = count($courses);
                ?>
            <tr>
              <td>
                {{$group->groupName}}
              </td>
              <td>{{$group->whatsappLink}}</td>
              <td><label class="badge badge-success">{{$count}}</label></td>
              <td>
                <a  data-id ="{{$group->id}}" class="btn btn-xs btn-danger delete_group"><i class="mdi mdi-trash-can"></i></a>
              </td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
                    </div>
                </div>
              </div> <!-- end col-->
            </div>
          </div> 
        </div>
      </div>
    <!-- END wrapper -->
    <div id="deletecourse" class="deletemodal modal fade">
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

<div id="deletegroup" class="deletemodal modal fade">
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
                <button id ="deletedata" type="button" class="btn btn-danger">לִמְחוֹק</button>
            </div>
        </div>
    </div>
</div>
  @endsection
  @section('scripts')
    <script>
        $(document).ready(function($) {
            
            $('.delete_course').click(function(){
                var id = $(this).attr('data-id');
                $('#deleted_id').val(id);
                $('#deletecourse').modal('show');

            });
            $("#delete_data").click(function(e) {
                e.preventDefault();
                var deleted_id = $('#deleted_id').val();
                $.ajax({
                    url: '{{ route("admin.deletecourseevent") }}',
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

            $('.delete_group').click(function(){
                var id = $(this).attr('data-id');
                $('#deletedid').val(id); 
                $('#deletegroup').modal('show');

            });
            $("#deletedata").click(function(e) {
                e.preventDefault();
                var deleted_id = $('#deletedid').val();
                $.ajax({
                    url: '{{ route("admin.deletegroupevent") }}',
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