<?php

namespace App\Http\Livewire\Admin;

use App\Models\Barrio;
use Livewire\Component;
use App\Models\Contacto;
use App\Models\Estaca;
use App\Models\Personale;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class ContactosIndex extends Component
{
	use WithPagination;
	protected $paginationTheme = 'bootstrap';

    public $meses;
    public $search;
    public $estaca_id;
    public $barrio_id = 0;
    public $barrios;
    public $states;
    public $created_at;
    public $estados_selecteds;
    public $solo_obispos;

	public $sortBy = 'newassign';
    public $sortDirection = 'desc';
    public $page = 1;
    public $readyToLoad = false;

    protected $listeners = ['changeEstado' => 'changeEstado'];

    public function loadContactos()
       {
           $this->readyToLoad = true;
           $this->emit('readytoload');
       }
   
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

    public function changeEstado(Contacto $contacto)
    {
        if (in_array($contacto->estado, [2,3])) { //2: Enviado al obispo, 3: Aprobado por el obispo
            $newestado = $contacto->estado == 3? 2: 3; 
            $update = $contacto->update([
                'estado' => $newestado
            ]);
    
            if ($update) {
                $this->emit('alert', $update);
            }
        }
    }
    
    public function updatedEstacaId(){
        $this->barrio_id = 0;
	}
    
    public function mount(){
        $this->meses = [
            '1' => 'Enero',
            '2' => 'Febrero',
            '3' => 'Marzo',
            '4' => 'Abril',
            '5' => 'Mayo',
            '6' => 'Junio',
            '7' => 'Julio',
            '8' => 'Agosto',
            '9' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre',
        ];

        $this->created_at = '2023-09-10';
    }

 	public function render()
    {
        $personales = Personale::all();
        $estacas = Estaca::all();
        $that = $this;

        $_estacas = [];
        $_estacas = json_decode($this->estaca_id);
        
        $this->barrios = [];
        if( is_array($_estacas) && count($_estacas)){
            $estacasselect = [];
            $estacas_selecteds = Estaca::whereIn('id', $_estacas)->get();
            
            foreach ($estacas_selecteds as $stk_selected) {
                $estacasselect[$stk_selected->nombre] = Barrio::where('estaca_id', $stk_selected->id)->pluck('nombre', 'id');
            }
            $this->barrios = $estacasselect;
            
        }
        $_estados_selected = [];
        $_estados_selected = json_decode($this->estados_selecteds);

        if (auth()->user()->can(['admin.contactos.allcontactos'])) {

            $this->states =  [
                '1' => 'Preinscrito',
                '2' => 'Enviado al obispo',
                '3' => 'Aprobado por el obispo',
                // '4' => 'Confirmado',
                '5' => 'Inscrito',
            ];

            $contactos= Contacto::join('barrios', 'contactos.barrio_id', '=', 'barrios.id')
                    ->whereIn('estado', is_array($_estados_selected) && count($_estados_selected)? $_estados_selected : array_keys($this->states))
                    ->where(function($query) use ($that,$_estacas) {
                        if (is_array($_estacas) && count($_estacas)) {
                            $query->whereHas('barrio', function($que) use ($that,$_estacas) {
                                $que->whereIn('estaca_id', $_estacas);
                            })->where(function($query) use ($that) {
                                if ($that->barrio_id > 0) {
                                    $query->where('barrio_id', $that->barrio_id);
                                }
                            });
                        }
                    })
                    ->where(function($query) use ($that) {
                        $query->orWhere('nombres', 'like','%'.$that->search.'%')
                                ->orWhere('apellidos', 'like','%'.$that->search.'%')
                                ->orWhere('telefono', 'like','%'.$that->search.'%');
                                // ->orWhere('email', 'like','%'.$that->search.'%');
                    })
                    ->where('contactos.created_at', '>=', $this->created_at)
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate();

        } else if (auth()->user()->can(['admin.contactos.contactos_barrio'])) {//obispo
            $this->states =  [
                // '1' => 'Preinscrito',
                '2' => 'Enviado al obispo',
                '3' => 'Aprobado por el obispo',
                // '4' => 'Confirmado',
                '5' => 'Inscrito',
            ];
            $contactos = Contacto::whereIn('estado', [2,3,5])->whereIn('estado',  is_array($_estados_selected) && count($_estados_selected)? $_estados_selected : array_keys($this->states))
                            ->where('barrio_id', auth()->user()->personale->contacto->barrio_id ) 
                            ->where(function($query) use ($that) {
                                $query->orWhere('nombres', 'like','%'.$that->search.'%')
                                        ->orWhere('apellidos', 'like','%'.$that->search.'%')
                                        ->orWhere('telefono', 'like','%'.$that->search.'%');
                                        // ->orWhere('email', 'like','%'.$that->search.'%');
                            })
                            ->whereDoesntHave('personale', function($q){
                                $q->whereHas('user', function($q){
                                    $q->whereHas('roles', function($q){
                                        $q->where('slug', 'obispo');
                                    });    
                                });
                            })
                            ->where('created_at', '>=', $this->created_at)
                            ->orderBy($this->sortBy, $this->sortDirection)
                            ->paginate();
        }

        $this->resetPage();
        return view('livewire.admin.contactos-index',compact('contactos', 'personales', 'estacas'));
    }
}