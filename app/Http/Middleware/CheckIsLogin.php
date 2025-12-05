<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIsLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika tidak login, redirect ke login
        if (!Auth::check()) {
            return redirect()->route('login')->with('warning', 'Silahkan login terlebih dahulu!');
        }

        // Jika login tapi role kosong, redirect ke halaman khusus
        // atau tetap izinkan tapi dengan warning
        if (empty(Auth::user()->role)) {
            // Bisa redirect ke halaman set role, atau tetap izinkan
            // return redirect()->route('set.role')->with('warning', 'Silahkan atur role Anda');
            
            // Atau set default role
            Auth::user()->update(['role' => 'User']);
            session(['role' => 'User']);
        }

        return $next($request);
    }
}