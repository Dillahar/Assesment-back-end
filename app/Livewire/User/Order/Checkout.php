<?php

namespace App\Livewire\User\Order;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.landing')]
#[Title('Course List')]
class Checkout extends Component
{
    public $course;
    public $paymentMethodId;
    public $paymentMethod;

    public $discountCode;

    public $discount;

    public $discountCut = 0;

    public function mount($slug)
    {
        $this->course = \App\Models\Course::where('slug', $slug)->firstOrFail();
        if (
            auth()
                ->user()
                ->hasThisCourse($this->course->id)
        ) {
            return redirect()->route('user.dashboard');
        }
    }

    public function render()
    {
        return view('livewire.user.order.checkout', [
            'payment_methods' => \App\Models\PaymentMethod::where('is_active', 1)->get(),
        ]);
    }

    public function redeem()
    {
        $this->validate([
            'discountCode' => 'required',
        ]);

        $this->discount = \App\Models\Discount::where('code', $this->discountCode)->first();
        if (!$this->discount || $this->discount->is_valid == false) {
            $this->discount = null;
            $this->discountCut = 0;
            $this->addError('discountCode', 'Invalid discount code');
            return;
        }
        $this->calculateDiscount();
    }

    private function calculateDiscount()
    {
        if ($this->discount) {
            if ($this->discount->type == \App\Enums\DiscountType::PERCENT) {
                $this->discountCut = ($this->course->price * $this->discount->value) / 100;
            } else {
                $this->discountCut = $this->discount->value;
            }
        }
    }

    private function calculateTotal()
    {
        $this->calculateDiscount();
        $total = $this->course->price - $this->discountCut;
        return $total <= 0 ? 0 : $total;
    }

    public function updatedPaymentMethodId($value)
    {
        $this->paymentMethod = \App\Models\PaymentMethod::findOrFail($value);
    }

    public function checkout()
    {
        $this->validate([
            'paymentMethodId' => 'required',
        ]);

        if (auth()->user()->is_admin) {
            $this->addError('paymentMethodId', 'Admin cannot buy course');
            return;
        }

        try {
            DB::beginTransaction();
            $total = $this->calculateTotal();
            $order = \App\Models\Order::create([
                'user_id' => auth()->id(),
                'number' => \App\Models\Order::generateNumber(),
                'discount_id' => $this->discount ? $this->discount->id : null,
                'payment_id' => $this->paymentMethod->id,
                'amount' => $this->course->price,
                'discount' => $total <= 0 ? $this->course->price : $this->discountCut,
                'total' => $total <= 0 ? 0 : $total,
                'status' => $total <= 0 ? \App\Enums\OrderStatus::SUCCESS : \App\Enums\OrderStatus::PENDING,
            ]);

            $order->details()->create([
                'course_id' => $this->course->id,
                'price' => $this->course->price,
            ]);
            DB::commit();
            if ($total <= 0) {
                $redirect = route('user.dashboard');
                $message = 'Your course has been enrolled.';
            } else {
                $redirect = route('user.payment', $order->number);
                $message = 'Your order has been created. Please complete the payment';
                $order->user->notify(new \App\Notifications\InvoiceOrder($order));
            }
            $this->dispatch('checkout-success', redirect: $redirect, message: $message);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('swal:danger', message: 'Gagal melakukan checkout : ' . $e->getMessage());
        }
    }
}
