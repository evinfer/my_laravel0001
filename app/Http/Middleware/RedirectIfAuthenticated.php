<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$guards
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        // Loop through all the specified guards
        foreach ($guards as $guard) {
            // Check if the user is authenticated for the current guard
            if (Auth::guard($guard)->check()) {
                // If the user is authenticated, handle the redirection logic
                if ($guard === 'admin') {
                    return redirect()->route('admin.home');
                }
            }
        }

        // If no authentication is detected, allow the request to continue
        return $next($request);
    }
}
