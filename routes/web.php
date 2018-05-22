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
    return view('welcome');
});

Route::get('/register-url', 'MPesaController@register');
Route::any('/mpesa/validate', 'MPesaController@validateTransaction');
Route::any('/mpesa/confirm', 'MPesaController@confirmTransaction');

Route::get('/fake-invoice', 'MPesaTestController@fakeInvoice');
Route::get('/real-invoice', 'MPesaTestController@realInvoice');
