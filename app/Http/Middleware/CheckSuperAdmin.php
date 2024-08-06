<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class CheckSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->hasRole('super_admin')) {
            return $next($request);
        }

        // Pengguna non-super_admin hanya dapat melihat data mereka sendiri
        $request->merge(['filter_by_user' => Auth::user()->email]);

        return $next($request);
    }
}
