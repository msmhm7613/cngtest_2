<?php

use App\Http\Controllers\PanelController;
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

Route::post('/setup','App\Http\Controllers\SetupController@index');

//Route::get('/panel', [PanelController::class , 'index']);

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::post('/welcome' , '\App\Http\Controllers\welController@index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/addUser', '\App\Http\Controllers\UserController@newUser');
Route::post('/editUser', '\App\Http\Controllers\UserController@editUser');
Route::post('/deleteUser', '\App\Http\Controllers\UserController@deleteUser');
Route::get('/selectUser', '\App\Http\Controllers\UserController@selectUser');

Route::get('/new-panel','\App\Http\Controllers\NewPanelController@index');
Route::post('/new-panel', '\App\Http\Controllers\NewPanelController@getContent');

Route::get('insertNewWorkshopForm', 'App\Http\Controllers\Workshop\WorkshopController@loadInsertForm');
Route::get('insert_new_contractor_form', 'App\Http\Controllers\Contractor\ContractorController@loadInsertForm');

Route::get('init_panel', 'App\Http\Controllers\PanelController@init');


