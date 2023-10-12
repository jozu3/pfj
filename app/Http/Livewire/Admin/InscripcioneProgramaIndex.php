<?php

namespace App\Http\Livewire\Admin;

use App\Models\Estaca;
use App\Models\Funcione;
use Livewire\Component;
use App\Models\Inscripcione;
use App\Models\Programa;
use App\Models\Grupo;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class InscripcioneProgramaIndex extends Component
{

    //public $inscripciones;
    public $grupo_id;
    public $programa_id;
    public $search;
    public $rol = 0;
    public $estado = 1;
    public $estaca = 0;
    public $familia = 0;
    public $readyToLoad = false;
    public $functions_selecteds = [];
    public $roles = 0;

    protected $listeners = ['changeEstado' => 'changeEstado'];

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function changeEstado(Inscripcione $inscripcione)
    {
        $newestado = !$inscripcione->estado;
        $update = $inscripcione->update([
            'estado' => $newestado
        ]);

        if ($update) {
            if (!$newestado && $inscripcione->inscripcioneCompanerismo) {
                $delete = $inscripcione->inscripcioneCompanerismo->delete();
                if ($delete && $update) {
                    $this->emit('alert', $update);
                }
            } else {
                $this->emit('alert', $update);
            }
        }
    }

    public function loadPersonal()
    {
        $this->readyToLoad = true;
        $this->emit('readytoload');
    }

    public function render()
    {
        $_roles = [];
        if ($this->roles != 0 && $this->roles != '') $_roles = json_decode($this->roles);

        $inscripciones = [];
        $familias = null;
        if ($this->readyToLoad) {
            $that = $this;
            if ($this->grupo_id != '') {
                $inscripciones = Inscripcione::whereHas('inscripcioneCompanerismo', function ($q) use ($that) {
                    $q->whereHas('companerismo', function ($qu) use ($that) {
                        $qu->where('grupo_id', $that->grupo_id);
                    });
                });
            }


            if ($this->programa_id != '') {
                $search = $this->search;
                $estaca = $this->estaca;
                $familia = $this->familia;
                $estado = $this->estado;
                $rol = $this->rol;

                $functions_selecteds = $this->functions_selecteds;
                $inscripciones = Inscripcione::where('programa_id', $this->programa_id);

                //filtro por rol
                if(is_array($_roles) && count($_roles)){
                    $inscripciones = $inscripciones->whereIn('role_id', $_roles);
                }

                //filtro por estado
                if($estado != '-1'){
                    $inscripciones = $inscripciones->where('estado', $this->estado);
                }

                //filtro por funciones
                if (count($functions_selecteds) && $this->rol > 4) {
                    $i = 0;
                    foreach ($functions_selecteds as $function) {
                        if ($function == 0) {
                            $i = $i + 1;
                        }
                    }
                    if (count($functions_selecteds) != $i) {
                        $inscripciones = $inscripciones->whereHas('funciones', function ($q) use ($functions_selecteds) {

                            $q->whereIn('funcione_id', $functions_selecteds);
                        });
                    }
                }

                $inscripciones = $inscripciones->whereHas('personale', function ($q) use ($search, $estaca) {
                    $q->whereHas('contacto', function ($qu) use ($search) {
                        $qu->where('nombres', 'like', '%' . $search . '%')
                            ->orWhere('apellidos', 'like', '%' . $search . '%')
                            ->orWhere('telefono', 'like', '%' . $search . '%');
                    })->whereHas('barrio', function($qu) use ($estaca){
                        //filtro estaca
                        if($estaca != '' && $estaca != '0'){
                            $qu->where('estaca_id', $estaca);
                        }
                    });
                    
                });

                //filtro por familia
                if($familia != '' && $familia != '0'){
                    $inscripciones = $inscripciones->whereHas( 'inscripcioneCompanerismo', function($q) use ($familia) {
                        $q->whereHas( 'companerismo', function($q) use ($familia) {
                            $q->where('grupo_id', $familia);
                        });
                    });
                }






            }
            $this->emit('readytoload');
            $inscripciones = $inscripciones->orderBy('role_id')->paginate();
            $this->page = 1;
        }
        $familias = Grupo::where('programa_id',$this->programa_id)->get();
        $roles_select = Role::whereNotIn('name', ['Admin'])->get();
        $estacas = Estaca::orderBy('nombre')->get();

        $funciones = Funcione::where('programa_id', $this->programa_id)->get();

        return view('livewire.admin.inscripcione-programa-index', compact('inscripciones', 'roles_select', 'funciones', 'estacas', 'familias'));
    }
}
