<?php

namespace App\Http\Livewire\Admin;

use App\Models\Companerismo;
use App\Models\Grupo;
use Livewire\Component;

class AsignarPersonal extends Component
{
    public $programa;
    public $psinasignar;
    // public 

    public $addFamilia;
    public $famNumero, $famNombre, $compCantidad;

    protected $listeners = ['render' => 'render'];
    protected $rules = [
        'famNumero' => 'required',
        'famNombre' => 'required',
        'compCantidad' => 'required',

    ];

    public function createFamilia()
    {
        $grupo = Grupo::create([
            'nombre' => $this->famNombre,
            'numero' => $this->famNumero,
            'programa_id' => $this->programa->id,
        ]);

        Companerismo::create([
            'numero' => 1,
            'role_id' => 5,
            'grupo_id' => $grupo->id,
        ]);

        for ($i = 1; $i <= $this->compCantidad; $i++) {
            Companerismo::create([
                'numero' => $i,
                'role_id' => 6,
                'grupo_id' => $grupo->id,
            ]);
        }

        
        $this->reset(['addFamilia', 'famNumero', 'famNombre', 'compCantidad']);
        $this->render();
        $this->emit('pruebaAsignar');
    }

    public function render()
    {
        $grupos = Grupo::where('programa_id', $this->programa->id)->get();
        $this->famNumero = ($grupos)? ($grupos->sortByDesc('numero')->first()->numero) + 1 : 1;
        return view('livewire.admin.asignar-personal', compact('grupos'));
    }
}
