<?php

namespace App\Http\Livewire\Admin;

use App\Models\InscripcioneVacuna;
use Livewire\Component;


class CreateInscripcioneVacuna extends Component
{
    public $tarea_id, $inscripcione_id;

    public function vacunado(){
        
    }

    public function render()
    {
        $inscripcioneVacuna = InscripcioneVacuna::where('inscripcione_id', $this->inscripcione_id)->get();        
        return view('livewire.admin.create-inscripcione-vacuna', compact('inscripcioneVacuna'));
    }
}
