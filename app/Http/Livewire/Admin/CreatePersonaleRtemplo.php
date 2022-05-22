<?php

namespace App\Http\Livewire\Admin;

use App\Models\Inscripcione;
use Livewire\Component;

class CreatePersonaleRtemplo extends Component
{
    public $programa;
    public function render()
    {

        $inscripciones = Inscripcione::where('programa_id', $this->programa->id)->whereIn('estado', [1])
                                    ->with('personale.contacto')
                                    ->get()
                                    ->sortBy('personale.contacto.nombres');

        return view('livewire.admin.create-personale-rtemplo', compact('inscripciones'));
    }
}
