<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alojamiento;
use App\Models\Estaca;
use App\Models\Inscripcione;
use App\Models\Locale;
use App\Models\Participante;
use Illuminate\Http\Request;
use App\Models\Pfj;
use App\Models\Programa;
use App\Models\Vacuna;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class ProgramaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.programas.index')->only('index');
        $this->middleware('can:admin.programas.control')->only('show');
        $this->middleware('can:admin.programas.create')->only('create', 'store');
        $this->middleware('can:admin.programas.edit')->only('edit', 'update', 'personal');
        $this->middleware('can:admin.programas.destroy')->only('destroy');
        $this->middleware('can:admin.inscripcioneCompanerismos.edit')->only('asignar');
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
        $locales = Locale::all()->pluck('nombre', 'id');

        return view('admin.programas.create', compact('pfj', 'locales'));
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
            'mostrarGrupos' => ['required', 'numeric'],
        ]);

        $programa = Programa::create($request->all());

        if ($request->file('imgMatrimonioDirector')) {
            $url = Storage::put('programas', $request->file('imgMatrimonioDirector'));
            $programa->imageMatrimonioDirector()->create([
                'url' => $url,
                'tipo' => 'md'
            ]);
        }

        if ($request->file('imgMatrimonioLogistica')) {
            $url = Storage::put('programas', $request->file('imgMatrimonioLogistica'));
            $programa->imageMatrimonioLogistica()->create([
                'url' => $url,
                'tipo' => 'ml'
            ]);
        }

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
        return view('admin.programas.show', compact('programa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Programa $programa)
    {
        $locales = Locale::all()->pluck('nombre', 'id');

        return view('admin.programas.edit', compact('programa', 'locales'));
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
            'mostrarGrupos' => ['required', 'numeric'],
        ]);

        $programa->update($request->all());
        // dd($programa->estado);
        if ($programa->estado == 1) //estado: Iniciado
        {
            Participante::where('programa_id', $programa->id)->where('estado', 0)->update(['estado' => 5]); //estado: en espera
        }

        if ($programa->estado == 0) //estado: por iniciar
        {
            Participante::where('programa_id', $programa->id)->whereIn('estado', [5, 3, 4])->update(['estado' => 0]); //estado: inscrito
        }

        if ($programa->estado == 2) //estado: terminado
        {
            Participante::where('programa_id', $programa->id)->where('estado', 2)->update(['estado' => 3]); //estado: terminado
        }

        if ($request->file('imgMatrimonioDirector')) {
            $urlMD = Storage::put('programas', $request->file('imgMatrimonioDirector'));
            //$programa->image()->delete();
            if ($programa->imageMatrimonioDirector != null) {
                Storage::delete($programa->imageMatrimonioDirector->url);
                $programa->imageMatrimonioDirector->update([
                    'url' => $urlMD,
                    'tipo' => 'md'
                ]);
            } else {
                $programa->imageMatrimonioDirector()->create([
                    'url' => $urlMD,
                    'tipo' => 'md'
                ]);
            }
        }


        if ($request->file('imgMatrimonioLogistica')) {
            $urlML = Storage::put('programas', $request->file('imgMatrimonioLogistica'));
            //$programa->image()->delete();
            if ($programa->imageMatrimonioLogistica != null) {
                Storage::delete($programa->imageMatrimonioLogistica->url);
                $programa->imageMatrimonioLogistica->update([
                    'url' => $urlML,
                    'tipo' => 'ml'
                ]);
                // dd($request->file('imgMatrimonioLogistica'));
            } else {
                $programa->imageMatrimonioLogistica()->create([
                    'url' => $urlML,
                    'tipo' => 'ml'
                ]);
            }
        }


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

    public function grupos()
    {
        return view('admin.programas.grupos');
    }

    public function planificador(Programa $programa)
    {
        return view('admin.programas.planificador', compact('programa'));
    }

    public function uploadImageTarea(Request $request){
        $path = Storage::put('images-tareas', $request->file('upload'));

        return [
            'url' => Storage::url($path)
        ];

    }

    public function asignar(Programa $programa)
    {
        return view('admin.programas.asignar', compact('programa'));
    }

    public function directorio(Programa $programa)
    {

        return view('admin.programas.directorio', compact('programa'));
    }

    public function tareas(Programa $programa)
    {
        return view('admin.programas.tareas', compact('programa'));
    }

    public function funciones(Programa $programa)
    {
        return view('admin.programas.funciones', compact('programa'));
    }

    public function personal(Programa $programa)
    {
        return view('admin.programas.personal', compact('programa'));
    }

    public function dashboard(Programa $programa)
    {

        $aprobados = Inscripcione::where('programa_id', $programa->id)->whereHas('personale', function ($q) {
            $q->where('permiso_obispo', '2');
        })->count();

        $pendientes = Inscripcione::where('programa_id', $programa->id)->whereHas('personale', function ($q) {
            $q->where('permiso_obispo', '1');
        })->count();

        $cancelados = Inscripcione::where('programa_id', $programa->id)->whereHas('personale', function ($q) {
            $q->where('permiso_obispo', '0');
        })->count();



        $aprobacion = [
            'aprobados' => $aprobados,
            'pendientes' => $pendientes,
            'cancelados' => $cancelados
        ];


        $rtemplo_activa = Inscripcione::where('programa_id', $programa->id)->whereHas('personale', function ($q) {
            $q->where('estado_rtemplo', 1);
        })->count();

        $rtemplo_activa_obs = Inscripcione::where('programa_id', $programa->id)->whereHas('personale', function ($q) {
            $q->where('obs_rtemplo', '<>', '');
        })->count();

        $rtemplo_noactiva = Inscripcione::where('programa_id', $programa->id)->whereHas('personale', function ($q) {
            $q->where('estado_rtemplo', '<>', 1);
        })->count();

        $rtemplo = [
            'activa' => ($rtemplo_activa - $rtemplo_activa_obs),
            'activa_obs' => $rtemplo_activa_obs,
            'noactiva' => $rtemplo_noactiva,
        ];



        return view('admin.programas.dashboard', compact('aprobacion', 'rtemplo', 'programa'));
    }

    public function changeSession(Programa $programa)
    {
        $this->authorize('changeSession', $programa);

        session(['programa_activo' => $programa->id]);
        return redirect()->route('admin.index');
    }

    public function participantes(Programa $programa)
    {
        return view('admin.programas.participantes', compact('programa'));
    }

    public function companias(Programa $programa)
    {
        return view('admin.programas.companias', compact('programa'));
    }

    public function dashboardBienvenida(Programa $programa)
    {
        $estacas = Estaca::all();

        $alojados = Participante::where('programa_id', $programa->id)->whereHas('alojamiento', function () {
        })->whereIn('estado', ['0', '1', '5', '2'])->get();
        $total = Participante::where('programa_id', $programa->id)->whereIn('estado', ['0', '1', '5', '2'])->get();

        $totalPersonalHombres__ = Inscripcione::where('programa_id', $programa->id)
                                ->where('estado', '1')
                                ->whereHas('personale', function ($q) {
                                    $q->whereHas('contacto', function ($qu) {
                                        $qu->where('genero', 'Hombre');
                                    });
                                });
                                
        $totalPersonalHombres = $totalPersonalHombres__->count();
        $totalPersonalHombresAlojados = $totalPersonalHombres__->whereHas('alojamientoPersonale', function(){})->count();

        $totalPersonalMujeres__ = Inscripcione::where('programa_id', $programa->id)
                                ->where('estado', '1')
                                ->whereHas('personale', function ($q) {
                                    $q->whereHas('contacto', function ($qu) {
                                        $qu->where('genero', 'Mujer');
                                    });
                                });

        $totalPersonalMujeres = $totalPersonalMujeres__->count();
        // dd($totalPersonalMujeres);
        $totalPersonalMujeresAlojados = $totalPersonalMujeres__->whereHas('alojamientoPersonale', function(){})->count();

      

        return view('admin.programas.dashboard-bienvenida', compact('programa', 'estacas', 'alojados', 'total', 
                                                                'totalPersonalHombres', 
                                                                'totalPersonalHombresAlojados', 
                                                                'totalPersonalMujeres', 
                                                                'totalPersonalMujeresAlojados'));
    }
    
    public function unidadesLocales(Programa $programa){


        return view('admin.programas.unidades-locales', compact('programa')); 
    }
}
