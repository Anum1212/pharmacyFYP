<?php



// controller Details
// ------------------
// methods and their details
// ---------------------------
// 1) index --> decides where to take the logged in pharmacist. if pharmacist hasn't chosen a dataSource then go to dataSource Selection page else go to dashBoard
// 2) storeProductsInTable --> set dataSorce to use database for saving data
// 3) savePharmacyApi --> test given api if test pass then set DataSource to use api
// 4) viewAllOrders --> view all customer orders
// 5) viewSpecificOrder --> view order details of a specific customer
// 6) editAccountDetailsForm --> goto edit pharamacy details form
// 7) editAccountDetails --> save pharamcy edit changes
// 8) contactUsForm --> goto contact admin form



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Auth;
use Curl;
use Geocode;
use App\User;
use App\Pharmacist;
use App\Pharmacistproduct;
use App\Order;
use App\Orderitem;

class PharmacistController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:pharmacist')->except(['viewSpecificOrder']);
        $this->middleware('userTypeAorP')->only(['viewSpecificOrder']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */



    //  |---------------------------------- Index ----------------------------------|
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
            return view('pharmacist.pharmacistDashboard', compact('userData'));
        }
    }



    //  |---------------------------------- storeProductsInTable ----------------------------------|

    // create table if user chose manual data entry i.e did not provide any api
    public function storeProductsInTable()
    {
        $saveRecord = Pharmacist::find(Auth::user()->id);
        $saveRecord->dataSource = '2';
        $saveRecord->save();
        return redirect()->action('PharmacistController@index')->with('message', 'Record Saved');
    }



    // |---------------------------------- savePharmacyApi ----------------------------------|
    // ---------------------------------- ARHAM PART ----------------------------------
    public function savePharmacyApi(Request $req)
    {
        $this->validate($req, [
            'dbAPI' => 'required|',
            ]);


        // *************************** use this api for testing purposes (if no own api)***************************
        // in actual program pharmacist api will be tested
        // $clinAPI = 'https://clin-table-search.lhc.nlm.nih.gov/api/rxterms/v3/search';

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



    //  |---------------------------------- viewAllOrders ----------------------------------|
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
        $orderId = array_unique($allOrderId);
        for ($i=0; $i<count($orderId); $i++) {
            $orders[$i] = Order::whereId($orderId[$i])->first();
        }
        foreach ($orders as $order) {
            $allCustomerId[] = $order->userId;
        }
        $customerId = array_unique($allCustomerId);
        for ($i=0; $i<count($customerId); $i++) {
            $customers[$i] = User::whereId($customerId[$i])->first();
        }
        return view('pharmacist.orders.allOrders', compact('orders', 'customers'));
    }



    //  |---------------------------------- viewSpecificOrder ----------------------------------|
    public function viewSpecificOrder($orderId, $customerId, $pharmacyId)
    {
        $productDetails =[];
        $orderDetails = Orderitem::where([
            ['orderId', $orderId],
            ['pharmacistId', $pharmacyId]
            ])->get();

        $customerDetails =  User::whereId($customerId)->first();
        foreach ($orderDetails as $orderDetail) {
            $productDetails[]=Pharmacistproduct::whereId($orderDetail->productId)->first();
        }
        return view('pharmacist.orders.specificOrder', compact('orderDetails', 'productDetails', 'customerDetails'));
    }



    //  |---------------------------------- editAccountDetailsForm ----------------------------------|
    public function editAccountDetailsForm()
    {
        $pharmacyDetails = Pharmacist::whereId(Auth::user()->id)->first();
        return view('pharmacist.editPharmacistDetails', compact('pharmacyDetails'));
    }



    //  |---------------------------------- editAccountDetails ----------------------------------|
    public function editAccountDetails(Request $req)
    {
        $address = $req->address.' '.$req->society.' '.$req->city;
        $addressToLatLng = Geocode::make()->address($address);

        $latitude = $addressToLatLng->latitude();
        $longitude = $addressToLatLng->longitude();

        $pharmacyDetails = Pharmacist::find(Auth::user()->id);
        $pharmacyDetails->name = $req->name;
        $pharmacyDetails->email = $req->email;
        $pharmacyDetails->contact = $req->contact;
        $pharmacyDetails->pharmacyName = $req->pharmacyName;
        $pharmacyDetails->address = $req->address;
        $pharmacyDetails->society = $req->society;
        $pharmacyDetails->city = $req->city;
        $pharmacyDetails->longitude = $longitude;
        $pharmacyDetails->latitude = $latitude;
        $pharmacyDetails->freeDeliveryPurchase = $req->freeDeliveryPurchase;
        $pharmacyDetails->save();

        return redirect('/pharmacist/dashboard');
    }



    //  |---------------------------------- contactUsForm ----------------------------------|
    public function contactUsForm()
    {
        return view('pharmacist.messageToAdminForm');
    }
}
