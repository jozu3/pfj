<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Capacitacione;

class CapacitacionesIndex extends Component
{
	public $info_capacitacione;
	public $programa;
    public $fechacapacitacion;
    public $tema;


    protected $rules = [
		'fechacapacitacion' => 'required|date',
		'tema' => 'required',
	];


    public function submit(){
		
		$this->validate();

		$capacitacione = new Capacitacione([
            'programa_id' => $this->programa->id,
			'fechacapacitacion' => $this->fechacapacitacion,
			'tema' => $this->tema,
            'estado' => 1
		]);

		if ($capacitacione->save())
        {
            $this->info_capacitacione = 'Capacitación creada con éxito.';
        }


		$this->tema = '';

	}

    public function render()
    {
    	$capacitaciones = Capacitacione::where('programa_id', $this->programa->id)->get();

        return view('livewire.admin.capacitaciones-index', compact('capacitaciones'));
    }
}
