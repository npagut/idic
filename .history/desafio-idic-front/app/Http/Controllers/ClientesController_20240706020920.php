<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientesController extends Controller
{ 
    public function index()
    {
        // Obtener el token de la sesión o del almacenamiento local
        $token = session('access_token');

        // Hacer la solicitud al proyecto X para obtener los clientes
        $response = Http::withToken($token)->get('http://localhost:8000/api/clients');

        // Verificar si la solicitud fue exitosa
        if ($response->successful()) {
            $clientes = $response->json();
            return view('clientes', ['clients' => $clientes]);
        }

        // Manejar el error si la solicitud falla
        return back()->withErrors(['message' => 'Error al obtener los clientes']);
    }
    //
}
