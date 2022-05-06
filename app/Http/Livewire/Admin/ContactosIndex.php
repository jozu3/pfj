<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Contacto;
use App\Models\Personale;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class ContactosIndex extends Component
{
	use WithPagination;

    public $search;
    public $nocontactado = true;
    public $contactado = true;
    public $probable = true;
	public $confirmado = true;
	public $inscrito = true;
	public $sortBy = 'newassign';
    public $sortDirection = 'desc';
    public $page = 1;

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortBy === $field
            ? $this->reverseSort()
            : 'asc';

        $this->sortBy = $field;
    }

    public function reverseSort()
    {
        return $this->sortDirection === 'asc'
            ? 'desc'
            : 'asc';
    }

	protected $paginationTheme = 'bootstrap';

	public function updatingSearch(){
		$this->resetPage();
	}

 	public function render()
    {
        $personales = Personale::all();
        $vendedor = null;
        $that = $this;
        $states = [];
        $this->nocontactado == true ? array_push($states, "1") : ''; 
        $this->contactado == true ? array_push($states, "2") : ''; 
        $this->probable == true ? array_push($states, "3") : '';
        $this->confirmado == true ? array_push($states, "4") : '';
        $this->inscrito == true ? array_push($states, "5") : '';


        // if (auth()->user()->hasRole()) {//vendedor

        //     $contactos = Contacto::where('personal_id', '=', auth()->user()->personal->id)
        //                         ->where('estado', '>=', '1')
        //                         ->where('estado', '<=', '4')
        //                         ->whereIn('estado', $states)
        //                         ->where(function($query) use ($that) {
        //                               $query->orWhere('nombres', 'like','%'.$that->search.'%')
        //                                     ->orWhere('apellidos', 'like','%'.$that->search.'%')
        //                                     ->orWhere('telefono', 'like','%'.$that->search.'%');
        //                                    // ->orWhere('email', 'like','%'.$that->search.'%');
        //                         })
        //                         ->orderBy($this->sortBy, $this->sortDirection)
        //                         ->paginate();            
        // } 

        if (auth()->user()->can(['admin.contactos.index'])) {//admin o asistente
            
          $contactos= Contacto::where('estado', '>=', '1')
                                ->where('estado', '<=', '5')
                                ->whereIn('estado', $states)
                                ->where(function($query) use ($that) {
                                      $query->orWhere('nombres', 'like','%'.$that->search.'%')
                                            ->orWhere('apellidos', 'like','%'.$that->search.'%')
                                            ->orWhere('telefono', 'like','%'.$that->search.'%');
                                           // ->orWhere('email', 'like','%'.$that->search.'%');
                                })
                                ->orderBy($this->sortBy, $this->sortDirection)
                                ->paginate();
        }



        $this->page = 1;

        return view('livewire.admin.contactos-index',compact('contactos', 'personales'));
    }
}