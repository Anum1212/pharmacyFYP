<?php



// controller Details
// ------------------
// Methods Present
// ------------------
// 1) __construct
// 2) index
// 3) viewAllOrders
// 4) viewSpecificOrder
// 5) viewPharmacySpecificOrder
// 6) searchOrder
// 7) viewAllCustomers
// 8) viewSpecificCustomer
// 9) blockCustomer
// 10) unBlockCustomer
// 11) viewAllPharmacies
// 12) pharmacyDetails
// 13) blockPharmacy
// 14) unBlockPharmacy
// 15) viewAllFiles
// 16) uploadFileForm
// 17) uploadFile
// 18) editFileForm
// 19) editFile
// 20) enableFile
// 21) disableFile
// 22) deleteFile
// 23) searchFile



// possible customer status
// 0 -> banned
// 1 -> not banned (default)

// possible pharmacy status
// 0 -> banned
// 1 -> not banned (default)

// possible uploaded file status
// 0 -> file download disabled
// 1 -> file download enabled (default)



namespace App\Http\Controllers;

use DB;
use App\File;
use Carbon\carbon;
use App\Order;
use App\Orderitem;
use App\Pharmacist;
use App\Pharmacistproduct;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;



class AdminController extends Controller
{



    // |---------------------------------- 1) __construct ----------------------------------|
    public function __construct()
    {
        $this->middleware('auth:admin');
    }



    // |---------------------------------- 2) index ----------------------------------|
    public function index()
    {
        // count all orders where time since order is less than 24 hours
        $newOrders = Order::where([
            ['created_at', '>=', Carbon::now()->subDays(1)]
        ])->count();

        // count total orders in database
        $totalOrders = Order::count();

        $totalCustomers = User::where('verificationStatus', 1)->count();
        $totalPharmacist = Pharmacist::where('verificationStatus', 1)->count();

        // most searched medicine
        $medicines=DB::table('mostsearch')->select('name', DB::raw('count(name) as total'))->whereMonth('created_at', '=', date('m'))->groupBy('name')->orderBy('total', 'DESC')->take(10)->get();
        return view('admin.adminDashboard', compact('medicines', 'newOrders', 'totalOrders', 'totalCustomers', 'totalPharmacist'));
    }



    // |---------------------------------- 3) viewAllOrders ----------------------------------|
    public function viewAllOrders()
    {
        $customers = [];
        $orders = Order::paginate(30);
        if ($orders->count()) {
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
            for ($i = 0; $i < count($arrangedCustomerId); $i++) {
                $customers[$i] = User::whereId($arrangedCustomerId[$i])->first();
            }
        }
        return view('admin.orders.viewAllOrders', compact('orders', 'customers'));
    }



    //  |---------------------------------- 4) viewSpecificOrder ----------------------------------|
    public function viewSpecificOrder($orderId)
    {
        $order = Order::whereId($orderId)->first();
        if (!empty($order)) {
            $customerDetails = User::whereId($order->userId)->first();

            $productDetails = [];
            $pharmacyDetails = [];
            $orderDetails = Orderitem::where('orderId', $orderId)->get();

            foreach ($orderDetails as $orderDetail) {
                $pharmacyDetails[] = Pharmacist::whereId($orderDetail->pharmacistId)->first();
                $productDetails[] = Pharmacistproduct::whereId($orderDetail->productId)->first();
            }
            return view('admin.orders.specificOrder', compact('pharmacyDetails', 'productDetails', 'orderDetails', 'customerDetails'));
        } else {
            return redirect()->action('AdminController@viewAllOrders')->with('error', 'order# '.$orderId.' not found');
        }
    }



