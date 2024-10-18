<?php

namespace App\Livewire\Admin\CourseManagement\Mentors;

use App\Livewire\Base\PaginationComponent;
use Livewire\Attributes\On;

class MentorList extends PaginationComponent
{
    public function render()
    {
        return view('livewire.admin.course-management.mentors.mentor-list', [
            'mentors' => \App\Models\Mentor::search($this->search)
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
        ]);
    }

    #[On('delete-data')]
    public function deleteData(int $id)
    {
        $mentor = \App\Models\Mentor::findOrFail($id);
        if ($mentor->photo && \File::exists(public_path('storage/' . $mentor->photo))) {
            \File::delete(public_path('storage/' . $mentor->photo));
        }
        if ($mentor->delete()) {
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil menghapus mentor');
        }
    }
}
