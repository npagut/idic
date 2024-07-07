<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\ClientesController;

Route::get('/', function () {
    return view('formulario');
});

Route::group(['middleware' => 'auth:web'], function(){
    Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
});

Route::get('/login', [FormularioController::class, 'mostrarFormulario'])->name('login');
Route::get('/formulario', [FormularioController::class, 'mostrarFormulario'])->name('formulario.mostrar');
Route::post('/formulario-enviar', [FormularioController::class, 'enviarFormulario'])->name('formulario.enviarFormulario');
