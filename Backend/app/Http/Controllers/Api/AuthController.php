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
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logged out successfully.',
        ], 200);
    }
}
