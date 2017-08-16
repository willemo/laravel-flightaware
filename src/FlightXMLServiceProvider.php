<?php

namespace Willemo\LaravelFlightAware;

use Illuminate\Support\ServiceProvider;

class FlightXMLServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FlightXMLClient::class, function ($app) {
            return new FlightXMLClient($app['config']['flightxml']);
        });
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'../config/flightxml.php' => config_path('flightxml.php'),
        ]);
    }
}
