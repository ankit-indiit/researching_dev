@extends('admin.layouts.app')
 
@section('title', ' מוצרים ')
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
                <li class="breadcrumb-item"><a href="{{route('admin.productslisting')}}">מוֹסָד</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.degreeslisting').'/'.$university_id}}">תוֹאַר</a></li>
                <li class="breadcrumb-item active">מוצרים</li>
              </ol>
            </div>
          <h4 class="page-title">מוצרים</h4>
        </div>
      </div>
    </div> 
    <div class="row">
      <div class="col-lg-12">
        <div class="card-box recentuser  allproducts">
          <div class="row" style="direction:rtl">
            <div class="col-md-6 text-right">
              <h4 class="header-title text-right mb-3">כל המוצרים </h4>
            </div>
            <div class="col-md-6 text-left">
              <a href="{{route('admin.addproduct').'/'.$degree_id.'/'.$university_id}}" class="btn btn-primary  mb-3">הוסף מוצר</a>
            </div>
          </div>
          <ul class="nav nav-tabs justify-content-center" style="direction:rtl">
            <li class="nav-item">
              <a href="#onlinecourse" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                               קורס מקוון
              </a>
            </li>
            <li class="nav-item">
              <a href="#grouplesson" data-toggle="tab" aria-expanded="false" class="nav-link ">
                                                 מרתון
              </a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane show active" id="onlinecourse">
              <div class="table-responsive">
                <table id="" class=" basic-datatable11 table table-borderless table-hover table-nowrap table-centered m-0">
                  <thead class="thead-light">
                    <tr> 
                      <th>מזהה מוצר</th>
                      <!--th>תמונה</th-->
                      <th>שם קורס</th>
                      <th>תוֹאַר</th>
                      <th>שם מוסד</th>
                      <!--th>דֵרוּג</th-->
                      <th>תאריך היצירה</th>
                      <th>העדכון אחרון</th>
                      <th>מספר המבקרים</th>
                      <th>מספר רכישות</th>
                      <th>רווח </th>
                      <th>מספר הפידבקים</th>
                      <th>עלות מוצר</th>
                      <th>דֵרוּג</th>
                      <th>פעולה</th>
                    </tr>
                  </thead>
                <tbody>
              <?php
              $degree = '';
              $university = '';
              foreach ($simple_courses_data as $index => $value) {
                $degrees = DB::table('degrees')->where('id',$value->degree_id)->pluck('degree_name');
                      if(isset($degrees)){
                          
                          foreach($degrees as $d_name){
                              $degree = $d_name;
                          }
                            }else{
                              $degree = '-';
                            }
                      $universities = DB::table('universities')->where('id',$value->university_id)->pluck('university_name');
                              if(isset($universities)){
                                  foreach($universities as $u_name){
                                   $university = $u_name;   
                                  }
                              }else{
                                $university = '-';
                              }
                      $created_at = $value->created_at;
                      $created_date = $created_at->format('d.m.Y');
                      $updated_at = $value->updated_at;
                      $updated_date = $updated_at->format('d.m.Y');
                ?>
              <tr>
              <td>{{$index + 1}}</td>
              <td>{{$value->course_name}}</td>
              <td>{{$degree}}</td>
              <td>{{$university}}</td>
              <td><span class="badge badge-secondary text-white">{{$created_date}} </span> </td>
              <td><span class="badge badge-secondary text-white">{{$updated_date}} </span> </td>
              <td><span class="badge badge-success text-white">20</span> </td>
              <td><span class="badge badge-success text-white">11</span> </td>
              <td><span class="badge badge-success text-white">23</span> </td>
              <td><span class="badge badge-success text-white">12</span> </td>
              <?php 
              if($value->price == 0){
                $price = 'free';
              }else{
                $price = $value->price;
              }
              ?>
              <td> ₪{{$price}}</td>
              <td><span class="starrating"> <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i></span>
              </td>
              <td>
                <a href="{{route('admin.editproduct').'/'.$value->course_id.'/'.$degree_id.'/'.$university_id}}" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>
                <a href="javascript:void(0)" class="btn btn-xs btn-primary" data-toggle="tooltip" title="לְשַׁכְפֵּל"><i class="fa fa-copy"></i></a>
                <a data-value ="{{$value->course_id}}" class="btn btn-xs btn-danger delete_online_course"><i class="mdi mdi-trash-can"></i></a>
              </td>
            </tr>
          <?php }?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- Marathon listing -->
    <div class="tab-pane " id="grouplesson">
      <div class="table-responsive">
        <table id="basic-datatable1" class="  table table-borderless table-hover table-nowrap table-centered m-0">
          <thead class="thead-light">
            <tr> 
              <th>מזהה מוצר</th>
              <th>שם קורס</th>
              <th>תוֹאַר</th>
              <th>שם מוסד</th>
              <th> שם המדריך  </th>
              <th> תאריך התחלה     </th>
              <th> שעת התחלה   </th>
              <th> מחיר   </th>
              <th>פעולה</th>
            </tr>
          </thead>
        <tbody>
          <?php
            foreach ($simple_courses_data as $index => $value) {
              $degrees = DB::table('degrees')->where('id',$value->degree_id)->pluck('degree_name');
              $instructors = DB::table('instructors')->where('id',$value->instructor_id)->pluck('first_name');
              if(isset($instructors)){
                $instructor_name = $instructors[0];
              }else{
                $instructor_name = '';
              }
              if(isset($degrees)){
                  $degree = $degrees[0];
                }else{
                  $degree = '-';
                }
                $universities = DB::table('universities')->where('id',$value->university_id)->pluck('university_name');
                if(isset($universities)){
                  $university = $universities[0];
                }else{
                  $university = '-';
                }
                $created_at = strtotime($value->start_date);
                $created_date = date('d.m.Y',$created_at);
                $start_at = strtotime($value->start_time);
                $startat = date('h:i A',$start_at);
                ?>
                <tr>
                  <td>{{$index + 1}}</td>
                  <td>מרתון עבור {{$value->course_name}}</td>
                  <td>{{$degree}}</td>
                  <td>{{$university}}</td>
                  <td>{{$instructor_name}}</td>
                  <td><span class="badge badge-secondary text-white">{{$created_date}}</span> </td>
                  <td><span class="badge badge-secondary text-white">{{$startat}} </span> </td>
                  <?php 
              if($value->marathon_price == 0){
                $price = 'free';
              }else{
                $price = '₪'.$value->marathon_price;
              }
              ?>
              <td> {{$price}}</td>
                <td>
                    <a href="{{route('admin.editintensiveproducts').'/'.$value->course_id . '/' . $degree_id . '/'. $university_id}}" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>
            <a href="javascript:void(0)" class="btn btn-xs btn-primary" data-toggle="tooltip" title="לְשַׁכְפֵּל"><i class="fa fa-copy"></i></a>
            <a data-value ="{{$value->course_id}}" class="btn btn-xs btn-danger delete_online_course"><i class="mdi mdi-trash-can"></i></a>
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
</div>
</div>   
<div id="DeleteModal2" class="renewalproduct modal fade" style="direction: rtl;">
    <input type="hidden" name="deletedid" id ="deletedid" value="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100">מחק רשומות</h4>   
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-right">
                <div class="form-group mb-3">
                    <label>סיסמה</label>
                    <input id ="get_password" name="get_passowrd" type="password"  class="form-control" placeholder="הזן את הסיסמה">
                </div>
                <button id = "confirm_password" type="button" class="btn btn-outline-warning waves-effect waves-light">שלח</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function($) {
            $('.delete_online_course').click(function(){
                var id = $(this).attr('data-value');
                $('#deletedid').val(id);
                $('#DeleteModal2').modal('show');

            });
            $("#confirm_password").click(function(e) {
                e.preventDefault();
                var password = $('#get_password').val();
                var deleted_id = $('#deletedid').val();
                $.ajax({
                    url: '{{ route("admin.deleteproduct") }}',
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