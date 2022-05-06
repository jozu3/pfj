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

    	$personales = Personale::whereHas('contacto', function($query) use ($that) {
								$query->where('apellidos', 'like','%'.$that->search.'%')
										->orWhere('nombres', 'like','%'.$that->search.'%')
										->orWhere('telefono', 'like','%'.$that->search.'%')
										->orWhere('email', 'like','%'.$that->search.'%');
								})
							->paginate();

        return view('livewire.admin.personales-index', compact('personales'));
    }
}
