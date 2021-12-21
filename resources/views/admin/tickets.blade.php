@extends('admin.layouts.app')
@section('title', ' כרטיסים ')
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
                        <li class="breadcrumb-item">
                           <a href="javascript: void(0);">בית</a>
                        </li>
                        <li class="breadcrumb-item active">כרטיסים</li>
                     </ol>
                  </div>
                  <h4 class="page-title">כרטיסים</h4>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12">
               <div class="card-box alltickets">
                  <div class="row" style="direction:rtl">
                     <div class="col-md-12  text-right">
                        <h4 class="header-title mb-3">כל הכרטיסים </h4>
                     </div>
                  </div>
                  <div class="table-responsive">
                     <table id="basic-datatable"  class="table  table-hover table-nowrap table-centered m-0">
                        <thead class="thead-light">
                           <th>תְעוּדַת זֶהוּת</th>
                           <th>נושא </th>
                           <th>תַאֲרִיך</th>
                           <th>סטָטוּס</th>
                           <th>פעולה</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($tickets as $ticket)
                           <tr>
                              <td>{{ $ticket->id }}</td>
                              <td>{{ $ticket->subject }}</td>
                              <td>{{ $ticket->created_at->diffForHumans() }}</td>
                              <td><label class="badge  badge-success">{{ $ticket->status }}</label></td>
                              <td><a href="{{route('admin.tickets')}}/{{$ticket->id}}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="" data-original-title="צפה בכרטיס"><i class="mdi mdi-eye"></i></a></td>
                           </tr>
                           @endforeach
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
@section('scripts')