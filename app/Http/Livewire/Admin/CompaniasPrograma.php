<?php

namespace App\Http\Livewire\Admin;

use App\Models\Companerismo;
use App\Models\EdadRango;
use App\Models\Participante;
use App\Models\ParticipanteCompania;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\Offset;
use Swift;

class CompaniasPrograma extends Component
{
    public $programa;
    public $cantidad;
    public $companias;
    public $rangosPrograma = [];
    public $paso1 = true;
    public $paso2 = false;
    public $paso3 = false;
    public $rangos;

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

    public function updatedRangos(){
        foreach ($this->rangos as $rango) {
            if (isset($rango['compania'])) {

                // unset($this->rangos[$r->id.'-'.$comp]);
            }

        }
    }
    public function limpiarRangoCompania($rango, $comp){

        $ran = EdadRango::where('programa_id', $this->programa->id)->get();
        foreach ($ran as $r) {
            if ($r->id != $rango) {
                unset($this->rangos[$r->id.'-'.$comp]);
            }
            
        }
        
        if ($this->rangos[$rango.'-'.$comp]['compania'] == false) {
            unset($this->rangos[$rango.'-'.$comp]);
        }


    }
    // public function cantidadCompaniasSelectbyRango($rango){
    //     $cant = 0;
    //     foreach ($this->programa->companias() as $compania) {
    //         if(array_key_exists($rango. '-'.$compania->id, $this->rangos)){
    //             $cant++;
    //         }
    //     }

    //     return $cant;

    // }

    public function crearCompanias()
    {
        //paso 1
        $this->validate();
        $cantCompanias =  count($this->programa->companias());
        $result = false;

        EdadRango::where('programa_id', $this->programa->id)->delete();

        foreach ($this->newRangos as $rango) {
            $result = false;

            $participantes = $this->programa->participantes->where('estado', 0)->where('age_2022', '>=', $rango['edadmin'])->where('age_2022', '<=', $rango['edadmax']);
            if(count($participantes) != 0){

                $razon = count($participantes)/count($this->programa->participantes->where('estado', 0));
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
            } else {
                $this->addError('rangoParticipantes', 'Uno de los rangos no tiene participantes');
            }
        }

        $totalcreadas = EdadRango::select(DB::raw('sum(cantcompanias) as total'))->where('programa_id', $this->programa->id)->groupBy('programa_id')->first()->total;

        if($cantCompanias != $totalcreadas){
            $sobra = $cantCompanias - $totalcreadas;
            // dd($sobra);
            $mayor = 0;
            $rangoMayor = 0;
            $rangosCreados = EdadRango::where('programa_id', $this->programa->id)->get();

            foreach ($rangosCreados as $rango) {
                $participantes = $this->programa->participantes->where('estado', 0)->where('age_2022', '>=', $rango->edadmin)->where('age_2022', '<=', $rango->edadmax);

                $cantcomp_ = ($cantCompanias * count($participantes) )/count($this->programa->participantes->where('estado', 0));
                $roundcantComp = round($cantcomp_);
                $residuo = $cantcomp_ - $roundcantComp;

                if($mayor < $residuo){
                    $mayor = $residuo;
                    $rangoMayor = $rango;
                }

            }

            // dd($rangoMayor.'+'.$mayor);

            $rangoMayor->update([
                'cantcompanias' => $rangoMayor->cantcompanias + $sobra
            ]);

        }

        if ($result) {
            $this->rangos = null;
            $this->paso1 = false;
            $this->paso2 = true;
            $this->companias = $this->programa->companias();
            $this->rangosPrograma = EdadRango::where('programa_id', $this->programa->id)->get();
        }
    }

    public function asginarCompaniasRangos()
    {
        $result = false;
        
        Companerismo::whereHas('grupo', function($q){
            $q->where('programa_id', $this->programa->id);
        })->update([
            'edadmin' => null,
            'edadmax' => null
        ]);

        $rango_companias = array_keys($this->rangos);

        foreach ($rango_companias as $rango_compania) {
            $result = false;

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
            $this->paso1 = false;
            $this->paso2 = false;
            $this->paso3 = true;
        }
    }

    public function finalizar()
    {

        ParticipanteCompania::whereHas('participante', function($q){
            $q->where('programa_id', $this->programa->id);
        })->delete();

        $result = false;
        //finalizar
        $rangos = EdadRango::where('programa_id', $this->programa->id)->get();
        foreach ($rangos as $rango) {
            $result = false;
            
            $companias = Companerismo::whereHas('grupo', function($q){
                $q->where('programa_id', $this->programa->id);
            })->where('edadmin', $rango->edadmin)->where('edadmax', $rango->edadmax)->get();
            
            
            //hombres
            $this->asignar(1, $rango, $companias);
            
            //mujeres
            $this->asignar(0, $rango, $companias);
            // dd($compania);
            $result = true;
            
        }

        if ($result) {
            $this->loadingAsign = false;
            $this->emit('offmodalloading');
        }

    }
    
    public function asignar($genero, $rango, $companias)
    {
        $participantes = $this->programa->participantes->where('genero', $genero)->where('estado', '0')->where('age_2022', '>=', $rango->edadmin)->where('age_2022', '<=', $rango->edadmax);
        
        
        $cantidadParticipanteNoAsignados = count($participantes);
        
        $pna = Participante::where('programa_id', $this->programa->id)->where('genero', $genero )->where('estado', '0')->where('age_2022', '>=', $rango->edadmin)->where('age_2022', '<=', $rango->edadmax);
        // dd($pna->doesntHave('participanteCompania')->get()->count());

        $cantcompanias = count($companias);
        $iComp = 0;


        while ($cantidadParticipanteNoAsignados > 0) {
            
            if (count($pna->doesntHave('participanteCompania')->get()) == 0) {
                break;
            }
            $p = $pna->doesntHave('participanteCompania')->get()->random();

            ParticipanteCompania::create([
                'participante_id' => $p->id,
                'companerismo_id' => $companias[$iComp]->id,
            ]);

            $cant = $pna->doesntHave('participanteCompania')->get()->count();
            $cantidadParticipanteNoAsignados = $cant;

            $iComp++;
            if($iComp == $cantcompanias){
                $iComp = 0;
            }
            $this->emit('comp', $cantidadParticipanteNoAsignados);
        }
    }

    public function volverPaso(){
       if ($this->paso2 === true) {
        $this->paso1 = true;
        $this->paso2 = false;
        $this->paso3 = false;
       } else {
           if ($this->paso3 === true) {
               $this->paso1 = false;
               $this->paso2 = true;
               $this->paso3 = false;
           }

       }
           
    }

    public function render()
    {
        $this->cantidad = count($this->programa->companias());

        return view('livewire.admin.companias-programa');
    }
}
