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
    
    
    Route::post('inti/search', 'IntiController@search')->name('search');
    Route::get('inti/relationship/{id}/{table}/{key}/{type}', 'IntiController@relationship')->name('relationship');
    Route::get('inti/view/{table}/{id}', 'IntiController@view')->name('view');
    Route::get('inti/deletes/recovery/{table}/{id}', 'IntiController@recovery')->name('recovery');
    Route::get('inti/deletes/{table}', 'IntiController@deletes')->name('deletes');
    
 
});
