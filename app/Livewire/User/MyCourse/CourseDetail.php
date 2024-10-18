<?php

namespace App\Livewire\User\MyCourse;

use App\Models\Course;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.course')]
class CourseDetail extends Component
{
    public $course;
    public $module_id;
    public $module;
    public $lesson;
    public $lesson_id;

    public $report;

    public function mount($slug, $module_id = null, $lesson_id = null)
    {
        $this->course = Course::where('slug', $slug)->firstOrFail();
        if ($lesson_id && $module_id) {
            $this->module_id = $module_id;
            $this->lesson_id = $lesson_id;
            $this->module = $this->course->course_modules()->where('id', $module_id)->firstOrFail();
            $this->lesson = $this->module->course_lessons()->where('id', $lesson_id)->firstOrFail();
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
        if (!$this->lesson && !$this->module){
            $next = $this->course->course_modules->count() > 0 && $this->course->course_modules->first()->course_lessons->count() > 0 ? $this->course->course_modules->first()->course_lessons->first()->id : null;
            $next = $next ? route("user.my-course.learn", [$this->course->slug, $this->course->course_modules->first()->id, $next]) : null;
            $prev = null;
            $video = $this->course->overview_video ? $this->course->overview_video_id : null;
            $description = $this->course->description;
            $title = $this->course->title;
        } else {
            $next = $this->lesson->nextLesson() ? route("user.my-course.learn", [$this->course->slug, $this->lesson->nextLesson()->course_module_id, $this->lesson->nextLesson()->id]) : null;
            $prev = $this->lesson->prevLesson() ? route("user.my-course.learn", [$this->course->slug, $this->lesson->prevLesson()->course_module_id, $this->lesson->prevLesson()->id]) : null;
            $video = $this->lesson->video_id;
            $description = $this->lesson->description;
            $title = $this->lesson->title;

            if (!$next && $this->module->nextModule() && $this->module->nextModule()->course_lessons->count() > 0) {
                $next = route("user.my-course.learn", [$this->course->slug, $this->module->nextModule()->id, $this->module->nextModule()->course_lessons->first()->id]);
            } else if(!$next && $this->course->assessment){
                $next = route('user.my-course.assessment', [$this->course->slug]);
            }
            if (!$prev && $this->module->prevModule() && $this->module->prevModule()->course_lessons->count() > 0) {
                $prev = route("user.my-course.learn", [$this->course->slug, $this->module->prevModule()->id, $this->module->prevModule()->course_lessons->first()->id]);
            } else if(!$prev && $this->lesson && $this->module){
                $prev = route('user.my-course.detail', $this->course->slug);
            }
        }
        return view('livewire.user.my-course.course-detail', [
            'title' => $title,
            'video_id' => $video,
            'image' => $this->course->thumbnail_url,
            'description' => $description,
            'next' => $next,
            'prev' => $prev,
        ]);
    }

    public function reportLesson(){
        $this->validate([
            'report' => 'required'
        ]);
        $this->lesson->reports()->create([
            'user_id' => auth()->user()->id,
            'message' => $this->report
        ]);
        $this->report = null;
        $this->dispatch('swal:success', message: "Laporan berhasil dikirim");
    }
}
