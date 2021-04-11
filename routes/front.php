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
  Route::post("/payment","HomeController@getPaymentPage")->name("front.payment");
  Route::get("/payment","HomeController@getPaymentPageGet")->name("front.paymentGet");
  Route::post("/create/order","HomeController@CreateOrder")->name("front.create.order");
  Route::get("/orders","HomeController@listOrders")->name("front.orders");
  Route::get("/orders/{id}","HomeController@orderDetails")->name("front.order.details");
});
