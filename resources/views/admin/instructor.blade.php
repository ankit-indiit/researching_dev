@extends('admin.layouts.app')

@section('title', ' מַדְרִיך  ')
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
                <li class="breadcrumb-item active">מַדְרִיך</li>
              </ol>
            </div>
            <h4 class="page-title">מַדְרִיך</h4>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">
          <div class="card-box ">
            <div class="row" style="direction:rtl">
              <div class="col-md-6  text-right">
                <h4 class="header-title mb-3">מַדְרִיך </h4>
              </div>
              <div class="col-md-6 text-left">
                <a href="{{route('admin.addinstructor')}}" class="btn btn-primary  mb-3">הוסף מדריך</a>
              </div>
            </div>
            
            <div class="table-responsive">
                <table id="basic-datatable"  class="table table-borderless table-hover table-nowrap table-centered m-0">
                  <thead class="thead-light">
                    <tr>
                      <th colspan="2">תמונה</th>
                      <th>מוסד אקדמי</th>
                      <th>תואר </th>
											<th>שם קורס </th>
											<th>מרתון </th>
											<th>פעולה</th>
                    </tr>
                  </thead>
                  <tbody>
      <?php
        $courses_data = array();
        $count_data = array();
        $count = '';
        $created_at ='';
        $created_date = '';
        $degree = array();
        $university = array();
        $degree_name = '';
        $university_name = '';
        $course_name = '';
        $course_id = '';
        $courses_data1 = array();
        $created_at1 ='';
        $created_date1 = '';
        $degree1 = array();
        $university1 = array();
        $degree_name1 = '';
        $university_name1 = '';
        if(count($instructors_data) > 0){
        foreach ($instructors_data as $key => $instructor) {
          $count_data = DB::table('courses')->where('instructor_id',$instructor->id)->get();
          $courses_data = DB::table('courses')->where('instructor_id',$instructor->id)->first();
          $count = count($count_data);
          $image =  asset('/assets/users/' .$instructor->avatar);
          if(isset($courses_data)){
            $course_id = $courses_data->course_id;
          }
           if($count != 0){
              $course_name = $courses_data->course_name;
              $degree = DB::table('degrees')->where('id',$courses_data->degree_id)->pluck('degree_name');
              if(!empty($degree)){
                $degree_name = $degree[0];
              }else{
                $degree_name = '';
              }

              $university = DB::table('universities')->where('id',$courses_data->university_id)->pluck('university_name');
              if(!empty($university)){
                $university_name = $university[0];
              }else{
                $university_name = '';
              }
            $created_at = strtotime($courses_data->created_at);
            $created_date = date('Y.M.d',$created_at);
        ?>
        <tr>
          <td style="width: 36px;" rowspan="{{$count}}">
            <img src="{{$image}}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
          </td>
          <td rowspan="{{$count}}">
            <h5 class="m-0 font-weight-normal">{{$instructor->first_name}} {{$instructor->last_name}}</h5>
          </td>
          <td>
            {{$university_name}}
          </td>
          <td>
            {{$degree_name}}
          </td>
          <td>
            {{$course_name}}
          </td>
          <td>
            <p class="mb-0 text-muted"><small>{{$created_date}}</small></p>
          </td>
          <td>
            <a href="{{route('admin.editinstructor') .'/'. $instructor->id}}" class="btn btn-xs btn-success" data-toggle="tooltip"  title="Edit"><i class="mdi mdi-pencil"></i></a>
            <a data-value ="{{$instructor->id}}" class="btn btn-xs btn-danger delete_instructor"><i class="mdi mdi-trash-can"></i></a>
          </td>
        </tr>
        <?php 
         }else{
           ?>
            <tr>
              <td style="width: 36px;" rowspan="1">
                <img src="{{$image}}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
              </td>
              <td rowspan="{{$count}}">
                <h5 class="m-0 font-weight-normal">{{$instructor->first_name}} {{$instructor->last_name}}</h5>
              </td>
              <td>
                ----
              </td>
              <td>
               ----
              </td>
              <td>
                ----
              </td>
              <td>
                <p class="mb-0 text-muted"><small>----</small></p>
              </td>
              <td>
                <a href="{{route('admin.editinstructor') .'/'. $instructor->id}}" class="btn btn-xs btn-success" data-toggle="tooltip"  title="Edit"><i class="mdi mdi-pencil"></i></a>
                <a data-value ="{{$instructor->id}}" class="btn btn-xs btn-danger delete_instructor"><i class="mdi mdi-trash-can"></i></a>
              </td>
            </tr>
          <?php
         }?>

         <?php 

         $courses_data1 = DB::table('courses')->where('instructor_id',$instructor->id)->where('course_id', '!=', $course_id)->get();
         foreach ($courses_data1 as $key => $Data) {
          $degree1 = DB::table('degrees')->where('id',$Data->degree_id)->pluck('degree_name');
              if(isset($degree1[0]) && !empty($degree1)){

                $degree_name1 = $degree1[0];
              }else{
                $degree_name1 = '';
              }
          $university1 = DB::table('universities')->where('id',$Data->university_id)->pluck('university_name');
              if(isset($university1[0]) && !empty($university1)){
                $university_name1 = $university1[0];
              }else{
                $university_name1 = '';
              }

              $created_at1 = strtotime($Data->created_at);
              $created_date1 = date('Y.M.d',$created_at1);
         ?>
                    <tr>
                      <td>
                      {{$university_name1}}
                      </td>
                      <td>
                        {{$degree_name1}}
                      </td>
                      <td>
                        {{$Data->course_name}}
                      </td> 
                      <td>
                        <p class="mb-0 text-muted"><small>{{$created_date1}}</small></p>
                      </td>
                      <td>
                        
                      </td>
                    </tr>
                  <?php }?>
              <!-- <tr>
              <td>
                אוניברסיטת וארטון
              </td>
              <td>
                 B.Tech במדעי המחשב
              </td>
              <td>
                Introduction to statistics
              </td>
              <td>
                <p class="mb-0 text-muted"><small>26Dec 2020 at 7:12 am</small></p>
              </td>
              <td>
                <a href="edituser.php" class="btn btn-xs btn-success" data-toggle="tooltip"  title="Edit"><i class="mdi mdi-pencil"></i></a>
                               
                <a href="#myDeleteModal"  data-toggle="modal" class="btn btn-xs btn-danger"><i class="mdi mdi-trash-can"></i></a>
              </td>
            </tr> -->
          <?php } }?>
         <!--  <tr>
            <td style="width: 36px;">
              <img src="{{$image}}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
            </td>
            <td>
              <h5 class="m-0 font-weight-normal">דייויד ג'ונס</h5>
              </td>
              <td>
                אוניברסיטת וארטון
              </td>
              <td>
                B.Tech במדעי המחשב
              </td>
             <td>
              Inferior statistics
              </td>
              <td>
                <p class="mb-0 text-muted"><small>24Dec 2020 at 11:17 am</small></p>
              </td>
              <td>
                <a href="edituser.php" class="btn btn-xs btn-success" data-toggle="tooltip"  title="Edit"><i class="mdi mdi-pencil"></i></a>
                <a href="#myDeleteModal"  data-toggle="modal" class="btn btn-xs btn-danger"><i class="mdi mdi-trash-can"></i></a>
              </td>
            </tr> -->
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
<div id="Deleteinstructor" class="renewalproduct modal fade" style="direction: rtl;">
  <input type="hidden" name="inst_id" id ="inst_id" value="">
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
        $('.delete_instructor').click(function(){
                var id = $(this).attr('data-value');
                $('#inst_id').val(id);
                $('#Deleteinstructor').modal('show');

            });
        $("#confirmpassword").click(function(e) {
                e.preventDefault();
                var password = $('#getpassword').val();
                var deleted_id = $('#inst_id').val();
                $.ajax({
                    url: '{{ route("admin.deleteinstructor") }}',
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
        