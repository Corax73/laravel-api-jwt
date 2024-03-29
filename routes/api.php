<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['api'])->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::controller(NewsController::class)->group(function () {
    Route::get('/news', 'index')->name('index');
    Route::get('/news/{news}', 'show')->name('show');
    Route::post('/news/search/', 'search')->name('search');
});

Route::middleware(['auth:api'])->controller(NewsController::class)->group(function () {
    Route::post('/news', 'store')->name('store');
    Route::patch('/news/{news}', 'update')->name('update');
    Route::delete('/news/{news}', 'destroy')->name('destroy');
});
