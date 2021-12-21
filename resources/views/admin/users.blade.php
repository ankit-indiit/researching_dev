@extends('admin.layouts.app')
@section('title', ' משתמשים ')
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
                <li class="breadcrumb-item active">משתמשים</li>
              </ol>
            </div>
            <h4 class="page-title">משתמשים</h4>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">
          <div class="card-box recentuser">
            <div class="row" style="direction:rtl">
              <div class="col-md-6  text-right">
                <h4 class="header-title mb-3">כל המשתמשים </h4>
              </div>
              <div class="col-md-6 text-left">
                <a href="{{route('admin.adduser')}}" class="btn btn-primary  mb-3">הוסף משתמש</a>
              </div>
            </div>
            <div class="table-responsive">
              <table id="basic-datatable1"  class="table table-borderless table-hover table-nowrap table-centered m-0  datatable-table">
                <thead class="thead-light datatable-head">
                  <tr class="datatable-row">
                    <th>מספר <br>מזהה</th>
                    <th colspan="2">תמונה</th>
                    <th>כתובת דוא"ל</th>
                    <th>מכשיר טלפון</th>
                    <th>תואר סטודנטים</th>
                    <th>מוסד אקדמי</th>
                    <th>סטָטוּס</th>
                    <th>סיבת האיסור</th>
                    <th>פעולה</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $degree_name ='';
                  $university_name='';
                  $created_at = '';
                  foreach ($users_data as $index => $user_data) {
                    $image =  asset('/assets/users/' .$user_data->avatar);
                    if($user_data->student_degree != '' || $user_data->student_degree != NULL){
                        $degree = DB::table('degrees')->where('id',$user_data->student_degree)->pluck('degree_name');
                        foreach ($degree as $key => $value) {
                          $degree_name = $value;
                        }
                        
                    }else{
                        $degree_name = '';
                    }
                    if($user_data->academic_institution != '' || $user_data->academic_institution != NULL){
                         $university = DB::table('universities')->where('id',$user_data->academic_institution)->pluck('university_name');
                          foreach ($university as $key => $value) {
                          $university_name = $value;
                        }
                    }else{
                        $university_name = '';
                    }

                    if($user_data->created_at != NULL){
                    $created_at = $user_data->created_at;
                    $created_at = $created_at->format('H:i , d.m.Y');
                  }else{
                    $created_at = '';
                  }
                   
                  ?>
                  
                  <tr>
                    <td class="number"> {{$index +1}}</td>
                    <td style="width: 36px;"> 
                      <img src="{{ $image }}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                    </td>
                    <td>
                      <h5 class="m-0 font-weight-normal">{{$user_data->first_name}}</h5>
                      <p class="mb-0 text-muted"><small>{{$created_at}}</small></p>
                    </td>
                    <td>{{$user_data->email}}</td>
                    <td>{{$user_data->contact_number}}</td>
                    <td>{{$degree_name}}  </td>
                    <td> {{$university_name}}</td> 
                    <td>
                      <?php
                      $status_class = ' badge-success';
                      $status_label = ' רגיל  ';
                      if($user_data->status == 0){
                        $status_class = '  badge-danger';
                        $status_label = ' הוסר ';
                      }elseif($user_data->status == 1){
                        $status_class = ' badge-success';
                        $status_label = ' רגיל  ';
                      }else{
                        $status_class = ' badge-warning';
                        $status_label = ' חסום ';
                      }
                      ?>
                      <input type="hidden" name="users_status" id = "users_status" value='{{$user_data->status}}'>
                      <input type="hidden" name="user_id" class ="user_id" value="">
                      <div class="dropdown ">
                        <label class="badge {{$status_class}} dropdown-toggle" data-toggle="dropdown"> {{$status_label}}<span class="fa fa-angle-down  mr-1"></span></label>
                            <ul class="dropdown-menu user_status">
                              <li data-id = "{{$user_data->id}}" data-value="2"><a  class="dropdown-item"> חסום </a></li>
                              <li data-id = "{{$user_data->id}}" data-value="1"><a  class="dropdown-item"> רגיל </a></li>
                              <li data-id = "{{$user_data->id}}" data-value="0"><a  class="dropdown-item"> הוסר </a></li>
                              </ul>
                              </div>
                    </td>
                    <td>  לורם איפסום הוא פשוט טקסט דמה    </td>
                    <td class="table-flex">
                      <input type="hidden" name="userid" id = "userid" value="{{$user_data->id}}">
                      
                      <a href ="{{route('admin.edituser').'/'.$user_data->id}}" class="btn btn-xs btn-success edituser" data-toggle="tooltip"  title="Edit"><i class="mdi mdi-pencil"></i></a>
                      <a href="{{route('admin.userlogs').'/'.$user_data->id}}" class="btn btn-xs btn-primary" data-toggle="tooltip"  title="Logs"><i class="mdi mdi-history"></i></a>
                      <a href="{{route('admin.add_comment').'/'.$user_data->id}}" class="btn btn-xs btn-primary" data-toggle="tooltip"  title="add comment"><i class="mdi mdi-comment"></i></i></a>
                       <!--<a href ="#" class="btn btn-primary float-left mr-1 addcourses ml-0" data-toggle="tooltip"  title="Add"><i class="fa fa-plus"></i></a>-->
                    </td>
                  </tr>
                <?php }?>
                </tbody>
              </table>
            </div>
          </div>
        </div> 
      </div>
