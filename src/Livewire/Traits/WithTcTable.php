<?php

namespace TallComponents\Livewire\Traits;

use Livewire\WithPagination;

trait WithTcTable
{
    use WithPagination;

    public string $tcSearch = '';

    public int $tcPerPage = 15;

    public function updatedTcSearch(): void
    {
        $this->resetPage();
    }

    public function updatedTcPerPage(): void
    {
        $this->resetPage();
    }
}
