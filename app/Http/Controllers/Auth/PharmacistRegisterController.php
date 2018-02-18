<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Pharmacist;
use App\Rating;
use Auth;
use Geocode;
use Mail;
use App\Mail\verifyEmailToPharmacist;

class PharmacistRegisterController extends Controller
{
  public function __construct()
  {
      $this->middleware('guest:pharmacist',['except' => ['logout']]);
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('pharmacist');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('auth.pharmacist-register');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $req
   * @return \Illuminate\Http\Response
   */
  public function store(Request $req)
  {

      // validate the data
      $this->validate($req, [
        'name'          =>      'required|string|max:255',
        'email'         =>      'required|string|email|max:255|unique:pharmacists',
        'contact'       =>      'required|digits:11',
        'pharmacyName'  =>      'required',
        'address'       =>      'required',
        'society'       =>      'required',
        'city'          =>      'required',
        'password'      =>      'required|string|min:6|confirmed'

      ]);
      $address = $req->address.' '.$req->society.' '.$req->city;
              $addressToLatLng = Geocode::make()->address($address);
       if ($addressToLatLng) {

    	$latitude = $addressToLatLng->latitude();
    	$longitude = $addressToLatLng->longitude();
      // store in the database
      $pharmacists = new Pharmacist;
      $pharmacists->name = $req->name;
      $pharmacists->email = $req->email;
      $pharmacists->contact = $req->contact;
      $pharmacists->pharmacyName = $req->pharmacyName;
      $pharmacists->address = $req->address;
      $pharmacists->society = $req->society;
      $pharmacists->city = $req->city;
      $pharmacists->latitude = $latitude;
      $pharmacists->longitude = $longitude;
      $pharmacists->password=bcrypt($req->password);
      $pharmacists->verificationToken=Str::random(40);
      // by default verificationStatus and status is set to 0 and 1 respectively
      // see create_pharmacists_table migration for more info
      $pharmacists->save();

      $thisUser = $pharmacists;
      $this->sendEmail($thisUser);

      return redirect()->route('pharmacist.login')->with('message', 'A confirmation email has been sent');
}
  }

  // to send email
  public function sendEmail($thisUser)
  {
    Mail::to($thisUser['email'])->send(new verifyEmailToPharmacist($thisUser));
  }

  // to update Pharmacist status to verified
  public function sendVerifyEmail($email, $verificationToken)
  {
    $pharmacist = Pharmacist::where(['email' => $email, 'verificationToken' => $verificationToken])->first();
    if($pharmacist){
      Pharmacist::where(['email' => $email, 'verificationToken' => $verificationToken])->update(['verificationStatus'=>'1', 'verificationToken' => NULL]);
      $defaultPharmacyRating = new Rating;
      $defaultPharmacyRating->pharmacyId = $pharmacist->id;
      $defaultPharmacyRating->pharmacyName = $pharmacist->pharmacyName;
      $defaultPharmacyRating->save();

      return redirect()->route('pharmacist.login')->with('message', 'Verification Successful');
    }
    else {
      return redirect()->route('pharmacist.login')->with('error', 'There seems to be an error. Try to login if login fails register again');
    }
  }

  public function logout()
  {
      Auth::guard('pharmacist')->logout();

      return redirect('/');
  }
}
