<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\ClientesController;

// Ruta para mostrar el formulario de inicio de sesión
Route::get('/login', [FormularioController::class, 'mostrarFormulario'])->name('login');

// Ruta para enviar los datos del formulario de inicio de sesión
Route::post('/formulario-enviar', [FormularioController::class, 'enviarFormulario'])->name('formulario.enviarFormulario');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');

});
Route::post('/clientes-agregar', [FormularioController::class, 'storeCliente'])->name('formulario.storeCliente');
// Ruta por defecto para mostrar el formulario de inicio de sesión si la ruta raíz es accedida
Route::get('/', [FormularioController::class, 'mostrarFormulario'])->name('formulario.mostrar');
Route::delete('cliente-eliminar/{id}', [FormularioController::class, 'eliminar'])->name('formulario.eliminar');

Route::put('/clientes/{id}', [FormularioController::class, 'update'])->name('formulario.update');



