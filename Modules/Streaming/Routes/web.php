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

    
    Route::post('profile/{id}/update', 'StreamingController@update')->name('profile_renovation');
    Route::post('profile/change', 'StreamingController@change')->name('profile_change');
  

    Route::resource('myboxes', 'BoxController');
    Route::post('myboxes/myseatings/contabilizar', 'BoxController@contabilizar')->name('box_conta');
    Route::get('myboxes/myseatings/{box_id}', 'BoxController@seatings')->name('box_seatings');
    Route::get('myboxes/myseatings/close/{box_id}', 'StreamingController@close')->name('box_close'); 
    

    Route::resource('myaccounts', 'AccountController');
    Route::get('myaccounts/myprofiles/{account_id}', 'AccountController@profiles')->name('account_profiles');
    Route::post('myaccounts/profiles_save', 'AccountController@profiles_save')->name('account_profiles_save');

    Route::resource('myprofiles', 'ProfilesController');
    Route::get('myprofiles/history/{id}','ProfilesController@history')->name('profile_history');

    Route::resource('myseatings', 'SeatingsController');
  });