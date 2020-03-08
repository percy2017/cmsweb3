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

    Route::get('profiles/{id}','StreamingController@history')->name('profile_history');
    Route::post('profiles/{id}/update', 'StreamingController@update')->name('profile_renovation');
    Route::post('profiles/change', 'StreamingController@change')->name('profile_change');
  
  
  });