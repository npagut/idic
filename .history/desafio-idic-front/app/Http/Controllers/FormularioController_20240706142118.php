<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FormularioController extends Controller
{
    public function mostrarFormulario()
    {
        return view('formulario'); // Vista del formulario
    }

    public function enviarFormulario(Request $request)
    {

        // Hacer la solicitud al proyecto X para obtener el token
        $response = Http::post('http://localhost:8000/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);
        dd($response->status());
        // Verificar si la solicitud fue exitosa
        if ($response->successful()) {
            $token = $response->json()['access_token'];

            // Ahora puedes usar el $token para hacer otras solicitudes al proyecto X
            // Por ejemplo, guardar el token en sesión o en el almacenamiento local
            session(['access_token' => $token]);
            // dd($token);
            $token = session('access_token');

            // Hacer la solicitud al proyecto X para obtener los clientes
            $response = Http::withToken($token)->get('http://localhost:8000/api/clients');

            // Verificar si la solicitud fue exitosa
            if ($response->successful()) {
                $clientes = $response->json();
                return view('formulario', ['clientes' => $clientes]);
            }
        }else{
            return back()->withErrors(['message' => 'Error al iniciar sesión']);
        }
        // Manejar el error si la autenticación falla
        return back()->withErrors(['message' => 'Credenciales inválidas']);
    }
}
