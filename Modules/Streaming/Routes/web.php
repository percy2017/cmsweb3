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

Route::group(['prefix' => 'admin'], function () {
    
    
    Route::post('streaming/search', 'StreamingController@search')->name('search');
    Route::get('streaming/relationship/{id}/{table}/{key}/{type}', 'StreamingController@relationship')->name('relationship');
    Route::get('streaming/view/{table}/{id}', 'StreamingController@view')->name('view');
    
 
});