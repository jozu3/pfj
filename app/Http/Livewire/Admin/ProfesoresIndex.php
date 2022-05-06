<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Profesore;
use Livewire\WithPagination;


class ProfesoresIndex extends Component
{
    use WithPagination;

	public $search;
	
	protected $paginationTheme = 'bootstrap';

	public function updatingSearch(){
		$this->resetPage();
	}
    public function render()
    {
    	$profesores = Profesore::where('nombres', 'like','%'.$this->search.'%')
                            ->orWhere('apellidos', 'like','%'.$this->search.'%')->paginate();
    	

        return view('livewire.admin.profesores-index', compact('profesores'));
    }
}
