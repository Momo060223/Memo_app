<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MemoController::class, 'show']);
Route::post('/add', [MemoController::class, 'add']);
Route::get('/edit/{edit_id}', [MemoController::class, 'getEdit']);
Route::post('/delete', [MemoController::class, 'delete']);
Route::get('/', [MemoController::class, 'index'])->name('home');
Route::post('/update', 'App\\Http\\Controllers\\MemoController@postEdit');
