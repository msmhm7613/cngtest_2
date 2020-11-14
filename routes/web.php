<?php

use App\Http\Controllers\PanelController;
use App\Http\Controllers\stuff\stuffController;
use App\Http\Controllers\stuffpacks\spController;
use App\Http\Controllers\tempReciept\TempRecieptController;
use App\Http\Controllers\unit\unitController;
use App\Http\Controllers\stuffpackList\StuffpackListController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


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

Route::get('/', 'App\Http\Controllers\InstallController@index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('setup', '\App\Http\Controllers\SetupController@index');

//Route::get('/panel', [PanelController::class , 'index']);

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::post('/welcome', '\App\Http\Controllers\welController@index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('addUser', '\App\Http\Controllers\UserController@newUser');
Route::post('/editUser', '\App\Http\Controllers\UserController@editUser');
Route::post('deleteUser', '\App\Http\Controllers\UserController@deleteUser');
Route::get('/selectUser', '\App\Http\Controllers\UserController@selectUser');


Route::get('/new-panel', '\App\Http\Controllers\NewPanelController@index');
Route::post('/new-panel', '\App\Http\Controllers\NewPanelController@getContent');
Route::get('new-panel-get-content', '\App\Http\Controllers\NewPanelController@getContent');

Route::get('insertNewWorkshopForm', 'App\Http\Controllers\Workshop\WorkshopController@loadInsertForm');
Route::get('insert_new_contractor_form', 'App\Http\Controllers\Contractor\ContractorController@loadInsertForm');

Route::get('init_panel', 'App\Http\Controllers\PanelController@init');

/********
 * Stuff URLs
 */
Route::group(['namespace' => 'stuff'], function () {
    Route::post('insert-new-stuff', [stuffController::class, 'insert']);
    Route::post('insert-new-stuff-file', [stuffController::class, 'UploadStuff'])->name('uploadStuff');
    Route::get('insert-new-stuff', [stuffController::class, 'insert']);
    Route::get('select-stuff', [stuffController::class, 'selectStuff']);
    Route::post('edit-stuff', [stuffController::class, 'editStuff']);
    Route::post('delete-stuff', [stuffController::class, 'deleteStuff']);
    Route::post('upload-stuff-file', [stuffController::class, 'uploadStuffFile']);
});


/**
 *
 * Stuff-pack URLs
 */

Route::group(['namespace' => 'stuffpacks'], function () {
    Route::get('open-insert-form', function () {
        return view('stuff-pack.insert-form');
    });
    Route::post('insert-new-stuffpack', [spController::class, 'insert']);
    Route::get('select-stuffpack', [spController::class, 'select']);

    Route::post('open-edit-form', [spController::class, 'edit']);
    Route::post('update-stuffpack', [spController::class, 'update']);

    Route::post('delete-stuffpack', [spController::class, 'delete']);
});

/**
 *
 * TEMP RECIEPT URLs
 */
Route::get('open-temp-reciept-insert-form', function () {
    return view('temp-reciept.insert-new-temp-reciept');
});
Route::post('insert-new-temp-rec', 'App\Http\Controllers\TempRecieptController2@insert');


/**
 * SERIAL URLs
 */

Route::post('get-serial-items-list', 'App\Http\Controllers\SerialController@getList');
Route::post('insert-serial-list', 'App\Http\Controllers\SerialListController@insert');

/**
 * WorkShop Urls
 */

Route::post('workshop/create', 'App\Http\Controllers\tempstore\TempstoreController@insert')->name('createTempstore');

/**
 * Transfer Urls
 */

Route::post('transfer/create','App\Http\Controllers\transfer\TransferController@insert')->name('createTransfer');

Route::get('check_serial/{reciept_no}','App\Http\Controllers\stuff\stuffController@check_serial');
Route::get('pagination','App\Http\Controllers\stuff\stuffController@fetch_data');
