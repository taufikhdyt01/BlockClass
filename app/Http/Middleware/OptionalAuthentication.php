<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OptionalAuthentication
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->bearerToken()) {
            // Jika ada token, coba autentikasi
            if (auth()->guard('sanctum')->check()) {
                return $next($request);
            }
        }
        
        // Lanjutkan request tanpa autentikasi
        return $next($request);
    }
}