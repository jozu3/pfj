<?php

namespace App\Http\Livewire\Admin;

use App\Models\Programa;
use App\Models\Tarea;
use Livewire\Component;
use Livewire\WithPagination;

class TareaLista extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $idTarea;
    public $programa;
    // public $tareas;
    public $addTarea = false;

    public $fecha;
    public $descripcion;

    protected $listeners = ['render' => 'render'];
    protected $rules = [
        'fecha' => 'required',
        'descripcion' => 'required',
    ];

    public function saveTarea()
    {
        $this->validate();
        if ($this->idTarea) {
            Tarea::where('id', $this->idTarea)
                ->update([
                    'fecha' => $this->fecha,
                    'descripcion' => $this->descripcion,
                ]);
        } else {
            Tarea::create([
                'fecha' => $this->fecha,
                'descripcion' => $this->descripcion,
                'programa_id' => $this->programa->id,
            ]);
        }

        $this->reset(['addTarea', 'idTarea', 'fecha', 'descripcion']);
        $this->render();

    }

    public function editTarea(Tarea $tarea)
    {
        // $tarea = Tarea::find($id);
        $this->idTarea = $tarea->id;
        $this->fecha = $tarea->fecha;
        $this->descripcion = $tarea->descripcion;
        $this->addTarea = true;
    }

    public function removeTarea($idTarea){
        $deleted = Tarea::where('id', $idTarea)->delete();
    }

    public function render()
    {
        $tareas = Tarea::where('programa_id', $this->programa->id)->orderBy('fecha', 'desc')->paginate(5);
        return view('livewire.admin.tarea-lista', compact('tareas'));
    }
}
