<?php

namespace TallComponents\Livewire\Traits;

use Livewire\WithPagination;

trait WithTcTable
{
    use WithPagination;

    public string $tcSearch = '';

    public int $tcPerPage = 15;

    public string $tcSortable = '';

    public string $tcSortDirection = 'asc';

    public function updatedTcSearch(): void
    {
        $this->resetPage();
    }

    public function updatedTcPerPage(): void
    {
        $this->resetPage();
    }

    public function changeSorting(string $column): void
    {
        if ($this->tcSortable === $column) {
            $this->tcSortDirection = $this->tcSortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->tcSortable = $column;
            $this->tcSortDirection = 'asc';
        }

        $this->resetPage();
    }
}
