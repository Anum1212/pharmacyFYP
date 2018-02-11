<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Auth;
use App\Pharmacydetail;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Redirect;

class PharmacistController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:pharmacist');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;

   $userData=Auth::user()->whereId( $userId )->first();
   if (Pharmacydetail::where('email', '=', $userData->email)->exists()) {
return view('pharmacist');
     }

else{
return view('pharmacist.pharmacyDetailsForm');
}
    }


    public function savePharmacyDetails(Request $req)
  {
        $this->validate($req,[
            'pharmacyName' => 'required|string|max:255',
            'freeDeliveryDistance' => 'required|numeric',
            'freeDeliveryPurchase' => 'required|numeric',
            'dbAPI' => 'required|',
          ]);


// *************************** Supported API ***************************
$clinAPI = 'https://clin-table-search.lhc.nlm.nih.gov/api/rxterms/v3/search';

// *********************************************************************

if (strpos($req->dbAPI, $clinAPI) !== false)
{
// if($req->dbAPI == clinApi)
          // ************** for clin API **************
          $api = 'https://clin-table-search.lhc.nlm.nih.gov/api/rxterms/v3/search';
          $medicine = $req->medicine;
          $medNotFound = '0';

          for ($i=0;$i<count($medicine); $i++)
          {
            $response[$i] = Curl::to($api)
              ->withData(['terms' => $medicine[$i]],['maxList'=>'1'],['q'=>'df'])
               ->asJson()
              ->get();

              if ($response[$i][0] == '0')
             $medNotFound = $medNotFound+1;

          }

          if($medNotFound >= '2')
          return redirect::back()->with('error', 'Api verifivcation failed');

          else{
          // ************** for university API **************

$saveRecord =new Pharmacydetail;
            $saveRecord->status = '1';
            $saveRecord->email = $req->email;
            $saveRecord->pharmacyName = $req->pharmacyName;
            $saveRecord->freeDeliveryDistance = $req->freeDeliveryDistance;
            $saveRecord->freeDeliveryPurchase = $req->freeDeliveryPurchase;
            $saveRecord->dbAPI = $req->dbAPI;
            $saveRecord->pharmacyAddress =  Auth::user()->address;
            $saveRecord->save();
            return redirect()->action('PharmacistController@index')->with('message', 'Record Saved');
  }
}
else
return redirect::back()->with('error', 'Sorry currently this API is not supported. Kindly contact Admin');
}
}
