<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Domain\Book\Http\Controllers\BookController;
use App\Domain\Store\Http\Controllers\StoreController;
use App\Domain\User\Http\Controllers\AuthController;
use App\Domain\User\Http\Controllers\UserController;

Route::post('/register', [UserController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiResource('books', BookController::class);
    Route::apiResource('stores', StoreController::class);
});
