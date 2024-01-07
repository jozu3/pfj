<?php

namespace App\Http\Controllers\Admin;

use App\Models\Participante;
use App\Http\Controllers\Controller;
use App\Models\Alojamiento;
use App\Models\ParticipanteCompania;
use App\Models\Programa;
use Illuminate\Http\Request;

class ParticipanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participante  $participante
     * @return \Illuminate\Http\Response
     */
    public function show(Participante $participante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Participante  $participante
     * @return \Illuminate\Http\Response
     */
    public function edit(Participante $participante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Participante  $participante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participante $participante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participante  $participante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participante $participante)
    {
        //
    }

    public function deleteAll(Programa $programa){
        
        ParticipanteCompania::whereHas('participante', function($q) use ($programa){
            $q->where('programa_id', $programa->id);
        })->delete();
        Alojamiento::whereHas('participante', function($q) use ($programa){
            $q->where('programa_id', $programa->id);
        })->delete();
        Participante::where('programa_id', $programa->id)->delete();

        return redirect()->route('admin.programas.participantes', $programa)->with('info', 'Se eliminó a todos los participantes(compañias y alojamientos) de la sesión');
    }
}
