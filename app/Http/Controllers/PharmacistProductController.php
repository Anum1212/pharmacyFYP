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
         $products = Pharmacistproduct::where('pharmacistId', Auth::user()->id)->get();
        return view('pharmacist.viewProducts', compact('products'));
    }



    // |---------------------------------- addProductForm ----------------------------------|
    
    public function addProductForm()
    {
        return view('pharmacist.addProduct');
    }
    


    // |---------------------------------- addProduct ----------------------------------|
    public function addProduct(Request $req)
    {
        $newProduct = new Pharmacistproduct;

        // store data in the pharmacist's table
            $newProduct->pharmacistId = Auth::user()->id;
            $newProduct->name = $req->productName;
            $newProduct->dosage = $req->dosage;
            $newProduct->type = $req->drugType;
            $newProduct->price = $req->price;
            $newProduct->quantity = $req->quantity;
            $newProduct->save();

            return redirect('/pharmacist/viewProducts');
    }



    // |---------------------------------- editProductForm ----------------------------------|
    
    public function editProductForm($productId)
    {
        // get logged in pharamcist details
        $userData=Auth::user()->whereId(Auth::user()->id)->first();
         $product = Pharmacistproduct::where([
                ['id', '=', $userData->id],
                ['pharmacistId', '=', $productId],
             ])->first();
        return view('pharmacist.editProduct', compact('product'));
    }
    

    // |---------------------------------- editProduct ----------------------------------|
    public function editProduct(Request $req, $productId)
    {
        $newProduct = new Pharmacistproduct;

        // store data in the pharmacist's table
            $newProduct->name = $req->productName;
            $newProduct->dosage = $req->dosage;
            $newProduct->type = $req->drugType;
            $newProduct->price = $req->price;
            $newProduct->quantity = $req->quantity;
            $newProduct->save();

            return redirect('/pharmacist/viewProducts');
    }



    // |---------------------------------- deleteProduct ----------------------------------|
    
    public function deleteProduct($productId)
    {
        $deleteRecord = Pharmacistproduct::find(Auth::user()->id);
        $deleteRecord->delete();
        return redirect('/pharmacist/viewProducts');
    }
}
