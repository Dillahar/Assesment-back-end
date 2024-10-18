<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use Livewire\Attributes\On;
class UserDetail extends Component
{
    public $user;

    public $section = 'about';

    public function mount($id)
    {
        $this->user = \App\Models\User::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.admin.users.user-detail');
    }

    public function changeSection($section)
    {
        $this->section = $section;
    }

    #[On('delete-order')]
    public function deleteOrder(int $id)
    {
        $order = \App\Models\OrderDetail::findOrFail($id);
        if ($order->delete()) {
            $this->render();
            $this->dispatch('swal:success', message: 'Berhasil menghapus order');
        }
    }

    #[On('delete-assessment')]
    public function deleteAssessment(int $id)
    {
        $assessment = \App\Models\AssessmentUser::findOrFail($id);
        if ($assessment->delete()) {
            $this->render();
            $this->dispatch('swal:success', message: 'Berhasil menghapus assessment');
        }
    }
}
