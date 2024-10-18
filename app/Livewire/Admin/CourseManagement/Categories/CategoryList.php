<?php

namespace App\Livewire\Admin\CourseManagement\Categories;

use App\Livewire\Base\PaginationComponent;
use Livewire\Attributes\On;

class CategoryList extends PaginationComponent
{
    public function render()
    {
        return view('livewire.admin.course-management.categories.category-list', [
            'categories' => \App\Models\Category::search($this->search)
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
        ]);
    }

    #[On('delete-data')]
    public function deleteData(int $id)
    {
        $category = \App\Models\Category::findOrFail($id);
        if ($category->delete()) {
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil menghapus category');
        }
    }
}
