<?php

namespace TallComponents\Tests\Unit;

use Illuminate\Support\Facades\File;
use TallComponents\Tests\TestCase;

class PublishViewsTest extends TestCase
{
    /** @test */
    public function test_publish_modal_view_when_not_exists()
    {
        mkdir(resource_path('views/vendor/tc/components'), 0777, true);

        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/modal.blade.php')));
        
        $this->artisan('vendor:publish --tag="tall-components-views"');

        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/modal.blade.php')));

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/views/components/modal.blade.php'),
            file_get_contents(resource_path('views/vendor/tc/components/modal.blade.php'))
        );
    }

    /** @test */
    public function test_publish_modal_view_when_already_exists()
    {
        mkdir(resource_path('views/vendor/tc/components'), 0777, true);

        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/modal.blade.php')));
        
        File::put(resource_path('views/vendor/tc/components/').'modal.blade.php', 'Views test');

        $this->artisan('vendor:publish --tag="tall-components-views"');

        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/modal.blade.php')));

        $this->assertEquals(
            'Views test',
            file_get_contents(resource_path('views/vendor/tc/components/modal.blade.php'))
        );
    }

    /** @test */
    public function test_publish_notification_view_when_not_exists()
    {
        mkdir(resource_path('views/vendor/tc/livewire'), 0777, true);

        $this->assertFalse(file_exists(resource_path('views/vendor/tc/livewire/notification.blade.php')));
        
        $this->artisan('vendor:publish --tag="tall-components-views"');

        $this->assertTrue(file_exists(resource_path('views/vendor/tc/livewire/notification.blade.php')));

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/views/livewire/notification.blade.php'),
            file_get_contents(resource_path('views/vendor/tc/livewire/notification.blade.php'))
        );
    }

    /** @test */
    public function test_publish_notification_view_when_already_exists()
    {
        mkdir(resource_path('views/vendor/tc/livewire'), 0777, true);

        $this->assertFalse(file_exists(resource_path('views/vendor/tc/livewire/notification.blade.php')));
        
        File::put(resource_path('views/vendor/tc/livewire/').'notification.blade.php', 'Views test');

        $this->artisan('vendor:publish --tag="tall-components-views"');

        $this->assertTrue(file_exists(resource_path('views/vendor/tc/livewire/notification.blade.php')));

        $this->assertEquals(
            'Views test',
            file_get_contents(resource_path('views/vendor/tc/livewire/notification.blade.php'))
        );
    }
}