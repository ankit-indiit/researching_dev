@extends('admin.layouts.app')

@section('title', ' ניהול אפליקציות ')
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
                <li class="breadcrumb-item active">ניהול יישומים</li>
              </ol>
            </div>
            <h4 class="page-title">ניהול יישומים</h4>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">
          <div class="card-box applicationmanage">
            <div class="row" style="direction:rtl">
              <div class="col-md-6 text-right">
                <h4 class="header-title mb-3 text-right">ניהול יישומים</h4>
              </div>
              <div class="col-md-6 text-left">
                <a href="{{route('admin.addapplication')}}" class="btn btn-primary  mb-3"><i class="fa fa-plus"></i></a>
              </div>
            </div>
            <div class="table-responsive ">
              <table id="basic-datatable1"  class="table table-borderless table-hover table-nowrap table-centered m-0">
                <thead class="thead-light">
                  <tr>
                    <th>מתַאֲרִיך</th>
                    <th colspan="2">תמונה</th>
                    <th>כתובת דוא"ל</th>
                    <th>מכשיר טלפון</th>
                    <th>תואר סטודנטים</th>
                    <th>מוסד אקדמי</th>
                    <th>נושא</th>
                    <th>שם מנהל</th>
                    <th>סטָטוּס</th>
                    <th>פעולה</th>
                  </tr>
                </thead>
              <tbody>
                <?php 
                foreach ($chats as $key => $chat) {
                  $created_at = $chat->created_at;            
                  $date = $created_at->format('d.m.y');
                  if($chat->user_id != 0){
                    $user_id = $chat->user_id;
                    $user_info = DB::table('users')->where('id',$user_id)->get();
                    foreach ($user_info as $value) {
                      $image = asset('/assets/users/' .$value->avatar);
                      $name = $value->first_name;
                      $user_createdat = $value->created_at;
                      $date =strtotime($user_createdat); 
                      $user_date = date('d.m.y', $date);  
                      $user_time = date('h:i',$date);
                      $university = DB::table('universities')->where('id',$value->academic_institution)->pluck('university_name');
                      $degree = DB::table('degrees')->where('id',$value->student_degree)->pluck('degree_name');
                      $contact_no = $value->contact_number;
                      if($contact_no != ''){
                        $contact_no = $contact_no;
                      }else{
                        $contact_no = '';
                      }
                      if(!empty($university) && count($university) != 0){
                        $university_name = $university[0];
                      }else{
                        $university_name = '';
                      }
                      if(!empty($degree) && count($university) != 0){
                        $degree_name = $degree[0];
                      }else{
                        $degree_name = '';
                      }
                      $user_email = '';
                    }
                  }else{
                    $image = '';
                    $name = '';
                    $user_date = '';
                    $user_time = '';
                    $user_email = $chat->email;
                    $university_name= '';
                    $degree_name = '';
                    $contact_no = '';
                  }
                ?>
                <tr>
                  <td><span class="badge badge-secondary text-white">{{$date}} </span></td>
                  <td style="width: 36px;"> 
                    <?php if($image != ''){?>
                    <img src="{{ $image }}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                    <?php }else{
                        echo $image;
                      }?>
                  </td>
                  <td>
                    <?php if($name != '' && $user_date != '' && $user_time != ''){?>
                    <h5 class="m-0 font-weight-normal">{{$name}}</h5>
                    <p class="mb-0 text-muted"><small> at 9:00 am</small></p>
                    <?php }else{
                        echo $name;
                      }?>
                  </td>
                  <td>
                     {{$user_email}}                                 
                  </td>
                  <td>
                    {{$contact_no}}                                 
                  </td>
                  <td>
                    {{$degree_name}}
                  </td>
                  <td>{{$university_name}}</td>
                 <td>
                    {{$chat->title}}
                  </td> 
                  <td>
                    <?php 
                    $instructors = DB::table('instructors')->get();
                                        ?>
                    <input type="hidden" name= "update_instchat_id" class="update_instchat_id" value="{{$chat->id}}">
                    <select class="table-select choose_manager" id =""> 
                      <option value =''>בחר שם</option>
                      @foreach($instructors as $instructor)
                      <option value="{{$instructor->id}}" {{$chat->manager_id == $instructor->id  ? 'selected' : ''}}>{{$instructor->first_name}}</option>
                      @endforeach
                    </select>
                  </td>
                <td>
                  <?php
                      $status_class = ' badge-primary';
                      $status_label = ' לִפְתוֹחַ ';
                      if($chat->status == 0){
                        $status_class = '  badge-primary';
                        $status_label = ' לִפְתוֹחַ ';
                      }elseif($chat->status == 1){
                        $status_class = ' badge-warning';
                        $status_label = ' בטיפול  ';
                      }elseif($chat->status == 2){
                        $status_class = ' badge-success';
                        $status_label = ' בוצע  ';
                      }else{
                        $status_class = ' badge-danger';
                        $status_label = ' חא רלוונטי ';
                      }
                      ?>
                      <input type="hidden" name="chats_status" class="chats_status" value='{{$chat->status}}'>
                      <input type="hidden" name="chat_id" class ="chat_id" value="">
                      <div class="dropdown ">
                        <label class="badge {{$status_class}} dropdown-toggle" data-toggle="dropdown"> {{$status_label}}<span class="fa fa-angle-down  mr-1"></span></label>
                            <ul class="dropdown-menu chat_status">
                              <li data-id = "{{$chat->id}}" data-value="0"><a  class="dropdown-item"> 
                                פְתוֹחַ 
                              </a></li>
                              <li data-id = "{{$chat->id}}" data-value="1"><a  class="dropdown-item">  בטיפול     </a></li>
                              <li data-id = "{{$chat->id}}" data-value="2"><a  class="dropdown-item">  בוצע    </a></li>
                              <li data-id = "{{$chat->id}}" data-value="3"><a  class="dropdown-item"> לא רלוונטי     </a></li>
                              </ul>
                              </div>
                </td>
                <td>
                  <a href="{{route('admin.viewapplication').'/'.$chat->id}}" class="btn btn-xs btn-info" data-toggle="tooltip"  title="צפה בפרטים"><i class="mdi mdi-eye"></i></a>
                  <a data-value ="{{$chat->id}}" class="btn btn-xs btn-danger delete_chat"><i class="mdi mdi-trash-can"></i></a>
                </td>
              </tr>
            <?php }?>
            </tbody>
          </table>
        </div>
      </div>
    </div> 
  </div>
  <?php $count = 0;
  if(count($archive_chats) > $count){?> 
  <div class="row">
    <div class="col-lg-12">
      <div class="card-box recentuser">
        <h4 class="header-title mb-3 text-right">ארכיון</h4>
          <div class="table-responsive">
              <table id="basic-datatable"  class="table table-borderless table-hover table-nowrap table-centered m-0">
                <thead class="thead-light">
                  <tr>
                    <th>מתַאֲרִיך</th>
                    <th colspan="2">תמונה</th>
                    <th>כתובת דוא"ל</th>
                    <th>מכשיר טלפון</th>
                    <th>תואר סטודנטים</th>
                    <th>מוסד אקדמי</th>
                    <th>נושא</th>
                    <th>שם מנהל</th>
                    <th>סטָטוּס</th>
                    <th>פעולה</th>
                  </tr>
                </thead>
              <tbody>
                <?php 
                foreach ($archive_chats as $key => $chat) {
                  $created_at = $chat->created_at;            
                  $date = $created_at->format('d.m.y');
                  $manager_id = $chat->manager_id;
                  if($manager_id != null){
                  $manager = DB::table('instructors')->where('id',$manager_id)->pluck('first_name');

                  if(count($manager) > 0){
                        $manager_name = $manager[0];
                      }else{
                        $manager_name = '';
                      }
                  }else{
                    $manager_name = '';
                  }
                  if($chat->user_id != 0){
                    $user_id = $chat->user_id;
                    $user_info = DB::table('users')->where('id',$user_id)->get();
                    foreach ($user_info as $value) {
                      $image = asset('/assets/users/' .$value->avatar);
                      $name = $value->first_name;
                      $user_createdat = $value->created_at;
                      $date =strtotime($user_createdat); 
                      $user_date = date('d.m.y', $date);  
                      $user_time = date('h:i',$date);
                      $university = DB::table('universities')->where('id',$value->academic_institution)->pluck('university_name');
                      $degree = DB::table('degrees')->where('id',$value->student_degree)->pluck('degree_name');
                      $contact_no = $value->contact_number;
                      if($contact_no != ''){
                        $contact_no = $contact_no;
                      }else{
                        $contact_no = '';
                      }
                      if(!empty($university)){
                        $university_name = $university[0];
                      }else{
                        $university_name = '';
                      }
                      if(!empty($degree)){
                        $degree_name = $degree[0];
                      }else{
                        $degree_name = '';
                      }
                      $user_email = '';
                    }
                  }else{
                    $image = '';
                    $name = '';
                    $user_date = '';
                    $user_time = '';
                    $user_email = $chat->email;
                    $university_name= '';
                    $degree_name = '';
                    $contact_no = '';
                  }
                ?>
                <tr>
                  <td><span class="badge badge-secondary text-white">{{$date}} </span></td>
                  <td style="width: 36px;"> 
                    <?php if($image != ''){?>
                    <img src="{{ $image }}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                    <?php }else{
                        echo $image;
                      }?>
                  </td>
                  <td>
                    <?php if($name != '' && $user_date != '' && $user_time != ''){?>
                    <h5 class="m-0 font-weight-normal">{{$name}}</h5>
                    <p class="mb-0 text-muted"><small> at 9:00 am</small></p>
                    <?php }else{
                        echo $name;
                      }?>
                  </td>
                  <td>
                     {{$user_email}}                                 
                  </td>
                  <td>
                    {{$contact_no}}                                 
                  </td>
                  <td>
                    {{$degree_name}}
                  </td>
                  <td>{{$university_name}}</td>
                 <td>
                    {{$chat->title}}
                  </td> 
                  <td>
                    {{$manager_name}}
                  </td>
                <td>
                  <?php
                      $status_class = ' badge-primary';
                      $status_label = ' לִפְתוֹחַ ';
                      if($chat->status == 0){
                        $status_class = '  badge-primary';
                        $status_label = ' לִפְתוֹחַ ';
                      }elseif($chat->status == 1){
                        $status_class = ' badge-warning';
                        $status_label = ' בטיפול  ';
                      }elseif($chat->status == 2){
                        $status_class = ' badge-success';
                        $status_label = ' בוצע  ';
                      }else{
                        $status_class = ' badge-danger';
                        $status_label = ' חא רלוונטי ';
                      }
                      ?>
                      <input type="hidden" name="chats_status" class = "chats_status" value='{{$chat->status}}'>
                      <input type="hidden" name="chat_id" class ="chat_id" value="">
                      <div class="dropdown ">
                        <label class="badge {{$status_class}} dropdown-toggle" data-toggle="dropdown"> {{$status_label}}</label>
                            
                              </div>
                </td>
                <td>
                    <a href="{{route('admin.viewapplication').'/'.$chat->id}}" class="btn btn-xs btn-info" data-toggle="tooltip"  title="צפה בפרטים"><i class="mdi mdi-eye"></i></a>
                    <a data-value = "{{$chat->id}}" class="btn btn-xs btn-primary revert_chat"><i class="fa fa-undo"></i></a>
                    <a data-value ="{{$chat->id}}" class="btn btn-xs btn-danger delete_chat"><i class="mdi mdi-trash-can"></i></a>
                  </td>
                <td> 
                  
                </td>
              </tr>
            <?php }?>
            </tbody>
          </table>
        </div>
        </div>
      </div> 
    </div>
  <?php }?>
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
<div id="chatdelete" class="deletemodal modal fade">
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
<div id="revertmodal" class="deletemodal statusmodal modal fade">
  <input type="hidden" name="reverted_id" id ="reverted_id" value="">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header flex-column">
        <div class="icon-box">
          <i class="fas fa-undo"></i>
        </div>            
        <h4 class="modal-title w-100">האם אתה בטוח?</h4>  
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      
      <div class="modal-footer justify-content-center">
        <button type="button"  class="btn btn-secondary" data-dismiss="modal">לא</button>
        <button type="button" id="revert_btn" class="btn btn-primary">כן</button>
      </div>
    </div>
  </div>
