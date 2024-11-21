<?php
namespace  App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait AuthTrait
{
    public  function get_current_auth()
    {
        foreach (config('auth.guards') as $guardName => $guardConfig) {
            if (Auth::guard($guardName)->user()) {
                return Auth::guard($guardName)->user();
            }
        }
    }
}
