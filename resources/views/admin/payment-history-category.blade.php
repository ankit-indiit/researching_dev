@extends('admin.layouts.app')

@section('title', ' היסטוריית תשלומים ')
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
                                            <li class="breadcrumb-item active">קטגוריית היסטוריית עסקאות</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">קטגוריית היסטוריית עסקאות</h4>
                                </div>
                            </div>
                        </div> 
                   

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box ">  
                                    <div class="row" style="direction:rtl">
                                     <div class="col-md-6 text-right">
                                       <h4 class="header-title  text-right mb-3">קטגוריית היסטוריית עסקאות </h4>
                                     </div>
                                      <div class="col-md-6 text-left text-right">
                                      <div class="form-group mb-3 mx-w-160 float-left">
                                        <label>מַדְרִיך</label>
                                        <select class=" form-control" placeholder="בחר מדריך">
                                         <option >בחר מדריך</option>
                                         <option>דייויד סמית '</option>
                                         <option>ג'יימס ג'ונס</option>
                                         <option>אנדרו פיליפ</option>
                                        </select>
                                    </div>
                                   
                                     </div>
                                    </div>
                                 
                                    <div class="table-responsive">
                                            <table  id="basic-datatable" class="table  table-hover table-nowrap table-centered m-0">
                                               <thead class="thead-light">
                                                <tr>
                                                  
                                                    <th>תאריך תשלום</th>
                                                    <th>שם משתמש</th>
                                                    <th>מספר טלפון</th>
                                                    <th>שם מוסד</th>
                                                    <th>תוֹאַר </th>
                                                    <th>שם קורס</th>
                                                    <th>השיעור הסתיים</th>
                                                    <th>הערות</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                   
                                                    <td>
                                                        <span class="badge badge-secondary text-white">1.4.20 </span>
                                                    </td>
                                                    <td>
                                                   ג'ון סמית
                                                    </td>
                                                    <td>
                                                    +91 9874563210
                                                    </td>
                                                    <td>
                                                    אוניברסיטת וארטון
                                                    </td>
                                                      <td>B.Tech במדעי המחשב </td>
                                                       <td>כַּלכָּלָנוּת</td>
                                                        <td>
                                                         <div class="dropdown">
                                                            <label class="badge badge-success dropdown-toggle" data-toggle="dropdown">V   <span class="fa fa-caret-down  mr-1"></span></label>
                                                             <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="javascript:void(0)">V </a>
                                                            <a class="dropdown-item" href="javascript:void(0)">X </a>
                                                          </div>
                                                          </div>
                                                        
                                                        </td>
                                                        <td>      לורם איפסום הוא פשוט טקסט דמה</td>
                                                       
                                                </tr>
                                            <tr>
                                                   
                                                    <td>
                                                        <span class="badge badge-secondary text-white">12.25.20 </span>
                                                    </td>
                                                    <td>
                                                  דייויד ג'ונס
                                                    </td>
                                                    <td>
                                                    +91 7889874563
                                                    </td>
                                                    <td>
                                                    אוניברסיטת וארטון
                                                    </td>
                                                      <td>B.Tech במדעי המחשב </td>
                                                      <td>    כַּלכָּלָנוּת</td>
                                                         <td>
                                                             <div class="dropdown">
                                                            <label class="badge badge-success dropdown-toggle" data-toggle="dropdown">X   <span class="fa fa-caret-down  mr-1"></span></label>
                                                             <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="javascript:void(0)">V </a>
                                                            <a class="dropdown-item" href="javascript:void(0)">X </a>
                                                          </div>
                                                          </div>
                                                         
                                                         </td>
                                                        <td>      לורם איפסום הוא פשוט טקסט דמה</td>
                                                </tr>
                                                 <tr>
                                                    
                                                   
                                                    <td>
                                                        <span class="badge badge-secondary text-white">12.22.20</span>
                                                    </td>
                                                    <td>
                                                  אנדרו סמית '
                                                    </td>
                                                    <td>
                                                    +91 9874563210
                                                    </td>
                                                    <td>
                                                    אוניברסיטת וארטון
                                                    </td>
                                                      <td>B.Tech במדעי המחשב </td>
                                                      <td>  עיצוב גרפי</td>
                                                      <td> <div class="dropdown">
                                                            <label class="badge badge-success dropdown-toggle" data-toggle="dropdown">V   <span class="fa fa-caret-down  mr-1"></span></label>
                                                             <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="javascript:void(0)">V </a>
                                                            <a class="dropdown-item" href="javascript:void(0)">X </a>
                                                          </div>
                                                          </div></td>
                                                       <td>   לורם איפסום הוא פשוט טקסט דמה</td>
                                                         
                                                </tr>
                                                 <tr>
                                                    
                                                    <td>
                                                        <span class="badge badge-secondary text-white">12.17.20</span>
                                                    </td>
                                                    <td>
                                                 אדם ג'יימס
                                                    </td>
                                                    <td>
                                                    +91 9874563210
                                                    </td>
                                                    <td>
                                                    אוניברסיטת וארטון
                                                    </td>
                                                      <td>B.Tech במדעי המחשב </td>
                                                       <td> עיצוב גרפי</td>
                                                         <td> <div class="dropdown">
                                                            <label class="badge badge-success dropdown-toggle" data-toggle="dropdown">X   <span class="fa fa-caret-down  mr-1"></span></label>
                                                             <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="javascript:void(0)">V </a>
                                                            <a class="dropdown-item" href="javascript:void(0)">X </a>
                                                          </div>
                                                          </div></td>
                                                        <td>      לורם איפסום הוא פשוט טקסט דמה</td>
                                                       
                                                </tr>
                                                 <tr>
                                                   
                                                    <td>
                                                        <span class="badge badge-secondary text-white">12.14.20</span>
                                                    </td>
                                                    <td>
                                                  סטיב ג'ונס
                                                    </td>
                                                    <td>
                                                    +91 9874563210
                                                    </td>
                                                    <td>
                                                    אוניברסיטת וארטון
                                                    </td>
                                                      <td>B.Tech במדעי המחשב </td>
                                                       <td>   כַּלכָּלָנוּת</td>
                                                       <td> <div class="dropdown">
                                                            <label class="badge badge-success dropdown-toggle" data-toggle="dropdown">V   <span class="fa fa-caret-down  mr-1"></span></label>
                                                             <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="javascript:void(0)">V </a>
                                                            <a class="dropdown-item" href="javascript:void(0)">X </a>
                                                          </div>
                                                          </div></td>
                                                       <td>   לורם איפסום הוא פשוט טקסט דמה</td>
                                                          
                                                </tr>
                                                 <tr>
                                                  
                                                    <td>
                                                        <span class="badge badge-secondary text-white">12.10.20</span>
                                                    </td>
                                                    <td>
                                                  ג'יימס פיליפ
                                                    </td>
                                                    <td>
                                                    +91 874562108
                                                    </td>
                                                    <td>
                                                    אוניברסיטת וארטון
                                                    </td>
                                                      <td>B.Tech במדעי המחשב</td>
                                                       <td>עיצוב גרפי </td>
                                                       <td> <div class="dropdown">
                                                            <label class="badge badge-success dropdown-toggle" data-toggle="dropdown">X   <span class="fa fa-caret-down  mr-1"></span></label>
                                                             <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="javascript:void(0)">V </a>
                                                            <a class="dropdown-item" href="javascript:void(0)">X </a>
                                                          </div>
                                                          </div></td>
                                                         <td>     לורם איפסום הוא פשוט טקסט דמה</td>
                                                          
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
        </div>
    @endsection
    @section('scripts')
       <script>$(document).ready(function() {
            $('.basic-datepicker ').flatpickr()
        });
        </script>
        @endsection