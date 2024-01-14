<?php

namespace App\Http\Controllers\Admin;

use App\Models\Alojamiento;
use App\Http\Controllers\Controller;
use App\Models\Habitacione;
use App\Models\Locale;
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
        $programa_ = session('programa_activo');

        $locale_id = Programa::find($programa_)->locale->id;

        $participantes = Participante::select('id', DB::raw('concat(nombres, " ", apellidos) as nombre_completo'))->where('programa_id', session('programa_activo'))->orderBy('nombre_completo')->get()->pluck('nombre_completo', 'id');

        $habitaciones = Habitacione::select('habitaciones.id as habitacion', DB::raw('concat(locales.nombre , " - " , edificios.nombre, " - Piso: " , num, " - ", habitaciones.numero) as nivel'))
            ->join('pisos', 'habitaciones.piso_id', '=', 'pisos.id')
            ->join('edificios', 'pisos.edificio_id', '=', 'edificios.id')
            ->join('locales', 'edificios.locale_id', '=', 'locales.id')
            ->whereHas('piso', function ($q) use ($locale_id) {
                $q->whereHas('edificio', function ($q) use ($locale_id) {
                    $q->where('locale_id', $locale_id);
                });
            })
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
        $programa = $alojamiento->participante->programa;
        $alojamiento->delete();
        return redirect()->route('admin.programas.participantes', $programa)->with('info', 'Se borró el alojamiento correctamente');
    }

    public function asignarParticipantesHabitacion(Programa $programa)
    {
        $programa_ = session('programa_activo');
        $locale_id = Programa::find($programa_)->locale_id;
        $locale = Locale::find($locale_id);

        $habitaciones = Habitacione::select('habitaciones.id as habitacion', 'habitaciones.numero', DB::raw('concat(locales.nombre , " - " , edificios.nombre, " - Piso: " , num, " - ", habitaciones.numero, " (", habitaciones.cupos," personas)") as nivel'))
            ->join('pisos', 'habitaciones.piso_id', '=', 'pisos.id')
            ->join('edificios', 'pisos.edificio_id', '=', 'edificios.id')
            ->join('locales', 'edificios.locale_id', '=', 'locales.id')
            ->whereHas('piso', function ($q) use ($locale_id) {
                $q->whereHas('edificio', function ($q) use ($locale_id) {
                    $q->where('locale_id', $locale_id);
                });
            })
            ->with('alojamientos', function($q) use ($programa_){
                $q->whereHas('participante', function($q) use ($programa_){
                    $q->where('programa_id', $programa_);
                });
            })
            ->with('alojamientosPersonales', function($q) use ($programa_){
                $q->whereHas('inscripcione', function($q) use ($programa_){
                    $q->where('programa_id', $programa_);
                });
            })
            ;

        $habitaciones_select = $habitaciones->pluck('nivel', 'habitacion');
        $habitaciones = $habitaciones->get();

        $companias = $programa->companias();

        return view('admin.alojamientos.asignarParticipantesHabitacion', compact('companias', 'habitaciones', 'locale', 'habitaciones_select'));
    }

    public function storeParticipantesHabitacion(Request $request)
    {

        $request->validate([
            'participantes' => 'required',
            'habitaciones' => 'required',
            // 'habitacione_id' => 'required',
        ]);

        $programa = Programa::find(session('programa_activo'));

        $nota = '';
        $participantes = $request->participantes;
        $p = 0;
        // dd(count($request->participantes));
        foreach ($request->habitaciones as $key => $value) {
            $habitacione = Habitacione::find($value);
            for ($i=0; $i < $habitacione->cupos - $habitacione->alojamientos->count() ; $i++) { 
                if(isset($participantes[$p])){

                    Alojamiento::where('participante_id', $participantes[$p])->delete();
                    Alojamiento::create([
                        'participante_id' => $participantes[$p],
                        'habitacione_id' => $habitacione->id,
                    ]);
                    $p++;
                }
            }
            if($p == count($request->participantes) - 1 ){

            }
        }

        // foreach ($request->participantes as $participante_id) {
        //     $habitacione = Habitacione::where('id', $request->habitacione_id)->first();

        //     if ($habitacione->alojamientos->count() < $habitacione->cupos) {
        //         Alojamiento::where('participante_id', $participante_id)->delete();
        //         Alojamiento::create([
        //             'participante_id' => $participante_id,
        //             'habitacione_id' => $request->habitacione_id,
        //         ]);
        //     } else {
        //         $nota = 'Nota: Algunos participantes no se alojaron porque la habitación está llena.';
        //     }
        // }

        return redirect()->route('admin.alojamientos.asignarParticipantesHabitacion', $programa)->with('info', 'Se alojó correctamente. ' . $nota);
    }
}
