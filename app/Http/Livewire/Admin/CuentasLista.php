<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Cuenta;

class CuentasLista extends Component
{

    public function render()
    {
    	$cuentas = Cuenta::all();
        return view('livewire.admin.cuentas-lista', compact('cuentas'));
    }
}
