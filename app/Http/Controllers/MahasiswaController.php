<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TugasAkhir;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    // Dashboard Mahasiswa
    public function dashboard()
    {
        $mahasiswaId = Auth::id();
        $tugasAkhir = TugasAkhir::where('mahasiswa_id', $mahasiswaId)
                                ->with(['dosenPembimbing1', 'dosenPembimbing2'])
                                ->first();

        return view('mahasiswa.dashboard', compact('tugasAkhir'));
    }

    // Form pengajuan proposal
    public function showFormPengajuan()
    {
        if (TugasAkhir::where('mahasiswa_id', Auth::id())->exists()) {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Anda sudah mengajukan proposal Tugas Akhir.');
        }

        $dosenList = User::where('role', 'dosen')->get();
        return view('mahasiswa.proposal_form', compact('dosenList'));
    }

    // Submit proposal
    public function submitPengajuan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul_ta' => 'required|string|min:10|max:255',
            'dosen_pembimbing_1_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (TugasAkhir::where('mahasiswa_id', Auth::id())->exists()) {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Anda sudah mengajukan proposal Tugas Akhir.');
        }

        TugasAkhir::create([
            'mahasiswa_id' => Auth::id(),
            'judul_ta' => $request->judul_ta,
            'dosen_pembimbing_1_id' => $request->dosen_pembimbing_1_id,
            'status' => 'Diajukan',
        ]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Proposal Tugas Akhir berhasil diajukan!');
    }
}
