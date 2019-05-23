<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/welcome', 'welcome');

Route::get('/', 'HomeController@show');
Route::get('home', 'HomeController@show');

Route::get('register', 'Auth\RegisterController@showRegistrationDispatcher')->name('register');
Route::get('register/donor', 'Auth\RegisterController@showRegistrationForm')->defaults('userType', 'donor');
Route::get('register/storekeeper', 'Auth\RegisterController@showRegistrationForm')->defaults('userType', 'storekeeper');
Route::get('register/needy_person', 'Auth\RegisterController@showRegistrationForm')->defaults('userType', 'needy_person');
Route::post('register/donor', 'Auth\RegisterController@storeDonor');
Route::post('register/storekeeper', 'Auth\RegisterController@storeStorekeeper');
Route::post('register/needy_person', 'Auth\RegisterController@StoreNeedyPerson');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

//Route::resource('delivery_rounds', 'DeliveryRoundsController');
// Routes tests pour les delivery_rounds
Route::get('delivery-rounds/new', 'DeliveryRoundsController@store');
Route::get('delivery-rounds/{id}', 'DeliveryRoundsController@show')->where('id', '[0-9]+');
