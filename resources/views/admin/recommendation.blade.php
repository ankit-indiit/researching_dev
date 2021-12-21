@extends('admin.layouts.app')

@section('title', ' עלינו   ')
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
                <li class="breadcrumb-item active">המלצה</li>
              </ol>
            </div>
            <h4 class="page-title">המלצה</h4>
          </div>
        </div>
      </div> 
      
<div class="row">
  <div class="col-lg-12">
    <div class="card-box recentuser">
      <div class="row">
        <div class="col-md-6 text-left">
          <a href="{{route('admin.addrecommendation')}}" class="btn btn-primary  mb-3">הוסף המלצה</a>
        </div>
        <div class="col-md-6">
          <h4 class="header-title text-right mb-3">המלצה</h4>
        </div>
      </div>
      <ul class="nav nav-tabs justify-content-center " style="direction: rtl;">
        <li class="nav-item">
          <a href="#course" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                               קורסים
          </a>
        </li>
        <li class="nav-item">
          <a href="#instructor" data-toggle="tab" aria-expanded="false" class="nav-link ">
                                              מַדְרִיך
          </a>
        </li> 
        <li class="nav-item">
          <a href="#website" data-toggle="tab" aria-expanded="false" class="nav-link ">
                                                 אתר אינטרנט
          </a>
        </li> 
        <li class="nav-item">
          <a href="#online_recommendation" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                 המלצה מקוונת
          </a>
        </li> 
      </ul>
      <div class="tab-content">
        <div class="tab-pane show active" id="course">
          <div class="table-responsive">
            <table id="basic-datatable_new" class="table table-borderless table-hover table-nowrap table-centered m-0">
              <thead class="thead-light">
                <tr>
                  <th>תאריך</th>
                  <th colspan="2">שם תלמיד</th>
                  <th>שם מוסד</th>
                  <th>שם התואר</th>
                  <th>שם הקורס</th>
                  <th>תכונה</th>
                  <th>הצג הסתר</th>
                  <th>סטטוס</th>
                  <th>פעולה</th>
                </tr>
              </thead>
            <tbody> 
  <?php
  $count = 0;
  $created_at ='';
  $created_date = '';
  $university_name = '';
  $degree_name = '';
  $course_name = '';
  $degree = array();
  $university = array();
