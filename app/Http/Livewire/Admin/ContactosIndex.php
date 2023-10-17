<?php

namespace App\Http\Livewire\Admin;

use App\Models\Barrio;
use Livewire\Component;
use App\Models\Contacto;
use App\Models\Estaca;
use App\Models\Personale;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class ContactosIndex extends Component
{
	use WithPagination;
	protected $paginationTheme = 'bootstrap';

    public $meses;
    public $search;
    public $estaca_id;
    public $barrio_id = 0;
    public $roles;
    public $barrios;
    public $states;
    public $estado_aprobaciones_selecteds;
    public $estado_aprobaciones;
    public $created_at;
    public $estados_selecteds;
    public $solo_obispos;
    public $aprob_contacto = [];

	public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $page = 1;
    public $cant_pages = 15;
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

        $this->estado_aprobaciones = [
            '1' => 'Aprobado',
            'NULL' => 'Aprobación pendiente',
            '2' => 'Desaprobado',
        ];
    }

    public function updatedAprobContacto($value, $key){
        $contacto = Contacto::find($key);
        $contacto->update(['estado_aprobacion' => $value]);
        $value_personale = 1;
        switch ($value) {
            case '1':
                $value_personale = 2;
                break;
            case '2':
                $value_personale = 0;
                break;
            
            default:
                $value_personale = 1;
                break;
        }

        $contacto->personale->update(['permiso_obispo' => $value_personale ]);
    }

 	public function render()
    {
        $personales = Personale::all();
        $estacas = Estaca::all();
        $that = $this;

        $_estacas = [];
        $_estacas = json_decode($this->estaca_id);

        $_roles = [];
        if($this->roles != '') $_roles = json_decode($this->roles);
        
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

        $_estado_aprobaciones_selecteds = [];
        if ($this->estado_aprobaciones_selecteds != '') {
            $_estado_aprobaciones_selecteds = json_decode($this->estado_aprobaciones_selecteds);
        }

        if (auth()->user()->can(['admin.contactos.allcontactos'])) {

            $this->states =  [
                '1' => 'Preinscrito',
                // '2' => 'Enviado al obispo',
                // '3' => 'Aprobado por el obispo',
                // '4' => 'Confirmado',
                '5' => 'Inscrito',
            ];

            $contactos= Contacto::
                    whereIn('estado', is_array($_estados_selected) && count($_estados_selected)? $_estados_selected : array_keys($this->states))
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
                    ->where(function($q) use ($_estado_aprobaciones_selecteds){
                        $q->where(function($query) use ($_estado_aprobaciones_selecteds) {
                            if(count($_estado_aprobaciones_selecteds)){
                                $query->whereIn('estado_aprobacion', $_estado_aprobaciones_selecteds);
                            }
                        })
                        ->orWhere(function($query) use ($_estado_aprobaciones_selecteds) {
                            if (in_array('NULL', $_estado_aprobaciones_selecteds, true)) {
                                $query->where('estado_aprobacion', null);
                            }
                        });
                    })
                    ->whereDoesntHave('personale', function($q) use ($_roles){
                        $q->whereHas('user', function($q) use ($_roles){
                            $q->whereHas('roles', function($q) use ($_roles){
                                $q->whereIn('id', $_roles);
                            });    
                        });
                    })
                    ->where(function($query) use ($that) {
                        $query->orWhere('nombres', 'like','%'.$that->search.'%')
                                ->orWhere('apellidos', 'like','%'.$that->search.'%')
                                ->orWhere('telefono', 'like','%'.$that->search.'%');
                                // ->orWhere('email', 'like','%'.$that->search.'%');
                    })
                    ->where('contactos.created_at', '>=', $this->created_at);
                    if (!str_contains($this->sortBy,'.')) {
                        $contactos = $contactos->orderBy($this->sortBy, $this->sortDirection);
                    } else {
                    switch ($this->sortDirection) {
                        case 'asc':
                            $contactos = $contactos->get()->sortBy(function($item) use ($that) {
                                switch ($that->sortBy) {
                                    case 'barrio.estaca.nombre':
                                    return $item->barrio->estaca->nombre;
                                    break;
                                    case 'barrio.nombre':
                                    return $item->barrio->nombre;
                                    break;
                                    default:
                                        break;
                                }
                            }); 
                        break;
                        case 'desc':
                            $contactos = $contactos->get()->sortByDesc(function($item) use ($that) {
                                switch ($that->sortBy) {
                                    case 'barrio.estaca.nombre':
                                    return $item->barrio->estaca->nombre;
                                    break;
                                    case 'barrio.nombre':
                                    return $item->barrio->nombre;
                                    break;
                                    default:
                                        break;
                                }
                            });
                            break;                                    
                        default:
                            $contactos = $contactos;
                            break;
                    }}
                    $contactos = $contactos->paginate($this->cant_pages);

        } else if (auth()->user()->can(['admin.contactos.contactos_barrio'])) {//obispo
            $this->states =  [
                '1' => 'Preinscrito',
                // '2' => 'Enviado al obispo',
                // '3' => 'Aprobado por el obispo',
                // '4' => 'Confirmado',
                '5' => 'Inscrito',
            ];
            $contactos = Contacto::whereIn('estado', [1,2,3,5])->whereIn('estado',  is_array($_estados_selected) && count($_estados_selected)? $_estados_selected : array_keys($this->states))
                            ->where('barrio_id', auth()->user()->personale->contacto->barrio_id ) 
                            ->where(function($query) use ($that) {
                                $query->orWhere('nombres', 'like','%'.$that->search.'%')
                                        ->orWhere('apellidos', 'like','%'.$that->search.'%')
                                        ->orWhere('telefono', 'like','%'.$that->search.'%');
                                        // ->orWhere('email', 'like','%'.$that->search.'%');
                            })
                            ->where(function($q) use ($_estado_aprobaciones_selecteds){
                                $q->where(function($query) use ($_estado_aprobaciones_selecteds) {
                                    if(count($_estado_aprobaciones_selecteds)){
                                        $query->whereIn('estado_aprobacion', $_estado_aprobaciones_selecteds);
                                    }
                                })
                                ->orWhere(function($query) use ($_estado_aprobaciones_selecteds) {
                                    if (in_array('NULL', $_estado_aprobaciones_selecteds, true)) {
                                        $query->where('estado_aprobacion', null);
                                    }
                                });
                            })
                            ->whereDoesntHave('personale', function($q){
                                $q->whereHas('user', function($q){
                                    $q->whereHas('roles', function($q){
                                        $q->where('slug', 'obispo');
                                    });    
                                });
                            })
                            ->where('created_at', '>=', $this->created_at);
                            if (!str_contains($this->sortBy,'.')) {
                                $contactos = $contactos->orderBy($this->sortBy, $this->sortDirection);
                            }
                            $contactos = $contactos->paginate($this->cant_pages);
        }

        $this->resetPage();
        $roles_select = Role::whereNotIn('name', ['Admin'])->get();

        return view('livewire.admin.contactos-index',compact('contactos', 'roles_select', 'personales', 'estacas'));
    }
}