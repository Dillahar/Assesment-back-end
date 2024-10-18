<?php

namespace App\Livewire\User\Order;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;

#[Layout('layouts.landing')]
#[Title('Payment')]
class Payment extends Component
{
    use WithFileUploads;
    public $order;
    public $accountNumber;
    public $accountName;
    public $paymentProof;

    protected $rules = [
        'accountNumber' => 'required|numeric',
        'accountName' => 'required',
        'paymentProof' => 'required|image|max:3024',
    ];

    public function mount($number)
    {
        $this->order = \App\Models\Order::where('number', $number)->firstOrFail();
    }
    public function render()
    {
        return view('livewire.user.order.payment');
    }

    public function submit(){
        $this->validate();
        try{
            $this->order->payment()->create([
                'order_id' => $this->order->id,
                'payment_proof' => $this->paymentProof->store('payment-proof', 'public'),
                'account_number' => $this->accountNumber,
                'account_name' => $this->accountName,
            ]);
        } catch(\Exception $e){
            $this->dispatch('swal:danger', [
                'title' => 'Error',
                'message' => 'Something went wrong',
            ]);
            return;
        }
        $this->dispatch('payment-input', redirect: route('user.dashboard'));
    }
}
