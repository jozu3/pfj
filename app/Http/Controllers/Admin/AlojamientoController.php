<?php

namespace App\Http\Controllers\Admin;

use App\Models\Alojamiento;
use App\Http\Controllers\Controller;
use App\Models\Habitacione;
use App\Models\Participante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlojamientoController extends Controller
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

        $habitaciones = Habitacione::select('habitaciones.id as habitacion', DB::raw('concat(locales.nombre , " - " , edificios.nombre, " - Piso: " , num, " - ", habitaciones.numero) as nivel'))
                            ->join('pisos', 'habitaciones.piso_id', '=', 'pisos.id')
                            ->join('edificios', 'pisos.edificio_id', '=', 'edificios.id')
                            ->join('locales', 'edificios.locale_id', '=', 'locales.id')
                            ->pluck('nivel', 'habitacion');

        return view('admin.alojamientos.create', compact('participantes', 'habitaciones'));
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
            'habitacione_id' => 'required',
        ]);

        Alojamiento::where('participante_id', $request->participante_id)->delete();

        Alojamiento::create($request->all());

        return redirect()->route('admin.alojamientos.create')->with('info', 'Se alojó correctamente al participante');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alojamiento  $alojamiento
     * @return \Illuminate\Http\Response
     */
    public function show(Alojamiento $alojamiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alojamiento  $alojamiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Alojamiento $alojamiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alojamiento  $alojamiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alojamiento $alojamiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alojamiento  $alojamiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alojamiento $alojamiento)
    {
        //
    }
}
