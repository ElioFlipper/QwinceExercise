<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Log::info("Fuori dalle rotte");

Route::get('/users',  [UserController::class, 'index']);

Route::get('/users/{id}', [UserController::class, 'show']);

Route::post('/register', [UserController::class, 'register']);

Route::put('/modify/{id}', [UserController::class, 'modify']);