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
Route::get('/', 'HomeController@index')->name('restaurant.home');


// Restaurant Info Routes
Route::get('/restaurant-info/create', 'Admin\UserInfoController@create')->middleware('auth')->name('admin-info.create');

Route::post('/restaurant-info/store', 'Admin\UserInfoController@store')->middleware('auth')->name('admin-info.store');

Route::get('/restaurant-info/{slug}/edit', 'Admin\UserInfoController@edit')->middleware('auth')->name('admin-info.edit');

Route::put('/restaurant-info/{slug}/update', 'Admin\UserInfoController@update')->middleware('auth')->name('admin-info.update');


// Restaurant Plates Routes
Route::prefix('admin')->namespace('Admin')->name('admin.')->middleware('auth')->group(function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('plates', 'PlateController');

});