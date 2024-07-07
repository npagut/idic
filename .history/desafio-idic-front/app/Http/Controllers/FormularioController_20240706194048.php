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
        // Verificar si ya existe un token de acceso en la sesión
        if (session()->has('access_token')) {
            $token = session('access_token');
        } else {
            // Si no existe un token en la sesión, intentar autenticar nuevamente
            $response = Http::post('http://localhost:8000/api/login', [
                'email' => $request->email,
                'password' => $request->password,
            ]);

            if ($response->successful()) {
                $token = $response->json()['access_token'];
                session(['access_token' => $token]);
            } else {
                return back()->withErrors(['message' => 'Credenciales inválidas']);
            }
        }

        // Realizar solicitudes utilizando el token de acceso
        $userResponse = Http::withToken($token)->get('http://localhost:8000/api/user');

        if ($userResponse->successful()) {
            $user = $userResponse->json();
            $rol = $user['rol'];

            $clientsResponse = Http::withToken($token)->get('http://localhost:8000/api/clients');

            if ($clientsResponse->successful()) {
                $clientes = $clientsResponse->json();

                if ($rol === 'admin') {
                    return view('adminClientes', ['clientes' => $clientes]);
                } elseif ($rol === 'usuario') {
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
    }


    public function storeCliente(Request $request)
    {
        $token = session('access_token');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('http://localhost:8000/api/clients', [
            'nombre' => $request['nombre'],
            'rut' => $request['rut'],
            'telefono' => $request['telefono'],
            'email' => $request['email'],
            'direccion' => $request['direccion'],
        ]);

        if ($response->successful()) {
            return $this->enviarFormulario($request);
        } else {

            return redirect()->back()->withErrors(['message' => 'Error al agregar el cliente']);
        }
    }

    public function eliminar($id)
    {
        // Obtener el token de la sesión actual o manejarlo como lo hiciste anteriormente
        $token = session('access_token');

        // Realizar la solicitud DELETE a la API del proyecto X
        $response = Http::withToken($token)->delete("http://localhost:8000/api/clients/{$id}");

        if ($response->successful()) {
            // Volver a cargar la lista de clientes después de eliminar
            return $this->enviarFormulario(request());
        } else {
            return redirect()->back()->withErrors(['message' => 'Error al eliminar el cliente.']);
        }
    }

    public function update(Request $request, $id)
    {
        // Validar los datos entrantes
        $request->validate([
            'direccion' => 'required|string',
            'telefono' => 'required|string',
        ]);

        // Obtener el token de sesión
        $token = session('access_token');

        // Realizar la solicitud PUT a la API del proyecto X
        $response = Http::withToken($token)->put('http://localhost:8000/api/clients/' . $id, [
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
        ]);

        // Verificar si la solicitud fue exitosa
        if ($response->successful()) {
            // Redirigir de vuelta a la página anterior con mensaje de éxito
            return redirect()->back()->with('success', 'Cliente actualizado correctamente.');
        } else {
            // Manejar el error en caso de falla
            return back()->withErrors(['message' => 'Error al actualizar el cliente.']);
        }
    }

}
