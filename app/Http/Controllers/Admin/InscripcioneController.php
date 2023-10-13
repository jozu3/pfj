<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInscripcioneRequest;
use App\Models\Barrio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Personale;
use App\Models\Contacto;
use App\Models\Estaca;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Inscripcione;
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
        $contacto['permiso_obispo'] = $contacto->estado_aprobacion == null ? 0 : $contacto->estado_aprobacion;
        $personale_existe = null;
        if (isset($contacto->personale)) {
            $personale_existe = 'Ya es personal, se sugiere tipo de matrícula para personale antiguo.';
        }

        $roles = Role::whereNotIn('id', [1])->pluck('name', 'id');
        $barrios = Barrio::orderBy('nombre')->pluck('nombre', 'id');
        $estacas = Estaca::all();
        $estacasselect = [];

        foreach ($estacas as $estaca) {
            $estacasselect[$estaca->nombre] = Barrio::where('estaca_id', $estaca->id)->pluck('nombre', 'id');
        }
        return view('admin.inscripciones.create', compact('contacto', 'personale_existe', 'roles', 'barrios', 'estacas', 'estacasselect'));
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
        $old_contacto = Contacto::where('email', $request->email)->where('id', '<>', $request->contacto_id)
                                ->whereHas('personale', function($q) use ($request){
                                    $q->whereHas('user', function($qu) use ($request){
                                        $qu->where('email', $request->email);
                                    });
                                })->get();

        if ($old_contacto->count() == 1) {
            Personale::where('contacto_id', $old_contacto->first()->id)->first()->update([
                'contacto_id' => $request->contacto_id
            ]);
        }

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

            $password = substr(str_shuffle("0123456789PFJ"),0,8);
            //crear el usuario y asignarlo al request
            $user = User::create([
                'name' => $contacto->nombres . ' ' . $contacto->apellidos,
                'email' => $contacto->email,
                'password' => Hash::make($password),
                'estado' => 1,
            ])->assignRole(Role::find($request->role_id)->name);

            $request['user_id'] = $user->id;
            // $request['permiso_obispo'] = 0;

            //obtener el ultimo codigo de personale y asignar el nuevo
            //PersonaleObserver / creating
            //crear el personale 
            $personale = Personale::create($request->all());

        } else {
            $password = '';
            $inscripcione_existe = Inscripcione::where('personale_id', $contacto->personale->id)->where('programa_id', $request->programa_id)->get();
            
            if (!count($inscripcione_existe)){ //Entra si no hay inscripcione en el mismo grupo
                $contacto->update($request->all());

                $personale = $contacto->personale;
            } else {
                 return redirect()->back()->with('error', 'El personal ya está inscrito en la sesión seleccionada.');
            }
        }

        $request['personale_id'] = $personale->id;

        //estado de la inscripcione
        $request['estado'] = '1';

        //registrar la inscripcion
        $inscripcione = Inscripcione::create($request->all());

        //enviar notification de inscripcione al personale
        $user = $personale->user;
        $user->notify(new InscripcioneNotification($inscripcione, $password));
        
        return redirect()->route('admin.inscripciones.show', $inscripcione)->with('info', 'Inscripción registrada correctamente. Se envío la notificación al correo '.  $user->email);
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
        $inscripcione->update($request->all());
        $inscripcione->funciones()->sync($request->funciones);
        
        
        
        return redirect()->route('admin.programas.personal', $inscripcione->programa)->with('info','Se actualizaron los datos correctamente');
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
        if(!count($personale->inscripciones)){
            $personale->delete();
            $user->delete();
        }
        
        return redirect()->route('admin.inscripciones.index')->with('eliminar','Ok');
    }
    
    public function notificacion(Inscripcione $inscripcione){
        $user =  $inscripcione->personale->user; 
        $user->notify(new InscripcioneNotification($inscripcione, ''));
        
        return redirect()->route('admin.inscripciones.show', $inscripcione)->with('info', 'Se envío la notificación correctamente al correo '.  $user->email);
    }
}
