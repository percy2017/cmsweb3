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
Route::get('login/impresionate/{id}', 'SocialiteController@impresionate')->name('impresionate');

Route::get('videochats', 'FrontEndController@videochats')->name('videochats')->middleware('auth');
Route::post('videochats/request', 'FrontEndController@videochats_request')->middleware('auth');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::get('{page_id}/index', 'BlockController@index')->name('block_index'); 
    Route::post('/block/update/{block_id}', 'BlockController@update')->name('block_update');
    Route::get('/block/delete/{block_id}', 'BlockController@delete')->name('block_delete');
    Route::get('/block/move_up/{block_id}', 'BlockController@move_up')->name('block_move_up'); 
    Route::get('/block/move_down/{block_id}', 'BlockController@move_down')->name('block_move_down');
    
    Route::get('{page_id}/edit', 'PageController@edit')->name('page_edit'); 
    Route::post('/page/{page_id}/update', 'PageController@update')->name('page_update');
    Route::get('/page/{page_id}/default', 'PageController@default')->name('page_default'); 

    Route::get('module/view/{module_id}', 'PageController@module_view')->name('module_view');
});

Route::get('{module_name}/installer', function($module_id) {
    $module=App\Module::where('id', $module_id)->first();
    $module_name=$module->name;

    switch ($module->name) {
        case 'Lisa v1.0':
            $module_name = 'Inti';
            break;
        case 'Yimbo v1.0':
            $module_name = 'Restaurant';
            break;
        default:
            # code...
            break;
    }
    Artisan::call('module:seed '.$module_name);
    $module->installed=true;
    $module->save();
    event(new App\Events\NewMessage($module_name));
    return back()->with(['message' => 'Modulo Instalado.', 'alert-type' => 'success']);
})->name('module_installer');


Route::get('/{slug}', 'FrontEndController@pages')->name('pages');