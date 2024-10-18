<?php

namespace App\Livewire\Admin\CourseManagement\Assessment;


use App\Livewire\Base\PaginationComponent;
use Livewire\Attributes\On;
class UserAssessmentList extends PaginationComponent
{
    public $course;

    public function mount($course_id)
    {
        $this->course = \App\Models\Course::findOrFail($course_id);
    }
    public function render()
    {
        return view('livewire.admin.course-management.assessment.user-assessment-list', [
            'assessments' => $this->course->assessment->assessment_users()->search($this->search)
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage)
        ]);
    }

    #[On('delete-data')]
    public function deleteData(int $id)
    {
        $assessment = \App\Models\AssessmentUser::findOrFail($id);
        if ($assessment->delete()) {
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil menghapus assessment');
        }
    }
}
