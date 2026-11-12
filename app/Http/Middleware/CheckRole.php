<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        // 1. Belum login? Arahkan ke halaman login
        if (! $user) {
            return redirect()->route('login');
        }

        // 2. Sudah login, tapi perannya tidak ada di daftar? Tolak
        if (! $user->hasRole(...$roles)) {
            abort(403, 'Anda tidak memiliki hak akses untuk halaman ini.');
        }

        // 3. Lolos: lanjut ke controller
        return $next($request);
    }
}