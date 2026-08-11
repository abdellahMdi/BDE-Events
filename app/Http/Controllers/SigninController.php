<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SigninController extends Controller
{

    public function showPage()
    {
        return view('auth.signin');
    }

    public function first()
    {
        return redirect()->route('login');
    }

    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role) {
                $role = strtolower($user->role->label);

                if ($user->role->label === 'admin') {
                    return redirect()->route('adminDashboard');
                }

                if ($user->role->label === 'student') {
                    return redirect()->route('dashboardStudent');
                }
            }

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The email or password you entered is incorrect.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
