<?php

namespace App\Observers;

use App\Models\Seguimiento;

class SeguimientoObserver
{
    /**
     * Handle the Seguimiento "created" event.
     *
     * @param  \App\Models\Seguimiento  $seguimiento
     * @return void
     */
    public function created(Seguimiento $seguimiento)
    {
        if(! \App::runningInConsole() && $seguimiento->contacto->newassign == 1 && $seguimiento->contacto->personal_id == auth()->user()->personal->id){
            $seguimiento->contacto->update([
                'newassign' => 0,
            ]);
        }
    }

    /**
     * Handle the Seguimiento "updated" event.
     *
     * @param  \App\Models\Seguimiento  $seguimiento
     * @return void
     */
    public function updated(Seguimiento $seguimiento)
    {
        //
    }

    /**
     * Handle the Seguimiento "deleted" event.
     *
     * @param  \App\Models\Seguimiento  $seguimiento
     * @return void
     */
    public function deleted(Seguimiento $seguimiento)
    {
        //
    }

    /**
     * Handle the Seguimiento "restored" event.
     *
     * @param  \App\Models\Seguimiento  $seguimiento
     * @return void
     */
    public function restored(Seguimiento $seguimiento)
    {
        //
    }

    /**
     * Handle the Seguimiento "force deleted" event.
     *
     * @param  \App\Models\Seguimiento  $seguimiento
     * @return void
     */
    public function forceDeleted(Seguimiento $seguimiento)
    {
        //
    }
}
