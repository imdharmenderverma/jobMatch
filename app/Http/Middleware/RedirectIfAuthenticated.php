<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard('recruiter')->check() && $guard == 'recruiter') {
                return redirect()->route('recruiter.dashboard');
            }

            if (Auth::guard('web')->check() && $guard == 'web') {
                return redirect('/admin/dashboard');
            }
        }
        return $next($request);
    }
}
