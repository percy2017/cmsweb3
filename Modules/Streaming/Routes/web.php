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

    Route::post('memberships/search', 'MembershipController@search');
 
});