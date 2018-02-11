<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PharmacistLoginController extends Controller
{
    public function __construct()
    {
        //defining our middleware for this controller
        $this->middleware('guest:pharmacist',['except' => ['logout']]);
    }

    //function to show pharmacist login form
    public function showLoginForm() {
        return view('auth.pharmacist-login');
    }
    //function to login pharmacists
    public function login(Request $request) {
        //validate the form data
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        //attempt to login the pharmacists in
        if (Auth::guard('pharmacist')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            //if successful redirect to pharmacist dashboard
            return redirect()->intended(route('pharmacist.dashboard'));
        }
        //if unsuccessfull redirect back to the login for with form data
        return redirect()->back()->withInput($request->only('email','remember'));
    }

    public function logout()
    {
        Auth::guard('pharmacist')->logout();

        return redirect('/');
    }

}
