<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Pfj;
use App\Models\Programa;

class ProgramaInfo extends Component
{
	public $pfj_id;
	public $programa_id;

    public function render()
    {
        $pfjs = Pfj::where('estado', '=', 1)->pluck('nombre', 'id');
        $programas = Programa::where('pfj_id', '=', $this->pfj_id)
        				->where(function($query){
                              $query->orWhere('estado', '=', '0')
                                    ->orWhere('estado', '=', '1');
                        })->pluck('nombre', 'id');

        $programa_seleccionado = Programa::find($this->programa_id);
        
        return view('livewire.admin.programa-info', compact('pfjs', 'programas', 'programa_seleccionado'));
    }
}
