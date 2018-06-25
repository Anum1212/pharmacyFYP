<?php



// controller Details
// ------------------
// Methods Present
// ------------------
// 1) __construct
// 2) contactUs -> save user message to db
// 3) viewAllMessages -> view all messages from db
// 4) viewMessage -> view message details
// 5) viewAllMessagesOfSpecificSender -> view all messages sent by a specific user
// 6) replyMessage -> send message to customer/pharmacist
// 7) markAsUnreadMessage -> mark a message as unread
// 8) markAsReadMessage -> mark a message as read
// 9) deleteMessage  -> delete a message
// 10) searchSender -> search for message

// Possible Status(int) Types
// --------------------------
// 0 -> UnRead message
// 1 -> admin only Read message
// 2 -> admin replied to messages
// 3 -> indicates that message is admin response



namespace App\Http\Controllers;

use App\Mail\replyToMessages;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Mail;



class messageController extends Controller
{



  // |---------------------------------- 1) __construct ----------------------------------|
    public function __construct()
    {
        $this->middleware('auth:admin')->except(['contactUs']);
    }



    // |---------------------------------- 2) contactUs ----------------------------------|
    public function contactUs(Request $req)
    {
        $message = new Message();
        $message->name = $req->name;
        $message->senderEmail = $req->email;
        $message->recipientEmail = '0'; // 0 = site admin
        $message->message = $req->message;
        $message->save();
        return redirect()->back()->with('message', 'Admin will soon get in contact with you.');
    }



    // |---------------------------------- 3) viewAllMessages ----------------------------------|
    public function viewAllMessages(Request $req)
    {
        $totalUnreadMessages = Message::where('status', '0')->count();
        $unreadMessages = Message::where('status', '0')->latest()->paginate(3, ['*'], 'unreadTable');
        $totalReadMessages = Message::where([ // count only messages that are 1->read or 2->replied to
            ['status', '!=', '0'],
            ['status', '!=', '3'],
        ])->count();
        $readMessages = Message::where([ // show only messages that are 1->read or 2->replied to
            ['status', '!=', '0'],
            ['status', '!=', '3'],
        ])->latest()->paginate(3, ['*'], 'readTable');
        return view('admin.messages.viewAllMessages', compact('unreadMessages', 'readMessages', 'totalUnreadMessages', 'totalReadMessages'));
    }



    // |---------------------------------- 4) viewMessage ----------------------------------|
    public function viewMessage($messageId)
    {
        $message = Message::find($messageId);
        if (!empty($message)) {
            $allPreviousEmails = Message::where('senderEmail', $message->senderEmail)->get();
            return view('admin.messages.replyMessage', compact('message', '$allPreviousEmails'));
        } else {
            return redirect()->action('messageController@viewAllMessages')->with('error', 'Message not found');
        }
    }



    // |---------------------------------- 5) viewAllMessagesOfSpecificSender ----------------------------------|
    public function viewAllMessagesOfSpecificSender($messageId)
    {
        $adminResponse = [];
        $recipientData = Message::find($messageId); // visitor Message
        if (!empty($recipientData)) {
            $visitorPrevMessages = Message::where('senderEmail', $recipientData->senderEmail)->get();
            $adminResponses = Message::where('recipientEmail', $recipientData->senderEmail)->get();
            foreach ($visitorPrevMessages as $individualVisitorPrevMessage) {
                $visitorPrevMessage[] = $individualVisitorPrevMessage;
            }
            foreach ($adminResponses as $individualAdminResponse) {
                $adminResponse[] = $individualAdminResponse;
            }
            return view('admin.messages.oldMessages', compact('visitorPrevMessage', 'adminResponse'));
        } else {
            return redirect()->action('messageController@viewAllMessages')->with('error', 'Messages not found');
        }
    }



    // |---------------------------------- 6) replyMessage ----------------------------------|
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

        $recipientData->status = '2'; // changes visitor message state to replied
        $recipientData->save();
        Mail::send(new replyToMessages($recipientData));
        return redirect('admin/viewAllMessages')->with('message', 'Email Sent');
    }



    // |---------------------------------- 7) markAsUnreadMessage ----------------------------------|
    public function markAsUnreadMessage($messageId)
    {
        $message = Message::find($messageId);
        $message->status = "0";
        $message->save();

        return redirect()->action('messageController@viewAllMessages')->with('message', 'Mark as unread successful');
    }



    // |---------------------------------- 8) markAsReadMessage ----------------------------------|
    public function markAsReadMessage($messageId)
    {
        $message = Message::find($messageId);
        $message->status = "1";
        $message->save();

        return redirect()->action('messageController@viewAllMessages')->with('message', 'Mark as read successful');
    }



    // |---------------------------------- 9) deleteMessage ----------------------------------|
    public function deleteMessage($messageId)
    {
        $message = Message::find($messageId);
        $message->delete();

        return redirect()->action('messageController@viewAllMessages')->with('message', 'Delete successful');
    }



    // |---------------------------------- 10) searchSender ----------------------------------|
    public function searchSender(Request $req)
    {
        $totalSearchResults = Message::where('name', 'LIKE', '%' . $req->search . '%')->orWhere('senderEmail', 'LIKE', '%' . $req->search . '%')->count();
        $searchResults = Message::where('name', 'LIKE', '%' . $req->search . '%')->orWhere('senderEmail', 'LIKE', '%' . $req->search . '%')->paginate(30);
        return view('admin.messages.searchResult', compact('searchResults', 'totalSearchResults'));
    }
}
