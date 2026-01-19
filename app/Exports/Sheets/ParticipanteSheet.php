<?php

namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Grupo;
use App\Models\Participante;

class ParticipanteSheet implements FromView, WithTitle
{
    private $grupo;
    private $programa;

    public function __construct($programa){
        $this->programa = $programa;
    }
    
    public function view():View{
               
        $participantes = Participante::where('programa_id', $this->programa)->get();

        return view('admin.exports.participantes', compact('participantes'));
    }

    public function title() : string{
        return 'Participantes';
    }
}
