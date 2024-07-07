<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\ClientesController;

Route::get('/', [FormularioController::class, 'mostrarFormulario'])->name('formulario.mostrar');

Route::post('/formulario-enviar', [FormularioController::class, 'enviarFormulario'])->name('formulario.enviarFormulario');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
    Route::post('/clientes-agregar', [FormularioController::class, 'storeCliente'])->name('formulario.storeCliente');
});
