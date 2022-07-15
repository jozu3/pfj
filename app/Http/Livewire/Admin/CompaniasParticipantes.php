<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class CompaniasParticipantes extends Component
{
    public $compania;
    
    public function render()
    {
        return view('livewire.admin.companias-participantes');
    }
}
