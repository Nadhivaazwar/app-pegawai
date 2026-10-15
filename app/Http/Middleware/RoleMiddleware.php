<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // kalau belum login -> ke login
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        // normalisasi: jadi lower case semua
        $roles = array_map(function ($role) {
            return strtolower(trim($role));
        }, $roles);

        $userRole = strtolower(trim(Auth::user()->role ?? ''));

        // kalau role user tidak ada di daftar -> 403
        if (! in_array($userRole, $roles, true)) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
