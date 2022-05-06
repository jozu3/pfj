<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Personale;
use App\Models\User;

class PersonaleController extends Controller
{   
    public function __construct(){
        $this->middleware('can:admin.personales.index')->only('index');
        $this->middleware('can:admin.personales.edit')->only('edit');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.personales.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.personales.create');
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
            'telefono' => 'required',
        ]);
        
        $personal = Personale::create($request->all());


        return redirect()->route('admin.users.create', compact('personal'))->with('info', 'El personal se creó correctamente, ahora debe crear el usuario y contraseña');
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
    public function edit(Personale $personale)
    {
        return view('admin.personales.edit', compact('personale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Personale $personale, Request $request)
    {

        $request->validate([
            // 'nombres' => 'required',
            // 'apellidos' => 'required',
            // 'telefono' => 'required',
            'permiso_obispo' => 'required'
        ]);

        //$personale->contacto->update($request->all());
        $personale->update($request->all());

        // $upt = User::where('id', $personale->user_id)->update([
        //     'name' => $request->nombres. ' ' . $request->apellidos
        // ]);
        if ($request->show_contacto) {
            return redirect()->route('admin.contactos.show', $personale->contacto)->with('info', 'Los datos se guardaron correctamente');
        }
        return redirect()->route('admin.personales.edit', $personale)->with('info', 'Los datos se guardaron correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personale $personale)
    {
        $personale->delete();

        return redirect()->back()->with('info', 'El personal se eliminó correctamente.');
    }
}
