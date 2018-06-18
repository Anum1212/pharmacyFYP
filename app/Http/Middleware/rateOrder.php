<?php

namespace App\Http\Middleware;

use Auth;
use Carbon\carbon;
use App\Rating;
use App\Order;
use App\Orderitem;
use App\Pharmacist;
use App\Pharmacistproduct;

use Closure;

class rateOrder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $allPharmacistIds = [];
        $pharmacyRatings = [];
        $order = Order::where([['userId', Auth::user()->id], ['ratingStatus', '1']])->first();
        if(!empty($order)){
        $orderDetails = Orderitem::where('orderId', $order->id)->get();
        
        foreach ($orderDetails as $orderDetail) {
            $productId = $orderDetail->productId;
            $allPharmacistIds[] = $orderDetail->pharmacistId;
            $product[] = Pharmacistproduct::whereId($productId)->first();
        }
        
        // to remove duplicates
        $pharmacistId = array_unique($allPharmacistIds);
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
        $arrangedPharmacistId = array_values($pharmacistId);
            for ($i=0; $i<count($arrangedPharmacistId); $i++) {
                $pharmacyRatings[] = Rating::where('pharmacyId', $arrangedPharmacistId[$i])->first();
            }
            $request->request->add(['pharmacyRatings' => $pharmacyRatings]);
            $request->request->add(['orderId' => $order->id]);
            
            return $next($request);
            // return response()->view('ratingsPage', compact('pharmacyRatings'));
        }
        return $next($request);
}
}