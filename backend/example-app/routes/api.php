<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\emailController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\subscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Mail\MyTestEmail;

Route::get('/users', [UserController::class, 'index']);

Route::get('/users/{id}', [UserController::class, 'show']);

Route::get('/pets', [PetController::class, 'getPets']);

Route::get('/users/{id}/pets', [PetController::class, 'getUsersPet']);

Route::post('/register', [UserController::class, 'register']);

Route::put('/modify/{id}', [UserController::class, 'modify']);

Route::delete('/delete/{id}', [UserController::class, 'delete']);

Route::get('/filter', [UserController::class, 'filter']);

Route::post('/users/{id}/pet', [PetController::class, 'storePet']);


// Route::get('/testroute', function() {

//     // The email sending is done using the to method on the Mail facade
//     Mail::to('elio.sanfratello@gmail.com')->send(new MyTestEmail());
// });

Route::get('/sendEmail', [UserController::class, 'mailSender']);



Route::get('/subscriptions', [subscriptionController::class, 'getSubscription']);

Route::get('/subscriptions/{id}', [subscriptionController::class, 'getSingleSubscription']);

Route::post('/createSubscription', [subscriptionController::class, 'createSubscription']);

Route::delete('/deleteSubscription/{id}', [subscriptionController::class, 'deleteSubscription']);

Route::put('/modifySubscription/{id}', [subscriptionController::class, 'modifySubscription']);


Route::get('/users/{id}/subscriptions', [UserController::class, 'getUsersSubscriptions']);

Route::get('/subscriptions/{subscriptionId}/users', [UserController::class, 'getUsersBySubscription']);

Route::post('/users/{userId}/subscriptions/{subscriptionId}', [UserController::class, 'addSubscriptionToUser']);

Route::delete('/users/{userId}/subscriptions/{subscriptionId}', [UserController::class, 'removeSubscriptionFromUser']);

Route::post('register', [AuthController::class, 'register'])->middleware('auth:sanctum');
Route::post('login', [AuthController::class, 'login'])->middleware('auth:sanctum');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
