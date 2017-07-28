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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/','pre_reservaController@index');

Route::post('/gravar','pre_reservaController@gravar');

Route::get('/gravar','pre_reservaController@index');



Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/aprovadas', 'adminController@listarAprovadas');
Route::get('admin/negadas', 'adminController@listarNegadas');
Route::get('admin/reserva-tecnica', 'adminController@listarReservaTecnica');
Route::get('admin/aguardando-formulario', 'adminController@listarPreReservadas');
Route::get('admin/pendentes', 'adminController@listarPendentes');
Route::get('admin/canceladas', 'adminController@listarCanceladas');


Route::put('admin/negadas','adminController@setNegadas');
Route::put('admin/aguardando-formulario','adminController@setAguardandoFormulario');
Route::put('admin/reserva-tecnica','adminController@setReservaTecnica');
Route::put('admin/aprovadas','adminController@setAprovadas');
Route::put('admin/canceladas','adminController@setCanceladas');

Route::post('admin/aguardando-formulario', 'adminController@showConfirm');


Route::resource('admin', 'adminController');

