<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function showtickets()
    {
        $tickets = Ticket::all();
        return view('admin.tickets',compact('tickets'));
    }

    public function showDetails($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('admin.ticketsdetail',compact('ticket'));
    }

    public function updateMessage(Request $request)
    {
        if($request->ticket_id){
            $ticketMessage = new TicketMessage();
            $ticketMessage->ticket_id = $request->ticket_id;
            $ticketMessage->message = $request->ticket_message;
            $ticketMessage->user_type = 1;
            $ticketMessage->save();
            return redirect()->back()->with('success', true); 
        }
    }

    public function updateStatus(Request $request)
    {
        if($request->update_ticket_id){
            $ticket = Ticket::find($request->update_ticket_id);
            if($ticket)
            {
                $ticket->status = $request->update_ticket_status;
                $ticket->save();
                return redirect()->back()->with('success', true); 
            }
        }
    }
}
