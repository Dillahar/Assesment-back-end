<?php

namespace App\Livewire\Admin\Users;

use App\Livewire\Base\ModalComponent;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class CreateUpdateUser extends ModalComponent
{
    use WithFileUploads;
    public $photo;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $is_admin = 0;
    public $province_id;
    public $district_code;
    public $city_id;
    public $address;
    public $instance;

    protected function rules()
    {
        $masterRules = [
            'photo' => 'sometimes|nullable|image|max:1024',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3',
            'password_confirmation' => 'required',
            'is_admin' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'instance' => 'required',
        ];
        if($this->editForm){
            $masterRules['email'] = 'required|email|unique:users,email,'.$this->model->id;
            $masterRules['password'] = 'nullable|min:8';
            $masterRules['password_confirmation'] = 'nullable|required_with:password|same:password';

        }
        
        return $masterRules;
    }

    public function render()
    {
        return view('livewire.admin.users.create-update-user', [
            'provinces' => \Indonesia::allProvinces(),
            'cities' => $this->province_id ? \Indonesia::findProvince($this->province_id)->cities : [],
        ]);
    }
    #[On('reset-form')]
    public function resetForm()
    {
        $this->reset();
    }

    #[On('edit-user')]
    public function editUser(int $id)
    {
        $this->editForm = true;
        $this->model = User::findOrFail($id);
        $this->name = $this->model->name;
        $this->email = $this->model->email;
        $this->is_admin = $this->model->is_admin;
        $this->province_id = \Indonesia::findCity($this->model->city_id)->province->id;
        $this->city_id = $this->model->city_id;
        $this->address = $this->model->address;
        $this->instance = $this->model->instance;
        
    }

    public function create()
    {
        $validate = $this->validate();
        $validate['password'] = bcrypt($validate['password']);
        if($this->photo){
            $validate['photo'] = $this->photo->store('profile', 'public');
        }
        $user = User::create($validate);
        if($user){
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil menambahkan user');
        }
        
    }

    public function update()
    {
        $validate = $this->validate();
        $validate['password'] = bcrypt($validate['password']);
        if($this->photo){
            if($this->model->photo && \File::exists(public_path('storage/'.$this->model->photo))){
                \File::delete(public_path('storage/'.$this->model->photo));
            }
            $validate['photo'] = $this->photo->store('profile', 'public');
        } else {
            $validate['photo'] = $this->model->photo;
        }
        if($this->model->update($validate)){
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil mengubah user');
        }
    }
}
