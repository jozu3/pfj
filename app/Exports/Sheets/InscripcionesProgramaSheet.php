<?php

namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Contracts\View\View;
use App\Models\Grupo;
use App\Models\Asistencia;
use App\Models\Inscripcione;

class InscripcionesProgramaSheet implements FromView, WithTitle
{

    private $programa, $familia, $estaca, $estado, $rol;

    public function __construct($programa, $familia, $estaca, $estado, $rol){
        $this->programa = $programa;
        $this->familia = $familia;
        $this->estaca = $estaca;
        $this->estado = $estado;
        $this->rol = $rol;
    }

    public function view():View{

        $inscripciones = Inscripcione::where('programa_id', $this->programa);

        //filtro por familia
        if($this->familia != 0){
            $familia = $this->familia;
            $inscripciones = $inscripciones->whereHas( 'inscripcioneCompanerismo', function($q) use ($familia) {
                $q->whereHas( 'companerismo', function($q) use ($familia) {
                    $q->where('grupo_id', $familia);
                });
            });
        }

        //filtro por estaca
        if($this->estaca != 0){
            $estaca = $this->estaca;
            $inscripciones = $inscripciones->whereHas('personale', function ($q) use ($estaca) {
                $q->whereHas('barrio', function($qu) use ($estaca){                
                    $qu->where('estaca_id', $estaca);
                });       
            });
        }

        //filtros por estado
        if($this->estado != '-1'){
            $estado = $this->estado;
            $inscripciones = $inscripciones->where('estado', $estado);
        }

        //filtros por rol
        if($this->rol != 0){
            $rol = $this->rol;
            $inscripciones = $inscripciones->where('role_id', $rol);
        }
        
        $inscripciones = $inscripciones->get();

        return view('admin.exports.inscripcione-programa', compact('inscripciones'));
    }

    public function title() : string{
        return 'Personal';
    }
}
