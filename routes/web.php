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

Route::get('/', 'HomeController@index')->name('customer.home');



// Restaurant Info Routes
Route::get('/restaurant-info', 'Restaurant\UserInfoController@index')->middleware('auth')->name('restaurant-info.index');

Route::get('/restaurant-info/create', 'Restaurant\UserInfoController@create')->middleware('auth')->name('restaurant-info.create');

Route::post('/restaurant-info', 'Restaurant\UserInfoController@store')->middleware('auth')->name('restaurant-info.store');

Route::get('/restaurant-info/{slug}/edit', 'Restaurant\UserInfoController@edit')->middleware('auth')->name('restaurant-info.edit');

Route::put('/restaurant-info/{slug}/update', 'Restaurant\UserInfoController@update')->middleware('auth')->name('restaurant-info.update');



// Restaurant Plates Routes
Route::prefix('restaurant')->namespace('Restaurant')->name('restaurant.')->middleware('auth')->group(function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('plates', 'PlateController');

});
