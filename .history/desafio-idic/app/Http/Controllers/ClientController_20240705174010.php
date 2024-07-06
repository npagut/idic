<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     //get para recibir datos, filtrados si es necesario.
    public function index(Request $request)
    {
        if($request->has('txtBuscar')){
            $clientes = Client::where('nombre', 'like', '%' . $request->txtBuscar . '%')
                        ->orWhere('rut', $request->txtBuscar)
                        ->get();
        }else{
            $clientes = Client::all();
        }
        return $clientes;
        //
    }

    /**
     * Store a newly created resource in storage.
     */

     //POST para insertar
    public function store(Request $request)
    {
        $input = $request->all();
        Client::create($input);
        return response()->json([
            'res' => true,
            'message' => 'Cliente ingresado'
        ], 200);
    }

    /**
     * Display the specified resource.
     */

     // GET para buscar x id
    public function show(Client $client)
    {
        return $client;
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
