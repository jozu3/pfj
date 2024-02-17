<?php

namespace App\Http\Controllers\Admin;

use App\Models\AlojamientoPersonale;
use App\Http\Controllers\Controller;
use App\Models\Alojamiento;
use App\Models\Habitacione;
use App\Models\Inscripcione;
use App\Models\Locale;
use App\Models\Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlojamientoPersonaleController extends Controller
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
        // $inscripciones = Inscripcione::select('id', DB::raw('concat(nombres, " ", apellidos) as nombre_completo'))->where('programa_id', session('programa_activo'))->orderBy('nombre_completo')->get()->pluck('nombre_completo', 'id');

        // $habitaciones = Habitacione::select('habitaciones.id as habitacion', DB::raw('concat(locales.nombre , " - " , edificios.nombre, " - Piso: " , num, " - ", habitaciones.numero) as nivel'))
        //                     ->join('pisos', 'habitaciones.piso_id', '=', 'pisos.id')
        //                     ->join('edificios', 'pisos.edificio_id', '=', 'edificios.id')
        //                     ->join('locales', 'edificios.locale_id', '=', 'locales.id')
        //                     ->pluck('nivel', 'habitacion');

        // return view('admin.alojamientos.create', compact('inscripciones', 'habitaciones'));
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
     * @param  \App\Models\AlojamientoPersonale  $alojamientoPersonale
     * @return \Illuminate\Http\Response
     */
    public function show(AlojamientoPersonale $alojamientoPersonale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AlojamientoPersonale  $alojamientoPersonale
     * @return \Illuminate\Http\Response
     */
    public function edit(AlojamientoPersonale $alojamientoPersonale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AlojamientoPersonale  $alojamientoPersonale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AlojamientoPersonale $alojamientoPersonale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AlojamientoPersonale  $alojamientoPersonale
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlojamientoPersonale $alojamientoPersonale)
    {
        dd($alojamientoPersonale->id);
        $programa = $alojamientoPersonale->inscripcione->programa;
        $alojamientoPersonale->delete();
        return redirect()->route('admin.programas.personal', $programa)->with('info', 'Se borró el alojamiento correctamente');
    }

    public function asignarInscripcionesHabitacion(Programa $programa){

        $locale_id = Programa::find($programa->id)->locale_id;
        $locale = Locale::where('id', $locale_id)->with('edificios', function($q) use ($programa){
            $q->with('pisos', function($q) use ($programa){
                $q->with('habitaciones', function($q) use ($programa){
                    $q->with('alojamientos', function($q) use ($programa){
                        $q->whereHas('participante', function($q) use ($programa){
                            $q->where('programa_id', $programa->id);
                        });
                    })
                    ->with('alojamientosPersonales', function($q) use ($programa){
                        $q->whereHas('inscripcione', function($q) use ($programa){
                            $q->where('programa_id', $programa->id);
                        });
                    });
                });
            });
        })->first();
        
        $locale_id = $programa->locale_id;

        $habitaciones = Habitacione::select('habitaciones.id as habitacion', DB::raw('concat(locales.nombre , " - " , edificios.nombre, " - Piso: " , num, " - ", habitaciones.numero, " (", habitaciones.cupos," personas)") as nivel'))
        ->join('pisos', 'habitaciones.piso_id', '=', 'pisos.id')
        ->join('edificios', 'pisos.edificio_id', '=', 'edificios.id')
        ->join('locales', 'edificios.locale_id', '=', 'locales.id')
        ->whereHas('piso', function ($q) use ($locale_id) {
            $q->whereHas('edificio', function ($q) use ($locale_id) {
                $q->where('locale_id', $locale_id);
            });
        })
        ->pluck('nivel', 'habitacion');

        $companias = $programa->companias();

        return view('admin.alojamientos-personale.asignarInscripcionesHabitacion', compact('companias', 'habitaciones', 'programa', 'locale'));
    }

    public function storeInscripcionesHabitacion(Request $request){

        $request->validate([
            'inscripciones' => 'required',
            'habitaciones' => 'required',
        ]);

        $programa = Programa::find(session('programa_activo'));

        // dd($request->Inscripciones);
        $nota = '';
        $p = 0;

        $inscripciones = $request->inscripciones;
        // dd(count($request->inscripciones));
        foreach ($request->habitaciones as $key => $value) {
            $habitacione = Habitacione::where('id', $value)->with('alojamientos', function($q) use ($programa){
                                $q->whereHas('participante', function($q) use ($programa){
                                    $q->where('programa_id', $programa->id);
                                });
                            })->first();
            if ( isset($habitacione->alojamientos) && $habitacione->alojamientos->count()) {
                return redirect()->back()->withErrors(['error' =>  'Una de las habiaciones seleccionadas ya se encuentra alojada por participantes. No puede alojar miembros del personal junto con participantes']);
            }
        }

        foreach ($request->habitaciones as $key => $value) {
            $habitacione = Habitacione::where('id', $value)->with('alojamientosPersonales', function($q) use ($programa){
                                $q->whereHas('inscripcione', function($q) use ($programa){
                                    $q->where('programa_id', $programa->id);
                                });
                            })->first();

            for ($i=0; $i < $habitacione->cupos - $habitacione->alojamientosPersonales->count() ; $i++) { 
                if(isset($inscripciones[$p])){
                    AlojamientoPersonale::where('inscripcione_id', $inscripciones[$p])->delete();
                    AlojamientoPersonale::create([
                        'inscripcione_id' => $inscripciones[$p],
                        'habitacione_id' => $habitacione->id,
                    ]);
                    $p++;
                }
            }
        }


        return redirect()->route('admin.alojamientosPersonale.asignarInscripcionesHabitacione', $programa)->with('info', 'Se alojó correctamente. '. $nota);
    }
}
