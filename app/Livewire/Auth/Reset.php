<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.auth')]
#[Title('Reset Password')]
class Reset extends Component
{
    public $token;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'token' => 'required',
        'password' => 'required|min:8|confirmed',
    ];

    public function mount($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
        $user = \App\Models\User::where('email', $this->email)->firstOrFail();
        $tokenIsValid = Password::broker()->tokenExists($user, $this->token);
        if (!$tokenIsValid) {
            flash('Token tidak valid!', 'danger');
            return redirect()->route('login');
        }
    }

    public function render()
    {
        return view('livewire.auth.reset');
    }

    public function resetPassword()
    {
        $this->validate();
        $status = Password::reset(
            [
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
                'email' => $this->email,
            ],
            function ($user, $password) {
                $user
                    ->forceFill([
                        'password' => $password,
                    ])
                    ->save();
            },
        );
        if ($status == Password::PASSWORD_RESET) {
            flash('Password berhasil direset!', 'success');
        } else {
            flash('Token tidak valid!', 'danger');
        }
        return redirect()->route('login');
    }
}
