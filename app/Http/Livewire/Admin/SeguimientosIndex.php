<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Seguimiento;

class SeguimientosIndex extends Component
{		
	use WithPagination;

	public $search;
    public $sortBy = 'fecha';
    public $sortDirection = 'desc';
	
	protected $paginationTheme = 'bootstrap';

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

	public function updatingSearch(){
		$this->resetPage();
	}

    public function render()
    {
    	$seguimientos = Seguimiento::select('*', 'seguimientos.personal_id', 'contactos.nombres', 'pfjs.nombre')
    		->join('contactos', 'seguimientos.contacto_id', '=', 'contactos.id')
    		->join('pfjs', 'seguimientos.pfj_id', '=', 'pfjs.id')
    		->where('contactos.nombres', 'like','%'.$this->search.'%')
            ->orWhere('seguimientos.fecha', 'like','%'.$this->search.'%')
    		->orWhere('pfjs.nombre', 'like','%'.$this->search.'%')
            ->orderBy($this->sortBy, $this->sortDirection)
    		->paginate();

            //vendedor
        if (auth()->user()->hasRole('Vendedor')) {
            $that = $this;

            $seguimientos = Seguimiento::select('*', 'seguimientos.personal_id', 'contactos.nombres', 'pfjs.nombre')
                ->join('contactos', 'seguimientos.contacto_id', '=', 'contactos.id')
                ->join('pfjs', 'seguimientos.pfj_id', '=', 'pfjs.id')
                ->where('seguimientos.personal_id', auth()->user()->personal->id)
                ->where(function($query) use ($that) {
                                      $query->orwhere('contactos.nombres', 'like','%'.$this->search.'%')
                                            ->orWhere('seguimientos.fecha', 'like','%'.$this->search.'%')
                                            ->orWhere('pfjs.nombre', 'like','%'.$this->search.'%');})
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate();

        }
    	

        return view('livewire.admin.seguimientos-index', compact('seguimientos'));
    }
}
