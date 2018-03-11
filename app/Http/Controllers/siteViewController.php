<?php

namespace App\Http\Controllers;

use Illuminate\ Http\ Request;
use Bodunde\ GoogleGeocoder\ Geocoder;
use DB;
use Geocode;

class siteViewController extends Controller
{
     public function index() {
    return view('siteView.index');
  }

  // find pharmacies within the specified distance
  public function findPharmacies(Request $req, $lat = null, $lng = null) {

    // variable initialization
    $latitude = ""; 
    $longitude = ""; 

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

    // query to fetch pharmacies within the speccified distance
    $results = DB::select(DB::raw('SELECT id, ( 3959 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians(latitude) ) ) ) AS distance FROM pharmacists HAVING distance < '.$distance.' ORDER BY distance'));
    dd($results);

  }

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
}
