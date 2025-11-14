<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TugasAkhir; // Pastikan model TugasAkhir sudah ada
use App\Models\User; // Digunakan untuk dosen jika tidak ada model Dosen terpisah
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan dashboard utama Mahasiswa dengan status Tugas Akhir mereka.
     * Diasumsikan 'User' dengan role 'mahasiswa' dapat mengakses.
     */
    public function index()
    {
        // Mendapatkan ID pengguna yang sedang login
        $mahasiswaId = Auth::id();

        // Mencari data Tugas Akhir (TA) milik mahasiswa tersebut
        // Menggunakan with() untuk memuat relasi Pembimbing 1 dan Pembimbing 2
        $tugasAkhir = TugasAkhir::where('mahasiswa_id', $mahasiswaId)
                                ->with(['dosenPembimbing1', 'dosenPembimbing2'])
                                ->first();

        return view('mahasiswa.dashboard', compact('tugasAkhir'));
    }

    /**
     * Menampilkan form pengajuan proposal Tugas Akhir.
     */
    public function showProposalForm()
    {
        // Pastikan mahasiswa belum pernah mengajukan TA sebelumnya
        if (TugasAkhir::where('mahasiswa_id', Auth::id())->exists()) {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Anda sudah mengajukan proposal Tugas Akhir.');
        }

        // Ambil daftar dosen yang tersedia untuk dipilih sebagai Pembimbing 1
        // Diasumsikan dosen memiliki role 'dosen' atau ada model/tabel 'Dosen' terpisah
        // Saya asumsikan role ada di model User
        $dosenList = User::where('role', 'dosen')->get();

        return view('mahasiswa.proposal_form', compact('dosenList'));
    }

    /**
     * Menyimpan proposal Tugas Akhir yang diajukan oleh Mahasiswa.
     */
    public function submitProposal(Request $request)
    {
        // 1. Validasi Input
        $validator = Validator::make($request->all(), [
            'judul_ta' => 'required|string|min:10|max:255',
            'dosen_pembimbing_1_id' => 'required|exists:users,id', // Ganti 'users' jika Anda memiliki tabel 'dosen' terpisah
        ], [
            'judul_ta.required' => 'Judul Tugas Akhir wajib diisi.',
            'judul_ta.min' => 'Judul Tugas Akhir minimal 10 karakter.',
            'dosen_pembimbing_1_id.required' => 'Dosen Pembimbing 1 wajib dipilih.',
            'dosen_pembimbing_1_id.exists' => 'Dosen Pembimbing 1 yang dipilih tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // 2. Cek duplikasi pengajuan
        if (TugasAkhir::where('mahasiswa_id', Auth::id())->exists()) {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Anda sudah mengajukan proposal Tugas Akhir dan tidak dapat mengajukan lagi.');
        }

        try {
            // 3. Simpan data Tugas Akhir
            TugasAkhir::create([
                'mahasiswa_id' => Auth::id(),
                'judul_ta' => $request->judul_ta,
                'dosen_pembimbing_1_id' => $request->dosen_pembimbing_1_id,
                'status' => 'Diajukan', // Status awal saat proposal diajukan
            ]);

            return redirect()->route('mahasiswa.dashboard')->with('success', 'Proposal Tugas Akhir berhasil diajukan! Menunggu persetujuan Admin/Koordinator.');

        } catch (\Exception $e) {
            // Log error
            \Log::error('Gagal menyimpan proposal TA: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan proposal. Silakan coba lagi.')->withInput();
        }
    }
}
