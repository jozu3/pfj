<?php

namespace App\Http\Livewire\Admin\Programa;

use App\Models\ConsejoCoordinacione;
use App\Models\Estaca;
use App\Models\EstacaInscripcione;
use App\Models\Programa;
use JeroenNoten\LaravelAdminLte\View\Components\Form\Select;
use Livewire\Component;

class UnidadesLocales extends Component
{
    public $estacas;
    public $ccrdnes;
    public $estacasselecteds = [] ;
    public $programa;

    public function mount(){
        $this->estacas = Estaca::all();
        $this->ccrdnes = ConsejoCoordinacione::all();
        $programa =  Programa::find($this->programa->id);
        $selects = $programa->estacaInscripciones->pluck('estaca_id')->toArray();
        foreach ($selects as $key => $value) {
            $this->estacasselecteds[$value] = $value; 
        }

    }

    public function guardar(){
        EstacaInscripcione::where('programa_id', $this->programa->id)->delete();
        foreach ($this->estacasselecteds as $id) {
            if($id != 0){
                EstacaInscripcione::create(['programa_id' => $this->programa->id, 'estaca_id' => $id]);
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.programa.unidades-locales');
    }
}
