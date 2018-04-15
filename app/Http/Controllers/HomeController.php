<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Geocode;
use App\User;
use App\Pharmacist;
use App\Pharmacistproduct;
use App\Order;
use App\Orderitem;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.customerDashboard');
    }


    //  |---------------------------------- viewAllOrders ----------------------------------|
    public function viewAllOrders()
    {
        $orders = Order::where('userId', Auth::user()->id)->get();
        return view('customer.orders.allOrders', compact('orders'));
    }



    //  |---------------------------------- viewSpecificOrder ----------------------------------|
    public function viewSpecificOrder($orderId)
    {
        $productDetails =[];
        $pharmacyDetails =[];
        $orderDetails = Orderitem::where('orderId', $orderId)->get();
        
        foreach($orderDetails as $orderDetail){
        $pharmacyDetails[] = Pharmacist::whereId($orderDetail->pharmacistId)->first();
        $productDetails[]  = Pharmacistproduct::whereId($orderDetail->productId)->first();
        }
            return view('customer.orders.specificOrder', compact('pharmacyDetails', 'productDetails', 'orderDetails'));
        }
                


    // |---------------------------------- contactUsForm ----------------------------------|
    public function contactUsForm()
    {
        return view('customer.messageToAdminForm');
    }



    //  |---------------------------------- editAccountDetailsForm ----------------------------------|
        public function editAccountDetailsForm()
        {
            $customerDetails = User::whereId(Auth::user()->id)->first();
            return view('customer.editCustomerDetails', compact('customerDetails'));
        }
        
        
        
        //  |---------------------------------- editAccountDetails ----------------------------------|
        public function editAccountDetails(Request $req)
        {
            $address = $req->address.' '.$req->society.' '.$req->city;
            $addressToLatLng = Geocode::make()->address($address);
            
            $latitude = $addressToLatLng->latitude();
    	    $longitude = $addressToLatLng->longitude();
            
            $customerDetails = User::find(Auth::user()->id);
            $customerDetails->name = $req->name;
            $customerDetails->email = $req->email;
            $customerDetails->contact = $req->contact;
            $customerDetails->address = $req->address;
            $customerDetails->society = $req->society;
            $customerDetails->city = $req->city;
            $customerDetails->longitude = $longitude;
            $customerDetails->latitude = $latitude;
            $customerDetails->save();
            
            return redirect('/dashboard');
        }
}
