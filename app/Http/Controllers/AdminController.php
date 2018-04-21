<?php



// controller Details
// ------------------
// methods and their details
// ---------------------------



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pharmacist;
use App\Order;


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
        $customerId = array_unique($allCustomerId);
        for ($i=0; $i<count($customerId); $i++) {
            $customers[$i] = User::whereId($customerId[$i])->first();
        }
    return view('admin.orders.viewAllOrders', compact('orders', 'customers'));
}



// |---------------------------------- viewAllCustomers ----------------------------------|
public function viewAllCustomers()
{
    $users = User::paginate(15);
    return view('admin.users.viewAllCustomers', compact('users'));
}



// |---------------------------------- viewAllCustomers ----------------------------------|
public function viewSpecificCustomer($customerId)
{
    $customer = User::find($customerId);
    $orders = Order::where('userId', $customerId)->paginate(15);
    return view('admin.users.customerDetails', compact('customer', 'orders'));
}



// |---------------------------------- viewAllPharmacies ----------------------------------|
public function viewAllPharmacies()
{
    $users = Pharmacist::paginate(15);
    return view('admin.users.viewAllPharmacies', compact('users'));
}



}
