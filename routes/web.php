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

Route::get('maintenance', function () {
	return view('maintenance');
});

Route::get('dashboard', 'PageController@index');
Route::get('responden', 'PageController@responden');

Route::get('keluhan', 'KeluhanController@index');

Route::get('user', 'UserController@index');

Route::get('saran','SaranController@index'); // list saran
Route::get('saran/create','SaranController@create'); // create saran
Route::get('saran/edit/{id}','SaranController@edit'); //edit
Route::post('saran','SaranController@store'); //store
Route::put('saran/{id}','SaranController@update'); //update
 
