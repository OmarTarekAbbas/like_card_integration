<?php

/** Front Route */

Route::get("/home","HomeController@index")->name("front.home");
Route::get("/products","HomeController@listProducts")->name("front.product");
