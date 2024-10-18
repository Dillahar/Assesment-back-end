<?php

namespace App\Livewire\Admin\CourseManagement\SubCategories;

use Livewire\Component;
use App\Livewire\Base\ModalComponent;
use App\Models\Category;
use Livewire\Attributes\On;

class CreateUpdateSubCategory extends ModalComponent
{

    public $category_id;
    public $name;

    protected $rules = [
        'category_id' => 'required|exists:categories,id',
        'name' => 'required',
    ];

    public function render()
    {
        return view('livewire.admin.course-management.sub-categories.create-update-sub-category', [
            'categories' => Category::all(),
        ]);
    }

    #[On('reset-form')]
    public function resetForm()
    {
        $this->reset();
    }

    #[On('edit-sub-category')]
    public function editSubCategory(int $id)
    {
        $this->editForm = true;
        $this->model = \App\Models\SubCategory::findOrFail($id);
        $this->category_id = $this->model->category_id;
        $this->name = $this->model->name;
    }

    public function create()
    {
        $this->validate();
        $subCategory = \App\Models\SubCategory::create([
            'category_id' => $this->category_id,
            'name' => $this->name,
        ]);

        if($subCategory){
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil menambahkan sub-category');
        }
    }

    public function update()
    {
        $this->validate();
        $this->model->update([
            'category_id' => $this->category_id,
            'name' => $this->name,
        ]);
        $this->dispatch('refresh-table');
        $this->dispatch('swal:success', message: 'Berhasil mengubah sub-category');
    }
}
