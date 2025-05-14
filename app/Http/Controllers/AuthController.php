<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Login as AuthUser; // Alias for App\Models\Login
use Illuminate\Support\Facades\Hash;
use App\Models\User; // For general user data

class AuthController extends Controller
{
    // ... showLogin() and login() methods should be fine from previous response ...

    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');
        $loginField = filter_var($credentials['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$loginField => $credentials['username'], 'password' => $credentials['password']], $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'))->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'username' => 'Kredensial yang diberikan tidak cocok dengan data kami.',
        ])->onlyInput('username');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Ensure unique validation targets the 'register' table
            'email' => 'required|string|email|max:255|unique:register,email',       // <--- ***** CHANGE THIS *****
            'username' => 'required|string|max:255|unique:register,username',   // <--- ***** CHANGE THIS *****
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Create user for authentication in 'register' table
        $authUser = AuthUser::create([ // AuthUser is App\Models\Login
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password, // Will be hashed by $casts in Login model
        ]);

        // Optional: Create a corresponding record in the 'users' table for additional profile info
        // At this point, decide how you want to handle the 'users' table.
        // For now, let's assume you might create a basic record.
        // Make sure 'password' is NOT saved to the 'users' table here.
        User::create([
            'name' => $authUser->name,
            'email' => $authUser->email,       // Duplicated
            'username' => $authUser->username, // Duplicated
            // 'penugasan' => $request->input('penugasan'), // If collected during registration
            // 'position' => $request->input('position'),   // If collected during registration
        ]);

        Auth::login($authUser);

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil! Selamat datang.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}