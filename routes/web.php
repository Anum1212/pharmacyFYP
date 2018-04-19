<?php

// |---------------------------------- Test Routes (for testing purposes) ----------------------------------|
    Route::get('/test', 'testController@index');
    Route::get('/', 'testController@allRoutes');



// |---------------------------------- General Site Navigation Routes ----------------------------------|
//index --> return site home page
    Route::get('/index', 'siteViewController@index');
//contactUs --> save message to database
    Route::post('/contactUs', 'messageController@contactUs');
//detectPharmacy --> find pharmacies in the customer defined radius
    Route::post('/detectPharmacy/{latitude?}/{longitude?}', 'findPharmaciesProducts@findPharmacies');
//convertAddress --> convert customer defined location to latitude longitude
    Route::post('/convertAddress', 'findPharmaciesProducts@convertAddressToLatLong');
//pharmacyDetails --> show the details of a pharmacy
    Route::get('/pharmacyDetails/{pharmacyId}', 'findPharmaciesProducts@pharmacyDetails');
//show Pharmacy Rating Page
    Route::get('ratePharmacy', 'ratingController@index');
//update Pharmacy Rating
    Route::post('ratePharmacy/{pharmacyId}', 'ratingController@ratePharmacy');



// |---------------------------------- Cart Managment Routes ----------------------------------|
// addToCart --> add item to cart
    Route::get('/addToCart/{productId}', 'cartController@addToCart');
// removeFromCart --> remove item from cart
    Route:: delete('/removeFromCart/{product}', 'cartController@remove');
// viewCart --> view items present in the cart
    Route:: get('/viewCart', 'cartController@view');
// updateCart --> update cart item quantity
    Route:: post('/updateCart', 'cartController@update');
// CheckOutCart --> change cart item to customer order and save in database as customer order
    Route:: get('/CheckOutCart', 'orderController@checkout');



// |---------------------------------- Customer Routes ----------------------------------|
// customer register login password reset
    Auth::routes();
//dashboard --> customer dashboard
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
//logout --> customer logout
    Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');
//contactUsForm --> goto to contact us form page
    Route::get('/contactUsForm', 'HomeController@contactUsForm');
//editAccountDetailsForm --> goto edit details form page
    Route::get('/editAccountDetailsForm', 'HomeController@editAccountDetailsForm');
//editAccountDetails --> save edit details form changes
    Route::post('/editAccountDetails', 'HomeController@editAccountDetails');
//viewAllOrders --> view all orders the customer made
    Route::get('/viewAllOrders', 'HomeController@viewAllOrders');
//viewSpecificOrder --> view details of a specific order
    Route::get('/viewSpecificOrder/{orderId}', 'HomeController@viewSpecificOrder');
// sendEmailToUser --> Send registration verification email to customer
    Route::get('sendEmailToUser/{email}/{verificationToken}', 'Auth\RegisterController@sendVerifyEmail')->name('sendEmailToUser');



// |---------------------------------- Admin Routes ----------------------------------|
//admin route for our multi-auth system
    Route::prefix('admin')->group(function () {
//dashboard --> admin dashboard
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
//login --> admin login
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
//logout --> admin logut
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
//password reset --> admin password reset
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
// viewAllCustomers --> view all messages
    Route::get('/viewAllCustomers', 'AdminController@viewAllCustomers');
// viewAllPharmacies --> view all messages
    Route::get('/viewAllPharmacies', 'AdminController@viewAllPharmacies');
// viewAllMessages --> view all messages
    Route::get('/viewAllMessages', 'messageController@viewAllMessages');
// viewSpecificMessage --> view details of a specific message
    Route::get('/viewMessage/{messageId}', 'messageController@viewMessage');
// viewAllMessagesOfSpecificSender --> view all messages sent by a specific sender
    Route::get('/viewAllMessagesOfSpecificSender/{messageId}', 'messageController@viewAllMessagesOfSpecificSender');
// replyMessage --> reply to received message
    Route::post('/replyMessage/{messageId}', 'messageController@replyMessage');
// markAsUnreadMessage --> mark a message as unread
    Route::put('/markAsUnreadMessage/{messageId}', 'messageController@markAsUnreadMessage');
// markAsReadMessage --> mark a message as read
    Route::put('/markAsReadMessage/{messageId}', 'messageController@markAsReadMessage');
// deleteMessage --> delete a message
    Route::delete('/deleteMessage/{messageId}', 'messageController@deleteMessage');
// searchSender --> search for a message sender
    Route::post('/searchSender', 'messageController@searchSender');
});



