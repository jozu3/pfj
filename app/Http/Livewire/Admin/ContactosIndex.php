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
    public $estaca_id = 0;
    public $barrio_id = 0;
    public $barrios;
    public $created_at;

    public $nocontactado = true;
    public $contactado = true;
    public $probable = true;
	public $confirmado = true;
	public $inscrito = true;
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
   
	public function updatingSearch(){
		$this->resetPage();
	}

    public function updatedEstacaId(){
        $this->barrio_id = 0;
	}
    
    public function showbarrios(){
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
        $vendedor = null;
        $that = $this;
        $states = [];
        $this->nocontactado == true ? array_push($states, "1") : ''; 
        $this->contactado == true ? array_push($states, "2") : ''; 
        $this->probable == true ? array_push($states, "3") : '';
        $this->confirmado == true ? array_push($states, "4") : '';
        $this->inscrito == true ? array_push($states, "5") : '';

        $this->barrios = [];
        if($this->estaca_id > 0){
            $this->barrios = Barrio::where('estaca_id', $this->estaca_id)->get();            
        }

        if (auth()->user()->can(['admin.contactos.allcontactos'])) {
            $contactos= Contacto::whereIn('estado', $states)
                    ->where(function($query) use ($that) {
                        if ($that->estaca_id > 0) {
                            $query->whereHas('barrio', function($que) use ($that) {
                                $que->where('estaca_id', $that->estaca_id);
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
                    ->where('created_at', '>=', $this->created_at)
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate();
        } else if (auth()->user()->can(['admin.contactos.contactos_barrio'])) {//obispo
            $contactos = Contacto::whereIn('estado', [2,3,5])->whereIn('estado', $states)->where('barrio_id', auth()->user()->personale->contacto->barrio_id ) 
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

        $this->page = 1;

        return view('livewire.admin.contactos-index',compact('contactos', 'personales', 'estacas'));
    }
}