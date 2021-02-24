<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


define('deviceId','31e0f17d72b7f0ef674fa6f1a102822de7e088613cb5ee24b67198d582a1c06d');
define('email','emad@ivas.com.eg');
define('password','b0844ea720cffe4f18e8e10e3cad0a33593c62ea8968851398d22bd75e6185a6');
define('securitycode','99498b770cd4927e39131afc1cf65cc7b3450c42f76099d78e57029a5ec52235');
define('phone','01223872695');
define('key','digizone');
define('hash_key','8Tyr4EDw!2sN');
define('secret_key','t-3zafRa');
define('secret_iv','St@cE4eZ');
define('encrypt_method','AES-256-CBC');
define('categoryId','96');
define('productId','376');
define('quantity','1');
define('langIdEn','1');
define('langIdAr','2');


Route::get('/test_check_balance','LikecartController@test_check_balance');
Route::get('/check_balance','LikecartController@check_balance');
Route::get('/categories','LikecartController@categories');
Route::get('/products','LikecartController@products');
Route::get('/products_with_optiona','LikecartController@products_with_optiona');
Route::get('/orders','LikecartController@orders');
Route::get('/orders/details','LikecartController@order_details');
Route::get('/create_order','LikecartController@create_order');

