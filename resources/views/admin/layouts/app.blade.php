<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <title> @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/admin/images/logo-sm.png') }}" >
    <link href="{{ asset('assets/admin/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('assets/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <link href="{{ asset('assets/admin/css/icons.min.css') }}" rel="stylesheet" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/chosen.css') }}">
    <!-- Summernote css -->
    <link href="{{ asset('assets/admin/libs/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css">
 </head>
 <body class="loading">
    <!--header starts-->
<div id ='wrapper'>
    <div class="navbar-custom">
        <div class="container-fluid">
            <ul class="list-unstyled topnav-menu float-left mb-0">
                <li class="d-none d-lg-block">
                    {{-- <form class="app-search">
                        <div class="app-search-box dropdown">
                            <div class="input-group">  
                                <div class="input-group-append">
                                    <button class="btn" type="submit">
                                        <i class="fe-search"></i>
                                    </button>
                                </div>
                                <input type="search" class="form-control" placeholder="????????..." id="top-search">
                            </div>
                        </div>
                    </form> --}}
                </li>
                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fe-bell noti-icon"></i>
                        <span class="badge badge-danger notificationCount rounded-circle noti-icon-badge">{{ count($admin_notify) }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left dropdown-lg">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="m-0">
                                <span class="float-right">
                                    @if(count($admin_notify) > 0 )
                                    <a href="javascript:void(0);" class="text-dark clearNotification">
                                        <small>?????? ??????</small>
                                    </a>
                                    @endif
                                </span>????????????????
                            </h5>
                        </div>
                        <div class="noti-scroll notificationSec" data-simplebar>
                        <!-- item-->
                            @if(count($admin_notify) > 0 )
                                @foreach($admin_notify as $notification)
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-primary">
                                        <i class="mdi mdi-comment-account-outline"></i>
                                    </div>
                                    <p class="notify-details"> {{ $notification->content }}
                                        <small class="text-muted">{{ Carbon\Carbon::parse($notification->created_at)->diffForHumans()}} </small>
                                    </p>
                                </a>                             
                                @endforeach
                                 <!-- All-->
                                 <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                    
                                </a>                                 
                            @else  
                                <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                    <div class="">
                                       
                                    </div>
                                    <p class="notify-details"> 
                                        ???? ?????????? ??????????!
                                    </p>
                                </a>                           
                            @endif
                        </div>
    
                    </div>
                        </li>
                         <li class="dropdown notification-list topbar-dropdown">
                            <?php 
                            if(Session :: has ('admin_logged_in') || !empty (Session :: get ('admin_logged_in'))){
                                $admin_id = session()->get('id');
                                $admin_data = DB::table('admins')->where('id',$admin_id)->get();
                                foreach ($admin_data as $value) {
                                   $image =  asset('/assets/users/' .$value->image);
                                
                                
                                ?>
                            
                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{ $image }}" alt="user-image" class="rounded-circle">
                                <span class="pro-user-name ml-1">
                                   {{$value->name}}<i class="mdi mdi-chevron-down"></i> 
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left profile-dropdown ">
                                <div class="dropdown-divider"></div>
                                <a href="{{route('admin.adminprofile')}}" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span>??????????????????</span>
                                </a>
                                <!-- item-->
                                <a href="{{route('admin.logout')}}" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i>
                                    <span>????????????</span>
                                </a>
    
                            </div>
                        </li>
                          <?php }}?>
                    </ul>
    
                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="{{route('admin.dashboard')}}" class="logo logo-dark text-center">
                            <span class="logo-sm">
                                <img src="{{ asset('/assets/admin/images/logo-sm.png') }}" alt="" height="50">
                              
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('/assets/admin/images/logo-dark.png') }}" alt="" height="50">
                             
                            </span>
                        </a>
    
                        <a href="{{route('admin.dashboard')}}" class="logo logo-light text-center">
                            <span class="logo-sm">
                                <img src="{{ asset('/assets/admin/images/logo-sm.png') }}" alt="" height="50">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('/assets/admin/images/logo-light.png') }}" alt="" height="50">
                            </span>
                        </a>
                    </div>
                    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                        <li>
                            <button class="button-menu-mobile waves-effect waves-light">
                                <i class="fe-menu"></i>
                            </button>
                        </li>
                        <li>
                            <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                        </li>   
                   </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="left-side-menu">
                <div class="h-100" data-simplebar>
                    <div id="sidebar-menu">
                        <ul id="side-menu">
                            <li class="menu-title">Navigation</li>
                            <li>
                                <a href="{{route('admin.dashboard')}}">
                                    <i data-feather="home"></i>
                                    <span> ?????????? ???????????????????? </span>
                                </a>
                            </li>
                           <li>
                                <a href="{{route('admin.userslisting')}}">
                                       <i data-feather="users"></i>
                                    <span> ?????????????? </span> 
                                </a>
                            </li>
                            
                             <li>
                                <a href="{{route('admin.productslisting')}}">
                                <i data-feather="book"></i>
                                    <span> 
                                        ???????????? ????????
                                    </span>
                                </a>
                            </li>
                             <li>
                                <a href="{{route('admin.blogslisting')}}">
                                    <i data-feather="list"></i>
                                    <span> ???? ?????????????? </span>
                                </a>
                            </li>                                   
                           <li>
                                <a href="{{route('admin.showhistory')}}">
                                    <i data-feather="dollar-sign"></i>
                                    <span>?????????????????? ????????????</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="{{route('admin.showhistorycategory')}}">
                                    <i data-feather="dollar-sign"></i>
                                    <span>???????????????? ?????????????????? ??????????????</span>
                                </a>
                            </li> -->
                             <li>
                                <a href="{{route('admin.application')}}">
                                    <i data-feather="file"></i>
                                    <span>
                                        ?????????? ??????????
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.couponslisting')}}">
                                    <i data-feather="gift"></i>
                                    <span> ?????????????? </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.groupedcourses')}}">
                                    <i data-feather="users"></i>
                                    <span> ???????????? ?????????????? </span>
                                </a>
                            </li> 
                             <li>
                                <a href="{{route('admin.showsales')}}">
                                    <i data-feather="bar-chart-2"></i>
                                    <span> ???????????? </span>
                                </a>
                            </li> 
                            
                            <li>
                                <a href="{{route('admin.instructorlisting')}}">
                                       <i data-feather="users"></i>
                                    <span> ???????????????? </span> 
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.events')}}">
                                       <i data-feather="calendar"></i>
                                    <span> ?????????????? </span> 
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.recommendation')}}">
                                    <i data-feather="calendar"></i>
                                     <span> ????????????  </span>
                                </a>
                            </li>
                            <li>
                                <a href="#pages" data-toggle="collapse">
                                    <i data-feather="file"></i>
                                    <span>????????????</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="pages">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{route('admin.home.setting')}}">???? ????????</a>
                                        </li>
                                        <li>
                                            <a href="{{route('admin.get_aboutus')}}">??????????</a>
                                        </li>
                                          <li>
                                            <a href="{{route('admin.get_contactus')}}">?????? ??????</a>
                                        </li>
                                        </ul>
                                    </div>
                                  </li> 
                                <!-- <li>
                                <a href="{{route('admin.quizlisting')}}">
                                    <i data-feather="help-circle"></i>
                                    <span> ?????????????? </span>
                                </a>
                            </li> --> 
                            <li>
                                <a href="{{route('admin.questionlisting')}}">
                                    <i data-feather="help-circle"></i>
                                    <span> ??????????</span>
                                </a>
                            </li>                            
                             <li>
                                <a href="{{route('admin.adminprofile')}}">
                                    <i data-feather="user"></i>
                                    <span> ?????????????????? </span>
                                </a>
                            </li>                           
                             <li>
                                <a href="{{route('admin.tickets')}}">
                                    <i data-feather="user"></i>
                                    <span> ?????????????? </span>
                                </a>
                            </li>                        
                             <li>
                                <a href="{{route('admin.package')}}">
                                    <i data-feather="package"></i>
                                    <span>????????????</span>
                                </a>
                            </li>                       
                             <li>
                                <a href="{{route('admin.marathon')}}">
                                    <i data-feather="book-open"></i>
                                    <span>??????????</span>
                                </a>
                            </li>              
                            <li>
                                <a href="{{route('admin.marathon.questions')}}">
                                    <i data-feather="alert-circle"></i>
                                    <span>?????????? ????????????</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.advance_notification')}}">
                                    <i data-feather="alert-octagon"></i>
                                    <span>????????????</span>
                                </a>
                            </li>                            
                            </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
    
