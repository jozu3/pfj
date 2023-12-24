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
use App\Models\Estaca;
use App\Models\Image;
use Intervention\Image\Facades\Image as ImageIntervention;
use DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

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

        $estacas = Estaca::all();
        $estacasselect = [];

        foreach ($estacas as $estaca) {
            $estacasselect[$estaca->nombre] = Barrio::where('estaca_id', $estaca->id)->pluck('nombre', 'id');
        } 

        return view('admin.contactos.create', compact('estacasselect'));
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
                'url' => $url,
                'tipo' => 'original'
            ]);
            
            //image 200x200
            $extension = $request->file('imgperfil')->getClientOriginalExtension();
            $image_200x200 = ImageIntervention::make($request->file('imgperfil'))->resize(200, null, function ($constraint) {
                                                                                    $constraint->aspectRatio();
                                                                                })->encode($extension);
            $name_img_200x200 = $contacto->id."_".$contacto->nombres."_".$contacto->apellidos.".".$extension;
            $url_200x200 = Storage::put('contactos/200x200/'.$name_img_200x200, $image_200x200);
            $contacto->image200x200()->create([
                'url' => $url_200x200,
                'tipo' => '200x200'
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

        $barrios = Barrio::orderBy('nombre', 'asc')->get()->pluck('nombre', 'id');
        
        // $estacas = Estaca::orderBy('nombre', 'asc')->get();
        // if (auth()->user()->hasRole(['Admin', 'Asistente'])) {
        //     $vendedores = Personale::select(DB::raw('concat(nombres, " ", apellidos) as nombre'), 'id')->pluck('nombre', 'id');

        //     $contacto['vendedor_id'] = $contacto->personal_id;
        // }

        $roles = Role::whereNotIn('id', [1])->pluck('name', 'id');

        $estacas = Estaca::all();
        $estacasselect = [];

        foreach ($estacas as $estaca) {
            $estacasselect[$estaca->nombre] = Barrio::where('estaca_id', $estaca->id)->pluck('nombre', 'id');
        }

        return view('admin.contactos.show', compact('contacto','seguimientos', 'pfjs', 'barrios', 'estacasselect', 'roles'));
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
                'name' => $request->nombres. ' '. $request->apellidos,
                'email' => $request->email
            ]);
        }
        
        if ($request->file('imgperfil')) {
            $url = Storage::put('contactos', $request->file('imgperfil'));
            //image 200x200
            $extension = $request->file('imgperfil')->getClientOriginalExtension();
            $image_200x200 = ImageIntervention::make($request->file('imgperfil'))->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode($extension);
            $name_img_200x200 = $contacto->id."_".$contacto->nombres."_".$contacto->apellidos.".".$extension;
            $url_200x200 = Storage::put('contactos/200x200/'.$name_img_200x200, $image_200x200);
            
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
            
            if($contacto->image200x200 != null){
                // Storage::delete($contacto->image200x200->url);
                // dd($url);
                $contacto->image200x200()->update([
                    'url' => $url_200x200,
                    'tipo' => '200x200'                
                ]);
            } else {
                $contacto->image200x200()->create([
                    'url' => $url_200x200,
                    'tipo' => '200x200'
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
        $errors = [];
        try {
            if (isset($contacto->personale)) {
                $errors['error_delete_contacto'] = 'No se puede eliminar porque. El contacto tiene un personal creado.';
            } else {
                // dd($contacto->image()->pluck('url')->toArray());
                Storage::delete($contacto->image()->pluck('url')->toArray());
                Storage::delete($contacto->image200x200()->pluck('url')->toArray());
                $contacto->image()->delete();
                $contacto->image200x200()->delete();
                $contacto->delete();

            }
        } catch (QueryException $qex) {
            return redirect()->back()->withErrors(['error_delete_contacto' =>  $qex->getMessage()]);
        }        
        if (count($errors)) {
            return redirect()->back()->withErrors($errors);
        }
        return redirect()->route('admin.contactos.index')->with('info', 'Contacto eliminado con éxito');
    }
}
