<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\contactus;
use App\Models\questions;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Notifications\contactsnew;
use App\Models\Ticket;

class ContactController extends Controller
{
    //main function to load contact us page
    public function getContact()
    {
       $info = contactus::find(1);
       $questions = questions::all();
       return view('includes.contact',compact('questions','info')); 
    } 

    //save the data of person that wants to ask questions and sending email.
  	public function saveContact(Request $request) {

       /* pr($request->all());
        die;*/
        $validator = Validator::make($request->all(),  [
             'contact_name' => 'required',
             'contact_email' => 'required|email',
             'contact_radio' => 'required',
             'contact_phone' => 'required',
             'contact_comments' => 'required'
         ]);
        if ($validator->passes()) {
        $contacts = new Contact;
        $contacts->name = $request->contact_name;
        $contacts->email = $request->contact_email;
        $contacts->phone_number = $request->contact_phone;
        $contacts->category = $request->input('contact_radio');
        $contacts->message = $request->contact_comments;
        $contacts->save();
        
        if(Auth::user()->id){
            $ticket = new Ticket();
            $ticket->subject = $request->contact_ticketIssue;
            $ticket->description = $request->contact_comments;
            $ticket->user_id = Auth::user()->id;
            $ticket->save();
            }
        }else{
        return response()->json(['error'=>$validator->errors()]);
        }

        $data = [
        'name' => $request->contact_name,
        'email' => $request->contact_email,
        'phone_number' => $request->contact_phone,
        'message' => $request->contact_comments
        ];
        //sending mail to admin
        Mail::send('includes.contact_email',["data1"=>$data],function($message){
        	$message->to('ruchikagarg764@gmail.com')
        			->subject('contact details');
        	$message->from('ruchikaindiit@gmail.com');
        });
        
        Session::flash('message', 'תודה שפנית אלינו !!!');
        

    }
}
