<?php

namespace App\Http\Livewire\Admin;

use App\Models\Grupo;
use App\Models\Inscripcione;
use App\Models\PersonaleVacuna;
use App\Models\Vacuna;
use Livewire\Component;
use Livewire\WithPagination;

class CreatePersonaleVacuna extends Component
{
    public $personale_id, $vacuna_id;
    public $programa;
    public $search;
    public $familia;
    
    use WithPagination;

	protected $paginationTheme = 'bootstrap';

    public function vacunado($personale_id, $vacuna_id)
    {
        $personaleVacuna = PersonaleVacuna::where('personale_id', $personale_id)->where('vacuna_id', $vacuna_id)->first();
        $vacunas = Vacuna::all();

        foreach ($vacunas as $vacuna) {
            if ($personaleVacuna) {

                $personaleVacuna = PersonaleVacuna::where('personale_id', $personale_id)
                    ->where('vacuna_id', $vacuna->id)->first();

                if ($personaleVacuna) {
                    if ($vacuna->id > $vacuna_id) { //&& $personaleVacuna->vacunado
                        $personaleVacuna->vacunado = false;
                    } else
                    if ($vacuna->id < $vacuna_id) { //&& !$personaleVacuna->vacunado
                        $personaleVacuna->vacunado = true;
                    } else {
                        $personaleVacuna->vacunado = !$personaleVacuna->vacunado;
                    }
                    $personaleVacuna->save();
                }
            } else {

                $personaleVacuna = PersonaleVacuna::where('personale_id', $personale_id)
                    ->where('vacuna_id', $vacuna->id)->first();

                if ($vacuna->id <= $vacuna_id) {
                    if (!$personaleVacuna) {
                        PersonaleVacuna::create([
                            'personale_id' => $personale_id,
                            'vacuna_id' => $vacuna->id,
                            'vacunado' => true,
                        ]);
                    } else {
                        $personaleVacuna->vacunado = true;
                        $personaleVacuna->save();
                    }
                    // $personaleVacuna = new PersonaleVacuna([
                    //     'personale_id' => $personale_id,
                    //     'vacuna_id' => $vacuna_id,
                    //     'vacunado' => true
                    // ]);
                }
            }
        }

    }

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
                                   
                // $inscripciones = $inscripciones->orderBy('nombres', 'asc')
                $inscripciones = $inscripciones->orderBy('contactos.nombres')->paginate();
                $this->page = 1;

        $vacunas = Vacuna::all();
        
        return view('livewire.admin.create-personale-vacuna', compact('vacunas', 'inscripciones', 'familias'));
    }
}