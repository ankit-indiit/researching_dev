@extends('admin.layouts.app')

@section('title', ' פירוט עסקה ')
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
                <li class="breadcrumb-item"><a href="{{route('admin.showhistory')}}">היסטוריית עסקאות</a></li>
                <li class="breadcrumb-item active">פרטי עסקה</li>
              </ol>
            </div>
            <h4 class="page-title">פרטי עסקה</h4>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">
          <div class="card-box">
            <div class="row" style="direction:rtl">
              <div class="col-md-6  text-right">
                <?php 
                $date = $order_data->created_at;
                $date = $date->format('d.m.y');
                $courseid = $order_data->ordered_courses;
                   $courses = DB::table('courses')->where('course_id',$courseid)->get();
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
                <h4 class="header-title">{{$date}}</h4>
              </div>
              <div class="col-md-6 text-left">
                <h4 class="header-title ">#{{$order_data->order_number}} מספר מזהה רכישה</h4>
              </div>
            </div>
            <div class="row  mb-3" style="direction:rtl">
              <div class="col-md-4 offset-md-4  text-right">
                <div class="address mt-2">
                  <p class="mb-2"><b>{{$order_data->first_name . $order_data->last_name}}</b></p>
                  <p>{{$order_data->address}}</p>
                  <p>{{$order_data->email}} :אימייל </p>
                  <p>מכשיר טלפון: {{$order_data->phone_number}}</p>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table   class="table  table-hover table-nowrap table-centered m-0">
                <thead class="thead-light">
                  <tr>
                    <th>שם מוסד</th>
                    <th>תוֹאַר </th>
                    <th>שם קורס</th>
                    <th>שיעור פרטי</th>
                    <th>שיעור למידה אינטנסיבי</th>
                    <th>אמצעי תשלום</th>
                    <th>עלות רכישה</th>
                    <th>אחרי הנחה</th>
                    <th>סטָטוּס</th>
                  </tr>
                </thead>
              <tbody>
            <tr>
              <td>{{$university}}</td>
              <td>{{$degree}}</td>
              <td>{{$course->course_name}}</td>
              <td>עיצוב גרפי</td>
              <td>מדעי הספורט</td>
              <td>{{$order_data->payment_method}}</td>
              <td>₪{{$order_data->grand_total}}</td>
              <td>₪50</td>
              <td>
              <span class="badge badge-primary text-white">{{$order_data->status}}</span>
            </td>
          </tr>
        <?php }?>
        </tbody>
      </table>
    </div>
  </div>
  </div> </div>
</div>
</div>
  </div>
</div>
       @endsection