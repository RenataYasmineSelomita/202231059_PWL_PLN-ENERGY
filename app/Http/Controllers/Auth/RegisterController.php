<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;  // Menambahkan impor kelas Controller
use App\Models\Register;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Menampilkan halaman register
     *
     * @return \Illuminate\View\View
     */
    public function showRegister()
    {
        return view('auth.register');  // Menampilkan form register
    }

    /**
     * Menangani pendaftaran pengguna baru
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validasi input dari form register
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',  // Validasi email unik di tabel 'users'
            'username' => 'required|string|max:255|unique:users', // Validasi username unik
            'password' => 'required|string|min:6|confirmed',  // Password harus terkonfirmasi
        ]);

        // Membuat pengguna baru dan menyimpan data ke dalam tabel 'register'
        $register = Register::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => $request->input('password'),  // Tidak menggunakan Hash untuk password
        ]);

        // Buat pengguna dengan menggunakan User model untuk login
        $user = User::create([
            'name' => $register->name,
            'email' => $register->email,
            'username' => $register->username,
            'password' => $register->password,
        ]);

        // Login otomatis setelah pendaftaran
        Auth::login($user);

        // Setelah berhasil daftar, redirect ke dashboard
        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil!');
    }
}