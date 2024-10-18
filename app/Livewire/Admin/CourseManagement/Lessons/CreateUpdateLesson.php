<?php

namespace App\Livewire\Admin\CourseManagement\Lessons;

use App\Livewire\Base\ModalComponent;
use Livewire\Attributes\On;
use Google\Service\YouTube;
use App\Rules\YoutubeVideo;

class CreateUpdateLesson extends ModalComponent
{
    public $module;
    public $module_id;
    public $title;
    public $description;
    public $video;

    protected function rules(){
        return [
            'module_id' => 'required|exists:course_modules,id',
            'title' => 'required',
            'description' => 'required',
            'video' => ['required', 'url', new YoutubeVideo()],
        ];
    }
    public function mount($module_id = null, $lesson_id = null)
    {
        $this->module = \App\Models\CourseModule::findOrFail($module_id);
        $this->module_id = $module_id;
        if ($lesson_id) {
            $this->editForm = true;
            $this->model = \App\Models\CourseLesson::findOrFail($lesson_id);
            $this->title = $this->model->title;
            $this->description = $this->model->description;
            $this->video = $this->model->video;
        }
    }
    public function render()
    {
        return view('livewire.admin.course-management.lessons.create-update-lesson');
    }

    #[On('reset-form')]
    public function resetForm()
    {
        $this->reset();
    }

    public function create()
    {
        $this->validate();
        try{
            $duration = $this->getVideoDurationByLink($this->video);
        } catch (\Exception $e) {
            $duration = 0;
        }
        $this->module->course_lessons()->create([
            'title' => $this->title,
            'description' => $this->description,
            'video' => $this->video,
            'duration' => $duration,
        ]);
        flash('Lesson created successfully!', 'success');
        return redirect()->route('lessons', $this->module->course_id);
    }

    public function update()
    {
        $this->validate();
        try{
            $duration = $this->getVideoDurationByLink($this->video);
        } catch (\Exception $e) {
            $duration = 0;
            dd($e->getMessage());
        }
        $this->model->update([
            'title' => $this->title,
            'description' => $this->description,
            'video' => $this->video,
            'duration' => $duration,
        ]);
        flash('Lesson updated successfully!', 'success');
        return redirect()->route('lessons', $this->module->course_id);
    }

    private function getVideoDuration($videoId)
    {
        $client = new \Google_Client();
        $client->setDeveloperKey(config('app.youtube_api_key'));

        $youtube = new YouTube($client);
        $response = $youtube->videos->listVideos('contentDetails', array('id' => $videoId));
        $duration = $response['items'][0]['contentDetails']['duration'];
        return $this->convertDuration($duration);
    }

    private function convertDuration($duration)
    {
        $interval = new \DateInterval($duration);
        return $interval->s + ($interval->i * 60) + ($interval->h * 3600);
    }

    private function getVideoId($link)
    {
        // Parse the URL to get the query string
        parse_str(parse_url($link, PHP_URL_QUERY), $query);
        // Return the video ID
        $videoId = isset($query['v']) ? $query['v'] : null;
        return $videoId;
    }

    private function getVideoDurationByLink($link)
    {
        $videoId = $this->getVideoId($link);
        return $this->getVideoDuration($videoId);
    }
}
