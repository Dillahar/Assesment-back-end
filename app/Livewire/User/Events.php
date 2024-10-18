<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.landing')]
class Events extends Component
{
    public function render()
    {
        return view('livewire.user.events');
    }
}
