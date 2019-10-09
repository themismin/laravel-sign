<?php

namespace ThemisMin\LaravelSign;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Boot the provider.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the provider.
     */
    public function register()
    {
        $configSource = realpath(__DIR__ . '/../config/laravel-sign.php');
        $this->publishes([$configSource => config_path('laravel-sign.php')], 'config');
        $this->mergeConfigFrom($configSource, 'laravel-sign');
    }
}
