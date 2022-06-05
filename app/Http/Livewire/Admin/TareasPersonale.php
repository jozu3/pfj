<?php

namespace App\Http\Livewire\Admin;

use App\Models\Grupo;
use App\Models\Inscripcione;
use App\Models\Tarea;
use Livewire\Component;
use Livewire\WithPagination;

class TareasPersonale extends Component
{
    public $programa;
    public $search;
    public $familia;
    public $aprobacion;

    use WithPagination;

	protected $paginationTheme = 'bootstrap';

    protected $listeners = ['update_totales' => 'render'];
    
    public function render()
    {
        $fam = $this->familia;
        $search = $this->search;
        $familias = Grupo::where('programa_id', session('programa_activo'))->get();


        $inscripciones = Inscripcione::where('inscripciones.programa_id', $this->programa->id)->whereIn('inscripciones.estado', [1])
                                    // ->join('inscripcione_companerismos', 'inscripciones.id', '=', 'inscripcione_companerismos.inscripcione_id')
                                    // ->join('companerismos', 'inscripcione_companerismos.id', '=', 'companerismos.id')
                                    // ->join('grupos', 'companerismos.grupo_id', '=', 'grupos.id')
                                    ->join('personales', 'inscripciones.personale_id', '=', 'personales.id')
                                    ->join('contactos', 'personales.contacto_id', '=', 'contactos.id')
                                    ->select(
                                            'inscripciones.id as inscripcione_id', 
                                            'contactos.id as contacto_id', 
                                            'contactos.nombres as contacto_nombres', 
                                            'contactos.apellidos as contacto_apellidos',
                                            'personales.estado_rtemplo as personale_estado_rtemplo',
                                            'personales.obs_rtemplo as personale_obs_rtemplo',
                                            )
                                    ->whereHas('personale', function ($q) use($search){
                                        $q->whereHas('contacto', function ($q) use ( $search){
                                            $q->where('nombres','like', '%'.$search.'%');
                                            $q->orWhere('apellidos','like', '%'.$search.'%');
                                        });
                                    });

                                    if(auth()->user()->can('admin.asistencias.migrupo' )){
                                        $auth_inscripcione = auth()->user()->personale->inscripciones->where('programa_id', $this->programa->id)->first();
                                        if($auth_inscripcione && $auth_inscripcione->inscripcioneCompanerismo){
                                            $fam = $auth_inscripcione->inscripcioneCompanerismo->companerismo->grupo_id;
                                            $this->familia = $fam; 
                                            
                                            $familias = Grupo::where('id', $fam)->get();
                                        }
                                    }
                                    if ($fam != '') {
                                        $inscripciones = $inscripciones->whereHas('inscripcioneCompanerismo', function ($q) use ($fam){
                                                            $q->whereHas('companerismo', function ($q) use ($fam){
                                                                $q->where('grupo_id', $fam);
                                                            });
                                                        });
                                    }
                                   
        $inscripciones = $inscripciones->orderBy('contactos.nombres');
        
        $inscripciones_all_ids = $inscripciones->pluck('inscripciones.inscripcione_id'); 
        $inscripciones = $inscripciones->paginate();
        $this->page = 1;
        $tareas = $this->programa->tareas;

        return view('livewire.admin.tareas-personale', compact('inscripciones', 'tareas', 'familias', 'inscripciones_all_ids'));
    }
}