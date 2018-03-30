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

class testController extends Controller {
    //   public function __construct()
    // {
    //     $this->middleware('auth:pharmacist');
    // }

    public function allRoutes()
    {
      return view('routeList');
    }
    
  public function index() {
    echo 'this is a test controller for testing the new code befoore implimenting in actual code';
  }
}