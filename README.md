# TALL components

Library of useful UI components created for TALL (Tailwind CSS, Alpine.js, Laravel, Livewire) stack.

Include:

- [x] [Modal](#modal)
- [x] [Confirmation modal](#confirmation-modal)
- [x] [Notification](#notification)
- [ ] Table (search, filters, sort columns)
- [x] [Loading spinner](#loading-spinner)
- [ ] Drag & drop file upload (Filepond)
- [ ] Markdown editor (Quill)
- [ ] Datetime picker (Flatpickr)
- [ ] Show/hide password input
- [ ] Auto generate slug

## Requirements

This package requires having installed and working Laravel, Tailwind CSS, Alpine.js and Livewire.

The package is created and tested for these frameworks:
- Laravel v10
- Tailwind CSS v3
- Alpine.js v3
- Livewire v3

There can be some differences for other versions.

## Installation

You can install the package via composer:

```bash
composer require vojislavd/tall-components
```

Next, you should compile assets:
```bash
npm install && npm run build
```

Components will use `primary`, `primary-dark`, `secondary` and `secondary-dark` colors. You should configure these colors in your `tailwind.config.js` file.

If you want to change colors or customize anything else, you can publish all components views with:

```bash
php artisan vendor:publish --tag="tall-components-views"
```

To change colors, just find `primary`, `primary-dark`, `secondary` or `secondary-dark` in the component and replace them with color you want to use.

## Usage

### Modal

<img src="https://github-production-user-asset-6210df.s3.amazonaws.com/23532087/303588933-619c5c08-2a43-4653-a1d4-a375b2a93e09.gif?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAVCODYLSA53PQK4ZA%2F20240209%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20240209T080440Z&X-Amz-Expires=300&X-Amz-Signature=8c87a030ec72677e1d80de2be5d8367c06c6738aa2b28b1fbd45cf123dee0511&X-Amz-SignedHeaders=host&actor_id=23532087&key_id=0&repo_id=748995892">

To use modal, you need have boolean variable inside your Livewire component. Modal will be opened or closed based on the value of that variable.

```php
<?php

namespace App\Livewire;

use Livewire\Component;

class MyComponent extends Component
{
    public bool $openModal = false;
}
```

In blade file of the same Livewire component, you should add `<x-tc::modal>` and set `model` property to match boolean variable you added in the PHP file of your Livewire component.

Inside `<x-tc::modal>` tags, you can add any content you want to be present in modal.

```blade
<x-tc-modal model="openModal">
    <h1>This is some title</h1>

    <p>This is some content</p>
</x-tc-modal>
```

The modal can be opened from the blade file, like this:

```blade
<button type="button" wire:click="$set('openModal', true)">
    Open my modal
</button>
```

Or it can be opened from a PHP file, like this:

```php
<?php

namespace App\Livewire;

use Livewire\Component;

class MyComponent extends Component
{
    public bool $openModal = false;

    public function someAction()
    {
        // do something

        $this->openModal = true;
    }
}
```

The same goes for closing the modal, only the value of `openModal` will be set to `false`.

For example, if you want to have a button to close the modal inside the modal itself, you can do it like this:

```blade
<x-tc-modal model="openModal">
    ... Some content of modal

    <button type="button" wire:click="$set('openModal', false)">
        Cancel
    </button>
</x-tc-modal>
```

It's possible to configure the width of the modal by passing a Tailwind CSS class to `width` property of the component. For example:

```blade
<x-tc-modal model="openModal" width="w-1/2">
    ... Some content of modal
</x-tc-modal>
```

You can add action buttons to the bottom of the modal like this:

```blade
<x-tc-modal model="openModal">
    ... Some content of modal

    <x-slot::action>
        <button>Cancel</button>
        <button>Submit</button>
    </x-slot::action>
</x-tc-modal>
```

### Confirmation modal

<img src="https://github-production-user-asset-6210df.s3.amazonaws.com/23532087/307432748-21b2a56a-ea47-46c8-84b7-7a572bc60e67.gif?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAVCODYLSA53PQK4ZA%2F20240223%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20240223T193650Z&X-Amz-Expires=300&X-Amz-Signature=b83c341cf492fefbea709a4a1d937cd2b13e30337c45e6571cc8e0bcbf1cbd90&X-Amz-SignedHeaders=host&actor_id=23532087&key_id=0&repo_id=748995892">

To use the confirmation modal, you need to add the `x-tc-confirmation-modal` component and the `WithTcConfirmation` trait to the Livewire component where you want to use it.

```php
<?php

namespace App\Livewire;

use Livewire\Component;
use TallComponents\Livewire\Traits\WithTcConfirmation;

class MyComponent extends Component
{
    use WithTcConfirmation;
}
```
```blade
<x-tc-confirmation-modal />
```

Then, to require confirmation for some action, you should add `x-tc-confirm` to the button from which you want to trigger the confirmation modal and pass `title`, `message`, and `action`.

`action` should be a Livewire method you want to call after the user clicks the "Confirm" button in the modal.

```blade
<button 
    type="button" 
    x-tc-confirm="{ 
        title: 'Delete user', 
        message: 'Are you sure you want to delete this user?', 
        action: 'deleteUser' 
    }
>
    Delete user
</button>
```

While the `title` parameter is optional, `message` and `action` are required, and the component will not work without them.

If you want to use the confirmation modal with multiple actions on the same Livewire component, it's enough to add it only once. Alternatively, if you want to have it on all pages, you can include it in your layout file. Just make sure you have the `WithTcConfirmation` trait in your Livewire component.

### Notification

<img src="https://github-production-user-asset-6210df.s3.amazonaws.com/23532087/303828514-2350f461-0f4a-4eea-bb37-84078252b8cd.gif?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAVCODYLSA53PQK4ZA%2F20240210%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20240210T103208Z&X-Amz-Expires=300&X-Amz-Signature=ad36e097dab1313849d1af4b507961fbcb047f1d177bf97baffb33c4fed46cf7&X-Amz-SignedHeaders=host&actor_id=23532087&key_id=0&repo_id=748995892">

You can display notifications on the same page without reloading, or you can redirect to some other page and display notifications on that page.

To use notifications, the recommended way is to add them to your layout file, so notifications will be available on all pages.

You should add this Livewire component at the end of the file, before `@livewireScripts`.

```blade
@livewire('tc-notification)

// or

<livewire:tc-notification>
```

If you want to display notifications from a Livewire component without reloading the page, all you need to do is dispatch `notification` event with the message you want to display, like this:

```php
<?php

namespace App\Livewire;

use Livewire\Component;

class MyComponent extends Component
{
    public function someAction()
    {
        // do something

        $this->dispatch('notification', 'Message to display in notification');
    }
}
```

If you want to redirect to some other page and display a notification there, you can do it like this:

```php
<?php

namespace App\Livewire;

use Livewire\Component;

class MyComponent extends Component
{
    public function someAction()
    {
        // do something

        return to_route('some-route-name')
            ->with('notification', 'Message to display in notification');
    }
}
```

Notification will disappear by default after 5 seconds (5000 ms). To change that, you need to pass the duration parameter to the component. Duration is represented in milliseconds.

For example, to change the notification to disappear after 3 seconds, you can do it like this:

```blade
@livewire('tc-notification, ['duration' => 3000])

// or

<livewire:tc-notification :duration="3000">
```

### Loading spinner

<img src="https://github-production-user-asset-6210df.s3.amazonaws.com/23532087/307294583-679ee54f-5524-4a03-b522-a99b6038b99d.gif?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAVCODYLSA53PQK4ZA%2F20240223%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20240223T103953Z&X-Amz-Expires=300&X-Amz-Signature=49cdb8b68d482b0221635b136c05b3358735cbaf5796a95232b7b350bdf08984&X-Amz-SignedHeaders=host&actor_id=23532087&key_id=0&repo_id=748995892">

Add `<x-tc-loading-spinner />` to your blade and add a `target` attribute that should match the Livewire action you want to use the spinner for.

```blade
<x-tc-loading-spinner target="someAction" />
```

```php
<?php

namespace App\Livewire;

use Livewire\Component;

class MyComponent extends Component
{
    public function someAction()
    {
        // Display spinner while this method executing
    }
}
```

If you want to change the style of the spinner, you can add a `class` with the changes you want to implement.

For example, you can change the size of the spinner like this:

```blade
<x-tc-loading-spinner target="someAction" class="!w-10 !h-10" />
```

Or if you want to make some other changes, you can publish the view file and do it there.

## Testing
Run tests with:

```bash
composer test
```

## Credits

- [Vojislav Dragicevic](https://vojislavd.com/)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
