<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekRoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek Login
        if (!Auth::check()) {
            return response()->json(['error' => 'Anda harus login (Unauthorized)'], 401);
        }

        $user = Auth::user();

        // 2. Cek Role (RBAC)
        foreach ($roles as $role) {
            if ($user->role == $role) {
                return $next($request); // Lolos
            }
        }

        // 3. Ditolak
        return response()->json(['error' => 'Akses ditolak. Khusus Admin.'], 403);
    }
}









