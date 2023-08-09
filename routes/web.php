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
    Route::get('/', [AppController::class, 'index'])->name('index');
    Route::get('/manual', [AppController::class, 'manual'])->name('manual');
    Route::post('/store', [AccessTokenController::class, 'store'])->name('store');


    Route::get('/set-locale/{locale}', static function ($locale) {
        session()->put('locale', $locale);

        return redirect()->back();
    })->name('locale');
});
