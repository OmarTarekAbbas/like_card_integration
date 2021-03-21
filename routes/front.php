<?php

/** Front Route */

Route::get("/home","HomeController@index")->name("front.home");
Route::get("/products/{category_id}","HomeController@listProducts")->name("front.products");
