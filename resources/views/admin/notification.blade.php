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
                                            <li class="breadcrumb-item active">התראות</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">התראות</h4>
                                </div>
                            </div>
                        </div> 
                   

                       <div class="row">
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

                </div> <!-- content -->
                    </div>
                </div>
            </div>
        </div>
        @endsection