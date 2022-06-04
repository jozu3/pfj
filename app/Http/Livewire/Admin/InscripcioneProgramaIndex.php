<?php

namespace App\Http\Livewire\Admin;

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
    public $rol;
    public $readyToLoad = false;
    public $functions_selecteds = [];

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
        $inscripciones = [];
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
                $functions_selecteds = $this->functions_selecteds;
                $inscripciones = Inscripcione::where('programa_id', $this->programa_id)
                    ->where('role_id', 'like', '%' . $this->rol);
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

                $inscripciones = $inscripciones->whereHas('personale', function ($q) use ($search) {
                    $q->whereHas('contacto', function ($qu) use ($search) {
                        $qu->where('nombres', 'like', '%' . $search . '%')
                            ->orWhere('apellidos', 'like', '%' . $search . '%')
                            ->orWhere('telefono', 'like', '%' . $search . '%');
                    });
                });




                $inscripciones = $inscripciones;
            }

            $inscripciones = $inscripciones->orderBy('role_id')->paginate();
            $this->page = 1;
        }
        $roles = Role::whereNotIn('name', ['Admin'])->get();
        $funciones = Funcione::where('programa_id', $this->programa_id)->get();

        return view('livewire.admin.inscripcione-programa-index', compact('inscripciones', 'roles', 'funciones'));
    }
}
