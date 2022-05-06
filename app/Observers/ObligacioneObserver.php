<?php

namespace App\Observers;

use App\Models\Obligacione;

class ObligacioneObserver
{
    /**
     * Handle the Obligacione "created" event.
     *
     * @param  \App\Models\Obligacione  $obligacione
     * @return void
     */
    public function created(Obligacione $obligacione)
    {
        //
    }

    /**
     * Handle the Obligacione "updated" event.
     *
     * @param  \App\Models\Obligacione  $obligacione
     * @return void
     */
    public function updating(Obligacione $obligacione)
    {
        $obligacione->montofinal = $obligacione->monto - $obligacione->descuento;
    }

    /**
     * Handle the Obligacione "deleted" event.
     *
     * @param  \App\Models\Obligacione  $obligacione
     * @return void
     */
    public function deleted(Obligacione $obligacione)
    {
        //
    }

    /**
     * Handle the Obligacione "restored" event.
     *
     * @param  \App\Models\Obligacione  $obligacione
     * @return void
     */
    public function restored(Obligacione $obligacione)
    {
        //
    }

    /**
     * Handle the Obligacione "force deleted" event.
     *
     * @param  \App\Models\Obligacione  $obligacione
     * @return void
     */
    public function forceDeleted(Obligacione $obligacione)
    {
        //
    }
}
