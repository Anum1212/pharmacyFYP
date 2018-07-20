<?php



// controller Details
// ------------------
// Methods Present
// ------------------
// 1) __construct
// 2) resendVerificationEmail
// 3) Index
// 4) storeProductsInTable
// 5) localhost
// 6) savePharmacyApi
// 7) viewAllOrders
// 8) changeOrderStatus
// 9) changeOrderStatus
// 10) editAccountDetailsForm
// 11) editAccountDetails
// 12) contactUsForm



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

        // if dataSource is 0 it means pharamcist hasnt provided an api or choose manual data entry
        // hence take pharamcist to page where they either enter api or decide to enter data manually
        if ($pharmacyDetails->dataSource == '0') {
            return view('pharmacist.pharmacyDetailsForm');

        // if dataSource is NOT 0 it means user has provided an api or chose manual data entry
          // hence take pharamcist to dashboard
        } else {

            $allOrderId = [];
            $newOrders = [];
            $orders = [];
            
            // if data source is website
            if ($pharmacyDetails->dataSource == '1') {
                $stockAlert = Pharmacistproduct::where([['pharmacistId', $pharmacyDetails->id], ['quantity', '<', '25']])->get();
                $totalProducts = Pharmacistproduct::where([['pharmacistId', $pharmacyDetails->id], ['status', 1]])->count();
            }

            // if data source is api
            if ($pharmacyDetails->dataSource == '2') {
                $stockAlert = [];
                $pharmacyApi = rtrim($pharmacyDetails->dbAPI, '/');
                $responseFromApi = Curl::to($pharmacyApi)->asJson()->get();
                    // responseFromApi is an array of collections of collection
                    // the code below converts it into collection of collcections
                $pharmacyProducts = new Collection();
                foreach ($responseFromApi as $collection) {
                    foreach ($collection as $item) {
                        $pharmacyProducts->push($item);
                    }
                }
                $totalProducts = count($pharmacyProducts);
                foreach ($pharmacyProducts as $pharmacyProduct)
                    if ($pharmacyProduct->quantity < '25')
                    $stockAlert[] = $pharmacyProduct;

                $stockAlert = collect($stockAlert);
            }

            // if data source is localhost
            if ($pharmacyDetails->dataSource == '3') {
                dd("arham write your code here pharmacistController index method stockAlert and totalProducts are needed for main dahboard page");
            }

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
            $medicines = DB::table('mostsearch')->select('name', DB::raw('count(name) as total'))->whereMonth('created_at', '=', date('m'))->groupBy('name')->orderBy('total', 'DESC')->take(10)->get();
            return view('pharmacist.pharmacistDashboard', compact('pharmacyDetails', 'medicines', 'newOrders', 'totalOrders', 'totalProducts', 'stockAlert'));
        }
    }



    //  |---------------------------------- 4) storeProductsInTable ----------------------------------|

    // create table if user chose manual data entry i.e did not provide any api
    public function storeProductsInTable()
    {
        $saveRecord = Pharmacist::find(Auth::user()->id);
        $saveRecord->dataSource = '1';
        $saveRecord->save();
        return redirect()->action('PharmacistController@index')->with('message', 'Welcome to LifeLine');
    }



    //  |---------------------------------- 5) localhost ----------------------------------|

    // create table if user chose manual data entry i.e did not provide any api
    public function localhost()
    {
        $pharmacistId = Auth::user()->id;
        $pharmacistDetails = Pharmacist::find(Auth::user()->id);
        Storage::put('public/myAssets/emailAttatchments/'.$pharmacistDetails->id.'.txt', $pharmacistDetails->id);
        // if file created
        if(Storage::exists('public/myAssets/emailAttatchments/'.$pharmacistDetails->id.'.txt')) {
            // send email
            Mail::send(new localhostPharmacy($pharmacistDetails));
            // delete the created file
            Storage::delete('public/myAssets/emailAttatchments/'.$pharmacistId.'.txt');
        }
        $pharmacistDetails->dataSource = '3';
        $pharmacistDetails->save();
        return redirect()->action('PharmacistController@index')->with('message', 'Welcome to LifeLine');
    }



    // |---------------------------------- 6) savePharmacyApi ----------------------------------|
    public function savePharmacyApi(Request $req)
    {
        $this->validate($req, [
            'dbAPI' => 'required|',
            'medicine' => 'required|',
        ]);


        $dbApi = $req->dbAPI;
        $dbApi = rtrim($dbApi, '/') . '/';
        $medicine = $req->medicine;
        $testApi = $dbApi . $medicine;
        $medNotFound = '0';
        $testApiResponse = Curl::to($testApi)->asJson()->get();

        if ($testApiResponse == '0' || $testApiResponse == null) {
            return redirect::back()->with('error', 'Api verifivcation failed');
        } else {
            $saveRecord = Pharmacist::find(Auth::user()->id);
            $saveRecord->dataSource = '2';
            $saveRecord->dbAPI = $dbApi;
            $saveRecord->save();
            return redirect()->action('PharmacistController@index')->with('message', 'Welcome to LifeLine');
        }
    }



    //  |---------------------------------- 7) viewAllOrders ----------------------------------|
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



    //  |---------------------------------- 8) changeOrderStatus ----------------------------------|
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



    //  |---------------------------------- 9) changeOrderStatus ----------------------------------|
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



    //  |---------------------------------- 10) editAccountDetailsForm ----------------------------------|
    public function editAccountDetailsForm()
    {
        $pharmacyDetails = Pharmacist::whereId(Auth::user()->id)->first();
        return view('pharmacist.editPharmacistDetails', compact('pharmacyDetails'));
    }



    //  |---------------------------------- 11) editAccountDetails ----------------------------------|
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



    //  |---------------------------------- 12) contactUsForm ----------------------------------|
    public function contactUsForm()
    {
        return view('pharmacist.messageToAdminForm');
    }
}
