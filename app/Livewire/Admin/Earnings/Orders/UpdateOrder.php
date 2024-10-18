<?php

namespace App\Livewire\Admin\Earnings\Orders;

use Livewire\Component;
use Livewire\Attributes\On;

class UpdateOrder extends Component
{
    public $order;

    public function mount($order_id)
    {
        $this->order = \App\Models\Order::findOrFail($order_id);
    }
    public function render()
    {
        return view('livewire.admin.earnings.orders.update-order');
    }

    #[On('confirm-order')]
    public function confirmOrder(int $id)
    {
        $order = \App\Models\Order::findOrFail($id);
        $order->update([
            'status' => \App\Enums\OrderStatus::SUCCESS,
        ]);
        $order->user->notify(new \App\Notifications\InvoiceStatusChange($order));
        flash('Berhasil mengkonfirmasi order', 'success');
        return redirect()->route('orders');
    }

    #[On('cancel-order')]
    public function cancelOrder(int $id)
    {
        $order = \App\Models\Order::findOrFail($id);
        $order->update([
            'status' => \App\Enums\OrderStatus::FAILED,
        ]);
        $order->user->notify(new \App\Notifications\InvoiceStatusChange($order));
        flash('Berhasil membatalkan order', 'success');
        return redirect()->route('orders');
    }

    #[On('refund-order')]
    public function refundOrder(int $id)
    {
        $order = \App\Models\Order::findOrFail($id);
        $order->update([
            'status' => \App\Enums\OrderStatus::REFUND,
        ]);
        $order->user->notify(new \App\Notifications\InvoiceStatusChange($order));
        flash('Berhasil mengembalikan order', 'success');
        return redirect()->route('orders');
    }
}
