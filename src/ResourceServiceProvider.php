<?php

namespace Hitman\Resource;

use Illuminate\Support\ServiceProvider;

class ResourceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views/', 'resource');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('command.hitman.resource', 'Hitman\Resource\Commands\MakeResource');
        $this->app->singleton('command.hitman.doc', 'Hitman\Resource\Commands\DocGenerator');
        $this->commands('command.hitman.resource');
        $this->commands('command.hitman.doc');
    }
}
