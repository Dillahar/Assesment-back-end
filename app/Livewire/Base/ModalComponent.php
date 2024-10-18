<?php

namespace App\Livewire\Base;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

abstract class ModalComponent extends Component
{
    public $editForm = false;
    public Model $model;

    abstract public function create();
    abstract public function update();

    abstract public function resetForm();

    
}