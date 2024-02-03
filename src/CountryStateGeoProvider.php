<?php
namespace Cherryant\CountryStateGeo;

use Illuminate\Support\ServiceProvider;

class CountryStateGeoProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton(CountryStateGeo::class, function ($app) {
            return new CountryStateGeo();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}