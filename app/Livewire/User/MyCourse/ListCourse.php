<?php

namespace App\Livewire\User\MyCourse;

use Livewire\Component;

class ListCourse extends Component
{
    public $filter = 'all';
    public $search = '';

    public function render()
    {
        $query = auth()
            ->user()
            ->my_courses()
            ->get()
            ->pluck('course');
        $count = $query->count();

        if ($this->filter == 'finished' || $this->filter == 'unfinished') {
            $query = $query->where('is_finished', $this->filter == 'finished');
        }

        if (!empty($this->search)) {
            // Assuming 'title' is a field in your 'courses' table where you want to search.
            $query = $query->filter(function ($course) {
                return false !== stripos($course->title, $this->search);
            });
        }

        $courses = $query->all();
        

        return view('livewire.user.my-course.list-course', [
            'count' => $count,
            'courses' => $courses,
        ]);
    }

    public function changeFilter($filter)
    {
        $this->filter = $filter;
    }
}
