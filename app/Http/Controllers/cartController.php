<?php



// controller Details
// ------------------
// Methods Present
// ------------------
// 1) __construct
// 2) addToCart --> add product to cart
// 3) remove --> remove product from cart
// 4) view --> go to cart page
// 5) update --> update quantity of cart item
// 6) __destruct



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Pharmacist;
use App\Pharmacistproduct;
use Cart;
use Auth;
use Curl;



class cartController extends Controller
{



  // |---------------------------------- 1) construct ----------------------------------|
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            Cart::instance('shopping');
            Cart::restore(Auth::id());

            return $next($request);
        });
    }



    // |---------------------------------- 2) addToCart ----------------------------------|
    public function addToCart($productSource, $productId, $pharmacistId)
    {
        // productSource types
        //      1 -> website storage
        //      2 -> api storage
        //      3 -> localhost storage
        
        if ($productSource == 1) {
            $productDetails = Pharmacistproduct::whereId($productId)->first();
            $cart = Cart::add($productDetails->id, $productDetails->name, '1', $productDetails->price, ['type' => $productDetails->type, 'pharmacistId' => $productDetails->pharmacistId, 'pharmacistName' => $productDetails->pharmacistName, 'prescription' => $productDetails->prescription]);
        }
        
        if ($productSource == 2) {
            $pharmacyDetails = Pharmacist::whereId($pharmacistId)->first();
            $productDetails = Curl::to($pharmacyDetails->dbAPI.$productId)->asJson()->get();;
            $cart = Cart::add($productDetails[0]->id, $productDetails[0]->name, '1', $productDetails[0]->price, ['type' => $productDetails[0]->type, 'pharmacistId' => $pharmacistId, 'pharmacistName' => $productDetails[0]->pharmacistName, 'prescription' => $productDetails[0]->prescription]);
        }

        return redirect()->back()->with('message', 'Item added to cart'); // change in future
    }



    // |---------------------------------- 3) remove ----------------------------------|
    public function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect('/viewCart');
    }



    // |---------------------------------- 4) view ----------------------------------|
    public function view()
    {
        return view('siteView.cart');
    }



    // |---------------------------------- 5) update ----------------------------------|
    public function update(Request $req)
    {
        $i=0;
        foreach (Cart::content() as $item) {
            $itemRowId = $item->rowId;
            Cart::update($itemRowId, $req->qty[$i]);
            $i++;
        }
        return redirect('/viewCart')->with('message', 'cart updated');
    }



    // |---------------------------------- 6) destruct ----------------------------------|
    public function __destruct()
    {
        Cart::instance('shopping')->store(Auth::id());
    }
}
