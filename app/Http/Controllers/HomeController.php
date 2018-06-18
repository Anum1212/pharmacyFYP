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
use App\Rating;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('auth:web')->except(['viewSpecificOrder', 'resendVerificationEmail']);
        $this->middleware('userTypeAorC')->only(['viewSpecificOrder']);
        $this->middleware('rateOrder');
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
        $pharmacyRatings = $this->request->get('pharmacyRatings');
        $orderId = $this->request->get('orderId');
        return view('customer.customerDashboard', compact('pharmacyRatings', 'orderId'));
    }



    //  |---------------------------------- viewAllOrders ----------------------------------|
    public function viewAllOrders()
    {
        $pharmacyRatings = $this->request->get('pharmacyRatings');
        $orderId = $this->request->get('orderId');
        $totalOrders = Order::where('userId', Auth::user()->id)->count();
        $orders = Order::where('userId', Auth::user()->id)->paginate(30);
        return view('customer.orders.allOrders', compact('orders', 'totalOrders', 'pharmacyRatings', 'orderId'));
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
        $pharmacyRatings = $this->request->get('pharmacyRatings');
        $orderId = $this->request->get('orderId');
        return view('customer.messageToAdminForm', compact('pharmacyRatings', 'orderId'));
    }



    //  |---------------------------------- editAccountDetailsForm ----------------------------------|
    public function editAccountDetailsForm()
    {
        $pharmacyRatings = $this->request->get('pharmacyRatings');
        $orderId = $this->request->get('orderId');
        $customerDetails = User::whereId(Auth::user()->id)->first();
        return view('customer.editCustomerDetails', compact('customerDetails', 'pharmacyRatings', 'orderId'));
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



    // |---------------------------------- ratePharmacy ----------------------------------|
    public function ratePharmacy(Request $req)
    {
        $currentRatings = [];
        $newCustomerRatings = [];
        $loopRange = count($req->pharmacyId);
        
        for($i=0; $i<$loopRange; $i++){
            $currentRatings[] = Rating::where('pharmacyId', $req->pharmacyId[$i])->first();
            $newCustomerRatings[] = $req->rating[$i];
        }
        
        $i = 0;
        foreach($currentRatings as $currentRating){
            // to convert the average back to total points
            $totalRating = $currentRating->rating*$currentRating->noOfUserThatRated;
            //adding 1 to old noOfUserThatRated to get new noOfUserThatRated
            $currentRating->noOfUserThatRated = $currentRating->noOfUserThatRated+1;
            // average formula (old total points + new user points)/ total number of people that rated
            $currentRating->rating = ($totalRating+$newCustomerRatings[$i])/$currentRating->noOfUserThatRated;
            // update rating
            $currentRating->update();
            $i++;
        }
        $order = Order::where([['userId', Auth::user()->id], ['ratingStatus', '1']])->first();
        $order->ratingStatus = '2';
        $order->update();
    }
    
    
    
    // |---------------------------------- ratePharmacyLater ----------------------------------|
    public function ratePharmacyLater()
    {
        $orderId = $this->request->get('orderId');
        $changeStatusToLater = Order::find($orderId);
        $changeStatusToLater->ratingStatus = '3';
        $changeStatusToLater->update();
        return redirect()->back();
    }
}
