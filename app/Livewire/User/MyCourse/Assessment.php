<?php

namespace App\Livewire\User\MyCourse;

use Livewire\Component;
use App\Models\Course;
use Google\Service\Batch\Message;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

#[Layout('layouts.course')]
class Assessment extends Component
{
    use WithFileUploads;
    public $course;
    public $file;

    public function mount($slug)
    {
        $this->course = Course::where('slug', $slug)->firstOrFail();
        if (!$this->course->assessment) {
            return abort(404);
        }

        if (
            !auth()
                ->user()
                ->hasThisCourse($this->course->id)
        ) {
            return abort(404);
        }
    }

    public function render()
    {
        return view('livewire.user.my-course.assessment', [
            'my_submissions' => $this->course->assessment
                ->assessment_users()
                ->where('user_id', auth()->id())
                ->get(),
        ]);
    }

    public function submit()
    {
        $this->validate([
            'file' => 'required|file|mimes:png,rar,zip,pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
        ]);

        //check if user already submit
        $anyPanding = $this->course->assessment
            ->assessment_users()
            ->where('user_id', auth()->id())
            ->where('status', \App\Enums\AssessmentStatus::PENDING)
            ->first();

        if ($anyPanding) {
            $this->dispatch('swal:danger', message: 'Anda sudah mengumpulkan tugas ini. Silahkan tunggu hasilnya.');
            return;
        }
        $file = $this->file->store('submissions', 'public');

        $this->course->assessment->assessment_users()->create([
            'user_id' => auth()->id(),
            'file' => $file,
        ]);
        $this->dispatch('swal:success', message: 'Tugas berhasil dikumpulkan');
        $this->file = null;
    }
}
