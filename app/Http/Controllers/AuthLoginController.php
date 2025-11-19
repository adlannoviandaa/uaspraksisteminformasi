<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthLoginController extends Controller
{
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'nim' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|in:admin,dosen,mahasiswa',
        ]);

        $credentials = $request->only('nim', 'password');
        $role = $request->input('role');

        if (Auth::attempt(array_merge($credentials, ['role' => $role]))) {
            $request->session()->regenerate();

            return match($role) {
                'admin' => redirect()->route('admin.dashboard'),
                'dosen' => redirect()->route('dosen.dashboard'),
                'mahasiswa' => redirect()->route('mahasiswa.dashboard'),
            };
        }

        return back()->withErrors([
            'nim' => 'NIM/NIP/ID atau password salah.',
        ])->withInput($request->only('nim','role'));
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
