<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class CreateTarea extends Component
{
    public $abierto = false;

    public function createShowModal()
    {
        $this->abierto = true;
                
    }

    public function render()
    {
        return view('livewire.admin.create-tarea');
    }
}
