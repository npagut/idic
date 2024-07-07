<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        User::create($input);
        return response()->json([
            'res' => true,
            'message' => 'Usuario creado Exitosamente!'
        ], 200);
    }

    public function login(Request $request)
    {
        // Validar los datos de entrada
        $credentials = $request->only('email', 'password');

        // Intentar autenticar al usuario y obtener el token
        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Respuesta exitosa con el token
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60,
        ]);
    }

    public function loginMantenedor()
    {
        return view('loginUser'); // Vista del formulario
    }
    public function index(Request $request)
    {
        // Verificar si existe un token válido en el encabezado de la solicitud
        if ($request->bearerToken()) {
            // Obtener y devolver los datos de clientes solo si el token es válido
            if ($request->has('txtBuscar')) {
                $usuarios = User::where('nombre', 'like', '%' . $request->txtBuscar . '%')
                    ->orWhere('rut', $request->txtBuscar)
                    ->get();
            } else {
                $usuarios = User::all();
            }

            return response()->json($usuarios);
        }

        // Devolver una respuesta de error si no se proporciona un token válido
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    //
}
