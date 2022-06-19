<?php

namespace App\Exports;

use App\Exports\Sheets\InscripcionesProgramaSheet;
use App\Models\Inscripcione;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class InscripcionesExport implements WithMultipleSheets
{
    use Exportable;

    private $programa, $familia, $estaca, $estado, $rol;
    
    public function programa($programa, $familia, $estaca, $estado, $rol){
        $this->programa = $programa;
        $this->familia = $familia;
        $this->estaca = $estaca;
        $this->estado = $estado;
        $this->rol = $rol;

        return $this;
    }

    public function sheets(): array{
        $sheets = [];

        $sheets[] = new InscripcionesProgramaSheet($this->programa, $this->familia, $this->estaca, $this->estado, $this->rol);

        return $sheets;
    }
}
