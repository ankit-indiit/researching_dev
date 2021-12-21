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
                    	<h4 class="page-title"><a href="{{ Route('admin.marathon') }}">מרתון</a></h4>
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
                                <h4 class="header-title mb-3">סטטיסטיקה של מרתון</h4>
                                </div>
                            </div>
                            <div class="tab-pane " id="grouplesson">
                                <div class="table-responsive">
                                    <table id="basic-datatable1" class="  table table-borderless table-hover table-nowrap table-centered m-0">
                                        <thead class="thead-light">
                                            <tr> 
                                                <th>שם משתמש</th>
                                                <th>כתובת דוא"ל</th>
                                                <th>מספר פלאפון</th>
                                                <th>שילמו עבור המרתון?</th>
                                                <th>שולם בעבר עבור שירות כלשהו באתר?</th>
                                               
                                            </tr>
                                        </thead>
                                            @foreach($marathons as $marahon)
                                            <tr> 
                                                <td>{{$marahon->user->full_name}}</td>
                                                <td>{{$marahon->user->email}}</td>
                                                <td>{{$marahon->user->contact_number}}</td>
                                                <td>@if($marahon->is_paid == 1) Yes @else No @endif</td>
                                                <td>{{ $marahon->previouslyPaid() }}</td>
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