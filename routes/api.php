<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'auth'], function(){
    Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'register']);
    Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);
    //Route::post('logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware("auth:sanctum");
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('auth/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
});
