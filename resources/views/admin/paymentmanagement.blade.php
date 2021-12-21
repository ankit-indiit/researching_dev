@extends('admin.layouts.app')

@section('title', ' עלינו   ')
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
                <li class="breadcrumb-item active">שניהול תשלום</li>
              </ol>
            </div>
            <h4 class="page-title">שניהול תשלום</h4>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">
          <div class="card-box ">
            <div class="row" style="direction:rtl">
              <div class="col-md-6  text-right">
                 <h4 class="header-title mb-3">ניהול תשלום </h4
              </div>
              
            </div>
                        <div class="table-responsive">
                <table  class="table table-borderless table-hover table-nowrap table-centered m-0 dataTable no-footer">

                                            <thead class="thead-light">
                                               <tr>
                                                   
                                                    <th>מספר תעודת זהות</th>
                                                    <th>קהודעה</th>
                                                  <th>זְמַן</th>
                                                    <!--<th>נוף</th>-->
	
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr role="row">
                                                    <td >
                                                      
                                                      #1212
                                                    </td>
    
                                                    <td >
                                                       לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה.
                                                        
                                                    </td>
    
                                                    
    
                                                    <td>
                                                      <p class="mb-0 text-muted"><small>2Jan 2021 at 9:00 am</small></p>
                                                    </td>
                                                    <td>
                                                     <!--<a href="{{route('admin.pendingmessage')}}" data-toggle="tooltip" title="" class="btn btn-xs btn-info" data-original-title="תצוגת הקבלה"><i class="mdi mdi-eye"></i></a>-->
                                                    </td>
                                                       
                                                    
                                                </tr>
                                                    <tr role="row">
                                                    <td >
                                                     #1234
                                                    </td>
    
                                                    <td >
                                                       לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה.
                                                        
                                                    </td>
    
                                                    
    
                                                    <td>
                                                        <p class="mb-0 text-muted"><small>2Jan 2021 at 9:00 am</small></p>
                                                    </td>
                                                    <td>
                                                     <!--<a href="{{route('admin.programmingerror')}}" data-toggle="tooltip" title="" class="btn btn-xs btn-info" data-original-title="תצוגת הקבלה"><i class="mdi mdi-eye"></i></a>-->
                                                    </td>
                                                       
                                                    
                                                </tr>
                                           
                                                
                                              

                                            </tbody>
                                        </table>
                                    </div>
          </div>
        </div> 
      </div>
    </div>
  </div>
</div>
@endsection