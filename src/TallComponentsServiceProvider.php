<?php

namespace TallComponents;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;
use TallComponents\Livewire\Notification;

class TallComponentsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        
    }

    public function boot(): void
    {
        Livewire::component('notification', Notification::class);

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tc');

        $this->configureComponents();

        $this->configurePublishing();
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

    protected function configurePublishing()
    {
        if ($this->app->runningInConsole()) {
            // Publish Modal
            $this->publishes([
                __DIR__.'/../resources/views/components/modal.blade.php' => resource_path('views/components/tc-modal.blade.php'),
            ], 'tall-components-modal');

            // Clear view cache for the package
            Artisan::call('view:clear');
        }
    }
}
