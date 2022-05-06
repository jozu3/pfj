<?php

namespace App\Observers;

use App\Models\Inscripcione;
use App\Models\Obligacione;

class InscripcioneObserver
{
    /**
     * Handle the Inscripcione "created" event.
     *
     * @param  \App\Models\Inscripcione  $inscripcione
     * @return void
     */
    public function creating(Inscripcione $inscripcione){
        if (! \App::runningInConsole()) {
            //$inscripcione->personal_id = auth()->user()->personal->id;
        }
    }

    public function created(Inscripcione $inscripcione)
    {
     

    }

    /**
     * Handle the Inscripcione "updated" event.
     *
     * @param  \App\Models\Inscripcione  $inscripcione
     * @return void
     */
    public function updated(Inscripcione $inscripcione)
    {

    }

    /**
     * Handle the Inscripcione "deleted" event.
     *
     * @param  \App\Models\Inscripcione  $inscripcione
     * @return void
     */
    public function deleted(Inscripcione $inscripcione)
    {
        //
    }

    /**
     * Handle the Inscripcione "restored" event.
     *
     * @param  \App\Models\Inscripcione  $inscripcione
     * @return void
     */
    public function restored(Inscripcione $inscripcione)
    {
        //
    }

    /**
     * Handle the Inscripcione "force deleted" event.
     *
     * @param  \App\Models\Inscripcione  $inscripcione
     * @return void
     */
    public function forceDeleted(Inscripcione $inscripcione)
    {
        //
    }
}
