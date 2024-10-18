<?php

namespace App\Livewire\Admin\CourseManagement\SubCategories;

use App\Livewire\Base\PaginationComponent;
use Livewire\Attributes\On;

class SubCategoryList extends PaginationComponent
{
    public function render()
    {
        return view('livewire.admin.course-management.sub-categories.sub-category-list', [
            'categories' => \App\Models\Category::all(),
            'subcategories' => \App\Models\SubCategory::with("category")->search($this->search)
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
        ]);
    }

    #[On('delete-data')]
    public function deleteData(int $id)
    {
        $subCategory = \App\Models\SubCategory::findOrFail($id);
        if ($subCategory->delete()) {
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil menghapus sub-category');
        }
    }
}
