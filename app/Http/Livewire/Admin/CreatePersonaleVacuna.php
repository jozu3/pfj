<?php

namespace App\Http\Livewire\Admin;

use App\Models\Inscripcione;
use App\Models\PersonaleVacuna;
use App\Models\Vacuna;
use Livewire\Component;

class CreatePersonaleVacuna extends Component
{
    public $personale_id, $vacuna_id;
    public $programa;

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
        $vacunas = Vacuna::all();

        $inscripciones = Inscripcione::where('programa_id', $this->programa->id)->whereIn('estado', [1])
                                    ->with('personale.contacto')
                                    ->get()
                                    ->sortBy('personale.contacto.nombres');
        
        return view('livewire.admin.create-personale-vacuna', compact('vacunas', 'inscripciones'));
    }
}