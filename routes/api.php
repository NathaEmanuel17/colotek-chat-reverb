<?php

use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;


// Rotas públicas de autenticação
Route::prefix('auth')->controller(RegisterController::class)->group(function() {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

// Rotas autenticadas de autenticação
Route::middleware('auth:sanctum')->group(function () {
    Route::post('auth/logout', [RegisterController::class, 'logout']);
});

// Rotas autenticadas de usuário
Route::middleware('auth:sanctum')->group(function () {
    Route::post('auth/logout', [RegisterController::class, 'logout']);
    
    Route::resource('users', UserController::class)->only([
        'show', 'update', 'destroy'
    ]);
});