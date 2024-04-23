<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'auth'], function(){
    Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'register']);
    Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('auth/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::get('albums/{id}', [App\Http\Controllers\Api\AlbumController::class, 'get']);
    Route::get('artists/{id}', [App\Http\Controllers\Api\ArtistController::class, 'get']);
    Route::get('search', [App\Http\Controllers\Api\SongController::class, 'search']);
});
