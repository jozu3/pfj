<?php

namespace App\Http\Livewire\Admin;

use App\Models\Companerismo;
use App\Models\Grupo;
use App\Models\InscripcioneCompanerismo;
use Livewire\Component;

class AsignarPersonal extends Component
{
    public $programa;
    public $psinasignar;
    public $renderSortable = true;
    // public

    public $addFamilia;
    public $idFamilia, $famNumero, $famNombre, $compCantidad;
    public $del;

    protected $listeners = ['render' => 'render'];
    protected $rules = [
        'famNumero' => 'required',
        'famNombre' => 'required',
        'compCantidad' => 'required',

    ];

    public function updatedRenderSortable(){
        $this->emit('habilitarSortable');
    }

    public function createFamilia()
    {
        if ($this->idFamilia) {
            Grupo::where('id', $this->idFamilia)
                ->update([
                    'nombre' => $this->famNombre,
                    'numero' => $this->famNumero,
                ]);

            $compaCount = Companerismo::where('grupo_id', $this->idFamilia)
                            ->where('role_id', 6)->count();

            if ($this->compCantidad > $compaCount) {
                for ($i = $compaCount; $i <= $this->compCantidad; $i++) {
                    Companerismo::create([
                        'numero' => $i,
                        'role_id' => 6,
                        'grupo_id' => $this->idFamilia,
                    ]);
                }
            }

            if ($this->compCantidad < $compaCount) {
                for ($i = $compaCount; $i > $this->compCantidad; $i--) {
                    $compa = Companerismo::where('grupo_id', $this->idFamilia)
                        ->where('numero', $i)->first();                    

                    if ((InscripcioneCompanerismo::where('companerismo_id', $compa->id)->get())->isEmpty()) {
                        $deleted = Companerismo::where('grupo_id', $this->idFamilia)
                            ->where('numero', $i)->delete();
                    }
                }
            }

            // $compaMax = Companerismo::where('grupo_id', $this->idFamilia)->max('numero');

        } else {
            $grupo = Grupo::create([
                'nombre' => $this->famNombre,
                'numero' => $this->famNumero,
                'programa_id' => $this->programa->id,
            ]);

            Companerismo::create([
                'numero' => 0,
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
        }

        $this->reset(['idFamilia', 'addFamilia', 'famNumero', 'famNombre', 'compCantidad']);
        $this->render();
        $this->emit('pruebaAsignar');
    }

    public function editFamilia(Grupo $grupo, $compas)
    {
        $this->idFamilia = $grupo->id;
        $this->famNumero = $grupo->numero;
        $this->famNombre = $grupo->nombre;
        $this->compCantidad = $compas;
        $this->addFamilia = true;
    }

    public function removeFamilia($idFamilia){
        $familia = Grupo::first('id', $idFamilia);
        $compa = Companerismo::where('grupo_id', $idFamilia)->get(); 

        $del =true;
        for ($i = 0; $i <= ($compa->count() - 1) && $del==false; $i++) {
            $compa = $compa->where('numero', $i)->first();                    

            if ((InscripcioneCompanerismo::where('companerismo_id', $compa->id)->get())->isNotEmpty()) {
                $del = false;
            }
        }       
        if($del){
            $deleted = Companerismo::where('grupo_id', $idFamilia)->delete();
            Grupo::where('id', $idFamilia)->delete();
        }        
    }

    public function render()
    {
        $grupos = Grupo::where('programa_id', $this->programa->id)->get();
        $this->famNumero = ($grupos->isNotEmpty()) ? ($grupos->sortByDesc('numero')->first()->numero) + 1 : 1;
        return view('livewire.admin.asignar-personal', compact('grupos'));
    }
}
