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
                    <form class="app-search">
                        <div class="app-search-box dropdown">
                            <div class="input-group">  
                                <div class="input-group-append">
                                    <button class="btn" type="submit">
                                        <i class="fe-search"></i>
                                    </button>
                                </div>
                                <input type="search" class="form-control" placeholder="לחפש..." id="top-search">
                            </div>
                        </div>
                    </form>
                </li>
                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fe-bell noti-icon"></i>
                        <span class="badge badge-danger rounded-circle noti-icon-badge">9</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left dropdown-lg">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="m-0">
                                <span class="float-right">
                                    <a href="#" class="text-dark">
                                        <small>נקה הכל</small>
                                    </a>
                                </span>הוֹדָעָה
                            </h5>
                        </div>
                        <div class="noti-scroll" data-simplebar>
                        <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                <div class="notify-icon">
                                    <img src="{{ asset('/assets/admin/images/users/user-1.jpg') }}" class="img-fluid rounded-circle" alt="" /> 
                                </div>
                                <p class="notify-details">כריסטינה גאווה</p>
                                <p class="text-muted mb-0 user-msg">
                                    <small>היי, מה שלומך? מה עם הפגישה הבאה שלנו</small>
                                </p>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-primary">
                                    <i class="mdi mdi-comment-account-outline"></i>
                                </div>
                                <p class="notify-details"> הגיב על מנהל המערכת  כלב פלאקלר
                                    <small class="text-muted">1 min ago</small>
                                </p>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon">
                                    <img src="{{ asset('/assets/admin/images/users/user-4.jpg') }}" class="img-fluid rounded-circle" alt="" /> 
                                </div>
                                <p class="notify-details">כריסטינה גאווה</p>
                                <p class="text-muted mb-0 user-msg">
                                    <small>וואו הלורם הזה נראה פורם ואמט של דולס</small>
                                </p>
                            </a>
                            <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-warning">
                                            <i class="mdi mdi-account-plus"></i>
                                        </div>
                                        <p class="notify-details">כריסטינה גאווה
                                            <small class="text-muted">5 hours ago</small>
                                        </p>
                                    </a>
    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-info">
                                            <i class="mdi mdi-comment-account-outline"></i>
                                        </div>
                                        <p class="notify-details">כריסטינה גאווה
                                            <small class="text-muted">4 days ago</small>
                                        </p>
                                    </a>
    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-secondary">
                                            <i class="mdi mdi-heart"></i>
                                        </div>
                                        <p class="notify-details">כריסטינה גאווה
                                            <b>מנהל</b>
                                            <small class="text-muted">13 days ago</small>
                                        </p>
                                    </a>
                                </div>
    
                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                   צפה בהכל
                                    <i class="fe-arrow-right"></i>
                                </a>
    
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
                                    <span>פּרוֹפִיל</span>
                                </a>
                                <!-- item-->
                                <a href="{{route('admin.logout')}}" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i>
                                    <span>להתנתק</span>
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
                                    <span> לוּחַ מַחווָנִים </span>
                                </a>
                            </li>
                           <li>
                                <a href="{{route('admin.userslisting')}}">
                                       <i data-feather="users"></i>
                                    <span> משתמשים </span> 
                                </a>
                            </li>
                            
                             <li>
                                <a href="{{route('admin.productslisting')}}">
                                <i data-feather="book"></i>
                                    <span> 
                                        מוצרים באתר
                                    </span>
                                </a>
                            </li>
                             <li>
                                <a href="{{route('admin.blogslisting')}}">
                                    <i data-feather="list"></i>
                                    <span> כל הבלוגים </span>
                                </a>
                            </li>                                   
                           <li>
                                <a href="{{route('admin.showhistory')}}">
                                    <i data-feather="dollar-sign"></i>
                                    <span>היסטוריית עסקאות</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="{{route('admin.showhistorycategory')}}">
                                    <i data-feather="dollar-sign"></i>
                                    <span>קטגוריית היסטוריית תשלומים</span>
                                </a>
                            </li> -->
                             <li>
                                <a href="{{route('admin.application')}}">
                                    <i data-feather="file"></i>
                                    <span>
                                        ניהול פניות
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.couponslisting')}}">
                                    <i data-feather="gift"></i>
                                    <span> קופונים </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.groupedcourses')}}">
                                    <i data-feather="users"></i>
                                    <span> קורסים מקובצים </span>
                                </a>
                            </li> 
                             <li>
                                <a href="{{route('admin.showsales')}}">
                                    <i data-feather="bar-chart-2"></i>
                                    <span> מכירות </span>
                                </a>
                            </li> 
                            
                            <li>
                                <a href="{{route('admin.instructorlisting')}}">
                                       <i data-feather="users"></i>
                                    <span> מַדְרִיך </span> 
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.events')}}">
                                       <i data-feather="calendar"></i>
                                    <span> אירועים </span> 
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.recommendation')}}">
                                    <i data-feather="calendar"></i>
                                     <span> המלצות  </span>
                                </a>
                            </li>
                            <li>
                                <a href="#pages" data-toggle="collapse">
                                    <i data-feather="file"></i>
                                    <span>עמודים</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="pages">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{route('admin.home.setting')}}">דף הבית</a>
                                        </li>
                                        <li>
                                            <a href="{{route('admin.get_aboutus')}}">עלינו</a>
                                        </li>
                                          <li>
                                            <a href="{{route('admin.get_contactus')}}">צור קשר</a>
                                        </li>
                                        </ul>
                                    </div>
                                  </li> 
                                <!-- <li>
                                <a href="{{route('admin.quizlisting')}}">
                                    <i data-feather="help-circle"></i>
                                    <span> חִידוֹן </span>
                                </a>
                            </li> --> 
                            <li>
                                <a href="{{route('admin.questionlisting')}}">
                                    <i data-feather="help-circle"></i>
                                    <span> שאלות</span>
                                </a>
                            </li>                            
                             <li>
                                <a href="{{route('admin.adminprofile')}}">
                                    <i data-feather="user"></i>
                                    <span> פּרוֹפִיל </span>
                                </a>
                            </li>                           
                             <li>
                                <a href="{{route('admin.tickets')}}">
                                    <i data-feather="user"></i>
                                    <span> כרטיסים </span>
                                </a>
                            </li>                        
                             <li>
                                <a href="{{route('admin.package')}}">
                                    <i data-feather="package"></i>
                                    <span>חבילות</span>
                                </a>
                            </li>                       
                             <li>
                                <a href="{{route('admin.marathon')}}">
                                    <i data-feather="book-open"></i>
                                    <span>מרתון</span>
                                </a>
                            </li>              
                            <li>
                                <a href="{{route('admin.marathon.questions')}}">
                                    <i data-feather="book-open"></i>
                                    <span>שאלות למרתון</span>
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
                <h4 class="modal-title w-100">האם אתה בטוח?</h4>    
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>האם אתה באמת רוצה למחוק את הרשומות האלה? לא ניתן לבטל תהליך זה.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">לְבַטֵל</button>
                <button type="button" class="btn btn-danger">לִמְחוֹק</button>
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
<!--jquery ends-->
@yield('scripts')
</body>
 </html>