<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login dan apakah dia admin
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request); // Lanjutkan jika admin
        }

        // Jika bukan admin, redirect ke login Brezee
        return redirect()->route('login'); // Ganti dengan rute login Brezee
    }
}
