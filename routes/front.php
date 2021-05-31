<?php

/** Front Route */
define("Tutorcomp_User_Name", "tutor_comp");
define("Tutorcomp_Password", "tutor_2021_5466");
define("User", "info@liveacademy.com");
define("Password", "L!ve0cademy");
define("ServiceID", "808");
define("ChannelID", "12211");
define("ProfileID", "1833");
define("ShortCode", "50230");

define('enable_dcb', false);
define('enable_delete', false);
define('balance_limit', 40);
define('admin_mail', "mohammed_hs55@yahoo.com");

Route::get("/home","HomeController@index")->name("front.home");
Route::get("/categorys/{parent_id}","HomeController@listCategoryChilds")->name("front.category");
Route::get("/products/{category_id}","HomeController@listProducts")->name("front.products");
Route::get("/search","HomeController@search")->name("front.search");

Route::get('client/register', 'Auth\ClientRegisterController@showLoginForm')->name('client.register');
Route::post('client/register', 'Auth\ClientRegisterController@register')->name('client.register.submit');
Route::get('client/login', 'Auth\ClientLoginController@showLoginForm')->name('client.login');
Route::post('client/login', 'Auth\ClientLoginController@login')->name('client.login.submit');
Route::post('client/logout', 'Auth\ClientLoginController@logout')->name('client.logout');
//payment page
Route::post("/payment","OrderController@getPaymentPage")->name("front.payment");
Route::get("/payment","OrderController@getPaymentPageGet")->name("front.paymentGet");
//dcb route
Route::post("/pincode/request","OrderController@pincodeRequest")->name("front.pincode.request");
Route::get("/pincode/verify","OrderController@pincodeVerifyPage")->name("front.pincode.verify");
Route::post("/pincode/verify","OrderController@pincodeVerify")->name("front.pincode.verify.submit");
//route myfatoorah
Route::post('myfatoorah/readirect', "FatoorahController@redirectToPaymentPage")->name("front.myfatoorah.redirect.payment");
Route::get('myfatoorah/callback', "FatoorahController@handleCallback")->name("front.myfatoorah.handle.callback");
//auth route
Route::group(['middleware' => 'auth:client'], function () {
  Route::get("/profile","ClientController@getProfilePage")->name("client.profile");
  Route::post("/profile","ClientController@updateProfile")->name("client.profile.submit");
  Route::post("/update_passwrod","ClientController@UpdatePassword")->name("client.password.submit");
  Route::get("/orders","OrderController@listOrders")->name("front.orders");
  Route::get("/orders/{id}","OrderController@orderDetails")->name("front.order.details");
});

Route::get("/cart","HomeController@cart")->name("front.cart");
Route::get("/pincode","HomeController@pincode")->name("front.pincode");
Route::get('test_fattora',"FattoraOrderController@initFattoraPaymentLink");
