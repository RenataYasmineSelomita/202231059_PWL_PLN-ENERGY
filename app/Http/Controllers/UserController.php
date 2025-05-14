<?php

namespace App\Http\Controllers;

use App\Models\User; // Pastikan ini adalah model yang benar, bisa juga App\Models\Pegawai jika Anda rename
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport; // Jika Anda rename model, export juga perlu disesuaikan
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    protected function getPenugasanOptions(): array
    {
        return [
            'Menangani laporan gangguan listrik dari pelanggan',
            'Melakukan perbaikan instalasi listrik di rumah pelanggan',
            'Melakukan pemasangan sambungan baru bagi pelanggan',
            'Melakukan inspeksi dan pemeliharaan jaringan listrik',
            'Meningkatkan kualitas pelayanan dan menjaga keandalan distribusi listrik'
        ];
    }

    public function index()
    {
        // Jika model Anda menjadi Pegawai, ganti User:: menjadi Pegawai::
        $users = User::orderBy('name', 'asc')->get();
        // Atau jika Anda membuat variabel $pegawai
        // $pegawai = User::orderBy('name', 'asc')->get();
        // return view('user.index', compact('pegawai')); // dan kirim 'pegawai'
        return view('user.index', compact('users')); // Untuk saat ini, tetap 'users' agar view tidak error dulu
    }

    public function create()
    {
        $penugasanOptions = $this->getPenugasanOptions();
        return view('user.create', compact('penugasanOptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'penugasan' => 'nullable|array',
            'penugasan.*' => 'string',
            'status' => ['required', Rule::in(['sudah ditugaskan', 'belum ditugaskan'])],
        ]);

        $data = $request->only(['name', 'username', 'email', 'password', 'penugasan', 'status']);
        $data['password'] = Hash::make($request->password);
        $data['position'] = 'yantek';

        if (!$request->has('penugasan') || empty($request->penugasan)) {
            $data['penugasan'] = null;
        } else {
            $validPenugasan = array_intersect((array)$request->penugasan, $this->getPenugasanOptions());
            $data['penugasan'] = !empty($validPenugasan) ? array_values($validPenugasan) : null;
        }

        User::create($data);

        return redirect()->route('user.index')->with('success', 'Pegawai Pelayanan Teknik berhasil ditambahkan.');
    }

    public function edit(User $user) // Jika model jadi Pegawai, ganti User $user menjadi Pegawai $pegawai
    {
        $penugasanOptions = $this->getPenugasanOptions();
        // return view('user.edit', compact('pegawai', 'penugasanOptions'));
        return view('user.edit', compact('user', 'penugasanOptions')); // Tetap 'user' untuk konsistensi dengan view yang dikirim
    }

    public function update(Request $request, User $user) // Jika model jadi Pegawai, ganti User $user
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'penugasan' => 'nullable|array',
            'penugasan.*' => 'string',
            'status' => ['required', Rule::in(['sudah ditugaskan', 'belum ditugaskan'])],
        ]);

        $dataToUpdate = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'status' => $request->status,
        ];

        if ($request->filled('password')) {
            $dataToUpdate['password'] = Hash::make($request->password);
        }

        if (!$request->has('penugasan') || empty($request->penugasan)) {
            $dataToUpdate['penugasan'] = null;
        } else {
            $validPenugasan = array_intersect((array)$request->penugasan, $this->getPenugasanOptions());
            $dataToUpdate['penugasan'] = !empty($validPenugasan) ? array_values($validPenugasan) : null;
        }

        $user->update($dataToUpdate);

        return redirect()->route('user.index')->with('success', 'Data Pegawai Pelayanan Teknik berhasil diperbarui.');
    }

    public function destroy(User $user) // Jika model jadi Pegawai, ganti User $user
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Data Pegawai berhasil dihapus.');
    }

    public function exportExcel()
    {
        // $usersQuery = User::where('position', 'yantek');
        // return Excel::download(new UsersExport($usersQuery), 'data_pegawai_yantek.xlsx');
        // Atau jika UsersExport sudah diatur untuk mengambil data Pegawai
        return Excel::download(new UsersExport, 'data_pegawai.xlsx');
    }

    public function exportPDF()
    {
        // $pegawai = User::where('position', 'yantek')->get();
        $pegawai = User::all(); // Asumsi Anda masih menggunakan model User untuk data pegawai
        // Jika nama view PDF adalah user.pdf, biarkan, atau ganti ke pegawai.pdf jika ada
        $pdf = PDF::loadView('user.pdf', ['users' => $pegawai]); // Mengirim dengan key 'users' jika view PDF mengharapkannya
        return $pdf->download('Daftar Pegawai Pelayanan Teknik PLN.pdf');
    }
}