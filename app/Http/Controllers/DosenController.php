<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TugasAkhir;

class DosenController extends Controller
{
    public function dashboard()
    {
        // ID dosen yang sedang login
        $dosenId = Auth::id();

        // Ambil semua TA yang dibimbing oleh dosen ini
        $dataTA = TugasAkhir::where('dosen_pembimbing1_id', $dosenId)->get();

        // Hitungan ringkasan data
        $totalTA = $dataTA->count();

        // Semua TA yang statusnya masih diajukan (untuk notifikasi)
        $pengajuanBaru = TugasAkhir::where('status', 'Diajukan')->count();

        // Jumlah mahasiswa bimbingan aktif (status diterima)
        $totalBimbingan = TugasAkhir::where('dosen_pembimbing1_id', $dosenId)
                                    ->where('status', 'Diterima')
                                    ->count();

        // Daftar mahasiswa bimbingan (boleh kosong)
        $mahasiswaBimbingan = TugasAkhir::where('dosen_pembimbing1_id', $dosenId)
                                        ->where('status', 'Diterima')
                                        ->with('mahasiswa') // relasi jika ada
                                        ->get();

        return view('dosen.dashboard', [
            'dataTA' => $dataTA,
            'totalTA' => $totalTA,
            'pengajuanBaru' => $pengajuanBaru,
            'totalBimbingan' => $totalBimbingan,
            'mahasiswaBimbingan' => $mahasiswaBimbingan ?? collect(),
        ]);
    }
}
