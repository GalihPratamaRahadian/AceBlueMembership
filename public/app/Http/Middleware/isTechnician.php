<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isTechnician
{
     public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 'teknisi') {
            return $next($request);
        }

        // Jika request dari AJAX, kirimkan JSON error
        if ($request->ajax()) {
            return response()->json(['message' => 'Tidak diizinkan.'], 403);
        }

        // Jika bukan AJAX, arahkan ke login
        return redirect('/login')->with('error', 'Sesi login anda berakhir.');
    }
}
