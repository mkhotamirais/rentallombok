<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate
        $fields = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|min:8',
        ]);

        // Try to login
        if (Auth::attempt($fields, $request->remember)) {
            // return redirect()->intended();
            return redirect()->route('dashboard');
        } else {
            return back()->with('error', 'The provided credentials are incorrect.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
