<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RolMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si es admin permitir al acceso al dashboard
        if (\auth()->user()->rol == 'ADMIN') {
            return $next($request);
        } else {
            // Si no redirigir al acceso
            return \redirect()->route('access-users');
        }
    }
}
