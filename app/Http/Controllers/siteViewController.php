<?php



// controller Details
// ------------------
// methods and their details
// ---------------------------
// index --> return main index page



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class siteViewController extends Controller
{



  // |---------------------------------- index ----------------------------------|
    public function index()
    {
        return view('siteView.index');
    }
}
