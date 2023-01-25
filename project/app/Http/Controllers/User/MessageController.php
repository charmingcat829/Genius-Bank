<?php

namespace App\Http\Controllers\User;

use App\Classes\GeniusMailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Auth;
use App\Models\AdminUserConversation;
use App\Models\AdminUserMessage;
use App\Models\Generalsetting;
use App\Models\Notification;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function adminmessages()
    {
        $user = Auth::guard('web')->user();
        $convs = AdminUserConversation::where('user_id','=',$user->id)->paginate();
        return view('user.message.index',compact('convs'));
    }

    public function messageload($id)
    {
        $conv = AdminUserConversation::findOrfail($id);
        return view('load.usermessage',compact('conv'));
    }

    public function adminmessage($id)
    {
        $conv = AdminUserConversation::findOrfail($id);
        $admin = Admin::where('id',1)->first();
        return view('user.message.create',compact('conv','admin'));
    }


    public function adminmessagedelete($id)
    {
        $conv = AdminUserConversation::findOrfail($id);
        if($conv->messages->count() > 0)
        {
            foreach ($conv->messages as $key) {
                $key->delete();
            }
        }
        $conv->delete();
        return redirect()->back()->with('success','Message Deleted Successfully');
    }

    public function adminpostmessage(Request $request)
    {
        $msg = new AdminUserMessage();
        $input = $request->all();
        $msg->fill($input)->save();

        $notification = new Notification;
        $notification->conversation_id = $msg->conversation->id;
        $notification->save();
        //--- Redirect Section
        $msg = 'Message Sent!';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    public function adminusercontact(Request $request)
    {
        $data = 1;
        $user = Auth::guard('web')->user();
        $gs = Generalsetting::findOrFail(1);
        $subject = $request->subject;
        $to = $gs->email;
        $from = $user->email;
        $msg = "Email: ".$from."\nMessage: ".$request->message;

        $conv = AdminUserConversation::where('user_id','=',$user->id)->where('subject','=',$subject)->first();
        if(isset($conv)){
            $msg = new AdminUserMessage();
            $msg->conversation_id = $conv->id;
            $msg->message = $request->message;
            $msg->user_id = $user->id;
            $msg->save();
            return response()->json($data);
        }
        else{
            $message = new AdminUserConversation();
            $message->subject = $subject;
            $message->user_id= $user->id;
            $message->message = $request->message;
            $message->save();

            $notification = new Notification;
            $notification->conversation_id = $message->id;
            $notification->save();

            $msg = new AdminUserMessage();
            $msg->conversation_id = $message->id;
            $msg->message = $request->message;
            $msg->user_id = $user->id;
            $msg->save();
            return response()->json($data);

        }
        if($gs->is_smtp == 1)
        {
            $data = [
            'to' => $to,
            'subject' => $subject,
            'body' => $msg,
        ];

        $mailer = new GeniusMailer();
        $mailer->sendCustomMail($data);
        }
        else
        {
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
            mail($to,$subject,$msg,$headers);
        }
    }
}
