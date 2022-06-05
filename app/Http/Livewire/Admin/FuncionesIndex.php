<?php

namespace App\Http\Livewire\Admin;

use App\Models\Funcione;
use Livewire\Component;

class FuncionesIndex extends Component
{
    public $programa;

    public function render()
    {
        $funciones = Funcione::where('programa_id', $this->programa->id)->get();
        return view('livewire.admin.funciones-index', compact('funciones'));
    }
}
