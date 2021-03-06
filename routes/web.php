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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('servers','ServerController');
Route::resource('markets','MarketController');
Route::resource('domains','DomainController');
Route::resource('communes','CommuneController');
Route::resource('payments','PaymentController');

Route::get('{path}',"HomeController@index")->where( 'path', '([A-z\d-\/_.]+)?' );