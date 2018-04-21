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
    public function findPharmacies(Request $req, $lat = null, $lng = null)
    {

    // variable initialization
        $latitude = "";
        $longitude = "";
        $i = 0;

        // if user used auto detect location form
        if ($req->latitude && $req->longitude) {
            $latitude = $req->latitude;
            $longitude = $req->longitude;
        }
        // if user enters location manually or uses registered address then lat and lng from method "convertAddressToLatLong" are passed and used in else
        else {
            $latitude = $lat;
            $longitude = $lng;
        }
        // get distance from form and convert to kilometer
        $distance = $req->distance * 1.60934;

        // query to fetch pharmacies within the specified distance
        $nearByPharmacies = DB::select(DB::raw('SELECT *, ( 3959 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians(latitude) ) ) ) AS distance FROM pharmacists HAVING distance < '.$distance.' ORDER BY distance'));

        // get details of those nearby pharmacies to see if the pharmacistProuct table has the searched medicine
        foreach ($nearByPharmacies as $nearByPharmacy) {
            $searchedProducts[] = Pharmacistproduct::where([
      ['pharmacistId', '=', $nearByPharmacy->id],
      ['name', 'LIKE', '%'.$req->medicineSearched.'%']
      ])->get();
        }

        return view('siteView.searchResultPage', compact('searchedProducts', 'nearByPharmacies'));
    }


    //  |---------------------------------- convertAddressToLatLong ----------------------------------|
    // if user enters address manually or uses registered address
    public function convertAddressToLatLong(Request $req)
    {
        // get address from form
        $address = $req->address;

        // convert address to latitude and longitude
        $addressToLatLng = Geocode::make()->address($address);
        if ($addressToLatLng) {
            $latitude = $addressToLatLng->latitude();
            $longitude = $addressToLatLng->longitude();
            // pass latitude and longitude to "findPharmacies" method
            return $this->findPharmacies($req, $latitude, $longitude);
        }
    }


    //  |---------------------------------- pharmacyDetails ----------------------------------|
    public function pharmacyDetails($pharmacyId)
    {
        $pharmacy = Pharmacist::whereId($pharmacyId)->first();
        $allOrderId=[];
        $allCustomerId=[];
        $customer=[];
        $orders=[];

        $orderItems = Orderitem::where('pharmacistId', $pharmacyId)->orderBy('id', 'desc')->get();
        foreach ($orderItems as $orderItem) {
            $allOrderId[] = $orderItem->orderId;
        }
        $orderId = array_unique($allOrderId);
        for ($i=0; $i<count($orderId); $i++) {
            $orders[$i] = Order::whereId($orderId[$i])->first();
        }
        foreach ($orders as $order) {
            $allCustomerId[] = $order->userId;
        }
        $customerId = array_unique($allCustomerId);
        for ($i=0; $i<count($customerId); $i++) {
            $customers[$i] = User::whereId($customerId[$i])->first();
        }
        if(Auth::guard('admin')->check())
        return view('admin.users.pharmacyDetails', compact('pharmacy', 'orders', 'customers'));
        else
        return view('siteView.pharmacyDetails', compact('pharmacy', 'orders', 'customers'));
    }
}
