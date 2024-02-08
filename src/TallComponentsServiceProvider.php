<?php

namespace TallComponents;

use Illuminate\Support\ServiceProvider;

class TallComponentsServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tc');

        if ($this->app->runningInConsole()) {
            // Publish view components
            $this->publishes([
                __DIR__.'/../resources/views/components/' => resource_path('views/components/tc'),
            ], 'tall-components-views');
        }
    }
}
