<?php

namespace App\Livewire\Landing;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;

#[Layout('layouts.landing')]
class Home extends Component
{
    public function render()
    {
        SEOTools::setTitle("Home");
        SEOTools::setDescription(config('seo.description'));
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(config('seo.canonical'));
        SEOMeta::addKeyword(config('seo.keywords'));

        return view('livewire.landing.home', [
            'categories' => \App\Models\Category::all(),
            'sub_categories' => \App\Models\SubCategory::all(),
            'courses' => \App\Models\Course::getBestCourses(),
            'tools' => \App\Models\Tool::all(),
            'reviews' => \App\Models\CourseReview::with(['course'])->where('is_approved', 1)->orderBy('star_count', 'desc')->take(3)->get(),
        ]);
    }
}
