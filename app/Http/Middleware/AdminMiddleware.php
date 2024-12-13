<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        // Pastikan pengguna sudah login dan memiliki role admin
        if (Auth::check() && Auth::user()->level === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, redirect ke halaman lain (contoh: home)
        return redirect('/')->with('error', 'You do not have access to this section.');
    }
}