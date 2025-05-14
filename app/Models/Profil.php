<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Profil extends Authenticatable
{
    protected $table = 'register'; // Gunakan tabel users2

    protected $fillable = [
        'name', 'email', 'username', 'lokasi', 'password'
    ];
}
