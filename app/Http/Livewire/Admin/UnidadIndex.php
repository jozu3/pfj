<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Unidad;
use App\Models\Pfj;
use App\Models\Nota;
use App\Models\Profesore;

class UnidadIndex extends Component
{
	public $grupo;
	public $descripcion;
	public $fechainicio;
	public $cantidad_clases;
	public $profesor;
	public $iniciado;

	protected $rules = [
		'descripcion' => 'required',
		'fechainicio' => 'required|date',
		'cantidad_clases' => 'required|numeric|min:1',
		'profesor' => 'required',
	];

	public function submit(){
		
		$this->validate();

		$unidad = new Unidad([
			'descripcion' => $this->descripcion,
			'fechainicio' => $this->fechainicio,
			'cantidad_clases' => $this->cantidad_clases,
			'grupo_id' => $this->grupo->id,
			'profesore_id' => $this->profesor,
		]);

		$unidad->save();

		//route('admin.grupos.store',$unidad);

		$this->descripcion = '';

	}

    public function render()
    {
    	$grupos = Unidad::where('grupo_id', $this->grupo->id)->get();
    	$profesores = Profesore::all();

        return view('livewire.admin.unidad-index', compact('grupos', 'profesores'));
    }
}
