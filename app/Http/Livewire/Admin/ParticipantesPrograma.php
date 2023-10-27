<?php

namespace App\Http\Livewire\Admin;

use App\Models\Barrio;
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
    public $barrio = 0;
    public $estado = -1;
    public $barriosEstaca = [];

    public function loadParticipantes(){
        
    }

    public function render()
    {
        $that = $this;
        $estacas = Estaca::all();

        //filtros
        $estaca = $this->estaca;

        $this->barriosEstaca = Barrio::where('estaca_id', $estaca)->get();

        $participantes = Participante::where('programa_id', $this->programa_id)
                                    ->where(function ($q){
                                        $q->where('apellidos','like', '%'. $this->search .'%')
                                        ->orWhere('nombres','like', '%'. $this->search .'%')
                                        ->orWhere('documento', 'like', '%'. $this->search .'%');
                                    })
                                    ->whereHas('barrio', function($qu) use ($estaca){
                                        //filtro estaca
                                        if($estaca != '' && $estaca != '0'){
                                            $qu->where('estaca_id', $estaca);
                                        }
                                    });

        $user = auth()->user();
        if($user->can('admin.programas.participantes')){

        } else if($user->can('admin.programas.participantes_barrio')){
            $barrio_obispo = $user->personale->contacto->barrio_id;
            // dd($barrio_obispo);
            $this->barrio = $barrio_obispo;
        }

        //filtro por barrio
        if ($this->barrio != '' && $this->barrio != '0') {
            $participantes = $participantes->where('barrio_id', $this->barrio);
        }


        //filtro por compañia
        if($this->compania != '' && $this->compania != '0'){
            $participantes = $participantes->whereHas('participanteCompania', function($q){
                $q->where('companerismo_id', $this->compania);
            });
        }

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
