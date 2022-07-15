<?php

namespace App\Http\Livewire\Admin;

use App\Models\Companerismo;
use App\Models\EdadRango;
use App\Models\Participante;
use App\Models\ParticipanteCompania;
use Livewire\Component;

class CompaniasPrograma extends Component
{
    public $programa;
    public $cantidad;
    public $datarango = [];
    public $paso1 = true;
    public $paso2 = false;
    public $paso3 = false;
    public $rangos;
    public $cPNA = 0;


    public $newRangos = [
        0 => [
            'edadmin' => null,
            'edadmax' => null,
        ]
    ];

    protected $rules = [
        'newRangos.*.edadmin' => 'required',
        'newRangos.*.edadmax' => 'required',
    ];

    public function añadirRango()
    {
        array_push($this->newRangos, []);
    }

    public function quitarNewRango($index = null)
    {
        if (!is_null($index)) {
            unset($this->newRangos[$index]);
        }
    }

    public function crearCompanias()
    {

        $this->validate();
        $cantCompanias =  count($this->programa->companias());
        $result = false;

        EdadRango::where('programa_id', $this->programa->id)->delete();

        foreach ($this->newRangos as $rango) {
            $result = false;

            $participantes = $this->programa->participantes->where('estado', 0)->where('age_2022', '>=', $rango['edadmin'])->where('age_2022', '<=', $rango['edadmax']);
            $razon = count($this->programa->participantes->where('estado', 0)) / count($participantes);
            $cantComp = round($cantCompanias * count($participantes) / count($this->programa->participantes->where('estado', 0)), 0);

            EdadRango::create([
                'edadmin' => $rango['edadmin'],
                'edadmax' => $rango['edadmax'],
                'razon' => $razon,
                'cantcompanias' => $cantComp,
                'cantparticipantes' => count($participantes),
                'programa_id' => $this->programa->id
            ]);

            $result = true;
        }

        if ($result) {

            $this->paso1 = false;
            $this->paso2 = true;
        }
    }

    public function asginarCompaniasRangos()
    {
        $result = false;
        $rango_companias = array_keys($this->rangos);
        
        foreach ($rango_companias as $rango_compania) {
            $result = false;
            dd($rango_compania);

            $rango = explode("-", $rango_compania)[0];
            $comp = explode("-", $rango_compania)[1];

            $r = EdadRango::find($rango);


            Companerismo::find($comp)->update([
                'edadmin' => $r->edadmin,
                'edadmax' => $r->edadmax
            ]);

            $result = true;
        }

        if ($result) {
            $this->paso2 = false;
            $this->paso3 = true;
        }
    }

    public function finalizar()
    {

        //finalizar
        $rangos = $this->programa->edadRangos;

        foreach ($rangos as $rango) {

            // $companias = Companerismo::where('edadmin', $rango->edadmin)
            //     ->where('edadmax', $rango->edadmax)
            //     ->whereHas('grupo', function ($q){
            //         $q->where('programa_id', $this->programa->id);
            //     })
            //     ->get();
            // dd($rango);

            $companias = $this->programa->companias()->where('edadmin', $rango->edadmin)->where('edadmax', $rango->edadmax);


            foreach ($companias as $compania) {
                //hombres
                $participantes = $this->programa->participantes->where('genero', '1')->where('estado', '0')->where('age_2022', '>=', $rango->edadmin)->where('age_2022', '<=', $rango->edadmax);

                
                $cantidadParticipanteNoAsignados = count($participantes);
                
                $pna = Participante::where('programa_id', $this->programa->id)->where('genero', '1')->where('estado', '0')->where('age_2022', '>=', $rango->edadmin)->where('age_2022', '<=', $rango->edadmax);
                // dd($pna->doesntHave('participanteCompania')->get()->count());
                while ($cantidadParticipanteNoAsignados > 0) {

                    $p = $pna->doesntHave('participanteCompania')->get()->random();
                    
                    ParticipanteCompania::create([
                        'participante_id' => $p->id,
                        'companerismo_id' => $compania->id,
                    ]);
                    
                    $cant = $pna->doesntHave('participanteCompania')->get()->count();
                    $cantidadParticipanteNoAsignados = $cant;

                    $this->cPNA = $cantidadParticipanteNoAsignados;

                    $this->emit('comp', $cantidadParticipanteNoAsignados);

                }


                //mujeres



            }
        }
    }


    public function render()
    {
        $this->cantidad = count($this->programa->companias());

        if ($this->programa->edadRangos) {
            # code...
        } 

        return view('livewire.admin.companias-programa');
    }
}
