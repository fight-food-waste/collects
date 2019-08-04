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

Route::get('bundles', 'BundleController@index')->name('bundle.index');
Route::get('bundles/{id}', 'BundleController@show')->where('id', '[0-9]+')->name('bundle.show');
Route::post('bundles/destroy', 'BundleController@destroy')->name('bundle.destroy');

Route::get('delivery-requests', 'DeliveryRequestController@index')->name('delivery_requests.index');
Route::get('delivery-requests/{id}', 'DeliveryRequestController@show')->where('id', '[0-9]+')
    ->name('delivery_requests.show');
Route::post('delivery-requests', 'DeliveryRequestController@store')->name('delivery_requests.store');
Route::delete('delivery-requests', 'DeliveryRequestController@destroy')->name('delivery_requests.destroy');

Route::post('products', 'ProductController@destroy')->name('product.destroy');

Route::prefix('admin')->group(function () {
    Route::get('/', 'Admin\AdminController@index')->name('admin.index');

    Route::get('bundles', 'Admin\BundleController@index')->name('admin.bundles.index');
    Route::post('bundles/approve', 'Admin\BundleController@approve')->name('admin.bundles.approve');
    Route::post('bundles/reject', 'Admin\BundleController@reject')->name('admin.bundles.reject');
    Route::get('bundles/{id}', 'Admin\BundleController@show')
        ->where('id', '[0-9]+')->name('admin.bundles.show');
    Route::post('bundles/product/reject', 'Admin\BundleController@rejectProduct')->name('admin.bundles.product.reject');

    Route::get('collection-rounds', 'Admin\CollectionRoundController@index')->name('admin.collection_rounds.index');
    Route::post('collection-rounds', 'Admin\CollectionRoundController@store')->name('admin.collection_rounds.store');
    Route::get('collection-rounds/{id}', 'Admin\CollectionRoundController@show')
        ->where('id', '[0-9]+')->name('admin.collection_rounds.show');
    Route::get('collection-rounds/{id}/export', 'Admin\CollectionRoundController@export')
        ->where('id', '[0-9]+')->name('admin.collection_rounds.export');
    Route::post('collection-rounds/bundles/remove', 'Admin\CollectionRoundController@removeBundle')
        ->name('admin.collection_rounds.bundles.remove');
    Route::post('collection-rounds/bundles/delete', 'Admin\CollectionRoundController@destroy')->name('admin.collection_rounds.destroy');
    Route::get('collection-rounds/{id}/add', 'Admin\CollectionRoundController@addBundles')
        ->where('id', '[0-9]+')->name('admin.collection_rounds.add_bundles');
    Route::post('collection-rounds/bundles/add', 'Admin\CollectionRoundController@addBundle')
        ->name('admin.collection_rounds.add_bundle');
    Route::post('collection-rounds/{id}/auto-add', 'Admin\CollectionRoundController@autoAddBundles')
        ->where('id', '[0-9]+')->name('admin.collection_rounds.auto_add_bundles');
    Route::put('collection-rounds/{id}', 'Admin\CollectionRoundController@update')
        ->where('id', '[0-9]+')->name('admin.collection_rounds.update');

    Route::get('products', 'Admin\ProductsController@index')->name('admin.products.index');

    Route::get('categories', 'Admin\CategoryController@index')->name('admin.categories.index');

    Route::get('trucks', 'Admin\TruckController@index')->name('admin.trucks.index');

    Route::get('warehouses', 'Admin\WarehouseController@index')->name('admin.warehouses.index');

    Route::get('users', 'Admin\UserController@index')->name('admin.users.index');
    Route::get('users/application_files/{id}.pdf', 'Admin\UserController@downloadApplication')
        ->where('id', '^[a-zA-Z0-9_]*$')->name('admin.users.application_files.download');
    Route::post('users/approve', 'Admin\UserController@approve')->name('admin.users.approve');
    Route::post('users/reject', 'Admin\UserController@reject')->name('admin.users.reject');
});
