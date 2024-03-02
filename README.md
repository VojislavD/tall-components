# TALL components

Library of useful UI components created for TALL (Tailwind CSS, Alpine.js, Laravel, Livewire) stack.

Include:

- [x] [Modal](#modal)
- [x] [Confirmation modal](#confirmation-modal)
- [x] [Notification](#notification)
- [x] [Table (search, filters, sort columns)](#table)
- [x] [Loading spinner](#loading-spinner)
- [x] [Drag & drop file upload (Filepond)](#drag--drop-file-upload-filepond)
- [x] [Markdown editor (Quill)](#markdown-editor-quill)
- [x] [Datetime picker (Flatpickr)](#datetime-picker-flatpickr)

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

You need to include `tc.js` in your `resources/js/app.js` file:
```js
import './../../vendor/vojislavd/tall-components/resources/js/tc.js'
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

<img src="https://private-user-images.githubusercontent.com/23532087/308881249-288208fd-732f-4828-abd4-1d9a0a3e46d5.gif?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MDkyMDEzOTQsIm5iZiI6MTcwOTIwMTA5NCwicGF0aCI6Ii8yMzUzMjA4Ny8zMDg4ODEyNDktMjg4MjA4ZmQtNzMyZi00ODI4LWFiZDQtMWQ5YTBhM2U0NmQ1LmdpZj9YLUFtei1BbGdvcml0aG09QVdTNC1ITUFDLVNIQTI1NiZYLUFtei1DcmVkZW50aWFsPUFLSUFWQ09EWUxTQTUzUFFLNFpBJTJGMjAyNDAyMjklMkZ1cy1lYXN0LTElMkZzMyUyRmF3czRfcmVxdWVzdCZYLUFtei1EYXRlPTIwMjQwMjI5VDEwMDQ1NFomWC1BbXotRXhwaXJlcz0zMDAmWC1BbXotU2lnbmF0dXJlPTdmNTA2MTNkMzM5NmNmY2NiOTUzNWU4ZjM0ZmZjYzlmYjUwZmNlZmYwMWQxMWRiMDI4YjExODdiMGNhOTM0Y2EmWC1BbXotU2lnbmVkSGVhZGVycz1ob3N0JmFjdG9yX2lkPTAma2V5X2lkPTAmcmVwb19pZD0wIn0.kDqXYY6O2roS-V_0UDpFZKYHjs9GuWCgtA-lAwufa3I">

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

<img src="https://private-user-images.githubusercontent.com/23532087/308881253-9255a8d6-672e-450b-86df-4bafb47e87bb.gif?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MDkyMDEzOTQsIm5iZiI6MTcwOTIwMTA5NCwicGF0aCI6Ii8yMzUzMjA4Ny8zMDg4ODEyNTMtOTI1NWE4ZDYtNjcyZS00NTBiLTg2ZGYtNGJhZmI0N2U4N2JiLmdpZj9YLUFtei1BbGdvcml0aG09QVdTNC1ITUFDLVNIQTI1NiZYLUFtei1DcmVkZW50aWFsPUFLSUFWQ09EWUxTQTUzUFFLNFpBJTJGMjAyNDAyMjklMkZ1cy1lYXN0LTElMkZzMyUyRmF3czRfcmVxdWVzdCZYLUFtei1EYXRlPTIwMjQwMjI5VDEwMDQ1NFomWC1BbXotRXhwaXJlcz0zMDAmWC1BbXotU2lnbmF0dXJlPTQ1YTkyNjBmNDA4YTQ1ODlmZmUwY2EzNWU2M2Y3OGFkMmRhMzkyY2NiZGJkZTY2OWJlOGRjNzk2Mjc1NWUwNjUmWC1BbXotU2lnbmVkSGVhZGVycz1ob3N0JmFjdG9yX2lkPTAma2V5X2lkPTAmcmVwb19pZD0wIn0.fI9dUoXd8awJWUjMEwavvKJu7eIZlyjpR3a_pgvWsjE">

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

<img src="https://private-user-images.githubusercontent.com/23532087/308881252-8d9b77cd-8c5d-452a-a641-14c5cd950938.gif?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MDkyMDEzOTQsIm5iZiI6MTcwOTIwMTA5NCwicGF0aCI6Ii8yMzUzMjA4Ny8zMDg4ODEyNTItOGQ5Yjc3Y2QtOGM1ZC00NTJhLWE2NDEtMTRjNWNkOTUwOTM4LmdpZj9YLUFtei1BbGdvcml0aG09QVdTNC1ITUFDLVNIQTI1NiZYLUFtei1DcmVkZW50aWFsPUFLSUFWQ09EWUxTQTUzUFFLNFpBJTJGMjAyNDAyMjklMkZ1cy1lYXN0LTElMkZzMyUyRmF3czRfcmVxdWVzdCZYLUFtei1EYXRlPTIwMjQwMjI5VDEwMDQ1NFomWC1BbXotRXhwaXJlcz0zMDAmWC1BbXotU2lnbmF0dXJlPTdmZTk5MDlhZjE4Y2FjZDA5MTMwZmI0MDk1NDE1MDRhZGU4MTMzZjI2ZjRhNWJhMzRjMGVmY2ZhMGJkZjA1MWUmWC1BbXotU2lnbmVkSGVhZGVycz1ob3N0JmFjdG9yX2lkPTAma2V5X2lkPTAmcmVwb19pZD0wIn0.83YOsLDwqIKsHDHup44epEjP9chbivo7IF7Qml_nWtg">

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

### Table

<img src="https://private-user-images.githubusercontent.com/23532087/308881251-e8b5a309-d7f0-414c-989a-8726eda5db22.gif?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MDkyMDEzOTQsIm5iZiI6MTcwOTIwMTA5NCwicGF0aCI6Ii8yMzUzMjA4Ny8zMDg4ODEyNTEtZThiNWEzMDktZDdmMC00MTRjLTk4OWEtODcyNmVkYTVkYjIyLmdpZj9YLUFtei1BbGdvcml0aG09QVdTNC1ITUFDLVNIQTI1NiZYLUFtei1DcmVkZW50aWFsPUFLSUFWQ09EWUxTQTUzUFFLNFpBJTJGMjAyNDAyMjklMkZ1cy1lYXN0LTElMkZzMyUyRmF3czRfcmVxdWVzdCZYLUFtei1EYXRlPTIwMjQwMjI5VDEwMDQ1NFomWC1BbXotRXhwaXJlcz0zMDAmWC1BbXotU2lnbmF0dXJlPWNlNDg1NmI4OWRjOGI5NzFjNGE0YjJlY2NjMDJkZTk1ZWM4MzIyMGFkNGU1N2E1OTAzNzc1ZDNhMWQyYzYzNTcmWC1BbXotU2lnbmVkSGVhZGVycz1ob3N0JmFjdG9yX2lkPTAma2V5X2lkPTAmcmVwb19pZD0wIn0.4cKTSq05mHt7BXKla0Ka_9nKuQz_ZpXsioRDG_tremE">

You can use a table in the blade file of your Livewire component like this:

```blade
<x-tc-table>
    <x-slot:search></x-slot:search>

    <x-slot:filters>
        <x-tc-switcher wire:model.live="onlyActive" label="Only active" />
    </x-slot:filters>

    <x-slot:per-page>
        <x-tc-per-page :options="[5, 15, 30]" />
    </x-slot:per-page>

    <x-slot:heading>
        <x-tc-th sortable="name">
            Name
        </x-tc-th>
        <x-tc-th sortable="email">
            Email
        </x-tc-th>
        <x-tc-th>
            Status
        </x-tc-th>
        <x-tc-th>
            Created at
        </x-tc-th>
    </x-slot:heading>

    @forelse($this->users as $user)
        <x-tc-tr href="{{ route('users.show', $user) }}" :index="$loop->index">
            <x-tc-td>
                {{ $user->name }}
            </x-tc-td>
            <x-tc-td>
                {{ $user->email }}
            </x-tc-td>
            <x-tc-td>
                {{ $user->status }}
            </x-tc-td>
            <x-tc-td>
                {{ $user->created_at->format('d.m.Y H:i') }}
            </x-tc-td>
        </x-tc-tr>
    @empty
        <x-tc-tr>
            <x-tc-td colspan="4">
                There is no results
            </x-tc-td>
        </x-tc-tr>
    @endforelse 

    <x-slot:pagination>
        {{ $this->users->links() }}
    </x-slot:pagination>
</x-tc-table>
```

And in Livewire component, you need to add the `WithTcTable` trait. When you are getting rows for the table (such as `$this->users` in this example), you can use filters like this:

```php
<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;
use TallComponents\Livewire\Traits\WithTcTable;

class MyComponent extends Component
{
    use WithTcTable;

    public bool $onlyActive = false;

    #[Computed]
    public function users(): LengthAwarePaginator|Model
    {
        return User::query()
            ->when($this->tcSearch, function ($query) {
                $query->where('name', 'LIKE', '%' . $this->tcSearch . '%');
            })
            ->when($this->onlyActive, function ($query) {
                $query->where('is_active', true);
            })
            ->when($this->tcSortable === 'name', function ($query) {
                $query->orderBy('name', $this->tcSortDirection);
            })
            ->when($this->tcSortable === 'email', function ($query) {
                $query->orderBy('email', $this->tcSortDirection);
            })
            ->paginate($this->tcPerPage);
    }
}
```
#### Clickable rows
It is possible to allow rows to be clickable by adding the `href` attribute to the `x-tc-tr` component and passing the value where you want to be redirected.

For example, to redirect to the user profile page with the route name `users.show`, you can do it like this:

```blade
<x-tc-tr :href="route('users.show', $user)" :index="$loop->index">
```

#### Search filter
Search filter is optional; if you don't need it, you can leave out `<x-slot:search></x-slot:search>`. In that case, there will be no input for searching the table.

The value of the search input is stored in the `tcSearch` variable. So, to filter the table based on the value from that field, you need to use `$this->tcSearch`.

#### Custom filters
You can add any custom filter you want (In the case above, it's the `Only active` filter). You can pass any toggle, checkbox, or select input inside the `<x-slot:filters>` slot.

#### Per page filter
Per page filter is optional; if you don't need it, you can leave out `<x-slot:per-page>`.


The value of per page is stored in the `tcPerPage` variable, and it is `15` by default. To use it, you need to pass `$this->tcPerPage` to your `paginate` method, like this:

```php
...
->paginate($this->tcPerPage);
```

You can customize the number of rows users can choose by passing values as the `options` attribute to the `x-tc-per-page` component. For example, if you want to allow users to choose between `15`, `30`, and `50`, you can do it like this:

```blade
<x-slot:per-page>
    <x-tc-per-page :options="[15, 30, 50]" />
</x-slot:per-page>
```

#### Sort by columns
You can allow sorting by any column in the table by adding `sortable` to the `<x-tc-th>` component and by passing the key for sorting, which you will use in Livewire components.

For example, if you want to allow sorting by user name, you can do it like this:

```blade
<x-tc-th sortable="name">
    Name
</x-tc-th>
```

And then you can sort results based on name like this:

```php
...
->when($this->tcSortable === 'name', function ($query) {
    $query->orderBy('name', $this->tcSortDirection);
})
```
Name of the sortable column is stored in `tcSortable`, and direction is stored in the `tcSortDirection` variable. Direction will be `asc` by default and will switch between `asc` and `desc` on every click.

#### Pagination
Pagination is optional; if you don't need it, you can leave out `<x-slot:pagination></x-slot:pagination>`.

### Loading spinner

<img src="https://private-user-images.githubusercontent.com/23532087/308881250-1fcda036-325a-4eb7-88d2-388814b72fec.gif?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MDkyMDEzOTQsIm5iZiI6MTcwOTIwMTA5NCwicGF0aCI6Ii8yMzUzMjA4Ny8zMDg4ODEyNTAtMWZjZGEwMzYtMzI1YS00ZWI3LTg4ZDItMzg4ODE0YjcyZmVjLmdpZj9YLUFtei1BbGdvcml0aG09QVdTNC1ITUFDLVNIQTI1NiZYLUFtei1DcmVkZW50aWFsPUFLSUFWQ09EWUxTQTUzUFFLNFpBJTJGMjAyNDAyMjklMkZ1cy1lYXN0LTElMkZzMyUyRmF3czRfcmVxdWVzdCZYLUFtei1EYXRlPTIwMjQwMjI5VDEwMDQ1NFomWC1BbXotRXhwaXJlcz0zMDAmWC1BbXotU2lnbmF0dXJlPTA5ZTllYjJkOWQ5YjNmOTcxMGUwODcyOGYzYmEwZWM2OTI5NDg5NDQ4MzI2NDA2YTUyZTk0NGM5ODBkZDQ0MjkmWC1BbXotU2lnbmVkSGVhZGVycz1ob3N0JmFjdG9yX2lkPTAma2V5X2lkPTAmcmVwb19pZD0wIn0.ceObB3mecs1wIaoghodafNQpFgoG07h_J4abUFhLzCY">

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

### Drag & drop file upload (Filepond)

<img src="https://private-user-images.githubusercontent.com/23532087/309271344-3e9616e6-54ed-41da-83b9-c221b7f1609c.gif?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MDkyOTkxNTEsIm5iZiI6MTcwOTI5ODg1MSwicGF0aCI6Ii8yMzUzMjA4Ny8zMDkyNzEzNDQtM2U5NjE2ZTYtNTRlZC00MWRhLTgzYjktYzIyMWI3ZjE2MDljLmdpZj9YLUFtei1BbGdvcml0aG09QVdTNC1ITUFDLVNIQTI1NiZYLUFtei1DcmVkZW50aWFsPUFLSUFWQ09EWUxTQTUzUFFLNFpBJTJGMjAyNDAzMDElMkZ1cy1lYXN0LTElMkZzMyUyRmF3czRfcmVxdWVzdCZYLUFtei1EYXRlPTIwMjQwMzAxVDEzMTQxMVomWC1BbXotRXhwaXJlcz0zMDAmWC1BbXotU2lnbmF0dXJlPWM1MTA0OGRhMGJhNDIxOWQ2NTk2YmI2MjI5ODFhNDU4N2M0MGJkZDdmYmU3NmI3ODEyY2M1OGI4ODUwZTU1NGImWC1BbXotU2lnbmVkSGVhZGVycz1ob3N0JmFjdG9yX2lkPTAma2V5X2lkPTAmcmVwb19pZD0wIn0.SaTdWlzuv3_IOrkKD8Iz9Yzm6y8ZrZwJ2tGhX9HkuhA">

To use a field for file uploading, you need to add `<x-tc-filepond>` to your blade and set `wire:model`.
```blade
<x-tc-filepond wire:model="state.file" />
```

When file is uploaded it will be standard Livewire temporary uploaded file (`Livewire\Features\SupportFileUploads\TemporaryUploadedFile`) and you can save it as any other file upload.

If you want to call a Livewire action immediately after a file is uploaded, you can add `callOnUpload` to the component and pass the name of the Livewire method you want to be called. For example, to call the `saveFile` method after a file is uploaded:
```blade
<x-tc-filepond 
    wire:model="state.file" 
    callOnUpload="saveFile" 
/>
```

You can reset Filepond field from Livewire by dispatching event that will match `resetKey` of component. For example:
```blade
<x-tc-filepond 
    wire:model="state.file" 
    callOnUpload="saveFile" 
    resetKey="resetFileField" 
/>
```
```php
<?php

namespace App\Livewire;

use Livewire\Component;

class MyComponent extends Component
{
    public function saveFile()
    {
        // Save file

        $this->dispatch('resetFileField');
    }
}
```

The component allows different configurations, with the following available properties:
| PROPERTY                | DEFAULT VALUE | DESCRIPTION                                                                         |
|-------------------------|---------------|-------------------------------------------------------------------------------------|
| allowDrop               | `true`        | Enable or disable drag n' drop                                                      |
| allowBrowse             | `true`        | Enable or disable file browser                                                      |
| allowPaste              | `true`        | Enable or disable pasting of files. Pasting files is not supported on all browsers  |
| allowMultiple           | `false`       | Enable or disable adding multiple files                                             |
| allowFileSizeValidation | `true`        | Enable or disable file size validation                                              |
| minFileSize             | `null`        | The minimum size of a file, for instance `5MB` or `750KB`                           |
| maxFileSize             | `null`        | The maximum size of a file, for instance `5MB` or `750KB`                           |
| allowFileTypeValidation | `true`        | Enable or disable file type validation                                              |
| acceptedFileTypes       | `[]`          | Array of accepted file types. Can be mime types or wild cards. For instance ['image/*'] will accept all images. ['image/png', 'image/jpeg'] will only accepts PNGs and JPEGs. |
| allowImagePreview       | `true`        | Enable or disable preview mode                                                      |
| imagePreviewMinHeight   | `44`          | Minimum image preview height                                                        |
| imagePreviewMaxHeight   | `256`         | Maximum image preview height                                                        |

If you want to make other changes, you can publish views and edit the `filepond.blade.php` file.

### Markdown editor (Quill)

<img src="https://private-user-images.githubusercontent.com/23532087/309473465-4de3a416-2d01-4f3d-a41a-c2cb8b9f60c6.gif?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MDkzODMyMzMsIm5iZiI6MTcwOTM4MjkzMywicGF0aCI6Ii8yMzUzMjA4Ny8zMDk0NzM0NjUtNGRlM2E0MTYtMmQwMS00ZjNkLWE0MWEtYzJjYjhiOWY2MGM2LmdpZj9YLUFtei1BbGdvcml0aG09QVdTNC1ITUFDLVNIQTI1NiZYLUFtei1DcmVkZW50aWFsPUFLSUFWQ09EWUxTQTUzUFFLNFpBJTJGMjAyNDAzMDIlMkZ1cy1lYXN0LTElMkZzMyUyRmF3czRfcmVxdWVzdCZYLUFtei1EYXRlPTIwMjQwMzAyVDEyMzUzM1omWC1BbXotRXhwaXJlcz0zMDAmWC1BbXotU2lnbmF0dXJlPWY5NDljOWQ5MGIxNTMwMjBjOTE5NWIzZmVkZmFiODkxNzkxNjM3ZTk2MGIwOThjNjUyOGQyZTNiNjBlYmNlNjMmWC1BbXotU2lnbmVkSGVhZGVycz1ob3N0JmFjdG9yX2lkPTAma2V5X2lkPTAmcmVwb19pZD0wIn0.RK-YhARLRIRcJRYytuR5wfhdsPuNJoaqRlAcoWZ3Ch8">

To use a Quill text editor, you need to add `<x-tc-quill-editor>` to your blade and set `wire:model` (it's not possible to use `live` or `blur`).
```blade
<x-tc-quill-editor wire:model="state.text" />
```

You can add placeholder text by passing the `placeholder` attribute to the component.
```blade
<x-tc-quill-editor 
    wire:model="state.text" 
    placeholder="Write some text here..."
/>
```

It's possible to make the editor read-only; just pass the `readOnly` attribute and set it to be true.
```blade
<x-tc-quill-editor 
    wire:model="state.text" 
    readOnly="true"
/>
```

Editor will include all editing options in the toolbar by default. You can configure it by passing the `toolbar` attribute to the component with the editing options you want to use. For example, if you want to have only the `bold`, `italic`, and `underline` options:
```blade
<x-tc-quill-editor 
    wire:model="state.text" 
    toolbar="['bold', 'italic', 'underline']"
/>
```

Editor's default toolbar:
```
['bold', 'italic', 'underline', 'strike'],
['blockquote', 'code-block'],
['link', 'formula'],

[{ 'header': 1 }, { 'header': 2 }], 
[{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
[{ 'script': 'sub'}, { 'script': 'super' }],
[{ 'indent': '-1'}, { 'indent': '+1' }],
[{ 'direction': 'rtl' }],

[{ 'size': ['small', false, 'large', 'huge'] }],
[{ 'header': [1, 2, 3, 4, 5, 6, false] }],

[{ 'color': [] }, { 'background': [] }],
[{ 'font': [] }],
[{ 'align': [] }],

['clean']
```

If you want to change the theme of the editor or make any other modifications, you can publish views and edit the `quill-editor.blade.php` file.

### Datetime picker (Flatpickr)

<img src="https://private-user-images.githubusercontent.com/23532087/309473466-da64cac0-22fc-41c7-9bee-da2fe7b85255.gif?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MDkzODMyMzMsIm5iZiI6MTcwOTM4MjkzMywicGF0aCI6Ii8yMzUzMjA4Ny8zMDk0NzM0NjYtZGE2NGNhYzAtMjJmYy00MWM3LTliZWUtZGEyZmU3Yjg1MjU1LmdpZj9YLUFtei1BbGdvcml0aG09QVdTNC1ITUFDLVNIQTI1NiZYLUFtei1DcmVkZW50aWFsPUFLSUFWQ09EWUxTQTUzUFFLNFpBJTJGMjAyNDAzMDIlMkZ1cy1lYXN0LTElMkZzMyUyRmF3czRfcmVxdWVzdCZYLUFtei1EYXRlPTIwMjQwMzAyVDEyMzUzM1omWC1BbXotRXhwaXJlcz0zMDAmWC1BbXotU2lnbmF0dXJlPTE5YWJkYzUxOTU5MDRjYTJlYThlYzQyYTUwNDVkMGZjNjgwOTcwOGJkNjg4MTEzMzcxODJmNTVjODkxZjIyNzImWC1BbXotU2lnbmVkSGVhZGVycz1ob3N0JmFjdG9yX2lkPTAma2V5X2lkPTAmcmVwb19pZD0wIn0.-jTYX0XL859Cefd1D5zNs8vv2HRrJHlVA2vlyeTujwo">

To use the datetime picker, you need to add `<x-tc-datetime-picker>` to your blade and set `wire:model`.

```blade
<x-tc-datetime-picker wire:model="state.datetime" />
```

To add a placeholder, just pass the `placeholder` attribute to components:
```blade
<x-tc-datetime-picker 
    wire:model="state.datetime" 
    placeholder="Select datetime..." 
/>
```

The component allows for different configurations; you can pass attributes to the component to change its configuration.

Available properties:
| PROPERTY     | TYPE        | DEFAULT VALUE | EXAMPLE VALUE                    |
|--------------|-------------|---------------|----------------------------------|
| dateFormat   | String      | `Y-m-d`       | `d.m.Y`                          |
| minDate      | String/Date | `null`        | `2024-03-01`                     |
| maxDate      | String/Date | `null`        | `2024-03-10`                     |
| defaultDate  | String      | `null`        | `2024-03-02`                     |
| enableTime   | Boolean     | `false`       | `true`                           |
| time_24hr    | Boolean     | `false`       | `true`                           |
| minTime      | String      | `null`        | `09:00`                          |
| maxTime      | String      | `null`        | `11:00`                          |
| mode         | String      | `single`      | `single`, `multiple`, or `range` |
| noCalendar   | Boolean     | `false`       | `true`                           |

If you want to make additional changes, you can publish views and edit the `datetime-picker.blade.php` file.

## Testing
Run tests with:

```bash
composer test
```

## Credits

- [Vojislav Dragicevic](https://vojislavd.com/)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
