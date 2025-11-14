<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MessageController; // IMPORT BARU

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Halaman utama (redirect ke login)
Route::get('/', function () {
    return redirect()->route('login');
});

// Autentikasi
Route::get('login', [AuthLoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthLoginController::class, 'login']);
Route::post('logout', [AuthLoginController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| ROLE-BASED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // --- Rute Pesan (Dapat diakses oleh semua peran) ---
    Route::prefix('pesan')->name('messages.')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('index'); // Pesan Masuk
        Route::get('/kirim', [MessageController::class, 'create'])->name('create'); // Formulir Kirim Pesan
        Route::post('/', [MessageController::class, 'store'])->name('store'); // Aksi Kirim Pesan
        // Tambahkan rute untuk melihat detail pesan/percakapan jika diperlukan:
        // Route::get('/{conversation}', [MessageController::class, 'show'])->name('show');
    });
    // --------------------------------------------------

    // --- Admin Routes ---
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // CRUD Users
        Route::get('/users', [AdminController::class, 'indexUsers'])->name('users.index');
        Route::get('/users/create', [AdminController::class, 'createUserForm'])->name('users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::get('/users/{user}/edit', [AdminController::class, 'editUserForm'])->name('users.edit');
        Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');

        // Laporan Global Tugas Akhir
        Route::get('/laporan/ta', [AdminController::class, 'laporanTugasAkhir'])->name('laporan.ta');

        // Penetapan Dosen Pembimbing 2
        Route::get('/ta/{tugasAkhir}/set-dosen', [AdminController::class, 'showSetDosenForm'])->name('dosen.set.form');
        Route::post('/ta/{tugasAkhir}/set-dosen', [AdminController::class, 'submitSetDosen'])->name('dosen.set.submit');
    });

    // --- Mahasiswa Routes ---
    Route::middleware(['role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('dashboard');

        // Pengajuan Judul
        Route::get('/judul/ajukan', [MahasiswaController::class, 'showFormPengajuan'])->name('judul.form');
        Route::post('/judul/ajukan', [MahasiswaController::class, 'submitPengajuan'])->name('judul.submit');

        // Pengajuan Bimbingan
        Route::post('/bimbingan/submit', [MahasiswaController::class, 'submitBimbingan'])->name('bimbingan.submit');
    });

    // --- Dosen Routes ---
    Route::middleware(['role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
        Route::get('/dashboard', [DosenController::class, 'dashboard'])->name('dashboard');

        // Persetujuan Judul
        Route::get('/judul/persetujuan', [DosenController::class, 'listPersetujuan'])->name('judul.list');
        Route::post('/judul/{tugasAkhir}/approve', [DosenController::class, 'approveJudul'])->name('judul.approve');
        Route::post('/judul/{tugasAkhir}/reject', [DosenController::class, 'rejectJudul'])->name('judul.reject');

        // Bimbingan
        Route::get('/log-bimbingan', [DosenController::class, 'listBimbingan'])->name('bimbingan.log.index');
        Route::post('/log-bimbingan/{bimbingan}/proses', [DosenController::class, 'prosesBimbingan'])->name('bimbingan.proses');

        // Penilaian
        Route::get('/ta/{tugasAkhir}/grading', [DosenController::class, 'showGradingForm'])->name('grading.form');
        Route::post('/ta/{tugasAkhir}/grading', [DosenController::class, 'submitGrading'])->name('grading.submit');

        // Daftar Mahasiswa Bimbingan
        Route::get('/mahasiswa-bimbingan', [DosenController::class, 'mahasiswaBimbingan'])->name('mahasiswa.bimbingan');
    });

    // Rute default setelah login (diarahkan oleh Authenticate.php)
    Route::get('/home', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->role === 'dosen') {
            return redirect()->route('dosen.dashboard');
        } elseif (auth()->user()->role === 'mahasiswa') {
            return redirect()->route('mahasiswa.dashboard');
        }
        return redirect()->route('login'); // Fallback
    })->name('home');
});
