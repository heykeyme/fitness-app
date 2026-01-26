<?php

namespace App\Http\Controllers;

use App\Models\User; // Added for User model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Added for Hash facade

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Redirect based on Role ID
            if ($user->role_id == 1) {
                return redirect()->intended('/admin/dashboard');
            }
            return redirect()->intended('/member/home');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        // 1. Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Create User (Notice role_id is hardcoded to 2 for Members)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2, 
        ]);

        // 3. Log them in automatically
        Auth::login($user);

        return redirect('/member/home')->with('success', 'You have been successfully registered!');
    }

}
