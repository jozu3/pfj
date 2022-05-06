<?php

namespace App\Observers;

use App\Models\Unidad;
use App\Models\Clase;

class UnidadObserver
{
    /**
     * Handle the Unidad "created" event.
     *
     * @param  \App\Models\Unidad  $unidad
     * @return void
     */
    public function created(Unidad $unidad)
    {
       /* for ($i = 0; $i < $unidad->cantidad_clases; $i++) {

            $days = 7*$i;

            Clase::create([
                'unidad_id' => $unidad->id,
                'fechaclase' => date('Y-m-d', strtotime( '+'.$days.'day', strtotime($unidad->fechainicio))),
                'estado' => 0
            ]);            
        }*/
    }

    /**
     * Handle the Unidad "updated" event.
     *
     * @param  \App\Models\Unidad  $unidad
     * @return void
     */
    public function updated(Unidad $unidad)
    {
        //
    }

    /**
     * Handle the Unidad "deleted" event.
     *
     * @param  \App\Models\Unidad  $unidad
     * @return void
     */
    public function deleted(Unidad $unidad)
    {
        //
    }

    /**
     * Handle the Unidad "restored" event.
     *
     * @param  \App\Models\Unidad  $unidad
     * @return void
     */
    public function restored(Unidad $unidad)
    {
        //
    }

    /**
     * Handle the Unidad "force deleted" event.
     *
     * @param  \App\Models\Unidad  $unidad
     * @return void
     */
    public function forceDeleted(Unidad $unidad)
    {
        //
    }
}
