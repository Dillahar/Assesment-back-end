<?php

namespace App\Livewire\User\Certificates;

use Livewire\Component;
use Livewire\Attributes\On;

class CertificateList extends Component
{
    public $rating = 5;
    public $review;

    public $course;
    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'review' => 'required|string|min:10|max:500',
    ];
    public function render()
    {
        return view('livewire.user.certificates.certificate-list', [
            'certificates' => auth()->user()->certificate_receives,
        ]);
    }

    #[On('rating-modal')]
    public function ratingCourse($id)
    {
        $this->course = auth()
            ->user()
            ->certificate_receives()
            ->where('course_id', $id)
            ->firstOrFail()->course;
    }

    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    public function giveReview()
    {
        $this->validate();
        if (
            $this->course
                ->course_reviews()
                ->where('user_id', auth()->id())
                ->exists()
        ) {
            $this->dispatch('swal:success', message: 'Already rated!');
            return;
        }
        $this->course->course_reviews()->create([
            'user_id' => auth()->id(),
            'star_count' => $this->rating,
            'review' => $this->review,
        ]);
        $this->dispatch('swal:success', message: 'Review berhasil ditambahkan');
    }
}
