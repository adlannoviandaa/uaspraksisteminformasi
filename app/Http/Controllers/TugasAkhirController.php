<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TugasAkhir;
use App\Models\User;

class TugasAkhirController extends Controller
{
    /**
     * LIST DATA TUGAS AKHIR (ADMIN / DOSEN)
     */
    public function index()
    {
        $data = TugasAkhir::with([
            'mahasiswa',
            'dosenPembimbing1',
            'dosenPembimbing2'
        ])->orderBy('created_at', 'desc')->get();

        return view('tugas-akhir.index', compact('data'));
    }

    /**
     * MAHASISWA: FORM PENGAJUAN
     */
    public function create()
    {
        $dosenList = User::where('role', 'dosen')->get();

        return view('tugas-akhir.create', compact('dosenList'));
    }

    /**
     * MAHASISWA: SIMPAN PENGAJUAN BARU
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_ta' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'bidang_minat' => 'required|string|max:255',
            'dosen_pembimbing1_id' => 'required|exists:users,id'
        ]);

        TugasAkhir::create([
            'mahasiswa_id' => auth()->id(),
            'judul_ta' => $request->judul_ta,
            'deskripsi' => $request->deskripsi,
            'bidang_minat' => $request->bidang_minat,
            'status' => 'Menunggu',
            'dosen_pembimbing1_id' => $request->dosen_pembimbing1_id,
        ]);

        return redirect()->route('ta.index')
            ->with('success', 'Pengajuan Tugas Akhir berhasil dikirim.');
    }

    /**
     * ADMIN / DOSEN: DETAIL
     */
    public function show(TugasAkhir $tugasAkhir)
    {
        return view('tugas-akhir.show', compact('tugasAkhir'));
    }

    /**
     * ADMIN: FORM SET DOSEN PEMBIMBING 2
     */
    public function setDosenForm(TugasAkhir $tugasAkhir)
    {
        if ($tugasAkhir->status !== 'Diterima') {
            return back()->with('error', 'Hanya TA dengan status Diterima yg boleh diberi pembimbing 2.');
        }

        $dosenList = User::where('role', 'dosen')->get();

        return view('tugas-akhir.set_dosen', compact('tugasAkhir', 'dosenList'));
    }

    /**
     * ADMIN: PROSES SET PEMBIMBING 2
     */
    public function setDosenSubmit(Request $request, TugasAkhir $tugasAkhir)
    {
        $request->validate([
            'dosen_pembimbing2_id' => 'nullable|exists:users,id'
        ]);

        if (
            $request->dosen_pembimbing2_id &&
            $request->dosen_pembimbing2_id == $tugasAkhir->dosen_pembimbing1_id
        ) {
            return back()->with('error', 'Pembimbing 2 tidak boleh sama dengan pembimbing 1.');
        }

        $tugasAkhir->update([
            'dosen_pembimbing2_id' => $request->dosen_pembimbing2_id
        ]);

        return redirect()->route('ta.index')
            ->with('success', 'Pembimbing 2 berhasil ditetapkan.');
    }

    /**
     * ADMIN / DOSEN: UBAH STATUS (Terima / Tolak)
     */
    public function updateStatus(Request $request, TugasAkhir $tugasAkhir)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Diterima,Ditolak'
        ]);

        $tugasAkhir->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status Tugas Akhir berhasil diperbarui.');
    }

    /**
     * ADMIN: HAPUS TUGAS AKHIR
     */
    public function destroy(TugasAkhir $tugasAkhir)
    {
        $tugasAkhir->delete();

        return back()->with('success', 'Data Tugas Akhir berhasil dihapus.');
    }
}
