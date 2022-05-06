<?php

namespace App\Exports;

use App\Models\Personale;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Sheets\AsistenciasGrupoSheet;
use App\Exports\Sheets\NotasGrupoSheet;

class PersonalesExport implements WithMultipleSheets
{
    use Exportable;

    private $grupo;

    public function forGroup($grupo){
        $this->grupo = $grupo;

        return $this;
    }

    public function sheets(): array{
        $sheets = [];

        $sheets[] = new AsistenciasGrupoSheet($this->grupo);
        $sheets[] = new NotasGrupoSheet($this->grupo);

        return $sheets;
    }
}
