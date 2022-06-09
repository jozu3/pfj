<?php

namespace App\Http\Livewire\Admin;

use App\Models\Funcione;
use Livewire\Component;

class FuncionesIndex extends Component
{
    public $programa;
    public $idFuncione;
    public $descripcion;

    protected $rules = [
        'descripcion' => 'required'
    ];

    public function saveFuncione()
    {
        $this->validate();
        if ($this->idFuncione){
            $funcion = Funcione::where('id', $this->idFuncione)->first();
            $funcion->descripcion = $this->descripcion;
        } else{
            $funcion = new Funcione([
                'descripcion' => $this->descripcion,
                'programa_id' => $this->programa->id
            ]);
        }

        $funcion->save();
        $this->reset(['idFuncione', 'descripcion']);
    }

    public function editFuncione(Funcione $funcione)
    {
        $this->idFuncione = $funcione->id;
        $this->descripcion = $funcione->descripcion;
    }

    public function removeFuncione($idFuncion)
    {
        $delete = Funcione::where('id', $idFuncion)->delete();
    }

    public function render()
    {
        $funciones = Funcione::where('programa_id', $this->programa->id)->get();
        return view('livewire.admin.funciones-index', compact('funciones'));
    }
}
