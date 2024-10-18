<?php

namespace App\Livewire\Admin\Earnings\Payments;

use App\Livewire\Base\ModalComponent;
use Livewire\Attributes\On;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CreateUpdatePayment extends ModalComponent
{
    use WithFileUploads;

    public $useTemp = false;
    public $bank;
    public $number;
    public $name;
    public $instructions;
    public $logo;
    public int $is_active = 1;

    protected function rules(){
        $masterRules = [
            'bank' => 'required|max:255',
            'number' => 'required|max:50',
            'name' => 'required',
            'instructions' => 'required',
            'logo' => 'required|image|max:2024',
            'is_active' => 'required',
        ];
        if($this->editForm){
            $masterRules['logo'] = 'nullable|image|max:2024';
        }
        return $masterRules;
    }

    public function mount($payment_id = null)
    {
        if ($payment_id) {
            $this->editForm = true;
            $this->model = \App\Models\PaymentMethod::findOrFail($payment_id);
            $this->bank = $this->model->bank;
            $this->number = $this->model->number;
            $this->name = $this->model->name;
            $this->instructions = $this->model->instructions;
            $this->is_active = $this->model->is_active;
        }
    }

    public function updatedLogo($value){
        $this->validate([
            'logo' => 'image|max:2024',
        ]);
        $this->useTemp = true;
    }

    public function render()
    {
        return view('livewire.admin.earnings.payments.create-update-payment');
    }

    #[On('reset-form')]
    public function resetForm()
    {
        $this->reset();
    }


    public function create()
    {
        $this->validate();
        $logo = $this->logo->store('banks', 'public');
        $create = \App\Models\PaymentMethod::create([
            'bank' => $this->bank,
            'number' => $this->number,
            'name' => $this->name,
            'instructions' => $this->instructions,
            'logo' => $logo,
            'is_active' => $this->is_active,
        ]);
        
        if ($create) {
            flash('Berhasil menambah payment', 'success');
        } else {
            flash('Gagal menambah payment', 'error');
        }
        return redirect()->intended(route('payments'));
    }

    public function update()
    {
        $this->validate();
        if($this->logo){
            $logo = $this->logo->store('banks', 'public');
            //delete old file
            if($this->model->logo){
                \Storage::disk('public')->delete($this->model->logo);
            }
        } else {
            $logo = $this->model->logo;
        }

        $update = $this->model->update([
            'bank' => $this->bank,
            'number' => $this->number,
            'name' => $this->name,
            'instructions' => $this->instructions,
            'logo' => $logo,
            'is_active' => $this->is_active,
        ]);

        if ($update) {
            flash('Berhasil mengubah payment', 'success');
        } else {
            flash('Gagal mengubah payment', 'error');
        }
        return redirect()->intended(route('payments'));
    }
}
