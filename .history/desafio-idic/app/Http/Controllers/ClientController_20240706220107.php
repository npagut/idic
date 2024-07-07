<?php

namespace App\Http\Controllers;

use App\Http\Resources\AgregarClienteRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    //get para recibir datos, filtrados si es necesario.
    public function index(Request $request)
    {
        // Verificar si existe un token válido en el encabezado de la solicitud
        if ($request->bearerToken()) {
            // Obtener y devolver los datos de clientes solo si el token es válido
            if ($request->has('txtBuscar')) {
                $clientes = Client::where('nombre', 'like', '%' . $request->txtBuscar . '%')
                    ->orWhere('rut', $request->txtBuscar)
                    ->get();
            } else {
                $clientes = Client::all();
            }

            return response()->json($clientes);
        }

        // Devolver una respuesta de error si no se proporciona un token válido
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    //POST para insertar
    public function store(AgregarClienteRequest $request)
    {
        $input = $request->all();
        Client::create($input);
        return response()->json([
            'res' => true,
            'message' => 'Cliente ingresado'
        ], 200);
    }

    // GET para buscar x id
    public function show(Client $client)
    {
        return $client;
    }

    public function update(Request $request, $id)
    {
        // Validar los datos entrantes
        $request->validate([
            'direccion' => 'required|string',
            'telefono' => 'required|string',
        ]);

        try {
            // Buscar el cliente por su ID
            $cliente = Client::findOrFail($id);

            // Actualizar los campos de dirección y teléfono
            $cliente->update([
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
            ]);

            // Redirigir con un mensaje de éxito
            return redirect()->back()->with('success', 'Cliente actualizado correctamente.');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['message' => 'Error al actualizar el cliente.']);
        }
    }
    public function destroy(string $id)
    {

        $client = Client::find($id);

        if (!$client) {
            return response()->json([
                'message' => 'Cliente no encontrado'
            ], 404);
        }

        $client->delete();

        return response()->json([
            'message' => 'Cliente eliminado correctamente'
        ], 200);
    }
}
