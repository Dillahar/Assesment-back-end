<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\User;
use App\Notifications\SendResetPassword;

#[Layout('layouts.auth')]
#[Title('Forgot Password')]
class Forgot extends Component
{
    public $email;

    protected $rules = [
        'email' => 'required|email'
    ];

    public function render()
    {
        return view('livewire.auth.forgot');
    }

    public function forgot(){
        $this->validate();
        $user = User::where('email', $this->email)->first();
        if ($user) {
            $user->notify(new SendResetPassword($user));
        } 
        flash('Jika email terdaftar, kami akan mengirimkan notifikasi ke email anda!', 'success');
    }
}
