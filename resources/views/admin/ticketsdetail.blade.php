@extends('admin.layouts.app') 
@section('title', ' כרטיסים ') 
@section('content')

<?php 
$is_logged_in = session()->get('admin_logged_in'); 

if(!isset($is_logged_in) && $is_logged_in != '1')
{ 
    return redirect()->route('admin.adminLogin')->send(); 
} 
?>
<?php
    
   /* echo "<pre>";
    print_r($ticket);
    die;*/


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

                                <li class="breadcrumb-item"><a href="{{route('admin.tickets')}}">כרטיסים</a></li>

                                <li class="breadcrumb-item active">פרטי כרטיס</li>
                            </ol>
                        </div>

                        <h4 class="page-title">תעודת זהות # 123ּ</h4>
                    </div>
                </div>
            </div>

            <div class="row ticketdetail" style="direction: rtl;">
                <div class="col-xl-8 col-lg-7">
                    <div class="card d-block">
                        <div class="card-body">
                            <h4 class="mb-3 mt-0 font-18 text-right">פרטי כרטיס</h4>

                            <div class="clerfix"></div>

                            <div class="row">
                                <div class="col-md-6 text-right">
                                    <label class="mt-2 mb-1 form-label width100">נושא :</label>

                                    <p>{{ $ticket->subject }}</p>
                                </div>
                                <!-- end col -->

                                <div class="col-md-6 text-right">
                                    <label class="mt-2 mb-1 form-label width100">תַאֲרִיך :</label>
                                    <p>{{$ticket->getCreatedAtTime($ticket->created_at) }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 text-right">
                                    <label class="mt-2 form-label width100">סטָטוּס :</label>

                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="dropdown">
                                                <label class="badge  badge-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> {{ $ticket->status }}  <span class="fa fa-angle-down  mr-1"></span></label>
                                                <ul class="dropdown-menu ticket_status" style="">
                                                    <li data-id="1" data-value="opened"><a class="dropdown-item"> נפתח </a></li>
                                                    <li data-id="1" data-value="closed"><a class="dropdown-item"> סגור </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body ticket-chat">
                            @if($ticket->description)
                            <div class="d-flex align-items-start">
                                <div class="w-100 text-right">
                                    <img class="ml-2 rounded-circle" src="{{ asset('/assets/users') }}/{{ $ticket->user->avatar }}" alt="" height="32" />
                                    <h5 class="mt-0 mb-1">{{ $ticket->user->first_name }}<small class="text-muted">{{ $ticket->created_at->diffForHumans() }}</small></h5>
                                    {{ $ticket->description }}
                                </div>
                            </div>
                            @endif
                            @foreach($ticket->ticketMessage as $msg)
                            @if($msg->user_type == 2)
                                <div class="d-flex align-items-start mt-3">
                                    <div class="w-100 text-right">
                                        <img class="ml-2 rounded-circle" src="{{ asset('/assets/users') }}/{{ $ticket->user->avatar }}" alt="" height="32" />
                                        <h5 class="mt-0 mb-1">{{ $ticket->user->first_name }}<small class="text-muted">{{ $msg->created_at->diffForHumans() }}</small></h5>
                                        {{ $msg->message }}
                                    </div>
                                </div>
                            @elseif($msg->user_type == 1) 
                                <div class="d-flex align-items-start mt-3">
                                    <div class="w-100 text-left">
                                        <img class="ml-2 rounded-circle" src="{{ asset('/assets/images/customer-support.jpg') }}" alt="" height="32" />
                                        <h5 class="mt-0 mb-1">{{ $ticket->user->first_name }}<small class="text-muted">{{ $msg->created_at->diffForHumans() }}</small></h5>
                                        {{ $msg->message }}
                                    </div>
                                </div>                                                          
                            @endif
                            @endforeach   
                            @if($ticket->getRawOriginal('status') == "closed")
                                <div class="w-100 text-left">
                                    הכרטיס נסגר.
                                </div>
                            @elseif($ticket->getRawOriginal('status') == "new")
                                <div class="w-100 text-left">
                                    פתח את הכרטיס כדי להתחיל את השיחה.
                                </div>
                            @else
                            <div class="border rounded mt-4">
                                <form action="{{ Route('admin.ticket.update') }}" method="POST" class="comment-area-box">
                                    <textarea rows="3" name="ticket_message" class="form-control border-0 resize-none" placeholder="ההודעה שלך..." required></textarea>
                                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                    <div class="p-2 bg-light d-flex justify-content-between align-items-center">
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="mdi mdi-send me-1"></i>השב כרטיס תמיכה</button>
                                    </div>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title font-16 mb-3 text-right">קבצים מצורפים</h5>
                            @if($ticket->image)
                            <div class="card mb-1 shadow-none border">
                                <div class="p-2">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar-sm">
                                                <span class="avatar-title badge-soft-primary text-primary rounded">
                                                   {{ pathinfo($ticket->image, PATHINFO_EXTENSION) }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col ps-0 text-right">
                                            <a href="{{ asset('assets/tickets/') }}/{{$ticket->image}}" target="_blank" class="text-muted fw-bold"> {{ pathinfo($ticket->image, PATHINFO_FILENAME) }}</a>
                                        </div>

                                        <div class="col-auto">
                                            <a href="{{ asset('assets/tickets/') }}/{{$ticket->image}}" class="btn btn-link font-16 text-muted" download>
                                                <i class="dripicons-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else        
                            <div class="card mb-1">
                                <div class="p-2">
                                    <div class="row align-items-center">
                                        אין קבצים מצורפים זמינים!
                                    </div>
                                </div>
                            </div>                
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- end row -->
        </div>
    </div>
</div>
<div id="statusModal" class="deletemodal modal fade">
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
            <p>
              האם אתה באמת רוצה לשנות סטטוס?
            </p>
        </div>
        <div class="modal-footer justify-content-center">
            <form action="{{ Route('admin.ticket.status') }}" method="post"> 
                <input type="hidden" name="update_ticket_id" id="ticket_id_f"  value="">
                <input type="hidden" name="update_ticket_status" id="ticket_status_f" value="">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">לְבַטֵל</button>
                <button  type="submit" class="btn btn-danger updatestatus ">לִמְחוֹק</button>
            </form>
        </div>
    </div>
</div>
</div>
@endsection 

@section('scripts')
<script>
$(function () {
   var chatbox = document.getElementsByClassName("ticket-chat")[0];
   chatbox.scrollTop = chatbox.scrollHeight;

   $(".ticket_status").on("click", "li", function(e){
        e.preventDefault();
        var status = $(this).attr('data-value');
        var id = '{{ $ticket->id }}';
        $('#ticket_id_f').val(id);
        $('#ticket_status_f').val(status);
        console.log(id);
        $('#statusModal').modal('show');
    });   
});    
</script>
@endsection
