<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        
        $programa_id =  session('programa_activo');
        return view('layouts.app', compact('programa_id'));
    }
}
