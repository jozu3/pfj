<?php

namespace App\Http\Controllers\Admin;

use App\Models\Edificio;
use App\Http\Controllers\Controller;
use App\Models\Alojamiento;
use App\Models\Habitacione;
use App\Models\Locale;
use App\Models\Piso;
use Illuminate\Http\Request;

class EdificioController extends Controller
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
        $locales = Locale::pluck('nombre', 'id');
        return view('admin.edificios.create', compact('locales'));
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
            'nombre' => 'required',
            'locale_id' => 'required',
            'pisos' => 'required|min:1',
        ]);

        $edificio = Edificio::create($request->all());

        for ($i=1; $i <= $request->pisos; $i++) { 
            Piso::create([
                'num' => $i,
                'edificio_id' => $edificio->id
            ]);
        }

        $locale = $edificio->locale;

        return redirect()->route('admin.locales.show', $locale)->with('info', 'El edificio se creó correctamente con '. $request->pisos . ' pisos.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Edificio  $edificio
     * @return \Illuminate\Http\Response
     */
    public function show(Edificio $edificio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Edificio  $edificio
     * @return \Illuminate\Http\Response
     */
    public function edit(Edificio $edificio)
    {
        $locales = Locale::all();
        return view('admin.edificios.edit', compact('locales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Edificio  $edificio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Edificio $edificio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Edificio  $edificio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Edificio $edificio)
    {
        $locale = $edificio->locale;

        Alojamiento::whereHas('habitacione', function($q) use($edificio){
            $q->whereHas('piso', function($qu) use($edificio){
                $qu->where('edificio_id', $edificio->id);
                });
            })->delete();

        Habitacione::whereHas('piso', function($q) use($edificio){
            $q->where('edificio_id', $edificio->id);
        })->delete();

        Piso::where('edificio_id', $edificio->id)->delete();

        $edificio->delete();

        return redirect()->route('admin.locales.show', $locale)->with('info', 'Se eliminó el edificio correctamente');

    }
}
