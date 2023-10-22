<?php

namespace App\Http\Livewire\Admin;

use App\Models\Estaca;
use App\Models\Grupo;
use App\Models\Inscripcione;
use App\Models\Personale;
use App\Models\Programa;
use Livewire\Component;
use Livewire\WithPagination;

class AprobacionPersonale extends Component
{
    public $programa;
    public $search;
    public $familia;
    public $aprobacion;
    public $estaca_id;

    protected $listeners = ['changeAprob'];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public $cantpages = 15;
	public $sortBy = 'contactos.nombres';
    public $sortDirection = 'asc';

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


    public function changeAprob(Personale $personale, $value){
        $update = $personale->update([
            'permiso_obispo' => $value
        ]);
        if($update){
            $value_contacto = null;
            switch ($value) {
                case '2':
                    $value_contacto = 1;
                    break;
                case '0':
                    $value_contacto = 2;
                    break;
                
                default:
                    $value_contacto = null;
                    break;
            }
    
            $personale->contacto->update(['estado_aprobacion' => $value_contacto]);
            $this->emit('alert', true);
        }

    }
    public function mount(){

    }

    public function render()
    {
        $fam = $this->familia;
        $search = $this->search;
        $aprobacion = $this->aprobacion;
        $familias = Grupo::where('programa_id', $this->programa->id)->get();

        $_estacas = [];
        if($this->estaca_id != '') $_estacas = json_decode($this->estaca_id);

        $inscripciones = Inscripcione::where('programa_id',$this->programa->id)
                            ->where('inscripciones.estado', '1')
                            ->whereIn('inscripciones.role_id', [4,5,6])
                            ->join('personales', 'inscripciones.personale_id', '=', 'personales.id')     
                            ->join('contactos', 'contactos.id', '=', 'personales.contacto_id')
                            ->join('barrios', 'barrios.id', '=', 'contactos.barrio_id')
                            ->select(
                                'inscripciones.id as inscripciones_id',
                                'contactos.id as contactos_id',
                                'contactos.nombres as contactos_nombres',
                                'contactos.apellidos as contactos_apellidos',
                                'contactos.mes_recomendacion as contactos_mes_recomendacion',
                                'contactos.anio_recomendacion as contactos_anio_recomendacion',
                                'personales.id as personales_id',
                                'personales.permiso_obispo as permiso_obispo',
                                'barrios.estaca_id'
                            )
                            ->where(function($q) use ($_estacas) {
                                if(count($_estacas)){
                                    $q->whereIn('barrios.estaca_id', $_estacas);
                                }
                            })
                            ->whereHas('personale', function ($q) use($search){
                                $q->whereHas('contacto', function ($q) use ( $search){
                                    $q->where('nombres','like', '%'.$search.'%')
                                      ->orderBy('nombres', 'asc')  ;
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
                            if ($aprobacion != '') {
                                $inscripciones = $inscripciones->whereHas('personale', function ($q) use ($aprobacion){
                                                    $q->where('permiso_obispo', $aprobacion);
                                                });
                            }

        // $inscripciones = $inscripciones->orderBy('nombres', 'asc')
        $id_estacas = $inscripciones->get()->unique('estaca_id')->pluck('estaca_id');
        $estacas = Estaca::whereIn('id', $id_estacas)->get();
        
        $inscripciones = $inscripciones->orderBy('nombres')->paginate();
        $this->page = 1;


        return view('livewire.admin.aprobacion-personale', compact('inscripciones', 'familias', 'estacas'));
    }
}
