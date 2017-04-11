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

Route::get('/', 'TimerController@show')->name('show_timer');

Route::get('/Yeah-its-DEV-BaF', 'TimerController@setDevBaF')->name('it_is_dev_baf_time');
