<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register_person(Request $request)
    {
        $validatedUser = $request->validate([
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validatedPerson = $request->validate([
            'name' => 'required|string|max:50',
            'pat_surname' => 'nullable|string|max:50',
            'mat_surname' => 'nullable|string|max:50',
            'ci' => 'required|numeric|unique:persons,ci',
            'birthdate' => 'required|date',
            'phone_number' => 'nullable|numeric',
            'direction' => 'nullable|string',
            'coordinates' => 'nullable|array',
            'url_picture' => 'nullable|url|max:128',
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $person = Person::Create([
                'user_id' => $user->id,
                'name' => $request->name,
                'pat_surname' => $request->pat_surname,
                'mat_surname' => $request->mat_surname,
                'ci' => $request->ci,
                'birthdate' => $request->birthdate,
                'phone_number' => $request->phone_number,
                'direction' => $request->direction,
                'coordinates' => $request->coordinates,
                'url_picture' => $request->url_picture,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Usuario y Persona creados correctamente',
                'user' => $user
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Ocurrió un error al crear el usuario y persona: ' . $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }
    
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
}
