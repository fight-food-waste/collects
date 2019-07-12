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

Route::get('/', function () {
    return response()->json(["message" => "Welcome to FFW API"], 200);
});

Route::get('products', 'Api\ProductController@index');
Route::get('products/{id}', 'Api\ProductController@show');
Route::post('products', 'Api\ProductController@store');
Route::get('products/stock', 'Api\ProductController@showFromStock');

Route::post('/bundle', 'Api\BundleController@open');
Route::get('/bundle/{id}', 'Api\BundleController@show');
Route::post('/bundle/close', 'Api\BundleController@close');

// Route::get('/user', 'Api\UserController@show');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
