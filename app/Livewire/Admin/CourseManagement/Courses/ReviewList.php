<?php

namespace App\Livewire\Admin\CourseManagement\Courses;

use App\Livewire\Base\PaginationComponent;
use App\Models\CourseReview;
use Livewire\Attributes\On;

class ReviewList extends PaginationComponent
{
    public $course;

    public function mount($course_id)
    {
        $this->course = \App\Models\Course::findOrFail($course_id);
    }
    public function render()
    {
        return view('livewire.admin.course-management.courses.review-list', [
            'reviews' => $this->course->course_reviews()->search($this->search)
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
        ]);
    }

    #[On('delete-data')]
    public function deleteData(int $id)
    {
        $course = CourseReview::findOrFail($id);
        if ($course->delete()) {
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil menghapus review');
        }
    }

    #[On('approve-data')]
    public function approveData(int $id)
    {
        $course = CourseReview::findOrFail($id);
        if ($course->update(['is_approved' => true])) {
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil menyetujui review');
        }
    }
}
