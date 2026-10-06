<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('user')) {
            return redirect('/login');
        }

        $user = session('user');
        $peran = $user['peran'] ?? null;
        $jabatan = $user['jabatan'] ?? '';

        $isAdmin = ($peran === 'Admin') || (
            $jabatan === 'Ketua Himpunan' ||
            $jabatan === 'Wakil Ketua Himpunan' ||
            str_starts_with($jabatan, 'Ketua Divisi')
        );

        if (!$isAdmin) {
            return redirect('/')->with('error', 'Akses ditolak! Anda tidak memiliki hak akses.');
        }

        return $next($request);
    }
}
