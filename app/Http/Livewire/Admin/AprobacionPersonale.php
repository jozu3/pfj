<?php

namespace App\Http\Livewire\Admin;

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

    protected $listeners = ['changeAprob'];

    use WithPagination;

	protected $paginationTheme = 'bootstrap';

    public function changeAprob(Personale $personale, $value){
        $update = $personale->update([
            'permiso_obispo' => $value
        ]);
        if($update){
            $this->emit('alert', true);
        }

    }

    public function render()
    {
        $fam = $this->familia;
        $search = $this->search;
        $aprobacion = $this->aprobacion;

        $inscripciones = Inscripcione::where('programa_id',$this->programa->id)
                            ->where('inscripciones.estado', '1')
                            ->join('personales', 'inscripciones.personale_id', '=', 'personales.id')     
                            ->join('contactos', 'contactos.id', '=', 'personales.contacto_id')
                            ->select(
                                'inscripciones.id as inscripciones_id',
                                'contactos.id as contactos_id',
                                'contactos.nombres as contactos_nombres',
                                'contactos.apellidos as contactos_apellidos',
                                'personales.id as personales_id',
                                'personales.permiso_obispo as permiso_obispo'
                            )   
                            ->whereHas('personale', function ($q) use($search){
                                $q->whereHas('contacto', function ($q) use ( $search){
                                    $q->where('nombres','like', '%'.$search.'%')
                                      ->orderBy('nombres', 'asc')  ;
                                });
                            });


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
        $inscripciones = $inscripciones->orderBy('nombres')->paginate();
        $this->page = 1;

        $familias = Grupo::where('programa_id', session('programa_activo'))->get();

        return view('livewire.admin.aprobacion-personale', compact('inscripciones', 'familias'));
    }
}
