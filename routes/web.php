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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'FrontEndController@default')->name('page_default');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('login/github', 'SocialiteController@redirectToProvider');
Route::get('login/github/callback', 'SocialiteController@handleProviderCallback');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::get('/block/{page_id}', 'BlockController@index')->name('block_index'); 
    Route::post('/block/update/{block_id}', 'BlockController@update')->name('block_update');
    Route::get('/block/delete/{block_id}', 'BlockController@delete')->name('block_delete');    
});
