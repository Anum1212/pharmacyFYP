<?php



// controller Details
// ------------------
// methods and their details
// ---------------------------
// 1) addToCart --> add product to cart
// 2) remove --> remove product from cart
// 3) view --> go to cart page
// 4) update --> update quantity of cart item


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Pharmacist;
use App\Pharmacistproduct;
use Cart;
use Auth;

class cartController extends Controller
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



    // |---------------------------------- addToCart ----------------------------------|
    public function addToCart($productId)
    {
        $productDetails = Pharmacistproduct::whereId($productId)->first();
        $cart = Cart::add($productDetails->id, $productDetails->name, '1', $productDetails->price, ['pharmacistId' => $productDetails->pharmacistId, 'pharmacistName' => $productDetails->pharmacistName]);
        return redirect('/viewCart'); // change in future
    }



    // |---------------------------------- remove ----------------------------------|
    public function remove($rowId)
    {
        Cart::remove($rowId);
        return view('siteView.cart');
    }



    // |---------------------------------- view ----------------------------------|
    public function view()
    {
        return view('siteView.cart');
    }



    // |---------------------------------- update ----------------------------------|
    public function update(Request $req)
    {
        $i=0;
        foreach (Cart::content() as $item) {
            $itemRowId = $item->rowId;
            Cart::update($itemRowId, $req->qty[$i]);
            $i++;
        }
        return redirect::back();
    }


    // |---------------------------------- destruct ----------------------------------|
    public function __destruct()
    {
        Cart::instance('shopping')->store(Auth::id());
    }
}
