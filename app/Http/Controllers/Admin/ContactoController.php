<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Contacto;
use App\Models\Seguimiento;
use App\Models\Personale;
use App\Models\Pfj;
use Illuminate\Http\Request;
use App\Http\Requests\StoreContactoRequest;
use App\Models\Barrio;
use DB;

use Illuminate\Support\Facades\Storage;

class ContactoController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.contactos.index')->only('index');
        $this->middleware('can:admin.contactos.create')->only('create', 'store');
        $this->middleware('can:admin.contactos.edit')->only('edit', 'update');
        $this->middleware('can:admin.contactos.destroy')->only('destroy');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.contactos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('crear', Contacto::class);
        $vendedores = [];
        // if (auth()->user()->hasRole(['Admin', 'Asistente'])) {
        //     $vendedores = Personale::select(DB::raw('concat(nombres, " ", apellidos) as nombre'), 'id')->pluck('nombre', 'id');
        // }

        return view('admin.contactos.create', compact('vendedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactoRequest $request)
    {

        //return Storage::put('contactos', $request->file('imgperfil'));

        
        $request['estado'] = 1;
        /*if (isset($request['vendedor_id'])) {
            $request['personal_id'] = $request['vendedor_id'];
        }*/
        $contacto = Contacto::create($request->all());

        if ($request->file('imgperfil')) {
            $url = Storage::put('contactos', $request->file('imgperfil'));
            $contacto->image()->create([
                'url' => $url
            ]);
        }

        return redirect()->route('admin.contactos.show', compact('contacto'))->with('info', 'Contacto creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contacto $contacto)
    {
        //dd($contacto->id);
        // $this->authorize('vendiendo', $contacto);

        $seguimientos = Seguimiento::where('contacto_id', $contacto->id)->get();
        $pfjs = Pfj::pluck('nombre', 'id');

        $barrios = Barrio::all()->pluck('nombre', 'id');
        // if (auth()->user()->hasRole(['Admin', 'Asistente'])) {
        //     $vendedores = Personale::select(DB::raw('concat(nombres, " ", apellidos) as nombre'), 'id')->pluck('nombre', 'id');

        //     $contacto['vendedor_id'] = $contacto->personal_id;
        // }

        return view('admin.contactos.show', compact('contacto','seguimientos', 'pfjs', 'barrios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacto $contacto)
    {
        
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreContactoRequest $request, Contacto $contacto)
    {
        

        /*if (isset($request['vendedor_id'])) {
            $request['personal_id'] = $request['vendedor_id'];
        }*/
        //return Storage::put('contactos', $request->imgperfil);

        if (!$contacto->update($request->all())) {
            
            return redirect()->route('admin.contactos.show', compact('contacto'))->with('error', 'Hubo un error al actualizar');
        }
        if($contacto->personale && $contacto->personale->user){

            $contacto->personale->user->update([
                'email' => $request->email
            ]);
        }
        
        if ($request->file('imgperfil')) {
            $url = Storage::put('contactos', $request->file('imgperfil'));
            //$contacto->image()->delete();
            if($contacto->image != null){
                Storage::delete($contacto->image->url);
                $contacto->image->update([
                    'url' => $url
                ]);
            } else {
                $contacto->image()->create([
                    'url' => $url
                ]);
            }
        }

        if ($request->asignar == 'true'){
            return redirect()->route('admin.contactos.index')->with('info', 'Contacto actualizado con éxito');
        }      

        return redirect()->route('admin.contactos.show', compact('contacto'))->with('info', 'Contacto actualizado con éxito');
    }


/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacto $contacto)
    {
        $this->authorize('vendiendo', $contacto);
        
        $contacto->delete();

        return redirect()->route('admin.contactos.index')->with('info', 'Contacto eliminado con éxito');
    }
}
