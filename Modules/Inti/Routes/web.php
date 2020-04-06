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
    
    
    Route::post('inti/search', 'IntiController@search')->name('inti_search');
    Route::get('inti/relationship/{id}/{table}/{key}/{type}', 'IntiController@relationship')->name('inti_relationship');
    Route::get('inti/view/{table}/{id}', 'IntiController@view')->name('inti_view');
    Route::get('inti/deletes/recovery/{table}/{id}', 'IntiController@recovery')->name('inti_recovery');
    Route::get('inti/deletes/{table}', 'IntiController@deletes')->name('inti_deletes');
    
 
});
