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


Route::get('/', 'HomeController@show');
Route::get('home', 'HomeController@show')->name('home');

Route::get('3d-demo', 'WebGLController@demo')->name('3d_demo');

Route::get('/register', 'Auth\RegisterController@showRegistrationDispatcher')->name('register');
Route::name('register.')->group(function () {
    Route::get('donor', 'Auth\RegisterController@createDonor')->name('donor.create');
    Route::post('donor', 'Auth\RegisterController@storeDonor')->name('donor.store');
    Route::get('needyperson', 'Auth\RegisterController@createNeedyPerson')->name('needyperson.create');
    Route::post('needyperson', 'Auth\RegisterController@storeNeedyPerson')->name('needyperson.store');
    Route::get('storekeeper', 'Auth\RegisterController@createStorekeeper')->name('storekeeper.create');
    Route::post('storekeeper', 'Auth\RegisterController@storeStorekeeper')->name('storekeeper.store');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('profile', 'ProfilesController@getProfile')->name('profile');

Route::name('admin.')->group(function () {
    Route::get('bundles', 'Admin\BundleController@index')->name('bundles.index');
    Route::post('bundles/approve', 'Admin\BundleController@approve')->name('bundles.approve');
    Route::post('bundles/reject', 'Admin\BundleController@reject')->name('bundles.reject');
    Route::get('bundles/{id}', 'Admin\BundleController@show')->where('id', '[0-9]+')->name('bundles.show');
    Route::post('bundles/product/reject', 'Admin\BundleController@rejectProduct')->name('bundles.product.reject');
});

//Route::resource('admin/collection-rounds', 'CollectionRoundsController');
//Route::post('admin/collection-rounds/start', 'CollectionRoundsController@startRound')->name('collection_rounds.start_round');
//Route::post('admin/collection-rounds/close', 'CollectionRoundsController@closeRound')->name('collection_rounds.close_round');
//
//Route::get('admin/collection-rounds/{id}/bundles', 'CollectionRoundBundlesController@bundlesList')->where('id', '[0-9]+')->name('collection-rounds.bundles');
//Route::get('admin/collection-rounds/{id}/journey', 'CollectionRoundAddressesController@addressesList')->where('id', '[0-9]+')->name('collection-rounds.addresses');
//
////Route::resource('delivery_rounds', 'DeliveryRoundsController');
//// Routes tests pour les delivery_rounds
//Route::get('delivery-rounds/new', 'DeliveryRoundsController@store');
//Route::get('delivery-rounds/{id}', 'DeliveryRoundsController@show')->where('id', '[0-9]+');
