<?php

namespace App\Http\Livewire\Student;

use App\Models\Comentario;
use App\Models\Inscripcione;
use App\Models\InscripcioneTarea;
use Livewire\Component;

class TareaComentarios extends Component
{
    public $tarea;
    public $newcomentario;

    public function saveComentario(){

        $this->validate([
            'newcomentario' => 'required'
        ]);

        $inscripcione = Inscripcione::where('programa_id', $this->tarea->programa->id)->where('personale_id', auth()->user()->personale->id)->first();
        $comentario = Comentario::create([
            'inscripcione_id' => $inscripcione->id,
            'tarea_id' => $this->tarea->id,
            'comentario' => $this->newcomentario,
            'estado' => 1
        ]);

        if($comentario){
            $inscripcione = Inscripcione::where('personale_id', auth()->user()->personale->id)->where('programa_id', $this->tarea->programa->id)->first();

            $inscripcioneTarea = InscripcioneTarea::where('inscripcione_id', $inscripcione->id)->where('tarea_id', $this->tarea->id)->first();
    
            if ($inscripcioneTarea) {            
                if($inscripcioneTarea->realizado == false){
                    $inscripcioneTarea->realizado = !$inscripcioneTarea->realizado;
                }
            } else {
                $inscripcioneTarea = new InscripcioneTarea([
                    'inscripcione_id' => $inscripcione->id,
                    'tarea_id' => $this->tarea->id,
                    'realizado' => true,
                ]);
            }
    
            $inscripcioneTarea->save();       
            $this->newcomentario = '';
        }

    }

    public function render()
    {
        $comentarios = Comentario::where('tarea_id', $this->tarea->id)->where('estado', '1')->get();

        return view('livewire.student.tarea-comentarios', compact('comentarios'));
    }
}