</div>  
 @endsection       
@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $(".chat_status").on("click", "li", function(e){
    e.preventDefault();
    var status = $(this).attr('data-value');
    var id = $(this).attr('data-id');
    $('.chat_id').val(id);
    $('.chats_status').val(status);
    console.log(status);
    if(status == '0' || status == '1' || status == '2' || status == '3'){
      $('#statusModal').modal('show');
    }
});
    $(".updatestatus").on("click", function(e){
    e.preventDefault();
    var toupdatestatus =  $('.chats_status').val();
    var chat_id = $('.chat_id').val();
    $.ajax({
      url: '{{ route("admin.updateappstatus") }}',
      type: 'POST',
      dataType: 'json',
      data: {
        chat_id: chat_id,
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
    $('.choose_manager').change(function(){
      var instructor_id = $(this).val();
      var chat_id = $('.update_instchat_id').val();
      $.ajax({
        url: '{{ route("admin.update_manager") }}',
        type: 'POST',
        data: {
            instructor_id: instructor_id,
            chat_id:chat_id
        },
        success: function(data) {
          if(response.data.status == 1){
      window.location.reload();
    }else{
      alert(' סטטוס לא עודכן ');
    }
          }
      });
    });
    $('.delete_chat').click(function(){
      var id = $(this).attr('data-value');
      $('#deleted_id').val(id);
      $('#chatdelete').modal('show');

    });
    $("#delete_data").click(function(e) {
      e.preventDefault();
      var deleted_id = $('#deleted_id').val();
      $.ajax({
          url: '{{ route("admin.deletechat") }}',
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

    $('.revert_chat').click(function(){
      var id = $(this).attr('data-value');
      $('#reverted_id').val(id);
      $('#revertmodal').modal('show');

    });
    $("#revert_btn").click(function(e) {
      e.preventDefault();
      var reverted_id = $('#reverted_id').val();
      $.ajax({
          url: '{{ route("admin.revertchat") }}',
          type: 'POST',
          dataType: 'json',
              data: {
              reverted_id:reverted_id
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
       
  