<?php

namespace App\Livewire\Admin\Users;

use App\Livewire\Base\PaginationComponent;
use Livewire\Attributes\On;

class UserList extends PaginationComponent
{
    public function render()
    {
        return view('livewire.admin.users.user-list', [
            'users' => \App\Models\User::search($this->search)
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
        ]);
    }

    #[On('delete-data')]
    public function deleteData(int $id)
    {
        $user = \App\Models\User::findOrFail($id);
        if ($user->photo && \File::exists(public_path('storage/' . $user->photo))) {
            \File::delete(public_path('storage/' . $user->photo));
        }
        if ($user->delete()) {
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil menghapus user');
        }
    }
}
