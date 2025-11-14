<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message; // Asumsikan Anda memiliki model Message
use App\Models\User;    // Asumsikan Anda menggunakan model User

class MessageController extends Controller
{
    /**
     * Tampilkan halaman Pesan Masuk (Inbox).
     * Akan menampilkan daftar percakapan (thread)
     */
    public function index()
    {
        $user = Auth::user();

        // Logika untuk mengambil daftar percakapan unik
        // Biasanya ini melibatkan grouping berdasarkan sender_id dan receiver_id

        // Placeholder data: Ambil 5 pesan terbaru yang melibatkan user ini
        $messages = Message::where('sender_id', $user->id)
                           ->orWhere('receiver_id', $user->id)
                           ->orderBy('created_at', 'desc')
                           ->take(5)
                           ->get();

        // Dalam aplikasi nyata, Anda akan memproses $messages menjadi $threads (daftar kontak)
        $conversations = [];

        // Untuk demo, kita kirimkan data pesan mentah saja.
        $demoMessages = [
            (object)['sender' => 'Dosen Wali, S.Pd', 'preview' => 'Selamat, proposal anda sudah direkomendasikan untuk...', 'time' => '3m lalu'],
            (object)['sender' => 'Admin TU', 'preview' => 'Mohon segera lengkapi berkas pendaftaran sidang...', 'time' => '1h lalu'],
        ];

        return view('messages.inbox', [
            'messages' => $demoMessages, // Ganti dengan $conversations yang sesungguhnya
            'userRole' => $user->role
        ]);
    }

    /**
     * Tampilkan formulir untuk Kirim Pesan Baru.
     */
    public function create()
    {
        // Ambil daftar Dosen dan Mahasiswa untuk opsi penerima
        $dosenList = User::where('role', 'dosen')->pluck('name', 'id');
        $mahasiswaList = User::where('role', 'mahasiswa')->pluck('name', 'id');

        return view('messages.create', [
            'dosenList' => $dosenList,
            'mahasiswaList' => $mahasiswaList,
        ]);
    }

    /**
     * Proses pengiriman pesan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'subject' => 'nullable|string|max:255',
            'content' => 'required|string',
        ]);

        try {
            Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $request->receiver_id,
                'subject' => $request->subject,
                'content' => $request->content,
                // Kolom lain seperti status read/unread
            ]);

            return redirect()->route('messages.index')->with('success', 'Pesan berhasil dikirim.');

        } catch (\Exception $e) {
            // Log error
            return back()->with('error', 'Gagal mengirim pesan. Silakan coba lagi.')->withInput();
        }
    }
}
