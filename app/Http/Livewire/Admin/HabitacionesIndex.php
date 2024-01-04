<?php

namespace App\Http\Livewire\Admin;

use App\Models\Habitacione;
use App\Models\Locale;
use Livewire\Component;
use Livewire\WithPagination;

class HabitacionesIndex extends Component
{
    public $search;
    public $edificio;
    public $piso;
    public $cant;
    public $locale;

    use WithPagination;

   protected $paginationTheme = 'bootstrap';
    
    public function render()
    { 
        $that = $this;

        $habitaciones = Habitacione::whereHas('piso', function ($q) use ($that){
                                        $q->whereHas('edificio', function ($qe) use ($that){
                                            $qe->where('locale_id', $that->locale);
                                        });
                                    })
                                    ->with('alojamientos', function($q){
                                        $q->whereHas('participante', function($q){
                                            $q->where('programa_id', session('programa_activo')); 
                                        }); 
                                    })
                                    ->with('alojamientosPersonales', function($q){
                                        $q->whereHas('inscripcione', function($q){
                                            $q->where('programa_id', session('programa_activo')); 
                                        }); 
                                    })
                                    ->paginate($this->cant);

        $locales = Locale::all();

        return view('livewire.admin.habitaciones-index', compact('habitaciones', 'locales'));
    }
}
