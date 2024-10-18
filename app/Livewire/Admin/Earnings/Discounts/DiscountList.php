<?php

namespace App\Livewire\Admin\Earnings\Discounts;

use App\Livewire\Base\PaginationComponent;
use Livewire\Attributes\On;

class DiscountList extends PaginationComponent
{
    public function render()
    {
        return view('livewire.admin.earnings.discounts.discount-list', [
            'discounts' => \App\Models\Discount::search($this->search)
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
        ]);
    }

    #[On('delete-data')]
    public function deleteData(int $id)
    {
        $discount = \App\Models\Discount::findOrFail($id);
        if ($discount->delete()) {
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil menghapus discount');
        }
    }
}
