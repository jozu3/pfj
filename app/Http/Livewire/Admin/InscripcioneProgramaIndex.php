<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Inscripcione;
use App\Models\Programa;
use App\Models\Grupo;
use Livewire\WithPagination;

class InscripcioneProgramaIndex extends Component
{

    //public $inscripciones;
    public $grupo_id;
    public $programa_id;
    public $search;

    public function render()
    {
        $that = $this;
        if($this->grupo_id != ''){
            $inscripciones = Inscripcione::whereHas('inscripcioneCompanerismo', function ($q) use ($that){
                $q->whereHas('companerismo', function($qu) use ($that){
                    $qu->where('grupo_id', $that->grupo_id);
                });                
            });
        } 

        
        if($this->programa_id != '' && $this->search != '') {
            $inscripciones = Inscripcione::where('programa_id', $this->programa_id);
                $search = $this->search;
                $inscripciones = $inscripciones->whereHas('personale', function($q) use ($search){
                                    $q->whereHas('contacto', function($qu) use ($search){
                                        $qu->where('nombres', 'like', '%'.$search.'%')
                                            ->orWhere('apellidos', 'like', '%'.$search.'%')
                                            ->orWhere('telefono', 'like', '%'.$search.'%');
                                    });
                                });
            
            $inscripciones = $inscripciones;
            
        }else if($this->programa_id != ''){
            $inscripciones = Inscripcione::where('programa_id', $this->programa_id);
        }

        $inscripciones = $inscripciones->orderBy('role_id')->get();
        

        return view('livewire.admin.inscripcione-programa-index', compact('inscripciones'));
    }
}
