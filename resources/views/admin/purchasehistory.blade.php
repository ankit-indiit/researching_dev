@extends('admin.layouts.app')

@section('title', ' היסטוריית רכישות ')
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">משתמשים</a></li>
                                            <li class="breadcrumb-item active">היסטוריית רכישות</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">היסטוריית רכישות</h4>
                                </div>
                            </div>
                        </div> 
                   

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                   <h4 class="header-title  text-right mb-3">היסטוריית עסקאות </h4>
                                    <div class="table-responsive">
                                            <table  id="basic-datatable" class="table  table-hover table-nowrap table-centered m-0">
                                               <thead class="thead-light">
                                                <tr>
                                                    <th>מספר מזהה</th>
                                                    <th>תאריך רכישה</th>
                                                    <th>סוג המוצר</th>
                                                    <th>שם קורס</th>
                                                    <th>תוֹאַר</th>
                                                    <th>שם מוסד </th>
                                                    <th>מחיר </th>
                                                    <th>פעולה</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                    1234
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-secondary text-white">20 Nov 2020 </span>
                                                    </td>
                                                    <td><span class="badge badge-success text-white">שיעור פרטי</span> </td>
                                                      <td>עיצוב גרפי </td>
                                                      <td>B.Tech במדעי המחשב  </td>
                                                      <td>אוניברסיטת וארטון  </td>
                                                       <td>$57</td>
                                                    <td>
                                                        <a href="transaction-detail.php" class="btn btn-xs btn-info"><i class="mdi mdi-eye"></i></a>
                                                       
                                                    </td>
                                                </tr>
                                            <tr>
                                                    <td>
                                                    1235
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-secondary text-white">18 Nov 2020 </span>
                                                    </td>
                                                   <td><span class="badge badge-success text-white">שיעור פרטי</span> </td>
                                                     <td>עיצוב גרפי </td>
                                                      <td>B.Tech במדעי המחשב  </td>
                                                      <td>אוניברסיטת וארטון  </td>
                                                       <td>$35</td>
                                                       
                                                    <td>
                                                        <a href="transaction-detail.php" class="btn btn-xs btn-info"><i class="mdi mdi-eye"></i></a>
                                                       
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td>
                                                    2135
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-secondary text-white">17 Nov 2020 </span>
                                                    </td>
                                                    <td><span class="badge badge-success text-white">שיעור פרטי</span> </td>
                                                    <td>עיצוב גרפי </td>
                                                      <td>B.Tech במדעי המחשב  </td>
                                                      <td>אוניברסיטת וארטון  </td>
                                                       <td>$25</td>

                                                    <td>
                                                        <a href="transaction-detail.php" class="btn btn-xs btn-info"><i class="mdi mdi-eye"></i></a>
                                                       
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td>
                                                    3267
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-secondary text-white">15 Nov 2020 </span>
                                                    </td>
                                                    <td><span class="badge badge-success text-white">שיעור פרטי</span> </td>
                                                     <td>עיצוב גרפי </td>
                                                      <td>B.Tech במדעי המחשב  </td>
                                                      <td>אוניברסיטת וארטון  </td>
                                                       <td>$23</td>
                                                      
                                                    <td>
                                                        <a href="transaction-detail.php" class="btn btn-xs btn-info"><i class="mdi mdi-eye"></i></a>
                                                       
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td>
                                                   4568
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-secondary text-white">13 Nov 2020 </span>
                                                    </td>
                                                   <td><span class="badge badge-success text-white">שיעור פרטי</span> </td>
                                                  <td>עיצוב גרפי </td>
                                                      <td>B.Tech במדעי המחשב  </td>
                                                      <td>אוניברסיטת וארטון  </td>
                                                       <td>$45</td>
                                                        
                                                    <td>
                                                        <a href="transaction-detail.php" class="btn btn-xs btn-info"><i class="mdi mdi-eye"></i></a>
                                                       
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td>
                                                    4588
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-secondary text-white">10 Nov 2020 </span>
                                                    </td>
                                                    <td><span class="badge badge-success text-white">שיעור פרטי</span> </td>
                                                    <td>עיצוב גרפי </td>
                                                      <td>B.Tech במדעי המחשב  </td>
                                                      <td>אוניברסיטת וארטון  </td>
                                                       <td>$38</td>
                                                       
                                                    <td>
                                                        <a href="transaction-detail.php" class="btn btn-xs btn-info"><i class="mdi mdi-eye"></i></a>
                                                       
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
        </div>
@endsection  