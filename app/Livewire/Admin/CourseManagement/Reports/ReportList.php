<?php

namespace App\Livewire\Admin\CourseManagement\Reports;

use App\Livewire\Base\PaginationComponent;
use Livewire\Attributes\On;

class ReportList extends PaginationComponent
{
    public $course;
    public function mount($course_id)
    {
        $this->course = \App\Models\Course::findOrFail($course_id);
    }
    public function render()
    {
        return view('livewire.admin.course-management.reports.report-list', [
            'reports' => \App\Models\Report::with(['user', 'lesson'])
                ->whereHas('lesson', function ($query) {
                    $query->whereHas('course_module', function ($query) {
                        $query->whereHas('course', function ($query) {
                            $query->where('id', $this->course->id);
                        });
                    });
                })
                ->search($this->search)
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
        ]);
    }

    #[On('delete-data')]
    public function deleteData(int $id)
    {
        $report = \App\Models\Report::findOrFail($id);
        if ($report->delete()) {
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil menghapus report');
        }
    }

    #[On('resolved-data')]
    public function resolvedData(int $id)
    {
        $report = \App\Models\Report::findOrFail($id);
        $report->update(['status' => \App\Enums\ReportStatus::RESOLVED]);
        $this->dispatch('refresh-table');
        $this->dispatch('swal:success', message: 'Berhasil menyelesaikan report');
    }
}
