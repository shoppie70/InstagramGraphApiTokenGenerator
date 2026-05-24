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



Route::group(['middleware'=>'set.locale'], static function () {
    // Japanese
    Route::group(['prefix' => 'ja'], static function () {
        Route::get('/', [AppController::class, 'index'])->name('index.ja');
        Route::get('/manual', [AppController::class, 'manual'])->name('manual.ja');
        Route::post('/store', [AccessTokenController::class, 'store'])->name('store.ja');
    });

    // English (Default)
    Route::get('/', [AppController::class, 'index'])->name('index.en');
    Route::get('/manual', [AppController::class, 'manual'])->name('manual.en');
    Route::post('/store', [AccessTokenController::class, 'store'])->name('store.en');
});
