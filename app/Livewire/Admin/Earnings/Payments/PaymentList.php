<?php

namespace App\Livewire\Admin\Earnings\Payments;

use App\Livewire\Base\PaginationComponent;
use Livewire\Attributes\On;

class PaymentList extends PaginationComponent
{
    public function render()
    {
        return view('livewire.admin.earnings.payments.payment-list', [
            'payments' => \App\Models\PaymentMethod::search($this->search)
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
        ]);
    }

    #[On('delete-data')]
    public function deleteData(int $id)
    {
        $payment = \App\Models\PaymentMethod::findOrFail($id);
        if ($payment->delete()) {
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil menghapus payment gateway');
        }
    }
}
