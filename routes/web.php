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

Route::get('/', 'AlbumsController@index');
Route::get('/projects', 'AlbumsController@index');
Route::get('/albums/create', 'AlbumsController@create');
Route::get('/albums', 'AlbumsController@index');
Route::post('/albums/store', 'AlbumsController@store');
Route::get('/photos/create/{id}', 'PhotosController@create');
Route::post('/photos/store', 'PhotosController@store')->name('store');
Route::put('/albums/{id}', 'AlbumsController@update')->name('update');
Route::put('/photos/{id}', 'PhotosController@update')->name('update');
Route::get('/albums/{id}/edit', 'AlbumsController@edit');
Route::get('/photos/{id}/edit', 'PhotosController@edit');
Route::get('/photos/{id}', 'PhotosController@show');
Route::delete('/photos/{id}', 'PhotosController@destroy');
Route::get('/albums/{id}', 'AlbumsController@show');
Route::delete('/albums/{id}', 'AlbumsController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
