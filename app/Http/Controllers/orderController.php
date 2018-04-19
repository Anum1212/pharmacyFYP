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
use Auth;
use App\User;
use App\Pharmacistproduct;
use App\Order;
use App\Orderitem;
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
