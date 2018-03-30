<?php



// controller Details
// ------------------
// methods and their details
// ---------------------------
// findPharmacies --> finds pharmacies according to location and then finds the searched product in those pharmacies 
// convertAddressToLatLong --> in case user doesnt't use auto detect feature and instead enters address manually then this method converts the address entered in input field to lat long and passes the data to findPharmacies method
// pharmacyDetails --> displays the pharmacy details to user



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Bodunde\ GoogleGeocoder\ Geocoder;
use DB;
use Geocode;
use App\Pharmacist;
use App\Pharmacistproduct;

class findPharmaciesProducts extends Controller
{



//  |---------------------------------- findPharmacies ----------------------------------| 
  // find pharmacies within the specified distance
  public function findPharmacies(Request $req, $lat = null, $lng = null) {

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
    foreach($nearByPharmacies as $nearByPharmacy)
    $searchedProducts[] = Pharmacistproduct::where([
      ['pharmacistId', '=', $nearByPharmacy->id],
      ['name', 'LIKE', '%'.$req->medicineSearched.'%']
      ])->get();

    return view('siteView.searchResultPage', compact('searchedProducts', 'nearByPharmacies'));

  }


  //  |---------------------------------- convertAddressToLatLong ----------------------------------| 
  // if user enters address manually or uses registered address
  public function convertAddressToLatLong(Request $req) {
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
    return view('siteView.pharmacyDetails', compact('pharmacy'));
  }
}
