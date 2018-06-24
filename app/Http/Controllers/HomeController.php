<?php



// controller Details
// ------------------
// Methods Present
// ------------------
// 1) __construct
// 2) resendVerificationEmail
// 3) index
// 4) viewAllOrders
// 5) viewSpecificOrder
// 6) contactUsForm
// 7) editAccountDetailsForm
// 8) editAccountDetails
// 9) ratePharmacy
// 10) ratePharmacyLater
// 11) setAvailabilityNotification



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\carbon;
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
use App\Reminder;

class HomeController extends Controller
{



     //  |---------------------------------- 1) __construct ----------------------------------|
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('auth:web')->except(['viewSpecificOrder', 'resendVerificationEmail']);
        $this->middleware('userTypeAorC')->only(['viewSpecificOrder']);
        $this->middleware('rateOrder');
    }



    //  |---------------------------------- 2) resendVerificationEmail ----------------------------------|
    public function resendVerificationEmail($id)
    {
        $user = User::whereId($id)->first();
        Mail::to($user['email'])->send(new verifyEmailToUser($user));
        return redirect::back();
    }



    //  |---------------------------------- 3) index ----------------------------------|
    public function index()
    {
        // to show rating pop up if rating not done
        $pharmacyRatings = $this->request->get('pharmacyRatings');
        $orderId = $this->request->get('orderId');

        // count all orders where time since order is less than 24 hours
        $newOrders = Order::where([
            ['userId', Auth::user()->id],
            ['created_at', '>=', Carbon::now()->subDays(1)]
        ])->count();

        // count total orders in database
        $totalOrders = Order::where('userId', Auth::user()->id)->count();

        return view('customer.customerDashboard', compact('pharmacyRatings', 'orderId', 'newOrders', 'totalOrders'));
    }



    //  |---------------------------------- 4) viewAllOrders ----------------------------------|
    public function viewAllOrders()
    {
        // to show rating pop up if rating not done
        $pharmacyRatings = $this->request->get('pharmacyRatings');
        $orderId = $this->request->get('orderId');
        $totalOrders = Order::where('userId', Auth::user()->id)->count();
        $orders = Order::where('userId', Auth::user()->id)->paginate(30);
        return view('customer.orders.allOrders', compact('orders', 'totalOrders', 'pharmacyRatings', 'orderId'));
    }



    //  |---------------------------------- 5) viewSpecificOrder ----------------------------------|
    public function viewSpecificOrder($orderId)
    {
        $productDetails =[];
        $pharmacyDetails =[];
        // find the order
        $order = Order::whereId($orderId)->first();
        // check if $order is empty
        // if $order not empty
        if (!empty($order)) {
            // check if $orderId belongs to the logged in user (to prevent unauthorized access by other users)
            if ($order->userId == Auth::user()->id) {
                // if everything is satisfied fetch order details
                $orderDetails = Orderitem::where('orderId', $orderId)->get();
                // check if $orderDetails is empty
                if (count($orderDetails)>0) {
                    // if $orderDetails is not empty fetch remaining details n return view
                    foreach ($orderDetails as $orderDetail) {
                        $pharmacyDetails[] = Pharmacist::whereId($orderDetail->pharmacistId)->first();
                        $productDetails[]  = Pharmacistproduct::whereId($orderDetail->productId)->first();
                    }
                    return view('customer.orders.specificOrder', compact('pharmacyDetails', 'productDetails', 'orderDetails'));
                }
                // if $orderDetails is empty return with error
                else {
                    return redirect()->action('HomeController@viewAllOrders')->with('error', 'Order# '.$orderId.' not found');
                }
            }
            // if $orderId does not belong to logged in user return with error
            else {
                return redirect()->action('HomeController@viewAllOrders')->with('error', 'Order# '.$orderId.' not found');
            }
        }
        // if $orderId not found return with error
        else {
            return redirect()->action('HomeController@viewAllOrders')->with('error', 'Order# '.$orderId.' not found');
        }
    }



    // |---------------------------------- 6) contactUsForm ----------------------------------|
    public function contactUsForm()
    {
        // to show rating pop up if rating not done
        $pharmacyRatings = $this->request->get('pharmacyRatings');
        $orderId = $this->request->get('orderId');
        return view('customer.messageToAdminForm', compact('pharmacyRatings', 'orderId'));
    }



    //  |---------------------------------- 7) editAccountDetailsForm ----------------------------------|
    public function editAccountDetailsForm()
    {
        // to show rating pop up if rating not done
        $pharmacyRatings = $this->request->get('pharmacyRatings');
        $orderId = $this->request->get('orderId');
        $customerDetails = User::whereId(Auth::user()->id)->first();
        return view('customer.editCustomerDetails', compact('customerDetails', 'pharmacyRatings', 'orderId'));
    }



    //  |---------------------------------- 8) editAccountDetails ----------------------------------|
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



    // |---------------------------------- 9) ratePharmacy ----------------------------------|
    public function ratePharmacy(Request $req)
    {
        $currentRatings = [];
        $newCustomerRatings = [];
        $loopRange = count($req->pharmacyId);

        for ($i=0; $i<$loopRange; $i++) {
            $currentRatings[] = Rating::where('pharmacyId', $req->pharmacyId[$i])->first();
            $newCustomerRatings[] = $req->rating[$i];
        }

        $i = 0;
        foreach ($currentRatings as $currentRating) {
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



    // |---------------------------------- 10) ratePharmacyLater ----------------------------------|
    public function ratePharmacyLater()
    {
        $orderId = $this->request->get('orderId');
        $changeStatusToLater = Order::find($orderId);
        $changeStatusToLater->ratingStatus = '3';
        $changeStatusToLater->update();
        return redirect()->back();
    }



    // |---------------------------------- 11) setAvailabilityNotification ----------------------------------|
    public function setAvailabilityNotification($medicineName, $latitude, $longitude)
    {
        $reminder = new Reminder;
        $reminder->customerId = Auth::user()->id;
        $reminder->customerName = Auth::user()->name;
        $reminder->customerEmail = Auth::user()->email;
        $reminder->productName = $medicineName;
        $reminder->longitude = $latitude;
        $reminder->latitude = $longitude;
        $reminder->save();
        return redirect()->back()->with('message', 'An email will be sent to you when your product is available');
    }
}
