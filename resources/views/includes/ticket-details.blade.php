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
               <li><a href="#"><i class="fas fa-home"></i> דף הבית</a></li>
                 <li><a href="#">דכרטיסים</a></li>
               <li class="active">פרטי הכרטיס</li>
            </ul>
         </div>
      </div>
   </div>
</div>

<!-- End Breadcrumb -->
<div class="default-padding-sm sidebar_content-section bg-gray" style="direction: rtl;">
   <div class="container">
      <!--div class="col-md-4">
         @include('includes.sidebar')
      </div-->
      <div class="col-md-12 ticketdetails">
         <div class="content-wraper">
            <div class="sidebar_header-login">
               <h3>פרטי כרטיס </h3>
               <a href="{{ Route('front.ticket') }}" class="btn circle btn-theme effect btn-sm back-btn">חזור  </a>
            </div>
            <div class="row">
               <div class="col-md-4">
                  <div class="list-chts">
                     <div class="heds">
                        <h5>פרטי הכרטיס </h5>
                     </div>
                        <div class="ticketlist">
                        <h5>נושא</h5>
                        <p>{{ $ticket->subject }}</p>
                     </div>
                     <div class="ticketlist">
                        <h5>תַאֲרִיך</h5>
                        <p>{{ $ticket->getCreatedAtTime($ticket->created_at) }}</p>
                     </div>
                     <div class="ticketlist">
                        <h5>סטָטוּס</h5>
                        <p>{{ $ticket->status }}</p>
                     </div>
                     @if($ticket->image)
                           <?php $imgurl = url('assets/tickets/'.$ticket->image); ?>
                            <div class="ticketlist">
                                <h5> תמונה</h5>
                                <p><img src="{{ $imgurl }}" id="imgTicket" style="width: 30%;height: 30%;"></p>
                            </div>
                    @endif
                  </div>
               </div>
               <div class="col-md-8">
                  <div class="msgs-all">
                     
                     <div class="chats-alls">
                        <ul class="list-all-chat">
                           @if($ticket->description)
                              <li class="right-msg main-message">
                                 <div class="msg-ic">
                                    {{  $ticket->description }}
                                 </div>
                              </li>                           
                           @endif
                           @foreach($ticket->ticketMessage as $msg)
                              @if($msg->user_type == 2)
                                 <li class="right-msg">
                                    <div class="msg-ic">
                                       {{  $msg->message }}
                                    </div>
                                    <span class="time-msg"><i class="fa fa-clock-o"></i> {{ $msg->created_at->diffForHumans() }} </span> 
                                 </li>
                              @elseif($msg->user_type == 1) 
                                 <li>
                                    <img class="user-img" src="{{ asset('/assets/images/customer-support.jpg') }}">
                                    <div class="msg-ic">
                                       {{  $msg->message }}
                                    </div>
                                    <span class="time-msg"><i class="fa fa-clock-o"></i> {{ $msg->created_at->diffForHumans() }} </span> 
                                 </li>                             
                              @endif
                           @endforeach 
                        </ul>
                     </div>
                     <div class="chat-foots">
                        @if($ticket->getRawOriginal('status') == "closed")
                        <div class="w-100 text-left">
                           הכרטיס נסגר.
                        </div>
                        @elseif($ticket->getRawOriginal('status') == "new")
                        <div class="w-100 text-left">
                           המתן לפתיחת הכרטיס
                        </div>
                        @else
                        
                        <div class="cont-all-set">
                           <form method="POST" action="{{ Route('front.ticket.message.store') }}" id="ticketMessage" autocomplete="off">
                              <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                              <textarea rows="5" name="ticket_message" class="form-control border-0 resize-none" placeholder="הקלד הודעה כאן ..." required></textarea>
                              <button type="submit" class="btn btn-sm btn-primary" style="border-color:#eb871e; background-color:#eb871e;"><i class="fa fa-paper-plane"></i>לשלוח</button>
                              <!--<button type="submit" class="hide" id="submit_ticket"></button>
                              <a href="#" class="sbmt-s" id="sub_tic_message"> <i class="fa fa-paper-plane"></i>   </a>-->
                           </form>
                        </div>
                        @endif
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
<script>

$(function () {
   var chatbox = document.getElementsByClassName("list-all-chat")[0];
   chatbox.scrollTop = chatbox.scrollHeight;
   $("#sub_tic_message").click(function(e){        
      e.preventDefault();
      $("#submit_ticket").trigger('click'); // Submit the form
   });
});
</script>
@endsection
