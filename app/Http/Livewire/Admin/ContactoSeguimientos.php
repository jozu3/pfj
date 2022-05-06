<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Pfj;
use App\Models\Seguimiento;

class ContactoSeguimientos extends Component
{	public $contacto = [];
	public $vermis_comentarios = false;

    public function render()
    {	
    	$pfjs = Pfj::pluck( 'nombre', 'id');
    	$contacto = $this->contacto;

		if ($this->vermis_comentarios) {
    		$seguimientos = Seguimiento::where('contacto_id', $contacto->id)->where('personal_id', $contacto->personal_id)->get();
		} else {
			$seguimientos = $contacto->seguimientos;
		}

        return view('livewire.admin.contacto-seguimientos', compact('contacto', 'pfjs', 'seguimientos'));
    }
}
