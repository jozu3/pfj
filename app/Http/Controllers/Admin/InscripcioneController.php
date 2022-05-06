<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInscripcioneRequest;
use App\Models\Barrio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Personale;
use App\Models\Contacto;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Inscripcione;
use App\Models\Pago;
use App\Models\Obligacione;
use DB;
use App\Notifications\InscripcioneNotification;

class InscripcioneController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.inscripciones.index')->only('index');
        $this->middleware('can:admin.inscripciones.create')->only('create', 'store');
        $this->middleware('can:admin.inscripciones.edit')->only('edit', 'update');
        $this->middleware('can:admin.inscripciones.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.inscripciones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $contacto = Contacto::find($_GET['idcontacto']);
        $personale_existe = null;
        if (isset($contacto->personale)) {
            $personale_existe = 'Ya es personale, se sugiere tipo de matrícula para personale antiguo.';
        }

        $roles = Role::whereNotIn('id', [1])->pluck('name', 'id');
        $barrios = Barrio::orderBy('nombre')->pluck('nombre', 'id');

        // $vendedores = [];
        // if (auth()->user()->can(['Admin'])) {
        //     $vendedores = Personale::select(DB::raw('concat(nombres, " ", apellidos) as nombre'), 'id')->pluck('nombre', 'id');
        //     //$contacto['vendedor_id'] = $contacto->personal_id;
        // }

        return view('admin.inscripciones.create', compact('contacto', 'personale_existe', 'roles', 'barrios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInscripcioneRequest $request)
    {

        //actualizar daotos del contacto
        $contacto = Contacto::find($request->contacto_id);
        //$this->authorize('updating', $contacto);// no se que hacia esto aquí
        $request['estado'] = 5;

        /*if (isset($request['vendedor_id'])) {
            //para actualizar el vendedor del contacto si fuera necesario
            $request['personal_id'] = $request['vendedor_id'];
        }*/

        $personale_existe = Personale::where('contacto_id', '=', $request->contacto_id)->get();


        if (!count($personale_existe)){//entra si el personale no existe

            $usuario_existe = User::where('email', $request->email)->get();

            if (count($usuario_existe)>0){
                return redirect()->back()->with('error', 'El correo electrónico ya está asociado a otro usuario, debe ingresar uno diferente.');
            }

            $contacto->update($request->all());
            $contacto = Contacto::find($request->contacto_id);

            
            //crear el usuario y asignarlo al request
            $user = User::create([
                'name' => $contacto->nombres . ' ' . $contacto->apellidos,
                'email' => $contacto->email,
                'password' => Hash::make('password'),
                'estado' => 1,
            ])->assignRole(Role::find($request->role_id)->name);

            $request['user_id'] = $user->id;
            $request['permiso_obispo'] = 0;

            //obtener el ultimo codigo de personale y asignar el nuevo
            //PersonaleObserver / creating
            //crear el personale 
            $personale = Personale::create($request->all());

        } else {
            $inscripcione_existe = Inscripcione::where('personale_id', $contacto->personale->id)->where('programa_id', $request->programa_id)->get();
            
            if (!count($inscripcione_existe)){ //Entra si no hay inscripcione en el mismo grupo
                $contacto->update($request->all());

                $personale = $contacto->personale;
            } else {
                 return redirect()->back()->with('error', 'El personale ya está inscrito en el grupo seleccionado.');
            }
        }

        $request['personale_id'] = $personale->id;

        //estado de la inscripcione
        $request['estado'] = '0';

        //registrar la matrícula
        $inscripcione = Inscripcione::create($request->all());

        //generar las obligaciones por pagar -> InscripcioneObserver

        //enviar notification de inscripcione al personale
        $user = $personale->user;
        //$user->notify(new InscripcioneNotification($inscripcione));
        
        return redirect()->route('admin.inscripciones.show', $inscripcione)->with('info', 'Inscripción registrada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inscripcione  $inscripcione
     * @return \Illuminate\Http\Response
     */
    public function show(Inscripcione $inscripcione)
    {
        return view('admin.inscripciones.show', compact('inscripcione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inscripcione  $inscripcione
     * @return \Illuminate\Http\Response
     */
    public function edit(Inscripcione $inscripcione)
    {
        $roles = Role::whereIn('id', [2,3,4,5,6])->pluck('name', 'id');
        return view('admin.inscripciones.edit', compact('inscripcione', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inscripcione  $inscripcione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inscripcione $inscripcione)
    {   

        // if ($request->tipoinscripcione != $inscripcione->tipoinscripcione) {
            
        //     $haypagos = Pago::whereHas('obligacione', function($query) use ($inscripcione){
        //         $query->where('inscripcione_id', $inscripcione->id);
        //     })->count();
        //     //dd($haypagos);
        //     if ($haypagos > 0 ){
        //         return redirect()->back()->with('haypagos', 'No puede cambiar el tipo de inscripcione porque algunas obligaciones ya fueron pagadas.');
        //     }
            
        // }

       /* $request->validate([
            'estado' => 'in:0,1,2,3',
            'tipoinscripcione' => 'in:0,1',
           // 'haypagos' => 'in:0'
        ], [
            'haypagos.in' => 'No puede cambiar el tipo de inscripcione porque algunas obligaciones ya fueron pagadas.'
        ]);*/


        $inscripcione->update([
            'estado' => $request->estado,
            'role_id' => $request->role_id
        ]);
        
        return redirect()->route('admin.inscripciones.edit', compact('inscripcione'))->with('info','Se actualizaron los datos correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inscripcione  $inscripcione
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inscripcione $inscripcione)
    {
        $personale = $inscripcione->personale; 
        $user = $personale->user;
        $inscripcione->delete();
        $personale->delete();
        $user->delete();

        return redirect()->route('admin.inscripciones.index')->with('eliminar','Ok');
    }
}
