<?php

namespace App\Livewire\Admin\Earnings\Orders;

use Livewire\Component;
use Livewire\Attributes\On;

class DetailDiscount extends Component
{
    public $order;
    public function render()
    {
        return view('livewire.admin.earnings.orders.detail-discount');
    }

    #[On('detail-discount')]
    public function detailDiscount(int $id)
    {
        $this->order = \App\Models\Order::findOrFail($id);
    }

}
