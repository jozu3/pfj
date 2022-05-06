<?php

namespace App\Observers;

use App\Models\Personale;

class PersonaleObserver
{
    /**
     * Handle the Personale "created" event.
     *
     * @param  \App\Models\Personale  $personal
     * @return void
     */
    public function created(Personale $personal)
    {
        if (isset($personal->user)){
            
        }
    }

    /**
     * Handle the Personale "updated" event.
     *
     * @param  \App\Models\Personale  $personal
     * @return void
     */
    public function updated(Personale $personal)
    {
        if (isset($personal->user)){
           
        }
    }

    /**
     * Handle the Personale "deleted" event.
     *
     * @param  \App\Models\Personale  $personal
     * @return void
     */
    public function deleted(Personale $personal)
    {
        //
    }

    /**
     * Handle the Personale "restored" event.
     *
     * @param  \App\Models\Personale  $personal
     * @return void
     */
    public function restored(Personale $personal)
    {
        //
    }

    /**
     * Handle the Personale "force deleted" event.
     *
     * @param  \App\Models\Personale  $personal
     * @return void
     */
    public function forceDeleted(Personale $personal)
    {
        //
    }
}
