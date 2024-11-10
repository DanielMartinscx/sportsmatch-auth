<?php

namespace App\Http\Controllers\API;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    

    public function login(Request $request)
    {
        // Validação dos dados de entrada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            // Obtém o usuário autenticado
            $person = Auth::user(); // Aqui definimos $person como o usuário autenticado
            $token = $person->createToken('API Token')->plainTextToken;
           
            return response()->json([
            'token' => $token, 
            'id' => $person->id,
            'name' => $person->name,
            'message' => 'Autorizado'], 200);
        }
    
        return response()->json(['message' => 'Credenciais inválidas'], 401);

    }
}

