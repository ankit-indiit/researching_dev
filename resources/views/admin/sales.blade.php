@extends('admin.layouts.app')

@section('title', ' מכירות ')
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
                                <li class="breadcrumb-item active">מכירות</li>
                            </ol>
                        </div>
                    <h4 class="page-title">מכירות</h4>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box applicationmanage">
                    <h4 class="header-title mb-3 text-right">מכירות</h4>
                    <div class="table-responsive">
                        <table id="basic-datatable"  class="table table-borderless table-hover table-nowrap table-centered m-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>שם המוסד</th>
                                    <th>תוֹאַר</th>
                                    <th>שם המוצר</th>
                                    <th>קוּפּוֹן</th>
                                    <th>הנחה (%)</th>
                                    <th>כמות</th>
                                </tr>
                            </thead>
                        <tbody>
    <?php 
        $degree = array();
        $university = array();
        $degree_name = array();
        $university_name = array();
        $coupon = array();
        $count = 0;
        $course_count =0;
        $newArr = array_count_values($orderedcourses);
        foreach ($courses as $key => $value) {
            $degree = DB::table('degrees')->where('id',$value->degree_id)->pluck('degree_name');
            if(!empty($degree)){
                $degree_name = $degree[0];
              }else{
                $degree_name = '';
              }
            if (array_key_exists($value->course_id, $newArr)) {
                $course_count = $newArr[$value->course_id];
            }
            $university = DB::table('universities')->where('id',$value->university_id)->pluck('university_name');
              if(!empty($university)){
                $university_name = $university[0];
              }else{
                $university_name = '';
              }

            $coupon = DB::table('couponcodes')->where('course_name',$value->course_id)->get();
        ?>
            <tr>
                <td>{{$university_name}}</td>
                <td>{{$degree_name}}</td>
                <td>{{$value->course_name}}</td>
                <td>קופון לקורס אדו</td>
                <td>12%</td>
                <td>{{$course_count}}</td>
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