<?php

namespace App\Exports;

use App\Exports\Sheets\ParticipanteSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ParticipantesExport implements WithMultipleSheets
{

    use Exportable;

    private $programa;
    
    public function programa($programa){
        $this->programa = $programa;

        return $this;
    }
    public function sheets(): array{
        $sheets = [];

        $sheets[] = new ParticipanteSheet($this->programa);

        return $sheets;
    }
}
