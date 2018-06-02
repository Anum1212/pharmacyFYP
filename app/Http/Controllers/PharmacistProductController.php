<?php



// controller Details
// ------------------
// methods and their details
// ---------------------------
// 1) viewProducts --> display the pharmacist its pharmacy products
// 2) addProductForm --> display add product form
// 3) addProduct --> save product
// 4) editProductForm --> display edit product form
// 5) editProduct --> save changes
// 6) deleteProduct --> delete product



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Pharmacist;
use App\Pharmacistproduct;
use Auth;

class PharmacistProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pharmacist');
    }



    // |---------------------------------- viewProducts ----------------------------------|

    public function viewProducts()
    {
        $totalProducts = Pharmacistproduct::where('pharmacistId', Auth::user()->id)->count();
        $products = Pharmacistproduct::where('pharmacistId', Auth::user()->id)->paginate(30);
        return view('pharmacist.productManagment.viewProducts', compact('products', 'totalProducts'));
    }



    // |---------------------------------- addProductForm ----------------------------------|

    public function addProductForm()
    {
        return view('pharmacist.productManagment.addProduct');
    }



    // |---------------------------------- addProduct ----------------------------------|
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
        $newProduct->save();

        return redirect('/pharmacist/viewProducts')->with('message', 'Product add successful');
    }



    // |---------------------------------- editProductForm ----------------------------------|

    public function editProductForm($productId)
    {
        // get logged in pharamcist details
        $userData=Auth::user()->whereId(Auth::user()->id)->first();
        $product = Pharmacistproduct::where([
                ['id', '=', $productId],
                ['pharmacistId', '=', $userData->id],
             ])->first();
        return view('pharmacist.productManagment.editProduct', compact('product'));
    }


    // |---------------------------------- editProduct ----------------------------------|
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
        $product->save();

        return redirect('/pharmacist/viewProducts')->with('message', 'Edit successful');
    }



    // |---------------------------------- deleteProduct ----------------------------------|

    public function deleteProduct($productId)
    {
        $deleteRecord = Pharmacistproduct::find($productId);
        $deleteRecord->delete();
        return redirect('/pharmacist/viewProducts')->with('message', 'Delete successful');
    }
}
