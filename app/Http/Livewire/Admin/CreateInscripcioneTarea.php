<?php

namespace App\Http\Livewire\Admin;

use App\Models\InscripcioneTarea;
use App\Models\Tarea;
use Livewire\Component;

class CreateInscripcioneTarea extends Component
{
    public $tarea_id, $inscripcione_id;
    public $checkTarea = "esto es un texto";


    public function hecho()
    {
        $inscripcioneTarea = InscripcioneTarea::where('inscripcione_id', $this->inscripcione_id)->where('tarea_id', $this->tarea_id)->first();        

        if ($inscripcioneTarea) {
            $inscripcioneTarea->realizado = !$inscripcioneTarea->realizado;
        } else {
            $inscripcioneTarea = new InscripcioneTarea([
                'inscripcione_id' => $this->inscripcione_id,
                'tarea_id' => $this->tarea_id,
                'realizado' => true,
            ]);
        }
        $inscripcioneTarea->save();
    }

    public function render()
    {
        // $tareas = Tarea::where('programa_id', $this->programa->id)->orderBy('fecha', 'asc')->get();
        $inscripcioneTarea = InscripcioneTarea::where('inscripcione_id', $this->inscripcione_id)->get();
        return view('livewire.admin.create-inscripcione-tarea', compact('inscripcioneTarea'));
    }

    
}