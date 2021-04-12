<?php

/** Front Route */

Route::get("/home","HomeController@index")->name("front.home");
Route::get("/category/{parent_id}","HomeController@listCategoryChilds")->name("front.category");
Route::get("/products/{category_id}","HomeController@listProducts")->name("front.products");
Route::get("/search","HomeController@search")->name("front.search");

Route::get('/register', 'Auth\ClientRegisterController@showLoginForm')->name('client.register');
Route::post('/register', 'Auth\ClientRegisterController@register')->name('client.register.submit');
Route::get('/login', 'Auth\ClientLoginController@showLoginForm')->name('client.login');
Route::post('/login', 'Auth\ClientLoginController@login')->name('client.login.submit');
Route::post('/logout', 'Auth\ClientLoginController@logout')->name('client.logout');

Route::group(['middleware' => 'auth:client'], function () {
  Route::get("/profile","ClientController@getProfilePage")->name("client.profile");
  Route::post("/profile","ClientController@updateProfile")->name("client.profile.submit");
  Route::post("/update_passwrod","ClientController@UpdatePassword")->name("client.password.submit");
  Route::post("/payment","OrderController@getPaymentPage")->name("front.payment");
  Route::get("/payment","OrderController@getPaymentPageGet")->name("front.paymentGet");
  Route::post("/create/order","OrderController@CreateOrder")->name("front.create.order");
  Route::get("/orders","OrderController@listOrders")->name("front.orders");
  Route::get("/orders/{id}","OrderController@orderDetails")->name("front.order.details");
});

Route::get("/cart","HomeController@cart")->name("front.cart");
