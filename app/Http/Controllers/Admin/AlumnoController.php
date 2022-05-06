<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Personale;
use App\Models\Pfj;
use DB;

class PersonaleController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.personales.index');//->only('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       
        return view('admin.personales.index');
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
     * @param  int  Personale $personale
     * @return \Illuminate\Http\Response
     */
    public function show(Personale $personale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Personale $personale
     * @return \Illuminate\Http\Response
     */
    public function edit(Personale $personale)
    {
        $vendedores = [];
        if (auth()->user()->hasRole(['Admin', 'Asistente'])) {
            $vendedores = Personale::select(DB::raw('concat(nombres, " ", apellidos) as nombre'), 'id')->pluck('nombre', 'id');
            $personale->contacto['vendedor_id'] = $personale->contacto->personal_id;
        }
        return view('admin.personales.edit', compact('personale', 'vendedores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Personale $personale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personale $personale)
    {
        
        $personale->contacto->update([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'doc' => $request->doc,
            'grado_academico' => $request->grado_academico,
        ]);

        if(isset($request->personal_id)){
            $personale->contacto->update([
                'personal_id' => $request->personal_id
            ]);
        }

        return redirect()->route('admin.personales.edit', compact('personale'))->with('info', 'El personale se actualizó correctamente');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Personale $personale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personale $personale)
    {
        //
    }
}
