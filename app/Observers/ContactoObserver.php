<?php

namespace App\Observers;

use App\Models\Contacto;

class ContactoObserver
{
    /**
     * Handle the Contacto "created" event.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return void
     */
    public function creating(Contacto $contacto)
    {
        if (! \App::runningInConsole()) {
            if (!auth()->user()->can('admin.contactos.asignarVendedor')) {
              //  $contacto->personal_id = auth()->user()->personal->id;
            }   
        }
    }

    /**
     * Handle the Contacto "updated" event.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return void
     */
    public function updating(Contacto $contacto)
    {
        
    }

    /**
     * Handle the Contacto "deleted" event.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return void
     */
    public function deleted(Contacto $contacto)
    {
        //
    }

    /**
     * Handle the Contacto "restored" event.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return void
     */
    public function restored(Contacto $contacto)
    {
        //
    }

    /**
     * Handle the Contacto "force deleted" event.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return void
     */
    public function forceDeleted(Contacto $contacto)
    {
        //
    }
}
