@extends('layouts.app')
@section('title', ' הוֹדָעָה ')
@section('content')

<!-- Start Breadcrumb -->
<div class="banner-inner-area2 pt8"></div>
<div class="breadcrumb-inner-area " style="">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <ul class="breadcrumb">
               <li><a href="{{ URL::to('/') }}"><i class="fas fa-home"></i> דף הבית</a></li>
               <li class="active">כרטיסים</li>
            </ul>
         </div>
      </div>
   </div>
</div>

<!-- End Breadcrumb -->
<div class="default-padding-sm sidebar_content-section bg-gray" style="direction: rtl;">
   <div class="container">
      @if(Session::has('message'))
         <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
         </div>
      @endif
      <div class="col-md-4">
         @include('includes.profile-sidebar')
      </div>
      <div class="col-md-8">
         <div class="content-wraper">
            <div class="tablehead">
               <div class="row">
                  <div class="col-md-4 text-left">
                     <a class="btn circle btn-theme effect btn-md " href="#addticket" data-toggle="modal">להוסיף כרטיס</a>
                  </div>
                  <div class="col-md-8">
                     <h3>כרטיסים </h3>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="table-responsive">
                     <table class="table table-ticket">
                        <thead>
                           <tr>
                              <th>תעודת זהות</th>
                              <th>נושא </th>
                              <th>תַאֲרִיך</th>
                              <th>סטטוס</th>
                              <th colspan="3">פעולה</th>
                              
                           </tr>
                        </thead>
                        <tbody>
                           @if(count($tickets) > 0)
                           @foreach($tickets as $ticket)
                           <tr>
                              <td>{{ $ticket->id }}</td>
                              <td>{{ $ticket->subject }}</td>
                              <td>{{$ticket->getCreatedAtTime($ticket->created_at) }}</td>
                              <td><span class="badgetable">{{ $ticket->status }}</span></td>
                              <td><a  href="{{ route('front.ticket.details',['id'=> $ticket->id ]) }}" class="btnview"><i class="fas fa-eye"></i></a></td>
                              <td><a  href="javascript:void(0);" class="btnview edit_ticket_cls" data-id="{{$ticket->id}}"><i class="fas fa-edit"></i></a></td>
                              <td><a  href="javascript:void(0);" class="btnview deleteticketcls" data-id="{{$ticket->id}}" id="deleteticket"><i class="fa fa-trash"></i></a></td>
                           </tr>
                           @endforeach
                           @else
                           <tr><td colspan="5" class="text-center">לא נמצאו שיאים!</td></tr>
                           @endif
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <ul class="pagination">
               <li class="disabled"> 
                  <a href="javascript:void(0)">Previous</a> 
               </li>
               <li class="active"> 
                  <a href="javascript:void(0)">1</a> 
               </li>
               <li class=""> 
                  <a href="javascript:void(0)">2</a> 
               </li>
               <li class=""> 
                  <a href="javascript:void(0)">3</a> 
               </li>
               <li class="">  
                  <a href="javascript:void(0)">Next</a> 
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>
<a class="edit_ticket" href="#editticket" data-toggle="modal"></a>
<div class="modal editticket fade privatelesson-md" id="editticket">
   <div class="modal-dialog">
      <div class="modal-content" style="width:100%">
         <div class="modal-header border-bottom-0">
            <h4 class="modal-title"><span><img src="{{ asset('/assets/img/icon/tickets.png') }}"></span> להוסיף כרטיס</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
         </div>
         <!-- Modal body -->
         <form id="editticketForm" action = "{{ route('front.updateTicket') }}" enctype="multipart/form-data" method="post">
            @csrf()
            <input type="hidden" id="ticket_id" name="ticket_id"> 
            <div class="modal-body p-30">
                  <div class="form-group">
                     <input  type="text" class="form-control " name="subject" id="edit_subject" placeholder="הזן נושא">
                     <span class="text-danger error-text subject_err pull-right"></span>           
                  </div>
                  <div class="form-group">
                     <textarea class="form-control" rows="10" name="description" id="edit_description" placeholder="תאר את הבעיה שלך כאן"></textarea>
                     <span class="text-danger error-text description_err pull-right"></span>                      
                  </div>
                  <div class="form-group">
                     <label for="uploadtickets1" class="uploadtickets">
                        <i class="fas fa-upload"></i>
                        <p>Click to upload</p>
                     </label>
                     <input type="file" id="uploadtickets1" name="uploadtickets" style="display:none"/>
                  </div>

            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-theme btn-md btn-lt-ht">הגעדכן כרטיס תמיכה</button>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal addticket fade privatelesson-md" id="addticket">
   <div class="modal-dialog">
      <div class="modal-content" style="width:100%">
         <div class="modal-header border-bottom-0">
            <h4 class="modal-title"><span><img src="{{ asset('/assets/img/icon/tickets.png') }}"></span> להוסיף כרטיס</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
         </div>
         <!-- Modal body -->
         <form id="ticketForm" action = "{{ route('front.ticket.store') }}" enctype="multipart/form-data" method="POST">
            @csrf()
            <div class="modal-body p-30">
                  <div class="form-group">
                     <input  type="text" class="form-control " name="subject" placeholder="הזן נושא">
                     <span class="text-danger error-text subject_err pull-right"></span>           
                  </div>
                  <div class="form-group">
                     <textarea class="form-control" rows="10" name="description" placeholder="תאר את הבעיה שלך כאן"></textarea>
                     <span class="text-danger error-text description_err pull-right"></span>                      
                  </div>
                  <div class="form-group">
                     <label for="uploadtickets" class="uploadtickets">
                        <i class="fas fa-upload"></i>
                        <p>Click to upload</p>
                     </label>
                     <input type="file" id="uploadtickets" name="uploadtickets" style="display:none"/>
                  </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-theme btn-md btn-lt-ht">הגש כרטיס תמיכה</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection
