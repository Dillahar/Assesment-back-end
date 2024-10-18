<?php

namespace App\Livewire\User\Assessments;

use Livewire\Component;

class ViewAssessment extends Component
{
    public $assessment;
    public function mount($assessment_id)
    {
        $this->assessment = auth()->user()->my_assessment()->findOrFail($assessment_id);
    }
    
    public function render()
    {
        return view('livewire.user.assessments.view-assessment');
    }
}
