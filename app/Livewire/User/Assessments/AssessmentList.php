<?php

namespace App\Livewire\User\Assessments;

use App\Livewire\Base\PaginationComponent;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class AssessmentList extends PaginationComponent
{
    public function render()
    {
        return view('livewire.user.assessments.assessment-list', [
            'assessments' => Auth::user()->my_assessment()->search($this->search)
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage)
        ]);
    }

    #[On('delete-data')]
    public function deleteData(int $id)
    {
    }
}
