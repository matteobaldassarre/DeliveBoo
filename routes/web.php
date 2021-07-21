<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

// VueJS Restaurants Rest API (HOME)
Route::get('/', 'HomeController@index')->name('customer.home');

// Public Restaurant Menu Page
Route::get('/restaurant/{slug}', 'UserInfoController@show')->name('restaurant.menu');

// Restaurant Info Routes
Route::get('/admin-info/create', 'Admin\UserInfoController@create')->middleware('auth')->name('admin-info.create');

Route::post('/admin-info/store', 'Admin\UserInfoController@store')->middleware('auth')->name('admin-info.store');

Route::get('/admin-info/{slug}/edit', 'Admin\UserInfoController@edit')->middleware('auth')->name('admin-info.edit');

Route::put('/admin-info/{slug}/update', 'Admin\UserInfoController@update')->middleware('auth')->name('admin-info.update');


// Restaurant Plates Routes
Route::prefix('admin')->namespace('Admin')->name('admin.')->middleware('auth')->group(function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('plates', 'PlateController');

});


// Braintree Routes
Route::get('/payment', 'PaymentController@index')->name('braintree-index');

Route::post('/payment-checkout', 'PaymentController@checkout')->name('braintree-checkout');

// orders route
Route::get('/order', 'OrderController@create')->name('order-create');
