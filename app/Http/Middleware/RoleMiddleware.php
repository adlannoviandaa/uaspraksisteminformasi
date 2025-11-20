<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next, $role)
    {
        // Pastikan user sudah login dan rolenya sesuai
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Jika role tidak sesuai -> logout & balik ke login
        Auth::logout();
        return redirect()->route('login')->withErrors([
            'error' => 'Anda tidak memiliki akses ke halaman tersebut.',
        ]);
    }
}
