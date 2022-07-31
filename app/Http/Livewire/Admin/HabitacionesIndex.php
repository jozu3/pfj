<?php

namespace App\Http\Livewire\Admin;

use App\Models\Habitacione;
use Livewire\Component;

class HabitacionesIndex extends Component
{
    public $search;
    public $edificio;
    public $piso;
    public $cant;

    public function render()
    { 
        $habitaciones = Habitacione::paginate($this->cant);

        return view('livewire.admin.habitaciones-index', compact('habitaciones'));
    }
}
