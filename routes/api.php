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

Route::post('login', 'Api\CustomerController@login');
Route::post('register', 'Api\CustomerController@register');
Route::get('/unauthorized', 'Api\CustomerController@unauthorized');
Route::get('shops-by-time', 'Api\ShopController@getShopsSubDays');
Route::group(['middleware' => ['CheckClientCredentials','auth:api-customers']], function() {
    Route::post('logout', 'Api\CustomerController@logout');
    Route::post('details', 'Api\CustomerController@details');
    Route::post('refresh', 'Api\CustomerController@refreshToken');
    Route::post('phone', 'Api\CustomerController@phoneNumber');
    Route::post('user/shops', 'Api\ShopController@index');
    Route::post('user/shops_categories', 'Api\ShopCategoryController@index');
    Route::post('user/products', 'Api\ProductController@index');
    Route::post('user/products_categories', 'Api\ProductCategoryController@index');

    Route::post('order', 'OrderController@store');
});
