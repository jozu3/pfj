<?php

namespace App\Http\Livewire\Admin;

use App\Models\Grupo;
use App\Models\Inscripcione;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AsistenciaPersonale extends Component
{   
    public $programa;
    public $search;
    public $familia;
    public $aprobacion;
    public $cantpages = 15;
	public $sortBy = 'contactos.nombres';
    public $sortDirection = 'asc';

    use WithPagination;

	protected $paginationTheme = 'bootstrap';

    protected $listeners = ['update_totales' => 'render'];

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortBy === $field
            ? $this->reverseSort()
            : 'asc';

        $this->sortBy = $field;
    }

    public function reverseSort()
    {
        return $this->sortDirection === 'asc'
            ? 'desc'
            : 'asc';
    }

    public function render()
    {   
        $fam = $this->familia;
        $search = $this->search;
        $familias = Grupo::where('programa_id', session('programa_activo'))->get();


        $inscripciones = Inscripcione::where('inscripciones.programa_id', $this->programa->id)
                                    ->whereIn('role_id', [2,3,4,5,6,8])
                                    ->whereIn('inscripciones.estado', [1])
                                    // ->join('inscripcione_companerismos', 'inscripciones.id', '=', 'inscripcione_companerismos.inscripcione_id')
                                    // ->join('companerismos', 'inscripcione_companerismos.id', '=', 'companerismos.id')
                                    // ->join('grupos', 'companerismos.grupo_id', '=', 'grupos.id')
                                    ->join('personales', 'inscripciones.personale_id', '=', 'personales.id')
                                    ->join('contactos', 'personales.contacto_id', '=', 'contactos.id')
                                    // ->join('asistencias', 'inscripciones.id', '=', 'asistencias.inscripcione_id')
                                    ->select(
                                            'inscripciones.id as inscripcione_id', 
                                            'contactos.id as contacto_id', 
                                            'contactos.nombres as contacto_nombres', 
                                            'contactos.apellidos as contacto_apellidos',
                                            'personales.estado_rtemplo as personale_estado_rtemplo',
                                            'personales.obs_rtemplo as personale_obs_rtemplo'
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
                                   
        $inscripciones = $inscripciones->orderBy($this->sortBy, $this->sortDirection);
        
        $inscripciones_all_ids = $inscripciones->pluck('inscripciones.inscripcione_id'); 
        $inscripciones = $inscripciones->paginate($this->cantpages);
        $this->page = 1;

        $capacitaciones = $this->programa->capacitaciones->where('tipo', '1');

        return view('livewire.admin.asistencia-personale', compact('inscripciones', 'familias', 'capacitaciones', 'inscripciones_all_ids'));
    }
}
