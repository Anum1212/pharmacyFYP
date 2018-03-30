<?php



// controller Details
// ------------------
// methods and their details
// ---------------------------
// index --> return main index page



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class siteViewController extends Controller
{


  // |---------------------------------- index ----------------------------------|
        public function index() {
    return view('siteView.index');
  }


      
    // |---------------------------------- messagetoAdminForm ----------------------------------|
    public function contactUsForm()
    {
        return view('siteView.messageToAdminForm');
    }



// ***************** Add Visitor Message *****************
public function contactUs(Request $req){
  $message = new Message();
  $message->name = $req->name;
  $message->senderEmail = $req->email;
  $message->recipientEmail = '0'; // 0 = site admin
  $message->message = $req->message;
  $message->save();
  return redirect('/')->with('message', 'Admin will soon get in contact with you.');
}
}
