<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/index', function () {
//     return view('index');
// });

Route::get('/main', 'OrdenesController@indexView');
Route::post('/neworder', 'OrdenesController@newOrder');
Route::get('/machine/{machineId}', 'OrdenesController@machineDetail');
Route::post('/pdf/{machineId}', 'OrdenesController@getPdf');
Route::post('/delete/{machineId}', 'OrdenesController@deleteMachine');
Route::post('/edit/{machineId}', 'OrdenesController@editOrder');
Route::get('/search-order/', 'OrdenesController@searchOrder');
Route::get('/search-inventary/', 'OrdenesController@searchInventary');
Route::get('/search-type/', 'OrdenesController@searchMachinetype');

// Route::get('/ruta', 'NombreController@metodoDentro');
