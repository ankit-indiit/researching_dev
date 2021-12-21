@extends('admin.layouts.app')

@section('title', ' להוסיף קורסים ')
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
                <li class="breadcrumb-item active">הוסף קורסים / קבוצות</li>
              </ol>
            </div>
            <h4 class="page-title">הוסף קורסים / קבוצות</h4>
          </div>
        </div>
      </div> 
      <form method="POST" id="add_course_form" action = "{{ route('admin.addeventcourses') }}" enctype="multipart/form-data">
@csrf()    
<input type="hidden" name ="event_id" id="event_id" value ="{{$id}}">
<input type="hidden" name ="type" id="type" value ="0">
      <!-- end page title --> 
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body recentuser eventcourse " style="direction:rtl">
              <div class="row" style="direction:rtl">
                <div class="col-md-6 text-right">
                  <h4 class="header-title mb-3">הוסף קורסים / קבוצות</h4>
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
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>חפש קורסים בודדים</label>
                          <select data-placeholder="חפש קורסים בודדים..." class="chosen-select form-control" tabindex="2" multiple>
                            <option value="">אוניברסיטת ת"א</option>
                            <option value="">אוניברסיטת וארטון</option>
                          </select>   
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table  class="  table table-hover table-nowrap table-centered m-0">
                        <thead class="thead-light">
                          <tr> 
                            <th>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control">
                              </div>
                            </th>
                            <th>מזהה מוצר</th>
                            <th>שם קורס</th>
                            <th>תוֹאַר</th>
                            <th>שם מוסד</th>
                            <th>עלות מוצר</th>
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
                    <div class="custom-control custom-checkbox">
                      <input value = "{{$course->course_id}} " type="checkbox" name="courses[]"  class="custom-control">
                    </div>
                  </td>
                 <td>
                  {{$course->course_id}}                   
                  </td>
                  <td>
                  {{$course->course_name}}
                  </td>
                  <td>{{$degree}}</td>
                  <td>{{$university}} </td>
                  <td>₪{{$course->price}}</td>
                </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
          <div class="text-right mt-2">
            <button type="submit" id="addbtn" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
          </div>
        </div>
      </form>
      
        <div class="tab-pane " id="groupedcourses">
          <form method="POST" id="add_groupcourse_form" action = "{{ route('admin.addeventcourses') }}" enctype="multipart/form-data">
@csrf()    
<input type="hidden" name ="event_id" id="event_id" value ="{{$id}}">
<input type="hidden" name ="type" id="type" value ="1">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>חפש קורסים בודדים</label>
                <select data-placeholder="חפש קורסים בודדים..." class="chosen-select form-control" tabindex="2" multiple>
                  <option value="">אוניברסיטת ת"א</option>
                  <option value="">אוניברסיטת וארטון</option>
                </select>   
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table  class="  table table-hover table-nowrap table-centered m-0">
            <thead class="thead-light">
              <tr> 
                <th>
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control">
                    </div>
                  </th>
                  <th>שם קבוצה</th>
                  <th>קישור Whatsapp</th>
                  <th>אין קורסים</th>
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
              <div class="custom-control custom-checkbox">
                <input value = "{{$group->id}} " type="checkbox" name="courses[]"  class="custom-control">
                  </div>
              </td>
              <td>
                {{$group->groupName}}
              </td>
              <td>{{$group->whatsappLink}}</td>
              <td><label class="badge badge-success">{{$count}}</label></td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
    <div class="text-right mt-2">
      <button type="submit" id="add_groups" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
    </div>
    </form>
  </div>

</div>
</div> <!-- end col-->
</div>
</div> 
</div>

</div>
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    $("#addbtn").click(function(e) {
        e.preventDefault();
         var fd = new FormData();
        $.ajax({

            url: '{{ route("admin.addeventcourses") }}',
            type: 'POST',
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            data:new FormData($("#add_course_form")[0]),
            success: function(response) {
              if ($.isEmptyObject(response.error)) {
                    window.location.href = '{{route("admin.events")}}';
                } else {
                  printErrorMsg(response.error);
                }
              }
              });
              function printErrorMsg (msg) {
                $.each( msg, function( key, value ) {
              $('.'+key+'_err').text(value);
            });
        }
            });

    $("#add_groups").click(function(e) {
        e.preventDefault();
         var fd = new FormData();
        $.ajax({

            url: '{{ route("admin.addeventcourses") }}',
            type: 'POST',
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            data:new FormData($("#add_groupcourse_form")[0]),
            success: function(response) {
              if ($.isEmptyObject(response.error)) {
                    window.location.href = '{{route("admin.events")}}';
                } else {
                  printErrorMsg(response.error);
                }
              }
              });
              function printErrorMsg (msg) {
                $.each( msg, function( key, value ) {
              $('.'+key+'_err').text(value);
            });
        }
            });
  });
</script>
@endsection
        
        
        
        
    
    
    
    
    