if(isset($course_recommendations)){
  $count = count($course_recommendations); 
  if($count != 0){
    foreach ($course_recommendations as $value) {

      $created_at = strtotime($value->created_at);
      $created_date = date('Y M d',$created_at);
      $user_data = DB::table('users')->where('id',$value->user_id)->get();
      foreach ($user_data as $data) {
        $image =  asset('/assets/users/' .$data->avatar);
        $username = $data->first_name . $data->last_name;
      }

      $course_data = DB::table('courses')->where('course_id',$value->course_id)->get();
      foreach ($course_data as $course) {
        $course_name = $course->course_name;
        $university_id = $course->university_id;
        $degree_id = $course->degree_id;
        $degree = DB::table('degrees')->where('id',$degree_id)->pluck('degree_name');
        if(isset($degree[0])){
          $degree_name = $degree[0];
        }else{
          $degree_name = '';
        }

        $university = DB::table('universities')->where('id',$university_id)->pluck('university_name');

        if(isset($university[0])){
          $university_name = $university[0];
        }else{
          $university_name = '';
        }
      } 
  ?>                             
    <tr>
      <td>
        <p class="mb-0 text-muted"><small>{{$created_date}}</small></p>                   
            </td>
            <td style="width: 36px;">
              <img src="{{$image}}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm">
            </td>
            <td>
              <h5 class="m-0 font-weight-normal">{{$username}}</h5>
            </td>
            <td>{{$university_name}}</td>      
            <td>{{$degree_name}}</td>         
            <td>{{$course_name}}</td>
            <?php
            $checked1 = ''; 
            if($value->is_posted == '1'){
              $checked1 = 'checked';
            }else{
              $checked1 = '';
            }
            ?>  
            <td>
              <label class="switch">
                <input type ="hidden" name="posted" id="posted" value="0">
                <input type="checkbox" class="show_posted" name="show_posted" value="{{$value->is_posted}}" data-id = "{{$value->id}}" <?php echo $checked1; ?> >
                <span class="slider round"></span>
              </label>
            </td>
            <?php
            $checked = ''; 
            if($value->status == '1'){
              $checked = 'checked';
            }else{
              $checked = '';
            }
            ?>
            <td>
              <label class="switch">
                <input type ="hidden" name="hideshow" id="hideshow" value="0">
                <input type="checkbox" class="show_hide" name="show_hide" value="{{$value->status}}" data-id = "{{$value->id}}" <?php echo $checked; ?> >
                <span class="slider round"></span>
              </label>
            </td>
            <?php
              $status_class = ' badge-success';
              $status_label = ' ממתין ל   ';
              if($value->is_approved == 0){
                $status_class = '  badge-danger';
                $status_label = ' ממתין ל    ';
              }elseif($value->is_approved == 1){
                $status_class = ' badge-success';
                $status_label = ' אשר  V ';
              }else{
                $status_class = ' badge-warning';
                $status_label = 'רב  X';
              }
            ?>
            <td>
              <input type="hidden" name="comments_status" id="comments_status" value="{{$value->is_approved}}">
              <input type="hidden" name="comment_id" class="comment_id" value="">
               <div class="dropdown ">
                  <label class="badge {{$status_class}} dropdown-toggle" data-toggle="dropdown"> {{$status_label}}<span class="fa fa-angle-down  mr-1"></span></label>
                  <ul class="dropdown-menu comment_status">
                    <li data-id="{{$value->id}}" data-value="2"><a class="dropdown-item"> סרב  X</a></li>
                    <li data-id="{{$value->id}}" data-value="1"><a class="dropdown-item"> אשר  V</a></li>
                    <li data-id = "{{$value->id}}" data-value="0"><a  class="dropdown-item">
                      ממתין ל
                    </a></li>
                  </ul>
                </div>
              </td>
              <td>
                <a href="{{route('admin.viewrecommendation').'/'.$value->id}}" class="btn btn-xs btn-info" data-toggle="tooltip" title="" data-original-title="צפה בפרטים"><i class="mdi mdi-eye"></i></a>
              </td>
            </tr> 
          <?php }}}?>   
          </tbody>
        </table>
      </div>
    </div>
  
    <div class="tab-pane " id="instructor">
      <div class="table-responsive">
        <table id="basic-datatable_new" class="table table-borderless table-hover table-nowrap table-centered m-0">
          <thead class="thead-light">
            <tr>
              <th>תאריך</th>
              <th colspan="2">שם תלמיד</th>
              <th>שם מוסד</th>
              <th>שם התואר</th>
              <th>שם הקורס</th>
              <th>תכונה</th>
              <th>הצג הסתר</th>
              <th>סטטוס</th>
              <th>פעולה</th>
            </tr>
          </thead>
        <tbody>
  <?php
  $count1 = 0;
  $created_at1 ='';
  $created_date1 = '';
  $university_name1 = '';
  $degree_name1 = '';
  $degree1 = array();
  $university1 = array();
  if(isset($instructor_recommendations)){
  $count1 = count($instructor_recommendations); 
  if($count1 != 0){
    foreach ($instructor_recommendations as $values) {

      $created_at1 = strtotime($values->created_at);
      $created_date1 = date('Y M d',$created_at1);
      $user_data1 = DB::table('users')->where('id',$values->user_id)->get();
      foreach ($user_data1 as $data1) {
        $image1 =  asset('/assets/users/' .$data1->avatar);
        $username1 = $data1->first_name . $data1->last_name;
      }

      $instructor_data = DB::table('instructors')->where('id',$values->instructor_id)->get();
      foreach ($instructor_data as $instructor) {
        $instructor_name = $instructor->first_name . $instructor->last_name;
        $university_id = $instructor->university;
        $degree_id = $instructor->degree;
        $degree1 = DB::table('degrees')->where('id',$degree_id)->pluck('degree_name');

        if(isset($degree1[0])){
          $degree_name1 = $degree1[0];
        }else{
          $degree_name1 = '';
        }

        $university1 = DB::table('universities')->where('id',$university_id)->pluck('university_name');
        if(isset($university1[0])){
          $university_name1 = $university1[0];
        }else{
          $university_name1 = '';
        }
      } 
  ?>                                     
  <tr>
    <td>
      <p class="mb-0 text-muted"><small>{{$created_date1}}</small></p>                   
    </td>
    <td style="width: 36px;">
      <img src="{{$image1}}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm">
    </td>
    <td>
      <h5 class="m-0 font-weight-normal">{{$username1}}</h5>
    </td>
    <td>{{$university_name1}}</td>      
    <td>{{$degree_name1}}</td>         
    <td>{{$instructor_name}}</td>
    <?php
      $checked2 = ''; 
      if($values->is_posted == '1'){
        $checked2 = 'checked';
      }else{
        $checked2 = '';
      }
    ?>  
    <td>
      <label class="switch">
        <input type ="hidden" name="posted1" id="posted1" value="0">
        <input type="checkbox" class="show_posted1" name="show_posted1" value="{{$values->is_posted}}" data-id = "{{$values->id}}" <?php echo $checked2; ?> >
        <span class="slider round"></span>
      </label>
    </td>
    <?php
      $checked3 = ''; 
        if($values->status == '1'){
          $checked3 = 'checked';
        }else{
          $checked3 = '';
        }
      ?>
      <td>
        <label class="switch">
          <input type ="hidden" name="hideshow1" id="hideshow1" value="0">
          <input type="checkbox" class="show_hide1" name="show_hide1" value="{{$values->status}}" data-id = "{{$values->id}}" <?php echo $checked3; ?> >
          <span class="slider round"></span>
        </label>
      </td>
      <?php
        $status_class1 = ' badge-success';
        $status_label1 = ' ממתין ל   ';
        if($values->is_approved == 0){
          $status_class1 = '  badge-danger';
          $status_label1 = ' ממתין ל    ';
        }elseif($values->is_approved == 1){
          $status_class1 = ' badge-success';
          $status_label1 = ' אשר  V ';
        }else{
          $status_class1 = ' badge-warning';
          $status_label1 = 'רב  X';
        }
      ?>
      <td>
        <input type="hidden" name="comments_status1" id="comments_status1" value="{{$values->is_approved}}">
        <input type="hidden" name="comment_id1" class="comment_id1" value="">
        <div class="dropdown ">
          <label class="badge {{$status_class1}} dropdown-toggle" data-toggle="dropdown"> {{$status_label1}}<span class="fa fa-angle-down  mr-1"></span></label>
          <ul class="dropdown-menu comment_status1">
            <li data-id="{{$values->id}}" data-value="2"><a class="dropdown-item"> סרב  X</a></li>
            <li data-id="{{$values->id}}" data-value="1"><a class="dropdown-item"> אשר  V</a></li>
            <li data-id = "{{$values->id}}" data-value="0"><a  class="dropdown-item">
                      ממתין ל
            </a></li>
          </ul>
        </div>
        </td>
        <td>
          <a href="{{route('admin.viewrecommendation').'/'.$values->id}}" class="btn btn-xs btn-info" data-toggle="tooltip" title="" data-original-title="צפה בפרטים"><i class="mdi mdi-eye"></i></a>
        </td>
      </tr> 
    <?php }}}?>                                         
      </tbody>
    </table>
  </div>
