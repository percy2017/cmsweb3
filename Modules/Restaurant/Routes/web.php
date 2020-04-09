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

Route::prefix('admin')->group(function() {
   
    Route::post('restaurant/search', 'RestaurantController@search')->name('restaurant_search');
    Route::get('restaurant/relationship/{id}/{table}/{key}/{type}', 'RestaurantController@relationship')->name('restaurant_relationship');
    Route::get('restaurant/view/{table}/{id}', 'RestaurantController@view')->name('restaurant_view');
    Route::get('restaurant/deletes/recovery/{table}/{id}', 'RestaurantController@recovery')->name('restaurant_recovery');
    Route::get('restaurant/deletes/{table}', 'RestaurantController@deletes')->name('restaurant_deletes');
    
});
