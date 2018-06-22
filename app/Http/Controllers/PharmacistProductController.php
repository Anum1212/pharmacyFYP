<?php



// controller Details
// ------------------
// Methods Present
// ------------------
// 1) __construct
// 2) viewProducts --> display the pharmacist its pharmacy products
// 3) addProductForm --> display add product form
// 4) addProduct --> save product
// 5) editProductForm --> display edit product form
// 6) editProduct --> save changes
// 7) deleteProduct --> product doesn't get deleted instead it simply gets disabled



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Pharmacist;
use App\Pharmacistproduct;
use Auth;



class PharmacistProductController extends Controller
{



  // |---------------------------------- 1) __construct ----------------------------------|
    public function __construct()
    {
        $this->middleware('auth:pharmacist');
    }



    // |---------------------------------- 2) viewProducts ----------------------------------|
    public function viewProducts()
    {
        $totalProducts = Pharmacistproduct::where('pharmacistId', Auth::user()->id)->count();
        $products = Pharmacistproduct::where('pharmacistId', Auth::user()->id)->paginate(30);
        return view('pharmacist.productManagment.viewProducts', compact('products', 'totalProducts'));
    }



    // |---------------------------------- 3) addProductForm ----------------------------------|
    public function addProductForm()
    {
        return view('pharmacist.productManagment.addProduct');
    }



    // |---------------------------------- 4) addProduct ----------------------------------|
    public function addProduct(Request $req)
    {
        $newProduct = new Pharmacistproduct;

        // store data in the pharmacist's table
        $newProduct->pharmacistId = Auth::user()->id;
        $newProduct->pharmacistName = Auth::user()->pharmacyName;
        $newProduct->name = $req->productName;
        $newProduct->dosage = $req->dosage;
        $newProduct->type = $req->drugType;
        $newProduct->prescription = $req->prescription;
        $newProduct->price = $req->price;
        $newProduct->quantity = $req->quantity;
        // $newProduct->status is set to 1 by default; see migration table

        $newProduct->save();

        return redirect('/pharmacist/viewProducts')->with('message', 'Product add successful');
    }



    // |---------------------------------- 5) editProductForm ----------------------------------|
    public function editProductForm($productId)
    {
        // get logged in pharamcist details
        $userData=Auth::user()->whereId(Auth::user()->id)->first();
        $product = Pharmacistproduct::where([
                ['id', '=', $productId],
                ['pharmacistId', '=', $userData->id],
             ])->first();
        if (!empty($product)) {
            return view('pharmacist.productManagment.editProduct', compact('product'));
        } else {
            return redirect()->action('PharmacistProductController@viewProducts')->with('error', 'product# '.$productId.' not found');
        }
    }


    // |---------------------------------- 6) editProduct ----------------------------------|
    public function editProduct(Request $req, $productId)
    {
        $product = Pharmacistproduct::find($productId);

        // store data in the pharmacist's table
        $product->name = $req->productName;
        $product->dosage = $req->dosage;
        $product->type = $req->drugType;
        $product->prescription = $req->prescription;
        $product->price = $req->price;
        $product->quantity = $req->quantity;
        // $product->status is set to 1 by default; see migration table
        $product->save();

        return redirect('/pharmacist/viewProducts')->with('message', 'Edit successful');
    }



    // |---------------------------------- 7) deleteProduct ----------------------------------|
    public function deleteProduct($productId)
    {
        $deleteRecord = Pharmacistproduct::find($productId);
        $deleteRecord->status = '0';
        $deleteRecord->save();
        return redirect('/pharmacist/viewProducts')->with('message', 'Delete successful');
    }
}