</div>
  
  <div class="tab-pane " id="website">
    <div class="table-responsive">
      <table id="basic-datatable_new" class="table table-borderless table-hover table-nowrap table-centered m-0">
        <thead class="thead-light">
          <tr>
            <th>תאריך</th>
            <th colspan="2">שם תלמיד</th>
            <th> recommendations</th>
            <th>תכונה</th>
            <th>הצג הסתר</th>
            <th>סטטוס</th>
            <th>פעולה</th>
          </tr>
        </thead>
        <tbody>
  <?php
  $count2 = 0;
  $created_at2 ='';
  $created_date2 = '';
  $university_name2 = '';
  $degree_name2 = '';
  $degree2 = array();
  $university2 = array();
  if(isset($website_recommendations)){
  $count2 = count($website_recommendations); 
  if($count2 != 0){
    foreach ($website_recommendations as $data) {

      $created_at2 = strtotime($data->created_at);
      $created_date2 = date('Y M d',$created_at2);
      $user_data2 = DB::table('users')->where('id',$data->user_id)->get();
      foreach ($user_data2 as $data2) {
        $image2 =  asset('/assets/users/' .$data2->avatar);
        $username2 = $data2->first_name . $data2->last_name;
      }
  ?> 
          <tr>
            <td>
              <p class="mb-0 text-muted"><small>{{$created_date2}}</small></p>                 
            </td>
            <td style="width: 36px;">
              <img src="{{$image2}}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm">
            </td>
            <td>
              <h5 class="m-0 font-weight-normal">{{$username2}}</h5>
            </td>
            <td>{{$data->description}}</td>
            <?php
      $checked4 = ''; 
      if($data->is_posted == '1'){
        $checked4 = 'checked';
      }else{
        $checked4 = '';
      }
    ?>  
    <td>
      <label class="switch">
        <input type ="hidden" name="posted2" id="posted2" value="0">
        <input type="checkbox" class="show_posted2" name="show_posted2" value="{{$data->is_posted}}" data-id = "{{$data->id}}" <?php echo $checked4; ?> >
        <span class="slider round"></span>
      </label>
    </td>
    <?php
      $checked5 = ''; 
        if($data->status == '1'){
          $checked5 = 'checked';
        }else{
          $checked5 = '';
        }
      ?>
      <td>
        <label class="switch">
          <input type ="hidden" name="hideshow2" id="hideshow2" value="0">
          <input type="checkbox" class="show_hid2" name="show_hide2" value="{{$data->status}}" data-id="{{$data->id}}" <?php echo $checked5; ?> >
          <span class="slider round"></span>
        </label>
      </td>
          <?php
        $status_class2 = ' badge-success';
        $status_label2 = ' ממתין ל   ';
        if($data->is_approved == 0){
          $status_class2 = '  badge-danger';
          $status_label2 = ' ממתין ל    ';
        }elseif($data->is_approved == 1){
          $status_class2 = ' badge-success';
          $status_label2 = ' אשר  V ';
        }else{
          $status_class2 = ' badge-warning';
          $status_label2 = 'רב  X';
        }
      ?>
      <td>
        <input type="hidden" name="comments_status2" id="comments_status2" value="{{$data->is_approved}}">
        <input type="hidden" name="comment_id2" class="comment_id2" value="">
        <div class="dropdown ">
          <label class="badge {{$status_class2}} dropdown-toggle" data-toggle="dropdown"> {{$status_label2}}<span class="fa fa-angle-down  mr-1"></span></label>
          <ul class="dropdown-menu comment_status2">
            <li data-id="{{$data->id}}" data-value="2"><a class="dropdown-item"> סרב  X</a></li>
            <li data-id="{{$data->id}}" data-value="1"><a class="dropdown-item"> אשר  V</a></li>
            <li data-id = "{{$data->id}}" data-value="0"><a  class="dropdown-item">
                      ממתין ל
            </a></li>
          </ul>
        </div>
        </td>
          <td>
            <a href="{{route('admin.viewrecommendation').'/'.$data->id}}" class="btn btn-xs btn-info" data-toggle="tooltip" title="" data-original-title="צפה בפרטים"><i class="mdi mdi-eye"></i></a>
          </td>
        </tr>
        <?php }}}?>        
      </tbody>
    </table>
  </div>
