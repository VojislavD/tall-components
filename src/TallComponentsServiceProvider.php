<?php

namespace TallComponents;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class TallComponentsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tc');

        $this->configureComponents();

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/views/components/modal.blade.php' => resource_path('views/components/tc-modal.blade.php'),
            ], 'tall-components-views');

            // Clear view cache for the package
            Artisan::call('view:clear');
        }
    }

    protected function configureComponents()
    {
		$this->callAfterResolving(BladeCompiler::class, function () {
			$this->registerComponent('modal');
		});
	}

    protected function registerComponent(string $component)
    {
        $componentName = "tc-$component";

        if (! View::exists("components.$componentName")) {
            Blade::component('tc::components.'.$component, $componentName);
        }
    }
}
