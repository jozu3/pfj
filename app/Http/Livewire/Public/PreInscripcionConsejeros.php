<?php

namespace App\Http\Livewire\Public;

use App\Models\Barrio;
use App\Models\Contacto;
use App\Models\Estaca;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class PreInscripcionConsejeros extends Component
{
    use WithFileUploads;

    public $nombres;
    public $apellidos;
    public $email;
    public $telefono;
    public $fecnac;
    public $genero;
    public $barrio_id;
    public $otro_barrio;
    public $otra_estaca;
    public $obispo;
    public $telefono_obispo;
    public $email_obispo;
    public $estudios;
    public $primeros_auxilios;
    public $ocupacion;
    public $llamamiento;
    public $instituto;
    public $mretornado;
    public $mision;
    public $mes_recomendacion;
    public $anio_recomendacion;
    public $imgperfil;
    public $disabled_enviar = '';

    public $asiste_instituto;
    public $recomendacion_vigente;

    public $result = false;

    protected $rules = [
		'nombres' => 'required',
		'apellidos' => 'required',
		'email' => 'required|email|unique:App\Models\Contacto,email',
		'telefono' => 'required|numeric|digits:9|min:0|unique:App\Models\Contacto,telefono',
		'fecnac' => 'required',
		'genero' => 'required',
		'barrio_id' => 'required',
		'otro_barrio' => 'required_if:barrio_id,1',
		'otra_estaca' => 'required_if:barrio_id,1',
		'obispo' => 'required',
		'telefono_obispo' => 'required|numeric|digits:9|min:0',
		// 'email_obispo' => 'required',
		'estudios' => 'required',
		'primeros_auxilios' => 'required',
		'ocupacion' => 'required',
		'llamamiento' => 'required',
		'asiste_instituto' => 'required',
        'instituto' => 'required_if:asiste_instituto,1',
		'mretornado' => 'required',
		'mision' => 'required_if:mretornado,1',
		'recomendacion_vigente' => 'required',
		'mes_recomendacion' => 'required_if:recomendacion_vigente,1',
		'anio_recomendacion' => 'required_if:recomendacion_vigente,1',
		'imgperfil' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
	];

    public function updatedImgperfil(){
        $this->validateOnly('imgperfil');
        $this->emit('imagen_cargada');
    }

    public function guardar(){
        $this->validate();

        $contacto = Contacto::create([
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'fecnac' => $this->fecnac,
            'genero' => $this->genero,
            'barrio_id' => $this->barrio_id,
            'otro_barrio' => $this->otro_barrio,
            'otra_estaca' => $this->otra_estaca,
            'obispo' => $this->obispo,
            'telobispo' => $this->telefono_obispo,
            'email_obispo' => $this->email_obispo,
            'estudios' => $this->estudios,
            'primeros_auxilios' => $this->primeros_auxilios,
            'ocupacion' => $this->ocupacion,
            'llamamiento' => $this->llamamiento,
            'instituto' => $this->instituto,
            'mretornado' => $this->mretornado,
            'mision' => $this->mision,
            'mes_recomendacion' => $this->mes_recomendacion,
            'anio_recomendacion' => $this->anio_recomendacion,
            'estado' => 1
        ]);

        if($contacto){
     
            if ($this->imgperfil) {
                $url = Storage::put('contactos', $this->imgperfil);
                $contacto->image()->create([
                    'url' => $url
                ]);
            }
            $this->result = true;
        }

    }

    public function loadFormulario(){
        $this->emitSelf('postAdded');
    }

    public function render()
    {

        $estacas = Estaca::whereNotIn('id', ['1'])->get();
        $estacasselect = [];

        foreach ($estacas as $estaca) {
            $estacasselect[$estaca->nombre] = Barrio::where('estaca_id', $estaca->id)->pluck('nombre', 'id');
        }

        $estacasselect["1"] = 'Otro';

        return view('livewire.public.pre-inscripcion-consejeros', compact('estacasselect'));
    }
}
