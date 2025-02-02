<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class AdminMiddleware
{
    public function handle(Request $request, Closure $next) : Response
    {
        // Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek role user
        if (auth()->user()->role !== 'admin') {
            return redirect('/manager/dashboard')
                ->with('error', 'Akses ditolak. Anda bukan admin.');
        }

        return $next($request);
    }
}
