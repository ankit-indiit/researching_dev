@extends('admin.layouts.app')

@section('title', ' פרט-ניהול אפליקציות ')
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
                                <li class="breadcrumb-item"><a href="{{route('admin.application')}}">ניהול יישומים</a></li>
                                <li class="breadcrumb-item active">פרטי ניהול יישומים</li>
                            </ol>
                        </div>
                        <h4 class="page-title">פרטי ניהול יישומים</h4>
                    </div>
                </div>
            </div>     
    <!-- end page title --> 
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="direction:rtl">
                        <div class="col-md-6 text-right">
                            <h4 class="header-title mb-3">פרטי ניהול יישומים</h4>
                        </div>
                        <div class="col-md-6 text-left">
                            <a href="{{route('admin.application')}}" class="btn btn-primary  mb-3">חזרה לניהול יישומים</a>
                        </div>
                    </div>
                <?php 
                    if($users_data != ''){
                        foreach ($users_data as $value) {
                            $image =  asset('/assets/users/' .$value->avatar);
                            $name = $value->first_name;
                            $contact_no = $value->contact_number;
                            $email = $value->email;
                            $university = DB::table('universities')->where('id',$value->academic_institution)->pluck('university_name');
                            $degree = DB::table('degrees')->where('id',$value->student_degree)->pluck('degree_name');
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
                        }   
                    }else{
                        $image =  asset('/assets/users/default.jpg');
                        $email = $chat->email;
                        $name = "";
                        $contact_no = '';
                        $university_name = '';
                        $degree_name = '';
                    }
                ?>
                <div class="row">
                    <div class="col-lg-4">
                        <div class=" profile_user">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="user-image "> 
                                        <img class="rounded-circle img-thumbnail" src="{{ $image }}">
                                        <h5><b>דייויד סמית '</b></h5>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div> 
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>כותרת</label>
                                    <p>{{$chat->title}}</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>תוכן היישום</label>
                                        <p>{{$chat->body}}</p>
                                </div>
                            </div>
                <div class="col-md-12">
                    <form method="POST" id = "add_chat_summary" enctype="multipart/form-data">
                                @csrf() 
                    <div class="row ">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>הערות</label>
                                <textarea  name="remarks" id="remarks" class="form-control" rows="4" placeholder="הערות">{{$chat->remarks}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>סיכום</label>
                                <textarea name="summary" id="summary"  class="form-control" rows="4" placeholder="סיכום">{{$chat->summary}}</textarea>
                            </div>
                        </div>
                    </div>  
                        <input type ="hidden" name ="chat_id" id="chat_id" value="{{$chat->id}}">
                        <div class="col-md-12 text-right">
                            <button type="submit" id="add_cht_btn" class="btn btn-primary waves-effect waves-light"><i class="fe-check-circle mr-1"></i> 
                              שמור שינויים   
                            </button>
                            <button type="button" id="reset_app" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i>
                              ביטול
                            </button>
                        </div>
                    </form>
                </div>
                    <div class="col-md-12 mt-3">
                        <h4 class="headsub">מידע משתמש</h4>
                    </div>
                    @if($name != '')
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>שֵׁם</label>
                                <p>{{$name}}</p>
                            </div>
                        </div>
                    @endif
                    @if($email != '')
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>כתובת דוא"ל</label>
                                <p>{{$email}}</p>
                            </div>
                        </div>
                    @endif
                    @if($contact_no != '')
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>מכשיר טלפון</label>
                                <p>{{$contact_no}}</p>
                            </div>
                        </div>
                    @endif
                    @if($degree_name != '')
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>תוֹאַר </label>
                                <p>{{$degree_name}}</p>
                            </div>
                        </div>
                    @endif 
                    @if($university_name != '')
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>מוֹסָד</label>
                                    <p>{{$university_name}}</p>
                                </div>
                            </div>
                    @endif
                </div>
            </div>
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>
</div> 
<div class="col-lg-12">
    <div class="card-box applicationmanage">
        <h4 class="header-title mb-3 text-right">יישומים קודמים</h4>
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
                foreach ($previous_chats as $key => $chat) {
                  $created_at = $chat->created_at;            
                  $date = $created_at->format('d.m.y');
                  $manager_id = $chat->manager_id;
                  $manager = DB::table('instructors')->where('id',$manager_id)->pluck('first_name');
                  if(count($manager) > 0){
                        $manager_name = $manager[0];
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
                      <input type="hidden" name="chats_status" id = "chats_status" value='{{$chat->status}}'>
                      <input type="hidden" name="chat_id" class ="chat_id" value="">
                      <div class="dropdown ">
                        <label class="badge {{$status_class}} dropdown-toggle" data-toggle="dropdown"> {{$status_label}}</label>
                    </div>
                </td>
                <td>
                  <a href="{{route('admin.viewapplication').'/'.$chat->id}}" class="btn btn-xs btn-info" data-toggle="tooltip"  title="צפה בפרטים"><i class="mdi mdi-eye"></i></a>
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
@endsection
@section('scripts')
<script type="text/javascript">
  $('#reset_app').click(function(){
       window.location.href = '{{route("admin.application")}}';
     });
    $("#add_cht_btn").click(function(e) {
           e.preventDefault();
           var fd = new FormData();
            // Check file selected or not
           $.ajax({
             url: '{{ route("admin.savesummary") }}',
             type: 'POST',
               data:new FormData($("#add_chat_summary")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
             success: function(data) {
                   if ($.isEmptyObject(data.error)) {
                    window.location.href = '{{route("admin.application")}}';
                } else {
                    printErrorMsg(data.error);
                }
               }
           });
         
   
         });
     function printErrorMsg (msg) {
          $.each( msg, function( key, value ) {
              $('.'+key+'_err').text(value);
            });
        }
</script>
@endsection