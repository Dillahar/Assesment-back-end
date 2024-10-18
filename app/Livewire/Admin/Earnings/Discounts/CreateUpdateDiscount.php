<?php

namespace App\Livewire\Admin\Earnings\Discounts;

use App\Livewire\Base\ModalComponent;
use Livewire\Attributes\On;

class CreateUpdateDiscount extends ModalComponent
{
    public $code;
    public $type;
    public $value;
    public $max_usage;
    public $expired_at;
    public $is_active = 1;

    protected function rules(){
        $masterRules = [
            'code' => 'required|unique:discounts,code',
            'type' => 'required|in:' . implode(',', \App\Enums\DiscountType::values()),
            'value' => 'required|numeric',
            'max_usage' => 'sometimes|nullable|numeric',
            'expired_at' => 'required|date',
            'is_active' => 'required|boolean',
        ];
        if ($this->editForm) {
            $masterRules['code'] = 'required|unique:discounts,code,' . $this->model->id;
        }
    
        if ($this->type === \App\Enums\DiscountType::PERCENT) {
            $masterRules['value'] .= '|max:100';
        }
    
        return $masterRules;
    }
    public function render()
    {
        return view('livewire.admin.earnings.discounts.create-update-discount');
    }

    #[On('reset-form')]
    public function resetForm()
    {
        $this->reset();
    }

    #[On('edit-discount')]
    public function editDiscount(int $id)
    {
        $this->editForm = true;
        $this->model = \App\Models\Discount::findOrFail($id);
        $this->code = $this->model->code;
        $this->type = $this->model->type;
        $this->value = $this->model->value;
        $this->max_usage = $this->model->max_usage;
        $this->expired_at = $this->model->expired_at;
        $this->is_active = $this->model->is_active;
    }

    public function generateCode(){
        $this->code = \App\Models\Discount::generateCode();
    }

    public function create()
    {
        $this->validate();
        $ExpiredAt = date('Y-m-d 23:59:59', strtotime($this->expired_at));
        $discount = \App\Models\Discount::create([
            'code' => $this->code,
            'type' => $this->type,
            'value' => $this->value,
            'max_usage' => empty($this->max_usage) ? null : $this->max_usage,
            'expired_at' => $ExpiredAt,
            'is_active' => $this->is_active,
        ]);
        if ($discount) {
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil menambahkan discount');
        }
    }

    public function update()
    {
        $this->validate();
        $updatedExpiredAt = date('Y-m-d 23:59:59', strtotime($this->expired_at));

        $update = $this->model->update([
            'code' => $this->code,
            'type' => $this->type,
            'value' => $this->value,
            'max_usage' => empty($this->max_usage) ? null : $this->max_usage,
            'expired_at' => $updatedExpiredAt,
            'is_active' => $this->is_active,
        ]);
        if ($update) {
            $this->dispatch('refresh-table');
            $this->dispatch('swal:success', message: 'Berhasil mengubah discount');
        }
    }
}
