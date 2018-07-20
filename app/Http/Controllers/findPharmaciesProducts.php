<?php



// controller Details
// ------------------
// Methods Present
// ------------------
// 1)__construct
// 2) medicineDetails
// 3) searchMedicine
// 4) searchMedicineByCategory
// 5) multiRequest
// 6) pharmacyDetails



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Session;
use Bodunde\ GoogleGeocoder\ Geocoder;
use Curl;
use DB;
use Auth;
use Geocode;
use App\User;
use App\Pharmacist;
use App\Pharmacistproduct;
use App\Order;
use App\Orderitem;
use App\Rating;
use Cart;

class findPharmaciesProducts extends Controller
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



//  |---------------------------------- 2) medicineDetails ----------------------------------|

function medicineDetails(Request $request, $productSource, $medicineId, $pharmacyId)
{
    // get pharmacy details
    $pharmacyDetails = Pharmacist::whereId($pharmacyId)->first();
    
    // get pharmacy rating
    $pharmacyRating = Rating::where('pharmacyId', $pharmacyId)->first();
    
    // if product is from web storage
    if($productSource=='1'){
        // using product as array to match result with api product response
        $product = [];
        // get product details
        $product[] = Pharmacistproduct::whereId($medicineId)->first();
    }

    // if product is from api
    if($productSource=='2'){
        $pharmacyApi = $pharmacyDetails->dbAPI.$medicineId;
        // get product details
        $product = Curl::to($pharmacyApi)->asJson()->get();
    }

    if($product[0]->type != '8' || $product[0]->category != 'category6'){
    $medicineName= $product[0]->name;
    
    // call api and get strength and forms
    $strengthAndFroms = Curl::to('https://clin-table-search.lhc.nlm.nih.gov/api/rxterms/v3/search')->withData(array( 'terms' => $medicineName,'ef' => 'STRENGTHS_AND_FORMS' ))->get();
    
    // json decode the response
    $jsonDecodeResponse = json_decode($strengthAndFroms);
    
    // call api and get sideEffects
    $sideEffects = Curl::to('https://api.fda.gov/drug/label.json')->withData(array('search' => /*$medicineName[0]->genericName*/ $medicineName))->get();
    
    // json decode the response
    $sideEffects = json_decode($sideEffects);
            
    // if no medicine strengths found
    if($jsonDecodeResponse[0]==0){
            return view('siteView.medicineDetails', compact('sideEffects', 'product', 'pharmacyDetails', 'pharmacyRating'))->with('mediName', $strengthAndFroms);
    }

    // if medicine strengths found
    else{
    $strengthAndFroms = array(
        'name' => $jsonDecodeResponse[1],
        'detail' => $jsonDecodeResponse[2]->STRENGTHS_AND_FORMS
    );
    return view('siteView.medicineDetails', compact('sideEffects', 'strengthAndFroms', 'product', 'pharmacyDetails', 'pharmacyRating'))->with('size', sizeof($strengthAndFroms['name']))->with('mediName', $strengthAndFroms);
}
}
else
    return view('siteView.medicineDetails', compact('product', 'pharmacyDetails', 'pharmacyRating'));
}



