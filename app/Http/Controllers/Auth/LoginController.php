<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Menangani proses login
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validasi input dari form login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Coba login dengan kredensial yang diberikan
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Jika login berhasil, regenerate session untuk keamanan
            $request->session()->regenerate();

            // Redirect ke dashboard
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        }

        // Jika gagal login, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan data kami.',
        ]);
    }

    /**
     * Menangani proses logout
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Proses logout
        Auth::logout();

        // Menghapus data sesi pengguna
        $request->session()->invalidate();

        // Menghasilkan token sesi baru untuk keamanan
        $request->session()->regenerateToken();

        // Mengarahkan pengguna kembali ke halaman login setelah logout
        return redirect()->route('login');
    }
}

