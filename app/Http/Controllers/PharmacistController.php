<?php



// controller Details
// ------------------
// Methods Present
// ------------------
// 1) __construct
// 2) resendVerificationEmail
// 3) Index
// 4) viewAllOrders
// 5) changeOrderStatus
// 6) changeOrderStatus
// 7) editAccountDetailsForm
// 8) editAccountDetails
// 9) contactUsForm



namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use App\File;
use Carbon\carbon;
use Auth;
use Curl;
use Geocode;
use Mail;
use App\Mail\verifyEmailToPharmacist;
use App\User;
use App\Pharmacist;
use App\Pharmacistproduct;
use App\Order;
use App\Orderitem;
use App\Prescription;
use App\Mail\localhostPharmacy;

class PharmacistController extends Controller
{



  //  |---------------------------------- 1) __construct ----------------------------------|
    public function __construct()
    {
        $this->middleware('auth:pharmacist')->except(['viewSpecificOrder', 'resendVerificationEmail']);
        $this->middleware('userTypeAorP')->only(['viewSpecificOrder']);
    }



    //  |---------------------------------- 2) resendVerificationEmail ----------------------------------|
    public function resendVerificationEmail($id)
    {
        $user = Pharmacist::whereId($id)->first();
        Mail::to($user['email'])->send(new verifyEmailToPharmacist($user));
        return redirect::back();
    }



    //  |---------------------------------- 3) Index ----------------------------------|
    public function index()
    {
        // get logged in pharamcist details
        $pharmacyDetails = Auth::user()->whereId(Auth::user()->id)->first();

            $allOrderId = [];
            $newOrders = [];
            $orders = [];
            
                $stockAlert = Pharmacistproduct::where([['pharmacistId', $pharmacyDetails->id], ['quantity', '<', '25']])->get();
                $totalProducts = Pharmacistproduct::where([['pharmacistId', $pharmacyDetails->id], ['status', 1]])->count();

            $orderItems = Orderitem::where('pharmacistId', $pharmacyDetails->id)->orderBy('id', 'desc')->get();
            foreach ($orderItems as $orderItem) {
                $allOrderId[] = $orderItem->orderId;
            }
        // to remove duplicates
            $orderId = array_unique($allOrderId);

        // to renumber the array index after using array_unique() i.e after using array_unique() the array may look like
        // index => value
        // 0     =>   1
        // 2     =>   3
        // 7     =>   9
        // to fix this we use array_values()
        // which will give the result
        // index => value
        // 0     =>   1
        // 1     =>   3
        // 2     =>   9
            $arrangedOrderId = array_values($orderId);

            // count total orders in database
            $totalOrders = count($arrangedOrderId);

        // count all orders where time since order is less than 24 hours
            for ($i = 0; $i < $totalOrders; $i++)
                $newOrders[] = Order::where([
                ['created_at', '>=', Carbon::now()->subDays(1)]
            ])->first();

            $newOrders = count($newOrders);
            return view('pharmacist.pharmacistDashboard', compact('pharmacyDetails', 'newOrders', 'totalOrders', 'totalProducts', 'stockAlert'));
        }



    //  |---------------------------------- 4) viewAllOrders ----------------------------------|
    public function viewAllOrders()
    {
        $allOrderId = [];
        $allCustomerId = [];
        $customer = [];
        $orders = [];
        $pharmacistId = Auth::user()->id;

        $orderItems = Orderitem::where('pharmacistId', $pharmacistId)->orderBy('id', 'desc')->get();
        foreach ($orderItems as $orderItem) {
            $allOrderId[] = $orderItem->orderId;
        }
        // to remove duplicates
        $orderId = array_unique($allOrderId);

        // to renumber the array index after using array_unique() i.e after using array_unique() the array may look like
        // index => value
        // 0     =>   1
        // 2     =>   3
        // 7     =>   9
        // to fix this we use array_values()
        // which will give the result
        // index => value
        // 0     =>   1
        // 1     =>   3
        // 2     =>   9
        $arrangedOrderId = array_values($orderId);

        for ($i = 0; $i < count($arrangedOrderId); $i++) {
            $orders[$i] = Order::whereId($arrangedOrderId[$i])->first();
        }
        foreach ($orders as $order) {
            $allCustomerId[] = $order->userId;
        }

        // to remove duplicates
        $customerId = array_unique($allCustomerId);

        // to renumber the array index after using array_unique() i.e after using array_unique() the array may look like
        // index => value
        // 0     =>   1
        // 2     =>   3
        // 7     =>   9
        // to fix this we use array_values()
        // which will give the result
        // index => value
        // 0     =>   1
        // 1     =>   3
        // 2     =>   9
        $arrangedCustomerId = array_values($customerId);

        for ($i = 0; $i < count($arrangedCustomerId); $i++) {
            $customers[$i] = User::whereId($arrangedCustomerId[$i])->first();
        }
        return view('pharmacist.orders.allOrders', compact('orders', 'customers'));
    }