<div class="row">
  <div class="col-lg-12">
      <div class="card-box recentuser">
        <h4 class="header-title text-right mb-3">משתמשים אחרונים </h4>
        <ul class="nav nav-tabs justify-content-center "style="direction: rtl;">
          <li class="nav-item">
            <a href="#freeuser" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                                המשתמשים האחרונים (חינם)
            </a>
          </li>
          <li class="nav-item">
            <a href="#paiduser" data-toggle="tab" aria-expanded="false" class="nav-link ">
                                                  המשתמשים האחרונים (בתשלום)
            </a>
          </li>  
        </ul>
        <div class="tab-content">
          <div class="tab-pane show active" id="freeuser">
            <div class="table-responsive">
              <table id="basic-datatable1"  class="table table-borderless table-hover table-nowrap table-centered m-0">
                <thead class="thead-light">
                  <tr>
                    <th>מספר מזהה</th>
                    <th colspan="2">תמונה</th>
                    <th>כתובת דוא"ל</th>
                    <th>מכשיר טלפון</th>
                    <th>תואר סטודנטים</th>
                    <th>מוסד אקדמי</th>
                    <th>הירשם לניוזלטר</th>
                    <th>עמוד אחרון</th>
                    <th>פעולה</th>
                  </tr>
                </thead>
              <tbody>
                <?php
                $degree_name ='';
                  $university_name='';
                  $created_at = '';
                if(!empty($free_users_data)){
                  foreach ($free_users_data as $index => $free_user) {
                    $image =  asset('/assets/users/' .$free_user->avatar);
                    if($free_user->student_degree != '' || $free_user->student_degree != NULL){
                        $degree = DB::table('degrees')->where('id',$user_data->student_degree)->pluck('degree_name');
                        foreach ($degree as $key => $value) {
                          $degree_name = $value;
                        }
                        
                    }else{
                        $degree_name = '';
                    }
                    if($free_user->academic_institution != '' || $free_user->academic_institution != NULL){
                         $university = DB::table('universities')->where('id',$free_user->academic_institution)->pluck('university_name');
                         foreach ($university as $key => $value) {
                          $university_name = $value;
                        }          
                        
                    }else{
                        $university_name = '';
                    }
                    if($user_data->created_at != NULL){
                    $created_at = $free_user->created_at;
                    $created_at = $created_at->format('H:i , d.m.Y');
                  }else{
                    $created_at = '';
                   }
                  ?>
                  
            <tr>
              <td>
               {{$index+1}}                                     
              </td>
              <td style="width: 36px;">
                <img src="{{$image}}"alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
              </td>
              <td>
                <h5 class="m-0 font-weight-normal">{{$free_user->first_name}}</h5>
                <p class="mb-0 text-muted"><small>{{$created_at}}</small></p>
              </td>
              <td>{{$free_user->email}}</td>      
              <td>{{$free_user->contact_number}}</td>         
              <td>{{$degree_name}}</td>                    
              <td>{{$university_name}}<td>
              <span class="badge badge-success text-white"> V </span>
            </td>
            <td>
                                                     עֲגָלָה
            </td>
            <td>
              <input type="hidden" name="userid" id = "userid" value="{{$free_user->id}}">
              <a href ="{{route('admin.edituser').'/'.$free_user->id}}" class="btn btn-xs btn-success edituser" data-toggle="tooltip"  title="Edit"><i class="mdi mdi-pencil"></i></a>
             
            </td>
          </tr>                                      
        <?php }}?>
      </tbody>
    </table>
  </div>
