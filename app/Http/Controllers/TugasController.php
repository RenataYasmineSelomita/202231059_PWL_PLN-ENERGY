<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TugasExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class TugasController extends Controller
{
    public function index()
    {
        try {
            $tugas = Tugas::with('user')
                          ->orderBy('tanggal_mulai', 'desc')
                          ->orderBy('created_at', 'desc')
                          ->paginate(10);
            return view('tugas.index', compact('tugas'));
        } catch (\Exception $e) {
            Log::error("Error di TugasController@index: " . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memuat daftar tugas. Silakan coba lagi.');
        }
    }

    public function create()
    {
        try {
            $pegawaiYantek = User::where('position', 'yantek')
                                ->orderBy('name', 'asc')
                                ->get(['id', 'name', 'username']);
            return view('tugas.create', compact('pegawaiYantek'));
        } catch (\Exception $e) {
            Log::error("Error di TugasController@create: " . $e->getMessage());
            return redirect()->route('tugas.index')->with('error', 'Gagal membuka form tambah tugas.');
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'deskripsi' => 'required|string|min:10',
            'lokasi' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'status_tugas' => ['nullable', Rule::in(['baru', 'dikerjakan', 'selesai', 'pending', 'batal'])],
        ]);

        if (empty($validatedData['status_tugas'])) {
            $validatedData['status_tugas'] = 'baru';
        }

        try {
            $tugas = Tugas::create($validatedData);

            if ($request->user_id) {
                $user = User::find($request->user_id);
                if ($user && $user->status !== 'sudah ditugaskan') {
                    $user->status = 'sudah ditugaskan';
                    $user->save();
                }
            }

            return redirect()->route('tugas.index')->with('success', 'Tugas berhasil ditambahkan dan ditugaskan.');

        } catch (\Exception $e) {
            Log::error("Error di TugasController@store: " . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan tugas: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $tugas = Tugas::with('user')->findOrFail($id);
            return view('tugas.show', compact('tugas'));
        } catch (\Exception $e) {
            Log::error("Error di TugasController@show untuk Tugas ID {$id}: " . $e->getMessage());
            return redirect()->route('tugas.index')->with('error', 'Gagal menampilkan detail tugas.');
        }
    }

    public function edit($id)
    {
        try {
            $tugas = Tugas::findOrFail($id);
            $pegawaiYantek = User::where('position', 'yantek')
                              ->orderBy('name', 'asc')
                              ->get(['id', 'name', 'username']);
            return view('tugas.edit', compact('tugas', 'pegawaiYantek'));
        } catch (\Exception $e) {
            Log::error("Error di TugasController@edit untuk Tugas ID {$id}: " . $e->getMessage());
            return redirect()->route('tugas.index')->with('error', 'Gagal membuka form edit tugas.');
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'deskripsi' => 'required|string|min:10',
            'lokasi' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'status_tugas' => ['required', Rule::in(['baru', 'dikerjakan', 'selesai', 'pending', 'batal'])],
        ]);

        try {
            $tugas = Tugas::findOrFail($id);
            $oldUserId = $tugas->user_id;

            $tugas->update($validatedData);

            if ($oldUserId && $oldUserId != $request->user_id) {
                $oldUser = User::find($oldUserId);
                if ($oldUser && $oldUser->daftarTugas()->where('id', '!=', $tugas->id)->whereNotIn('status_tugas', ['selesai', 'batal'])->count() == 0) {
                    $oldUser->status = 'belum ditugaskan';
                    $oldUser->save();
                }
            }
            if ($request->user_id) {
                $newUser = User::find($request->user_id);
                if ($newUser && $newUser->status !== 'sudah ditugaskan') {
                    $newUser->status = 'sudah ditugaskan';
                    $newUser->save();
                }
            }

            return redirect()->route('tugas.index')->with('success', 'Tugas berhasil diperbarui.');

        } catch (\Exception $e) {
            Log::error("Error di TugasController@update untuk Tugas ID {$id}: " . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui tugas: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $tugas = Tugas::findOrFail($id);
            $userId = $tugas->user_id;

            $tugas->delete();

            if ($userId) {
                $user = User::find($userId);
                if ($user && $user->daftarTugas()->whereNotIn('status_tugas', ['selesai', 'batal'])->count() == 0) {
                    $user->status = 'belum ditugaskan';
                    $user->save();
                }
            }

            return redirect()->route('tugas.index')->with('success', 'Tugas berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error("Error di TugasController@destroy untuk Tugas ID {$id}: " . $e->getMessage());
            return redirect()->route('tugas.index')->with('error', 'Gagal menghapus tugas.');
        }
    }
}