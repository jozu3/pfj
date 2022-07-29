<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Barrio;
use App\Models\Companerismo;
use App\Models\Estaca;
use App\Models\Participante;
use App\Models\ParticipanteCompania;
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
            // 'documento' => 'required',
            'fecnac' => 'required',
            'genero' => 'required',
            // 'telefono' => 'required',
            'talla' => 'required',
            // 'tipo_ingreso' => 'required',
            'vacunas' => 'required|numeric',
            'sangre' => 'required',
            'diabetico_asmatico' => 'required',
            'alergia' => 'required',
            'tratamiento_medico' => 'required',
            'seguro_medico' => 'required',
            'informacion_medica' => 'required',
            'informacion_alimentaria' => 'required',
            'barrio_id' => 'required',
            'estado_aprobacion' => 'required',
            'estado' => 'required',
            'obispo' => 'required'
        ]);

        $fecha1 = date_create(date('Y-m-d'));
        $fecha2 = date_create($request['fecnac']);

        $request['age'] = date_diff($fecha1, $fecha2)->y;
        $request['age_2022'] = date_diff(date_create(date('Y').'-12-31'), $fecha2)->y;
        $request['horallegada'] = date('Y-m-d H:i:s');

        $participante = Participante::create($request->all());
        // $participante = Participante::find($participante_id);

        return redirect()->route('st.participantes.edit', $participante)->with('info', 'Se creo al participante y se registró su ingreso.');
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

        if ($participante->participanteCompania) {
            $participante['compania'] = $participante->participanteCompania->companerismo_id;
        }

        $companias = [];

        

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
            // 'documento' => 'required',
            'fecnac' => 'required',
            'genero' => 'required',
            // 'telefono' => 'required',
            'talla' => 'required',
            // 'tipo_ingreso' => 'required',
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

        if (isset($request->compania)) {
            $parComp = ParticipanteCompania::where('participante_id', $participante->id)->first()->update(['companerismo_id' => $request->compania]);
            // dd($parComp);
        }
        

        return redirect()->route('st.participantes.edit', $participante)->with('info', 'Se actualizó los datos del participante');
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

    public function compania(Companerismo $companerismo){


        return view('student.participante.compania', compact('companerismo'));
    }
}
