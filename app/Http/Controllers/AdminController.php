<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\TugasAkhir;
use App\Models\Bimbingan;

class AdminController extends Controller
{
    /**
     * Menampilkan dashboard utama untuk Admin.
     */
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalDosen = User::where('role', 'dosen')->count();
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();

        // Statistik Tugas Akhir
        $totalTA = TugasAkhir::count();
        $taDiajukan = TugasAkhir::where('status', 'Diajukan')->count();
        $taDiterima = TugasAkhir::where('status', 'Diterima')->count();
        $taDitolak = TugasAkhir::where('status', 'Ditolak')->count();
        $taSelesai = TugasAkhir::where('status', 'Selesai')->count();


        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAdmin',
            'totalDosen',
            'totalMahasiswa',
            'totalTA',
            'taDiajukan',
            'taDiterima',
            'taDitolak',
            'taSelesai'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | MANAJEMEN PENGGUNA (CRUD)
    |--------------------------------------------------------------------------
    */

    /**
     * Menampilkan daftar semua pengguna.
     */
    public function indexUsers()
    {
        $users = User::all();
        return view('admin.users_index', compact('users'));
    }

    /**
     * Menampilkan formulir pembuatan pengguna baru.
     */
    public function createUserForm()
    {
        return view('admin.user_create');
    }

    /**
     * Menyimpan pengguna baru.
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'identifier' => 'required|string|max:255|unique:users',
            'role' => 'required|in:admin,dosen,mahasiswa',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'identifier' => $request->identifier, // NIP/NIM
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Menampilkan formulir edit pengguna.
     */
    public function editUserForm(User $user)
    {
        return view('admin.user_edit', compact('user'));
    }

    /**
     * Memperbarui data pengguna.
     */
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'identifier' => 'required|string|max:255|unique:users,identifier,' . $user->id,
            'role' => 'required|in:admin,dosen,mahasiswa',
            'password' => 'nullable|string|min:8',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->identifier = $request->identifier;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    /**
     * Menghapus pengguna.
     */
    public function destroyUser(User $user)
    {
        // Pastikan Admin tidak bisa menghapus dirinya sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | LAPORAN GLOBAL TUGAS AKHIR
    |--------------------------------------------------------------------------
    */

    /**
     * Menampilkan laporan global semua Tugas Akhir.
     */
    public function laporanTugasAkhir()
    {
        $tugasAkhirList = TugasAkhir::with('mahasiswa', 'dosenPembimbing1', 'dosenPembimbing2')
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        return view('admin.laporan_ta', compact('tugasAkhirList'));
    }


    /*
    |--------------------------------------------------------------------------
    | PENETAPAN DOSEN PEMBIMBING 2
    |--------------------------------------------------------------------------
    */

    /**
     * Menampilkan formulir untuk menetapkan Dosen Pembimbing 2.
     */
    public function showSetDosenForm(TugasAkhir $tugasAkhir)
    {
        // Ambil semua pengguna dengan role 'dosen'
        $dosenList = User::where('role', 'dosen')->orderBy('name')->get();

        // Pastikan hanya TA yang sudah Diterima yang bisa ditetapkan Pembimbing 2
        if ($tugasAkhir->status !== 'Diterima') {
            return back()->with('error', 'Penetapan Pembimbing 2 hanya untuk Tugas Akhir berstatus Diterima.');
        }

        return view('admin.set_dosen_form', compact('tugasAkhir', 'dosenList'));
    }

    /**
     * Memproses penetapan Dosen Pembimbing 2.
     */
    public function submitSetDosen(Request $request, TugasAkhir $tugasAkhir)
    {
        $request->validate([
            // ID dosen boleh kosong (nullable) jika Pembimbing 2 tidak diperlukan
            'dosen_pembimbing_2_id' => 'nullable|exists:users,id',
        ]);

        // Pastikan Pembimbing 2 tidak sama dengan Pembimbing 1, jika Pembimbing 2 diisi
        if ($request->dosen_pembimbing_2_id && $request->dosen_pembimbing_2_id == $tugasAkhir->dosen_pembimbing_1_id) {
            return back()->with('error', 'Dosen Pembimbing 2 tidak boleh sama dengan Dosen Pembimbing 1.');
        }

        $tugasAkhir->update([
            // Jika ID kosong (null), itu berarti Admin memilih "Tidak Ada" atau opsi kosong
            'dosen_pembimbing_2_id' => $request->dosen_pembimbing_2_id ?? null,
        ]);

        return redirect()->route('admin.laporan.ta')->with('success', 'Dosen Pembimbing 2 berhasil ditetapkan/diperbarui.');
    }
}