</div>
  <div class="tab-pane " id="online_recommendation">
    <div class="table-responsive">
      <table id="basic-datatable_new" class="table table-borderless table-hover table-nowrap table-centered m-0">
        <thead class="thead-light">
          <tr>
            <th >תאריך</th>
            <th colspan="2">שם המדריך</th>
            <th> recommendations</th>
            <th>הצג </th>
            <!--<th>הצג הסתר</th>
            <th>סטטוס</th>>-->
            <th>פעולה</th>
          </tr>
        </thead>
        <tbody>
  <?php
  if(isset($online_recommendation)){
  $count2 = count($online_recommendation);
  if($count2 != 0){
    foreach ($online_recommendation as $data) {

      $created_at2 = strtotime($data->created_at);
      $created_date2 = date('Y M d',$created_at2);
      $user_data2 = DB::table('users')->where('id',$data->user_id)->get();
      foreach ($user_data2 as $data2) {
        $image2 =  asset('/assets/users/' .$data2->avatar);
        $username2 = $data2->first_name . $data2->last_name;
      }
  ?> 
          <tr>
            <td>
              <p class="mb-0 text-muted"><small>{{$created_date2}}</small></p>                 
            </td>
            <td style="width: 36px;">
              <img src="{{$image2}}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm">
            </td>
            <td>
              <h5 class="m-0 font-weight-normal">{{$username2}}</h5>
            </td>
            <td>{{$data->description}}</td>
            <?php
              $checked4 = ''; 
              if($data->is_posted == '1'){
                $checked4 = 'checked';
              }else{
                $checked4 = '';
              }
            ?>  
    <td>
      <label class="switch">
        <input type ="hidden" name="posted2" id="posted2" value="0">
        <input type="checkbox" class="show_posted2" name="show_posted2" value="{{$data->is_posted}}" data-id = "{{$data->id}}" <?php echo $checked4?> >
        <span class="slider round"></span>
      </label>
    </td>
    <?php
      $checked5 = ''; 
        if($data->status == '1'){
          $checked5 = 'checked';
        }else{
          $checked5 = '';
        }
      ?>
      <!--<td>
        <label class="switch">
          <input type ="hidden" name="hideshow2" id="hideshow2" value="0">
          <input type="checkbox" class="show_hid2" name="show_hide2" value="{{$data->status}}" data-id = "{{$data->id}}" <?php // echo $checked5 ?> >
          <span class="slider round"></span>
        </label>
      </td>-->
          <?php
        /*$status_class2 = ' badge-success';
        $status_label2 = ' ממתין ל   ';
        if($data->is_approved == 0){
          $status_class2 = '  badge-danger';
          $status_label2 = ' ממתין ל    ';
        }elseif($data->is_approved == 1){
          $status_class2 = ' badge-success';
          $status_label2 = ' אשר  V ';
        }else{
          $status_class2 = ' badge-warning';
          $status_label2 = 'רב  X';
        }*/
      ?>
      <!--<td>
        <input type="hidden" name="comments_status2" id="comments_status2" value="{{$data->is_approved}}">
        <input type="hidden" name="comment_id2" class="comment_id2" value="">
        <div class="dropdown ">
          <label class="badge {{$status_class2}} dropdown-toggle" data-toggle="dropdown"> {{$status_label2}}<span class="fa fa-angle-down  mr-1"></span></label>
          <ul class="dropdown-menu comment_status2">
            <li data-id="{{$data->id}}" data-value="2"><a class="dropdown-item"> סרב  X</a></li>
            <li data-id="{{$data->id}}" data-value="1"><a class="dropdown-item"> אשר  V</a></li>
            <li data-id = "{{$data->id}}" data-value="0"><a  class="dropdown-item">
                      ממתין ל
            </a></li>
          </ul>
        </div>
        </td>-->
          <td>
            <a data-id="{{ $data->id }}" data-value="{{ $data->id }}" class="btn btn-xs btn-danger delete_online_recommend"><i class="mdi mdi-trash-can"></i></a>
            <a href="{{route('admin.editrecommendation').'/'.$data->id}}" class="btn btn-xs btn-success editrecommendation" data-toggle="tooltip" title="" data-original-title="Edit"><i class="mdi mdi-pencil"></i></a>
            <a href="{{route('admin.viewrecommendation').'/'.$data->id}}" class="btn btn-xs btn-info" data-toggle="tooltip" title="" data-original-title="צפה בפרטים"><i class="mdi mdi-eye"></i></a>
          </td>
        </tr>
        <?php }}}?>
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

