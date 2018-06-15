<?php



// controller Details
// ------------------
// methods and their details
// ---------------------------
// index --> experimental method



namespace App\ Http\ Controllers;

use Illuminate\ Http\ Request;
use Bodunde\ GoogleGeocoder\ Geocoder;
use DB;
use Geocode;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
Use Auth;
Use App\Pharmacist;
use Pusher\Pusher;

class testController extends Controller {
    public function allRoutes()
    {
      return view('routeList');
    }
    
  public function index() {
    return view('email.sendVerificationEmailToUser');
    // echo 'this is a test controller for testing the new code befoore implimenting in actual code';
  }


   public  function fetchMedicineName(Request $request)
 {

  /*'name', 'like', '%' . Input::get('name') . '%'*/
/*    $data2 = DB::table('medicine_names')->
where('brandName', 'LIKE', '%'.$_GET['search'].'%')->get();*/

$data=DB::table('medicine_names')->where('brandName','like','%' . $_GET['search'].'%')->take(3)->get();
echo json_encode($data);
}



public function searchAskMed(Request $request)
{

$array=array(
0 => 'http://keer.aua.net.pk/mediDetails',
1 => 'http://keer.aua.net.pk/mediDetails2'
);
$response=$this->multiRequest($array);
// get size of $response
$responseSize = sizeof($response);
// loop for json decoding
for($i=0; $i<$responseSize-1; $i++)
$searchedProducts = json_decode($response[$i]);
dd($searchedProducts);
}



function multiRequest($data, $options = array()) {
  
 // array of curl handles
 $curly = array();
 // data to be returned
 $result = array();
 // multi handle
 $mh = curl_multi_init();
 // loop through $data and create curl handles
 // then add them to the multi-handle
 foreach ($data as $id => $d) {

   $curly[$id] = curl_init();

   $url = (is_array($d) && !empty($d['url'])) ? $d['url'] : $d;
   curl_setopt($curly[$id], CURLOPT_URL,            $url);
   curl_setopt($curly[$id], CURLOPT_HEADER,         0);
   curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);

   // post?
   if (is_array($d)) {
     if (!empty($d['post'])) {
       curl_setopt($curly[$id], CURLOPT_POST,       1);
       curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $d['post']);
     }
   }

   // extra options?
   if (!empty($options)) {
     curl_setopt_array($curly[$id], $options);
   }

   curl_multi_add_handle($mh, $curly[$id]);
 }

 // execute the handles
 $running = null;
 do {
   curl_multi_exec($mh, $running);
 } while($running > 0);


 // get content and remove handles
 foreach($curly as $id => $c) {
   $result[$id] = curl_multi_getcontent($c);
   curl_multi_remove_handle($mh, $c);
 }

 // all done
 curl_multi_close($mh);

 return $result;
}


 public function chat(Request $request)
    {
        if(Auth::check()){
            //pharmicist names 
            $data=DB::table('pharmacists')->get();
            return view('chatView',compact('data'));
        }
        else if(Auth::guard('pharmacist')->check())
            {
                //user names
                  $data=DB::table('users')->get();
            return view('chatView',compact('data'));
            }
            return view('chat');
        }
        public function getMessages(Request $request)
        {
         if(Auth::check()){
          $chat=DB::table('chat_records')->where('pharmicistName',$request->name)->where('userName',Auth::user()->name)->orderBy('created_at','DESC')->get();
          $data=DB::table('pharmacists')->get();
      }
      else if(Auth::guard('pharmacist')->check()){
       $chat=DB::table('chat_records')->where('pharmicistName',Auth::guard('pharmacist')->user()->name)->where('userName',$request->name)->orderBy('created_at','DESC')->get(); 
       $data=DB::table('users')->get();
   }
 /* if(sizeof($chat)==0){
    dd("ok");
    $data=new array();
    $data=(
        'id' => 1,
        ''
    );
  }*/
   return view('chatView',compact('data','chat'));
}



public function storeChatData(Request $request)
{
   if(Auth::check()){
   DB::insert('insert into  chat_records (pharmicistName,userName,senderName,message,created_at) values(?,?,?,?,?)',[$request->reciever,Auth()->user()->name,Auth()->user()->name,$request->message,new \dateTime]);
       //Remember to set your credentials below.
       $id=DB::table('pharmacists')->where('name',$request->reciever)->get();
      // dd($id);
       $id=$id[0]->id;
     $senderName=Auth()->user()->name;
     $reciever="pharmicist";
   //dispatch krna event with user id and message
   }
   else if(Auth::guard('pharmacist')->check()){
 DB::insert('insert into  chat_records (userName,pharmicistName,senderName,message,created_at) values(?,?,?,?,?)',[$request->reciever,Auth::guard('pharmacist')->user()->name,Auth::guard('pharmacist')->user()->name,$request->message,new \dateTime]);
$id=DB::table('users')->where('name',$request->reciever)->get();
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