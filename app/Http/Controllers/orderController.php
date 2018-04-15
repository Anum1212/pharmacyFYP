<?php



// controller Details
// ------------------
// methods and their details
// ---------------------------

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\User;
use App\Pharmacistproduct;
use App\Order;
use App\Orderitem;
use Cart;
Use Mail;
Use App\Mail\invoice;

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

// i now have access to categoryId and productId
// i can now record them in my orderItem
// which can then later on be used to fetch customer orders from db table orderItem
$userId = Auth::user()->id;
$cost=Cart::total();

if($cost > 0)
{
$order = new Order;

        $order->userId = $userId;
        $order->cost = $cost;
        $order->status = '0';
        $order->save();

$lastInsertId = $order->id; // for using it in orderItem table

foreach(Cart::content() as $item)
  {
    $orderItem = new orderitem;
    $orderItem->orderId = $lastInsertId;
    $orderItem->productId = $item->id;
    $orderItem->pharmacistId = $item->options->pharmacistId;
    $orderItem->quantity = $item->qty;
    $orderItem->save();

}

        Cart::destroy();
return $this->generateInvoice($lastInsertId);
  }
else
return redirect('/');
  }



  // |---------------------------------- viewOrders ----------------------------------|
  public function viewOrders()
  {
    $userId = Auth::user()->id;

    $orders = Order::where('userId', $userId)->paginate(15);

return view('user.orderList', compact('orders'));
  }



  // |---------------------------------- viewOrderDetails ----------------------------------|
  public function viewOrderDetails($orderId)
  {
    $orderItems = Orderitem::where('orderId', $orderId)->take(15)->get();

    foreach($orderItems as $orderItem)
    {
      $productId = $orderItem->productId;
      $product[] = Pharmacistproduct::whereId($productId)->first();

    }
    return view('user.orderDetails', compact('product','orderItems'));
  }



  // |---------------------------------- generateInvoice ----------------------------------|
  public function generateInvoice($lastInsertId)
  {
      $product=[];
    $order = Order::whereId($lastInsertId)->first();
    $customerDetails = User::whereId($order->userId)->first();

    $orderItems = Orderitem::where('orderId', $lastInsertId)->take(15)->get();
    // dd($orderItems);
    foreach($orderItems as $orderItem)
    {
      $productId = $orderItem->productId;
      $product[] = Pharmacistproduct::whereId($productId)->first();
    }
    Mail::send(new invoice($customerDetails, $product, $order, $orderItems));
    return view('siteView.invoice', compact('product', 'order', 'orderItems', 'customerDetails', 'lastInsertId'));
  }
}
