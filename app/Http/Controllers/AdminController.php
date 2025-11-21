<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TugasAkhir;
use App\Models\Pesan;

class AdminController extends Controller
{
    /**
     * DASHBOARD ADMIN
     */
    public function dashboard()
    {
        // Hitung jumlah mahasiswa
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();

        // Hitung total tugas akhir
        $totalTA = TugasAkhir::count();

        // Hitung total pesan
        $totalPesan = Pesan::count();

        // Ambil semua pengajuan TA
        $pengajuan = TugasAkhir::with([
            'mahasiswa',
            'dosenPembimbing1',
            'dosenPembimbing2'
        ])->get();

        return view('admin.dashboard', [
            'totalMahasiswa' => $totalMahasiswa,
            'totalTA'        => $totalTA,
            'totalPesan'     => $totalPesan,
            'pengajuan'      => $pengajuan
        ]);
    }

    /**
     * CRUD USER
     */
    public function indexUsers()
    {
        $users = User::all();
        return view('admin.users_index', compact('users'));
    }

    public function createUserForm()
    {
        return view('admin.user_create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users',
            'identifier' => 'required|string|max:255|unique:users',
            'role'       => 'required|in:admin,dosen,mahasiswa',
            'password'   => 'required|min:8',
        ]);

        User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'identifier' => $request->identifier,
            'role'       => $request->role,
            'password'   => bcrypt($request->password),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function editUserForm(User $user)
    {
        return view('admin.user_edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255|unique:users,email,' . $user->id,
            'identifier' => 'required|string|max:255|unique:users,identifier,' . $user->id,
            'role'       => 'required|in:admin,dosen,mahasiswa',
            'password'   => 'nullable|min:8',
        ]);

        $user->update([
            'name'       => $request->name,
            'email'      => $request->email,
            'identifier' => $request->identifier,
            'role'       => $request->role,
            'password'   => $request->filled('password')
                                ? bcrypt($request->password)
                                : $user->password
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroyUser(User $user)
    {
        if ($user->id == auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }

    /**
     * LAPORAN TUGAS AKHIR
     */
    public function laporanTugasAkhir()
    {
        $tugasAkhirList = TugasAkhir::with([
            'mahasiswa',
            'dosenPembimbing1',
            'dosenPembimbing2'
        ])->orderBy('created_at', 'desc')->get();

        return view('admin.laporan_ta', compact('tugasAkhirList'));
    }

    /**
     * FORM PENETAPAN PEMBIMBING 2
     */
    public function showSetDosenForm(TugasAkhir $tugasAkhir)
    {
        if ($tugasAkhir->status !== 'Diterima') {
            return back()->with('error', 'Pembimbing 2 hanya dapat ditetapkan jika status TA = Diterima.');
        }

        $dosenList = User::where('role', 'dosen')->orderBy('name')->get();

        return view('admin.set_dosen_form', compact('tugasAkhir', 'dosenList'));
    }

    /**
     * PROSES PENETAPAN PEMBIMBING 2
     */
    public function submitSetDosen(Request $request, TugasAkhir $tugasAkhir)
    {
        $request->validate([
            'dosen_pembimbing2_id' => 'nullable|exists:users,id',
        ]);

        if (
            $request->dosen_pembimbing2_id &&
            $request->dosen_pembimbing2_id == $tugasAkhir->pembimbing1_id
        ) {
            return back()->with('error', 'Pembimbing 2 tidak boleh sama dengan Pembimbing 1.');
        }

        $tugasAkhir->update([
            'pembimbing2_id' => $request->dosen_pembimbing2_id ?? null,
        ]);

        return redirect()->route('admin.laporan.ta')
            ->with('success', 'Pembimbing 2 berhasil diperbarui.');
    }
}
