<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// All Restaurants API
Route::get('/restaurants', 'Api\UserInfoController@index')->name('api.restaurants');

// Types Buttons API
Route::get('/restaurants/types', 'Api\UserInfoController@types')->name('api.restaurants-types');

// Filtered Restaurants By Type API
Route::get('/restaurants/{type}', 'Api\UserInfoController@searchRestaurants')->name('api.search');


