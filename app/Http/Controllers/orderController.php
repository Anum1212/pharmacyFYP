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
    public function prescriptionUploadForm()
    {
        // possible prescriptionNeeded status (default = 0)
        // 0 -> not required
        // 1 -> required
        $prescriptionNeeded='0'; //

        foreach (Cart::content() as $item) {
            if ($item->options->prescription==1) {
                $prescriptionNeeded = '1';
            }
        }
        if ($prescriptionNeeded==1) {
            return view('siteView.prescriptionUpload');
        } else {
            return redirect('/checkOutCart');
        }
    }



    // |---------------------------------- 3) (checkout with) prescriptionUpload ----------------------------------|
    public function prescriptionUpload(Request $req)
    {
        $userId = Auth::user()->id;
        $cost=Cart::total();

        if ($cost > 0) {
            $order = new Order;

            $order->userId = $userId;
            $order->cost = $cost;
            $order->status = '0';
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
    $j = 0;     // Variable for indexing uploaded image.
        // Loop to get individual element from the array
    for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
        // Extensions which are allowed.
        $validextensions = array("jpeg", "jpg", "png");
        // Explode file name from dot(.)
        $ext = explode('.', basename($_FILES['file']['name'][$i]));
        // Store extensions in the variable.
        $file_extension = end($ext);
        // Increment the number of uploaded images according to the files in array.
        $j = $j + 1;
     // Approx. 10000kb (10Mb) files can be uploaded.
    if (($_FILES["file"]["size"][$i] < 1000000) && in_array($file_extension, $validextensions)) {
        Storage::put('public/myAssets/prescriptions', $req->file[$i]);
        $prescription = new Prescription;
        $prescription->orderId = $lastInsertId;
        $prescription->fileName = $req->file[$i]->hashName();
        $prescription->save();
}
//   If File Size And File Type Was Incorrect.
    else {
        return redirect::back()->with('error', 'Invalid file Size or Type');
}
        }
            Cart::destroy();
            return $this->generateInvoice($lastInsertId);
        } else {
            return redirect('/')->with('message', 'Cart Empty');
        }
    }



    // |---------------------------------- 4) checkout ----------------------------------|
    public function checkout()
    {
        $userId = Auth::user()->id;
        $cost=Cart::total();

        if ($cost > 0) {
            $order = new Order;

            $order->userId = $userId;
            $order->cost = $cost;
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

            // Cart::destroy();
            return $this->generateInvoice($lastInsertId);
        } else {
            return redirect('/');
        }
    }



    // |---------------------------------- 5) generateInvoice ----------------------------------|
    public function generateInvoice($lastInsertId)
    {
        $product=[];
        $allPharmacistId=[];
        $order = Order::whereId($lastInsertId)->first();
        $customerDetails = User::whereId($order->userId)->first();

        $orderItems = Orderitem::where('orderId', $lastInsertId)->get();
        foreach ($orderItems as $orderItem) {
            $productId = $orderItem->productId;
            $allPharmacistId[] = $orderItem->pharmacistId;
            $product[] = Pharmacistproduct::whereId($productId)->first();
        }

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

        for ($i=0; $i<count($arrangedPharmacistId); $i++) {
            $pharmacistId[$i] = Pharmacist::whereId($arrangedPharmacistId[$i])->first();
        }

        // // send mail to customer
        // Mail::send(new invoice($customerDetails, $product, $order, $orderItems));

        // // send mail to pharmacist(s)
        // foreach($pharmacistId as $pharmacist){
        // Mail::send(new customerOrder($pharmacist, $customerDetails, $product, $order, $orderItems));
        // }

        // send sms to customer
        $response = Curl::to('http://sendpk.com/api/sms.php')
                        ->withData(['username'=>923224482641, 'password'=>5821, 'sender'=>'1','mobile'=> floatval($customerDetails->contact),'message'=>'Thank You for your order. Regards WebsiteNameHere'])
                        ->post();
        // return view
        return view('siteView.invoice', compact('product', 'order', 'orderItems', 'customerDetails', 'lastInsertId'));
    }
}
