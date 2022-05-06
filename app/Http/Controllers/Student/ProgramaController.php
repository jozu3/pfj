<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Programa;
use App\Models\Inscripcione;
use App\Models\InscripcioneCompanerismo;
use Illuminate\Http\Request;

class ProgramaController extends Controller
{
    public function __construct(){
        $this->middleware('can:student.programas.index')->only('index', 'show');
    }
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
     * @param  \App\Models\Programa  $grupo
     * @return \Illuminate\Http\Response
     */
    public function show(Programa $programa)
    {
        // $this->authorize('view', $programa);

        $personale = auth()->user()->personale;

        $inscripcione = Inscripcione::where('programa_id', $programa->id)->where('personale_id', $personale->id)->first();
        // $inscripcioneCompanerismos = InscripcioneCompanerismo::where('inscripcione_id', $inscripcione->id)->get();

        // return view('student.programas.show', compact('inscripcioneCompanerismos', 'inscripcione'));
        return view('student.programas.show', compact('inscripcione'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Programa  $programa
     * @return \Illuminate\Http\Response
     */
    public function edit(Programa $programa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Programa  $programa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programa $programa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Programa  $grupo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programa $grupo)
    {
        //
    }
}
