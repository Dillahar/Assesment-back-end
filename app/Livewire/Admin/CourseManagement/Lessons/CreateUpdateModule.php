<?php

namespace App\Livewire\Admin\CourseManagement\Lessons;

use App\Livewire\Base\ModalComponent;
use Livewire\Attributes\On;

class CreateUpdateModule extends ModalComponent
{
    public $title;
    public $course_id;

    protected $rules = [
        'title' => 'required',
    ];

    public function render()
    {
        return view('livewire.admin.course-management.lessons.create-update-module');
    }

    #[On('reset-form')]
    public function resetForm()
    {
        $this->title = null;
        //$this->model = null;
        $this->editForm = false;
    }

    #[On('edit-module')]
    public function editModule(int $id)
    {
        $this->editForm = true;
        $this->model = \App\Models\CourseModule::findOrFail($id);
        $this->title = $this->model->title;
    }

    public function create()
    {
        $this->validate();
        $create = \App\Models\CourseModule::create([
            'course_id' => $this->course_id,
            'title' => $this->title,
        ]);
        if($create){
            $this->dispatch('swal:success', message: 'Berhasil menambahkan module');
            $this->dispatch("refresh-list");
        }
    }

    public function update()
    {
        $this->validate();
        $update = $this->model->update([
            'title' => $this->title,
        ]);
        if($update){
            $this->dispatch('swal:success', message: 'Berhasil mengubah module');
            $this->dispatch("refresh-list");
        }
    }


}
