<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class LocaleEdificios extends Component
{
    public $locale;
    
    public function render()
    {
        $edificios = $this->locale->edificios;

        return view('livewire.admin.locale-edificios', compact('edificios'));
    }
}
