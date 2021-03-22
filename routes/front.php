<?php

/** Front Route */

Route::get("/home","HomeController@index")->name("front.home");
Route::get("/products/{category_id}","HomeController@listProducts")->name("front.products");
Route::post("/create/order","HomeController@CreateOrder")->name("front.create.order");
Route::get("/orders","HomeController@listOrders")->name("front.orders");
Route::get("/orders/{id}","HomeController@orderDetails")->name("front.order.details");
