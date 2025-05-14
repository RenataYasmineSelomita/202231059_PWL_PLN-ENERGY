<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Login extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     * This MUST match your database table name for authentication.
     */
    protected $table = 'register'; // <--- ***** CHANGE THIS *****

    /**
     * The attributes that are mass assignable.
     * Ensure these match columns in your 'register' table.
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token', // Add this, Laravel uses it
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime', // If you have this column
    ];
}