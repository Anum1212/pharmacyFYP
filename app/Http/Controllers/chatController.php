<?php



// controller Details
// ------------------
// Methods Present
// ------------------
// 1) chat
// 2) getMessages
// 3) storeChatData
// 4) sendNotification



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Pusher\Pusher;
use Cart;



class chatController extends Controller
{


     //  |---------------------------------- 1) __construct ----------------------------------|
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware(function ($request, $next) {
            Cart::instance('shopping');
            Cart::restore(Auth::id());

            return $next($request);
        });
    }



  // |---------------------------------- 1) chat ----------------------------------|
    public function chat(Request $request)
    {
        if (Auth::check()) {
            //pharmicist names
            $data=DB::table('pharmacists')->get();
            return view('chatView', compact('data'));
        } elseif (Auth::guard('pharmacist')->check()) {
            //user names
            $data=DB::table('users')->get();
            return view('chatView', compact('data'));
        }
        return view('chat');
    }



    // |---------------------------------- 2) getMessages ----------------------------------|
    public function getMessages(Request $request)
    {
        if (Auth::check()) {
            $chat=DB::table('chat_records')->where('pharmicistName', $request->name)->where('userName', Auth::user()->name)->orderBy('created_at', 'ASC')->get();
            $data=DB::table('pharmacists')->get();
        } elseif (Auth::guard('pharmacist')->check()) {
            $chat=DB::table('chat_records')->where('pharmicistName', Auth::guard('pharmacist')->user()->name)->where('userName', $request->name)->orderBy('created_at', 'ASC')->get();
            $data=DB::table('users')->get();
        }
        return view('chatView', compact('data', 'chat'));
    }



// |---------------------------------- 3) storeChatData ----------------------------------|
    public function storeChatData(Request $request)
    {
        if (Auth::check()) {
            DB::insert('insert into  chat_records (pharmicistName,userName,senderName,message,created_at) values(?,?,?,?,?)', [$request->reciever,Auth()->user()->name,Auth()->user()->name,$request->message,new \dateTime]);
            //Remember to set your credentials below.
            //dd($request);
            $id=DB::table('pharmacists')->where('name', $request->reciever)->get();
            //  dd($id);
            $id=$id[0]->id;
            $senderName=Auth()->user()->name;
            $reciever="pharmicist";
        //dispatch krna event with user id and message
        } elseif (Auth::guard('pharmacist')->check()) {
            DB::insert('insert into  chat_records (userName,pharmicistName,senderName,message,created_at) values(?,?,?,?,?)', [$request->reciever,Auth::guard('pharmacist')->user()->name,Auth::guard('pharmacist')->user()->name,$request->message,new \dateTime]);
            $id=DB::table('users')->where('name', $request->reciever)->get();
            $id=$id[0]->id;
            $senderName=Auth::guard('pharmacist')->user()->name;
            $reciever="user";
            //dispatch krna event with user id and message
        }
        $options = array(
        'cluster' => 'mt1',
        'encrypted' => true
    );
        $pusher = new Pusher(
        'd777d40d2f1e9e7e6b04',
        'acf01fcfbc91e9ba90a4',
        '460282',
        $options
    );
        $content=$request->message;
        $message=array(
      0 =>$id,
      1=> $content,
      2 => $senderName,
      3 => $reciever
    );
        //Send a message to notify channel with an event name of notify-event
        $pusher->trigger('notify2', 'notify-event2', $message);
    }



// |---------------------------------- 4) sendNotification ----------------------------------|
    public function sendNotification()
    {
        //Remember to change this with your cluster name.
        $options = array(
        'cluster' => 'mt1',
        'encrypted' => true
    );

        //Remember to set your credentials below.
        $pusher = new Pusher(
        'd777d40d2f1e9e7e6b04',
        'acf01fcfbc91e9ba90a4',
        '460282',
        $options
    );
        $content="msg";
        $message=array(
      0 => 1,
      1=> $content,
    );

        //Send a message to notify channel with an event name of notify-event
        $pusher->trigger('notify', 'notify-event', $message);
    }
}
