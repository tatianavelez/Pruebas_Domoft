<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

//Registro

    public function registroapi(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['user' => $user, 'message' => 'Usuario Registrado Exitosamente'], 201);
    }


//Login
public function loginapi(Request $request)
{
// Validar
$this->validate($request, [
    'email' => 'required|email',
    'password' => 'required',
]);

$user = User::where('email', $request->email)->first();

if (!$user || !Hash::check($request->password, $user->password)) {
    throw ValidationException::withMessages([
        'email' => ['Las credenciales proporcionadas son incorrectas.'],
    ]);
}

$user->tokens()->delete();

$token = $user->createToken('authToken-' . $user->id)->plainTextToken;

return response()->json(['message' => 'Inicio de sesión exitoso', 'token' => $token, 'user' => $user]);
}




}
