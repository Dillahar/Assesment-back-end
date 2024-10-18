<?php

namespace App\Livewire\Admin\CourseManagement\Mentors;

use App\Livewire\Base\ModalComponent;
use App\Models\Mentor;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class CreateUpdateMentor extends ModalComponent
{
    use WithFileUploads;
    public $name;
    public $profession;

    public $picture;

    protected function rules()
    {
        $masterRules = [
            'name' => 'required',
            'profession' => 'required',
        ];

        if ($this->editForm) {
            return array_merge($masterRules, [
                'picture' => 'sometimes|nullable|image|max:1024',
            ]);
            
        } else {
            return array_merge($masterRules, [
                'picture' => 'required|image|max:1024',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.course-management.mentors.create-update-mentor');
    }

    #[On('reset-form')]
    public function resetForm()
    {
        $this->reset();
    }

    #[On('edit-mentor')]
    public function editSubCategory(int $id)
    {
        $this->editForm = true;
        $this->model = Mentor::findOrFail($id);
        $this->name = $this->model->name;
        $this->profession = $this->model->profession;
    }

    public function create()
    {
        $this->validate();
        if ($this->picture) {
            $picture = $this->picture->store('mentors', 'public');
            $create = Mentor::create([
                'name' => $this->name,
                'profession' => $this->profession,
                'picture' => $picture,
            ]);
        } else {
            $create = Mentor::create([
                'name' => $this->name,
                'profession' => $this->profession,
            ]);
        }

        if ($create) {
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil menambahkan mentor');
        }
    }

    public function update()
    {
        $this->validate();
        if ($this->picture) {
            $picture = $this->picture->store('mentors', 'public');
            $update = $this->model->update([
                'name' => $this->name,
                'profession' => $this->profession,
                'picture' => $picture,
            ]);
            if ($this->model->picture && \File::exists(public_path('storage/' . $this->model->picture))) {
                \File::delete(public_path('storage/' . $this->model->picture));
            }
        } else {
            $update = $this->model->update([
                'name' => $this->name,
                'profession' => $this->profession,
            ]);
        }

        if ($update) {
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil mengubah mentor');
        }
    }
}
