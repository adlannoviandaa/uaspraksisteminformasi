<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthLoginController extends Controller
{
    /**
     * Tampilkan formulir login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses permintaan login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'identifier' => 'required|string', // Bisa berupa NIP/NIM
            'password' => 'required',
        ]);

        // Coba login berdasarkan field 'identifier' yang bisa berupa 'nip' atau 'nim'
        if (Auth::attempt(['nip' => $credentials['identifier'], 'password' => $credentials['password']])) {
            // Login sebagai Dosen atau Admin (menggunakan NIP)
            $request->session()->regenerate();
            return $this->redirectToDashboard();

        } elseif (Auth::attempt(['nim' => $credentials['identifier'], 'password' => $credentials['password']])) {
            // Login sebagai Mahasiswa (menggunakan NIM)
            $request->session()->regenerate();
            return $this->redirectToDashboard();

        } else {
            // Login gagal
            return back()->withErrors([
                'identifier' => 'NIP/NIM atau password salah.',
            ])->onlyInput('identifier');
        }
    }

    /**
     * Arahkan pengguna ke dashboard yang sesuai berdasarkan peran.
     */
    protected function redirectToDashboard()
    {
        $role = Auth::user()->role;

        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'dosen':
                return redirect()->route('dosen.dashboard');
            case 'mahasiswa':
                return redirect()->route('mahasiswa.dashboard');
            default:
                // Fallback atau error
                Auth::logout();
                return redirect()->route('login')->withErrors(['error' => 'Peran tidak dikenali.']);
        }
    }

    /**
     * Proses logout pengguna.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
