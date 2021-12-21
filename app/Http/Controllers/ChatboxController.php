<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\chatbox;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Notifications\contactsnew;



class ChatboxController extends Controller
{
     public function storechats(Request $request){

        $chatboxes = new chatbox;
        if ($request->hasFile('uploadfile')) {
            $imagePath = $request->file('uploadfile');
            $imageName = $imagePath->getClientOriginalName();

            $path = $request->file('uploadfile')->storeAs('uploadschats', $imageName, 'public');
        }
        $chatboxes->uploadfile = $imageName.'/storage/'.$path;;
        $chatboxes->title = $request->title;
        $chatboxes->body = $request->body;
        if (Auth::guest()){
            $chatboxes->email = $request->cahtbox_email;
            $chatboxes->user_id = 0;
        }else{
            $chatboxes->user_id = Auth::user()->id;
            $chatboxes->email = '';
        }
        $id = $chatboxes->save();
        return response()->json(['success' => true]);
     }

}
