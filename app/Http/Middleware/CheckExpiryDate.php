<?php

namespace App\Http\Middleware;

use App\Models\Configuration;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class CheckExpiryDate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $healthcare_entity = Auth::guard('healthcare')->user();

        if($healthcare_entity && Carbon::parse($healthcare_entity->expired_at)->isPast()) {
            // Expired user, unauthorized access
            return \response()->view("front.healthcares.pages.expired" , ['profile' => $healthcare_entity , 'title' => 'Expired Account' , 'config' => Configuration::find(1)]);
        }
        return $next($request);
    }
}
