<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id',Auth::user()->id)->get();
        return view('includes.tickets',compact('tickets'));
    }

    public function ShowDetails($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('includes.ticket-details',compact('ticket'));
    }

    public function store(Request $request)
    {
        /*if($request->hasFile('uploadtickets')) {
            echo "yes";
        }
        else{
            echo "no";
        }
        echo "<pre>";
        print_r($request->hasFile('uploadtickets'));
        print_r($request->all());
        exit();*/
        
        $validator = Validator::make($request->all(),  [
            'subject' => 'required',
            'description' => 'required',
        ]);

        if ($validator->passes()) {
            $ticket = new Ticket();
            $ticket->subject = $request->subject;
            $ticket->description = $request->description;

            if($request->hasFile('uploadtickets')) {
                $file = $request->file('uploadtickets') ;
                $destinationPath = public_path().'/assets/tickets/';
                $filename = $file->getClientOriginalName();
                $file->move($destinationPath, $filename);
                $ticket->image = $filename ;
            }       
            $ticket->user_id = Auth::user()->id;
            $ticket->save();
            Session::flash('message', 'הכרטיס הוגש בהצלחה.');
            return response()->json(['success' => true]);            
        }
        else
        {
            return response()->json(['error'=>$validator->errors()]);
        }       
    }

    public function showTicketDetail(Request $request){
        
        $ticket = Ticket::select('*')->where('id',$request->ticketId)->get();
        if(!empty($ticket)){
            $result['data'] = $ticket;
            $result['status'] = 1;
        }
        else{
            $result['status'] = 0;
        }
        $subject = $ticket[0]['subject'];
        $id = $ticket[0]['id'];
        $image = $ticket[0]['image'];
        $description = $ticket[0]['description'];
        return response()->json(['success' => true,'subject'=>$subject,'id'=>$id,'image'=>$image,'description'=>$description]);
    }
    public function updateMessage(Request $request)
    {
       if($request->ticket_id){
            $ticketMessage = new TicketMessage();
            $ticketMessage->ticket_id = $request->ticket_id;
            $ticketMessage->message = $request->ticket_message;
            $ticketMessage->user_type = 2;
            $ticketMessage->save();
            return redirect()->back()->with('success', true);
        }
        return redirect()->back()->with('success', false);
    }
    public function updateTicket(Request $request)
    {
        $id = $request->ticket_id;
        $data['subject']= $request->subject;
        $data['description']= $request->description;
        
        if($request->hasFile('uploadtickets')) {
                $file = $request->file('uploadtickets') ;
                $destinationPath = public_path().'/assets/tickets/';
                $filename = $file->getClientOriginalName();
                $file->move($destinationPath, $filename);
                $data['image'] = $filename ;
        }
        $res = Ticket::where('id', $id)->update($data);
        if($res){
            return redirect()->back()->with('success', true);
        }else{
            return redirect()->back()->with('success', false);
        }
    }
    public function deleteTicket(Request $request)
    {
        $id = $request->ticketId;
        $ticket = Ticket::find($id);
        $ticket->delete();
        return redirect()->back()->with('success', true);
    }
    
    
    public function addTicket(Request $request){
        
        $date = date('Y-m-d H:i:s');
        $data['ticket_id'] = $request->ticket_id;
        $data['message'] = $request->ticket_message;
        $data['user_type'] = 2;
        $data['created_at'] = $date;
        $data['updated_at'] = $date;
        $res = TicketMessage::insert($data);
        return response()->json(['success' => true]);
        
    }
}
