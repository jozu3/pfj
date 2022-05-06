<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Capacitacione;
use App\Models\Grupo;
use App\Models\Programa;
use Illuminate\Http\Request;

class CapacitacioneController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.capacitaciones.index')->only('index');
        $this->middleware('can:admin.capacitaciones.create')->only('create', 'store', 'storeforgroup');
        $this->middleware('can:admin.capacitaciones.edit')->only('edit', 'update');
        $this->middleware('can:admin.capacitaciones.destroy')->only('destroy', 'destroyfromgroup');
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Capacitacione  $capacitacione
     * @return \Illuminate\Http\Response
     */
    public function show(Capacitacione $capacitacione)
    {
        return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Capacitacione  $capacitacione
     * @return \Illuminate\Http\Response
     */
    public function edit(Capacitacione $capacitacione)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Capacitacione  $capacitacione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Capacitacione $capacitacione)
    {   
        
        $capacitacione->update($request->all());
        $programa = Programa::find($capacitacione->programa_id);

        return redirect()->route('admin.programas.edit', compact('programa'))
                ->with('info_capacitacione', 'La capacitación se editó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Capacitacione  $capacitacione
     * @return \Illuminate\Http\Response
     */
    public function destroy(Capacitacione $capacitacione)
    {
        $capacitacione->delete();
        $programa = $capacitacione->programa;

        return redirect()->route('admin.programas.edit', compact('programa'))
        ->with('info_capacitacione', 'La capacitación se eliminó correctamente');
    }

    public function storeforgroup(Grupo $grupo){

        foreach ($grupo->grupos as $unidad){
            for ($i = 0; $i < $unidad->cantidad_capacitaciones; $i++) {

                $days = 7*$i;

                Capacitacione::create([
                    'unidad_id' => $unidad->id,
                    'fechacapacitacione' => date('Y-m-d', strtotime( '+'.$days.'day', strtotime($unidad->fechainicio))),
                    'estado' => 0
                ]); 
            }
        }

        $var_msg = 'info_personale_nota';
        $msg = 'Los registros de las capacitaciones para los personales se crearon correctamente.';

        return redirect()->route('admin.grupos.edit', compact('grupo'))->with($var_msg, $msg);
    }

    public function destroyfromgroup(Grupo $grupo){
        $result = false;
       //dd($grupo);
        foreach ($grupo->grupos as $unidad){
            foreach ($unidad->capacitaciones as $capacitacione){
                $result = false;
                if ($capacitacione->delete()) {
                    $result = true;
                }
            }
        }
        if ($result){
            $var_msg = 'info_personale_nota';
            $msg = 'Los registros de las capacitaciones para los personales se eliminaron correctamente.';
        } else {
            $var_msg = 'error_personale_nota';
            $msg = 'No se pudo eliminar todos los registros correctamente.';
        }

        return redirect()->route('admin.grupos.edit', compact('grupo'))->with($var_msg, $msg);

    }
}
