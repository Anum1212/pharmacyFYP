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
Route::get('/', 'testController@allRoutes');

// *************** SITE NAVIGATION ROUTES ***************
Route::get('/index', 'siteViewController@index');
Route::post('/contactUs', 'messageController@contactUs');


// *************** Customer ROUTES ***************
Route::get('/contactUsForm', 'HomeController@contactUsForm');
Route::get('/editAccountDetailsForm', 'HomeController@editAccountDetailsForm');
Route::post('/editAccountDetails', 'HomeController@editAccountDetails');
//CustomerOrders
Route::get('/viewAllOrders', 'HomeController@viewAllOrders');
Route::get('/viewSpecificOrder/{orderId}', 'HomeController@viewSpecificOrder');


// *************** Product and pharmacy find ROUTES ***************
Route::post('/detectPharmacy/{latitude?}/{longitude?}', 'findPharmaciesProducts@findPharmacies');
Route::post('/convertAddress', 'findPharmaciesProducts@convertAddressToLatLong');
Route::get('/pharmacyDetails/{pharmacyId}', 'findPharmaciesProducts@pharmacyDetails');



// *************** Order Managment Routes ***************
Route::get('/addToCart/{productId}', 'cartController@addToCart');
// Remove from cart
Route:: delete('/removeFromCart/{product}', 'cartController@remove');
// View from cart
Route:: get('/viewCart', 'cartController@view');
// Update cart
Route:: post('/updateCart', 'cartController@update');
// checkout cart
Route:: get('/CheckOutCart', 'orderController@checkout');


// *************** ROLE MANAGEMENT ROUTES ***************
Route::get('/roles', function () {
    return view('welcome'); // *** change page name in future ***
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
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

    // *************** Message ROUTES ***************
// View Messages
Route::get('/viewAllMessages', 'messageController@viewAllMessages');
// View Specific Message
Route::get('/viewMessage/{messageId}', 'messageController@viewMessage');
// View All Replies to a Specific Message Sender
Route::get('/viewAllMessagesOfSpecificSender/{messageId}', 'messageController@viewAllMessagesOfSpecificSender');
// Reply to Message
Route::post('/replyMessage/{messageId}', 'messageController@replyMessage');
// Mark As Unread Message
Route::put('/markAsUnreadMessage/{messageId}', 'messageController@markAsUnreadMessage');
// Mark As Read Message
Route::put('/markAsReadMessage/{messageId}', 'messageController@markAsReadMessage');
// Delete Specific Message
Route::delete('/deleteMessage/{messageId}', 'messageController@deleteMessage');
// Search for Sender
Route::post('/searchSender', 'messageController@searchSender');
});

Route::prefix('pharmacist')->group(function () {
    //pharmacist register login logout routes
    Route::get('/dashboard', 'PharmacistController@index')->name('pharmacist.dashboard');
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
    
    //Pharamcy Edit Details Routes
    Route::get('/editAccountDetailsForm', 'PharmacistController@editAccountDetailsForm');
    Route::post('/editAccountDetails', 'PharmacistController@editAccountDetails');
    
    //Pharamcy DataStorage
    Route::post('/savePharmacyApi', 'PharmacistController@savePharmacyApi');
    Route::get('/storeProductsInTable', 'PharmacistController@storeProductsInTable');
    
    //Pharamcy DataStorage
    Route::get('/contactUsForm', 'PharmacistController@contactUsForm');

    //PharamcyProducts
    Route::get('/viewProducts', 'PharmacistProductController@viewProducts');
    Route::get('/addProduct', 'PharmacistProductController@addProductForm');
    Route::post('/addProduct', 'PharmacistProductController@addProduct');
    Route::get('/editProduct/{productId}', 'PharmacistProductController@editProductForm');
    Route::put('/editProduct/{productId}', 'PharmacistProductController@editProduct');
    Route::delete('/deleteProduct/{productId}', 'PharmacistProductController@deleteProduct');
    
    //PharmacyOrders
    Route::get('/viewAllOrders', 'PharmacistController@viewAllOrders');
    Route::get('/viewSpecificOrder/{orderId}/{customerId}', 'PharmacistController@viewSpecificOrder');
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