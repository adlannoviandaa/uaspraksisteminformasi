<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TugasAkhir;
use App\Models\User;

class DosenController extends Controller
{
    /**
     * Menampilkan dashboard utama untuk Dosen.
     */
    public function dashboard()
    {
        // Hitung jumlah mahasiswa bimbingan yang masih aktif (status Diterima)
        $jumlahBimbinganAktif = TugasAkhir::where('dosen_pembimbing1_id', Auth::id())
                                         ->where('status', 'Diterima')
                                         ->count();

        // Hitung judul yang masih menunggu persetujuan secara umum (untuk ditampilkan di notifikasi)
        $judulMenunggu = TugasAkhir::where('status', 'Diajukan')
                                     ->count();

        return view('dosen.dashboard', compact('jumlahBimbinganAktif', 'judulMenunggu'));
    }

    /**
     * Menampilkan daftar semua judul TA yang perlu ditinjau (status 'Diajukan').
     */
    public function showJudulReview()
    {
        $judulReview = TugasAkhir::where('status', 'Diajukan')
                                 ->with('mahasiswa') // Ambil data mahasiswa yang mengajukan
                                 ->get();

        return view('dosen.judul_review', compact('judulReview'));
    }

    /**
     * Memproses persetujuan atau penolakan judul TA.
     */
    public function prosesJudul(Request $request, TugasAkhir $tugasAkhir)
    {
        $request->validate([
            'action' => 'required|in:terima,tolak',
            'catatan' => 'nullable|string',
        ]);

        if ($request->action === 'terima') {
            // Set status Diterima dan tetapkan diri sendiri (dosen yang login) sebagai Pembimbing 1
            $tugasAkhir->update([
                'status' => 'Diterima',
                'dosen_pembimbing1_id' => Auth::id(),
                'catatan_dosen' => $request->catatan,
            ]);
            $message = 'Judul berhasil DITERIMA dan Anda ditetapkan sebagai Pembimbing 1.';

        } else { // Tolak
            $tugasAkhir->update([
                'status' => 'Ditolak',
                'dosen_pembimbing1_id' => null, // Hapus penetapan pembimbing jika ditolak
                'catatan_dosen' => $request->catatan,
            ]);
            $message = 'Judul berhasil DITOLAK.';
        }

        return redirect()->route('dosen.review.index')->with('success', $message);
    }

    /**
     * Menampilkan daftar mahasiswa yang dibimbing oleh dosen yang sedang login.
     */
    public function listMahasiswaBimbingan()
    {
        // Mengambil semua Tugas Akhir di mana dosen yang sedang login adalah Pembimbing 1
        // Status: hanya yang Diterima (sudah menjadi bimbingan aktif)
        $mahasiswaBimbingan = TugasAkhir::where('dosen_pembimbing1_id', Auth::id())
                                        ->where('status', 'Diterima')
                                        ->with('mahasiswa') // Ambil data User Mahasiswa
                                        ->get();

        return view('dosen.mahasiswa_bimbingan', compact('mahasiswaBimbingan'));
    }
}
