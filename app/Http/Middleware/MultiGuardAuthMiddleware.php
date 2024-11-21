<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class MultiGuardAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        foreach (config('auth.guards') as $guardName => $guardConfig) {
            if (Auth::guard($guardName)->user()) {
                return $next($request);
            }
        }

        // If none of the guards is authenticated, redirect or handle the unauthorized request as needed.
        return redirect()->route('front.home'); // You can customize this part based on your requirements.
    }
}
