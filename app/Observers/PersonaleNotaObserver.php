<?php

namespace App\Observers;

use App\Models\Personale_nota;

class PersonaleNotaObserver
{
    /**
     * Handle the Personale_nota "created" event.
     *
     * @param  \App\Models\Personale_nota  $personale_nota
     * @return void
     */
    public function created(Personale_nota $personale_nota)
    {
        $nota = 0;
        $notabaja = 20;
        $notarecuperatoria = 0;

        foreach ($personale_nota->personaleUnidade->personaleNotas as $alnot){
            if ($alnot->valor < $notabaja) {
                $notabaja = $alnot->valor;
            }

            if ($alnot->nota->tipo == 1) { //nota recuperatoria
                $notarecuperatoria = $alnot->valor;
            }

            $nota += $alnot->valor*$alnot->nota->valor;
        }

        if ($notarecuperatoria != 0) {
            $nota = $notarecuperatoria;
        }

        $personale_nota->personaleUnidade->update([
            'nota' => $nota
        ]);
    }

    /**
     * Handle the Personale_nota "updated" event.
     *
     * @param  \App\Models\Personale_nota  $personale_nota
     * @return void
     */
    public function updated(Personale_nota $personale_nota)
    {
        $nota = 0;
        $notabaja = 20;
        $notarecuperatoria = 0;

        foreach ($personale_nota->personaleUnidade->personaleNotas as $alnot){
            if ($alnot->valor < $notabaja) {
                $notabaja = $alnot->valor;
            }

            if ($alnot->nota->tipo == 1) { //nota recuperatoria
                $notarecuperatoria = $alnot->valor;
            }

            $nota += $alnot->valor*$alnot->nota->valor;
        }

        if ($notarecuperatoria != 0) {
            $nota = $notarecuperatoria;
        }

        $personale_nota->personaleUnidade->update([
            'nota' => $nota
        ]);
    }

    /**
     * Handle the Personale_nota "deleted" event.
     *
     * @param  \App\Models\Personale_nota  $personale_nota
     * @return void
     */
    public function deleted(Personale_nota $personale_nota)
    {
        //
    }

    /**
     * Handle the Personale_nota "restored" event.
     *
     * @param  \App\Models\Personale_nota  $personale_nota
     * @return void
     */
    public function restored(Personale_nota $personale_nota)
    {
        //
    }

    /**
     * Handle the Personale_nota "force deleted" event.
     *
     * @param  \App\Models\Personale_nota  $personale_nota
     * @return void
     */
    public function forceDeleted(Personale_nota $personale_nota)
    {
        //
    }
}
