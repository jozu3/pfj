<?php

namespace App\Http\Livewire\Admin;

use App\Models\Barrio;
use App\Models\BarrioInfo;
use App\Models\Companerismo;
use App\Models\Estaca;
use App\Models\EstadoAprobacione;
use App\Models\Participante;
use Livewire\Component;
use Livewire\WithPagination;

class ParticipantesPrograma extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $programa_id;
    public $search;
    public $compania = 0;
    public $estaca = 0;
    public $barrio = 0;
    public $estado = -1;
    public $barriosEstaca = [];
    public $estado_aprobaciones;
    public $estado_aprobacion = 'Todos';

    public function loadParticipantes()
    {
    }

    protected $listeners = ['changeEstadoParticipante'];

    public function changeEstadoParticipante($idparticipante, $value)
    {
        if ($value == 0) {
            $user = auth()->user();
            $barrioinfo = '';
            if ($user->can('admin.programas.participantes')) {
                $inscritos = Participante::where('programa_id', $this->programa_id)->where('estado', '0')->count();
                $miscupos = Participante::where('programa_id', $this->programa_id)->where('estado_aprobacion', '1')->count() ;
            } else if ($user->can('admin.programas.participantes_barrio')) {
                $inscritos = Participante::where('programa_id', $this->programa_id)->where('barrio_id', $this->barrio)->where('estado', '0')->count();
                $barrioinfo = BarrioInfo::where('barrio_id', $this->barrio)->where('programa_id', $this->programa_id)->first();
                if ($barrioinfo) {
                    $miscupos = $barrioinfo->cupos;
                } 
            }
            // dd($inscritos);

            if ($inscritos < $miscupos) {
                Participante::find($idparticipante)->update([
                    'estado' => $value
                ]);
                $this->emit('alert', true);
            } else {

                $this->emit('alert', false);
                $estado = Participante::find($idparticipante)->estado;
                $this->emit('backState', $estado);
            }
        } else {

            Participante::find($idparticipante)->update([
                'estado' => $value
            ]);
            $this->emit('alert', true);
        }
    }

    public function mount()
    {
        $this->estado_aprobaciones = EstadoAprobacione::where('estado', '1')->get();
    }

    public function render()
    {
        $this->emit('readyto');
        $that = $this;
        $estacas = Estaca::all();

        //filtros
        $estaca = $this->estaca;

        $this->barriosEstaca = Barrio::where('estaca_id', $estaca)->get();

        $participantes = Participante::where('programa_id', $this->programa_id)
            ->where(function ($q) {
                $q->where('apellidos', 'like', '%' . $this->search . '%')
                    ->orWhere('nombres', 'like', '%' . $this->search . '%')
                    ->orWhere('documento', 'like', '%' . $this->search . '%');
            })
            ->where(function ($q) use ($that) {
                if ($that->estado_aprobacion != 'Todos') {
                    $q->where('estado_aprobacion', $that->estado_aprobacion);
                }
            })
            ->whereHas('barrio', function ($qu) use ($estaca) {
                //filtro estaca
                if ($estaca != '' && $estaca != '0') {
                    $qu->where('estaca_id', $estaca);
                }
            });

        $user = auth()->user();
        $miscupos = 0;
        $inscritos = 0;
        $noinscritos = 0;
        if ($user->can('admin.programas.participantes')) {
            $allParticipantes = Participante::where('programa_id', $this->programa_id)->get();
            $miscupos = Participante::where('programa_id', $this->programa_id)->where('estado_aprobacion', 1)->get()->count();
        } else if ($user->can('admin.programas.participantes_barrio')) {
            $barrio_obispo = $user->personale->contacto->barrio_id;
            // dd($barrio_obispo);
            $this->barrio = $barrio_obispo;
            $allParticipantes = Participante::where('programa_id', $this->programa_id)->where('barrio_id', $this->barrio)->get();
            $barrioinfo = BarrioInfo::where('barrio_id', $this->barrio)->where('programa_id', $this->programa_id)->first();
            if ($barrioinfo) {
                $miscupos = $barrioinfo->cupos;
            }
        }
        $inscritos = $allParticipantes->where('estado', 0)->count();
        $noinscritos = $allParticipantes->where('estado', -1)->count();
        $permutados = $allParticipantes->where('estado', 2)->count();

        //filtro por barrio
        if ($this->barrio != '' && $this->barrio != '0') {
            $participantes = $participantes->where('barrio_id', $this->barrio);
        }


        //filtro por compañia
        if ($this->compania != '' && $this->compania != '0') {
            $participantes = $participantes->whereHas('participanteCompania', function ($q) {
                $q->where('companerismo_id', $this->compania);
            });
        }

        //filtro por estado
        if ($this->estado != '-1') {
            $participantes = $participantes->where('estado', $this->estado);
        }

        $participantes = $participantes->paginate(30);


        $this->page = 1;

        $companerismos = Companerismo::where('role_id', '6')->whereHas('grupo', function ($q) use ($that) {
            $q->where('programa_id', $that->programa_id);
        })->get();

        $info_cupos = BarrioInfo::whereHas('barrio', function ($q) use ($that) {
            $q->whereHas('estaca', function ($qu) use ($that) {
                $qu->whereHas('estacaInscripciones', function ($que) use ($that) {
                    $que->where('programa_id', $that->programa_id);
                });
            });
        })->get()->sum('cupos');

        // dd($info_cupos);

        return view('livewire.admin.participantes-programa', compact('estacas', 'companerismos', 'participantes', 'allParticipantes', 'info_cupos', 'miscupos', 'inscritos', 'noinscritos', 'permutados'));
    }
}
