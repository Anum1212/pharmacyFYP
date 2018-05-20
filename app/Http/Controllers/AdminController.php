<?php



// controller Details
// ------------------
// methods and their details
// ---------------------------



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use App\File;
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



    //  |---------------------------------- viewAllFiles ----------------------------------|
    public function viewAllFiles()
    {
        $enabledFiles = File::where('status', 1)->latest()->paginate(10, ['*'], 'enabledTable');
        $disabledFiles = File::where('status', 0)->latest()->paginate(10, ['*'], 'disabledTable');
        return view('admin.file.viewAllFiles', compact('enabledFiles', 'disabledFiles'));
    }



    //  |---------------------------------- uploadFileForm ----------------------------------|
    public function uploadFileForm()
    {
        return view('admin.file.uploadFile');
    }



    //  |---------------------------------- uploadFile ----------------------------------|
    public function uploadFile(Request $req)
    {
        if ($req->file('uploadFile')) {
            Storage::put('public/myAssets/files', $req->uploadFile);

            $saveFormData = new File;
            $saveFormData->title = $req->fileTitle;
            $saveFormData->filename = $req->uploadFile->hashName();
            $saveFormData->status = "1";
            $saveFormData->save();
            return redirect::back()->with('message', 'Upload Successful');
        }
    }



    //  |---------------------------------- editFileForm ----------------------------------|
    public function editFileForm($fileId)
    {
        $file = File::find($fileId);
        return view('admin.file.editFile', compact('file'));
    }



    //  |---------------------------------- editFile ----------------------------------|
    public function editFile(Request $req, $fileId)
    {
        $saveFormData = File::find($fileId);

        if ($req->file('uploadFile')) {
            Storage::put('public/myAssets/files', $req->uploadFile);
            // delete old file
            if (File::exists('storage/myAssets/files/'.$saveFormData->filename)) {
                Storage::delete('public/myAssets/files/'.$saveFormData->filename);
            }

            $saveFormData->filename = $req->uploadFile->hashName();
        }
        $saveFormData->title = $req->fileTitle;
        $saveFormData->save();
        return redirect()->action('AdminController@viewAllFiles');
    }



    //  |---------------------------------- enableFile ----------------------------------|
    public function enableFile($fileId)
    {
        $file = File::find($fileId);
        $file->status = "1";
        $file->save();
        return redirect()->action('AdminController@viewAllFiles');
    }



    //  |---------------------------------- disableFile ----------------------------------|
    public function disableFile($fileId)
    {
        $file = File::find($fileId);
        $file->status = "0";
        $file->save();
        return redirect()->action('AdminController@viewAllFiles');
    }



    //  |---------------------------------- deleteFile ----------------------------------|
    public function deleteFile($fileId)
    {
        $file = File::find($fileId);
        if (File::exists('storage/myAssets/files/'.$file->filename)) {
            Storage::delete('public/myAssets/files/'.$file->filename);
        }

        $file->delete();
        return redirect()->action('AdminController@viewAllFiles');
    }



    //  |---------------------------------- searchFile ----------------------------------|
    public function searchFile(Request $req)
    {
        $searchResults = File::where('title', 'LIKE', '%'.$req->search.'%')->paginate(15);
        return view('admin.file.searchResult', compact('searchResults'));
    }
}
