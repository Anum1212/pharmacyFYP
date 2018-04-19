<?php



// controller Details
// ------------------
// methods and their details
// ---------------------------



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pharmacist;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */



// |---------------------------------- contactUs ----------------------------------|
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    
// |---------------------------------- index ----------------------------------|
public function index()
{
    return view('admin.adminDashboard');
}



// |---------------------------------- viewAllCustomers ----------------------------------|
public function viewAllCustomers()
{
    $users = User::paginate(15);
    return view('admin.users.viewAllCustomers', compact('users'));
}
// |---------------------------------- viewAllPharmacies ----------------------------------|
public function viewAllPharmacies()
{
    $users = Pharmacist::paginate(15);
    return view('admin.users.viewAllPharmacies', compact('users'));
}



}