//  |---------------------------------- 3) searchMedicine ----------------------------------|
    public function searchMedicine(Request $req)
    {
        if (!Cache::has('key')) {
            Cache::forever('key', 0);
        } else {
            $count = Cache::get('key');
            $count = ++$count;
            Cache::forever('key', $count);
        }
        if (Cache::get('key') > 0) {
  //user is reloading from same browser
            Cache::forget('key');
         // return redirect()->back()->withError('kindly search medicine again');
        }

        /*$reloadTime=$_COOKIE[$cookie_name];*/

        $starttime = microtime(true);
   //setting time limit infinite for unlimited execution of the code
        set_time_limit(0);
        if (!isset($request->trim)) {
            $trim = 0;
        } else {
            $trim = (int)$request->trim;
          /* dd(gettype($trim));*/
        }


        // setting Variables
        $latitude = $req->latitude;
        $longitude = $req->longitude;
        $formatedAddress = $req->formatedAddress;
        $medicineSearched = $req->medicineSearched;
        // if session already has value use it
        if (Session::has('distance'))
        $distance = session('distance');
        // else get value from form and convert to kilometer
        else
        $distance = $req->distance;

        // setting session values
        session(['latitude' => $latitude, 'longitude'=> $longitude, 'medicineSearched'=>$medicineSearched, 'formatedAddress'=>$formatedAddress, 'distance'=> $distance]);
        

        // query to fetch pharmacies within the specified distance
        $nearByPharmacies = DB::select(DB::raw('SELECT *, ( 3959 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians(latitude) ) ) ) AS distance FROM pharmacists HAVING distance < '.$distance * 1.60934.' ORDER BY distance'));
        
        
        // if no pharmacies found nearby redirect with message
        if (empty($nearByPharmacies)) {
            return redirect()->back()->with('error', 'oops no pharmacies in the defined radius');
        }
        
        // if pharmacies found nearby then find the searched product in them
        if (!empty($nearByPharmacies)) {
            
            
// ----------------------- get products from local website storage -----------------------            
            foreach ($nearByPharmacies as $nearByPharmacy) {
                $websiteProducts[] = Pharmacistproduct::where([
                    ['pharmacistId', '=', $nearByPharmacy->id],
                    ['name', 'LIKE', '%'.$medicineSearched.'%'],
                    ['status', '=', '1']
                    ])->get();
                }

                // ********** critical step **********
                // $websiteProducts is an array of collections
                // in the code below we combine the collections into 1 collection
                $websiteProductsCollection = new Collection();
                foreach ($websiteProducts as $collection) {
                    foreach ($collection as $item) {
                        $websiteProductsCollection->push($item);
                    }
                }
                

// ----------------------- get products from api -----------------------
                $apiProducts = [];
                foreach ($nearByPharmacies as $nearByPharmacy) {
                    if ($nearByPharmacy->dataSource == '2') {
                        $apiProducts[] = $nearByPharmacy->dbAPI. $medicineSearched;
                    }
                }
                sleep(0);
                
                //function to call multiple api
                $multiRequestResponse = $this->multiRequest($apiProducts);
                //dd($medicineRecordFromApi);
                //local medicine array
                $trim = $trim + 4;
                
                // get size of $response
                $multiRequestResponseSize = sizeof($multiRequestResponse);
                // loop for json decoding
                for ($i = 0; $i < $multiRequestResponseSize; $i++) {
                    $responseFromApi[] = json_decode($multiRequestResponse[$i]);
                }

                // responseFromApi is an array of collections of collection
                // the code below converts it into collection of collcections
                $apiProductsIntialCollection = new Collection();
                foreach ($responseFromApi as $collection) {
                    foreach ($collection as $item) {
                        $apiProductsIntialCollection->push($item);
                    }
                }
                
                // apiProductsIntialCollection is an array of collections
                // the code below converts it into 1 collection
            $apiProductsCollection = new Collection();
            foreach ($apiProductsIntialCollection as $collection) {
                foreach ($collection as $item) {
                    $apiProductsCollection->push($item);
                }
            }

            // the code below merges websiteProductsCollection & apiProductsCollection into one collection
            $productsCollection = $websiteProductsCollection->merge($apiProductsCollection);

            // if product not found return with error
                if ($productsCollection->isEmpty()) {
                    return redirect()->back()->with('error', "Oops product not found in the defined radius.<ul style='list-style:none'><li>Try to increase the radius</li><li>or <a href='' id = 'showNotifyModal' data-toggle= 'modal' data-target='#notifyModal'><b>Click here</b></a> to get notified when product is available near you</li></ul>");
                }

            return view('siteView.searchResultPage', compact('productsCollection', 'nearByPharmacies'));
        } // end of if(!empty($nearByPharmacies)) condition
    }



