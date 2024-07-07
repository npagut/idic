<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
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
        if (session()->has('access_token')) {
            $token = session('access_token');
        } else {
            $response = $this->login($request);
            if ($response->status() >= 200 && $response->status() < 300) {
                $token = $response->getData()->access_token;
                session(['access_token' => $token]);
            } else {
                return back()->withErrors(['message' => 'Credenciales inválidas']);
            }
        }

        // Realizar una solicitud HTTP para obtener los usuarios
        try {
            $response = Http::withToken($token)->timeout(60)->get('http://127.0.0.1:8000/api/usuarios');

            if ($response->successful()) {
                $users = $response->json(); // Obtener los usuarios en formato JSON
                return view('mantenedorUsuarios', compact('users'));
            } else {
                return back()->withErrors(['message' => 'Error al obtener los usuarios']);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Error en la solicitud: ' . $e->getMessage()]);
        }
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'rol' => 'required|in:admin,usuario,supervisor',
        ]);

        $user->rol = $request->rol;
        $user->save();

        // Obtener todos los usuarios actualizados
        $users = User::all();

        return view('mantenedorUsuarios', compact('users'))->with('success', 'Rol actualizado correctamente.');
    }

    public function getAllUsers()
{
    $users = User::all();
    return response()->json($users, 200);
}

    //
}
