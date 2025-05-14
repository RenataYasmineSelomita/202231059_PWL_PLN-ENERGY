<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    // Pastikan semua kolom yang Anda kirim dari form dan ingin disimpan ada di sini
    // dan TIDAK ADA kolom bernama 'tugas' di sini KECUALI memang ada di tabel database
    // dan Anda memang mengirimkan nilainya.
    protected $fillable = [
        'user_id',
        'nama',         // Ini adalah nama/judul tugas
        'email',
        'deskripsi',    // Ini adalah deskripsi detail tugas
        'lokasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'waktu_mulai',
        'waktu_selesai',
        'status_tugas',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}