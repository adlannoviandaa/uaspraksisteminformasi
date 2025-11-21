<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Auth\ForgotPasswordController;

// =======================================
// AUTH
// =======================================
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthLoginController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthLoginController::class, 'logout'])->name('logout');

// Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

// =======================================
// ROUTES YANG BUTUH LOGIN
// =======================================
Route::middleware(['auth'])->group(function () {

    // ===========================
    // ADMIN AREA
    // ===========================
    Route::middleware(['role:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

            Route::resource('users', AdminController::class)->except(['show']);

            Route::get('/laporan/ta', [AdminController::class, 'laporanTugasAkhir'])->name('laporan.ta');
            Route::get('/laporan/mahasiswa/{mahasiswa}', [AdminController::class, 'laporanMahasiswa'])
                ->name('laporan.mahasiswa');

            Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
            Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
        });

    // ===========================
// DOSEN AREA
// ===========================
Route::middleware(['role:dosen'])
    ->prefix('dosen')
    ->name('dosen.')
    ->group(function () {

        Route::get('/dashboard', [DosenController::class, 'dashboard'])->name('dashboard');

        // Tambahan agar cocok dengan layout
        Route::get('/review', [DosenController::class, 'listPersetujuan'])->name('review.index');

        Route::get('/judul/persetujuan', [DosenController::class, 'listPersetujuan'])
            ->name('judul.persetujuan');
        Route::post('/judul/{tugasAkhir}/approve', [DosenController::class, 'approveJudul'])
            ->name('judul.approve');
        Route::post('/judul/{tugasAkhir}/reject', [DosenController::class, 'rejectJudul'])
            ->name('judul.reject');

        Route::get('/log-bimbingan', [DosenController::class, 'listBimbingan'])
            ->name('bimbingan.log');
        Route::post('/log-bimbingan/{bimbingan}/proses', [DosenController::class, 'prosesBimbingan'])
            ->name('bimbingan.proses');

        Route::get('/ta/{tugasAkhir}/grading', [DosenController::class, 'showGradingForm'])
            ->name('grading.form');
        Route::post('/ta/{tugasAkhir}/grading', [DosenController::class, 'submitGrading'])
            ->name('grading.submit');

        Route::get('/mahasiswa-bimbingan', [DosenController::class, 'mahasiswaBimbingan'])
            ->name('mahasiswa.bimbingan');
        Route::get('/bimbingan/mahasiswa/{mahasiswa}', [DosenController::class, 'detailBimbingan'])
            ->name('bimbingan.detail');
        Route::get('/mahasiswa-bimbingan/{mahasiswa}', [DosenController::class, 'profileMahasiswa'])
            ->name('mahasiswa.profile');
    });

    // ===========================
    // MAHASISWA AREA
    // ===========================
    Route::middleware(['role:mahasiswa'])
        ->prefix('mahasiswa')
        ->name('mahasiswa.')
        ->group(function () {

            Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('dashboard');

            Route::get('/judul/ajukan', [MahasiswaController::class, 'showFormPengajuan'])
                ->name('judul.form');
            Route::post('/judul/ajukan', [MahasiswaController::class, 'submitPengajuan'])
                ->name('judul.submit');

            Route::get('/bimbingan/riwayat', [MahasiswaController::class, 'riwayatBimbingan'])
                ->name('bimbingan.riwayat');
            Route::post('/bimbingan/submit', [MahasiswaController::class, 'submitBimbingan'])
                ->name('bimbingan.submit');

            Route::get('/ta/laporan', [MahasiswaController::class, 'laporanTA'])
                ->name('ta.laporan');
        });

    // ===========================
    // PROFIL USER
    // ===========================
    Route::prefix('profile')
        ->name('profile.')
        ->group(function () {
            Route::get('/', [AuthLoginController::class, 'showProfile'])->name('show');
            Route::post('/update', [AuthLoginController::class, 'updateProfile'])->name('update');
            Route::get('/settings', [AuthLoginController::class, 'settings'])->name('settings');
            Route::post('/settings', [AuthLoginController::class, 'updateSettings'])->name('settings.update');
        });

    // ===========================
    // PESAN
    // ===========================
    Route::prefix('pesan')
        ->name('messages.')
        ->group(function () {
            Route::get('/', [MessageController::class, 'index'])->name('index');
            Route::get('/kirim', [MessageController::class, 'create'])->name('create');
            Route::post('/', [MessageController::class, 'store'])->name('store');
            Route::get('/{conversation}', [MessageController::class, 'show'])->name('show');
            Route::post('/{conversation}/reply', [MessageController::class, 'reply'])->name('reply');
        });

    // ===========================
    // NOTIFIKASI
    // ===========================
    Route::prefix('notifikasi')
        ->name('notifications.')
        ->group(function () {
            Route::get('/', [MessageController::class, 'notifications'])->name('index');
            Route::post('/mark-read/{id}', [MessageController::class, 'markAsRead'])->name('mark.read');
        });
});

// =======================================
// PUBLIC PAGES
// =======================================
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
