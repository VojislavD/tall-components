<?php

namespace TallComponents\Tests\Unit;

use Illuminate\Support\Facades\File;
use TallComponents\Tests\TestCase;

class PublishViewsTest extends TestCase
{
    /** @test */
    public function test_publish_view_for_modal_when_not_exists()
    {
        mkdir(resource_path('views/components/tc'), 0777, true);

        $this->assertFalse(file_exists(resource_path('views/components/tc/modal.blade.php')));
        
        $this->artisan('vendor:publish --tag="tall-components-views"');

        $this->assertTrue(file_exists(resource_path('views/components/tc/modal.blade.php')));

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/views/components/modal.blade.php'),
            file_get_contents(resource_path('views/components/tc/modal.blade.php'))
        );
    }

    /** @test */
    public function test_publish_view_for_modal_when_already_exists()
    {
        mkdir(resource_path('views/components/tc'), 0777, true);

        $this->assertFalse(file_exists(resource_path('views/components/tc/modal.blade.php')));
        
        File::put(resource_path('views/components/tc/').'modal.blade.php', 'Views test');

        $this->artisan('vendor:publish --tag="tall-components-views"');

        $this->assertTrue(file_exists(resource_path('views/components/tc/modal.blade.php')));

        $this->assertEquals(
            'Views test',
            file_get_contents(resource_path('views/components/tc/modal.blade.php'))
        );
    }
}