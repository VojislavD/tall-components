# TALL components

Library of useful UI components created for TALL (Tailwind CSS, Alpine.js, Laravel, Livewire) stack.

Include:

- [x] [Modal](#modal)
- [ ] Confirmation modal
- [ ] Notification
- [ ] Table (search, filters, sort columns)
- [ ] Loading spinner
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

If you want to change colors or customize anything else, you can publish all components with:

```bash
php artisan vendor:publish --tag="tall-components"
```

To change colors, just find `primary`, `primary-dark`, `secondary` or `secondary-dark` in the component and replace them with color you want to use.

## Usage

### Modal

<img src="https://private-user-images.githubusercontent.com/23532087/302423745-52b0b6dd-77e6-454d-91d8-90e83507959e.gif?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MDcxNjYyNDksIm5iZiI6MTcwNzE2NTk0OSwicGF0aCI6Ii8yMzUzMjA4Ny8zMDI0MjM3NDUtNTJiMGI2ZGQtNzdlNi00NTRkLTkxZDgtOTBlODM1MDc5NTllLmdpZj9YLUFtei1BbGdvcml0aG09QVdTNC1ITUFDLVNIQTI1NiZYLUFtei1DcmVkZW50aWFsPUFLSUFWQ09EWUxTQTUzUFFLNFpBJTJGMjAyNDAyMDUlMkZ1cy1lYXN0LTElMkZzMyUyRmF3czRfcmVxdWVzdCZYLUFtei1EYXRlPTIwMjQwMjA1VDIwNDU0OVomWC1BbXotRXhwaXJlcz0zMDAmWC1BbXotU2lnbmF0dXJlPWRkM2NiMmYwYWFmZDExNWFkNGE4Nzg1YmRlOTNmNTI1ODE5MTIzY2Q5MjU1YWRlMzgwZWEzOGVlNGIyOGYyOTUmWC1BbXotU2lnbmVkSGVhZGVycz1ob3N0JmFjdG9yX2lkPTAma2V5X2lkPTAmcmVwb19pZD0wIn0.YkZgd5ltZf6XxPA9OXYX0KUOryzNTXn2e9BfUjlsIy4">

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
<x-tc::modal model="openModal">
    <h1>This is some title</h1>

    <p>This is some content</p>
</x-tc::modal>
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
<x-tc::modal model="openModal">
    ... Some content of modal

    <button type="button" wire:click="$set('openModal', false)">
        Cancel
    </button>
</x-tc::modal>
```

It's possible to configure the width of the modal by passing a Tailwind CSS class to `width` property of the component. For example:

```blade
<x-tc::modal model="openModal" width="w-1/2">
    ... Some content of modal
</x-tc::modal>
```

You can add action buttons to the bottom of the modal like this:

```blade
<x-tc::modal model="openModal">
    ... Some content of modal

    <x-slot::action>
        <button>Cancel</button>
        <button>Submit</button>
    </x-slot::action>
</x-tc::modal>
```
## Testing
Run tests with:

```bash
composer test
```

## Credits

- [Vojislav Dragicevic](https://vojislavd.com/)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.