    //  |---------------------------------- 5) viewPharmacySpecificOrder ----------------------------------|
    public function viewPharmacySpecificOrder($orderId, $customerId, $pharmacyId)
    {
        $productDetails = [];
        $order = Order::whereId($orderId)->first();
        if (!empty($order)) {
            $orderDetails = Orderitem::where([
            ['orderId', $orderId],
            ['pharmacistId', $pharmacyId],
        ])->get();

            $customerDetails = User::whereId($customerId)->first();
            foreach ($orderDetails as $orderDetail) {
                $productDetails[] = Pharmacistproduct::whereId($orderDetail->productId)->first();
            }

            return view('admin.orders.pharmacySpecificOrder', compact('order', 'orderDetails', 'productDetails', 'customerDetails'));
        } else {
            return redirect()->action('AdminController@viewAllOrders')->with('error', 'order# '.$orderId.' not found');
        }
    }



    //  |---------------------------------- 6) searchOrder ----------------------------------|
    public function searchOrder(Request $req)
    {
        $totalSearchResults = File::where('id', 'LIKE', '%' . $req->search . '%')->count();
        $searchResults = File::where('id', 'LIKE', '%' . $req->search . '%')->paginate(30);
        return view('admin.orders.searchResult', compact('totalSearchResults', 'searchResults'));
    }



    // |---------------------------------- 7) viewAllCustomers ----------------------------------|
    public function viewAllCustomers()
    {
        $totalUsers = User::count();
        $users = User::paginate(30);
        return view('admin.users.viewAllCustomers', compact('users', 'totalUsers'));
    }



    // |---------------------------------- 8) viewSpecificCustomer ----------------------------------|
    public function viewSpecificCustomer($customerId)
    {
        $customer = User::find($customerId);
        if (!empty($customer)) {
            $orders = Order::where('userId', $customerId)->paginate(30);
            return view('admin.users.customerDetails', compact('customer', 'orders'));
        } else {
            return redirect()->action('AdminController@viewAllCustomers')->with('error', 'No such customer found');
        }
    }



    //  |---------------------------------- 9) blockCustomer ----------------------------------|
    public function blockCustomer($customerId)
    {
        $customer = User::find($customerId);
        if (!empty($customer)) {
            $customer->status = '0';
            $customer->save();
            return redirect('/admin/viewAllCustomers')->with('message', 'Block successful');
        } else {
            return redirect()->action('AdminController@viewAllCustomers')->with('error', 'No such customer found');
        }
    }



    //  |---------------------------------- 10) unBlockCustomer ----------------------------------|
    public function unBlockCustomer($customerId)
    {
        $customer = User::find($customerId);
        if (!empty($customer)) {
            $customer->status = '1';
            $customer->save();
            return redirect('/admin/viewAllCustomers')->with('message', 'UnBlock successful');
        } else {
            return redirect()->action('AdminController@viewAllCustomers')->with('error', 'No such customer found');
        }
    }



    // |---------------------------------- 11) viewAllPharmacies ----------------------------------|
    public function viewAllPharmacies()
    {
        $totalUsers = Pharmacist::count();
        $users = Pharmacist::paginate(30);
        return view('admin.users.viewAllPharmacies', compact('users', 'totalUsers'));
    }



