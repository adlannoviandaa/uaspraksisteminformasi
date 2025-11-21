<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesan;

class PesanController extends Controller
{
    /**
     * Menampilkan daftar semua percakapan.
     */
    public function index()
    {
        $conversations = Pesan::latest()->get();
        return view('pesan.index', compact('conversations'));
    }

    /**
     * Form kirim pesan (untuk user / mahasiswa).
     */
    public function create()
    {
        return view('pesan.kirim');
    }

    /**
     * Simpan pesan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'isi' => 'required|min:3'
        ]);

        Pesan::create([
            'nama'   => auth()->user()->name,
            'email'  => auth()->user()->email,
            'isi'    => $request->isi,
            'balasan_admin' => null,
            'status' => 'new', // pesan baru masuk
        ]);

        return redirect()->route('pesan.index')
            ->with('success', 'Pesan berhasil dikirim!');
    }

    /**
     * Detail pesan (admin & user).
     */
    public function show($id)
    {
        $pesan = Pesan::findOrFail($id);

        // Jika admin membuka pesan baru → ubah status jadi "awaiting_reply"
        if ($pesan->status === 'new') {
            $pesan->update(['status' => 'awaiting_reply']);
        }

        return view('pesan.show', compact('pesan'));
    }

    /**
     * Admin membalas pesan.
     */
    public function reply(Request $request, $id)
    {
        $request->validate([
            'balasan_admin' => 'required|min:3'
        ]);

        $pesan = Pesan::findOrFail($id);

        $pesan->update([
            'balasan_admin' => $request->balasan_admin,
            'status'        => 'replied',   // status lebih jelas
        ]);

        return redirect()->route('pesan.show', $id)
            ->with('success', 'Balasan berhasil dikirim!');
    }
}
