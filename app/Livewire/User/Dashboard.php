<?php

namespace App\Livewire\User;

use App\Models\Course;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.user.dashboard', [
            'user' => auth()->user(),
        ]);
    }
}
