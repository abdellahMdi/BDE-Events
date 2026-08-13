<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function signin(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 1. Find user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Email address not found in database.'
            ], 404);
        }

        // 2. Explicitly verify password hash
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Password does not match.'
            ], 401);
        }

        // 3. Load role relationship
        $user->load('role');
        $roleLabel = $user->role ? strtolower($user->role->label) : 'student';

        // 4. Issue Sanctum Token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful.',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $roleLabel,
            ],
        ], 200);
    }

    public function logout(Request $request)
    {
        try {
            $user = $request->user();

            if ($user && $user->currentAccessToken()) {
                // Delete current token
                $user->currentAccessToken()->delete();
            }

            return response()->json([
                'message' => 'Déconnexion réussie.'
            ], 200);

        } catch (\Throwable $e) {
            // Return 200 even on edge cases so client state can clear
            return response()->json([
                'message' => 'Déconnecté localement.'
            ], 200);
        }
    }
}
