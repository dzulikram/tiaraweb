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

Route::get('/', 'Auth\LoginController@checkIsLogin');

Route::get('maintenance', function () {
	return view('maintenance');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
	Route::get('/logout', 'Auth\LoginController@logout');
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

	Route::get('chat','ChatController@index');

	Route::get('tiket','TiketController@index');
	Route::get('tiket-open','TiketController@indexOpen');
	Route::get('tiket-assigned','TiketController@indexAssigned');
	Route::get('tiket-resolved','TiketController@indexResolved');
	Route::get('assign-tiket/{id}','TiketController@assignTiket');
	Route::post('assign-tiket/{id}','TiketController@storeAssignTiket');
});