<?php

namespace App\Livewire\Admin\CourseManagement\Assessment;

use App\Livewire\Base\ModalComponent;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class CreateUpdateAssessment extends ModalComponent
{
    use WithFileUploads;
    public $course;
    public $title;
    public $description;
    public $file;
    public $max_score;
    public $passed_min_score;

    protected $rules = [
        'title' => 'required',
        'description' => 'required',
        'file' => 'sometimes|nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
        'max_score' => 'required|numeric',
        'passed_min_score' => 'required|numeric|lte:max_score',
    ];

    public function mount($course_id = null)
    {
        $this->course = \App\Models\Course::findOrFail($course_id);
        if ($this->course->assessment) {
            $this->model = $this->course->assessment;
            $this->editForm = true;
            $this->title = $this->course->assessment->title;
            $this->description = $this->course->assessment->description;
            $this->max_score = $this->course->assessment->max_score;
            $this->passed_min_score = $this->course->assessment->passed_min_score;
        }
    }
    public function render()
    {
        return view('livewire.admin.course-management.assessment.create-update-assessment');
    }

    #[On('reset-form')]
    public function resetForm()
    {
        $this->reset();
    }

    public function create()
    {
        $this->validate();
        $file = null;
        if ($this->file) {
            $file = $this->file->store('assessments', 'public');
        }
        $this->course->assessment()->create([
            'title' => $this->title,
            'description' => $this->description,
            'file' => $file,
            'max_score' => $this->max_score,
            'passed_min_score' => $this->passed_min_score
        ]);
        flash('Assessment created successfully!', 'success');
        return redirect()->route('lessons', $this->course->id);
    }

    public function update()
    {
        $this->validate();
        if ($this->file) {
            //remove old file
            if ($this->course->assessment->file) {
                \Storage::delete($this->model->file);
            }
            $this->file = $this->file->store('assessments', 'public');
        } else {
            $this->file = $this->course->assessment->file;
        }
        $this->course->assessment()->update([
            'course_id' => $this->course->id, //just in case if the course_id is not set yet
            'title' => $this->title,
            'description' => $this->description,
            'file' => $this->file,
            'max_score' => $this->max_score,
            'passed_min_score' => $this->passed_min_score
        ]);
        flash('Assessment updated successfully!', 'success');
        return redirect()->route('lessons', $this->course->id);
    }
}
