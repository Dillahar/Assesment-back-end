<?php

namespace App\Livewire\Admin\CourseManagement\Lessons;

use Livewire\Component;
use Livewire\Attributes\On;

class LessonList extends Component
{
    public $course;
    public function mount($id)
    {
        $this->course = \App\Models\Course::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.admin.course-management.lessons.lesson-list');
    }

    #[On('refresh-list')]
    public function refreshList()
    {
        $this->render();
    }

    #[On('delete-assessment')]
    public function deleteAssessment($id)
    {
        $assessment = $this->course->assessment();
        if ($assessment->delete()) {
            $this->render();
            $this->dispatch('swal:success', message: 'Berhasil menghapus assessment');
        }
    }

    #[On('delete-module')]
    public function deleteModule($id)
    {
        $module = \App\Models\CourseModule::findOrFail($id);
        if ($module->delete()) {
            $this->render();
            $this->dispatch('swal:success', message: 'Berhasil menghapus module');
        }
    }

    #[On('delete-lesson')]
    public function deleteLesson($id)
    {
        $lesson = \App\Models\CourseLesson::findOrFail($id);
        if ($lesson->delete()) {
            $this->render();
            $this->dispatch('swal:success', message: 'Berhasil menghapus lesson');
        }
    }
}
