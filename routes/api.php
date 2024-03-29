<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

$router->post('get-data', 'ChatController@getData')->middleware('basic_auth');
$router->post('close-tiket','ChatController@closeTicket')->middleware('basic_auth');
$router->post('post-tiket','TiketController@apiTiket')->middleware('basic_auth');