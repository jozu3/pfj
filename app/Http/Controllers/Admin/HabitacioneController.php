<?php

namespace App\Http\Controllers\Admin;

use App\Models\Habitacione;
use App\Http\Controllers\Controller;
use App\Models\Piso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HabitacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.habitaciones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $pisos = Piso::select('pisos.id as pisoid', DB::raw('concat(locales.nombre , " - " , edificios.nombre, " - Piso: " , num) as nivel'))
                            ->join('edificios', 'pisos.edificio_id', '=', 'edificios.id')
                            ->join('locales', 'edificios.locale_id', '=', 'locales.id')
                            ->pluck('nivel', 'pisoid');

        return view('admin.habitaciones.create', compact('pisos'));
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
            'numero' => 'required',
            'cupos' => 'required',
            'piso_id' => 'required',
        ]);

        Habitacione::create($request->all());

        return redirect()->route('admin.habitaciones.create')->with('info', 'La habitación se creó con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Habitacione  $habitacione
     * @return \Illuminate\Http\Response
     */
    public function show(Habitacione $habitacione)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Habitacione  $habitacione
     * @return \Illuminate\Http\Response
     */
    public function edit(Habitacione $habitacione)
    {        
        
        $pisos = Piso::select('pisos.id as pisoid', DB::raw('concat(locales.nombre , " - " , edificios.nombre, " - Piso: " , num) as nivel'))
        ->join('edificios', 'pisos.edificio_id', '=', 'edificios.id')
        ->join('locales', 'edificios.locale_id', '=', 'locales.id')
        ->pluck('nivel', 'pisoid');

        return view('admin.habitaciones.edit', compact('habitacione', 'pisos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Habitacione  $habitacione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Habitacione $habitacione)
    {
        $request->validate([
            'numero' => 'required',
            'cupos' => 'required',
            'piso_id' => 'required',
        ]);

        $habitacione->update($request->all());

        return redirect()->route('admin.habitaciones.index')->with('info', 'La habitación se editó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Habitacione  $habitacione
     * @return \Illuminate\Http\Response
     */
    public function destroy(Habitacione $habitacione)
    {
        $habitacione->delete();

        return redirect()->route('admin.habitaciones.index')->with('info', 'La habitación se eliminó con éxito');
    }
}
