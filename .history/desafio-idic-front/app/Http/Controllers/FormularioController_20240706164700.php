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

        // Verificar si la solicitud fue exitosa
        if ($response->successful()) {
            $token = $response->json()['access_token'];

            // Guardar el token en sesión
            session(['access_token' => $token]);

            // Obtener la información del usuario autenticado
            $userResponse = Http::withToken($token)->get('http://localhost:8000/api/user');

            if ($userResponse->successful()) {
                $user = $userResponse->json();
                $role = $user['rol']; // Asegúrate de que 'role' es el campo correcto

                // Hacer la solicitud al proyecto X para obtener los clientes
                $clientsResponse = Http::withToken($token)->get('http://localhost:8000/api/clients');

                if ($clientsResponse->successful()) {
                    $clientes = $clientsResponse->json();

                    if ($role === 'admin') {
                        // El usuario es admin, puede agregar, visualizar y eliminar clientes
                        return view('adminClientes', ['clientes' => $clientes]);
                    } elseif ($role === 'usuario') {
                        // El usuario es solo un usuario, solo puede visualizar clientes
                        return view('usuarioClientes', ['clientes' => $clientes]);
                    } else {
                        // El usuario no tiene un rol asignado
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

        // Hacer la solicitud al proyecto X para agregar un cliente
        $response = Http::withToken($token)->post('http://localhost:8000/api/users', [
            'nombre' => $request->nombre,
            'rut' => $request->rut,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'direccion' => $request->direccion,
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Cliente agregado con éxito');
        } else {
            return redirect()->back()->withErrors(['message' => 'Error al agregar el cliente']);
        }
    }
}
