<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            \Illuminate\Support\Facades\Log::debug('Redireccionando a la ruta de inicio de sesión.');
            return route('login'); // Cambia 'clientes.index' por 'login' si esa es tu ruta de inicio de sesión
        }else{
            \Illuminate\Support\Facades\Log::debug('Redireccionando a la ruta de inicio de sesión222222.');
        };
    }
}
