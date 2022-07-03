<?php

namespace App\Http\Livewire\Admin;

use App\Models\Inscripcione;
use Livewire\Component;

class ModalDetalleContacto extends Component
{
    public $inscripcione;

    protected $listeners = ['showcontacto'];

    public function showcontacto(Inscripcione $inscripcione){
        $this->inscripcione = $inscripcione;
    }

    public function render()
    {
        return view('livewire.admin.modal-detalle-contacto');
    }
}
