<?php

use App\Http\Controllers\page_controller;
use App\Http\Controllers\view_controller;
use App\Livewire\Counter;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [view_controller::class, 'index']);
Route::get('/history', [view_controller::class, 'history']);
Route::get('/history/print', [view_controller::class, 'print']);
Route::get('/import', [view_controller::class, 'import']);
Route::get('/export', [view_controller::class, 'export']);
Route::get('/withdrawal', [view_controller::class, 'withdrawal']);

/*
*再読み込みエラー防止のために、getを先に追加
*/
Route::get('/add', [page_controller::class, 'reg_requests']);
Route::post('/add', [page_controller::class, 'reg_requests']);
Route::get('/edit', [page_controller::class, 'reg_requests']);
Route::post('/edit', [page_controller::class, 'reg_requests']);
Route::get('/csv', [page_controller::class, 'csv_use']);
Route::post('/csv', [page_controller::class, 'csv_use']);
Route::get('/erasure', [page_controller::class, 'erasure']);
Route::post('/erasure', [page_controller::class, 'erasure']);
Route::get('/ajax', [page_controller::class, 'ajax']);
Route::post('/ajax', [page_controller::class, 'ajax']);

// Livewire
Route::get('/counter', Counter::class);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
