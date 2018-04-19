<?php



// controller Details
// ------------------
// methods and their details
// ---------------------------
// 1) contactUs -> save user message to db
// 2) viewAllMessages -> view all messages from db
// 3) viewMessage -> view message details
// 4) viewAllMessagesOfSpecificSender -> view all messages sent by a specific user
// 5) replyMessage -> send message to customer/pharmacist
// 6) markAsUnreadMessage -> mark a message as unread
// 7) markAsReadMessage -> mark a message as read
// 8) deleteMessage  -> delete a message
// 9) searchSender -> search for message

// Possible Status(int) Types
// --------------------------
// 0 -> UnRead message
// 1 -> admin only Read message
// 2 -> admin replied to messages
// 3 -> indicates that message is admin response



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use App\Pharmacist;
use Mail;
use App\Mail\replyToMessages;

class messageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except(['contactUs']);
    }



    // |---------------------------------- contactUs ----------------------------------|
    public function contactUs(Request $req)
    {
        $message = new Message();
        $message->name = $req->name;
        $message->senderEmail = $req->email;
        $message->recipientEmail = '0'; // 0 = site admin
        $message->message = $req->message;
        $message->save();
        return redirect('/')->with('message', 'Admin will soon get in contact with you.');
    }



    // |---------------------------------- viewAllMessages ----------------------------------|
    public function viewAllMessages(Request $req)
    {
        $unreadMessages = Message::where('status', '0')->latest()->paginate(10, ['*'], 'unreadTable');
        $readMessages = Message::where([ // show only messages that are 1->read or 2->replied to
    ['status', '!=','0'],
    ['status', '!=','3'],
    ])->latest()->paginate(10, ['*'], 'readTable');
        return view('admin.messages.viewAllMessages', compact('unreadMessages', 'readMessages'));
    }



    // |---------------------------------- viewMessage ----------------------------------|
    public function viewMessage($messageId)
    {
        $message = Message::find($messageId);
        $allPreviousEmails = Message::where('senderEmail', $message->senderEmail)->get();
        return view('admin.messages.replyMessage', compact('message', '$allPreviousEmails'));
    }



    // |---------------------------------- viewAllMessagesOfSpecificSender ----------------------------------|
    public function viewAllMessagesOfSpecificSender($messageId)
    {
        $recipientData = Message::find($messageId); // visitor Message
        $visitorPrevMessages = Message::where('senderEmail', $recipientData->senderEmail)->get();
        $adminResponses = Message::where('recipientEmail', $recipientData->senderEmail)->get();
        foreach ($visitorPrevMessages as $individualVisitorPrevMessage) {
            $visitorPrevMessage[] = $individualVisitorPrevMessage;
        }
        foreach ($adminResponses as $individualAdminResponse) {
            $adminResponse[] = $individualAdminResponse;
        }
        return view('admin.messages.oldMessages', compact('visitorPrevMessage', 'adminResponse'));
    }



    // |---------------------------------- replyMessage ----------------------------------|
    public function replyMessage(Request $req, $messageId)
    {
        $recipientData = Message::find($messageId); // visitor Message
        $reply = new Message();
        $reply->repliedToId = $messageId;
        $reply->name = 'Admin';
        $reply->senderEmail = '0'; // 0 = site admin
        $reply->recipientEmail = $recipientData->senderEmail;
        $reply->message = $req->messageReply;
        $reply->status = '3'; // indicates admin response
        $reply->save();

        $recipientData->status='2'; // changes visitor message state to replied
        $recipientData->save();
        Mail::send(new replyToMessages($recipientData));
        return redirect('admin/viewAllMessages')->with('message', 'Email Sent');
    }



    // |---------------------------------- markAsUnreadMessage ----------------------------------|
    public function markAsUnreadMessage($messageId)
    {
        $message = Message::find($messageId);
        $message->status = "0";
        $message->save();

        return redirect()->action('messageController@viewAllMessages');
    }



    // |---------------------------------- markAsReadMessage ----------------------------------|
    public function markAsReadMessage($messageId)
    {
        $message = Message::find($messageId);
        $message->status = "1";
        $message->save();

        return redirect()->action('messageController@viewAllMessages');
    }



    // |---------------------------------- deleteMessage ----------------------------------|
    public function deleteMessage($messageId)
    {
        $message = Message::find($messageId);
        $message->delete();

        return redirect()->action('messageController@viewAllMessages');
    }



    // |---------------------------------- searchSender ----------------------------------|
    public function searchSender(Request $req)
    {
        $searchResults = Message::where('name', 'LIKE', '%'.$req->search.'%')->orWhere('senderEmail', 'LIKE', '%'.$req->search.'%')->get();
        return view('admin.messages.searchResult', compact('searchResults'));
    }
}
