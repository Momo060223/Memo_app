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

// この部分を追加
Route::get('/', 'App\\Http\\Controllers\\MemoController@show');
Route::post('/add', 'App\\Http\\Controllers\\MemoController@add');
Route::get('edit/{edit_id}', 'App\\Http\\Controllers\\MemoController@getEdit');
Route::post('/delete', 'App\\Http\\Controllers\\MemoController@delete'); // 追加
Route::post('/update', 'App\\Http\\Controllers\\MemoController@postEdit');

