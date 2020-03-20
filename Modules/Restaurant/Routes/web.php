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
    Route::resource('myproducts', 'ProductController');
    Route::get('myproducts/ajaxdata/{id}', 'ProductController@ajaxdata')->name('myproducts_ajaxdata');

    Route::resource('mycategories', 'CategoryController');
    Route::resource('mysubcategories', 'SubCategoryController');
    Route::resource('mybranchOfficies', 'BranchOfficeController');
    Route::resource('mysupplies', 'SupplyController');
    Route::resource('myextras', 'ExtraController');
    
});
