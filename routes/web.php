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

	Route::get('user', 'UserController@index');
	Route::get('user/create','UserController@create'); // create user
	Route::get('user/edit/{id}','UserController@edit'); //edit
	Route::post('user','UserController@store'); //store
	Route::put('user/{id}','UserController@update'); //update
	Route::get('user/delete/{id}','UserController@delete'); //delete

	Route::get('rekap/harian', 'TiketController@harian');
	Route::get('rekap/bulanan', 'TiketController@bulanan');
	Route::get('rekap/kategori', 'TiketController@kategori');
	Route::get('rekap/itsupport', 'TiketController@itsupport');
	Route::get('rekap/user', 'TiketController@user');
	Route::get('rekap/unit', 'TiketController@unit');

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

	Route::get('pojok','PojokController@index'); // list saran
	Route::get('pojok/create','PojokController@create'); // create saran
	Route::get('pojok/edit/{id}','PojokController@edit'); //edit
	Route::post('pojok','PojokController@store'); //store
	Route::put('pojok/{id}','PojokController@update'); //update
	Route::get('pojok/delete/{id}','PojokController@delete'); //delete

	Route::get('pegawai','PegawaiController@index'); // list saran
	Route::get('pegawai/create','PegawaiController@create'); // create saran
	Route::get('pegawai/edit/{id}','PegawaiController@edit'); //edit
	Route::post('pegawai','PegawaiController@store'); //store
	Route::put('pegawai/{id}','PegawaiController@update'); //update
	Route::get('pegawai/delete/{id}','PegawaiController@delete'); //delete

	Route::get('kategori','KategoriController@index'); // list saran
	Route::get('kategori/create','KategoriController@create'); // create saran
	Route::get('kategori/edit/{id}','KategoriController@edit'); //edit
	Route::post('kategori','KategoriController@store'); //store
	Route::put('kategori/{id}','KategoriController@update'); //update
	Route::get('kategori/delete/{id}','KategoriController@delete'); //delete

	Route::get('report-harian','ReportController@tiketPerDate');
	Route::post('report-harian/filter','ReportController@filterPerDate');
	Route::get('report-bulanan','ReportController@tiketPerMonth');
	Route::post('report-bulanan/filter','ReportController@filterPerMonth');
	Route::get('report-kategori','ReportController@tiketPerKategori');
	Route::post('report-kategori/filter','ReportController@filterPerKategori');
	Route::get('report-itsupport','ReportController@tiketPerItSupport');
	Route::post('report-itsupport/filter','ReportController@filterPerItSupport');
	Route::get('report-pegawai','ReportController@tiketPerPegawai');
	Route::post('report-pegawai/filter','ReportController@filterPerPegawai');
});
