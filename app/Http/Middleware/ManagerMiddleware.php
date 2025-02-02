<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManagerMiddleware
{
    public function handle(Request $request, Closure $next) : Response
    {
        // Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek role user
        if (auth()->user()->role !== 'manager') {
            return redirect('/admin/dashboard')
                ->with('error', 'Akses ditolak. Anda bukan manager.');
        }

        return $next($request);
    }
}
