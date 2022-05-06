<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inscripcione;
use Illuminate\Http\Request;
use App\Models\Pfj;
use App\Models\Programa;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class ProgramaController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.programas.index')->only('index');
        $this->middleware('can:admin.asistencias.create')->only('show');
        $this->middleware('can:admin.programas.create')->only('create', 'store');
        $this->middleware('can:admin.programas.edit')->only('edit', 'update');
        $this->middleware('can:admin.programas.destroy')->only('destroy');
        $this->middleware('can:admin.programas.misprogramas')->only('misprogramas');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$programas = Programa::all();
        
        return view('admin.programas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
    
        $pfj = Pfj::find($_GET['idpfj']);

        return view('admin.programas.create', compact('pfj'));
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
            'pfj_id' => 'required',
            'nombre' => ['required'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['required', 'date'],
            'estado' => ['required', 'numeric'],
        ]);

        $programa = Programa::create($request->all());

        if ($request->file('imgMatrimonioDirector')) {
            $url = Storage::put('programas', $request->file('imgMatrimonioDirector'));
            $programa->imageMatrimonioDirector()->create([
                'url' => $url
            ]);
        }

        // if ($request->file('imgMatrimonioLogistica')) {
        //     $url = Storage::put('programas', $request->file('imgMatrimonioLogistica'));
        //     $programa->imageMatrimonioLogistica()->create([
        //         'url' => $url
        //     ]);
        // }

        $pfj = Pfj::find($request->pfj_id);
        //echo $request->id;  

        return redirect()->route('admin.pfjs.edit', compact('pfj'))->with('info', 'Programa creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Programa $programa)
    {
        $inscripciones = Inscripcione::where('programa_id', $programa->id)->whereIn('estado', [0,1,2])
            ->with('personale.contacto')
            ->get()
            ->sortBy('personale.contacto.apellidos');


            
        $aprobados = Inscripcione::where('programa_id', $programa->id)->whereHas('personale', function($q){
                $q->where('permiso_obispo', 1);
            })->count();

        $no_aprobados = Inscripcione::where('programa_id', $programa->id)->whereHas('personale', function($q){
            $q->where('permiso_obispo', '<>', 1);
        })->count();
        


        $aprobacion = [
            'aprobados' => $aprobados,
            'no_aprobados' => $no_aprobados
        ];


        return view('admin.programas.show', compact('programa', 'inscripciones', 'aprobacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Programa $programa)
    {
        return view('admin.programas.edit', compact('programa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programa $programa)
    {
        $request->validate([
            'pfj_id' => 'required',
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['required', 'date'],
            'estado' => ['required', 'numeric'],
        ]);

        $programa->update($request->all());
        
        if ($request->file('imgMatrimonioDirector')) {
            $urlMD = Storage::put('programas', $request->file('imgMatrimonioDirector'));
            //$programa->image()->delete();
            if($programa->imageMatrimonioDirector != null){
                Storage::delete($programa->imageMatrimonioDirector->url);
                $programa->imageMatrimonioDirector->update([
                    'url' => $urlMD
                ]);
            } else {
                $programa->imageMatrimonioDirector()->create([
                    'url' => $urlMD
                ]);
            }
        }
        
        // if ($request->file('imgMatrimonioLogistica')) {
        //     $urlML = Storage::put('programas', $request->file('imgMatrimonioLogistica'));
        //     //$programa->image()->delete();
        //     if($programa->imageMatrimonioLogistica != null){
        //         Storage::delete($programa->imageMatrimonioLogistica->url);
        //         $programa->imageMatrimonioLogistica->update([
        //             'url' => $urlML
        //         ]);
        //         // dd($request->file('imgMatrimonioLogistica'));
        //     } else {
        //         $programa->imageMatrimonioLogistica()->create([
        //             'url' => $urlML
        //         ]);
        //     }
        // }


        return redirect()->route('admin.programas.edit', compact('programa'))->with('info', 'Se actualizaron los datos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programa $programa)
    {
        $programa->delete();

        return redirect()->route('admin.pfjs.edit', $programa->pfj)->with('info', 'El programa se eliminó con éxito'); 
    }


    public function misprogramas()
    {
        return view('admin.programas.misprogramas');
    }

    public function grupos(){
        return view('admin.programas.grupos');
    }


    public function asignar(Programa $programa){
        return view('admin.programas.asignar', compact('programa'));
    }
}
