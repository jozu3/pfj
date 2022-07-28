<?php

namespace App\Http\Livewire\Student;

use App\Models\Participante;
use Livewire\Component;

class Bienvenida extends Component
{
    public $search;
    public $programa;
    public $open = false;
    public $formsearch = false;
    public $participanteSelected;
    // public $editData = false;

    public function selectParticipante(Participante $participante){
        $this->participanteSelected = $participante;
        $this->open = true;
        $this->search = '';
    }

    public function render()
    {
        $participantes = [];

        if($this->search != ''){
            $participantes = Participante::where('programa_id', $this->programa->id);

            $participantes = $participantes->where(function($q) {
                $q->where('documento', 'like', '%'.$this->search.'%')
                ->orWhere('nombres', 'like', '%'.$this->search.'%')//buscar por nombre y apellidos
                ->orWhere('apellidos', 'like', '%'.$this->search.'%');//buscar por nombre y apellidos
            })
            ->get();

        }

        return view('livewire.student.bienvenida', compact('participantes'));
    }
}
