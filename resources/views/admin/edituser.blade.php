@extends('admin.layouts.app')
@section('title', ' ערוך משתמש ')
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
                        <li class="breadcrumb-item"><a href="{{route('admin.userslisting')}}">משתמשים</a></li>
                        <li class="breadcrumb-item active">ערוך משתמש</li>
                     </ol>
                  </div>
                  <h4 class="page-title">ערוך משתמש</h4>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-body">
                     <div class="row" style="direction:rtl">
                        <div class="col-md-6 text-right">
                           <h4 class="header-title mb-3">ערוך משתמש </h4>
                        </div>
                        <div class="col-md-6 text-left">
                           <a href="{{route('admin.userslisting')}}" class="btn btn-primary  mb-3">בחזרה למשתמשים</a>
                        </div>
                        <span class="text-info error-text mail_success"></span>
                  <span class="text-error error-text mail_error"></span>
                     </div>
                     <form method="POST" id="edituser_form" action = "" enctype="multipart/form-data">
                        @csrf()
                        <input type="hidden" name="user_id" id ="user_id" value ="{{$user_data->id}}">
                        <div class="row">
                           <div class="col-lg-4">
                              <div class=" profile_user">
                                 <div class="card">
                                    <div class="card-body text-center">
                                       <div class="user-image ">
                                          <?php
                                             $university_data = DB::table('universities')->get();
                                             $image =  asset('/assets/users/' .$user_data->avatar);
                                             ?>
                                          <img class="rounded-circle img-thumbnail userPreview" src="{{ $image }}">
                                          <label for="user-img">העלאת תמונה</label>
                                          <input id="user-img" name="user_img" style="display:none" type="file">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-8">
                              <h4 class="headsub">מידע בסיסי</h4>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="user_name">שם פרטי</label>
                                       <input type="text" id="user_name" name ="user_name" class="form-control" placeholder="הכנס את שמך הפרטי" value="{{$user_data->first_name}}">
                                       <span class="text-danger error-text user_name_err"></span>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="user_lname">שם משפחה</label>
                                       <input type="text" id="user_lname" name ="user_lname" class="form-control" placeholder="הזן את Lname שלך" value="{{$user_data->last_name}}">
                                       <span class="text-danger error-text user_lname_err"></span>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="user_email">כתובת דוא"ל</label>
                                       <input type="email" id="user_email" name ="user_email" class="form-control" placeholder="הזן את כתובת הדוא"ל שלך" value="{{$user_data->email}}">
                                       <span class="text-danger error-text user_email_err"></span>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="user_phone">מכשיר טלפון</label>
                                       <input type="text" id="user_phone" name ="user_phone" class="form-control" placeholder="הזן את מספר הטלפון שלך" value="{{$user_data->contact_number}}">
                                       <span class="text-danger error-text user_phone_err"></span>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="academic">מוֹסָד</label>
                                       <select id="user_university" name="user_university" type="text" class="form-control">
                                          <option >היכנס למוסד האקדמי שלך</option>
                                          @foreach($university_data as $university)
                                          <option value="{{ $university->id }}" {{$university->id == $user_data->academic_institution  ? 'selected' : ''}}>{{ $university->university_name }}</option> 
                                          @endforeach 
                                       </select>
                                       <span class="text-danger error-text user_university_err"></span>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <?php if((!empty($degree_id)) && (!empty($degree_name))){?>
                                       <input type="hidden" id="user_degree_id" value ="{{$degree_id}}">
                                       <input type="hidden" id="user_degree_name" value ="{{$degree_name}}">
                                       <?php }else{?>
                                       <input type="hidden" id="user_degree_id" value ="">
                                       <input type="hidden" id="user_degree_name" value ="">
                                       <?php }?>
                                       <label for="degree">תוֹאַר</label>
                                       <select id = "user_degree" name = "user_degree" data-placeholder="תוֹאַר " class="form-control" required="required"  >
                                          <option value="">וֹאַר </option>
                                       </select>
                                       <span class="text-danger error-text user_degree_err"></span>
                                    </div>
                                 </div>
                              </div>
                              <h4 class="headsub">
                                 פרופיל חברתי.
                              </h4>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="facebookurl">
                                       כתובת אתר בפייסבוק
                                       </label>
                                       <input type="text" name = "facebookurl" id="facebookurl" class="form-control" placeholder="הזן את כתובת האתר שלך לפרופיל בפייסבוק."  value="{{$user_data->facebook_url}}">
                                       <span class="text-danger error-text facebookurl_err"></span>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="linkedinurl">
                                       כתובת אתר של לינקדאין
                                       </label>
                                       <input type="text" name = "linkedinurl" id="linkedinurl" class="form-control" placeholder="הזן את כתובת האתר שלך ב- linkin." value="{{$user_data->linkedin_url}}">
                                       <span class="text-danger error-text linkedinurl_err"></span>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="twitterurl">
                                       כתובת אתר בטוויטר
                                       </label>
                                       <input type="text" name = "twitterurl" id="twitterurl" class="form-control" placeholder="הזן את כתובת ה- Twitter שלך." value="{{$user_data->twitter_url}}">
                                       <span class="text-danger error-text twitterurl_err"></span>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="youtubeurl">
                                       כתובת אתר של Youtube
                                       </label>
                                       <input type="text" name = "youtubeurl" id="youtubeurl" class="form-control" placeholder="הזן את כתובת האתר שלך ב- YouTube." value="{{$user_data->youtube_url}}">
                                       <span class="text-danger error-text youtubeurl_err"></span>
                                    </div>
                                 </div>
                              </div>
                              <div class="row mt-3">
                                 <div class="col-12 text-center">
                                    <input type="hidden" name="reset_email" id="reset_email" value="{{$user_data->email}}">
                                    <button type="button" id="resetpassword" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח קישור איפוס סיסמה</button>
                                    <button id = "edituserbtn" type="button" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> 
                                    שמור שינויים
                                    </button>
                                    <button id = "resetuser" type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> 
                                    לא לשמור שינויים
                                    </button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- end card-->
                     </form>
                  </div>
                  <!-- end col-->
               </div>
               <!-- end row-->
            </div>
            <div class="col-12">
               <div class="card">
                  <div class="card-body recentuser edituser">
                     <ul class="nav nav-tabs justify-content-center" style="direction: rtl;">
                        <li class="nav-item">
                           <a href="#currentproduct" data-toggle="tab" aria-expanded="true" class="nav-link active">
                           מוצרים נוכחיים
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#outdateproduct" data-toggle="tab" aria-expanded="false" class="nav-link ">
                           מוצרים בעבר
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#purchasehistory" data-toggle="tab" aria-expanded="false" class="nav-link ">
                           היסטוריית רכישות
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#applicationhistory" data-toggle="tab" aria-expanded="false" class="nav-link ">
                           היסטוריית פניות 
                           </a>
                        </li>
                     </ul>
   <div class="tab-content">
      <div class="tab-pane show active" id="currentproduct">
         <div class="table-responsive">
            <table id="" class=" basic-datatable  table table-borderless table-hover table-nowrap table-centered m-0">
               <thead class="thead-light">
                  <tr>
                     <th>מספר <br>מזהה</th>
                     <th>שם קורס</th>
                     <th>תוֹאַר</th>
                     <th>שם מוסד</th>
                     <th>סוג מוצר</th>
                     <th> Course Completion  </th>
                     <th> Recommendation Written  </th>
                     <th>סוג שנרכש</th>
                     <th>מחיר</th>
                     <th>פעולה</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  if(!empty($courses_list)){
                  foreach ($courses_list as $key => $course_list) {
                      $course_degree = $course_list->degree_id;
                      $degree = DB::table('degrees')->where('id',$course_degree)->pluck('degree_name');
                      $course_university = $course_list->university_id;
                      $university = DB::table('universities')->where('id',$course_university)->pluck('university_name');
                      $type = $course_list->course_type;
                      if($type == '0'){
                        $text = 'קורס מקוון';
                      }else{
                        $text = ' למידה אינטנסיבית  ';
                      }
                  ?>

                  <tr>
                     <td>{{$key+1}}</td>
                     <td>{{$course_list->course_name}}</td>
                     <td>{{$degree[0]}}</td>
                     <td>{{$university[0]}}</td>
                     <td><span class="badge badge-success text-white">{{$text}}</span> </td>
                     <td class="text-center"> 20%  </td>
                     <td class="text-center"> V </td>
                     <td>לפי משתמש</td>
                     <td>
                         ₪{{$course_list->price}}
                     </td>
                     <td>
                        <a href="#myDeleteModal"  data-toggle="modal" class="btn btn-xs btn-danger"><i class="mdi mdi-trash-can"></i></a>
                     </td>
                  </tr>
               <?php }}?>
                  <?php
                  if(!empty($packages_list)){
                  foreach ($packages_list as $key => $package_list) {
                      $course_degree = $package_list->degree_id;
                      $degree = DB::table('degrees')->where('id',$course_degree)->pluck('degree_name');
                      $course_university = $package_list->university_id;
                      $university = DB::table('universities')->where('id',$course_university)->pluck('university_name');
                      $type = $package_list->course_type;
                      if($type == '0'){
                        $text = 'קורס מקוון';
                      }else{
                        $text = ' למידה אינטנסיבית  ';
                      }
                  ?>
                  <tr>
                     <td>{{$key+1}}</td>
                     <td>{{$package_list->package_name}}</td>
                     <td>{{$degree[0]}}</td>
                     <td>{{$university[0]}}</td>
                     <td><span class="badge badge-success text-white">{{$text}}</span> </td>
                     <td class="text-center"> 20%  </td>
                     <td class="text-center"> V </td>
                     <td>לפי משתמש</td>
                     <td>
                         ₪{{$package_list->price}}
                     </td>
                     <td>
                        <a href="#myDeleteModal"  data-toggle="modal" class="btn btn-xs btn-danger"><i class="mdi mdi-trash-can"></i></a>
                     </td>
                  </tr>
               <?php }}?>
               </tbody>
            </table>
         </div>
      </div>
                        <div class="tab-pane" id="outdateproduct">
                           <div class="table-responsive">
                              <table id="" class="basic-datatable  table table-borderless table-hover table-nowrap table-centered m-0">
                                 <thead class="thead-light">
                                    <tr>
                                       <th>מספר <br>מזהה</th>
                                       <!--th>תמונה</th-->
                                       <th>שם קורס</th>
                                       <th>תוֹאַר</th>
                                       <th>שם מוסד</th>
                                       <!--th>דֵרוּג</th-->
                                       <th>סוג מוצר</th>
                                       <th>מחיר</th>
                                       <th>פעולה</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>
                                          21
                                       </td>
                                       <!--td>
                                          <img src="assets/images/course_biology_portfolio_feat.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-md" />
                                          </td-->
                                       <td>
                                          עיצוב גרפי
                                       </td>
                                       <td>B.Tech במדעי המחשב </td>
                                       <td>אוניברסיטת וארטון </td>
                                       <td><span class="badge badge-success text-white">קורס מקוון</span> </td>
                                       <!--td>
                                          <span class="starrating"> <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i></span>
                                                          </td-->
                                       <td>
                                          ₪500
                                       </td>
                                       <td>
                                          <a href="#renewalproduct" class="btn btn-xs btn-primary" data-toggle="modal" title="חידוש המוצר"><i class="mdi mdi-autorenew"></i></a>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          22
                                       </td>
                                       <!--td>
                                          <img src="assets/images/course_biology_portfolio_feat.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-md" />
                                          </td-->
                                       <td>עיצוב גרפי</td>
                                       <td>B.Tech במדעי המחשב </td>
                                       <td>אוניברסיטת וארטון </td>
                                       <td><span class="badge badge-success text-white">קורס מקוון</span> </td>
                                       <!--td>
                                          <span class="starrating"> <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i></span>
                                                          </td-->
                                       <td>
                                          ₪200
                                       </td>
                                       <td>
                                          <a href="#renewalproduct" class="btn btn-xs btn-primary" data-toggle="modal" title="חידוש המוצר"><i class="mdi mdi-autorenew"></i></a>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          23
                                       </td>
                                       <!--td>
                                          <img src="assets/images/course_economics_portfolio_feat.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-md" />
                                          </td-->
                                       <td>
                                          עיצוב גרפי
                                       </td>
                                       <td>B.Tech במדעי המחשב </td>
                                       <td>אוניברסיטת וארטון </td>
                                       <td><span class="badge badge-success text-white">למידה אינטנסיבית</span> </td>
                                       <!--td>
                                          <span class="starrating"> <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i></span>
                                                          </td-->
                                       <td>
                                          ₪100
                                       </td>
                                       <td>
                                          <a href="#renewalproduct" class="btn btn-xs btn-primary" data-toggle="modal" title="חידוש המוצר"><i class="mdi mdi-autorenew"></i></a>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
      <div class="tab-pane" id="purchasehistory">
         <div class="table-responsive">
            <table  id="" class="basic-datatable table  table-hover table-nowrap table-centered m-0">
               <thead class="thead-light">
                  <tr>
                     <th>מספר<br>קבלה</th>
                     <th>תאריך רכישה</th>
                     <th>סוג המוצר</th>
                     <th>שם קורס</th>
                     <th>תוֹאַר</th>
                     <th>שם מוסד </th>
                     <th>מחיר </th>
                     <th>פעולה</th>
                  </tr>
                  </thead>
                     <tbody>
                     <?php 
                     if(!empty($enrolled_courses)){
                     foreach ($enrolled_courses as $key => $value) {
                        $date = $value->created_at;
                        $date = $date->format('d/m/Y');
                        ?>
                        <tr>
                           <td>
                            {{$value->order_number}}  
                           </td>
                           <td>
                              <span class="badge badge-secondary text-white">{{$date}}</span>
                           </td>
                           <?php 
                           $courses_data = array();
                           $degree = array();
                           $course_name = '';
                           $course_degree = '';
                           $course_university = '';
                           $degree_name = '';
                           $university_name = '';
                           $university = array();
                           $type= '';
                           $text ='';
                           $price = '';
                           $courses_data = DB::table('courses')->where('course_id',$value->ordered_courses)->get();
                           foreach ($courses_data as $key => $course_data) {
                              $course_name = $course_data->course_name;
                              $course_degree = $course_data->degree_id;

                              $degree = DB::table('degrees')->where('id',$course_degree)->pluck('degree_name');
                              if(count($degree) != 0){
                                 $degree_name = $degree[0];
                              }else{
                                 $degree_name = '';
                              }
                              $course_university = $course_data->university_id;
                              $university = DB::table('universities')->where('id',$course_university)->pluck('university_name');
                              if(count($university) != 0){
                                 $university_name = $university[0];
                              }else{
                                 $university_name = '';
                              }
                              $type = $course_data->course_type;
                              if($type == '0'){
                                 $text = 'קורס מקוון';
                              }else{
                                 $text = ' למידה אינטנסיבית  ';
                              }
                              $price = $course_data->price;
                           }
                           
                           ?>
                           <td><span class="badge badge-success text-white">שיעור פרטי</span> </td>
                           <td>{{$course_name}}</td>
                           <td>{{$degree_name}} </td>
                           <td>{{$university_name}} </td>
                           <td>₪{{$price}}</td>
                           <td>
                              <a href="{{route('admin.refunduser')}}" class="btn btn-xs btn-warning" data-toggle="tooltip"  title="refund"><i class="mdi mdi-refresh"></i></a>
                           </td>
                        </tr>
                        <?php }}?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="tab-pane" id="applicationhistory">
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
         foreach ($chats as $key => $chat) {
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
                     <td><span class="badge badge-secondary text-white">{{$date}}</span></td>
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
                  </td>
            </tr>
            <?php }?>
         </tbody>
      </table>
   </div>
