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

Route::post('/','pre_reservaController@gravar');


//google calendar test

Route::resource('gcalendar', 'gCalendarController');
Route::get('oauth', ['as' => 'oauthCallback', 'uses' => 'gCalendarController@oauth']);