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
use Illuminate\Support\Facades\Cache;
Use App\Pharmacist;
use App\Pharmacistproduct;
use Pusher\Pusher;

class testController extends Controller {
    public function allRoutes()
    {
      return view('routeList');
    }
    
  public function index() {
    return view('siteLayout.index');
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
   //dd($request);
       $id=DB::table('pharmacists')->where('name',$request->reciever)->get();
     //  dd($id);
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
public function storeSearhData(Request $request)
{

  if(isset($request->medId))
  {
$medicineName=DB::table('medicine_names')->select('brandName')->where('id',$request->medId)->get();
$medicine=$medicineName[0]->brandName;
  }
  else
  {
$medicine=$request->name;
  }
  if(DB::table('mostsearch')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->where('userId',1)->where('name',$medicine)->count()<4)
    {
// allow him rto store the data
      DB::insert('insert into  mostsearch(userId,name,created_at) values(?,?,?)',[1,$medicine,\Carbon\Carbon::today()->toDateString()]);
    }
    else
    {
      // do not save record
    }
 /* dd(\Carbon\Carbon::today()->toDateString());*/
  echo json_encode($request->medId);
}
public function displayMostSearchMedicines()
{
  $medicines=DB::table('mostsearch')->select('name',DB::raw('count(name) as total'))->whereMonth('created_at','=', date('m'))->groupBy('name')->orderBy('total','DESC')->take(10)->get();
  //dd($medicines);
  return view('graph',compact('medicines'));        
}
 public function searchMed(Request $request)
      {
        /*dd($request->latitude);*/
        if (!Cache::has('key')) {
          Cache::forever('key',0);
        }
        else
        {
          $count=Cache::get('key');
          $count=++$count;
          Cache::forever('key',$count);
        }
        if(Cache::get('key')>0)
        {
  //user is reloading from same browser
          Cache::forget('key');
         // return redirect()->back()->withError('kindly search medicine again');
        }

        /*$reloadTime=$_COOKIE[$cookie_name];*/

        $starttime = microtime(true);
   //setting time limit infinite for unlimited execution of the code             
        set_time_limit(0);
        if(!isset($request->trim))
        {
          $trim=0;
        }
        else
        {
          $trim=(int)$request->trim;
          /* dd(gettype($trim));*/
        }
        if(!$request->latitude)
        {
      //location is not available kindly search it from ip
         $ip=$request->ip();
   //    $ip="103.255.4.247";
         $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
 //dd($query);
         $latitude=$query['lat'];
         $longitude=$query['lon'];
       }

       $nearByPharmacies = DB::select(DB::raw('SELECT *, ( 3959 * acos( cos( radians('.$request->latitude.') ) * cos( radians(  latitude) ) * cos( radians(longitude) - radians('.$request->longitude.') ) + sin( radians('.$request->latitude.') ) * sin( radians(latitude) ) ) ) AS distance FROM pharmacists HAVING distance < '.$request->distanceVal.' ORDER BY distance LIMIT '.$trim.' , 4 '));
 // dd($nearByPharmacies);
       $medicineName=DB::table('medicine_names')->select('genericName','brandName')->where('id',$request->medId)->get();
    //dd( $medicineName);
//website pharmacy data 
       $localPharmArray=[];
       for($i=0;$i<=sizeof($nearByPharmacies)-1;$i++){

         if($nearByPharmacies[$i]->typeOfStorage=='inventory')
         {
          $localPharmArray[]=$nearByPharmacies[$i]->pharmacyName;
        }
      }
  /*    dd($localPharmArray);*/
//api pharmacy array 
      $apiArray=[];
      for($i=0;$i<=sizeof($nearByPharmacies)-1;$i++){

       if($nearByPharmacies[$i]->typeOfStorage=='API')
       {
        $apiArray[]=$nearByPharmacies[$i]->api.'?medicineName='.$medicineName[0]->brandName;
      }
    }
    sleep(0);

//at here you have to apply medicine condition

            // get details of those nearby pharmacies to see if the pharmacistProuct table has the searched medicine
    for($i=0;$i<sizeof($localPharmArray);$i++) {
      $searchedProductsFromLocal[] = Pharmacistproduct::where([
        ['pharmacistName', '=',$localPharmArray[$i]],
        ['name', 'LIKE', '%'.$medicineName[0]->brandName.'%'],
        ['status', '=', '1']
      ])->get();
    }
/*dd($localPharmArray);*/
/*dd($searchedProductsFromLocal);*/

//function to call multiple api
    $medicineRecordFromApi = $this->multiRequest($apiArray);
 //dd($medicineRecordFromApi);
//local medicine array
    $trim=$trim+4;

    if(!isset($request->user_id)){
    /*  dd("reach");*/
  //browser is reloading for first time
      /*  dd(session()->get('ReloadCount'));*/
      $user_id=md5(rand(10,1000));
  //we are entering data into it if time limit exeeds then at upper place data can be achieve 
      session()->flash('uniqueID',$user_id);

      $savingRequestForLocalPharmacy=$this->saveDataRequiredFromLocal($nearByPharmacies,$medicineName[0]->brandName,$user_id);
    }
    else{
    //is code ma tab ae ga jab user next ka button click kra user_id pehle sa set hugi 
      $user_id=$request->user_id;
    //we are entering data into it if time limit exeeds then at upper place data can be achieve
    $id=DB::table('localfetchrecord')->where('user_id',$user_id)->get();
    DB::table('localfetchrecord')->where('id',$id[0]->id)->delete();

  /*   dd("eax");*/
      $savingRequestForLocalPharmacy=$this->saveDataRequiredFromLocal($nearByPharmacies,$medicineName[0]->brandName,$user_id);
      session()->flash('uniqueID',$user_id);
//reload else 
    }
    $longitude=$request->longitude;
    $latitude=$request->latitude;
    $medId=$request->medId;
    $distanceVal=$request->distanceVal;  
    goto tryAgainLocal;
    tryAgainLocal:
     $user_id=session()->get('uniqueID');
    if(microtime(true)-$starttime >30 )
    {
    //TIME RETURN PRODUCT VIEW with desktop and pharmacy result and user 

  /*  var_dump($user_id);
  var_dump($medicineRecordFromApi);*/
 /* var_dump($searchedProductsFromLocal);
 die();*/

 Cache::forget('key');
 /*dd(json_decode($medicineRecordFromApi[0][0]));*/
 /*dd('reach');*/
 return view('productView',compact('distanceVal','trim','user_id','longitude','latitude','medId','medicineRecordFromApi','searchedProductsFromLocal'));
}
//dd($user_id);
if(DB::table('local_medicines_results')->where('user_id',$user_id)->exists())
{

 $LocalMedicinesResult=DB::table('local_medicines_results')->where('user_id',$user_id)->get();
 /*$LocalMedicinesResult=DB::table('local_medicines_results')->where('user_id',$uniqueIdentity)->get();*/
}
else
{ 
  goto tryAgainLocal;
    //sleep(30);
}
/*dd($LocalMedicinesResult);*/
Cache::forget('key');
$longitude=$request->longitude;
    $latitude=$request->latitude;
    $medId=$request->medId;
    $distanceVal=$request->distanceVal;  
   /* dd($medicineRecordFromApi);*/
return view('productView',compact('distanceVal','trim','user_id','longitude','latitude','medId','medicineRecordFromApi','searchedProductsFromLocal','LocalMedicinesResult'));
if(0==1)
{

  //trim number 
}
}
function saveDataRequiredFromLocal($results,$medicineName,$user_id)
{
  $localPharmacyNamesArray=[];
  for($i=0;$i<=sizeof($results)-1;$i++)
  { 
   if($results[$i]->typeOfStorage=='desktop')
   {
    $localPharmacyNamesArray[]=$results[$i]->pharmacyName;
  }
}
$request=array(
  'localPharmacyNamesArray' => $localPharmacyNamesArray,
  'medicineName' => $medicineName,
);
/*$user_id=md5($user_id);*/
DB::insert('insert into  localfetchrecord (user_id,request,pharmacyNames) values(?,?,?)',[$user_id,serialize($request),implode(',',$localPharmacyNamesArray)]);
}
    //  |---------------------------------- 5) multiRequest ----------------------------------|
public function multiRequest($data, $options = array())
{
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
    curl_setopt($curly[$id], CURLOPT_URL, $url);
    curl_setopt($curly[$id], CURLOPT_HEADER, 0);
    curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);

            // post?
    if (is_array($d)) {
      if (!empty($d['post'])) {
        curl_setopt($curly[$id], CURLOPT_POST, 1);
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
  } while ($running > 0);


        // get content and remove handles
  foreach ($curly as $id => $c) {
    $result[$id] = curl_multi_getcontent($c);
    curl_multi_remove_handle($mh, $c);
  }

        // all done
  curl_multi_close($mh);

  return $result;
}
}