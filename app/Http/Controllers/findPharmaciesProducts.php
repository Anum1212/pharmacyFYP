<?php



// controller Details
// ------------------
// Methods Present
// ------------------
// 1) medicineDetails
// 2) findPharmacies
// 3) fetchMedicineName
// 4) searchAskMed
// 5) multiRequest
// 6) pharmacyDetails



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Curl;
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



//  |---------------------------------- 1) medicineDetails ----------------------------------|

function medicineDetails(Request $request)
{
    $data="zyrtec";
        $strengthAndFroms = Curl::to('https://clin-table-search.lhc.nlm.nih.gov/api/rxterms/v3/search')->withData(array( 'terms' => $data,'ef' => 'STRENGTHS_AND_FORMS' ))->get();
        $data = json_decode($strengthAndFroms);
        //dd($data[2]->STRENGTHS_AND_FORMS);
        $strengthAndFroms=array(
  'name' => $data[1],
  'detail' => $data[2]->STRENGTHS_AND_FORMS
);
        $details=$strengthAndFroms['detail'];
        // dd($details[0]);
        $names=$data[1];
        $details=$data[2]->STRENGTHS_AND_FORMS;
        // dd(sizeof($strengthAndFroms['name']));
        $size=sizeof($strengthAndFroms);




        $data="aspirin";
        $medicineName=DB::table('medicine_names')->select('genericName')->where('id', $request->id)->get();
        //dd($medicineName);
        $sideEffects = Curl::to('https://api.fda.gov/drug/label.json')->withData(array( 'search' => /*$medicineName[0]->genericName*/ $data ))->get();
        $sideEffects=json_decode($sideEffects);

        if (!isset($sideEffects->results[0]->precautions[0])  and !isset($sideEffects->results[0]->warnings[0])) {
            session()->flash('error', 'medicine info not available');
            return view('arham.searchPage')->withError("medicine info not available");
        } else {
            return view('siteView.medicineDetails', compact('sideEffects', 'strengthAndFroms'))->with('size', sizeof($strengthAndFroms['name']))->with('mediName', $data);
        }









}



//  |---------------------------------- 2) findPharmacies ----------------------------------|
    // find pharmacies within the specified distance
    public function findPharmacies(Request $req)
    {
        $latitude = $req->latitude;
        $longitude = $req->longitude;

        // get distance from form and convert to kilometer
        $distance = $req->distance * 1.60934;

        // query to fetch pharmacies within the specified distance
        $nearByPharmacies = DB::select(DB::raw('SELECT *, ( 3959 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians(latitude) ) ) ) AS distance FROM pharmacists HAVING distance < '.$distance.' ORDER BY distance'));

        // if no pharmacies found nearby redirect with message
        if (empty($nearByPharmacies)) {
            return redirect()->back()->with('error', 'oops no pharmacies in the defined radius');
        }

        // if pharmacies found nearby then find the searched product in them
        if (!empty($nearByPharmacies)) {
            // get details of those nearby pharmacies to see if the pharmacistProuct table has the searched medicine
            foreach ($nearByPharmacies as $nearByPharmacy) {
                $searchedProducts[] = Pharmacistproduct::where([
      ['pharmacistId', '=', $nearByPharmacy->id],
      ['name', 'LIKE', '%'.$req->medicineSearched.'%'],
      ['status', '=', '1']
      ])->get();
            }

            // ********** critical step **********
            // $searchedProducts is an array of collections
            // in the code below we combine the collections into 1 collection
            // benefits
            // 1) easy to detect if no product found
            // 2) easy to use

            $searchedProductsMergeCollection = new Collection();
            foreach ($searchedProducts as $collection) {
                foreach ($collection as $item) {
                    $searchedProductsMergeCollection->push($item);
                }
            }
            // if product not found return with error
            if ($searchedProductsMergeCollection->isEmpty()) {
                return redirect('/')->with('error', "Oops product not found in the defined radius.<ul style='list-style:none'><li>Try to increase the radius</li><li>or <a href='setAvailabilityNotification/$req->medicineSearched/$latitude/$longitude'><b>Click here</b></a> to get notified when product is available near you</li></ul>");
            }

            return view('siteView.searchResultPage', compact('searchedProductsMergeCollection', 'nearByPharmacies'));
        } // end of if(!empty($nearByPharmacies)) condition
    }



    //  |---------------------------------- 3) fetchMedicineName ----------------------------------|
    public function fetchMedicineName(Request $request)
    {
        $data=DB::table('medicine_names')->where('brandName', 'like', '%' . $_GET['search'].'%')->take(3)->get();
        echo json_encode($data);
    }



    //  |---------------------------------- 4) searchAskMed ----------------------------------|
    public function searchAskMed(Request $request)
    {
        $array=array(
        // 0 => 'http://127.0.0.1:8000/api/api1/getAllMedicines', for local host ignore

        // ------------------------------------
        // arham in routes ko use krna hai
        // ------------------------------------

        // see keer web routes and controller further details of all methods
        // to get all medicines
        0 => 'http://keer.aua.net.pk/api1/getAllMedicines',
        // // to get medicine by id
        // 0 => 'http://keer.aua.net.pk/api1/getSpecificMedicineById',
        // // to get medicine by name
        // 0 => 'http://keer.aua.net.pk/api1/getSpecificMedicineByName',

        1 => 'http://keer.aua.net.pk/mediDetails2'
        );

        $response=$this->multiRequest($array);
        // get size of $response
        $responseSize = sizeof($response);
        // loop for json decoding
        for ($i=0; $i<$responseSize; $i++) {
            $searchedProducts[] = json_decode($response[$i]);
        }
        // converting to collection to match output result with findPharmacies method
        // $searchedProducts[] = collect($searchedProduct);
        // dd($searchedProduct);
        return view('siteView.searchResultPage', compact('searchedProducts'));
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



    //  |---------------------------------- 6) pharmacyDetails ----------------------------------|
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
