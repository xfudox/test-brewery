<?php

namespace App\Providers;

use App\Interfaces\BreweryService;
use App\Services\OpenBreweryDBService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(BreweryService::class, function ($app) {
            return new OpenBreweryDBService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
