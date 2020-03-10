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

// Route::prefix('streaming')->group(function() {
//     Route::get('/', 'StreamingController@index');
//     Route::get('profiles/{id}','StreamingController@history')->name('profile_history');
// });


Route::group(['prefix' => 'admin'], function () {

    Route::get('profile/{id}','StreamingController@history')->name('profile_history');
    Route::post('profile/{id}/update', 'StreamingController@update')->name('profile_renovation');
    Route::post('profile/change', 'StreamingController@change')->name('profile_change');
  
    Route::get('seating/{box_id}', 'StreamingController@index')->name('seating_index'); 
    Route::post('seating/ingresos', 'StreamingController@store')->name('seating_storage'); 
    Route::get('seating/cerrar/{box_id}', 'StreamingController@close')->name('box_close'); 

    Route::resource('boxe', 'BoxController');
  });