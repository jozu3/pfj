<?php

namespace App\Http\Livewire\Admin\Programa;

use App\Models\Habitacione;
use Livewire\Component;

class ShowAlojamientos extends Component
{
    public $programa;
    public $habitacione;

    protected $listeners = ['showAlojamientos'];

    public function showAlojamientos($habitacione_id)
    {
        $that = $this;
        $this->habitacione = Habitacione::where('id', $habitacione_id)->with('alojamientos', function ($q) use ($that) {
            $q->whereHas('participante', function ($q) use ($that) {
                        $q->where('programa_id', $that->programa);
                    });
                })
            ->with('alojamientosPersonales', function ($q) use ($that) {
                $q->whereHas('inscripcione', function ($q) use ($that) {
                    $q->where('programa_id', $that->programa);
                });
            })->first();
    }

    public function render()
    {
        $alojados = null;
        return view('livewire.admin.programa.show-alojamientos', compact('alojados'));
    }
}