<div id="statusModal1" class="deletemodal modal fade">
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
                <button  type="button" class="btn btn-danger updatestatus1 ">לִמְחוֹק</button>
            </div>
        </div>
    </div>
</div>

<div id="statusModal2" class="deletemodal modal fade">
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
                <button  type="button" class="btn btn-danger updatestatu2 ">לִמְחוֹק</button>
            </div>
        </div>
    </div>
</div>
<div id="onlineRecommendDelete" class="deletemodal modal fade">
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
                <button  type="button" class="btn btn-danger deleted_online_recommed_btn" data-token="{{ csrf_token() }}">לִמְחוֹק</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript">


$(document).on("click",".delete_online_recommend",function(){
    var online_recommend_id = $(this).data("id");
    
    $('.deleted_online_recommed_btn').attr('dataval', online_recommend_id);
    $('#onlineRecommendDelete').modal('show');    
});
$(document).on("click",".deleted_online_recommed_btn",function(){
    var online_recommend_delete_id = $(this).attr("dataval");
    var token = $(this).attr("data-token");
    $.ajax({
        url: '{{ route("admin.delete_onlie_recommed") }}',
        type: 'POST',
        dataType: 'json',
        data: {
          id: online_recommend_delete_id,
          _token:token
      },
      success: function (response) {
        if(response.status == 1){
          window.location.reload();
        }else{
          alert(' סטטוס לא עודכן ');
        }
        }
        });
    
      
});



  $(document).ready(function() {
    $('.show_hide').click(function(){
      if($(this).prop("checked") == true){
        $('#hideshow').val('1');
      }
      else if($(this).prop("checked") == false){
        $('#hideshow').val('0');
      }
      var id = $(this).attr('data-id');
      var status = $('#hideshow').val();
      $.ajax({
        url: '{{ route("admin.updateshowhide") }}',
        type: 'POST',
        dataType: 'json',
        data: {
          comment_id: id,
          status:status
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
    $('.show_posted').click(function(){
      if($(this).prop("checked") == true){
        $('#posted').val('1');
      }
      else if($(this).prop("checked") == false){
        $('#posted').val('0');
      }
      var id = $(this).attr('data-id');
      var status = $('#posted').val();
      $.ajax({
        url: '{{ route("admin.updateshowposted") }}',
        type: 'POST',
        dataType: 'json',
        data: {
          comment_id: id,
          status:status
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
     
    $(".comment_status").on("click", "li", function(e){
    e.preventDefault();
    var status = $(this).attr('data-value');
    var id = $(this).attr('data-id');
    $('.comment_id').val(id);
    $('#comments_status').val(status);
    console.log(status);
    if(status == '0' || status == '1' || status == '2'){
      $('#statusModal').modal('show');
    }
});
    $(".updatestatus").on("click", function(e){
    e.preventDefault();
    var toupdatestatus =  $('#comments_status').val();
    var comment_id = $('.comment_id').val();
    $.ajax({
      url: '{{ route("admin.updatecommentstatus") }}',
      type: 'POST',
      dataType: 'json',
      data: {
        comment_id: comment_id,
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

    $('.show_hide1').click(function(){
      if($(this).prop("checked") == true){
        $('#hideshow1').val('1');
      }
      else if($(this).prop("checked") == false){
        $('#hideshow1').val('0');
      }
      var id = $(this).attr('data-id');
      var status = $('#hideshow1').val();
      $.ajax({
        url: '{{ route("admin.updateshowhide") }}',
        type: 'POST',
        dataType: 'json',
        data: {
          comment_id: id,
          status:status
      },
      success: function (response) {
        if(response.data.status == 1){
          window.location.reload();
          window.location.href = '#instructor';
          // $('#instructor').show();
        }else{
          alert(' סטטוס לא עודכן ');
        }
        
        }
        });
            
        });
    $('.show_posted1').click(function(){
      if($(this).prop("checked") == true){
        $('#posted1').val('1');
      }
      else if($(this).prop("checked") == false){
        $('#posted1').val('0');
      }
      var id = $(this).attr('data-id');
      var status = $('#posted1').val();
      $.ajax({
        url: '{{ route("admin.updateshowposted") }}',
        type: 'POST',
        dataType: 'json',
        data: {
          comment_id: id,
          status:status
      },
      success: function (response) {
        if(response.data.status == 1){
          window.location.reload();
           window.location.href = '#instructor';
          // $('#instructor').show();
        }else{
          alert(' סטטוס לא עודכן ');
        }
        
        }
        });
            
        });
     
    $(".comment_status1").on("click", "li", function(e){
    e.preventDefault();
    var status = $(this).attr('data-value');
    var id = $(this).attr('data-id');
    $('.comment_id1').val(id);
    $('#comments_status1').val(status);
    console.log(status);
    if(status == '0' || status == '1' || status == '2'){
      $('#statusModal1').modal('show');
    }
});
    $(".updatestatus1").on("click", function(e){
    e.preventDefault();
    var toupdatestatus =  $('#comments_status1').val();
    var comment_id = $('.comment_id1').val();
    $.ajax({
      url: '{{ route("admin.updatecommentstatus") }}',
      type: 'POST',
      dataType: 'json',
      data: {
        comment_id: comment_id,
        status:toupdatestatus

      },
      success: function (response) {
        if(response.data.status == 1){
          window.location.reload();
           window.location.href = '#instructor';
          // $('#instructor').show();
        }else{
          alert(' סטטוס לא עודכן ');
        }
        
        }
        });
});

    $('.show_hide2').click(function(){
      if($(this).prop("checked") == true){
        $('#hideshow2').val('1');
      }
      else if($(this).prop("checked") == false){
        $('#hideshow2').val('0');
      }
      var id = $(this).attr('data-id');
      var status = $('#hideshow2').val();
      $.ajax({
        url: '{{ route("admin.updateshowhide") }}',
        type: 'POST',
        dataType: 'json',
        data: {
          comment_id: id,
          status:status
      },
      success: function (response) {
        if(response.data.status == 1){
          window.location.reload();
          window.location.href = '#instructor';
          // $('#instructor').show();
        }else{
          alert(' סטטוס לא עודכן ');
        }
        
        }
        });
            
        });
    $('.show_posted2').click(function(){
      if($(this).prop("checked") == true){
        $('#posted2').val('1');
      }
      else if($(this).prop("checked") == false){
        $('#posted2').val('0');
      }
      var id = $(this).attr('data-id');
      var status = $('#posted2').val();
      $.ajax({
        url: '{{ route("admin.updateshowposted") }}',
        type: 'POST',
        dataType: 'json',
        data: {
          comment_id: id,
          status:status
      },
      success: function (response) {
        if(response.data.status == 1){
            console.log("done");
            swal({
                  title: 'Done!',
                  success:'success',
                  text: 'Status changed successfully.',
                  timer: 2000,
                  showCancelButton: false,
                  showConfirmButton: false
                })
            //sweetAlert("Done", "Status changed successfully!", "success");
            
          /*window.location.reload();
           window.location.href = '#instructor';*/
          // $('#instructor').show();
        }else{
          alert(' סטטוס לא עודכן ');
        }
        
        }
        });
            
        });
     
    $(".comment_status2").on("click", "li", function(e){
    e.preventDefault();
    var status = $(this).attr('data-value');
    var id = $(this).attr('data-id');
    $('.comment_id2').val(id);
    $('#comments_status2').val(status);
    console.log(status);
    if(status == '0' || status == '1' || status == '2'){
      $('#statusModal2').modal('show');
    }
});
    $(".updatestatus2").on("click", function(e){
    e.preventDefault();
    var toupdatestatus =  $('#comments_status2').val();
    var comment_id = $('.comment_id2').val();
    $.ajax({
      url: '{{ route("admin.updatecommentstatus") }}',
      type: 'POST',
      dataType: 'json',
      data: {
        comment_id: comment_id,
        status:toupdatestatus

      },
      success: function (response) {
        if(response.data.status == 1){
          window.location.reload();
           window.location.href = '#instructor';
          // $('#instructor').show();
        }else{
          alert(' סטטוס לא עודכן ');
        }
        
        }
        });
});
  });
</script>

@endsection