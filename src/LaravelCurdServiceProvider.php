<?php

namespace Lany\LaravelCurd;

use Illuminate\Support\ServiceProvider;

class LaravelCurdServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('l_curd', function ($app) {
            return new LCurd();
        });
        $this->app->singleton('classArr', function ($app) {
            return new ClassArr($app['config']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'l_curd');
        $this->publishes([
            __DIR__.'/config/l_curd.php' => config_path('l_curd.php'),
        ]);
    }
}