</div>
  <div class="tab-pane " id="paiduser"> <div class="table-responsive">
    <table id="basic-datatable2"  class="table table-borderless table-hover table-nowrap table-centered m-0">
      <thead class="thead-light">
        <tr>
          <th>מספר מזהה</th>
          <th colspan="2">תמונה</th>
          <th>כתובת דוא"ל</th>
          <th>מכשיר טלפון</th>
          <th>תואר סטודנטים</th>
          <th>מוסד אקדמי</th>
          <th>קורסים שנרכשו</th>
          <th>פעולה</th>
        </tr>
        </thead>
          <tbody>
            <?php
            $degree_name ='';
                  $university_name='';
                  $created_at = '';
            if($paid_users_data){
          foreach ($paid_users_data as $index => $paid_user) {
            $image =  asset('/assets/users/' .$paid_user->avatar);
            if($paid_user->student_degree != '' || $paid_user->student_degree != NULL){
              $degree = DB::table('degrees')->where('id',$user_data->student_degree)->pluck('degree_name');
               foreach ($degree as $key => $value) {
                          $degree_name = $value;
                        }
            }else{
              $degree_name = '';
            }
            if($paid_user->academic_institution != '' || $paid_user->academic_institution != NULL){
              $university = DB::table('universities')->where('id',$paid_user->academic_institution)->pluck('university_name');
              foreach ($university as $key => $value) {
                          $university_name = $value;
                        }
            }else{
              $university_name = '';
            }
            if($user_data->created_at != NULL){
            $created_at = $paid_user->created_at;
            $created_at = $created_at->format('H:i , d.m.Y');
          }else{
            $created_at = '';
          }
          ?>
            <tr>
              <td>{{$index+1}}</td>
              <td style="width: 36px;">
                <img src="{{ $image }}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
              </td>
              <td>
                <h5 class="m-0 font-weight-normal">{{$paid_user->first_name}}</h5>
                <p class="mb-0 text-muted"><small>{{$created_at}}</small></p>
              </td>
              <td>{{$paid_user->email}}</td>
              <td>{{$paid_user->contact_number}}</td>
              <td>{{$degree_name}}</td>
              <td>{{$university_name}}</td>
              <td>    עיצוב גרפי
              </td>
              <td>
                <input type="hidden" name="userid" id = "userid" value="{{$paid_user->id}}">
                <a href ="{{route('admin.edituser').'/'.$paid_user->id}}" class="btn btn-xs btn-success edituser" data-toggle="tooltip"  title="Edit"><i class="mdi mdi-pencil"></i></a>  
              </td>
            </tr>
          <?php }}?>

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
</div>
</div>
<div id="statusModal" class="deletemodal modal fade">
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
                <p>
                  האם אתה באמת רוצה לשנות סטטוס? לא ניתן לבטל את התהליך הזה.
                </p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">לְבַטֵל</button>
                <button  type="button" class="btn btn-danger updatestatus ">לִמְחוֹק</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $(".user_status").on("click", "li", function(e){
    e.preventDefault();
    var status = $(this).attr('data-value');
    var id = $(this).attr('data-id');
    $('.user_id').val(id);
    $('#users_status').val(status);
    console.log(status);
    if(status == '0' || status == '1' || status == '2'){
      $('#statusModal').modal('show');
    }
});
    $(".updatestatus").on("click", function(e){
    e.preventDefault();
    var toupdatestatus =  $('#users_status').val();
    var user_id = $('.user_id').val();
    $.ajax({
      url: '{{ route("admin.updatestatus") }}',
      type: 'POST',
      dataType: 'json',
      data: {
        user_id: user_id,
        status:toupdatestatus

      },
      success: function (response) {
        if(response.data.status == 1){
          window.location.reload();
        }else{
          alert(' סטטוס לא עודכן ');
        }
        
        }
        });
});
  });
</script>
@endsection