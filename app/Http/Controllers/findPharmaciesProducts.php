<?php



// controller Details
// ------------------
// methods and their details
// ---------------------------
// 1) findPharmacies --> finds pharmacies according to location and then finds the searched product in those pharmacies
// 2) convertAddressToLatLong --> in case user doesnt't use auto detect feature and instead enters address manually then this method converts the address entered in input field to lat long and passes the data to findPharmacies method
// 3) pharmacyDetails --> displays the pharmacy details to user



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Bodunde\ GoogleGeocoder\ Geocoder;
use DB;
use Auth;
use Geocode;
use App\User;
use App\Pharmacist;
use App\Pharmacistproduct;
use App\Order;
use App\Orderitem;

class findPharmaciesProducts extends Controller
{



//  |---------------------------------- findPharmacies ----------------------------------|
    // find pharmacies within the specified distance
    public function findPharmacies(Request $req)
    {
            $latitude = $req->latitude;
            $longitude = $req->longitude;

        // get distance from form and convert to kilometer
        $distance = $req->distance * 1.60934;

        // query to fetch pharmacies within the specified distance
        $nearByPharmacies = DB::select(DB::raw('SELECT *, ( 3959 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians(latitude) ) ) ) AS distance FROM pharmacists HAVING distance < '.$distance.' ORDER BY distance'));

        // get details of those nearby pharmacies to see if the pharmacistProuct table has the searched medicine
        foreach ($nearByPharmacies as $nearByPharmacy) {
            $searchedProducts[] = Pharmacistproduct::where([
      ['pharmacistId', '=', $nearByPharmacy->id],
      ['name', 'LIKE', '%'.$req->medicineSearched.'%'],
      ['status', '=', '1']
      ])->paginate('30');
        }
        // dd($searchedProducts);
        return view('siteView.searchResultPage', compact('searchedProducts', 'nearByPharmacies'));
    }



//  |---------------------------------- fetchMedicineName ----------------------------------|
    public  function fetchMedicineName(Request $request){
        $data=DB::table('medicine_names')->where('brandName','like','%' . $_GET['search'].'%')->take(3)->get();
        echo json_encode($data);
}



//  |---------------------------------- searchAskMed ----------------------------------|
    public function searchAskMed(Request $request){
        $array=array(
        0 => 'http://keer.aua.net.pk/mediDetails',
        1 => 'http://keer.aua.net.pk/mediDetails2'
        );
        $response=$this->multiRequest($array);
        // get size of $response
        $responseSize = sizeof($response);
        // loop for json decoding
        for($i=0; $i<$responseSize-1; $i++)
        $searchedProduct[] = json_decode($response[$i]);
        // converting to collection to match output result with findPharmacies method
        $searchedProducts[] = collect($searchedProduct);
        // dd($searchedProduct);
        return view('siteView.searchResultPage', compact('searchedProducts'));
}



//  |---------------------------------- multiRequest ----------------------------------|
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







































































































































    //  |---------------------------------- pharmacyDetails ----------------------------------|
    public function pharmacyDetails($pharmacyId, $productId = null) //$productId for displaying the product that the user selected for viewing medicine details
    {
        $pharmacy = Pharmacist::whereId($pharmacyId)->first();
        $allOrderId=[];
        $allCustomerId=[];
        $customer=[];
        $orders=[];

        $selectedProduct = Pharmacistproduct::whereId($productId)->first();
        $pharmacyProducts = Pharmacistproduct::where('pharmacistId', $pharmacyId)->paginate(30);

        $orderItems = Orderitem::where('pharmacistId', $pharmacyId)->orderBy('id', 'desc')->paginate(30);
        foreach ($orderItems as $orderItem) {
            $allOrderId[] = $orderItem->orderId;
        }

        // to remove duplicates
        $orderId = array_unique($allOrderId);
        
        // to renumber the array index after using array_unique() i.e after using array_unique() the array may look like
        // index => value
        // 0     =>   1
        // 2     =>   3 
        // 7     =>   9 
        // to fix this we use array_values()
        // which will give the result
        // index => value
        // 0     =>   1
        // 1     =>   3 
        // 2     =>   9

        $arrangedOrderId = array_values($orderId);
        for ($i=0; $i<count($arrangedOrderId); $i++) {
            $orders[$i] = Order::whereId($arrangedOrderId[$i])->first();
        }
        foreach ($orders as $order) {
            $allCustomerId[] = $order->userId;
        }
        // to remove duplicates
        $customerId = array_unique($allCustomerId);
        // to renumber the array index after using array_unique() i.e after using array_unique() the array may look like
        // index => value
        // 0     =>   1
        // 2     =>   3 
        // 7     =>   9 
        // to fix this we use array_values()
        // which will give the result
        // index => value
        // 0     =>   1
        // 1     =>   3 
        // 2     =>   9
        $arrangedCustomerId = array_values($customerId);
        for ($i=0; $i<count($arrangedCustomerId); $i++) {
            $customers[$i] = User::whereId($arrangedCustomerId[$i])->first();
        }
        return view('siteView.pharmacyDetails', compact('pharmacy', 'pharmacyProducts', 'selectedProduct', 'orders', 'customers'));
    }
}
