<?php

namespace App\Livewire\Admin\CourseManagement\Courses;

use App\Livewire\Base\PaginationComponent;
use App\Models\Course;
use Livewire\Attributes\On;

class CourseList extends PaginationComponent
{
    public function render()
    {
        return view('livewire.admin.course-management.courses.course-list', [
            'courses' => Course::search($this->search)
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage),
        ]);
    }

    #[On('delete-data')]
    public function deleteData(int $id)
    {
        $course = Course::findOrFail($id);
        if ($course->thumbnail && \File::exists(public_path('storage/' . $course->thumbnail))) {
            \File::delete(public_path('storage/' . $course->thumbnail));
        }
        if ($course->delete()) {
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil menghapus course');
        }
    }
}
