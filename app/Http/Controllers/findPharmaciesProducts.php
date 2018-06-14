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
      ])->paginate('2');
        }

        return view('siteView.searchResultPage', compact('searchedProducts', 'nearByPharmacies'));
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
        $pharmacyProducts = Pharmacistproduct::where('pharmacistId', $pharmacyId)->paginate(15);

        $orderItems = Orderitem::where('pharmacistId', $pharmacyId)->orderBy('id', 'desc')->paginate(15);
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
