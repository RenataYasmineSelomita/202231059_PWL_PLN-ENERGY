<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pengaduan = session('pengaduan', [
            ['id' => 1, 'nama' => 'Budi', 'isi' => 'Listrik padam di wilayah saya.'],
            ['id' => 2, 'nama' => 'Siti', 'isi' => 'Meteran tidak terbaca sejak 2 bulan.'],
        ]);

        session(['pengaduan' => $pengaduan]);
        return view('dashboard', compact('pengaduan'));
    }

    public function edit($id)
    {
        $pengaduan = collect(session('pengaduan'))->firstWhere('id', $id);
        return view('edit', compact('pengaduan'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('nama', 'isi');
        $pengaduan = collect(session('pengaduan'))->map(function ($item) use ($id, $data) {
            if ($item['id'] == $id) {
                return array_merge($item, $data);
            }
            return $item;
        })->toArray();

        session(['pengaduan' => $pengaduan]);
        return redirect()->route('dashboard');
    }

    public function destroy($id)
    {
        $pengaduan = collect(session('pengaduan'))->reject(function ($item) use ($id) {
            return $item['id'] == $id;
        })->values()->toArray();

        session(['pengaduan' => $pengaduan]);
        return redirect()->route('dashboard');
    }
}
