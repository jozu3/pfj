<?php

namespace App\Http\Livewire\Admin;

use App\Models\Programa;
use Livewire\Component;

class ConsejerosEstacaSesion extends Component
{
    public $programas;
    public function render()
    {
        $this->programas = Programa::all();
        
        return view('livewire.admin.consejeros-estaca-sesion');
    }
}
