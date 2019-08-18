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


Route::get('/', 'HomeController@show')->name('home');

Route::get('lang/{locale}', 'LocalizationController@setLocale')->name('lang.switch');

Route::get('webgl', function () {
    return view('webgl');
});

Route::prefix('register')->group(function () {
    Route::get('/', 'Auth\RegisterController@showRegistrationDispatcher')->name('register');
    Route::get('donor', 'Auth\RegisterController@createUser')->defaults('slug', 'donor')->name('register.donor.create');
    Route::post('donor', 'Auth\RegisterController@storeUser')->defaults('slug', 'donor')->name('register.donor.store');
    Route::get('needyperson', 'Auth\RegisterController@createUser')->defaults('slug', 'needyperson')->name('register.needyperson.create');
    Route::post('needyperson', 'Auth\RegisterController@storeUser')->defaults('slug', 'needyperson')->name('register.needyperson.store');
    Route::get('storekeeper', 'Auth\RegisterController@createUser')->defaults('slug', 'storekeeper')->name('register.storekeeper.create');
    Route::post('storekeeper', 'Auth\RegisterController@storeUser')->defaults('slug', 'storekeeper')->name('register.storekeeper.store');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('account', 'AccountController@index')->name('account.index');
Route::get('account/edit', 'AccountController@edit')->name('account.edit');
Route::delete('account', 'AccountController@destroy')->name('account.destroy');
Route::put('account', 'AccountController@update')->name('account.update');

Route::get('bundles', 'BundleController@index')->name('bundle.index');
Route::get('bundles/{id}', 'BundleController@show')->where('id', '[0-9]+')->name('bundle.show');
Route::post('bundles/destroy', 'BundleController@destroy')->name('bundle.destroy');

Route::get('delivery-requests', 'DeliveryRequestController@index')->name('delivery_requests.index');
Route::get('delivery-requests/{id}', 'DeliveryRequestController@show')->where('id', '[0-9]+')->name('delivery_requests.show');
Route::post('delivery-requests', 'DeliveryRequestController@store')->name('delivery_requests.store');
Route::delete('delivery-requests', 'DeliveryRequestController@destroy')->name('delivery_requests.destroy');

Route::get('products', 'ProductController@index')->name('products.index');
Route::post('products', 'ProductController@destroy')->name('products.destroy');
Route::post('products/delivery-request/add', 'ProductController@addToDeliveryRequest')->name('products.delivery_request.add');
Route::post('products/delivery-request/remove', 'ProductController@removeFromDeliveryRequest')->name('products.delivery_request.remove');

Route::prefix('admin')->group(function () {
    Route::get('/', 'Admin\AdminController@index')->name('admin.index');

    Route::get('bundles', 'Admin\BundleController@index')->name('admin.bundles.index');
    Route::post('bundles/approve', 'Admin\BundleController@approve')->name('admin.bundles.approve');
    Route::post('bundles/reject', 'Admin\BundleController@reject')->name('admin.bundles.reject');
    Route::get('bundles/{id}', 'Admin\BundleController@show')->where('id', '[0-9]+')->name('admin.bundles.show');
    Route::post('bundles/product/reject', 'Admin\BundleController@rejectProduct')->name('admin.bundles.product.reject');

    Route::get('collection-rounds', 'Admin\CollectionRoundController@index')->name('admin.collection_rounds.index');
    Route::post('collection-rounds', 'Admin\CollectionRoundController@store')->name('admin.collection_rounds.store');
    Route::delete('collection-rounds', 'Admin\CollectionRoundController@destroy')->name('admin.collection_rounds.destroy');
    Route::get('collection-rounds/{id}', 'Admin\CollectionRoundController@show')->where('id', '[0-9]+')->name('admin.collection_rounds.show');
    Route::get('collection-rounds/{id}/export', 'Admin\CollectionRoundController@export')->where('id', '[0-9]+')->name('admin.collection_rounds.export');
    Route::post('collection-rounds/bundles/remove', 'Admin\CollectionRoundController@removeBundle')->name('admin.collection_rounds.bundles.remove');
    Route::get('collection-rounds/{id}/add', 'Admin\CollectionRoundController@addBundles')->where('id', '[0-9]+')->name('admin.collection_rounds.add_bundles');
    Route::post('collection-rounds/bundles/add', 'Admin\CollectionRoundController@addBundle')->name('admin.collection_rounds.add_bundle');
    Route::post('collection-rounds/{id}/auto-add', 'Admin\CollectionRoundController@autoAddBundles')->where('id', '[0-9]+')->name('admin.collection_rounds.auto_add_bundles');
    Route::put('collection-rounds/{id}', 'Admin\CollectionRoundController@update')->where('id', '[0-9]+')->name('admin.collection_rounds.update');

    Route::get('delivery-requests', 'Admin\DeliveryRequestController@index')->name('admin.delivery_requests.index');
    Route::post('delivery-requests/approve', 'Admin\DeliveryRequestController@approve')->name('admin.delivery_requests.approve');
    Route::post('delivery-requests/reject', 'Admin\DeliveryRequestController@reject')->name('admin.delivery_requests.reject');
    Route::get('delivery-requests/{id}', 'Admin\DeliveryRequestController@show')->where('id', '[0-9]+')->name('admin.delivery_requests.show');
    Route::post('delivery-requests/product/reject', 'Admin\DeliveryRequestController@rejectProduct')->name('admin.delivery_requests.product.reject');

    Route::get('delivery-rounds', 'Admin\DeliveryRoundController@index')->name('admin.delivery_rounds.index');
    Route::post('delivery-rounds', 'Admin\DeliveryRoundController@store')->name('admin.delivery_rounds.store');
    Route::get('delivery-rounds/{id}', 'Admin\DeliveryRoundController@show')->where('id', '[0-9]+')->name('admin.delivery_rounds.show');
    Route::get('delivery-rounds/{id}/export', 'Admin\DeliveryRoundController@export')->where('id', '[0-9]+')->name('admin.delivery_rounds.export');
    Route::post('delivery-rounds/delivery-request/remove', 'Admin\DeliveryRoundController@removeDeliveryRequest')->name('admin.delivery_rounds.delivery_round.remove');
    Route::delete('delivery-rounds', 'Admin\DeliveryRoundController@destroy')->name('admin.delivery_rounds.destroy');
    Route::get('delivery-rounds/{id}/add', 'Admin\DeliveryRoundController@addDeliveryRequests')->where('id', '[0-9]+')->name('admin.delivery_rounds.add_delivery_requests');
    Route::post('delivery-rounds/delivery-request/add', 'Admin\DeliveryRoundController@addDeliveryRequest')->name('admin.delivery_rounds.add_delivery_request');
    Route::post('delivery-rounds/{id}/auto-add', 'Admin\DeliveryRoundController@autoAddDeliveryRequests')->where('id', '[0-9]+')->name('admin.delivery_rounds.auto_add_delivery_requests');
    Route::put('delivery-rounds/{id}', 'Admin\DeliveryRoundController@update')->where('id', '[0-9]+')->name('admin.delivery_rounds.update');

    Route::get('products', 'Admin\ProductController@index')->name('admin.products.index');
    Route::post('products/{product}/reject', 'Admin\ProductController@reject')->where('product', '[0-9]+')->name('admin.products.reject');

    Route::get('categories', 'Admin\CategoryController@index')->name('admin.categories.index');
    Route::get('categories/{category}/edit', 'Admin\CategoryController@edit')->where('category', '[0-9]+')->name('admin.categories.edit');
    Route::patch('categories/{category}', 'Admin\CategoryController@update')->where('category', '^[0-9]+')->name('admin.categories.update');

    Route::get('trucks', 'Admin\TruckController@index')->name('admin.trucks.index');
    Route::get('trucks/create', 'Admin\TruckController@create')->name('admin.trucks.create');
    Route::post('trucks', 'Admin\TruckController@store')->name('admin.trucks.store');
    Route::get('trucks/{id}/edit', 'Admin\TruckController@edit')->where('id', '[0-9]+')->name('admin.trucks.edit');
    Route::put('trucks/{id}/update', 'Admin\TruckController@update')->where('id', '[0-9]+')->name('admin.trucks.update');
    Route::delete('trucks', 'Admin\TruckController@destroy', )->name('admin.trucks.destroy');

    Route::get('warehouses', 'Admin\WarehouseController@index')->name('admin.warehouses.index');
    Route::get('warehouses/create', 'Admin\WarehouseController@create')->name('admin.warehouses.create');
    Route::post('warehouses', 'Admin\WarehouseController@store')->name('admin.warehouses.store');
    Route::get('warehouses/{id}/edit', 'Admin\WarehouseController@edit')->where('id', '[0-9]+')->name('admin.warehouses.edit');
    Route::put('warehouses/{id}/update', 'Admin\WarehouseController@update')->where('id', '[0-9]+')->name('admin.warehouses.update');

    Route::get('users', 'Admin\UserController@index')->name('admin.users.index');
    Route::get('users/application_files/{id}.pdf', 'Admin\UserController@downloadApplication')->where('id', '^[a-zA-Z0-9_]*$')->name('admin.users.application_files.download');
    Route::post('users/approve', 'Admin\UserController@approve')->name('admin.users.approve');
    Route::post('users/reject', 'Admin\UserController@reject')->name('admin.users.reject');
});
