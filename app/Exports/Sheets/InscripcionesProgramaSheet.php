<?php

namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Contracts\View\View;
use App\Models\Grupo;
use App\Models\Asistencia;
use App\Models\Capacitacione;
use App\Models\Inscripcione;
use App\Models\Tarea;

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

        if ($this->rol != 0 && $this->rol != '') {
            $_roles = json_decode($this->rol);
            if(is_array($_roles) && count($_roles)){
                $inscripciones = $inscripciones->whereIn('role_id', $_roles);
            }
        }
        
        $inscripciones = $inscripciones->get();
        $capacitaciones = Capacitacione::where('programa_id', $this->programa)->where('tipo', '1')->get();
        $tareas = Tarea::where('programa_id', $this->programa)->get();

        return view('admin.exports.inscripcione-programa', compact('inscripciones', 'capacitaciones', 'tareas'));
    }

    public function title() : string{
        return 'Personal';
    }
}
