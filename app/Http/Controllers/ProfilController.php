<?php

namespace App\Http\Controllers;

use App\Models\User;       // Pastikan model User di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
// use Illuminate\Support\Facades\Hash; // Untuk update password, jika diperlukan nanti
// use Illuminate\Validation\Rules\Password; // Untuk validasi password, jika diperlukan nanti

class ProfilController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna yang sedang login.
     */
    public function index(): View
    {
        $user = Auth::user(); // Mengambil data pengguna yang sedang login
        return view('profil.index', compact('user'));
    }

    /**
     * Menampilkan form untuk mengedit profil pengguna yang sedang login.
     */
    public function edit(): View
    {
        $user = Auth::user(); // Mengambil data pengguna yang sedang login
        return view('profil.edit', compact('user'));
    }

    /**
     * Memperbarui profil pengguna yang sedang login.
     */
    public function update(Request $request)
    {
        $user = Auth::user(); // Mengambil objek pengguna yang sedang login

        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // Email harus unik di tabel users, KECUALI untuk ID user saat ini
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Username juga harus unik, KECUALI untuk ID user saat ini (jika username digunakan dan bisa diedit)
            'username' => 'nullable|string|max:255|unique:users,username,' . $user->id,
            'lokasi' => 'nullable|string|max:255',
            // Tambahkan validasi untuk 'position' dan 'penugasan' jika bisa diedit oleh user
        ]);

        // Update data pengguna
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        // Hanya update jika field diisi dan berbeda
        if ($request->filled('username') && $user->username !== $validatedData['username']) {
            $user->username = $validatedData['username'];
        }
        if ($request->filled('lokasi') && $user->lokasi !== $validatedData['lokasi']) {
            $user->lokasi = $validatedData['lokasi'];
        }
        // Contoh jika 'position' bisa diedit (hati-hati dengan ini, bisa jadi isu keamanan)
        // if ($request->filled('position') && $user->position !== $request->input('position')) {
        //     $user->position = $request->input('position');
        // }

        $user->save(); // Simpan perubahan

        return redirect()->route('profil.index')->with('success', 'Profil berhasil diperbarui!');
    }
}