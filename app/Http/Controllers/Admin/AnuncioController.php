<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anuncio;
use App\Models\Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnuncioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.anuncios.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programas = Programa::whereHas('inscripciones', function ($q){
            $q->where('personale_id', auth()->user()->personale->id);
        })->pluck('nombre', 'id');

        return view('admin.anuncios.create', compact('programas'));
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
            'descripcion' => 'required',
            'tipo' => 'required',
            'estado' => 'required',
            'programa_id' => 'required',
        ]);

        Anuncio::create($request->all());

        return redirect()->route('admin.anuncios.index')->with('info', 'Anuncio creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function show(Anuncio $anuncio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function edit(Anuncio $anuncio)
    {
        $programas = Programa::whereHas('inscripciones', function ($q){
            $q->where('personale_id', auth()->user()->personale->id);
        })->pluck('nombre', 'id');

        return view('admin.anuncios.edit', compact('anuncio', 'programas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Anuncio $anuncio)
    {
        $request->validate([
            'descripcion' => 'required',
            'tipo' => 'required',
            'estado' => 'required',
            'programa_id' => 'required',
        ]);

        $anuncio->update($request->all());

        return redirect()->route('admin.anuncios.index')->with('info', 'Anuncio editado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anuncio $anuncio)
    {
        $anuncio->delete();

        return redirect()->route('admin.anuncios.index')->with('info', 'Se eliminó el anuncio');
    }
}
