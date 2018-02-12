<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Geocode;
use Mail;
use App\Mail\verifyEmailToUser;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'contact'       =>      'required|digits:11',
            'address'       =>      'required',
            'society'       =>      'required',
            'city'          =>      'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
      $address = $data['address'].' '.$data['society'].' '.$data['city'];
        $addressToLatLng = Geocode::make()->address($address);
if ($addressToLatLng) {
	$latitude = $addressToLatLng->latitude();
	$longitude = $addressToLatLng->longitude();
        $user = User::create([
            'status' => '0',
            'name' => $data['name'],
            'email' => $data['email'],
            'contact' => $data['contact'],
            'address' => $data['address'],
            'society' => $data['society'],
            'city' => $data['city'],
            'latitude' => $latitude,
            'longitude' => $longitude,
            'password' => bcrypt($data['password']),
            'verificationToken' => Str::random(40),
        ]);

        $thisUser = User::findOrFail($user->id);
        $this->sendEmail($thisUser);
        return $user;
    }
  }

// overriding register function found in D:\Projects\Pharmacy\vendor\laravel\framework\src\Illuminate\Foundation\Auth\RegistersUsers
  public function register(Request $request)
{
    $this->validator($request->all())->validate();

    event(new Registered($user = $this->create($request->all())));
    return redirect('login')->with('message', 'A confirmation email has been sent');
}

// to send email
public function sendEmail($thisUser)
{
  Mail::to($thisUser['email'])->send(new verifyEmailToUser($thisUser));
}

// to update user status to verified
public function sendVerifyEmail($email, $verificationToken)
{
  $user = User::where(['email' => $email, 'verificationToken' => $verificationToken])->first();
  if($user){
    User::where(['email' => $email, 'verificationToken' => $verificationToken])->update(['verificationStatus'=>'1', 'verificationToken' => NULL]);
    return redirect('login')->with('message', 'Verification Successful');
  }
  else {
    return redirect('login')->with('error', 'There seems to be an error. Try to login if login fails register again');
  }
}
}
