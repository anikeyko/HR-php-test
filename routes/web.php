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

Route::get('weather', 'WeatherController@index')->name('weather');

Route::get('orders', 'OrdersController@index')->name('orders');
Route::get('orders/{id}/edit', 'OrdersController@edit')->name('edit_order');
Route::patch('orders/{id}', 'OrdersController@update')->name('update_order');
