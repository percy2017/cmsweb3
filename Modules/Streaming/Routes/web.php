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

  // funciones accounts------------------------------------------------------
  Route::resource('myaccounts', 'AccountController');
  Route::get('myaccounts/ajax_destroy/{id}/{model}', 'AccountController@ajax_destroy')->name('myaccounts_ajax_destroy');
    // ajax profiles
    Route::get('myaccounts/ajax/profiles/index/{account_id}', 'AccountController@ajax_profiles')->name('myaccounts_ajax_profile');
    Route::get('myaccounts/ajax/profiles/create/{account_id}', 'AccountController@ajax_profiles_create')->name('myaccounts_ajax_profile_create');
    Route::post('myaccounts/ajax/profiles/store/{account_id}', 'AccountController@ajax_profiles_store')->name('myaccounts_ajax_profile_store');
    
  







  Route::resource('myprofiles', 'ProfilesController');

  Route::resource('myboxes', 'BoxController');
 
  Route::resource('myseatings', 'SeatingController');

  });