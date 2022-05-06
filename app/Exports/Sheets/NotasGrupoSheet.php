<?php

namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Grupo;

class NotasGrupoSheet implements FromView, WithTitle
{
    private $grupo;

    public function __construct($grupo){
        $this->grupo = $grupo;
    }
    
    public function view():View{
        return view('admin.grupos.partials.register-notas', [
            'grupo' => Grupo::find($this->grupo),
            'is_report' => true
        ]);
    }

    public function title() : string{
        return 'Notas';
    }
}
