<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Pharmacist;

class PharmacistLoginController extends Controller
{
    public function __construct()
    {
        //defining our middleware for this controller
        $this->middleware('guest:pharmacist', ['except' => ['logout']]);
    }

    //function to show pharmacist login form
    public function showLoginForm()
    {
        return view('auth.pharmacist-login');
    }
    //function to login pharmacists
    public function login(Request $request)
    {
        //validate the form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        //attempt to login the pharmacists in
        if (Auth::guard('pharmacist')->attempt(['email' => $request->email, 'password' => $request->password, 'verificationStatus' => '1'], $request->remember)) {
            //if successful redirect to pharmacist dashboard
            return redirect()->intended(route('pharmacist.dashboard'));
        }

        // if pharmacist hasn't verified email go to login form with form data and appropriate error message
        $pharmacist = Pharmacist::where('email', $request->email)->first();
        if (Auth::guard('pharmacist') && $pharmacist->verificationStatus == '0') {
            return redirect()->back()->withInput($request->only('email', 'remember'))->with('error', 'Verify Account First');
        }

        //if Wrong credentials or any other problem redirect back to the login form with form data and appropriate error message
        return redirect()->back()->withInput($request->only('email', 'remember'))->with('error', 'Wrong credentials');
    }


    // logout Pharmacist
    public function logout()
    {
        Auth::guard('pharmacist')->logout();

        return redirect('/');
    }
}
