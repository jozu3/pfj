<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConsejoCoordinacione;
use App\Models\Estaca;
use Illuminate\Http\Request;

class EstacaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $estacas = Estaca::all();
        return view('admin.estacas.index', compact('estacas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $consejo_coordinaciones = ConsejoCoordinacione::get()->pluck('nombre', 'id');
        return view('admin.estacas.create', compact('consejo_coordinaciones'));
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
            'consejo_coordinacione_id' => 'required'
        ]);

        $estaca = Estaca::create($request->all());

        if ($estaca->id)
            return redirect()->route('admin.estacas.index')->with('info', 'La estaca se creó correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Estaca $estaca)
    {
        //
        $consejo_coordinaciones = ConsejoCoordinacione::get()->pluck('nombre', 'id');
        return view('admin.estacas.edit', compact('estaca', 'consejo_coordinaciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estaca $estaca)
    {
        //
        $request->validate([
            'nombre' => 'required',
            'consejo_coordinacione_id' => 'required'
        ]);

        $estaca->update($request->all());

        if ($estaca->id)
            return redirect()->route('admin.estacas.index')->with('info', 'La estaca ha sido actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
