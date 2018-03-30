<?php



// controller Details
// ------------------
// methods and their details
// ---------------------------
// 1) index --> display all pharmacy ratings
// 2) ratePharmacy --> save rating



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rating;
use App\Pharmacist;

class ratingController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }


  // |---------------------------------- index ----------------------------------|
  public function index()
  {
    // getting activated pahrmacy records
    $pharmacies = Pharmacist::where([
            ['pharmacistStatus', '=', '1'], // Pharmacy is not banned by admin
                ['verificationStatus', '=', '1'], // pharmacist has verified the email
                ])->get();
    // getting ratings of those "$pharmacies" form ratings table
    // we can directly read the ratings table but this way will only get result of pharmacies that are enabled
    for($i=0; $i<count($pharmacies);$i++)
    $pharmacyRatings[] = Rating::where('pharmacyId', $pharmacies[$i]->id)->first();
    return view('ratingsPage', compact('pharmacyRatings'));
  }


  // |---------------------------------- ratePharmacy ----------------------------------|
    public function ratePharmacy(Request $req, $pharmacyId)
    {
      echo $req->rating;
      $currentRating = Rating::where('pharmacyId', $pharmacyId)->first();

      // to convert the average back to total points
      $totalRating = $currentRating->rating*$currentRating->noOfUserThatRated;
      //adding 1 to old noOfUserThatRated to get new noOfUserThatRated
      $currentRating->noOfUserThatRated = $currentRating->noOfUserThatRated+1;
      // average formula (old total points + new user points)/ total number of people that rated
      $currentRating->rating = ($totalRating+$req->rating)/$currentRating->noOfUserThatRated;

      // update rating
      $currentRating->update();
      return redirect()->action('ratingController@index');
    }
}
