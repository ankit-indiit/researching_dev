@extends('admin.layouts.app')
@section('title', 'מרתון')
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
                                <li class="breadcrumb-item active">מרתון</li>
                        	</ol>
                        </div>
                    	<h4 class="page-title">מרתון</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body recentuser eventcourse ">
                            <div class="row align-items-center" style="direction:rtl">
                                <div class="col-md-12 text-right">
                                <h4 class="header-title mb-3">מרתון</h4>
                                </div>
                            </div>
                            <div class="tab-pane " id="grouplesson">
                                <div class="table-responsive">
                                    <table id="basic-datatable1" class="  table table-borderless table-hover table-nowrap table-centered m-0">
                                        <thead class="thead-light">
                                            <tr> 
                                                <th>שם קורס</th>
                                                <th>תוֹאַר</th>
                                                <th>מוֹסָד</th>
                                                <th>תאריך שעה</th>
                                                <th>משתמשים רשומים</th>
                                                <th>משתמשים בתשלום</th>
                                                <th>מַדְרִיך</th>
                                                <th>קישור זום (הוכנס לפגישה)</th>
                                                <th>קישור זום (הוכנס לרשומות)</th>
                                                <th>פעולה</th>
                                            </tr>
                                        </thead>
                                            @foreach($marathon_courses as $marathon)
                                            <tr> 
                                                <td>{{ $marathon->course_name }}</td>
                                                <td>{{$marathon->degrees->degree_name}}</td>
                                                <td>{{$marathon->university->university_name}}</td>
                                                <td>@if($marathon->start_date) {{$marathon->start_date}} | {{$marathon->start_time}} - {{$marathon->end_time}} @else - @endif</td>
                                                <td>{{ count($marathon->marathonRegisterUser) }}</td>
                                                <td>{{ count($marathon->marathonPaidUser) }}</td>
                                                <td>@if(isset($marathon->instructors->first_name)) {{ $marathon->instructors->first_name }} @endif</td>
                                                <td>{{$marathon->zoom_link}}</td>
                                                <td>{{$marathon->video_link}}</td>
                                                <td><a href="{{ Route('admin.marathon.show',['id' => $marathon->course_id]) }}"><i class="mdi mdi-eye"></i></a></td>
                                            </tr>  
                                            @endforeach                                      
                                        <tbody>
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
<!--content-->

@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
     
    });
</script>
@endsection