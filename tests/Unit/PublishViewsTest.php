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

    public function test_publish_confirmation_modal_view_when_not_exists()
    {
        mkdir(resource_path('views/vendor/tc/components'), 0777, true);

        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/confirmation-modal.blade.php')));
        
        $this->artisan('vendor:publish --tag="tall-components-views"');

        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/confirmation-modal.blade.php')));

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/views/components/confirmation-modal.blade.php'),
            file_get_contents(resource_path('views/vendor/tc/components/confirmation-modal.blade.php'))
        );
    }

    /** @test */
    public function test_publish_confirmation_modal_view_when_already_exists()
    {
        mkdir(resource_path('views/vendor/tc/components'), 0777, true);

        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/confirmation-modal.blade.php')));
        
        File::put(resource_path('views/vendor/tc/components/').'confirmation-modal.blade.php', 'Views test');

        $this->artisan('vendor:publish --tag="tall-components-views"');

        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/confirmation-modal.blade.php')));

        $this->assertEquals(
            'Views test',
            file_get_contents(resource_path('views/vendor/tc/components/confirmation-modal.blade.php'))
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

    /** @test */
    public function test_publish_loading_spinner_view_when_not_exists()
    {
        mkdir(resource_path('views/vendor/tc/components'), 0777, true);

        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/loading-spinner.blade.php')));
        
        $this->artisan('vendor:publish --tag="tall-components-views"');

        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/loading-spinner.blade.php')));

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/views/components/loading-spinner.blade.php'),
            file_get_contents(resource_path('views/vendor/tc/components/loading-spinner.blade.php'))
        );
    }

    /** @test */
    public function test_publish_loading_spinner_view_when_already_exists()
    {
        mkdir(resource_path('views/vendor/tc/components'), 0777, true);

        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/loading-spinner.blade.php')));
        
        File::put(resource_path('views/vendor/tc/components/').'loading-spinner.blade.php', 'Views test');

        $this->artisan('vendor:publish --tag="tall-components-views"');

        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/loading-spinner.blade.php')));

        $this->assertEquals(
            'Views test',
            file_get_contents(resource_path('views/vendor/tc/components/loading-spinner.blade.php'))
        );
    }

    /** @test */
    public function test_publish_table_view_when_not_exists()
    {
        mkdir(resource_path('views/vendor/tc/components'), 0777, true);

        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/per-page.blade.php')));
        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/switcher.blade.php')));
        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/table.blade.php')));
        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/td.blade.php')));
        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/th.blade.php')));
        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/tr.blade.php')));
        
        $this->artisan('vendor:publish --tag="tall-components-views"');

        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/per-page.blade.php')));
        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/switcher.blade.php')));
        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/table.blade.php')));
        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/td.blade.php')));
        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/th.blade.php')));
        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/tr.blade.php')));

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/views/components/per-page.blade.php'),
            file_get_contents(resource_path('views/vendor/tc/components/per-page.blade.php'))
        );

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/views/components/switcher.blade.php'),
            file_get_contents(resource_path('views/vendor/tc/components/switcher.blade.php'))
        );

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/views/components/table.blade.php'),
            file_get_contents(resource_path('views/vendor/tc/components/table.blade.php'))
        );

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/views/components/td.blade.php'),
            file_get_contents(resource_path('views/vendor/tc/components/td.blade.php'))
        );

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/views/components/th.blade.php'),
            file_get_contents(resource_path('views/vendor/tc/components/th.blade.php'))
        );

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/views/components/tr.blade.php'),
            file_get_contents(resource_path('views/vendor/tc/components/tr.blade.php'))
        );
    }

    /** @test */
    public function test_publish_table_view_when_already_exists()
    {
        mkdir(resource_path('views/vendor/tc/components'), 0777, true);

        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/per-page.blade.php')));
        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/switcher.blade.php')));
        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/table.blade.php')));
        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/td.blade.php')));
        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/th.blade.php')));
        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/tr.blade.php')));
        
        File::put(resource_path('views/vendor/tc/components/').'per-page.blade.php', 'Views test');
        File::put(resource_path('views/vendor/tc/components/').'switcher.blade.php', 'Views test');
        File::put(resource_path('views/vendor/tc/components/').'table.blade.php', 'Views test');
        File::put(resource_path('views/vendor/tc/components/').'td.blade.php', 'Views test');
        File::put(resource_path('views/vendor/tc/components/').'th.blade.php', 'Views test');
        File::put(resource_path('views/vendor/tc/components/').'tr.blade.php', 'Views test');

        $this->artisan('vendor:publish --tag="tall-components-views"');

        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/per-page.blade.php')));
        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/switcher.blade.php')));
        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/table.blade.php')));
        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/td.blade.php')));
        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/th.blade.php')));
        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/tr.blade.php')));

        $this->assertEquals(
            'Views test',
            file_get_contents(resource_path('views/vendor/tc/components/per-page.blade.php'))
        );

        $this->assertEquals(
            'Views test',
            file_get_contents(resource_path('views/vendor/tc/components/switcher.blade.php'))
        );

        $this->assertEquals(
            'Views test',
            file_get_contents(resource_path('views/vendor/tc/components/table.blade.php'))
        );

        $this->assertEquals(
            'Views test',
            file_get_contents(resource_path('views/vendor/tc/components/td.blade.php'))
        );

        $this->assertEquals(
            'Views test',
            file_get_contents(resource_path('views/vendor/tc/components/th.blade.php'))
        );

        $this->assertEquals(
            'Views test',
            file_get_contents(resource_path('views/vendor/tc/components/tr.blade.php'))
        );
    }

    /** @test */
    public function test_publish_filepond_view_when_not_exists()
    {
        mkdir(resource_path('views/vendor/tc/components'), 0777, true);

        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/filepond.blade.php')));
        
        $this->artisan('vendor:publish --tag="tall-components-views"');

        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/filepond.blade.php')));

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/views/components/filepond.blade.php'),
            file_get_contents(resource_path('views/vendor/tc/components/filepond.blade.php'))
        );
    }

    /** @test */
    public function test_publish_filepond_view_when_already_exists()
    {
        mkdir(resource_path('views/vendor/tc/components'), 0777, true);

        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/filepond.blade.php')));
        
        File::put(resource_path('views/vendor/tc/components/').'filepond.blade.php', 'Views test');

        $this->artisan('vendor:publish --tag="tall-components-views"');

        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/filepond.blade.php')));

        $this->assertEquals(
            'Views test',
            file_get_contents(resource_path('views/vendor/tc/components/filepond.blade.php'))
        );
    }

    /** @test */
    public function test_publish_quill_editor_view_when_not_exists()
    {
        mkdir(resource_path('views/vendor/tc/components'), 0777, true);

        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/quill-editor.blade.php')));
        
        $this->artisan('vendor:publish --tag="tall-components-views"');

        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/quill-editor.blade.php')));

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/views/components/quill-editor.blade.php'),
            file_get_contents(resource_path('views/vendor/tc/components/quill-editor.blade.php'))
        );
    }

    /** @test */
    public function test_publish_quill_editor_view_when_already_exists()
    {
        mkdir(resource_path('views/vendor/tc/components'), 0777, true);

        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/quill-editor.blade.php')));
        
        File::put(resource_path('views/vendor/tc/components/').'quill-editor.blade.php', 'Views test');

        $this->artisan('vendor:publish --tag="tall-components-views"');

        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/quill-editor.blade.php')));

        $this->assertEquals(
            'Views test',
            file_get_contents(resource_path('views/vendor/tc/components/quill-editor.blade.php'))
        );
    }

    /** @test */
    public function test_publish_datetime_picker_view_when_not_exists()
    {
        mkdir(resource_path('views/vendor/tc/components'), 0777, true);

        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/datetime-picker.blade.php')));
        
        $this->artisan('vendor:publish --tag="tall-components-views"');

        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/datetime-picker.blade.php')));

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/views/components/datetime-picker.blade.php'),
            file_get_contents(resource_path('views/vendor/tc/components/datetime-picker.blade.php'))
        );
    }

    /** @test */
    public function test_publish_datetime_picker_view_when_already_exists()
    {
        mkdir(resource_path('views/vendor/tc/components'), 0777, true);

        $this->assertFalse(file_exists(resource_path('views/vendor/tc/components/datetime-picker.blade.php')));
        
        File::put(resource_path('views/vendor/tc/components/').'datetime-picker.blade.php', 'Views test');

        $this->artisan('vendor:publish --tag="tall-components-views"');

        $this->assertTrue(file_exists(resource_path('views/vendor/tc/components/datetime-picker.blade.php')));

        $this->assertEquals(
            'Views test',
            file_get_contents(resource_path('views/vendor/tc/components/datetime-picker.blade.php'))
        );
    }
}