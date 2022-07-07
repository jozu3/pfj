<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Locale;

class LocalesIndex extends Component
{
    public $search;

    public function render()
    {
        $locales = Locale::all();
        return view('livewire.admin.locales-index', compact('locales'));
    }
}
