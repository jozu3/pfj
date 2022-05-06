<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Inscripcione;
use Livewire\WithPagination;

class InscripcionesIndex extends Component
{
	use WithPagination;

	public $search;
	public $estado = 0;
	public $readyToLoad = false;
    public $estado_retirado = true;
    public $estado_suspendido = true;
    public $estado_habilitado = true;
	
	protected $paginationTheme = 'bootstrap';

	public function updatingSearch(){
		$this->resetPage();
	}

	public function loadInscripciones(){
		$this->readyToLoad = true;
		$this->emit('readytoload');
	}
	
    public function render()
    {
    	if ($this->readyToLoad) {
    		$states = [];
	        $this->estado_habilitado == true ? array_push($states, "0") : ''; 
	        $this->estado_retirado == true ? array_push($states, "1") : ''; 
	        $this->estado_suspendido == true ? array_push($states, "2") : ''; 

    		$inscripciones = Inscripcione::whereIn('inscripciones.estado', $states)
    							->whereHas('Personale', function($query) {
			                          $query->whereHas('contacto', function ($q){
										  $q->where('nombres', 'like','%'.$this->search.'%')
											->orWhere('apellidos', 'like','%'.$this->search.'%');
											});
									  });


    		$inscripciones = $inscripciones->orderBy('inscripciones.id', 'asc')->paginate();

    	} else {
    		$inscripciones = Inscripcione::where('personale_id', '')->paginate();
    	}

        return view('livewire.admin.inscripciones-index', compact('inscripciones'));
    }
}
