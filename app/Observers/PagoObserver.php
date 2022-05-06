<?php

namespace App\Observers;

use App\Models\Pago;

class PagoObserver
{
    public function creating(Pago $pago){
        if (! \App::runningInConsole()) {
            $pago->personal_id = auth()->user()->personal->id;
        }

        if ($pago->obligacione->estado == 3) {
            return false;
        }
    }
    /**
     * Handle the Pago "created" event.
     *
     * @param  \App\Models\Pago  $pago
     * @return void
     */
    public function created(Pago $pago)
    {
        $obligacione = $pago->obligacione;
        $monto_final = $obligacione->montofinal;
        $monto_pagado = $obligacione->montopagado + $pago->monto;

        //$estado = $obligacione->estado; 
        $fechapagadototal = null;

        if($monto_final > $monto_pagado && $monto_pagado == 0){
            $estado = 1;//por pagar
        }

        if($monto_final > $monto_pagado && $monto_pagado > 0){
            $estado = 2;//parcial
        }

        if($monto_final === $monto_pagado){
            $estado = 3;//completo
            $fechapagadototal = $pago->fechapago;
        }

        $obligacione->update([
            'estado' => $estado,
            'montopagado' => $monto_pagado,
            'fechapagadototal' => $fechapagadototal
        ]);



    }

    /**
     * Handle the Pago "updated" event.
     *
     * @param  \App\Models\Pago  $pago
     * @return void
     */
    public function updating(Pago $pago){
        //$pago['monto_pago_anterior'] = $pago->monto;
    }

    public function updated(Pago $pago)
    {
        $obligacione = $pago->obligacione;
        $monto_final = $obligacione->montofinal;
        $monto_pagado = Pago::where('obligacione_id', $pago->obligacione_id)->sum('monto');
        $fechapagadototal = null;
       
        if($monto_final > $monto_pagado && $monto_pagado == 0){
            $estado = 1;
        }

        if($monto_final > $monto_pagado && $monto_pagado > 0){
            $estado = 2;
        }

        if($monto_final == $monto_pagado){
            $estado = 3;
            $fechapagadototal = $pago->fechapago;
        }

        $obligacione->update([
            'estado' => $estado,
            'montopagado' => $monto_pagado,
            'fechapagadototal' => $fechapagadototal
        ]);
    }

    /**
     * Handle the Pago "deleted" event.
     *
     * @param  \App\Models\Pago  $pago
     * @return void
     */
    public function deleted(Pago $pago)
    {
        $obligacione = $pago->obligacione;
        $monto_final = $obligacione->montofinal;
        $monto_pagado = Pago::where('obligacione_id', $pago->obligacione_id)->sum('monto');
        $fechapagadototal = null;

        if($monto_final > $monto_pagado && $monto_pagado == 0){
            $estado = 1;
        }

        if($monto_final > $monto_pagado && $monto_pagado > 0){
            $estado = 2;
        }

        if($monto_final == $monto_pagado){
            $estado = 3;
            $fechapagadototal = $pago->fechapago;
        }

        $obligacione->update([
            'estado' => $estado,
            'montopagado' => $monto_pagado,
            'fechapagadototal' => $fechapagadototal
        ]);
    }

    /**
     * Handle the Pago "restored" event.
     *
     * @param  \App\Models\Pago  $pago
     * @return void
     */
    public function restored(Pago $pago)
    {
        //
    }

    /**
     * Handle the Pago "force deleted" event.
     *
     * @param  \App\Models\Pago  $pago
     * @return void
     */
    public function forceDeleted(Pago $pago)
    {
        //
    }
}
