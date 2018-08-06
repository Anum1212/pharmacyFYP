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
use Curl;
use DB;
use Auth;
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

function medicineDetails(Request $request, $medicineId, $pharmacyId)
{
    // get pharmacy details
    $pharmacyDetails = Pharmacist::whereId($pharmacyId)->first();
    
    // get pharmacy rating
    $pharmacyRating = Rating::where('pharmacyId', $pharmacyId)->first();
    
        // get product details
        $product = Pharmacistproduct::whereId($medicineId)->first();

    if($product->type != '8' || $product->category != 'category6'){
    $medicineName= $product->name;
    
    // call api and get strength and forms
    $strengthAndForms = Curl::to('https://clin-table-search.lhc.nlm.nih.gov/api/rxterms/v3/search')->withData(array( 'terms' => $medicineName,'ef' => 'STRENGTHS_AND_FORMS' ))->get();
    
    // json decode the response
    $jsonDecodeResponse = json_decode($strengthAndForms);
    
    // call api and get sideEffects
    $sideEffects = Curl::to('https://api.fda.gov/drug/label.json')->withData(array('search' => $medicineName))->get();
    
    // json decode the response
    $sideEffects = json_decode($sideEffects);
            
    // if no medicine strengths found
    if($jsonDecodeResponse[0]==0){
            return view('siteView.medicineDetails', compact('sideEffects', 'product', 'pharmacyDetails', 'pharmacyRating'))->with('medicineName', $strengthAndForms);
    }

    // if medicine strengths found
    else{
    $strengthAndForms = array(
        'name' => $jsonDecodeResponse[1],
        'detail' => $jsonDecodeResponse[2]->STRENGTHS_AND_FORMS
    );
    return view('siteView.medicineDetails', compact('sideEffects', 'strengthAndForms', 'product', 'pharmacyDetails', 'pharmacyRating'))->with('size', sizeof($strengthAndForms['name']))->with('medicineName', $strengthAndForms);
}
}
else
    return view('siteView.medicineDetails', compact('product', 'pharmacyDetails', 'pharmacyRating'));
}



//  |---------------------------------- 3) searchMedicine ----------------------------------|
    public function searchMedicine(Request $req)
    {
        // setting Variables

        if ($req->latitude != ""){
        $latitude =$req->latitude;
        $longitude = $req->longitude;
        $formatedAddress = $req->formatedAddress;
        $medicineSearched = $req->medicineSearched;
        }

        else{
            $latitude = session('latitude');
            $longitude = session('longitude');
            $formatedAddress = session('formatedAddress');
            $medicineSearched = session('medicineSearched');
        }

        // if form has value get value from form and convert to kilometer
        if ($req->distance != "")
            $distance = $req->distance;
        // else use session value 
        else
            $distance = session('distance');

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
            
            
// ----------------------- get products -----------------------            
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
                $productsCollection = new Collection();
                foreach ($websiteProducts as $collection) {
                    foreach ($collection as $item) {
                        $productsCollection->push($item);
                    }
                }
                if ($productsCollection->isEmpty()) 
return redirect()->back()->with('error', "Oops product not found in the defined radius. Try to increase the radius");
else
            return view('siteView.searchResultPage', compact('productsCollection', 'nearByPharmacies'));
        } // end of if(!empty($nearByPharmacies)) condition
    }



//  |---------------------------------- 4) searchMedicineByCategory ----------------------------------|
    // find pharmacies within the specified distance
    public function searchMedicineByCategory(Request $req, $categoryId)
    {
        
        // setting variables
        // checking if customer used the find medicine form first 
        // if yes then we will the distance and geolocation from that form
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
            $productsCollection = new Collection();
            foreach ($websiteProducts as $collection) {
                foreach ($collection as $item) {
                    $productsCollection->push($item);
                }
            }
                
                // if product not found return with error
            if ($productsCollection->isEmpty()) {
                return redirect('/')->with('error', "Oops no products found in this category.");
            }

            return view('siteView.searchResultPage', compact('productsCollection', 'nearByPharmacies'));
        } // end of if(!empty($nearByPharmacies)) condition
    }



    //  |---------------------------------- 6) pharmacyDetails ----------------------------------|
    public function pharmacyDetails($pharmacyId, $productId = null) //$productId for displaying the product that the user selected for viewing medicine details
    {
        $pharmacyRating = Rating::where('pharmacyId', $pharmacyId)->first();
        $pharmacy = Pharmacist::whereId($pharmacyId)->first();

            $selectedProduct = Pharmacistproduct::whereId($productId)->first();
            $pharmacyProducts = Pharmacistproduct::where('pharmacistId', $pharmacyId)->get();

        return view('siteView.pharmacyDetails', compact('pharmacy', 'pharmacyProducts', 'selectedProduct', 'pharmacyRating'));
    }
}
