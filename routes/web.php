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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/articulos', 'ArticuloController@index')->name('articulos.index');
Route::get('articulos/show/{id}','ArticuloController@show')->name('articulos.show');
Route::any('articulos/create','ArticuloController@create')->name('articulos.create');
Route::any('articulos/store','ArticuloController@store')->name('articulos.store');
Route::any('articulos/edit/{id}','ArticuloController@edit')->name('articulos.edit');
Route::any('articulos/update','ArticuloController@update')->name('articulos.update');
Route::any('articulos/destroy/{id}','ArticuloController@destroy')->name('articulos.destroy');

//Route::resource('articulos','ArticuloController');
//Route::resource('photos','ArticuloController');
route::delete ('photos/eliminar/{id}','ArticuloController@eliminarPhoto')->name('photos.eliminarPhoto');