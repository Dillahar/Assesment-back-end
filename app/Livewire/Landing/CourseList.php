<?php

namespace App\Livewire\Landing;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;

#[Layout('layouts.landing')]
#[Title('Course List')]
class CourseList extends Component
{
    public $category;
    public $courses;
    public $sub_category;
    public function mount($category_id)
    {
        $sub_category = request()->get('sub_category');
        $this->sub_category = \App\Models\SubCategory::find($sub_category);

        if ($category_id != "all") {
            $this->category = \App\Models\Category::findOrFail($category_id);
            $this->courses = $this->category->courses()->where('status', \App\Enums\CourseStatus::PUBLISHED)
                ->when($sub_category, function ($query, $sub_category) {
                    return $query->where('sub_category_id', $sub_category);
                })->get();
        } else {
            $this->courses = \App\Models\Course::where('status', \App\Enums\CourseStatus::PUBLISHED)
                ->when($sub_category, function ($query, $sub_category) {
                    return $query->where('sub_category_id', $sub_category);
                })->get();
        }
    }
    public function render()
    {
        SEOTools::setTitle("Course List");
        SEOTools::setDescription(config('seo.description'));
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(config('seo.canonical'));
        SEOMeta::addKeyword(config('seo.keywords'));


        return view('livewire.landing.course-list');
    }
}
