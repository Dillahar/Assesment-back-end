<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.auth')]
#[Title('Register')]
class Register extends Component
{
    public $name;
    public $email;
    public $province_id;
    public $city_id;
    public $address;
    public $instance;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'province_id' => 'required',
        'city_id' => 'required',
        'address' => 'required',
        'instance' => 'required',
        'password' => 'required|confirmed|min:8',
        'password_confirmation' => 'required',
    ];
    public function render()
    {
        return view('livewire.auth.register',[
            'provinces' => \Indonesia::allProvinces(),
            'cities' => $this->province_id ? \Indonesia::findProvince($this->province_id)->cities : [],
        ]);
    }

    public function register()
    {
        $validate = $this->validate();
        $validate['password'] = bcrypt($validate['password']);
        \App\Models\User::create($validate);
        flash('Registrasi Berhasil!', 'success');
        return redirect()->route('login');
    }
}
