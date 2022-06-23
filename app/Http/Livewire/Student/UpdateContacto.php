<?php

namespace App\Http\Livewire\Student;

use App\Models\Contacto;
use Livewire\Component;

class UpdateContacto extends Component
{   
    public $fecnac;
    public $nombres;
    public $apellidos;
    public $telefono;
    
    protected $rules = [
        'nombres' => 'required',
        'apellidos' => 'required',
        'fecnac' => 'required|date',
        'telefono' => 'required|numeric',
    ];

    public function updateContacto(){
        $this->validate();
        
        $update =  auth()->user()->personale->contacto->update([
            'fecnac' => $this->fecnac,
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'telefono' => $this->telefono,
        ]);

        $update = auth()->user()->update([
            'name' => $this->nombres. ' ' . $this->apellidos,
        ]);

        if($update){ 
            $this->emit('saved');
        }

    }


    public function render()
    {
        $this->fecnac = auth()->user()->personale->contacto->fecnac;
        $this->nombres = auth()->user()->personale->contacto->nombres;
        $this->apellidos = auth()->user()->personale->contacto->apellidos;
        $this->telefono = auth()->user()->personale->contacto->telefono;

        return view('livewire.student.update-contacto');
    }
}
