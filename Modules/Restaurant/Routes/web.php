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

Route::prefix('admin')->group(function() {
    Route::resource('mycategories', 'CategoryController');
    Route::resource('mysubcategories', 'SubCategoryController');
    Route::resource('myproducts', 'ProductController');

    Route::get('myproducts/ajax_index/{id}/{model}', 'ProductController@ajax_index')->name('myproducts_ajax_index');
    Route::get('myproducts/ajax_create/{table}', 'ProductController@ajax_create')->name('myproducts_ajax_create');
    Route::post('myproducts/ajax_store/{model}', 'ProductController@ajax_store')->name('myproducts_ajax_store');
    Route::get('myproducts/ajax_images/{id}/{model}', 'ProductController@ajax_images')->name('myproducts_ajax_images');

    
    Route::resource('mybranch_offices', 'BranchOfficeController');
    Route::resource('mysupplies', 'SupplyController');
    Route::resource('myextras', 'ExtraController');
    
});
