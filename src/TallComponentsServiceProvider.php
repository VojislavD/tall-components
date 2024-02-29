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
			$this->registerComponent('confirmation-modal');
			$this->registerComponent('loading-spinner');
			$this->registerComponent('per-page');
			$this->registerComponent('switcher');
			$this->registerComponent('table');
			$this->registerComponent('td');
			$this->registerComponent('th');
			$this->registerComponent('tr');
			$this->registerComponent('filepond');
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
            // Publish Views
            $this->publishes([
                __DIR__.'/../resources/views/components/modal.blade.php' => resource_path('views/vendor/tc/components/modal.blade.php'),
                __DIR__.'/../resources/views/components/confirmation-modal.blade.php' => resource_path('views/vendor/tc/components/confirmation-modal.blade.php'),
                __DIR__.'/../resources/views/components/loading-spinner.blade.php' => resource_path('views/vendor/tc/components/loading-spinner.blade.php'),
                __DIR__.'/../resources/views/components/per-page.blade.php' => resource_path('views/vendor/tc/components/per-page.blade.php'),
                __DIR__.'/../resources/views/components/switcher.blade.php' => resource_path('views/vendor/tc/components/switcher.blade.php'),
                __DIR__.'/../resources/views/components/table.blade.php' => resource_path('views/vendor/tc/components/table.blade.php'),
                __DIR__.'/../resources/views/components/td.blade.php' => resource_path('views/vendor/tc/components/td.blade.php'),
                __DIR__.'/../resources/views/components/th.blade.php' => resource_path('views/vendor/tc/components/th.blade.php'),
                __DIR__.'/../resources/views/components/tr.blade.php' => resource_path('views/vendor/tc/components/tr.blade.php'),
                __DIR__.'/../resources/views/components/filepond.blade.php' => resource_path('views/vendor/tc/components/filepond.blade.php'),
                __DIR__.'/../resources/views/livewire/notification.blade.php' => resource_path('views/vendor/tc/livewire/notification.blade.php'),
            ], 'tall-components-views');

            // Clear view cache for the package
            Artisan::call('view:clear');
        }
    }
}
