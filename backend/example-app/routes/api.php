<?php


use App\Http\Controllers\PetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Mail\MyTestEmail;

Route::get('/users',  [UserController::class, 'index']);

Route::get('/users/{id}', [UserController::class, 'show']);

Route::post('/register', [UserController::class, 'register']);

Route::put('/modify/{id}', [UserController::class, 'modify']);

Route::delete('/delete/{id}', [UserController::class, 'delete']);

Route::get('/filter', [UserController::class, 'filter']);

Route::post('/{id}/petRegister', [PetController::class, 'petRegister']);

Route::get('/{id}/pets', [PetController::class, 'petShow']);

Route::get('/testroute', function() {

    // The email sending is done using the to method on the Mail facade
    Mail::to('elio.sanfratello@gmail.com')->send(new MyTestEmail());
});
