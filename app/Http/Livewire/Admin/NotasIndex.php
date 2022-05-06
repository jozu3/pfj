<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Unidad;
use App\Models\Nota;

class NotasIndex extends Component
{
	public $unidad;
	public $descripcion;
	public $tipo = 0;
	public $valor;
	public $notas_completas;
	public $tiene_nota_recuperatoria;


	protected $rules = [
        'descripcion' => 'required',
        'tipo' => 'required',
        'valor' => 'required',
        'valor' => 'exclude_if:tipo,1|numeric|min:0.01|max:1',
    ];

    protected $messages = [
    	'tipo.in' => 'Esta unidad ya tiene una nota recuperatoria.'
    ];

    private function notas_completas(){
    	$this->notas_completas = 0;

    	foreach ($this->unidad->notas as $nota) {
				$this->notas_completas += $nota->valor;
			}

		//return $this->notas_completas;
    }

    private function tiene_nota_recuperatoria(){
    	$this->tiene_nota_recuperatoria = 0;

		foreach ($this->unidad->notas as $nota) {
			if ($nota->tipo == 1)
			{
				//sí tiene
				$this->tiene_nota_recuperatoria = 1;
				//$this->addError('tiene_nota_recuperatoria', 'Esta unidad ya tiene una nota recuperatoria.');
			}
		}	
    }

	public function submit(){

		$this->notas_completas = 0;
		$this->tiene_nota_recuperatoria == 0;

		$this->tiene_nota_recuperatoria();
		$this->notas_completas();

		if ($this->tiene_nota_recuperatoria == 1 && $this->tipo == 1){
			$this->rules['tipo'] = 'required|in:0';
			$this->rules['tipo'] = 'required|in:0';
		}

		$registrar = false;
		$registrar2 = false;

		if ($this->notas_completas >= 1) {
			$this->addError('notas_completas', 'Las notas están completas.');
			if($this->tiene_nota_recuperatoria == 0 && $this->tipo == 1){
				$registrar = true;
				$this->valor = 0;
			}
		} else {
			if ($this->valor === '') {
				$this->valor = 0;
			}
			if (($this->valor + $this->notas_completas ) > 1) {
				$this->addError('notas_completas', 'El valor ingresado a la nota excede el 100% del total.');
			}
			else{
			
				$registrar2 = true;
				
			}
		}

		if ($registrar2 || $registrar){

			$this->validate();

			$nota = new Nota([
					'unidad_id' => $this->unidad->id,
					'descripcion' => $this->descripcion,
					'tipo' => $this->tipo,
					'valor' => $this->valor,
				]);

			$nota->save();

			$this->unidad = $nota->unidad;
			$this->descripcion = '';
			$this->valor = '';
			$this->tipo = 0;

		}
	}


    public function render()
    {
    	$this->notas_completas();
    	$this->tiene_nota_recuperatoria();
    	//$notas = $this->unidad->notas;
    	$notas = Nota::where('unidad_id', $this->unidad->id)->orderBy('tipo', 'asc')->get();

        return view('livewire.admin.notas-index', compact('notas'));
    }
}
