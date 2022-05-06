<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Personale_unidade;
use App\Models\Personale_nota;
use App\Models\Grupo;
use Illuminate\Http\Request;

class PersonaleUnidadeController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.personale_unidades.index')->only('index');
        $this->middleware('can:admin.personale_unidades.create')->only('create', 'store');
        $this->middleware('can:admin.personale_unidades.edit')->only('edit', 'update');
        $this->middleware('can:admin.personale_unidades.destroy')->only('destroy', 'destroyfromgroup');
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
        $grupo = Grupo::find($request->grupo_id);
        $inscripciones = $grupo->inscripciones;

        foreach ($inscripciones as $inscripcione){
            foreach ($grupo->grupos as $unidad){
                $personale_unidade = Personale_unidade::create([
                    'unidad_id' => $unidad->id,
                    'inscripcione_id' => $inscripcione->id,
                ]);

                foreach($personale_unidade->unidad->notas as $nota){
                    Personale_nota::create([
                        'nota_id' => $nota->id,
                        'personale_unidade_id' => $personale_unidade->id,
                    ]);
                }
            }
        }

        return redirect()->route('admin.grupos.edit', compact('grupo'))->with('info_personale_nota', 'Los registros de notas para los personales se generaron correctamente.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personale_unidade  $personale_unidade
     * @return \Illuminate\Http\Response
     */
    public function show(Personale_unidade $personale_unidade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personale_unidade  $personale_unidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Personale_unidade $personale_unidade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request    }
     * @param  \App\Models\Personale_unidade  $personale_unidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personale_unidade $personale_unidade)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personale_unidade  $personale_unidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personale_unidade $personale_unidade)
    {

    }

    public function destroyfromgroup(Grupo $grupo){
        $result = false;
       //dd($grupo);
        foreach ($grupo->inscripciones as $inscripcione){
            foreach ($inscripcione->personaleUnidades as $personaleUnidad){
                $result = false;
                if ($personaleUnidad->delete()) {
                    $result = true;
                }
            }
        }
        if ($result){
            $var_msg = 'info_personale_nota';
            $msg = 'Los registros de notas para los personales se eliminaron correctamente.';
        } else {
            $var_msg = 'error_personale_nota';
            $msg = 'No se pudo eliminar todos los registros correctamente.';
        }

        return redirect()->route('admin.grupos.edit', compact('grupo'))->with($var_msg, $msg);

    }
    
    public function updatefromgroup(Request $request, Grupo $grupo){

        $grupo = Grupo::find($request->grupo_id);
        $inscripciones = $grupo->inscripciones;

        foreach ($inscripciones as $inscripcione){
            $existe = Personale_unidade::where('inscripcione_id',$inscripcione->id)->count();

            foreach ($grupo->grupos as $unidad){

                if (!$existe) {
                    $personale_unidade = Personale_unidade::create([
                        'unidad_id' => $unidad->id,
                        'inscripcione_id' => $inscripcione->id,
                    ]);

                    foreach($personale_unidade->unidad->notas as $nota){
                        Personale_nota::create([
                            'nota_id' => $nota->id,
                            'personale_unidade_id' => $personale_unidade->id,
                        ]);
                    }
                }
                
            }
        }

        return redirect()->route('admin.grupos.edit', compact('grupo'))->with('info_personale_nota', 'Los registros de notas para los personales se generaron correctamente.');
    }
}
