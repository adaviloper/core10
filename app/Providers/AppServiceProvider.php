<?php

namespace App\Providers;

use App\Clients\ApiClient;
use App\Clients\SWClient;
use Illuminate\Support\ServiceProvider;

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
        // Http::macro('starwars', function() {
        //     return Http::baseUrl('http://swapi.dev/api');
        // });

        $this->app->bind(ApiClient::class, SWClient::class);
    }
}
