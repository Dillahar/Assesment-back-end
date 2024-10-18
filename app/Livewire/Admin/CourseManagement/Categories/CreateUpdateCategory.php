<?php

namespace App\Livewire\Admin\CourseManagement\Categories;

use App\Livewire\Base\ModalComponent;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class CreateUpdateCategory extends ModalComponent
{
    use WithFileUploads;
    public $name;
    public $background;

    protected function rules(){
        return [
            'name' => 'required',
            'background' => $this->editForm ? 'sometimes|nullable|image|max:10024' : 'required|image|max:10024', 
        ];    
    }
    public function render()
    {
        return view('livewire.admin.course-management.categories.create-update-category');
    }
    #[On('reset-form')]
    public function resetForm()
    {
        $this->reset();
    }

    #[On('edit-category')]
    public function editCategory(int $id)
    {
        $this->editForm = true;
        $this->model = Category::findOrFail($id);
        $this->name = $this->model->name;
    }

    public function create()
    {
        $this->validate();
        $category = Category::create([
            'name' => $this->name,
            'background' => $this->background->store('categories', 'public'),
        ]);

        if($category){
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil menambahkan category');
        }
    }

    public function update()
    {
        $this->validate();
        if ($this->background) {
            if ($this->model->background) {
                \Storage::disk('public')->delete($this->model->background);
            }
            $this->model->update([
                'background' => $this->background->store('categories', 'public'),
            ]);
        }
        $this->model->update([
            'name' => $this->name
        ]);
        $this->dispatch('refresh-table');
        $this->dispatch('swal:success', message: 'Berhasil mengubah category');
    }
}
