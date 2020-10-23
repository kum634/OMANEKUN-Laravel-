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
Route::get('/','omanekun_controller@index');
Route::get('input','omanekun_controller@input');
Route::get('data_Register','omanekun_controller@data_Register');
Route::get('seach_display','omanekun_controller@seach_display');
Route::get('seach_result','omanekun_controller@seach_result');
Route::get('delete_seach_result','omanekun_controller@delete_seach_result');
Route::get('details','omanekun_controller@details');
Route::get('print','omanekun_controller@print');
Route::get('delete_seach_display','omanekun_controller@delete_seach_display');
Route::get('delete_details','omanekun_controller@delete_details');
Route::get('delete','omanekun_controller@delete');
Route::get('withdrawal','omanekun_controller@withdrawal');
Route::get('withdrawal_judgment','omanekun_controller@withdrawal_judgment');
Route::get('import','omanekun_controller@import');
Route::post('import_judgment','omanekun_controller@import_judgment');
Route::get('export','omanekun_controller@export');
Route::get('export_judgment','omanekun_controller@export_judgment');

Auth::routes();
