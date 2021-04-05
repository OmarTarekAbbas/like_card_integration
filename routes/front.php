<?php

/** Front Route */

Route::get("/home","HomeController@index")->name("front.home");
Route::get("/category/{parent_id}","HomeController@listCategoryChilds")->name("front.category");
Route::get("/products/{category_id}","HomeController@listProducts")->name("front.products");
Route::post("/payment","HomeController@getPaymentPage")->name("front.payment");
Route::get("/payment","HomeController@getPaymentPageGet")->name("front.paymentGet");
Route::post("/create/order","HomeController@CreateOrder")->name("front.create.order");
Route::get("/orders","HomeController@listOrders")->name("front.orders");
Route::get("/orders/{id}","HomeController@orderDetails")->name("front.order.details");
Route::get("/search","HomeController@search")->name("front.search");
