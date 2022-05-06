<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Programa;
use App\Models\Grupo;
use Livewire\WithPagination;

class ProgramasIndex extends Component
{
	use WithPagination;

	public $search;
	public $pfj_id;
	public $estado = 1;
	public $poriniciar = true;
    public $iniciado = true;
    public $terminado = true;
	public $mis_programas;

	protected $paginationTheme = 'bootstrap';
	public $cant = 15;


	public function updatingSearch(){
		$this->resetPage();
	}

    public function render()
    {
		$states = [];
		$this->poriniciar == true ? array_push($states, "0") : ''; 
	    $this->iniciado == true ? array_push($states, "1") : '';
	    $this->terminado == true ? array_push($states, "2") : '';
	    
	    //$pfj_id = $this->pfj_id;

    	$programas = Programa::where('nombre', 'like','%'.$this->search.'%')
							->whereIn('estado', $states);
										

		if($this->pfj_id != ''){
			$programas = $programas->whereHas('pfj', function($q) {
				$q->where( 'id', $this->pfj_id);
			});
		}
		
		$programas = $programas->whereHas('pfj', function ($q){
			$q->where( 'nombre', 'like','%'.$this->search.'%');
		});
		

							
		if ($this->mis_programas == true) {
			$programas = Programa::whereHas("inscripciones", function($q) {
				$q->where("personale_id", auth()->user()->personale->id); 
			})->whereIn('estado', $states);
		}



		$programas = $programas->orderby('programas.fecha_inicio', 'desc')
							->paginate($this->cant);



		$this->resetPage();

        return view('livewire.admin.programas-index', compact('programas'));
    }
}