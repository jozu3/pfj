<?php

namespace App\Http\Controllers\Admin;

use App\Models\ParticipanteCompania;
use App\Http\Controllers\Controller;
use App\Models\Participante;
use App\Models\Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParticipanteCompaniaController extends Controller
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
        $participantes = Participante::select('id', DB::raw('concat(nombres, " ", apellidos) as nombre_completo'))->where('programa_id', session('programa_activo'))->orderBy('nombre_completo')->get()->pluck('nombre_completo', 'id');
        
        $companerismos = Programa::where('id', session('programa_activo'))->first()->companias()->pluck('numero', 'id');

        return view('admin.participanteCompanias.create', compact('participantes', 'companerismos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'participante_id' => 'required',
            'companerismo_id' => 'required',
        ]);

        ParticipanteCompania::where('participante_id', $request->participante_id)->delete();

        ParticipanteCompania::create($request->all());

        return redirect()->route('admin.programas.companias', session('programa_activo'))->with('info', 'Se asigno correctamente al participante.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParticipanteCompania  $participanteCompania
     * @return \Illuminate\Http\Response
     */
    public function show(ParticipanteCompania $participanteCompania)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ParticipanteCompania  $participanteCompania
     * @return \Illuminate\Http\Response
     */
    public function edit(ParticipanteCompania $participanteCompania)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ParticipanteCompania  $participanteCompania
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParticipanteCompania $participanteCompania)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParticipanteCompania  $participanteCompania
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParticipanteCompania $participanteCompania)
    {
        //
    }
}
