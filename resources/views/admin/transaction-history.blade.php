@extends('admin.layouts.app')

@section('title', ' היסטוריית חיתוך ')
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
                <li class="breadcrumb-item active">היסטוריית עסקאות</li>
              </ol>
            </div>
            <h4 class="page-title">היסטוריית עסקאות</h4>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">
          <div class="card-box recentuser">  
            <div class="row" style="direction:rtl">
              <div class="col-md-6 text-right">
                <h4 class="header-title  text-right mb-3">היסטוריית עסקאות </h4>
              </div>
              <div class="col-md-6 text-left">
                <div class="form-group mb-3 mx-w-160 float-left  text-right">
                  <label>תאריך התחלה</label>
                  <input type="text" class="basic-datepicker form-control" placeholder="תאריך התחלה">
                </div>  
                <div class="form-group mb-3 mx-w-160 ml-2 float-left  text-right">
                  <label>תאריך סיום</label>
                  <input type="text" class="basic-datepicker form-control" placeholder="תאריך סיום">
                </div>
                <div class="form-group  mt-29  ml-2 float-left  text-right">
                  <button class="btn btn-primary waves-effect ">לְסַנֵן</button>  
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table  id="basic-datatable1" class="table  table-hover table-nowrap table-centered m-0">
              <thead class="thead-light">
                <tr>
                  <th>מספר מזהה רכישה</th>
                  <th>תאריך תשלום</th>
                  <th>שם משתמש</th>
                  <th>שם מוסד</th>
                  <th>תוֹאַר </th>
                  <th>שם קורס</th>
                  <th>שיעור פרטי</th>
                  <th>שיעור למידה אינטנסיבי</th>
                  <th>אמצעי תשלום</th>
                  <th>עלות רכישה</th>
                  <th>אחרי הנחה</th>
                  <th>סטָטוּס</th>
                  <th>פעולה</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                
                foreach ($orders as $value) {
                  if($value->ordered_courses != ''){
                    $courseid = $value->ordered_courses;
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
                <tr>
                  <td>
                    {{$value->order_number}}
                  </td>
                  <td>
                    <span class="badge badge-secondary text-white">{{($value->created_at)->format('d-m-y')}} </span>
                  </td>
                  <td>{{$value->first_name . $value->last_name}}</td>
                  <td>
                    {{$university}}
                  </td>
                  <td>{{$degree}}</td>
                  <td>{{$course->course_name}}</td>
                  <td>
                   
                  </td>
                  <td></td>
                  <td>{{$value->payment_method}}</td>
                  <td>₪{{$value->grand_total}}</td>
                  <td>₪50</td>
                  <td>
                    <span class="badge badge-primary text-white">{{$value->status}}</span>
                  </td>
                <td>
                  <a href="{{route('admin.showdetailhistory').'/'.$value->id}}" data-toggle="tooltip" title="תצוגת הקבלה" class="btn btn-xs btn-info"><i class="mdi mdi-eye"></i></a>
                </td>
              </tr>  
              <?php }   }}?>    
            </tbody>
          </table>
        </div>
      </div>
    </div> 
  </div>
  
  <div class="row">
    <div class="col-lg-12">
      <div class="card-box recentuser">
        <h4 class="header-title text-right mb-3">מוצרים אחרונים </h4>
          <div class="table-responsive">
            <table id="" class=" basic-datatable11 table table-borderless table-hover table-nowrap table-centered m-0">
              <thead class="thead-light">
                <tr> 
                  <th>מספר מזהה</th>
                  <th>שם קורס</th>
                  <th>תוֹאַר</th>
                  <th>שם מוסד</th>
                  <th>סוג מוצר</th>
                  <th>מחיר</th>
                  <th>פעולה</th>
                </tr>
              </thead>
              <tbody>
                <?php 
    $type = '';
    $degree = '';
    $university = '';
    foreach ($recent_courses_data as $index => $value) {
      $degrees = DB::table('degrees')->where('id',$value->degree_id)->pluck('degree_name');
      if(!empty($degrees)){
        foreach($degrees as $d_name){
          $degree = $d_name;
      }
    }else{
      $degree = '-';
    }
    $universities = DB::table('universities')->where('id',$value->university_id)->pluck('university_name');
    if(!empty($universities) > 0){
      foreach($universities as $u_name){
        $university = $u_name;
      }
    }else{
      $university = '-';
    }
    if($value->course_type == '0'){
      $type = 'online Course';
    }else{
      $type = 'Intensive Learning';
    }
  ?>
                <tr>
                  <td> {{$index +1}}</td>
                  <td>{{$value->course_name}} </td>
                  <td>{{$degree}}</td>
                  <td>{{$university}} </td>
                  <td><span class="badge badge-success text-white">{{$type}}</span> </td>
                  <td>₪{{$value->price}} </td>
                  <td>
                    <a href="javascript: void(0);" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>
                    <a href="#myDeleteModal"  data-toggle="modal" class="btn btn-xs btn-danger"><i class="mdi mdi-trash-can"></i></a>
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
</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $('.basic-datepicker ').flatpickr()
  });
</script>
@endsection
