<?php



// controller Details
// ------------------
// methods and their details
// ---------------------------
// 1) checkout --> save order to database, call generateInvoice function to send order confirmation email, n show receipt
// 2) generateInvoice --> function to send order confirmation email, n show receipt



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use App\File;
use Auth;
use App\User;
use App\Pharmacistproduct;
use App\Order;
use App\Orderitem;
use App\Prescription;
use Cart;
use Mail;
use App\Mail\invoice;

class orderController extends Controller
{



    // |---------------------------------- construct ----------------------------------|
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            Cart::instance('shopping');
            Cart::restore(Auth::id());

            return $next($request);
        });
    }



    // |---------------------------------- prescriptionUploadForm ----------------------------------|
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



    // |---------------------------------- prescriptionUpload ----------------------------------|
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
            return redirect('/');
        }
    }



    // |---------------------------------- checkout ----------------------------------|
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

            Cart::destroy();
            return $this->generateInvoice($lastInsertId);
        } else {
            return redirect('/');
        }
    }



    // |---------------------------------- generateInvoice ----------------------------------|
    public function generateInvoice($lastInsertId)
    {
        $product=[];
        $order = Order::whereId($lastInsertId)->first();
        $customerDetails = User::whereId($order->userId)->first();

        $orderItems = Orderitem::where('orderId', $lastInsertId)->take(15)->get();
        // dd($orderItems);
        foreach ($orderItems as $orderItem) {
            $productId = $orderItem->productId;
            $product[] = Pharmacistproduct::whereId($productId)->first();
        }
        Mail::send(new invoice($customerDetails, $product, $order, $orderItems));
        return view('siteView.invoice', compact('product', 'order', 'orderItems', 'customerDetails', 'lastInsertId'));
    }
}
