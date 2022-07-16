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
    // public $editData = false;

    public function render()
    {
        $participantes = Participante::where('programa_id', $this->programa->id)->where('documento', $this->search)->get();

        return view('livewire.student.bienvenida', compact('participantes'));
    }
}
