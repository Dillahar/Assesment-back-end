<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.auth')]
#[Title('Login')]
class Login extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function login(){
        $validate = $this->validate();
        if(Auth::attempt($validate))
        {
            if(Auth::user()->is_admin == 1){
                return redirect()->intended(route('dashboard'));
            } else {
                return redirect()->intended(route('user.dashboard'));
            }
            
        }
        flash('Email atau Password salah!', 'danger');
    }
}