//  |---------------------------------- 4) searchMedicineByCategory ----------------------------------|
    // find pharmacies within the specified distance
    public function searchMedicineByCategory(Request $req, $categoryId)
    {
        if (!Cache::has('key')) {
            Cache::forever('key', 0);
        } else {
            $count = Cache::get('key');
            $count = ++$count;
            Cache::forever('key', $count);
        }
        if (Cache::get('key') > 0) {
  //user is reloading from same browser
            Cache::forget('key');
         // return redirect()->back()->withError('kindly search medicine again');
        }

        /*$reloadTime=$_COOKIE[$cookie_name];*/

        $starttime = microtime(true);
   //setting time limit infinite for unlimited execution of the code
        set_time_limit(0);
        if (!isset($request->trim)) {
            $trim = 0;
        } else {
            $trim = (int)$request->trim;
          /* dd(gettype($trim));*/
        }

        // setting variables
        // checking if customer used the find medicine form first 
        // if yes then we will the distance and geoloacation from that form
        // if session already has latitude use it
        if (Session::has('latitude')){
        $latitude = session('latitude');
        $longitude = session('longitude');
        }
        else{
            $latitude =  $req->latitude;
            $longitude = $req->longitude;
        }
        // if session already has distance use it
        if (Session::has('distance'))
            $distance = session('distance');
        // else use default value of 15 kilometer
        else
            $distance = '15';

        // set session values
        session(['latitude' => $latitude, 'longitude'=> $longitude, 'distance'=> $distance]);

        // query to fetch pharmacies within the specified distance
        $nearByPharmacies = DB::select(DB::raw('SELECT *, ( 3959 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians(latitude) ) ) ) AS distance FROM pharmacists HAVING distance < '.$distance.' ORDER BY distance'));

        
        
        // if no pharmacies found nearby redirect with message
        if (empty($nearByPharmacies)) {
            return redirect()->back()->with('error', 'oops no pharmacies in the defined radius');
        }
        
        // if pharmacies found nearby then find the searched product in them
        if (!empty($nearByPharmacies)) {
            
            
// ----------------------- get products from local website storage -----------------------            
            foreach ($nearByPharmacies as $nearByPharmacy) {
                $websiteProducts[] = Pharmacistproduct::where([
                    ['pharmacistId', '=', $nearByPharmacy->id],
                    ['category', $categoryId],
                    ['status', '=', '1']
                ])->get();
            }

                // ********** critical step **********
                // $websiteProducts is an array of collections
                // in the code below we combine the collections into 1 collection
            $websiteProductsCollection = new Collection();
            foreach ($websiteProducts as $collection) {
                foreach ($collection as $item) {
                    $websiteProductsCollection->push($item);
                }
            }
                

// ----------------------- get products from api -----------------------
            $apiProducts = [];
            foreach ($nearByPharmacies as $nearByPharmacy) {
                if ($nearByPharmacy->dataSource == '2') {
                    $apiProducts[] = $nearByPharmacy->dbAPI . $categoryId;
                }
            }
            sleep(0);
                
                //function to call multiple api
            $multiRequestResponse = $this->multiRequest($apiProducts);
                //dd($medicineRecordFromApi);
                //local medicine array
            $trim = $trim + 4;
                
                // get size of $response
            $multiRequestResponseSize = sizeof($multiRequestResponse);
                // loop for json decoding
            for ($i = 0; $i < $multiRequestResponseSize; $i++) {
                $responseFromApi[] = json_decode($multiRequestResponse[$i]);
            }

                // responseFromApi is an array of collections of collection
                // the code below converts it into collection of collcections
            $apiProductsIntialCollection = new Collection();
            foreach ($responseFromApi as $collection) {
                foreach ($collection as $item) {
                    $apiProductsIntialCollection->push($item);
                }
            }
                
                // apiProductsIntialCollection is an array of collections
                // the code below converts it into 1 collection
            $apiProductsCollection = new Collection();
            foreach ($apiProductsIntialCollection as $collection) {
                foreach ($collection as $item) {
                    $apiProductsCollection->push($item);
                }
            }

            // the code below merges websiteProductsCollection & apiProductsCollection into one collection
            $productsCollection = $websiteProductsCollection->merge($apiProductsCollection);

                // if product not found return with error
            if ($productsCollection->isEmpty()) {
                return redirect('/')->with('error', "Oops no products found in this category.");
            }

            return view('siteView.searchResultPage', compact('productsCollection', 'nearByPharmacies'));
        } // end of if(!empty($nearByPharmacies)) condition
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
        $pharmacyRating = Rating::where('pharmacyId', $pharmacyId)->first();
        $pharmacy = Pharmacist::whereId($pharmacyId)->first();

        if($pharmacy->dataSource == '1'){
            $selectedProduct = [];
            $selectedProduct[] = Pharmacistproduct::whereId($productId)->first();
            $pharmacyProducts = Pharmacistproduct::where('pharmacistId', $pharmacyId)->get();
        }

        if($pharmacy->dataSource == '2'){
            $pharmacyApi = rtrim($pharmacy->dbAPI, '/');
        // get product details
            $responseFromApi = Curl::to($pharmacyApi)->asJson()->get();
            $selectedProduct = Curl::to($pharmacyApi.'/'.$productId)->asJson()->get();
        // responseFromApi is an array of collections of collection
        // the code below converts it into collection of collcections
            $pharmacyProducts = new Collection();
            foreach ($responseFromApi as $collection) {
                foreach ($collection as $item) {
                    $pharmacyProducts->push($item);
                }
            }
        }
        return view('siteView.pharmacyDetails', compact('pharmacy', 'pharmacyProducts', 'selectedProduct', 'pharmacyRating'));
    }
}
