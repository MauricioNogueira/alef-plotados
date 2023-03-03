<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ResponseService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('response', function ($app) {
            return new ResponseService();
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
