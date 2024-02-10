<?php

namespace TallComponents;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;
use Livewire\Mechanisms\CompileLivewireTags\CompileLivewireTags;
use TallComponents\Livewire\Notification;

class TallComponentsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        
    }

    public function boot(): void
    {

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tc');

        $this->configureComponents();

        $this->configureLivewireComponents();

        $this->configurePublishing();

    }

    protected function configureComponents(): void
    {
		$this->callAfterResolving(BladeCompiler::class, function () {
			$this->registerComponent('modal');
		});
	}

    protected function registerComponent(string $component): void
    {
        $componentName = "tc-$component";

        if (! View::exists("components.$componentName")) {
            Blade::component('tc::components.'.$component, $componentName);
        }
    }

    protected function configureLivewireComponents(): void
    {
        Livewire::component('tc-notification', Notification::class);
    }

    protected function configurePublishing(): void
    {
        if ($this->app->runningInConsole()) {
            // Publish Modal
            $this->publishes([
                __DIR__.'/../resources/views/components/modal.blade.php' => resource_path('views/vendor/tc/components/modal.blade.php'),
            ], 'tall-components-views');

            // Clear view cache for the package
            Artisan::call('view:clear');
        }
    }
}
