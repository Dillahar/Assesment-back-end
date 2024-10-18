<?php

namespace App\Livewire\Admin\CourseManagement\Courses;

use App\Livewire\Base\ModalComponent;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CreateUpdateCourse extends ModalComponent
{
    use WithFileUploads;
    public $title;
    public $level;
    public $category_id;
    public $subcategory_id;
    public $slug;
    public $price;
    public array $tools;
    public $mentor_id;
    public $group_invite_link;
    public $description;
    public $methods;
    public $thumbnail;
    public $status = \App\Enums\CourseStatus::DRAFT;
    public $overview_video;
    public $useTemp = false;

    public function mount($id = null)
    {
        if ($id) {
            $this->editForm = true;
            $this->model = \App\Models\Course::findOrFail($id);
            $this->title = $this->model->title;
            $this->level = $this->model->level;
            $this->category_id = $this->model->sub_category->category_id;
            $this->subcategory_id = $this->model->sub_category_id;
            $this->slug = $this->model->slug;
            $this->price = $this->model->price;
            $this->tools = $this->model->tools->pluck('id')->toArray();
            $this->mentor_id = $this->model->mentor_id;
            $this->group_invite_link = $this->model->group_invite_link;
            $this->description = $this->model->description;
            $this->methods = $this->model->methods;
            $this->status = $this->model->status;
            $this->overview_video = $this->model->overview_video;
        }
    }

    protected function rules()
    {
        $masterRules = [
            'title' => 'required',
            'level' => 'required|in:' . implode(',', \App\Enums\CourseLevel::values()),
            'slug' => 'required|unique:courses,slug',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:sub_categories,id',
            'group_invite_link' => 'required|url',
            'price' => 'required|numeric',
            'tools' => 'required',
            'tools.*' => 'required|exists:tools,id',
            'mentor_id' => 'required|exists:mentors,id',
            'description' => 'required',
            'methods' => 'required',
            'thumbnail' => 'required|image|max:10048',
            'status' => 'required|in:' . implode(',', \App\Enums\CourseStatus::values()),
            'overview_video' => 'sometimes|nullable|url',
        ];
        if ($this->editForm) {
            $masterRules['thumbnail'] = 'sometimes|nullable|image|max:10048';
            $masterRules['slug'] = 'required|unique:courses,slug,' . $this->model->id;
        }
        return $masterRules;
    }
    public function render()
    {
        return view('livewire.admin.course-management.courses.create-update-course', [
            'levels' => \App\Enums\CourseLevel::values(),
            'categories' => \App\Models\Category::all(),
            'subcategories' => $this->category_id ? \App\Models\SubCategory::where('category_id', $this->category_id)->get() : [],
            'statuses' => \App\Enums\CourseStatus::values(),
            'mentors' => \App\Models\Mentor::all(),
            'toolsData' => \App\Models\Tool::all(),
        ]);
    }

    #[On('reset-form')]
    public function resetForm()
    {
        $this->reset();
    }

    public function updatingCategoryId($value)
    {
        $this->subcategory_id = null;
    }

    public function updatedThumbnail($value)
    {
        $this->validate([
            'thumbnail' => 'image|max:10048',
        ]);
        $this->useTemp = true;
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }
    public function create()
    {
        $this->validate();
        try {
            DB::beginTransaction();
            $thumbnail = $this->thumbnail->store('courses', 'public');
            $create = \App\Models\Course::create([
                'title' => $this->title,
                'level' => $this->level,
                'sub_category_id' => $this->subcategory_id,
                'slug' => $this->slug,
                'price' => $this->price,
                'group_invite_link' => $this->group_invite_link,
                'mentor_id' => $this->mentor_id,
                'description' => $this->description,
                'methods' => $this->methods,
                'thumbnail' => $thumbnail,
                'status' => $this->status,
                'overview_video' => $this->overview_video,
            ]);
            $create->tools()->sync($this->tools);
            DB::commit();
            flash('Berhasil menambah course', 'success');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            flash('Gagal menambah course: ' . $e->getMessage(), 'danger');
        }
        //return redirect()->intended(route('courses'));
    }

    public function update()
    {
        $this->validate();
        if ($this->useTemp) {
            $thumbnail = $this->thumbnail->store('courses', 'public');
        } else {
            $thumbnail = $this->model->thumbnail;
        }
        try {
            DB::beginTransaction();
            $update = $this->model->update([
                'title' => $this->title,
                'level' => $this->level,
                'sub_category_id' => $this->subcategory_id,
                'slug' => $this->slug,
                'price' => $this->price,
                'group_invite_link' => $this->group_invite_link,
                'mentor_id' => $this->mentor_id,
                'description' => $this->description,
                'methods' => $this->methods,
                'thumbnail' => $thumbnail,
                'status' => $this->status,
                'overview_video' => $this->overview_video,
            ]);
            $this->model->tools()->sync($this->tools);
            DB::commit();
            flash('Berhasil mengubah course', 'success');
        } catch (\Exception $e) {
            DB::rollback();
            flash('Gagal mengubah course' . $e->getMessage(), 'danger');
        }
        return redirect()->intended(route('courses'));
    }
}
