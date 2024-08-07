<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
Route::group(['middleware' => 'auth:api'], function(){
    Route::apiResource('clients', ClientController::class);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::delete('clients/{id}', [ClientController::class, 'destroy']);
    Route::put('/clients/{id}', [ClientController::class, 'update']);
    Route::get('/usuarios', [UserController::class, 'getAllUsers']);
});
Route::put('/users/{user}', [UserController::class, 'update'])->name('user.update');

Route::post('users', [UserController::class, 'store']);
Route::post('login', [UserController::class,'login']);
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('loginuser', [UserController::class, 'index'])->name('user.index');

