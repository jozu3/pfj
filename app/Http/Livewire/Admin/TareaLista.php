<?php

namespace App\Http\Livewire\Admin;

use App\Models\Comentario;
use App\Models\InscripcioneTarea;
use App\Models\Materiale;
use App\Models\Programa;
use App\Models\Tarea;
use App\Models\TareaMateriale;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class TareaLista extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $noMaterial = 1;
    public $idTarea;
    public $programa;
    public $addTarea = false;

    public $fecha_inicio, $fecha_final, $descripcion;
    public $tareaMateriales;
    public $deleteTareaMaterial = [], $rrr;

    protected $listeners = ['refresh' => 'render'];
    protected $rules = [
        'fecha_inicio' => 'required',
        'fecha_final' => 'required',
        // 'descripcion' => 'required',        
        'tareaMateriales.*.materiale_id' => 'required',
        'tareaMateriales.*.tema' => 'required',
    ];

    public function añadirTareaMaterial()
    {
        $this->noMaterial = $this->noMaterial + 1;
    }

    public function quitarTareaMaterial($index = null)
    {
        if (!is_null($index) && $this->tareaMateriales != null && $this->tareaMateriales[$index] != null) {
            array_push($this->deleteTareaMaterial, $this->tareaMateriales[$index]['id']);
            array_splice($this->tareaMateriales, $index, 1);
        }
        $this->noMaterial = $this->noMaterial - 1;
    }

    public function saveTarea()
    {
        $this->validate();
        if ($this->idTarea) {
            $tarea = Tarea::where('id', $this->idTarea)->first();
            $tarea->fecha_inicio = $this->fecha_inicio;
            $tarea->fecha_final = $this->fecha_final;
            $tarea->descripcion = $this->descripcion;
            $tarea->save();

            foreach ($this->tareaMateriales as $tareaMaterial) {
                if (array_key_exists("id", $tareaMaterial)) {
                    $tareaMateriale = TareaMateriale::where('tarea_id', $this->idTarea)
                        ->where('id', $tareaMaterial['id'])->first();

                    $tareaMateriale->materiale_id = $tareaMaterial['materiale_id'];
                    $tareaMateriale->tema = $tareaMaterial['tema'];
                    $tareaMateriale->link = isset($tareaMaterial['link'])  ? $tareaMaterial['link'] : '';
                    $tareaMateriale->save();
                    // unset($array[array_search($tareaMaterial['id'], $tareaMateriale)]);
                } else {
                    TareaMateriale::create([
                        'tarea_id' => $this->idTarea,
                        'materiale_id' => $tareaMaterial['materiale_id'],
                        'tema' => $tareaMaterial['tema'],
                        'link' => isset($tareaMaterial['link'])  ? $tareaMaterial['link'] : '',
                    ]);
                }
            }

            foreach ($this->deleteTareaMaterial as $delete) {
                TareaMateriale::where('id', $delete)->delete();
            }

            $extractImages = '/src=["\']([^ ^"^\']*)["\']/ims';
            preg_match_all($extractImages, $this->descripcion, $matches);
            $img_nuevas = $matches[1];
            $img_antiguas = $tarea->images()->pluck('url')->toArray();

            foreach ($img_nuevas as $img) {
                $url_image = 'images-tareas/' . pathinfo($img, PATHINFO_BASENAME);

                $clave = array_search($url_image, $img_antiguas);
                if ($clave === false) {
                    $tarea->images()->create([
                        'url' => $url_image
                    ]);
                } else {
                    unset($img_antiguas[$clave]);
                }
            }

            foreach ($img_antiguas as $img) {
                Storage::delete($img);
                $tarea->images()->where('url', $img)->delete();
            }
        } else {
            $tarea = Tarea::create([
                'fecha_inicio' => $this->fecha_inicio,
                'fecha_final' => $this->fecha_final,
                'descripcion' => $this->descripcion,
                'programa_id' => $this->programa->id,
            ]);

            foreach ($this->tareaMateriales as $tareaMaterial) {
                TareaMateriale::create([
                    'tarea_id' => $tarea->id,
                    'materiale_id' => $tareaMaterial['materiale_id'],
                    'tema' => $tareaMaterial['tema'],
                    'link' => isset($tareaMaterial['link'])  ? $tareaMaterial['link'] : '',
                ]);
            }

            $extractImages = '/src=["\']([^ ^"^\']*)["\']/ims';
            preg_match_all($extractImages, $this->descripcion, $matches);
            $images = $matches[1];

            foreach ($images as $img) {
                $url_image = 'images-tareas/' . pathinfo($img, PATHINFO_BASENAME);
                $tarea->images()->create([
                    'url' => $url_image
                ]);
            }
        }

        $this->reset(['addTarea', 'idTarea', 'fecha_inicio', 'fecha_final', 'noMaterial', 'tareaMateriales', 'deleteTareaMaterial']);
        // $this->render();

    }

    public function updatedAddTarea($value)
    {
        $this->descripcion = '';
        $this->emit('addtareadescripcion');
    }

    public function editTarea(Tarea $tarea)
    {
        if ($this->addTarea == false) {
            $this->emit('addtareadescripcion');
        }
        $this->idTarea = $tarea->id;
        $this->fecha_inicio = $tarea->fecha_inicio;
        $this->fecha_final = $tarea->fecha_final;
        $this->descripcion = $tarea->descripcion;
        $this->addTarea = true;
        $this->noMaterial = $tarea->tareaMateriales->count();
        $i = 0;
        foreach ($tarea->tareaMateriales as $tareaMaterial) {
            $this->tareaMateriales[$i] = [
                'id' => $tareaMaterial->id,
                'materiale_id' => $tareaMaterial->materiale_id,
                'tema' => $tareaMaterial->tema,
                'link' => $tareaMaterial->link,
            ];
            $i++;
        }
        $this->emit('edtTarea');
        // $this->tareaMateriales = $tarea->tareaMateriales;
    }

    public function removeTarea($idTarea, $confirmed = null)
    {
        if ($confirmed) {
            $deleted = InscripcioneTarea::where('tarea_id', $idTarea)->delete();
            $deleted = TareaMateriale::where('tarea_id', $idTarea)->delete();
            $deleted = Comentario::where('tarea_id', $idTarea)->delete();
            $tarea = Tarea::find($idTarea);
            $img_antiguas = $tarea->images()->pluck('url')->toArray();
            foreach ($img_antiguas as $img) {
                Storage::delete($img);
                $tarea->images()->where('url', $img)->delete();
            }
            $deleted = $tarea->delete();
            if ($deleted) {
                $this->render();
            }
        } else {
            $this->dispatchBrowserEvent('questionremove', ['idTarea' => $idTarea, 'msj' => 'Se eliminarán todas las dependencias, incluso todos los comentarios realizados por el personal. No se podrá recuperar esta información.']);
        }
    }

    public function render()
    {
        // $this->tareaMateriales = new TareaMateriale();
        $materiales = Materiale::where('estado', true)->get();
        $tareas = Tarea::where('programa_id', $this->programa->id)->orderBy('id', 'desc')->paginate(5);
        return view('livewire.admin.tarea-lista', compact('tareas', 'materiales'));
    }
}
