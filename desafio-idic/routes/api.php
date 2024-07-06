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
});

Route::post('users', [UserController::class, 'store']);
Route::post('login', [UserController::class,'login']);

