<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TugasAkhir;

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        $mahasiswaId = Auth::id();

        // Ambil data TA (jika ada)
        $tugasAkhir = TugasAkhir::where('mahasiswa_id', $mahasiswaId)->first();

        return view('mahasiswa.dashboard', compact('tugasAkhir'));
    }

    public function showFormPengajuan() {
    return view('mahasiswa.pengajuan_judul'); // sesuai nama blade
}

public function submitPengajuan(Request $request) {
    // validasi & simpan data
}

}
