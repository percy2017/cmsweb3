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

  Route::resource('myaccounts', 'AccountController');
  Route::get('myaccounts/ajax_destroy/{id}/{model}', 'AccountController@ajax_destroy')->name('myaccounts_ajax_destroy');
  Route::get('myaccounts/ajax/profiles/create', 'AccountController@ajax_profiles_create')->name('myaccounts_ajax_profile_create');
  Route::post('myaccounts/ajax/profiles/store', 'AccountController@ajax_profiles_store')->name('myaccounts_ajax_profile_store');
  Route::post('myaccounts/ajax/profiles/destroy', 'AccountController@ajax_profiles_detroy')->name('myaccounts_ajax_profile_detroy');
  Route::get('myaccounts/ajax/profiles/{account_id}', 'AccountController@ajax_profiles')->name('myaccounts_ajax_profile');
  

  Route::resource('myprofiles', 'ProfilesController');

  Route::resource('myboxes', 'BoxController');
 
  Route::resource('myseatings', 'SeatingController');

  });