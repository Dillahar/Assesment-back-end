<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public $photo;
    public $user;
    public $province_id;
    public $old_password;
    public $password;
    public $password_confirmation;

    public $useTemp = false;

    public function updatedPhoto($value)
    {
        $this->validate([
            'photo' => 'image|max:50048',
        ]);
        $this->useTemp = true;
    }

    protected function rules()
    {
        return [
            'photo' => 'sometimes|nullable|image|max:50048',//max 5MB
            'user.name' => 'required',
            'user.email' => 'required|email|unique:users,email,' . Auth::id(),
            'old_password' => 'nullable|required_with:password',
            'password' => 'nullable|required_with:old_password|min:8',
            'password_confirmation' => 'nullable|required_with:password|same:password',
            'user.city_id' => 'required|exists:indonesia_cities,id',
            'user.address' => 'required',
        ];
    }

    public function mount()
    {
        $this->user = Auth::user()->toArray();
        $this->province_id = \Indonesia::findCity($this->user['city_id'])->province->id;
    }
    public function render()
    {
        return view('livewire.user.profile', [
            'provinces' => \Indonesia::allProvinces(),
            'cities' => $this->province_id ? \Indonesia::findProvince($this->province_id)->cities : [],
            'orders' => Auth::user()->orders()->latest()->get(),
        ]);
    }

    public function updatedProvinceId($value)
    {
        $this->user['city_id'] = null;
    }

    public function save()
    {
        $this->validate();
        if ($this->old_password && $this->password && $this->password_confirmation) {
            if (!\Hash::check($this->old_password, Auth::user()->password)) {
                $this->addError('old_password', 'Password lama tidak sesuai');
                return;
            }
            $this->user['password'] = $this->password;
        }

        $user = User::find($this->user['id']);
        if ($this->photo) {
            $this->user['photo'] = $this->photo->store('profile', 'public');
        }
        $user->update($this->user);
        $this->dispatch('swal:success', message: 'Profil berhasil diperbarui');
        $this->old_password = null;
        $this->password = null;
        $this->password_confirmation = null;
    }
}
