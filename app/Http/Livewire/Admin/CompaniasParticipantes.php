<?php

namespace App\Http\Livewire\Admin;

use App\Models\Companerismo;
use App\Models\Estaca;
use App\Models\Participante;
use Livewire\Component;
use Livewire\WithPagination;

class CompaniasParticipantes extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
	
    public $companerismo;
    public $search;
    public $compania= 0;
    public $estaca = 0;
    public $estado = 0;

    protected $listeners = ['render'];

    public function loadParticipantes(){
        
    }

    public function render()
    {
        $that = $this;
        $estacas = Estaca::all();

        //filtros
        $estaca = $this->estaca;

        $participantes = Participante::where('nombres','like', '%'. $this->search .'%')
                                    ->whereHas('barrio', function($qu) use ($estaca){
                                        //filtro estaca
                                        if($estaca != '' && $estaca != '0'){
                                            $qu->where('estaca_id', $estaca);
                                        }
                                    })
                                    ->whereHas('participanteCompania', function ($q) use ($that){
                                        $q->where('companerismo_id', $that->companerismo->id);
                                    });



        //filtro por estado
        if($this->estado != '-1'){
            $participantes = $participantes->where('estado', $this->estado);
        }

        $participantes = $participantes->paginate(50);


        $this->page = 1;


        return view('livewire.admin.companias-participantes', compact('participantes', 'estacas'));
    }
}
