@extends('admin.layouts.app')

@section('title', ' הוֹדָעָה  ')
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
                                            <li class="breadcrumb-item active">הוֹדָעָה</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">הוֹדָעָה</h4>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                           
                            <div class="col-xl-3 col-lg-4">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="media mb-3">
                                            <img src="{{ asset('/assets/admin/images/users/user-1.jpg') }}" class="mr-2 rounded-circle" height="42" alt="Brandon Smith">
                                            <div class="media-body">
                                                <h5 class="mt-0 mb-0 font-15">
                                                    <a href="#" class="text-reset">ז'נבה מקנייט</a>
                                                </h5>
                                                <p class="mt-1 mb-0 text-muted font-14">
                                                    <small class="mdi mdi-circle text-primary"></small> באינטרנט
                                                </p>
                                            </div>
                                            <div>
                                                <a href="javascript: void(0);" class="text-reset font-20">
                                                    <i class="mdi mdi-cog-outline"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- start search box -->
                                        <form class="search-bar mb-3">
                                            <div class="position-relative">
                                                <input type="text" class="form-control form-control-light" placeholder="לחפש...">
                                                <span class="mdi mdi-magnify"></span>
                                            </div>
                                        </form>
                                  
                                       
                                        <div class="row">
                                            <div class="col">
                                                <div data-simplebar style="max-height: 375px">
                                                    <a href="javascript:void(0);" class="text-body">
                                                        <div class="media p-2">
                                                            <img src="{{ asset('/assets/admin/images/users/user-2.jpg') }}"class="mr-2 rounded-circle" height="42" alt="Brandon Smith" />
                                                            <div class="media-body">
                                                                <h5 class="mt-0 mb-0 font-14">
                                                                    <span class="float-right text-muted font-weight-normal font-12">4:30am</span>
                                                                   ברנדון סמית '
                                                                </h5>
                                                                <p class="mt-1 mb-0 text-muted font-14">
                                                                    <span class="w-25 float-right text-right"><span class="badge badge-soft-danger">3</span></span>
                                                                    <span class="w-75">מה שלומך היום?</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="javascript:void(0);" class="text-body">
                                                        <div class="media p-2">
                                                            <img src="{{ asset('/assets/admin/images/users/user-5.jpg') }}" class="mr-2 rounded-circle" height="42" alt="James Z" />
                                                            <div class="media-body">
                                                                <h5 class="mt-0 mb-0 font-14">
                                                                    <span class="float-right text-muted font-weight-normal font-12">5:30am</span>
                                                                   ג'יימס זי
                                                                </h5>
                                                                <p class="mt-1 mb-0 text-muted font-14">
                                                                    <span class="w-75">מה שלומך היום...</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="javascript:void(0);" class="text-body">
                                                        <div class="media p-2">
                                                            <img src="{{ asset('/assets/admin/images/users/user-7.jpg') }}" class="mr-2 rounded-circle" height="42" alt="Maria C" />
                                                            <div class="media-body">
                                                                <h5 class="mt-0 mb-0 font-14">
                                                                    <span class="float-right text-muted font-weight-normal font-12">Thu</span>
                                                                   מריה סי
                                                                </h5>
                                                                <p class="mt-1 mb-0 text-muted font-14">
                                                                    <span class="w-25 float-right text-right"><span class="badge badge-soft-danger">2</span></span>
                                                                    <span class="w-75">Aמה שלומך היום?</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="javascript:void(0);" class="text-body">
                                                        <div class="media bg-light p-2">
                                                            <img src="{{ asset('/assets/admin/images/users/user-10.jpg') }}"
                                                                class="mr-2 rounded-circle" height="42" alt="Rhonda D" />
                                                            <div class="media-body">
                                                                <h5 class="mt-0 mb-0 font-14">
                                                                    <span class="float-right text-muted font-weight-normal font-12">Wed</span>
                                                                   רונדה ד
                                                                </h5>
                                                                <p class="mt-1 mb-0 text-muted font-14">
                                                                    <span class="w-75">מה שלומך היום?</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="javascript:void(0);" class="text-body">
                                                        <div class="media p-2">
                                                            <img src="{{ asset('/assets/admin/images/users/user-3.jpg') }}" 
                                                                class="mr-2 rounded-circle" height="42" alt="Michael H" />
                                                            <div class="media-body">
                                                                <h5 class="mt-0 mb-0 font-14">
                                                                    <span class="float-right text-muted font-weight-normal font-12">Tue</span>
                                                                 מייקל ה
                                                                </h5>
                                                                <p class="mt-1 mb-0 text-muted font-14">
                                                                    <span class="w-75">מה שלומך היום?</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="javascript:void(0);" class="text-body">
                                                        <div class="media p-2">
                                                            <img src="{{ asset('/assets/admin/images/users/user-6.jpg') }}" 
                                                                class="mr-2 rounded-circle" height="42" alt="Thomas R" />
                                                            <div class="media-body">
                                                                <h5 class="mt-0 mb-0 font-14">
                                                                    <span class="float-right text-muted font-weight-normal font-12">Tue</span>
                                                                   תומאס ר
                                                                </h5>
                                                                <p class="mt-1 mb-0 text-muted font-14">
                                                                    <span class="w-75">מה שלומך היום?</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="javascript:void(0);" class="text-body">
                                                        <div class="media p-2">
                                                            <img src="{{ asset('/assets/admin/images/users/user-8.jpg') }}"
                                                                class="mr-2 rounded-circle" height="42" alt="Thomas J" />
                                                            <div class="media-body">
                                                                <h5 class="mt-0 mb-0 font-14">
                                                                    <span class="float-right text-muted font-weight-normal font-12">Tue</span>
                                                                    תומאס ג'יי
                                                                </h5>
                                                                <p class="mt-1 mb-0 text-muted font-14">
                                                                    <span class="w-75">מה שלומך היום?</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="javascript:void(0);" class="text-body">
                                                        <div class="media p-2">
                                                            <img src="{{ asset('/assets/admin/images/users/user-4.jpg') }}"
                                                                class="mr-2 rounded-circle" height="42" alt="Ricky J" />
                                                            <div class="media-body">
                                                                <h5 class="mt-0 mb-0 font-14">
                                                                    <span class="float-right text-muted font-weight-normal font-12">Mon</span>
                                                                        ריקי ג'יי
                                                                </h5>
                                                                <p class="mt-1 mb-0 text-muted font-14">
                                                                    <span class="w-75">מה שלומך היום?</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>

                                                </div> 
                                            </div> 
                                        </div>
                                    </div>
                                </div> 
                            </div>
                         
                            <div class="col-xl-9 col-lg-8">

                                <div class="card">
                                    <div class="card-body py-2 px-3 border-bottom border-light">
                                        <div class="media py-1">
                                            <img src="{{ asset('/assets/admin/images/users/user-5.jpg') }}" class="mr-2 rounded-circle" height="36" alt="Brandon Smith">
                                            <div class="media-body">
                                                <h5 class="mt-0 mb-0 font-15">
                                                    <a href="#" class="text-reset">ג'יימס זאבל</a>
                                                </h5>
                                                <p class="mt-1 mb-0 text-muted font-12">
                                                    <small class="mdi mdi-circle text-primary"></small> באינטרנט
                                                </p>
                                            </div>
                                        
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <ul class="conversation-list" data-simplebar style="max-height: 310px">
                                            <li class="clearfix">
                                                <div class="chat-avatar">
                                                    <img src="{{ asset('/assets/admin/images/users/user-5.jpg') }}" class="rounded" alt="James Z" />
                                                    <i>10:00</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>ג'יימס זי</i>
                                                        <p>
                                                           שלום!
                                                        </p>
                                                    </div>
                                                </div>
                                               
                                            </li>
                                            <li class="clearfix odd">
                                                <div class="chat-avatar">
                                                    <img src="{{ asset('/assets/admin/images/users/user-1.jpg') }}" class="rounded" alt="Geneva M" />
                                                    <i>10:01</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>ז'נבה מ</i>
                                                        <p>
                                                           היי, מה שלומך? מה עם הפגישה הבאה שלנו?
                                                        </p>
                                                    </div>
                                                </div>
                                              
                                            </li>
                                            <li class="clearfix">
                                                <div class="chat-avatar">
                                                    <img src="{{ asset('/assets/admin/images/users/user-5.jpg') }}" class="rounded" alt="James Z" />
                                                    <i>10:01</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>ג'יימס זי</i>
                                                        <p>
                                                          כן הכל בסדר
                                                        </p>
                                                    </div>
                                                </div>
                                               
                                            </li>
                                            <li class="clearfix odd">
                                                <div class="chat-avatar">
                                                    <img src="{{ asset('/assets/admin/images/users/user-1.jpg') }}" class="rounded" alt="Geneva M" />
                                                    <i>10:02</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>ז'נבה מ</i>
                                                        <p>
                                                           וואו זה נהדר
                                                        </p>
                                                    </div>
                                                </div>
                                              
                                            </li>
                                            <li class="clearfix">
                                                <div class="chat-avatar">
                                                    <img src="{{ asset('/assets/admin/images/users/user-5.jpg') }}" alt="James Z" class="rounded" />
                                                    <i>10:02</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>ג'יימס זי</i>
                                                        <p>
                                                         שיהיה לנו היום אם אתה חופשי
                                                        </p>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            <li class="clearfix odd">
                                                <div class="chat-avatar">
                                                    <img src="{{ asset('/assets/admin/images/users/user-1.jpg') }}" alt="Geneva M" class="rounded" />
                                                    <i>10:03</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>ז'נבה מ</i>
                                                        <p>
                                                          היי, מה שלומך? מה עם הפגישה הבאה שלנו?
                                                        </p>
                                                    </div>
                                                </div>
                                              
                                            </li>
                                            <li class="clearfix">
                                                <div class="chat-avatar">
                                                    <img src="{{ asset('/assets/admin/images/users/user-5.jpg') }}" alt="James Z" class="rounded" />
                                                    <i>10:04</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>ז'נבה מ</i>
                                                        <p>
                                                          היי, מה שלומך? מה עם הפגישה הבאה שלנו?
                                                        </p>
                                                    </div>
                                                </div>
                                               
                                            </li>
                                            <li class="clearfix">
                                                <div class="chat-avatar">
                                                    <img src="{{ asset('/assets/admin/images/users/user-5.jpg') }}" alt="James Z" class="rounded" />
                                                    <i>10:04</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>ג'יימס זי</i>
                                                        <p>
                                                       היי, מה שלומך? מה עם הפגישה הבאה שלנו
                                                        </p>
                                                    </div>
                                                </div>
                                               
                                            </li>
                                          
                                        </ul>

                                        <div class="row">
                                            <div class="col">
                                                <div class="mt-2 bg-light p-3 rounded">
                                                    <form class="needs-validation" novalidate="" name="chat-form"
                                                        id="chat-form">
                                                        <div class="row">
                                                            <div class="col mb-2 mb-sm-0">
                                                                <input type="text" class="form-control border-0" placeholder="הזן את הטקסט שלך" required="">
                                                                
                                                            </div>
                                                            <div class="col-sm-auto">
                                                                <div class="btn-group">
                                                                    <a href="#" class="btn btn-light"><i class="fe-paperclip"></i></a>
                                                                    <button type="submit" class="btn btn-primary  chat-send btn-block"><i class='fe-send'></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end chat area-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection