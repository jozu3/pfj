<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Barrio;
use App\Models\Estaca;
use App\Models\Participante;
use Illuminate\Http\Request;

class ParticipanteController extends Controller
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


        $estacas = Estaca::get();
        $estacasselect = [];

        foreach ($estacas as $estaca) {
            $estacasselect[$estaca->nombre] = Barrio::where('estaca_id', $estaca->id)->pluck('nombre', 'id');
        }
        return view('student.participante.create', compact('estacasselect'));
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
            'nombres' => 'required',
            'apellidos' => 'required',
            'documento' => 'required',
            'fecnac' => 'required',
            'genero' => 'required',
            // 'telefono' => 'required',
            'talla' => 'required',
            'tipo_ingreso' => 'required',
            'vacunas' => 'required',
            'sangre' => 'required',
            // 'diabetico_asmatico' => 'required',
            // 'alergia' => 'required',
            // 'tratamiento_medico' => 'required',
            'seguro_medico' => 'required',
            // 'informacion_medica' => 'required',
            // 'informacion_alimentaria' => 'required',
            'barrio_id' => 'required',
            'estado_aprobacion' => 'required',
            'obispo' => 'required'
        ]);

        $fecha1 = date_create(date('Y-m-d'));
        $fecha2 = date_create($request['fecnac']);

        $request['age'] = date_diff($fecha1, $fecha2)->y;
        $request['age_2022'] = date_diff($fecha1, $fecha2)->y;
        $request['horallegada'] = date('Y-m-d H:i:s');

        $participante = Participante::create($request->all());
        // $participante = Participante::find($participante_id);

        return redirect()->route('st.participantes.edit', $participante)->with('info', 'Se actualizó y asigno los roles correctamente');
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
    public function edit(Participante $participante)
    {
        //
        $estacas = Estaca::get();
        $estacasselect = [];

        foreach ($estacas as $estaca) {
            $estacasselect[$estaca->nombre] = Barrio::where('estaca_id', $estaca->id)->pluck('nombre', 'id');
        }
        return view('student.participante.edit', compact('participante', 'estacasselect'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participante $participante)
    {
        //
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'documento' => 'required',
            'fecnac' => 'required',
            'genero' => 'required',
            // 'telefono' => 'required',
            'talla' => 'required',
            'tipo_ingreso' => 'required',
            'vacunas' => 'required',
            'sangre' => 'required',
            // 'diabetico_asmatico' => 'required',
            // 'alergia' => 'required',
            // 'tratamiento_medico' => 'required',
            'seguro_medico' => 'required',
            // 'informacion_medica' => 'required',
            // 'informacion_alimentaria' => 'required',
            'barrio_id' => 'required',
            'estado_aprobacion' => 'required',
            'obispo' => 'required'

        ]);

        $participante->update($request->all());

        return redirect()->route('st.participantes.edit', $participante)->with('info', 'Se actualizó y asigno los roles correctamente');
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