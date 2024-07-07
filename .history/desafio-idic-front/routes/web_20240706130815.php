<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\ClientesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('formulario');
});
Route::get('/login', [FormularioController::class, 'mostrarFormulario'])->name('login');
Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index')->middleware('auth');
Route::get('/formulario', [FormularioController::class, 'mostrarFormulario'])->name('formulario.mostrar');
Route::post('/formulario-enviar', [FormularioController::class, 'enviarFormulario'])->name('formulario.enviarFormulario');