    //  |---------------------------------- 5) changeOrderStatus ----------------------------------|
    public function changeOrderStatus($orderId, $status)
    {
        // possible status types
        // 0 -> order received
        // 1 -> order dispatched
        // 2 -> order cancelled

        $orderDetails = Order::whereId($orderId)->first();
        $orderDetails->status = $status;
        $orderDetails->save();

        $customerDetails = User::whereId($orderDetails->userId)->first();

        return redirect('/pharmacist/viewAllOrders')->with('message', 'Order Status Changed');

    }



    //  |---------------------------------- 6) changeOrderStatus ----------------------------------|
    public function viewSpecificOrder($orderId, $customerId, $pharmacyId)
    {
        $productDetails = [];
        $order = Order::whereId($orderId)->first();
        if (!empty($order)) {
            $orderDetails = Orderitem::where([
                ['orderId', $orderId],
                ['pharmacistId', $pharmacyId]
            ])->get();

            $customerDetails = User::whereId($customerId)->first();

            // error if product gets deleted. Solution??
            foreach ($orderDetails as $orderDetail) {
                echo $orderDetail->productId;
                $productDetails[] = Pharmacistproduct::whereId($orderDetail->productId)->first();
            }

            if ($order->prescription == 1) {
                $prescriptions = Prescription::where('orderId', $orderId)->get();
                return view('pharmacist.orders.specificOrder', compact('orderDetails', 'productDetails', 'customerDetails', 'order', 'prescriptions'));
            } else {
                return view('pharmacist.orders.specificOrder', compact('orderDetails', 'productDetails', 'customerDetails', 'order'));
            }
        } else {
            return redirect()->action('PharmacistController@viewAllOrders')->with('error', 'Order# ' . $orderId . ' not found');
        }
    }



    //  |---------------------------------- 7) editAccountDetailsForm ----------------------------------|
    public function editAccountDetailsForm()
    {
        $pharmacyDetails = Pharmacist::whereId(Auth::user()->id)->first();
        return view('pharmacist.editPharmacistDetails', compact('pharmacyDetails'));
    }



    //  |---------------------------------- 8) editAccountDetails ----------------------------------|
    public function editAccountDetails(Request $req)
    {
        $pharmacyDetails = Pharmacist::find(Auth::user()->id);
        $address = $req->address . ' ' . $req->society . ' ' . $req->city;
        $savedAddress = $pharmacyDetails->address . ' ' . $pharmacyDetails->society . ' ' . $pharmacyDetails->city;

        // check if user changed address if db saved address = form address then no need to call latlong function
        if ($savedAddress === $address) {
            $pharmacyDetails->name = $req->name;
            $pharmacyDetails->email = $req->email;
            $pharmacyDetails->contact = $req->contact;
            $pharmacyDetails->pharmacyName = $req->pharmacyName;
            $pharmacyDetails->address = $req->address;
            $pharmacyDetails->society = $req->society;
            $pharmacyDetails->city = $req->city;
            $pharmacyDetails->save();

            return redirect('/pharmacist/dashboard')->with('message', 'Edit successful');
        }

        // if db saved address != form address then call latlong function
        else {
            $addressToLatLng = Geocode::make()->address($address);

            // check if geocode fun was successful if not save other form details n return back to form with error message
            if ($addressToLatLng == false) {
                $pharmacyDetails->name = $req->name;
                $pharmacyDetails->email = $req->email;
                $pharmacyDetails->contact = $req->contact;
                $pharmacyDetails->pharmacyName = $req->pharmacyName;
                return redirect::back()->with('error', 'failed to detect location. Try again later');
            }
            // if geocode fun was successful save form details n return back to form
            else {
                $latitude = $addressToLatLng->latitude();
                $longitude = $addressToLatLng->longitude();

                $pharmacyDetails->name = $req->name;
                $pharmacyDetails->email = $req->email;
                $pharmacyDetails->contact = $req->contact;
                $pharmacyDetails->pharmacyName = $req->pharmacyName;
                $pharmacyDetails->address = $req->address;
                $pharmacyDetails->society = $req->society;
                $pharmacyDetails->city = $req->city;
                $pharmacyDetails->longitude = $longitude;
                $pharmacyDetails->latitude = $latitude;
                $pharmacyDetails->save();

                return redirect('/pharmacist/dashboard')->with('message', 'Edit successful');
            }
        }
    }



    //  |---------------------------------- 9) contactUsForm ----------------------------------|
    public function contactUsForm()
    {
        return view('pharmacist.messageToAdminForm');
    }
}
