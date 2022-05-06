<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pfj;

class PfjsIndex extends Component
{
	use WithPagination;

	public $search;
	public $estado = 1;
	
	protected $paginationTheme = 'bootstrap';

	public function updatingSearch(){
		$this->resetPage();
	}

 	public function render()
    {
        $est = $this->estado;
        $pfjs = Pfj::where('nombre', 'like','%'.$this->search.'%');

  /*      
*/
        if ($est == 1) {
			$pfjs = $pfjs->where('estado', $est);
        }

		$pfjs = $pfjs->paginate(50);

        return view('livewire.admin.pfjs-index', compact('pfjs', 'est'));
    }
}
