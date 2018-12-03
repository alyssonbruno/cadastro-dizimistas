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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/dizimista', 'DizimistaController@index')->name('dizimista.index');
Route::get('/dizimista/{id}', 'DizimistaController@show')->name('dizimista.show');
Route::put('/dizimista/{id}/update', 'DizimistaController@update')->name('dizimista.update');
