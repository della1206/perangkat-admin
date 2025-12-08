<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Jika user belum login
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        $user = auth()->user();
        $userRole = $user->role;
        
        // Debug untuk melihat apa yang terjadi
        Log::info('CheckRole Debug', [
            'user_email' => $user->email,
            'user_role' => $userRole,
            'required_roles' => $roles,
            'url' => $request->url(),
            'path' => $request->path()
        ]);
        
        // Izinkan SUPER_ADMIN (dengan underscore) untuk SEMUA akses
        if ($userRole === 'super_admin') {
            Log::info('Super_admin access granted');
            return $next($request);
        }
        
        // Izinkan SUPERADMIN (tanpa underscore) untuk backward compatibility
        if ($userRole === 'superadmin') {
            Log::info('Superadmin (no underscore) access granted');
            return $next($request);
        }
        
        // Cek apakah role user ada dalam roles yang diizinkan
        if (!in_array($userRole, $roles)) {
            Log::warning('Access denied', [
                'user_role' => $userRole,
                'required_roles' => $roles
            ]);
            abort(403, 'Akses ditolak. Role Anda: ' . $userRole . '. Diperlukan: ' . implode(', ', $roles));
        }
        
        return $next($request);
    }
}