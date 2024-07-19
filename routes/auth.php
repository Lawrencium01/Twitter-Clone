<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
Route::group(["middleware"=> "guest"], function () {
    Route::get('/register', [AuthController::class,'register'])->name('register');

    Route::post('/store', [AuthController::class,'store']);

    Route::get('/login', [AuthController::class,'login'])->name('login');

    Route::post('/send', [AuthController::class,'authenticate']);
});

Route::post('/logout', [AuthController::class,'logout'])->middleware('auth');