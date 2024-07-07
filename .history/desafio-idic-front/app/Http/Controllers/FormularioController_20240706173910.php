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
        $response = Http::post('http://localhost:8000/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $token = $response->json()['access_token'];
            session(['access_token' => $token]);

            $userResponse = Http::withToken($token)->get('http://localhost:8000/api/user');

            if ($userResponse->successful()) {
                $user = $userResponse->json();
                $role = $user['rol'];

                $clientsResponse = Http::withToken($token)->get('http://localhost:8000/api/clients');

                if ($clientsResponse->successful()) {
                    $clientes = $clientsResponse->json();

                    if ($role === 'admin') {
                        return view('adminClientes', ['clientes' => $clientes]);
                    } elseif ($role === 'usuario') {
                        return view('usuarioClientes', ['clientes' => $clientes]);
                    } else {
                        return back()->withErrors(['message' => 'Falta asignar un rol a este usuario']);
                    }
                } else {
                    return back()->withErrors(['message' => 'Error al obtener clientes']);
                }
            } else {
                return back()->withErrors(['message' => 'Error al obtener información del usuario']);
            }
        } else {
            return back()->withErrors(['message' => 'Credenciales inválidas']);
        }
    }

    public function storeCliente(Request $request)
    {
        $token = session('access_token');

        $response = Http::withToken($token)->post('http://localhost:8000/api/clients', [
            'nombre' => $request['nombre'],
            'rut' => $request['rut'],
            'telefono' => $request['telefono'],
            'email' => $request['email'],
            'direccion' => $request['direccion'],
        ]);
        dd($response->status()); // Ver el código de estado HTTP
dd($response->body()); // Ver el cuerpo completo de la respuesta


        if ($response->successful()) {
            echo 'aqui';
            // return redirect()->route('clientes.index')->with('success', 'Cliente agregado con éxito');
        } else {
            echo 'aquino';
            // return redirect()->back()->withErrors(['message' => 'Error al agregar el cliente']);
        }
    }
}
