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

  Route::get('seating/{box_id}', 'SeatingController@index')->name('seating_index'); 
  Route::post('seating/ingresos', 'SeatingController@store')->name('seating_storage'); 
});
