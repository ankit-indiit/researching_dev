@extends('admin.layouts.app')

@section('title', ' אינדקס  ')
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
                                <li class="breadcrumb-item active">לוּחַ מַחווָנִים</li>
                            </ol>
                        </div>
                        <h4 class="page-title">לוּחַ מַחווָנִים</h4>
                    </div>
                </div>
            </div> 
            <div class="row align-items-center">
                <div class="col-6">
                    <div id="reportrange" >
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                </div>
            </div>        
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="card-box p-2">
                        <div class="row">
                            <div class="col-8">
                                <div class="text-right">
                                    <h3 class="my-1"><span id ="visitors_count"data-plugin="counterup">{{$visitors}}</span></h3>
                                    <p class="text-muted mb-1 text-truncate"> מספר כניסות לאתר </p>
                                </div>
                            </div> 
                            <div class="col-4">
                                <div class="avatar-sm bg-blue rounded mr-auto">
                                <i class="fe-users avatar-title font-22 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card-box-->
                </div> <!-- end col -->
                <div class="col-md-6 col-lg-3">
                    <div class="card-box p-2">
                        <div class="row">
                            <div class="col-8">
                                <div class="text-right">
                                    <h3 class="my-1"><span id ="registered_users_count" data-plugin="counterup">{{$registered_users}}</span></h3>
                                    <p class="text-muted mb-1 text-truncate"> משתמשים שנרשמו </p>
                                </div>
                            </div> 
                            <div class="col-4">
                                <div class="avatar-sm bg-success rounded mr-auto">
                                <i class="fe-shopping-cart avatar-title font-22 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-box-->
            </div> <!-- end col -->
            <div class="col-md-6 col-lg-3">
                <div class="card-box p-2">
                    <div class="row">
                        <div class="col-8">
                            <div class="text-right">
                                <h3 class="my-1"><span id ="paid_users_count" data-plugin="counterup">{{$count_users}}</span></h3>
                                <p class="text-muted mb-1 text-truncate"> משתמשים שנרשמו ורכשו   </p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="avatar-sm bg-danger rounded mr-auto">
                                <i class="fe-thumbs-up  avatar-title font-22 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-box-->
            </div> <!-- end col -->
            <div class="col-md-6 col-lg-3">
                <div class="card-box p-2">
                    <div class="row">
                        <div class="col-8">
                            <div class="text-right">
                                <h3 class="my-1">₪<span id ="total_income_count" data-plugin="counterup">{{$total_income}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">רהכנסה כוללת    </p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="avatar-sm bg-info rounded mr-auto">
                            <i class="fe-pie-chart avatar-title font-22 text-white"></i>
                        </div>
                    </div>
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col -->
    </div>
<!--alert section start-->  
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box ">
                <div class="row" style="direction:rtl">
                    <div class="col-md-6  text-right">
                        <h4 class="header-title mb-3">התראות</h4>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="basic-datatableg" class="table table-borderless table-hover table-nowrap table-centered m-0 dataTable no-footer">
                        <thead class="thead-light">
                            <tr>
                                <th>מספר  מזהה</th>
                                <th>קטגוריה</th>
                                <th>לספור</th>
                                <th>נוף</th>
							</tr>
                        </thead>
                    <tbody>
                    <tr role="row">
                        <td >  1</td>
                        <td >
                                                        הודעה בהמתנה
                                                        
                        </td>
                        <td>
                           {{$total_alert_count}}                        
                        </td>
                        <td>
                            <a href="{{route('admin.pendingmessage')}}" data-toggle="tooltip" title="" class="btn btn-xs btn-info" data-original-title="תצוגת הקבלה"><i class="mdi mdi-eye"></i></a>
                        </td>
                    </tr>
                    <tr role="row">
                        <td >2</td>
                        <td >
                                                      שגיאת תכנות
                        </td>
                        <td>02</td>
                        <td>
                            <a href="{{route('admin.programmingerror')}}" data-toggle="tooltip" title="" class="btn btn-xs btn-info" data-original-title="תצוגת הקבלה"><i class="mdi mdi-eye"></i></a>
                        </td>
                    </tr>
                    <tr role="row">
                        <td >3</td>
                        <td >
                                                       	ניהול תשלום
                                                        
                        </td>
                        <td>
                            25
                        </td>
                        <td>
                            <a href="{{route('admin.paymentmanagement')}}" data-toggle="tooltip" title="" class="btn btn-xs btn-info" data-original-title="תצוגת הקבלה"><i class="mdi mdi-eye"></i></a>
                        </td>
                    </tr>
                    <tr role="row">
                        <td >4</td>
                        <td >
                                                       	אישור תגובה
                                                        
                        </td>
                        <td>
                        32
                        </td>
                        <td>
                            <a href="{{route('admin.responseconfirmation')}}" data-toggle="tooltip" title="" class="btn btn-xs btn-info" data-original-title="תצוגת הקבלה"><i class="mdi mdi-eye"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
    <div class="col-md-12">
        <div class="graph_box">
            <h4 class="header-title mb-3 text-right">קטע גרף</h4>
            <div>
                <canvas id="Graph" style="width:100%;"></canvas>
            </div>
        </div>
    </div> 
</div>

<!--alert section end-->
    <div class="row d-none">
        <div class="col-12">
            <div class="card">
                <div class="card-body" style="direction: rtl;">
                    <h4 class="header-title mb-3 text-right">התראות</h4>
                        <div class="notifications-row">
                            <div class="notifications-img">
                                <img src="{{ asset('/assets/admin/images/users/user-2.jpg') }}" class="">
                            </div>
                            <div class="notifications-text text-right">
                                <div class="notifications-heading">
                                    <h5>מה זה לורם איפסום </h5>
                                </div>
                                <p>לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז שנות ה 1500-, כאשר מדפסת לא ידועה לקחה מטה מסוג וסיבב אותו בכדי ליצור ספר דגימה.</p>
                                <div>
                                    <span><i class="ti-time"></i> 05 Oct 2020 at 4:52 PM</span>
                                </div>
                            </div>
                        </div>
                        <div class="notifications-row">
                            <div class="notifications-img">
                                <img src="{{ asset('/assets/admin/images/users/user-3.jpg') }}" class="">
                            </div>
                            <div class="notifications-text text-right">
                                <div class="notifications-heading">
                                    <h5>מה זה לורם איפסום </h5>
                                </div>
                                <p>לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז שנות ה 1500-, כאשר מדפסת לא ידועה לקחה מטה מסוג וסיבב אותו בכדי ליצור ספר דגימה.</p>
                            <div>
                            <span><i class="ti-time"></i> 05 Oct 2020 at 4:52 PM</span>
                        </div>
                    </div>
                </div>
                <div class="notifications-row">
                    <div class="notifications-img">
                        <img src="{{ asset('/assets/admin/images/users/user-1.jpg') }}" class="">
                    </div>
                    <div class="notifications-text text-right">
                        <div class="notifications-heading">
                            <h5>מה זה לורם איפסום </h5>
                        </div>
                        <p>לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז שנות ה 1500-, כאשר מדפסת לא ידועה לקחה מטה מסוג וסיבב אותו בכדי ליצור ספר דגימה.</p>
                    <div>
                        <span><i class="ti-time"></i> 05 Oct 2020 at 4:52 PM</span>
                    </div>
                </div>
            </div>                                  
        </div>
    </div> 
</div>
</div>
        <div class="row">
            <div class="col-md-3 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-4">
                            <div class="avatar-lg rounded-circle bg-primary border-primary border">
                                <i class="d-flex fa fa-graduation-cap font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="text-right mr-2">
                                <h3 class="mt-1"><span id="degree_count"data-plugin="counterup">{{$degree_count}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">תוֹאַר</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-4">
                            <div class="avatar-lg rounded-circle bg-success border-success border">
                                <i class="mdi mdi-notebook font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="text-right  mr-2">
                                <h3 class="text-dark mt-1"><span id="courses_count" data-plugin="counterup">{{$courses_count}}</span></h3>
                                <p class="text-muted mb-1 text-truncate"> קורסים</p>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div>
            <div class="col-md-3 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-4">
                            <div class="avatar-lg rounded-circle bg-info border-info border"><i class="fe-users font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="text-right mr-2">
                                <h3 class="text-dark mt-1"><span id="users_count" data-plugin="counterup">{{$registered_users}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">משתמשים </p>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div>
            <div class="col-md-3 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-4">
                            <div class="avatar-lg rounded-circle bg-warning border-warning border">
                                <i class="d-flex  fa fa-question-circle font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="text-right mr-2">
                                <h3 class="text-dark mt-1"><span id="quiz_count" data-plugin="counterup"></span></h3>
                                <p class="text-muted mb-1 text-truncate">חִידוֹן</p>
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
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        graphSegment();
        var startDate = $('#reportrange').data('daterangepicker').startDate.format('Y-MM-DD HH:mm:ss');
        var endDate = $('#reportrange').data('daterangepicker').endDate.format('Y-MM-DD HH:mm:ss'); 

        fetch_filter_data(startDate , endDate);

        function fetch_data(from_date = '', to_date = '', is_ajax = '') {
            console.log(from_date);
            console.log(to_date);
        /*$.ajax({
            url:"{{ route('admin.dashboard')}}" + '/' + from_date + '/' + to_date,
            success:function(data) {
                console.log(data);
            }
        });*/
        }

    function fetch_filter_data(from_date = '', to_date = '') {

        $.ajax({
            url:"{{ route('admin.filtered_data')}}" + '/' + from_date + '/' + to_date,
            //  url:"",
            success:function(data) {
                var visitors = data.visitors;
                $('#visitors_count').text(visitors);
                var registered_users = data.registered_users;
                $('#registered_users_count').text(registered_users);
                $('#users_count').text(registered_users);
                var paid_users = data.count_users;
                $('#paid_users_count').text(paid_users);
                var total_income = data.total_income;
                $('#total_income_count').text(total_income);
                var degree_count = data.degree_count;
                $('#degree_count').text(degree_count);
                var courses_count = data.courses_count;
                $('#courses_count').text(courses_count);
                $('#quiz_count').text(data.quiz_count);
            }
        });
    }

    function graphSegment() {
        $.ajax({
            url:"{{ route('admin.graphSegment')}}",
            success:function(data) {
                console.log(data);
                var labels = arrayColumn(data, 'monthname');
                var data = arrayColumn(data, 'count');
                var options = {
                    responsive:true
                };
                var graph = {
                    labels: labels, 
                    datasets: [
                        {
                        label: "Dados primários",
                        fillColor: "rgba(220,220,220,0.3)",
                        strokeColor: "#4d90fe",
                        pointColor: "#4d90fe",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "#4d90fe",
                        data: data 
                        }
                    ]
                };    
                var ctx = document.getElementById("Graph").getContext("2d");
                var LineChart = new Chart(ctx).Line(graph, options);           
            }
        });
    }

    $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        var startdate = picker.startDate.format('YY-MM-DD HH:mm:ss');
        var enddate = picker.endDate.format('YY-MM-DD HH:mm:ss');
        
        fetch_filter_data(startdate , enddate);
    });
    });

    function arrayColumn(array, columnName) {
        return array.map(function(value,index) {
            return value[columnName];
        })
    }
</script>
@endsection