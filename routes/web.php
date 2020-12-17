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

Route::get('/', 'ContactController@index'); //ke halaman utma
Route::get('/contacts/create', 'ContactController@create'); // ke halaman add contact
Route::post('/contacts', 'ContactController@store'); //ketika klik button save
Route::get('/contacts/{id}/edit', 'ContactController@edit'); // ke halaman edit
Route::patch('/contacts/{id}', 'ContactController@update'); // ketika save button langsung update
Route::delete('/contacts/{id}', 'ContactController@destroy');// route untuk hapus