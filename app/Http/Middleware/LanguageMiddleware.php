<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->has('locale')) {
            app()->setLocale($request->session()->get('locale'));
        }
        return $next($request);
    }
}
