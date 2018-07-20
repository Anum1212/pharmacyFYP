<?php



// controller Details
// ------------------
// Methods Present
// ------------------
// 1) __construct
// 2) prescriptionUploadForm
// 3) prescriptionUpload
// 4) checkout
// 5) generateInvoice



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use App\File;
use Curl;
use Auth;
use App\User;
use App\Pharmacist;
use App\Pharmacistproduct;
use App\Order;
use App\Orderitem;
use App\Prescription;
use Cart;
use Mail;
use App\Mail\invoice;
use App\Mail\customerOrder;



class orderController extends Controller
{



    // |---------------------------------- 1) construct ----------------------------------|
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            Cart::instance('shopping');
            Cart::restore(Auth::id());

            return $next($request);
        });
    }



    // |---------------------------------- 2) prescriptionUploadForm ----------------------------------|
    public function prescriptionUploadForm(Request $req)
    {
        $deliveryDate = $req->deliveryDate;

        // possible prescriptionNeeded status (default = 0)
        // 0 -> not required
        // 1 -> required
        $prescriptionNeeded = '0'; //

        foreach (Cart::content() as $item) {
            if ($item->options->prescription == 1) {
                $prescriptionNeeded = '1';
            }
        }
        if ($prescriptionNeeded == 1) {
            return view('siteView.prescriptionUpload', compact('deliveryDate'));
        } else {
            return $this->checkout($deliveryDate);
            // return redirect('/checkOutCart/' deliveryDate);
        }
    }



    // |---------------------------------- 3) (checkout with) prescriptionUpload ----------------------------------|
    public function prescriptionUpload(Request $req, $deliveryDate)
    {
        $userId = Auth::user()->id;
        $cost = Cart::total();

        if ($cost > 0) {
            $order = new Order;

            $order->userId = $userId;
            $order->cost = $cost;
            $order->status = '0';
            $order->deliveryDate = $deliveryDate;
            // possible prescription status
            // 0 -> not required
            // 1 -> required
            $order->prescription = '1';
            $order->save();

            $lastInsertId = $order->id; // for using it in orderItem table

            foreach (Cart::content() as $item) {
                $orderItem = new orderitem;
                $orderItem->orderId = $lastInsertId;
                $orderItem->productId = $item->id;
                $orderItem->pharmacistId = $item->options->pharmacistId;
                $orderItem->quantity = $item->qty;
                $orderItem->save();
            }

            if ($req->file('imageFile')) {
                Storage::put('public/myAssets/prescriptions', $req->imageFile);
                $prescription = new Prescription;
                $prescription->orderId = $lastInsertId;
                $prescription->fileName = $req->imageFile->hashName();
                $prescription->save();
            }

            return $this->generateInvoice($lastInsertId);
        } else {
            return redirect('/')->with('message', 'Cart Empty');
        }
    }



    // |---------------------------------- 4) checkout ----------------------------------|
    public function checkout($deliveryDate)
    {
        $userId = Auth::user()->id;
        $cost = Cart::total();

        if ($cost > 0) {
            $order = new Order;

            $order->userId = $userId;
            $order->cost = $cost;
            $order->deliveryDate = $deliveryDate;
            $order->status = '0';
            $order->save();

            $lastInsertId = $order->id; // for using it in orderItem table

            foreach (Cart::content() as $item) {
                $orderItem = new orderitem;
                $orderItem->orderId = $lastInsertId;
                $orderItem->productId = $item->id;
                $orderItem->pharmacistId = $item->options->pharmacistId;
                $orderItem->quantity = $item->qty;
                $orderItem->save();
            }

            return $this->generateInvoice($lastInsertId);
        } else {
            return redirect('/');
        }
    }



    // |---------------------------------- 5) generateInvoice ----------------------------------|
    public function generateInvoice($lastInsertId)
    {
        $product = [];
        $allPharmacistId = [];
        $order = Order::whereId($lastInsertId)->first();
        $customerDetails = User::whereId($order->userId)->first();
        
        $products = Cart::content();


        
        // to remove duplicates
        $pharmacistId = array_unique($allPharmacistId);
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
        $arrangedPharmacistId = array_values($pharmacistId);

        for ($i = 0; $i < count($arrangedPharmacistId); $i++) {
            $pharmacistId[$i] = Pharmacist::whereId($arrangedPharmacistId[$i])->first();
        }

        // send mail to customer
            // Mail::send(new invoice($customerDetails, $products, $order));

        // // send mail to pharmacist(s)
        // foreach ($pharmacistId as $pharmacist) {
        //     Mail::send(new customerOrder($pharmacist, $customerDetails, $product, $order, $orderItems));
        // }

        // send sms to customer
        // $username = '923208778084';///Your  Username 
        // $password = '3195';///Your SECRET Password 
        // $sender = 'ABC';///Your Masking 
        // $mobile = $customerDetails->contact; ///add comma to send multiple sms like 92301,92310,92321 
        // $message = 'Your Order# ' . $lastInsertId . ' has been received. Your Total Order Cost is Rs ' . $order->cost;///Your Message 
        // $post = "sender=" . urlencode($sender) . "&mobile=" . urlencode($mobile) . "&message=" . urlencode($message) . "&format=json";
        // $url = "http://sendpk.com/api/sms.php?username=" . $username . "&password=" . $password . "";
        // $ch = curl_init();
        // $timeout = 0; // set to zero for no timeout 
        // curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        // $result = curl_exec($ch);

        Cart::destroy();

        // return view
        return view('siteView.invoice', compact('products', 'order', 'orderItems', 'customerDetails', 'lastInsertId'));
    }
}
