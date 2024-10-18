<?php

namespace App\Livewire\Admin\Earnings\Orders;

use App\Livewire\Base\PaginationComponent;
use Livewire\Attributes\On;

class OrderList extends PaginationComponent
{
    public function render()
    {
        return view('livewire.admin.earnings.orders.order-list', [
            'orders' => \App\Models\Order::search($this->search)
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
        ]);
    }

    #[On('delete-data')]
    public function deleteData(int $id)
    {
    }
}
