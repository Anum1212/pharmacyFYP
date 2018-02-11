<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Auth;
use App\Post;
use Illuminate\Support\Facades\Redirect;

class posts_controller extends Controller
{

  public function __construct()
  {
      $this->middleware('auth:pharmacist',['only' => ['pharmacistPostQuery']]);
  }

// Possible senderTypes
// 0 -> Admin
// 1 -> Pharmist
// 2 -> User(customer)
// recipientId
// 0 -> admin

  // Pharmacist Question Method
    public function pharmacistPostQuery(Request $req)
    {
      $this->validate($req,[
          'askQuestion' => 'required',
        ]);

        $saveRecord =new post;
                    $saveRecord->senderType = '1'; // pharmacist
                    $saveRecord->recipientId = '0';
                    $saveRecord->senderId = Auth::user()->id;
                    $saveRecord->post = $req->askQuestion;
                    $saveRecord->save();
                   return redirect::back()->with('message', 'Admin will soon get in contact with you');
    }

// Customer Question Method
    public function userPostQuery(Request $req)
    {
      $this->validate($req,[
          'askQuestion' => 'required',
        ]);

        $saveRecord =new post;
                    $saveRecord->senderType = '2'; // user(customer)
                    $saveRecord->recipientId = '0';
                    $saveRecord->senderId = Auth::user()->id;
                    $saveRecord->post = $req->askQuestion;
                    $saveRecord->save();
                    return redirect::back()->with('message', 'Admin will soon get in contact with you');
    }

// Admin Reply Method
    public function adminReplyQuery(Request $req)
    {
      $this->validate($req,[
          'askQuestion' => 'required',
        ]);

        $saveRecord =new post;
                    $saveRecord->senderType = '0'; //admin
                    $saveRecord->recipientId = '1';
                    $saveRecord->senderId = Auth::user()->id;
                    $saveRecord->post = $req->askQuestion;
                    $saveRecord->save();
                  return redirect::back()->with('message', 'Message Sent');
    }
}
