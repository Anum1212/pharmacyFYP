<?php



// |---------------------------------- Test Routes (for testing purposes) ----------------------------------|
Route::get('/test', 'testController@index');
Route::get('/p', 'testController@allRoutes');
Route::get('/search', function (/*Geocoder $geocoder*/ ) {
    return view('search');
});
Route::get('/fetchMedicineName', 'findPharmaciesProducts@fetchMedicineName');
Route::post('searchAskMed', 'findPharmaciesProducts@searchAskMed');

    // moved to site navigation heading
    // Route::get('/chatView','testController@chat');
    // Route::get('getMessages','testController@getMessages');
    // Route::get('storeChatData','testController@storeChatData');

Route::get('storeSearhData', 'testController@storeSearhData');
Route::get('displayMostSearchMedicines', 'testController@displayMostSearchMedicines');
Route::get('medicneDetails', 'arhamController@medicneDetails');
Route::get('getMedicineInformations', 'arhamController@getMedicineInformations');



    // |---------------------------------- Cron Routes ----------------------------------|
    // changeStatus -> change order rating Status to 1 if diff b/w created_at and now > 12 hours
Route::get('/changeStatus', 'cronController@changeStatus');



    // |---------------------------------- General Site Navigation Routes ----------------------------------|
    //index --> return site home page
Route::get('/', 'siteViewController@index');
    //contactUs --> save message to database
Route::post('/contactUs', 'messageController@contactUs');
    //searchMedicine --> find pharmacies and medicines in the customer defined radius
Route::get('/searchMedicine', 'findPharmaciesProducts@searchMedicine');
    // Search Medicine By Category 
Route::get('searchMedicineByCategory/{categoryId}', 'findPharmaciesProducts@searchMedicineByCategory');
    //pharmacyDetails --> show the details of a pharmacy
Route::get('/pharmacyDetails/{pharmacyId}/{productId?}', 'findPharmaciesProducts@pharmacyDetails');
    //update Pharmacy Rating
Route::post('/ratePharmacy', 'HomeController@ratePharmacy');
    //mark Pharmacy Rating as later
Route::post('/ratePharmacyLater', 'HomeController@ratePharmacyLater');
    //update Pharmacy Rating
Route::get('/downloads', 'siteViewController@downloads');
    // Show Medicine Details
Route::get('medicineDetails/{medicineId}/{pharmacyId}', 'findPharmaciesProducts@medicineDetails');
    //contactUsFormGeneral --> goto to contact us form page
Route::get('/contactUsFormGeneral', 'siteViewController@contactUsFormGeneral');
    //aboutUs --> goto to contact us form page
Route::get('/aboutUs', 'siteViewController@aboutUs');



    // |---------------------------------- Cart Managment Routes ----------------------------------|
    // addToCart --> add item to cart
Route::get('/addToCart/{productId}/{pharmacistId}', 'cartController@addToCart');
    // removeFromCart --> remove item from cart
Route::get('/removeFromCart/{product}', 'cartController@remove');
    // viewCart --> view items present in the cart
Route::get('/viewCart', 'cartController@view');
// updateCart --> update cart item quantity
Route::post('/updateCart', 'cartController@update');
// prescriptionUploadForm --> test if cart contains a medicine that needs prescription. if YES go to prescriptionUploadForm if NO call CheckOutCart method
Route::post('/prescriptionUploadForm', 'orderController@prescriptionUploadForm');
// prescriptionUpload --> save prescriptionUploadForm
Route::post('/prescriptionUpload/{deliveryDate}', 'orderController@prescriptionUpload');
// CheckOutCart --> change cart item to customer order and save in database as customer order
Route::get('/checkOutCart/{deliveryDate}', 'orderController@checkout');



// |---------------------------------- Customer Routes ----------------------------------|
// customer register login password reset
Auth::routes();
// resendVerificationEmail
Route::get('/resendVerificationEmail/{id}', 'HomeController@resendVerificationEmail');
//dashboard --> customer dashboard
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
//logout --> customer logout
Route::post('user/logout', 'Auth\LoginController@userlogout')->name('user.logout');
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
// verifyCustomerRegistration --> verify Customer Registration
Route::get('verifyCustomerRegistration/{email}/{verificationToken}', 'Auth\RegisterController@verifyCustomerRegistration')->name('verifyCustomerRegistration');
// verifyCustomerRegistration --> verify Customer Registration
Route::get('setAvailabilityNotification', 'HomeController@setAvailabilityNotification');



