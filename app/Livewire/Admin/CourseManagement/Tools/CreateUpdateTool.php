<?php

namespace App\Livewire\Admin\CourseManagement\Tools;

use App\Livewire\Base\ModalComponent;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

use function PHPUnit\Framework\isEmpty;

class CreateUpdateTool extends ModalComponent
{
    use WithFileUploads;
    public $name;
    public $description;
    public $link;
    public $image;

    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'link' => 'nullable|url',
            'image' => $this->editForm ? 'sometimes|nullable|image|max:3024' : 'required|image|max:3024',
        ];
    }

    public function render()
    {
        return view('livewire.admin.course-management.tools.create-update-tool');
    }

    #[On('reset-form')]
    public function resetForm()
    {
        $this->reset();
    }

    #[On('edit-tool')]
    public function editTool(int $id)
    {
        $this->editForm = true;
        $this->model = \App\Models\Tool::findOrFail($id);
        $this->name = $this->model->name;
        $this->description = $this->model->description;
        $this->link = $this->model->link;
    }

    public function create()
    {
        $this->validate();
        $create = \App\Models\Tool::create([
            'name' => $this->name,
            'description' => $this->description,
            'link' => $this->link,
            'image' => $this->image->store('tools', 'public'),
        ]);
        if ($create) {
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil menambahkan mentor');
        } else {
            $this->dispatch('swal:danger', message: 'Gagal menambahkan mentor');
        }
    }

    public function update()
    {
        $this->validate();
        if (!$this->image) {
            $this->image = $this->model->image;
        } else {
            //delete old image
            if (\File::exists(public_path('storage/' . $this->model->image))) {
                \File::delete(public_path('storage/' . $this->model->image));
            }
            $this->image = $this->image->store('tools', 'public');
        }
        $update = $this->model->update([
            'name' => $this->name,
            'description' => $this->description,
            'link' => $this->link == "" ? null : $this->link,
            'image' => $this->image,
        ]);
        if ($update) {
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil mengubah mentor');
        } else {
            $this->dispatch('swal:danger', message: 'Gagal mengubah mentor');
        }
    }
}
