<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web', ['except' => ['logout', 'userlogout']]);
    }

    // overriding default credentials method to check verificationStatus of user
    protected function credentials(Request $request)
    {
        return ['email'=>$request->{$this->username()},'password' => $request->password, 'verificationStatus' => '1', 'status' => '1'];
    }

    // overriding default sendFailedLoginResponse method to show appropriate error message to user if verificationStatus is 0 -> email not verified
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        // Load user from database
        $user = User::where($this->username(), $request->{$this->username()})->first();

        // Check if user was successfully loaded, that the password matches
        // and verificationStatus is 0. If so, override the default error message.
        if ($user && \Hash::check($request->password, $user->password) && $user->verificationStatus == 0) {
            return redirect()->back()->withInput($request->only('email', 'remember'))->with('error', 'Verify Account First');
        }
        if ($user && \Hash::check($request->password, $user->password) && $user->status == 0) {
            return redirect()->back()->withInput($request->only('email', 'remember'))->with('error', 'Your Account has been Blocked! Contact Admin');
        }

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }


    public function userlogout()
    {
        Auth::guard('web')->logout();

        return redirect('/');
    }
}
