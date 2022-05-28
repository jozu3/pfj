<?php

namespace App\Http\Livewire\Admin;

use App\Models\Grupo;
use App\Models\Inscripcione;
use Livewire\Component;
use Livewire\WithPagination;

class CreatePersonaleRtemplo extends Component
{
    public $programa;
    public $search;
    public $familia;
    public $rtemplo;
    
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $fam = $this->familia;
        $search = $this->search;
        $rtemplo = $this->rtemplo;

        $inscripciones = Inscripcione::where('programa_id', $this->programa->id)->whereIn('estado', [1])
                                    ->whereHas('personale', function ($q) use($search){
                                        $q->whereHas('contacto', function ($q) use ( $search){
                                            $q->where('nombres','like', '%'.$search.'%');
                                        });
                                    });
                                    if ($fam != '') {
                                        $inscripciones = $inscripciones->whereHas('inscripcioneCompanerismo', function ($q) use ($fam){
                                                            $q->whereHas('companerismo', function ($q) use ($fam){
                                                                $q->where('grupo_id', $fam);
                                                            });
                                                        });
                                    }
                                    if ($rtemplo != '') {
                                        $inscripciones = $inscripciones->whereHas('personale', function ($q) use ($rtemplo){
                                                            if($rtemplo == '2') {
                                                                $q->where('obs_rtemplo', '<>','');
                                                            } else {
                                                                $q->where('estado_rtemplo', $rtemplo);
                                                            }
                                                        });
                                    }
        
                // $inscripciones = $inscripciones->orderBy('nombres', 'asc')
                $inscripciones = $inscripciones->with(['personale.contacto' => function ($query)  {
                    $query->orderBy('nombres', 'asc');
                }])->paginate();
                $this->page = 1;
        
                $familias = Grupo::where('programa_id', session('programa_activo'))->get();
        

        return view('livewire.admin.create-personale-rtemplo', compact('inscripciones', 'familias'));
    }
}
