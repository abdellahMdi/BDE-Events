<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 1. Return a 401 error if authentication fails
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'The provided credentials do not match our records.'
            ], 401);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 2. Safely resolve role (whether 'role' is a relationship or a database string column)
        $roleLabel = 'student';
        if ($user->relationLoaded('role') || method_exists($user, 'role')) {
            $user->load('role');
            $roleLabel = $user->role ? strtolower($user->role->label ?? $user->role) : 'student';
        } elseif (is_string($user->role)) {
            $roleLabel = strtolower($user->role);
        }

        // 3. Generate Sanctum API token required by React
        $token = $user->createToken('auth_token')->plainTextToken;

        // 4. Return token alongside user data
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
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logged out successfully.',
        ], 200);
    }
}
