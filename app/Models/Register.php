<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;

    // Define the table name explicitly (since it's 'register', not the default 'users')
    protected $table = 'register';

    // The attributes that are mass assignable.
    protected $fillable = [
        'name', 'email', 'username', 'password'
    ];

    // Ensure the password is always hashed before saving
    protected $hidden = [
        'password', // So the password is not exposed
    ];
}
