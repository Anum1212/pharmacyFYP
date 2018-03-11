<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// *************** TEST ROUTES (for testing purposes only) ***************
Route::get('/test', 'testController@index');


// *************** SITE NAVIGATION ROUTES ***************
Route::get('/', 'findPharmaciesProducts@index');
Route::post('/detectPharmacy/{latitude?}/{longitude?}', 'findPharmaciesProducts@findPharmacies');
Route::post('/convertAddress', 'findPharmaciesProducts@convertAddressToLatLong');


// *************** ROLE MANAGEMENT ROUTES ***************
Route::get('/roles', function () {
    return view('welcome'); // *** change page name in future ***
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/logout','Auth\LoginController@userLogout')->name('user.logout');

//admin route for our multi-auth system

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout','Auth\AdminLoginController@logout')->name('admin.logout');

    //admin password reset routes
    Route::post('/password/email','Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset','Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset','Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}','Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});

Route::prefix('pharmacist')->group(function () {
    Route::get('/', 'PharmacistController@index')->name('pharmacist.dashboard');
    Route::get('/login', 'Auth\PharmacistLoginController@showLoginForm')->name('pharmacist.login');
    Route::post('/login', 'Auth\PharmacistLoginController@login')->name('pharmacist.login.submit');
    Route::get('/register', 'Auth\PharmacistRegisterController@create')->name('pharmacist.register');
    Route::post('/register', 'Auth\PharmacistRegisterController@store')->name('pharmacist.register.store');
    Route::get('/logout','Auth\PharmacistLoginController@logout')->name('pharmacist.logout');

    //pharmacist password reset routes
    Route::post('/password/email','Auth\PharmacistForgotPasswordController@sendResetLinkEmail')->name('pharmacist.password.email');
    Route::get('/password/reset','Auth\PharmacistForgotPasswordController@showLinkRequestForm')->name('pharmacist.password.request');
    Route::post('/password/reset','Auth\PharmacistResetPasswordController@reset');
    Route::get('/password/reset/{token}','Auth\PharmacistResetPasswordController@showResetForm')->name('pharmacist.password.reset');
    //PharamcyDetails Form
    Route::post('/savePharmacyDetails', 'PharmacistController@savePharmacyDetails');
    //Ask Query
    Route::post('/postQuery', 'posts_controller@pharmacistPostQuery');

});


// *************** VERIFICATION EMAIL ROUTES ***************
// Send verification email to user
Route::get('sendEmailToUser/{email}/{verificationToken}', 'Auth\RegisterController@sendVerifyEmail')->name('sendEmailToUser');

// Send verification email to pharmacist
Route::get('sendEmailToPharmacist/{email}/{verificationToken}', 'Auth\PharmacistRegisterController@sendVerifyEmail')->name('sendEmailToPharmacist');


// *************** PHARMACY RATING ROUTES ***************
//show Pharmacy Rating Page
Route::get('ratePharmacy', 'ratingController@index');

//update Pharmacy Rating
Route::post('ratePharmacy/{pharmacyId}', 'ratingController@ratePharmacy');
