<?php



// controller Details
// ------------------
// methods and their details
// --------------------------
// 1) index --> goto customer dashboard
// 2) viewAllOrders --> view all customer orders
// 3) viewSpecificOrder --> view details of specific order
// 4) contactUsForm --> goto admin contact form
// 5) editAccountDetailsForm --> goto edit customer details form
// 6) editAccountDetails --> save customer detail changes (incomplete need to add password change code)



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Geocode;
use Mail;
use App\Mail\verifyEmailToUser;
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
        $this->middleware('auth:web')->except(['viewSpecificOrder', 'resendVerificationEmail']);
        $this->middleware('userTypeAorC')->only(['viewSpecificOrder']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */



    //  |---------------------------------- resendVerificationEmail ----------------------------------|
    public function resendVerificationEmail($id)
    {
        $user = User::whereId($id)->first();
        Mail::to($user['email'])->send(new verifyEmailToUser($user));
        return redirect::back();
    }



    //  |---------------------------------- index ----------------------------------|
    public function index()
    {
        return view('customer.customerDashboard');
    }


    //  |---------------------------------- viewAllOrders ----------------------------------|
    public function viewAllOrders()
    {
        $totalOrders = Order::where('userId', Auth::user()->id)->count();
        $orders = Order::where('userId', Auth::user()->id)->paginate(30);
        return view('customer.orders.allOrders', compact('orders', 'totalOrders'));
    }



    //  |---------------------------------- viewSpecificOrder ----------------------------------|
    public function viewSpecificOrder($orderId)
    {
        $productDetails =[];
        $pharmacyDetails =[];
        // find the order
        $order = Order::whereId($orderId)->first();
        // check if $order is empty
        // if $order not empty
        if(!empty($order)){
            // check if $orderId belongs to the logged in user (to prevent unauthorized access by other users)
        if($order->userId == Auth::user()->id){
        // if everything is satisfied fetch order details
        $orderDetails = Orderitem::where('orderId', $orderId)->get();
        // check if $orderDetails is empty
        if(count($orderDetails)>0){
            // if $orderDetails is not empty fetch remaining details n return view
        foreach ($orderDetails as $orderDetail) {
            $pharmacyDetails[] = Pharmacist::whereId($orderDetail->pharmacistId)->first();
            $productDetails[]  = Pharmacistproduct::whereId($orderDetail->productId)->first();
        }
        return view('customer.orders.specificOrder', compact('pharmacyDetails', 'productDetails', 'orderDetails'));
    }
    // if $orderDetails is empty return with error
    else
    return redirect()->action('HomeController@viewAllOrders')->with('error', 'Order# '.$orderId.' not found');
}   
// if $orderId does not belong to logged in user return with error
    else
        return redirect()->action('HomeController@viewAllOrders')->with('error', 'Order# '.$orderId.' not found');
    }
    // if $orderId not found return with error
        else
        return redirect()->action('HomeController@viewAllOrders')->with('error', 'Order# '.$orderId.' not found');
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

        return redirect('/dashboard')->with('message', 'Edit successful');
    }
}
