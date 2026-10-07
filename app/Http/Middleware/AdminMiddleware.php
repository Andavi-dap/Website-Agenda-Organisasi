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

        // Determine admin status using the centralized Role helper
        $isAdmin = \App\Support\Role::isAdmin($jabatan);

        if (! $isAdmin) {
            // Show a 403 Forbidden page with a custom HARUNA‑styled view
            abort(403);
        }

        return $next($request);
    }
}
