<?php



// controller Details
// ------------------
// methods and their details
// ---------------------------



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pharmacist;
use App\Pharmacistproduct;
use App\Order;
use App\Orderitem;


class AdminController extends Controller
{



// |---------------------------------- index ----------------------------------|
    public function index()
    {
        return view('admin.adminDashboard');
    }



// |---------------------------------- contactUs ----------------------------------|
    public function __construct()
    {
        $this->middleware('auth:admin');
    }



// |---------------------------------- viewAllOrders ----------------------------------|
public function viewAllOrders()
{
    $customers = [];
    $orders = Order::paginate(15);
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
    return view('admin.orders.viewAllOrders', compact('orders', 'customers'));
}



    //  |---------------------------------- viewSpecificOrder ----------------------------------|
    public function viewSpecificOrder($orderId)
    {
        $order = Order::whereId($orderId)->first();
        $customerDetails = User::whereId($order->userId)->first();

        $productDetails =[];
        $pharmacyDetails =[];
        $orderDetails = Orderitem::where('orderId', $orderId)->get();

        foreach ($orderDetails as $orderDetail) {
            $pharmacyDetails[] = Pharmacist::whereId($orderDetail->pharmacistId)->first();
            $productDetails[]  = Pharmacistproduct::whereId($orderDetail->productId)->first();
        }
        return view('admin.orders.specificOrder', compact('pharmacyDetails', 'productDetails', 'orderDetails', 'customerDetails'));
    }



    //  |---------------------------------- viewPharmacySpecificOrder ----------------------------------|
    public function viewPharmacySpecificOrder($orderId, $customerId, $pharmacyId)
{
        $productDetails =[];
        $order = Order::whereId($orderId)->first();
        $orderDetails = Orderitem::where([
            ['orderId', $orderId],
            ['pharmacistId', $pharmacyId]
            ])->get();

        $customerDetails =  User::whereId($customerId)->first();
        foreach ($orderDetails as $orderDetail) {
            $productDetails[]=Pharmacistproduct::whereId($orderDetail->productId)->first();
        }

        // dd($orderDetails, $productDetails);
        return view('admin.orders.pharmacySpecificOrder', compact('order', 'orderDetails', 'productDetails', 'customerDetails'));
    }


    
// |---------------------------------- viewAllCustomers ----------------------------------|
public function viewAllCustomers()
{
    $users = User::paginate(15);
    return view('admin.users.viewAllCustomers', compact('users'));
}



// |---------------------------------- viewSpecificCustomer ----------------------------------|
public function viewSpecificCustomer($customerId)
{
    $customer = User::find($customerId);
    $orders = Order::where('userId', $customerId)->paginate(15);
    return view('admin.users.customerDetails', compact('customer', 'orders'));
}


    //  |---------------------------------- blockCustomer ----------------------------------|
    public function blockCustomer($customerId)
    {
        $customer = User::find($customerId);

        $customer->status='0';
        $customer->save();
        return redirect('/admin/viewAllCustomers');
    }


    
    //  |---------------------------------- unBlockCustomer ----------------------------------|
    public function unBlockCustomer($customerId)
    {
        $customer = User::find($customerId);

        $customer->status='1';
        $customer->save();
        return redirect('/admin/viewAllCustomers');
    }



// |---------------------------------- viewAllPharmacies ----------------------------------|
public function viewAllPharmacies()
{
    $users = Pharmacist::paginate(15);
    return view('admin.users.viewAllPharmacies', compact('users'));
}


    //  |---------------------------------- pharmacyDetails ----------------------------------|
    public function pharmacyDetails($pharmacyId)
    {
        $pharmacy = Pharmacist::whereId($pharmacyId)->first();
        $allOrderId=[];
        $allCustomerId=[];
        $customer=[];
        $orders=[];
        
        $orderItems = Orderitem::where('pharmacistId', $pharmacyId)->orderBy('id', 'desc')->get();
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
        return view('admin.users.pharmacyDetails', compact('pharmacy', 'orders', 'customers'));
        
    }
    
    
    
    //  |---------------------------------- blockPharmacy ----------------------------------|
    public function blockPharmacy($pharmacyId)
    {
        $pharmacy = Pharmacist::find($pharmacyId);

        $pharmacy->pharmacistStatus='0';
        $pharmacy->save();
        return redirect('/admin/viewAllPharmacies');
    }



    //  |---------------------------------- unBlockPharmacy ----------------------------------|
    public function unBlockPharmacy($pharmacyId)
    {
        $pharmacy = Pharmacist::find($pharmacyId);

        $pharmacy->pharmacistStatus='1';
        $pharmacy->save();
        return redirect('/admin/viewAllPharmacies');
    }
}
