<?php

namespace TallComponents\Providers;

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
        $this->loadViewsFrom(__DIR__.'/../../resources/views/components', 'tall');
    }
}