</div>
                        </div>
                     </div>
                     <!-- end col-->
                  </div>
                  <!-- end row-->
               </div>
               <!-- container -->
            </div>
            <!-- content -->
         </div>
      </div>
   </div>
</div>
<div id="renewalproduct" class="renewalproduct modal fade" style="direction: rtl;">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title w-100">חידוש המוצר</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         </div>
         <div class="modal-body text-right">
            <div class="form-group mb-3">
               <label>תאריך תפוגה</label>
               <input type="text" id="basic-datepicker" class="form-control" placeholder="בחר תאריך">
            </div>
            <button type="button" class="btn btn-outline-warning waves-effect waves-light">שלח</button>
         </div>
      </div>
   </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
   $(document).ready(function() {
     $('#resetuser').click(function(){
       window.location.href = '{{route("admin.userslisting")}}';
     });
     function readURL(input) {
           if (input.files && input.files[0]) {
             var reader = new FileReader();
             reader.onload = function(e) {
               $('.userPreview').attr('src', e.target.result);
             $('.userPreview').hide();
             $('.userPreview').fadeIn(650);
           }
           reader.readAsDataURL(input.files[0]);
         }
       }
       $("#user-img").change(function() {
         readURL(this);
       });
     $('.basic-datatable ').DataTable();
       var degree_id = $('#user_degree_id').val();
       var degree_name = $('#user_degree_name').val();
       $('#user_degree').append('<option selected value="' + degree_id + '">' + degree_name + '</option>');
       $("#edituserbtn").click(function(e) {
         e.preventDefault();
          var fd = new FormData();
           var files = $('#user-img')[0].files;
           if(files.length > 0 ){
             fd.append('file',files[0]);
           }
         $.ajax({
             url: '{{ route("admin.updateuser") }}',
             type: 'POST',
             data:new FormData($("#edituser_form")[0]),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
             success: function(response) {
                 if ($.isEmptyObject(response.error)) {
                     window.location.href = '{{route("admin.userslisting")}}';
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
             $('#user_university').change(function(){
           var university_id = $(this).val();
           $.ajax({
             url: '{{ route("front.getdegree") }}',
             type: 'POST',
             data: {
                 university_id: university_id
             },
             success: function(data) {
               $('#user_degree').html('');
                 $.each(data.degree_data, function(i, d) {
                     $('#user_degree').append('<option value="' + d.id + '">' + d.degree_name + '</option>');
                 });
               }
           });
         });

    $("#resetpassword").click(function(e) {
        e.preventDefault();
        var email = $("#reset_email").val();
        $.ajax({
            url: '{{ route("admin.admin_user_forgotpassword") }}',
            type: 'POST',
            dataType: 'json',
            data: {
                email: email
            },
            success: function(data) {
                if (data.status == 1) {
                    printErrorMsg1(data.msg);
                } else {
                    printErrorMsg2(data.msg);
                }
              }
          });
        });
    function printErrorMsg1 (msg) {
           $('.mail_success').text(msg);
           $(window).scrollTop(0);
         }
         function printErrorMsg2 (msg) {
           $('.mail_error').text(msg);
           $(window).scrollTop(0);
         }
         });
         
</script>
@endsection