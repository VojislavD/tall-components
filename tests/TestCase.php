<?php

namespace TallComponents\Tests;

use Livewire\LivewireServiceProvider;
use TallComponents\TallComponentsServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->cleanState();
    }

    /**
     * @return void
     */
    public function tearDown(): void
    {
        $this->cleanState();
        parent::tearDown();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * 
     * @return void
     */
    public function getEnvironmentSetUp($app)
    {
        
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * 
     * @return array
     */
    public function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            TallComponentsServiceProvider::class,
        ];
    }

    /**
     * @return void
     */
    private function cleanState()
    {
        if (
            file_exists(resource_path('/views/vendor/tc/components/modal.blade.php')) ||
            file_exists(resource_path('/views/vendor/tc/components/confirmation-modal.blade.php')) ||
            file_exists(resource_path('/views/vendor/tc/components/loading-spinner.blade.php')) ||
            file_exists(resource_path('/views/vendor/tc/livewire/notification.blade.php'))
        ) {
            unlink(resource_path('/views/vendor/tc/components/modal.blade.php'));
            unlink(resource_path('/views/vendor/tc/components/confirmation-modal.blade.php'));
            unlink(resource_path('/views/vendor/tc/components/loading-spinner.blade.php'));
            unlink(resource_path('/views/vendor/tc/livewire/notification.blade.php'));
            rmdir(resource_path('/views/vendor/tc/components'));
            rmdir(resource_path('/views/vendor/tc/livewire'));
            rmdir(resource_path('/views/vendor/tc'));
            rmdir(resource_path('/views/vendor'));
        }
    }
}
