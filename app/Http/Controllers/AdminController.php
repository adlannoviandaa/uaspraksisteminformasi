<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TugasAkhir;
use App\Models\Pesan;

class AdminController extends Controller
{
    // ===========================
    // DASHBOARD
    // ===========================
    public function dashboard()
    {
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalTA = TugasAkhir::count();
        $totalPesan = Pesan::count();

        $pengajuan = TugasAkhir::with(['mahasiswa', 'dosenPembimbing1', 'dosenPembimbing2'])->get();

        return view('admin.dashboard', compact(
            'totalMahasiswa', 'totalTA', 'totalPesan', 'pengajuan'
        ));
    }

    // ===========================
    // CRUD USER
    // ===========================
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

    // ===========================
    // TUGAS AKHIR
    // ===========================
    public function tugasAkhirIndex()
    {
        $tugasAkhirList = TugasAkhir::with(['mahasiswa', 'dosenPembimbing1', 'dosenPembimbing2'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.tugasakhir.index', compact('tugasAkhirList'));
    }

    public function tugasAkhirShow(TugasAkhir $tugasAkhir)
    {
        return view('admin.tugasakhir.show', compact('tugasAkhir'));
    }

    public function updateStatus(Request $request, TugasAkhir $tugasAkhir)
    {
        $request->validate([
            'status' => 'required|in:Pending,Diterima,Ditolak',
        ]);

        $tugasAkhir->update(['status' => $request->status]);

        return redirect()->route('admin.tugasakhir.index')
            ->with('success', 'Status berhasil diperbarui.');
    }

    // ===========================
    // SET PEMBIMBING 2
    // ===========================
    public function showSetDosenForm(TugasAkhir $tugasAkhir)
    {
        if ($tugasAkhir->status !== 'Diterima') {
            return back()->with('error', 'Pembimbing 2 hanya dapat ditetapkan jika TA sudah Diterima.');
        }

        $dosenList = User::where('role', 'dosen')->get();

        return view('admin.tugasakhir.set_dosen', compact('tugasAkhir', 'dosenList'));
    }

    public function submitSetDosen(Request $request, TugasAkhir $tugasAkhir)
    {
        $request->validate([
            'dosen_pembimbing2_id' => 'nullable|exists:users,id',
        ]);

        $tugasAkhir->update([
            'dosen_pembimbing2_id' => $request->dosen_pembimbing2_id
        ]);

        return redirect()->route('admin.tugasakhir.index')
            ->with('success', 'Pembimbing 2 berhasil ditetapkan.');
    }

    // ===========================
    // DELETE TUGAS AKHIR
    // ===========================
    public function destroyTugasAkhir(TugasAkhir $tugasAkhir)
    {
        $tugasAkhir->delete();

        return redirect()->route('admin.tugasakhir.index')
            ->with('success', 'Data TA berhasil dihapus.');
    }
}
