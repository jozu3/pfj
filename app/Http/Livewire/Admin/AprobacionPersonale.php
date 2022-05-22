<?php

namespace App\Http\Livewire\Admin;

use App\Models\Inscripcione;
use App\Models\Personale;
use App\Models\Programa;
use Livewire\Component;
use Livewire\WithPagination;

class AprobacionPersonale extends Component
{
    public $programa;

    protected $listeners = ['changeAprob'];

    use WithPagination;

	protected $paginationTheme = 'bootstrap';

    public function changeAprob(Personale $personale, $value){
        $update = $personale->update([
            'permiso_obispo' => $value
        ]);
        if($update){
            $this->emit('alert', true);
        }

    }

    public function render()
    {
        $inscripciones = Inscripcione::where('programa_id',$this->programa->id)
                            ->where('inscripciones.estado', '1')
                            ->join('personales', 'inscripciones.personale_id', '=', 'personales.id')     
                            ->join('contactos', 'contactos.id', '=', 'personales.contacto_id')
                            ->select('*')   
                            // ->with('personale.contacto')
                            ->orderBy('nombres', 'asc')
                            // ->get()
                            // ->sortByDesc('personale.contacto.nombres')
                            ->paginate();

        return view('livewire.admin.aprobacion-personale', compact('inscripciones'));
    }
}
