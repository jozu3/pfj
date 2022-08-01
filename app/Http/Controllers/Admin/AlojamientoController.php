<?php

namespace App\Http\Controllers\Admin;

use App\Models\Alojamiento;
use App\Http\Controllers\Controller;
use App\Models\Habitacione;
use App\Models\Participante;
use App\Models\Programa;
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

    public function asignarParticipantesHabitacion(Programa $programa){

        $habitaciones = Habitacione::select('habitaciones.id as habitacion', DB::raw('concat(locales.nombre , " - " , edificios.nombre, " - Piso: " , num, " - ", habitaciones.numero) as nivel'))
        ->join('pisos', 'habitaciones.piso_id', '=', 'pisos.id')
        ->join('edificios', 'pisos.edificio_id', '=', 'edificios.id')
        ->join('locales', 'edificios.locale_id', '=', 'locales.id')
        ->pluck('nivel', 'habitacion');

        $companias = $programa->companias();

        return view('admin.alojamientos.asignarParticipantesHabitacion', compact('companias', 'habitaciones'));
    }

    public function storeParticipantesHabitacion(Request $request){

        $request->validate([
            'participantes' => 'required',
            'habitacione_id' => 'required',
        ]);

        $programa = Programa::find(session('programa_activo'));

        // dd($request->participantes);
        $habitacione = Habitacione::find($request->habitacione_id);
        $nota = '';

        foreach ($request->participantes as $participante_id){

            if($habitacione->alojamientos->count() < $habitacione->cupos){
                Alojamiento::where('participante_id', $participante_id)->delete();
                Alojamiento::create([
                    'participante_id' => $participante_id,
                    'habitacione_id' => $request->habitacione_id,
                ]);

            } else {
                $nota= 'Nota: Algunos participantes no se alojaron porque la habitación está llena.';
            }
        }

        return redirect()->route('admin.alojamientos.asignarParticipantesHabitacion', $programa)->with('info', 'Se alojó correctamente'. $nota);
    }
}
