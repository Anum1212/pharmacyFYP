<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pharmacist;
use Auth;
use Geocode;

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
        'email'         =>      'required|string|email|max:255|unique:users',
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
      $pharmacists->status = '0';
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

      $pharmacists->save();


      return redirect()->route('pharmacist.login');
}
  }

  public function logout()
  {
      Auth::guard('pharmacist')->logout();

      return redirect('/');
  }
}