// |---------------------------------- Pharmacy Routes ----------------------------------|
    Route::prefix('pharmacist')->group(function () {
//dashboard --> goto pharmacist dashboard
    Route::get('/dashboard', 'PharmacistController@index')->name('pharmacist.dashboard');
//login --> pharmacist login
    Route::get('/login', 'Auth\PharmacistLoginController@showLoginForm')->name('pharmacist.login');
    Route::post('/login', 'Auth\PharmacistLoginController@login')->name('pharmacist.login.submit');
//register --> pharmacist register
    Route::get('/register', 'Auth\PharmacistRegisterController@create')->name('pharmacist.register');
    Route::post('/register', 'Auth\PharmacistRegisterController@store')->name('pharmacist.register.store');
//logout --> pharmacist logout
    Route::get('/logout', 'Auth\PharmacistLoginController@logout')->name('pharmacist.logout');
//password reset  --> pharmacist password reset
    Route::post('/password/email', 'Auth\PharmacistForgotPasswordController@sendResetLinkEmail')->name('pharmacist.password.email');
    Route::get('/password/reset', 'Auth\PharmacistForgotPasswordController@showLinkRequestForm')->name('pharmacist.password.request');
    Route::post('/password/reset', 'Auth\PharmacistResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\PharmacistResetPasswordController@showResetForm')->name('pharmacist.password.reset');
//editAccountDetailsForm --> goto pharmacist edit details form
    Route::get('/editAccountDetailsForm', 'PharmacistController@editAccountDetailsForm');
//editAccountDetails --> save pharmacist edit form changes
    Route::post('/editAccountDetails', 'PharmacistController@editAccountDetails');
//savePharmacyApi(trash arham will make new one)
// Route::post('/savePharmacyApi', 'PharmacistController@savePharmacyApi');
//storeProductsInTable --> pharamacist decides to use website database to store products
    Route::get('/storeProductsInTable', 'PharmacistController@storeProductsInTable');
//contactUsForm --> goto contact admin form
    Route::get('/contactUsForm', 'PharmacistController@contactUsForm');
//viewProducts --> view products the pharamacist has uploaded to website
    Route::get('/viewProducts', 'PharmacistProductController@viewProducts');
//addProductForm --> goto add products form page
    Route::get('/addProduct', 'PharmacistProductController@addProductForm');
//addProduct --> add products to website database
    Route::post('/addProduct', 'PharmacistProductController@addProduct');
//editProductForm --> goto edit products form page
    Route::get('/editProduct/{productId}', 'PharmacistProductController@editProductForm');
//editProduct --> save changes made to a product
    Route::put('/editProduct/{productId}', 'PharmacistProductController@editProduct');
//deleteProduct --> delete a product
    Route::delete('/deleteProduct/{productId}', 'PharmacistProductController@deleteProduct');
//viewAllOrders --> view all orders the pharmamcy has received
    Route::get('/viewAllOrders', 'PharmacistController@viewAllOrders');
//viewSpecificOrder --> view details of a specific order
    Route::get('/viewSpecificOrder/{orderId}/{customerId}', 'PharmacistController@viewSpecificOrder');
    });
// sendEmailToPharmacist --> Send registration verification email to pharmacist
    Route::get('sendEmailToPharmacist/{email}/{verificationToken}', 'Auth\PharmacistRegisterController@sendVerifyEmail')->name('sendEmailToPharmacist');


















// *************** ROLE MANAGEMENT ROUTES(trash) ***************
// Route::get('/roles', function () {
//     return view('welcome'); // *** change page name in future ***
// });
