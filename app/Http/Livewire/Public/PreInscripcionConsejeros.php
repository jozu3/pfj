<?php

namespace App\Http\Livewire\Public;

use App\Models\Barrio;
use App\Models\Contacto;
use App\Models\Estaca;
use Livewire\Component;

class PreInscripcionConsejeros extends Component
{

    public $name;
    public $lastname;
    public $email;
    public $telefono;
    public $gender;
    public $obispo;
    public $obispo_telefono;
    public $obispo_email;
    public $barrio_id;
    public $estudios;
    public $primeros_auxilios;
    public $trabajo;
    public $llamamiento;
    public $mes_recomendacion;
    public $anio_recomendacion;

    protected $rules = [
		'name' => 'required',
		'lastname' => 'required',
		'email' => 'required',
		'telefono' => 'required',
		'gender' => 'required',
		'obispo' => 'required',
		'obispo_telefono' => 'required',
		'barrio_id' => 'required',
		'estudios' => 'required',
		'primeros_auxilios' => 'required',
		'trabajo' => 'required',
		'llamamiento' => 'required',
		'mes_recomendacion' => 'required',
		'anio_recomendacion' => 'required',
	];

    public function submitContacto(){
        $this->validate();

        $contacto = Contacto::create([

        ]);

        

    }

    public function render()
    {

        $estacas = Estaca::get();
        $estacasselect = [];

        foreach ($estacas as $estaca) {
            $estacasselect[$estaca->nombre] = Barrio::where('estaca_id', $estaca->id)->pluck('nombre', 'id');
        }

        $estacasselect["Desconocido"] = 'Otro';

        return view('livewire.public.pre-inscripcion-consejeros', compact('estacasselect'));
    }
}
