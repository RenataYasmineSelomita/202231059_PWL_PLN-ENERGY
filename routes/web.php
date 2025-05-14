<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\ProfilController;
// use App\Http\Controllers\PengaduanController; // Uncomment jika dibuat dan digunakan

// Redirect root to login page
Route::get('/', function () {
    return redirect()->route('login');
});

// Public routes - accessible without login
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.submit');
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register')->name('register.submit');
});

// Handle the default /home redirect (Laravel's default)
Route::get('/home', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
})->name('home');

// Protected routes (require authentication)
Route::middleware('auth')->group(function () {
    // Logout route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User management routes
    Route::resource('user', UserController::class)->except(['show']);
    Route::get('/user/export-excel', [UserController::class, 'exportExcel'])->name('user.exportExcel');
    Route::get('/user/export-pdf', [UserController::class, 'exportPDF'])->name('user.exportPDF');

    // Routes for managing tugas - Explicitly define parameter name
    Route::resource('tugas', TugasController::class)->parameters([
        'tugas' => 'id'
    ]);

    Route::get('/tugas/export/excel', [TugasController::class, 'exportExcel'])->name('tugas.export.excel');
    Route::get('/tugas/export/pdf', [TugasController::class, 'exportPDF'])->name('tugas.export.pdf');

    // Routes for profile management
    Route::prefix('profil')->name('profil.')->controller(ProfilController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/edit', 'edit')->name('profil.edit');
        Route::put('/update', 'update')->name('update');
        Route::get('/reset-password', 'showResetPasswordForm')->name('reset-password.form');
        Route::post('/reset-password', 'resetPassword')->name('reset-password.submit');
    });
});