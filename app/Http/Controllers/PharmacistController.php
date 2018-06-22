<?php



// controller Details
// ------------------
// Methods Present
// ------------------
// 1) __construct
// 2) resendVerificationEmail
// 3) Index
// 4) storeProductsInTable
// 5) savePharmacyApi (arham)??
// 6) viewAllOrders
// 7) viewSpecificOrder
// 8) editAccountDetailsForm
// 9) editAccountDetails
// 10) contactUsForm



namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
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
        $userData=Auth::user()->whereId(Auth::user()->id)->first();

        // if dataSource is 0 it means pharamcist hasnt provided an api or choose manual data entry
        // hence take pharamcist to page where they either enter api or decide to enter data manually
        if ($userData->dataSource == '0') {
            return view('pharmacist.pharmacyDetailsForm');

        // if dataSource is NOT 0 it means user has provided an api or chose manual data entry
          // hence take pharamcist to dashboard
        } else {
            $medicines=DB::table('mostsearch')->select('name', DB::raw('count(name) as total'))->whereMonth('created_at', '=', date('m'))->groupBy('name')->orderBy('total', 'DESC')->take(10)->get();
            return view('pharmacist.pharmacistDashboard', compact('userData', 'medicines'));
        }
    }



    //  |---------------------------------- 4) storeProductsInTable ----------------------------------|

    // create table if user chose manual data entry i.e did not provide any api
    public function storeProductsInTable()
    {
        $saveRecord = Pharmacist::find(Auth::user()->id);
        $saveRecord->dataSource = '2';
        $saveRecord->save();
        return redirect()->action('PharmacistController@index')->with('message', 'You can now add products to our databse');
    }



    // |---------------------------------- 5) savePharmacyApi ----------------------------------|
    // ---------------------------------- ARHAM PART ----------------------------------
    public function savePharmacyApi(Request $req)
    {
        $this->validate($req, [
            'dbAPI' => 'required|',
            ]);


        // *************************** use this api for testing purposes (if no own api)***************************
        // in actual program pharmacist api will be tested
        // $clinAPI = 'https://clin-table-search.lhc.nlm.nih.gov/api/rxterms/v3/search';
        // random medicine name for testing
        // Aceon
        // Cambia
        // CALAN

        $medicine = $req->medicine;
        $medNotFound = '0';

        for ($i=0;$i<count($medicine); $i++) {
            $response[$i] = Curl::to($req->dbAPI)
                // written according to clin api response
                // arham will make changes from here according to project api response structure
                ->withData(['terms' => $medicine[$i]], ['maxList'=>'1'], ['q'=>'df'])
                ->asJson()
                ->get();

            // counting how many medicine tests failed
            if ($response[$i][0] == '0') {
                $medNotFound = $medNotFound+1;
            }
        }

        // if 2/3 medicine test fails api test fails and pharamicst is shown error
        if ($medNotFound >= '2') {
            return redirect::back()->with('error', 'Api verifivcation failed');
        }

        // if no error, api test passes and api is saved to pharmacists table
        else {
            $saveRecord = Pharmacist::find(Auth::user()->id);

            //dataSource 1 means pharmacist provided api
            $saveRecord->dataSource = '1';

            $saveRecord->dbAPI = $req->dbAPI;
            $saveRecord->save();
            return redirect()->action('PharmacistController@index')->with('message', 'Record Saved');
        }
    }



    //  |---------------------------------- 6) viewAllOrders ----------------------------------|
    public function viewAllOrders()
    {
        $allOrderId=[];
        $allCustomerId=[];
        $customer=[];
        $orders=[];
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

        for ($i=0; $i<count($arrangedOrderId); $i++) {
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

        for ($i=0; $i<count($arrangedCustomerId); $i++) {
            $customers[$i] = User::whereId($arrangedCustomerId[$i])->first();
        }
        return view('pharmacist.orders.allOrders', compact('orders', 'customers'));
    }



    //  |---------------------------------- 7) viewSpecificOrder ----------------------------------|
    public function viewSpecificOrder($orderId, $customerId, $pharmacyId)
    {
        $productDetails =[];
        $order = Order::whereId($orderId)->first();
        if (!empty($order)) {
            $orderDetails = Orderitem::where([
            ['orderId', $orderId],
            ['pharmacistId', $pharmacyId]
            ])->get();

            $customerDetails =  User::whereId($customerId)->first();

            // error if product gets deleted. Solution??
            foreach ($orderDetails as $orderDetail) {
                echo $orderDetail->productId;
                $productDetails[]=Pharmacistproduct::whereId($orderDetail->productId)->first();
            }

            if ($order->prescription==1) {
                $prescriptions = Prescription::where('orderId', $orderId)->get();
                return view('pharmacist.orders.specificOrder', compact('orderDetails', 'productDetails', 'customerDetails', 'order', 'prescriptions'));
            } else {
                return view('pharmacist.orders.specificOrder', compact('orderDetails', 'productDetails', 'customerDetails', 'order'));
            }
        } else {
            return redirect()->action('PharmacistController@viewAllOrders')->with('error', 'Order# '.$orderId.' not found');
        }
    }



    //  |---------------------------------- 8) editAccountDetailsForm ----------------------------------|
    public function editAccountDetailsForm()
    {
        $pharmacyDetails = Pharmacist::whereId(Auth::user()->id)->first();
        return view('pharmacist.editPharmacistDetails', compact('pharmacyDetails'));
    }



    //  |---------------------------------- 9) editAccountDetails ----------------------------------|
    public function editAccountDetails(Request $req)
    {
        $pharmacyDetails = Pharmacist::find(Auth::user()->id);
        $address = $req->address.' '.$req->society.' '.$req->city;
        $savedAddress = $pharmacyDetails->address.' '.$pharmacyDetails->society.' '.$pharmacyDetails->city;

        // check if user changed address if db saved address = form address then no need to call latlong function
        if ($savedAddress === $address) {
            $pharmacyDetails->name = $req->name;
            $pharmacyDetails->email = $req->email;
            $pharmacyDetails->contact = $req->contact;
            $pharmacyDetails->pharmacyName = $req->pharmacyName;
            $pharmacyDetails->address = $req->address;
            $pharmacyDetails->society = $req->society;
            $pharmacyDetails->city = $req->city;
            // $pharmacyDetails->freeDeliveryPurchase = $req->freeDeliveryPurchase;
            $pharmacyDetails->save();

            return redirect('/pharmacist/dashboard')->with('message', 'Edit successful');
        }

        // if db saved address != form address then call latlong function
        else {
            $addressToLatLng = Geocode::make()->address($address);

            // check if geocode fun was successful if not save other form details n return back to form with error message
            if ($addressToLatLng ==false) {
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
                // // $pharmacyDetails->freeDeliveryPurchase = $req->freeDeliveryPurchase;
                $pharmacyDetails->save();

                return redirect('/pharmacist/dashboard')->with('message', 'Edit successful');
            }
        }
    }



    //  |---------------------------------- 10) contactUsForm ----------------------------------|
    public function contactUsForm()
    {
        return view('pharmacist.messageToAdminForm');
    }
}
