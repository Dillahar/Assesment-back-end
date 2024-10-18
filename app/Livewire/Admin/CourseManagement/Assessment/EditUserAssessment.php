<?php

namespace App\Livewire\Admin\CourseManagement\Assessment;

use App\Livewire\Base\ModalComponent;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class EditUserAssessment extends ModalComponent
{
    public $score;
    public $note;
    protected function rules(){
        return [
            'score' => 'required|numeric|min:0|max:'.$this->model->assessment->max_score,
            'note' => 'sometimes|nullable|string|max:255',
        ];
    }
    public function render()
    {
        return view('livewire.admin.course-management.assessment.edit-user-assessment');
    }

    #[On('reset-form')]
    public function resetForm()
    {
        $this->reset();
    }

    public function create()
    {
        //not implemented
    }

    #[On('edit-user-assessment')]
    public function editSubCategory(int $id)
    {
        $this->editForm = true;
        $this->model = \App\Models\AssessmentUser::findOrFail($id);
        $this->score = $this->model->score;
        $this->note = $this->model->note;
    }

    public function update()
    {
        
        $this->validate();
        try {
            DB::beginTransaction();
    
            $this->validate();
    
            $status = $this->score >= $this->model->assessment->passed_min_score;
            $this->model->update([
                'score' => $this->score,
                'note' => $this->note,
                'status' => $status ? \App\Enums\AssessmentStatus::PASSED : \App\Enums\AssessmentStatus::REJECTED,
            ]);
    
            if ($status && !$this->model->user->certificate_receives()->where('course_id', $this->model->assessment->course_id)->exists()) {
                $certificate = $this->model->user->certificate_receives()->create([
                    'number' => \App\Models\CertificateReceive::generateNumber(),
                    'course_id' => $this->model->assessment->course_id,
                    'valid_until' => now()->addYears(config('app.certificate_valid_year')),
                ]);
                $this->model->user->notify(new \App\Notifications\CertificateReceived($certificate));
            }
    
            DB::commit();
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil mengubah assessment');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('refresh-table');
            $this->dispatch('swal:danger', message: 'Gagal mengubah assessment: '. $e->getMessage());
        }

    }

}
