<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('name', 'password'))) {
            $user = Auth::user();

            // Generate and retrieve the token
            $token = $user->createToken('auth_token')->plainTextToken;

            // Create a custom response structure
            $response = [
                "id" => $user->id,
                "name" => $user->name,
                "created_at" => $user->created_at,
                "updated_at" => $user->updated_at,
                "token" => $token,
            ];

            return response()->json($response, 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
