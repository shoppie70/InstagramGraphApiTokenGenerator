<?php

use App\Http\Controllers\Api\AccessTokenController;
use App\Http\Controllers\AppController;
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


Route::get('/', [AppController::class, 'index'])->name('index');
Route::post('/manual', [AppController::class, 'manual'])->name('manual');
Route::post('/store', [AccessTokenController::class, 'store'])->name('store');
