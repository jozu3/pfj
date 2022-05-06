<?php

namespace App\Http\Livewire\Admin;

use App\Models\Anuncio;
use App\Models\Programa;
use Livewire\Component;

class AnunciosIndex extends Component
{
    public $anuncios;
    public $programa_id;

    public function render()
    {
        $this->anuncios = Anuncio::where('programa_id', $this->programa_id)->get();
        $programa = Programa::find($this->programa_id);

        return view('livewire.admin.anuncios-index', compact('programa'));
    }
}
