<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Auth\ForgotPasswordController;

// Halaman utama
Route::get('/', fn() => redirect()->route('login'));

// Login/Logout
Route::get('login', [AuthLoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthLoginController::class, 'login'])->name('login.process');
Route::post('logout', [AuthLoginController::class, 'logout'])->name('logout');

// Forgot password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Middleware auth
Route::middleware(['auth'])->group(function () {

    // --- Admin ---
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'indexUsers'])->name('users.index');
        Route::get('/users/create', [AdminController::class, 'createUserForm'])->name('users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::get('/users/{user}/edit', [AdminController::class, 'editUserForm'])->name('users.edit');
        Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
        Route::get('/laporan/ta', [AdminController::class, 'laporanTugasAkhir'])->name('laporan.ta');
        Route::get('/laporan/mahasiswa/{mahasiswa}', [AdminController::class, 'laporanMahasiswa'])->name('laporan.mahasiswa');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
        Route::get('/dashboard/statistik', [AdminController::class, 'dashboardStats'])->name('dashboard.stats');
    });

    // --- Dosen ---
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
     Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('dashboard');
        Route::get('/judul/persetujuan', [DosenController::class, 'listPersetujuan'])->name('judul.list');
        Route::post('/judul/{tugasAkhir}/approve', [DosenController::class, 'approveJudul'])->name('judul.approve');
        Route::post('/judul/{tugasAkhir}/reject', [DosenController::class, 'rejectJudul'])->name('judul.reject');
        Route::get('/log-bimbingan', [DosenController::class, 'listBimbingan'])->name('bimbingan.log.index');
        Route::post('/log-bimbingan/{bimbingan}/proses', [DosenController::class, 'prosesBimbingan'])->name('bimbingan.proses');
        Route::get('/ta/{tugasAkhir}/grading', [DosenController::class, 'showGradingForm'])->name('grading.form');
        Route::post('/ta/{tugasAkhir}/grading', [DosenController::class, 'submitGrading'])->name('grading.submit');
        Route::get('/mahasiswa-bimbingan', [DosenController::class, 'mahasiswaBimbingan'])->name('mahasiswa.bimbingan');
        Route::get('/bimbingan/mahasiswa/{mahasiswa}', [DosenController::class, 'detailBimbingan'])->name('bimbingan.detail');
        Route::get('/mahasiswa-bimbingan/{mahasiswa}', [DosenController::class, 'profileMahasiswa'])->name('mahasiswa.profile');
    });

    // --- Mahasiswa ---
    Route::middleware(['role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('dashboard');
        Route::get('/judul/ajukan', [MahasiswaController::class, 'showFormPengajuan'])->name('judul.form');
        Route::post('/judul/ajukan', [MahasiswaController::class, 'submitPengajuan'])->name('judul.submit');
        Route::post('/bimbingan/submit', [MahasiswaController::class, 'submitBimbingan'])->name('bimbingan.submit');
        Route::get('/bimbingan/riwayat', [MahasiswaController::class, 'riwayatBimbingan'])->name('bimbingan.riwayat');
        Route::get('/ta/laporan', [MahasiswaController::class, 'laporanTA'])->name('ta.laporan');
    });

    // --- Profil & Pengaturan ---
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [AuthLoginController::class, 'showProfile'])->name('show');
        Route::post('/update', [AuthLoginController::class, 'updateProfile'])->name('update');
        Route::get('/settings', [AuthLoginController::class, 'settings'])->name('settings');
        Route::post('/settings', [AuthLoginController::class, 'updateSettings'])->name('settings.update');
    });

    // --- Pesan ---
    Route::prefix('pesan')->name('messages.')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('index');
        Route::get('/kirim', [MessageController::class, 'create'])->name('create');
        Route::post('/', [MessageController::class, 'store'])->name('store');
        Route::get('/{conversation}', [MessageController::class, 'show'])->name('show');
        Route::post('/{conversation}/reply', [MessageController::class, 'reply'])->name('reply');
    });

    // --- Notifikasi ---
    Route::prefix('notifikasi')->name('notifications.')->group(function () {
        Route::get('/', [MessageController::class, 'notifications'])->name('index');
        Route::post('/mark-read/{id}', [MessageController::class, 'markAsRead'])->name('mark.read');
    });
});

// Halaman umum
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/contact', fn() => view('contact'))->name('contact');
