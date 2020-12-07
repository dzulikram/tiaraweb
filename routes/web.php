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

Auth::routes();

Route::get('dashboard', 'PageController@index');
Route::get('responden', 'PageController@responden');

Route::get('user', 'UserController@index');
Route::get('user/create','UserController@create'); // create user
Route::get('user/edit/{id}','UserController@edit'); //edit
Route::post('user','UserController@store'); //store
Route::put('user/{id}','UserController@update'); //update
Route::get('user/delete/{id}','UserController@delete'); //delete

Route::get('saran','SaranController@index'); // list saran
Route::get('saran/create','SaranController@create'); // create saran
Route::get('saran/edit/{id}','SaranController@edit'); //edit
Route::post('saran','SaranController@store'); //store
Route::put('saran/{id}','SaranController@update'); //update
 

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
