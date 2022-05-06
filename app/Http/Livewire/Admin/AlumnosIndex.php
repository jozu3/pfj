<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Personale;
use Livewire\WithPagination;

class PersonalesIndex extends Component
{
	use WithPagination;

	public $search;
	
	protected $paginationTheme = 'bootstrap';

	public function updatingSearch(){
		$this->resetPage();
	}

    public function render()
    {
        $that = $this;

    	$personales = Personale::select('*','personales.id as id', 'contactos.id as idcontacto')
                    ->join('contactos', 'personales.contacto_id', '=', 'contactos.id')
                    //->join('inscripciones', 'inscripciones.personale_id', '=', 'personales.id')
                    ->where(function($query) use ($that) {
                          $query->orWhere('contactos.apellidos', 'like','%'.$that->search.'%')
	 			                ->orWhere('contactos.nombres', 'like','%'.$that->search.'%')
                                ->orWhere('contactos.telefono', 'like','%'.$that->search.'%')
                                ->orWhere('contactos.email', 'like','%'.$that->search.'%');
                        });

        if (auth()->user()->hasRole(['Profesor'])) {
            $personales = $personales->whereHas('inscripciones', function($q){ 
                $q->where("inscripciones.personal_id", auth()->user()->profesor->id); 
            });
        }
        $personales = $personales->paginate();

            		//dd($personales);
        return view('livewire.admin.personales-index', compact('personales'));
    }
}
