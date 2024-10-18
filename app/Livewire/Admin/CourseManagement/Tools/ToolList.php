<?php

namespace App\Livewire\Admin\CourseManagement\Tools;

use App\Livewire\Base\PaginationComponent;
use Livewire\Attributes\On;

class ToolList extends PaginationComponent
{
    public function render()
    {
        return view('livewire.admin.course-management.tools.tool-list', [
            'tools' => \App\Models\Tool::search($this->search)
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
        ]);
    }

    #[On('delete-data')]
    public function deleteData(int $id)
    {
        $tool = \App\Models\Tool::findOrFail($id);
        if ($tool->image && \File::exists(public_path('storage/' . $tool->image))) {
            \File::delete(public_path('storage/' . $tool->image));
        }
        if ($tool->delete()) {
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil menghapus tool');
        }
    }
}
