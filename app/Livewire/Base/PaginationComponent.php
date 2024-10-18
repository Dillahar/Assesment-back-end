<?php

namespace App\Livewire\Base;

use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;


abstract class PaginationComponent extends Component
{
    use WithPagination;

    #[URL(history: true)]
    public int $perPage = 10;

    #[Url(history: true)]
    public string $search = '';
    #[Url(history: true)]
    public string $sortBy = 'created_at';
    #[Url(history: true)]
    public string $sortDir = 'DESC';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = $this->sortDir === 'ASC' ? 'DESC' : 'ASC';
        }
        $this->sortBy = $sortByField;
    }


    #[On('refresh-table')]
    public function refreshTable()
    {
        $this->render();
    }

    #[On('delete-data')]
    abstract public function deleteData(int $id);
}