</div>
    <!--header ends -->
    <div id="myDeleteModal" class="deletemodal modal fade">
        <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="fas fa-times"></i>
                </div>                      
                <h4 class="modal-title w-100">?????? ?????? ?????????</h4>    
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>?????? ?????? ???????? ???????? ?????????? ???? ?????????????? ????????? ???? ???????? ???????? ?????????? ????.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">??????????????</button>
                <button type="button" class="btn btn-danger">????????????????</button>
            </div>
        </div>
    </div>
</div>
    <!--content-->
      @yield('content')
    <!--content ends-->
<footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12  text-center">
                               &copy;Copyright 2021 Researching. All Rights Reserved
                            </div>
                          
                        </div>
                    </div>
                </footer>
<!-- End Footer -->
<!--extra starts-->
<div class="rightbar-overlay"></div>
<!--extra ends -->
<!-- jQuery Frameworks -->
<link href="{{ asset('assets/admin/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

<script src="{{ asset('assets/admin/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/pages/datatables.init.js') }}"></script>
<script src="{{ asset('assets/admin/js/app.min.js') }}" ></script>
<script src="{{ asset('assets/admin/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/datatables.net-buttons/js/jszip.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/datatables.net-buttons/js/buttons.html5.min2.js') }}"></script>

<script src="{{ asset('assets/admin/libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/summernote/summernote-bs4.min.js') }}" ></script>
<script src="{{ asset('assets/admin/js/pages/form-summernote.init.js') }}"></script>
<script src="{{ asset('assets/admin/js/chosen.jquery.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/init.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('assets/admin/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/pages/form-pickers.init.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
 <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js'></script>
 <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>
 <script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});

$(document).on('click','.clearNotification',function(e){
    e.preventDefault();
    var result = confirm("Are you sure? Want to clear all notification ?");
    if (result) {
        $.ajax({
            url:"{{ Route('admin.clear_notification') }}",
            type: 'DELETE',
            success:function(data) {
                var html = '<a href="javascript:void(0);" class="dropdown-item notify-item active">'+
                            '<div class=""></div>'+
                            '<p class="notify-details"> ???? ?????????? ??????????!</p></a>';
                $('.notificationSec').html(html);
                $('.notificationCount').text(0);
            }
        });
    }
});
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.basic-datepicker ').flatpickr()
  });
</script>
<script type="text/javascript">
$(function() {
    $(".chzn-select").chosen();
});
</script>
<script>
    $("#upload_docs_btnssss").click(function(e) {
        e.preventDefault(); 
        $.ajax({
            url: '{{ route('admin.stroedata') }}',
            type: 'POST',
            data:new FormData($("#upload-docs-form")[0]),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) { 
                window.location.reload();
            }
        });
    });
</script>
<!--jquery ends-->
@yield('scripts')
</body>
 </html>