@section('scripts')
<script>

$(function () {
   function readURL(input) {
      if (input.files && input.files[0]) {
         var reader = new FileReader();
         reader.onload = function (e) {
            // $("#imgTicket").attr("src",e.target.result);
          var img = $('<img>');
            img.attr('src', e.target.result);
            img.attr('width','100px');
            $('.uploadtickets p').html(img);
        
         }
         reader.readAsDataURL(input.files[0]);
      }else{
         $('.uploadtickets p').text('Click to upload');
      }
   }
   function readURLEdit(input) {
      if (input.files && input.files[0]) {
         var reader = new FileReader();
         reader.onload = function (e) {
            // $("#imgTicket").attr("src",e.target.result);
          var img = $('<img>');
            img.attr('src', e.target.result);
            img.attr('width','100px');
            $('.uploadtickets p').html(img);
         }
         reader.readAsDataURL(input.files[0]);
      }else{
         $('.uploadtickets p').text('Click to upload');
      }
   }

   $("#uploadtickets").change(function(){
      readURL(this);
   });   
   $("#uploadtickets1").change(function(){
      readURLEdit(this);
   });   

    $('#ticketForm').submit(function (e) {
        
        e.preventDefault();
        $('.error-text').empty();
        var form = new FormData(document.getElementById('ticketForm'));
        //append files
        var file = document.getElementById('uploadtickets').files[0];
        if (file) {
            form.append('uploadtickets', file);
        }
        $.ajax({
            url: '{{ route('front.ticket.store') }}',
            type: 'POST',
            
            //data: new FormData($("#ticketForm")[0]),
            data: form,
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
               if ($.isEmptyObject(response.error)) {
                  window.location.reload();
               }else{
                  printErrorMsg(response.error);
               }                
            }
         });
    });

   function printErrorMsg (msg) {
      $.each( msg, function( key, value ) {
         $('.'+key+'_err').text(value);
      });
   }   
});


$(document).on("click",".edit_ticket_cls",function(){

    $("#edit_subject").val('');
    $("#edit_description").val('');
    $("#ticket_id").val('');
    var ticketId = $(this).attr('data-id');
    var token = $('meta[name=csrf-token]').attr('content');
    $.ajax({
        url: '{{ route('front.showTicketDetail') }}',
        //dataType:'josn',
        type: 'POST',
        data: {token:token,ticketId:ticketId},
        //contentType: false,
        //cache: false,
        //processData: false,
        success: function(response) {
           if ($.isEmptyObject(response.error)) {
              if(response.success){
                  $(".edit_ticket").click();
                  $("#ticket_id").val(response.id);
                  $("#edit_subject").val(response.subject);
                  $("#edit_description").val(response.description);
                  if(response.image){
                     let img = "{{url('/assets/tickets')}}/"+response.image;
                     var img_con = $('<img>');
                     img_con.attr('src', img);
                     img_con.attr('width','100px');
                     $('.modal.editticket .uploadtickets p').html(img_con);
                  }
              }
           }else{
              printErrorMsg(response.error);
           }                
        }
     });
});


$(".deleteticketcls").click(function(){
    if(confirm("Are you sure you want to delete this ticket ?")){
    var ticketId = $(this).attr('data-id');
    var token = $('meta[name=csrf-token]').attr('content');
    $.ajax({
        url: '{{ route('front.deleteTicket') }}',
        //dataType:'josn',
        type: 'POST',
        data: {token:token,ticketId:ticketId},
        //contentType: false,
        //cache: false,
        //processData: false,
        success: function(response) {
           if ($.isEmptyObject(response.error)) {
                 window.location.reload();
           }else{
              printErrorMsg(response.error);
           }                
        }
     });
    }
});


</script>

@endsection