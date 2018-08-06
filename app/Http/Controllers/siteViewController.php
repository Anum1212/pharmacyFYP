<?php



// controller Details
// ------------------
// Methods Present
// ------------------
// 1) __construct
// 2) index
// 3) downloads
// 4) contactUsFormGeneral
// 5) aboutUs



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\File;
use Cart;
use Auth;

class siteViewController extends Controller
{


    
     //  |---------------------------------- 1) __construct ----------------------------------|
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('userTypeCorP')->only(['downloads']);
        $this->middleware(function ($request, $next) {
            Cart::instance('shopping');
            Cart::restore(Auth::id());

            return $next($request);
        });
    }



  // |---------------------------------- 2) index ----------------------------------|
    public function index()
    {
        return view('siteView.index');
    }



  // |---------------------------------- 3) downloads ----------------------------------|
    public function downloads()
    {
        $files = File::all();
        return view('siteView.downloads', compact('files'));
    }



  // |---------------------------------- 4) contactUsFormGeneral ----------------------------------|
    public function contactUsFormGeneral()
    {
        return view('siteView.messageToAdminForm');
    }



  // |---------------------------------- 5) aboutUs ----------------------------------|
    public function aboutUs()
    {
        return view('siteView.aboutUs');
    }
}
