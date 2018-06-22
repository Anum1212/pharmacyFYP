<?php



// controller Details
// ------------------
// Methods Present
// ------------------
// 1) __construct
// 2) changeStatus



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\carbon;
use App\Rating;
use App\Order;
use App\Orderitem;
use App\Pharmacist;
use App\Pharmacistproduct;



class cronController extends Controller
{



  // |---------------------------------- 1) __construct ----------------------------------|
    public function __construct()
    {
        // $this->middleware('auth');
    }



    // |---------------------------------- 2) changeStatus ----------------------------------|
    public function changeStatus()
    {
        $ratingStatus = Order::where([
            ['ratingStatus','0'],
            ['created_at', '<', Carbon::now()->subHours(12)->toDateTimeString()]])->get();
        foreach ($ratingStatus as $changeRatingStatus) {
            $changeRatingStatus->ratingStatus = '1';
            $changeRatingStatus->update();
        }
    }
}
