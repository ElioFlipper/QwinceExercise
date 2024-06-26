<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

Log::info("Fuori dalle rotte web");

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/token', function () {
    return csrf_token();
});