<?php

use Illuminate\Http\Request;

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


Route::get('/server', 'ServerController@index');
Route::get('/market', 'MarketController@index');
Route::get('/domain', 'DomainController@index');
Route::get('/commune', 'CommuneController@index');
Route::get('/payment', 'PaymentController@index');