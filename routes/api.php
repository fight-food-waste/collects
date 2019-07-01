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

Route::get('/', function () {
    return response()->json(["message" => "Welcome to FFW API"], 200);
});

Route::get('products', 'Api\ProductController@index');
Route::get('products/{article}', 'Api\ProductController@show');
Route::post('products', 'Api\ProductController@store');
Route::put('products/{article}', 'Api\ProductController@update');
Route::delete('products/{article}', 'Api\ProductController@delete');