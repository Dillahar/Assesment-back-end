<?php

namespace App\Livewire\Landing;

use Livewire\Component;
use Artesaos\SEOTools\Facades\SEOTools;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;

#[Layout('layouts.landing')]
class CourseDetail extends Component
{
    public $course;
    public function mount($slug){
        $this->course = \App\Models\Course::where([
            'slug' => $slug,
            'status' => \App\Enums\CourseStatus::PUBLISHED,
        ])->firstOrFail();
        SEOTools::setTitle($this->course->title);
        SEOTools::setDescription(nl2br(Str::limit(strip_tags($this->course->description), 200)));
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->addProperty('type', 'course');
        SEOTools::jsonLd()->addImage($this->course->thumbnail_url);
    }

    public function render()
    {
        return view('livewire.landing.course-detail');
    }
}