    //  |---------------------------------- 12) pharmacyDetails ----------------------------------|
    public function pharmacyDetails($pharmacyId)
    {
        $pharmacy = Pharmacist::whereId($pharmacyId)->first();
        $allOrderId = [];
        $allCustomerId = [];
        $customer = [];
        $orders = [];

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
        for ($i = 0; $i < count($arrangedOrderId); $i++) {
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
        for ($i = 0; $i < count($arrangedCustomerId); $i++) {
            $customers[$i] = User::whereId($arrangedCustomerId[$i])->first();
        }
        return view('admin.users.pharmacyDetails', compact('pharmacy', 'orders', 'customers'));
    }



    //  |---------------------------------- 13) blockPharmacy ----------------------------------|
    public function blockPharmacy($pharmacyId)
    {
        $pharmacy = Pharmacist::find($pharmacyId);

        $pharmacy->pharmacistStatus = '0';
        $pharmacy->save();
        return redirect('/admin/viewAllPharmacies')->with('message', 'Block successful');
    }



    //  |---------------------------------- 14) unBlockPharmacy ----------------------------------|
    public function unBlockPharmacy($pharmacyId)
    {
        $pharmacy = Pharmacist::find($pharmacyId);

        $pharmacy->pharmacistStatus = '1';
        $pharmacy->save();
        return redirect('/admin/viewAllPharmacies')->with('message', 'UnBlock successful');
    }



    //  |---------------------------------- 15) viewAllFiles ----------------------------------|
    public function viewAllFiles()
    {
        $totalEnabledFiles = File::where('status', 1)->count();
        $enabledFiles = File::where('status', 1)->latest()->paginate(30, ['*'], 'enabledTable');
        $totaldisabledFiles = File::where('status', 1)->count();
        $disabledFiles = File::where('status', 0)->latest()->paginate(30, ['*'], 'disabledTable');
        return view('admin.file.viewAllFiles', compact('totalEnabledFiles', 'enabledFiles', 'totaldisabledFiles', 'disabledFiles'));
    }



    //  |---------------------------------- 16) uploadFileForm ----------------------------------|
    public function uploadFileForm()
    {
        return view('admin.file.uploadFile');
    }



    //  |---------------------------------- 17) uploadFile ----------------------------------|
    public function uploadFile(Request $req)
    {
        if ($req->file('uploadFile')) {
            Storage::put('public/myAssets/files', $req->uploadFile);

            $saveFormData = new File;
            $saveFormData->title = $req->fileTitle;
            $saveFormData->description = $req->description;
            $saveFormData->filename = $req->uploadFile->hashName();
            $saveFormData->status = "1";
            $saveFormData->save();
            return redirect::back()->with('message', 'Upload Successful');
        }
    }



    //  |---------------------------------- 18) editFileForm ----------------------------------|
    public function editFileForm($fileId)
    {
        $file = File::find($fileId);
        return view('admin.file.editFile', compact('file'));
    }



    //  |---------------------------------- 19) editFile ----------------------------------|
    public function editFile(Request $req, $fileId)
    {
        $saveFormData = File::find($fileId);

        if ($req->file('uploadFile')) {
            Storage::put('public/myAssets/files', $req->uploadFile);
            // delete old file
            if (File::exists('storage/myAssets/files/' . $saveFormData->filename)) {
                Storage::delete('public/myAssets/files/' . $saveFormData->filename);
            }

            $saveFormData->filename = $req->uploadFile->hashName();
        }
        $saveFormData->title = $req->fileTitle;
        $saveFormData->description = $req->description;
        $saveFormData->save();
        return redirect()->action('AdminController@viewAllFiles')->with('message', 'Edit successful');
    }



    //  |---------------------------------- 20) enableFile ----------------------------------|
    public function enableFile($fileId)
    {
        $file = File::find($fileId);
        $file->status = "1";
        $file->save();
        return redirect()->action('AdminController@viewAllFiles')->with('message', 'File enable successful');
    }



    //  |---------------------------------- 21) disableFile ----------------------------------|
    public function disableFile($fileId)
    {
        $file = File::find($fileId);
        $file->status = "0";
        $file->save();
        return redirect()->action('AdminController@viewAllFiles')->with('message', 'File disable successful');
    }



    //  |---------------------------------- 22) deleteFile ----------------------------------|
    public function deleteFile($fileId)
    {
        $file = File::find($fileId);
        if (File::exists('storage/myAssets/files/' . $file->filename)) {
            Storage::delete('public/myAssets/files/' . $file->filename);
        }

        $file->delete();
        return redirect()->action('AdminController@viewAllFiles')->with('message', 'File delete successful');
    }



    //  |---------------------------------- 23) searchFile ----------------------------------|
    public function searchFile(Request $req)
    {
        $totalSearchResults = File::where('title', 'LIKE', '%' . $req->search . '%')->count();
        $searchResults = File::where('title', 'LIKE', '%' . $req->search . '%')->paginate(30);
        return view('admin.file.searchResult', compact('totalSearchResults', 'searchResults'));
    }
}
