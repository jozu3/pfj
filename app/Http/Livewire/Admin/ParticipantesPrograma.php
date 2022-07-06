<?php

namespace App\Http\Livewire\Admin;

use App\Models\Companerismo;
use App\Models\Estaca;
use App\Models\Participante;
use Livewire\Component;
use Livewire\WithPagination;

class ParticipantesPrograma extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
	
    public $programa_id;
    public $search;
    public $compania= 0;
    public $estaca = 0;
    public $estado = 0;

    public function loadParticipantes(){
        
    }

    public function render()
    {
        $that = $this;
        $estacas = Estaca::all();

        //filtros
        $estaca = $this->estaca;

        $participantes = Participante::where('programa_id', $this->programa_id)
                                    ->where('nombres','like', '%'. $this->search .'%')
                                    ->whereHas('barrio', function($qu) use ($estaca){
                                        //filtro estaca
                                        if($estaca != '' && $estaca != '0'){
                                            $qu->where('estaca_id', $estaca);
                                        }
                                    });



        //filtro por estado
        if($this->estado != '-1'){
            $participantes = $participantes->where('estado', $this->estado);
        }

        $participantes = $participantes->paginate();


        $this->page = 1;

        $companerismos = Companerismo::where('role_id', '6')->whereHas('grupo', function ($q) use ($that) {
            $q->where('programa_id', $that->programa_id );
        })->get();

        return view('livewire.admin.participantes-programa', compact('estacas', 'companerismos', 'participantes'));
    }
}
