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
Route::get('home', 'HomeController@show')->name('home');

Route::get('3d-demo', 'WebGLController@demo')->name('3d_demo');

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

Route::resource('admin/collection-rounds', 'CollectionRoundsController');
Route::post('admin/collection-rounds/start', 'CollectionRoundsController@startRound')->name('collection_rounds.start_round');
Route::post('admin/collection-rounds/close', 'CollectionRoundsController@closeRound')->name('collection_rounds.close_round');

Route::get('admin/collection-rounds/{id}/bundles', 'CollectionRoundBundlesController@bundlesList')->where('id', '[0-9]+')->name('collection-rounds.bundles');
Route::get('admin/collection-rounds/{id}/journey', 'CollectionRoundAddressesController@addressesList')->where('id', '[0-9]+')->name('collection-rounds.addresses');

//Route::resource('delivery_rounds', 'DeliveryRoundsController');
// Routes tests pour les delivery_rounds
Route::get('delivery-rounds/new', 'DeliveryRoundsController@store');
Route::get('delivery-rounds/{id}', 'DeliveryRoundsController@show')->where('id', '[0-9]+');

Route::get('profile', 'ProfilesController@getProfile');

Route::get('admin/bundles', 'BundlesController@index');
Route::get('admin/bundles/{id}/products/', 'BundleProductsController@productsList')->where('id', '[0-9]+')->name('bundles.products');
