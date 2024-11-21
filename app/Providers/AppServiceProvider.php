<?php

namespace App\Providers;

use App\Models\HealthcareEntity;
use App\Observers\HealthcareObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        HealthcareEntity::observe(HealthcareObserver::class);
    }
}
