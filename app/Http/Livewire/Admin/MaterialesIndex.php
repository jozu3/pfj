<?php

namespace App\Http\Livewire\Admin;

use App\Models\Materiale;
use Livewire\Component;

class MaterialesIndex extends Component
{
    public $materiale;
    public $idMateriale;

    protected $rules = [
        'materiale' => 'required'
    ];

    public function saveMateriale()
    {
        $this->validate();
        if ($this->idMateriale)
        {
            $material = Materiale::where('id', $this->idMateriale)->first();
            $material->descripcion = $this->materiale;
        } else{
            $material = new Materiale([
                'descripcion' => $this->materiale,
                'estado' => true,
            ]);
        }        

        $material->save();
        $this->reset(['idMateriale', 'materiale']);
    }

    public function editMateriale(Materiale $materiale){
        $this->idMateriale = $materiale->id;
        $this->materiale = $materiale->descripcion;
    }

    public function removeMateriale($idMaterial){
        $deleted = Materiale::where('id', $idMaterial)->delete();
    }

    public function render()
    {
        $materiales = Materiale::all();
        return view('livewire.admin.materiales-index', compact('materiales'));
    }
}