// |---------------------------------- Admin Routes ----------------------------------|
//admin route for our multi-auth system
Route::prefix('admin')->group(function () {
        //dashboard --> admin dashboard
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
        //login --> admin login
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
        //logout --> admin logut
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
        //password reset --> admin password reset
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
        // viewAllOrders --> view all orders
    Route::get('/viewAllOrders', 'AdminController@viewAllOrders');
        // viewSpecificOrder --> view specific order
    Route::get('/viewSpecificOrder/{orderId}', 'AdminController@viewSpecificOrder');
        //viewPharmacySpecificOrder --> view details of a specific order
    Route::get('/viewPharmacySpecificOrder/{orderId}/{customerId}/{pharmacyId}', 'AdminController@viewPharmacySpecificOrder');
        // searchOrder --> search for a order
    Route::get('/searchOrder', 'AdminController@searchOrder');
        // viewAllCustomers --> view all customers
    Route::get('/viewAllCustomers', 'AdminController@viewAllCustomers');
        // viewSpecificCustomer --> view specific customer details
    Route::get('/viewSpecificCustomer/{customerId}', 'AdminController@viewSpecificCustomer');
        // searchCustomer --> search for a customer [build if needed]
        // Route::get('/searchCustomer', 'AdminController@searchCustomer');
        // blockCustomer --> block a Customer
    Route::get('/blockCustomer/{customerId}', 'AdminController@blockCustomer');
        // unblockCustomer --> unblock a Customer
    Route::get('/unBlockCustomer/{customerId}', 'AdminController@unBlockCustomer');
        // viewAllPharmacies --> view all pharmacies
    Route::get('/viewAllPharmacies', 'AdminController@viewAllPharmacies');
        // pharmacyDetails --> view specific pharmacy details
    Route::get('/pharmacyDetails/{pharmacyId}', 'AdminController@pharmacyDetails');
        // searchPharmacy --> search for a Pharmacy [build if needed]
        // Route::get('/searchPharmacy', 'AdminController@searchPharmacy');
        // blockPharmacy --> block a pharmacy
    Route::get('/blockPharmacy/{pharmacyId}', 'AdminController@blockPharmacy');
        // unblockPharmacy --> unblock a pharmacy
    Route::get('/unBlockPharmacy/{pharmacyId}', 'AdminController@unBlockPharmacy');
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
    Route::get('/searchSender', 'messageController@searchSender');
        // viewAllFiles --> view all files
    Route::get('/viewAllFiles', 'AdminController@viewAllFiles');
        // uploadFileForm --> go to upload file form
    Route::get('/uploadFileForm', 'AdminController@uploadFileForm');
        // uploadFile --> save uploaded file
    Route::post('/uploadFile', 'AdminController@uploadFile');
        // editFileForm --> go to edit file form
    Route::get('/editFileForm/{fileId}', 'AdminController@editFileForm');
        // editFile --> save file edit changes
    Route::post('/editFile/{fileId}', 'AdminController@editFile');
        // enableFile --> enable file download
    Route::put('/enableFile/{fileId}', 'AdminController@enableFile');
        // disableFile --> disable file download
    Route::put('/disableFile/{fileId}', 'AdminController@disableFile');
        // deleteFile --> delete uploaded file
    Route::delete('/deleteFile/{fileId}', 'AdminController@deleteFile');
        // searchFile --> search for uploaded file
    Route::get('/searchFile', 'AdminController@searchFile');
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
        // resendVerificationEmail
    Route::get('/resendVerificationEmail/{id}', 'PharmacistController@resendVerificationEmail');
        //logout --> pharmacist logout
    Route::post('/logout', 'Auth\PharmacistLoginController@logout')->name('pharmacist.logout');
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
    Route::post('/savePharmacyApi', 'PharmacistController@savePharmacyApi');
        //storeProductsInTable --> pharamacist decides to use website database to store products
    Route::get('/storeProductsInTable', 'PharmacistController@storeProductsInTable');
        //localhost --> pharamacist decides to use their own system storage
    Route::get('/localhost', 'PharmacistController@localhost');
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
    Route::get('/viewSpecificOrder/{orderId}/{customerId}/{pharmacyId}', 'PharmacistController@viewSpecificOrder');
        //changeOrderStatus --> change order status
    Route::get('/changeOrderStatus/{orderId}/{status}', 'PharmacistController@changeOrderStatus');
        // sendEmailToPharmacist --> Send registration verification email to pharmacist
    Route::get('/verifyPharmacistRegistration/{email}/{verificationToken}', 'Auth\PharmacistRegisterController@verifyPharmacistRegistration')->name('verifyPharmacistRegistration');
});









// *************** ROLE MANAGEMENT ROUTES(trash) ***************
// Route::get('/roles', function () {
//     return view('welcomeTrash'); // *** change page name in future ***
// });
